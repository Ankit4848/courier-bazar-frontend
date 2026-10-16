<?php
/**
 * Courier Bazar — Production Portal Live Tracking Backend API
 * Queries CourierBazar database & Live Delhivery/ShipMozo/XpressBees API
 */

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');

$awbInput = isset($_GET['awb']) ? trim($_GET['awb']) : '';
$orderIdInput = isset($_GET['order_id']) ? trim($_GET['order_id']) : '';

$queryVal = !empty($awbInput) ? $awbInput : $orderIdInput;
$queryVal = preg_replace('/[^a-zA-Z0-9]/', '', $queryVal);

if (empty($queryVal)) {
    echo json_encode([
        'success' => false,
        'found' => false,
        'message' => 'Please enter a valid AWB or Order Number.'
    ]);
    exit;
}

// 1. Portal API Bridge: Query live Portal API (https://cb.softieons.me/api/tracking) for 100% data consistency
$portalUrls = [
    'https://cb.softieons.me/api/tracking?awb=' . urlencode($queryVal),
    'http://127.0.0.1/CourierBazar/public/api/tracking?awb=' . urlencode($queryVal)
];

foreach ($portalUrls as $portalUrl) {
    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL => $portalUrl,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => false,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_TIMEOUT => 5,
        CURLOPT_HTTPHEADER => ['Accept: application/json']
    ]);
    $portalBody = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($portalBody && $httpCode === 200) {
        $portalRes = json_decode($portalBody, true);
        if ((($portalRes['status'] ?? false) || ($portalRes['success'] ?? false)) && !empty($portalRes['data'])) {
            $pData = $portalRes['data'];

            $history = [];
            if (!empty($pData['history']) && is_array($pData['history'])) {
                foreach ($pData['history'] as $idx => $h) {
                    $history[] = [
                        'title' => 'Activity : ' . ($h['status'] ?? 'Update'),
                        'location' => $h['location'] ?? 'N/A',
                        'instructions' => '',
                        'time' => !empty($h['date']) ? $h['date'] : date('M d, Y h:i a'),
                        'latest' => ($idx === 0)
                    ];
                }
            }

            $courierName = $pData['courier_name'] ?? ($pData['shipping_company_name'] ?? 'Courier Partner');
            $rawStatus = $pData['status'] ?? 'In Transit';

            $statusCode = 'in-transit';
            $statusLower = strtolower($rawStatus);
            if (strpos($statusLower, 'deliver') !== false)
                $statusCode = 'delivered';
            elseif (strpos($statusLower, 'out') !== false)
                $statusCode = 'out-for-delivery';
            elseif (strpos($statusLower, 'not picked') !== false || strpos($statusLower, 'pending') !== false || strpos($statusLower, 'manifest') !== false || strpos($statusLower, 'new') !== false)
                $statusCode = 'booked';

            $progress = 25;
            if ($statusCode === 'delivered')
                $progress = 100;
            elseif ($statusCode === 'out-for-delivery')
                $progress = 75;
            elseif ($statusCode === 'in-transit')
                $progress = 50;

            echo json_encode([
                'success' => true,
                'found' => true,
                'data' => [
                    'awb' => !empty($pData['awb_number']) ? $pData['awb_number'] : $queryVal,
                    'courier' => $courierName,
                    'courierIcon' => 'bi-truck',
                    'status' => ucfirst($rawStatus),
                    'statusCode' => $statusCode,
                    'origin' => 'Origin, India',
                    'originPincode' => '395007',
                    'destination' => 'Destination, India',
                    'destPincode' => '395009',
                    'lr_no' => $pData['lr_no'] ?? null,
                    'order_prefix' => $pData['order_prefix'] ?? null,
                    'estDelivery' => $pData['expected_delivery'] ?? 'N/A',
                    'steps' => [
                        ['label' => 'Booked', 'time' => 'Completed', 'status' => 'completed'],
                        ['label' => 'Picked Up', 'time' => $progress >= 50 ? 'Completed' : 'Pending', 'status' => $progress >= 50 ? 'completed' : 'pending'],
                        ['label' => 'In Transit', 'time' => $progress >= 50 ? 'Active' : 'Pending', 'status' => $progress >= 75 ? 'completed' : ($progress >= 50 ? 'active' : 'pending')],
                        ['label' => 'Out for Delivery', 'time' => $statusCode === 'out-for-delivery' ? 'Active' : ($progress == 100 ? 'Completed' : 'Pending'), 'status' => $statusCode === 'delivered' ? 'completed' : ($statusCode === 'out-for-delivery' ? 'active' : 'pending')],
                        ['label' => 'Delivered', 'time' => $pData['expected_delivery'] ?? ($statusCode === 'delivered' ? 'Completed' : 'Pending'), 'status' => $statusCode === 'delivered' ? 'completed' : 'pending']
                    ],
                    'progressPercent' => $progress,
                    'activities' => $history
                ]
            ]);
            exit;
        }
    }
}

$dbHost = '127.0.0.1';
$dbName = 'courierbazar';
$dbUser = 'root';
$dbPass = '';

try {
    $pdo = new PDO("mysql:host={$dbHost};dbname={$dbName};charset=utf8mb4", $dbUser, $dbPass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);

    // Query order from database with warehouse & customer address joins
    $stmt = $pdo->prepare("
        SELECT o.*, 
               sc.name AS shipping_company_name, sc.url AS sc_url, sc.api_key AS sc_api_key,
               w.city AS warehouse_city, w.state AS warehouse_state, w.zip_code AS warehouse_pincode, w.warehouse_name AS warehouse_name,
               ca.city AS cust_city, ca.state AS cust_state, ca.zip_code AS cust_pincode, ca.address AS cust_address
        FROM orders o
        LEFT JOIN shipping_companies sc ON o.shipping_company_id = sc.id
        LEFT JOIN courier_warehouses w ON o.warehouse_id = w.id
        LEFT JOIN customer_addresses ca ON o.customer_address_id = ca.id
        WHERE o.awb_number = :val1 
           OR o.order_prefix = :val2 
           OR o.lr_no = :val3
           OR o.id = :val4
           OR o.order_prefix LIKE :val5
           OR o.awb_number LIKE :val5
        LIMIT 1
    ");

    $stmt->execute([
        ':val1' => (string) $queryVal,
        ':val2' => (string) $queryVal,
        ':val3' => (string) $queryVal,
        ':val4' => is_numeric($queryVal) ? (int)$queryVal : 0,
        ':val5' => '%' . $queryVal . '%',
    ]);

    $order = $stmt->fetch();

    if ($order) {
        $history = [];
        $liveConsigneeCity = null;
        $liveConsigneeState = null;
        $liveConsigneePin = null;

        $scApiKey = $order['sc_api_key'] ?? null;
        $scUrl = $order['sc_url'] ?? null;
        $scId = (int) ($order['shipping_company_id'] ?? 0);

        // 1. Fetch live Delhivery B2C API scans
        if (!empty($order['awb_number']) && !empty($scApiKey) && in_array($scId, [1, 4, 5])) {
            $baseUrl = rtrim($scUrl ?? 'https://track.delhivery.com', '/');
            $fullUrl = $baseUrl . '/api/v1/packages/json?waybill=' . urlencode($order['awb_number']) . '&token=' . urlencode($scApiKey);

            $ch = curl_init();
            curl_setopt_array($ch, [
                CURLOPT_URL => $fullUrl,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_SSL_VERIFYHOST => false,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_TIMEOUT => 8,
                CURLOPT_HTTPHEADER => ['Accept: application/json']
            ]);
            $respBody = curl_exec($ch);
            curl_close($ch);

            if ($respBody) {
                $respData = json_decode($respBody, true);
                $shipmentData = (isset($respData['ShipmentData']) && is_array($respData['ShipmentData']) && isset($respData['ShipmentData'][0]) && is_array($respData['ShipmentData'][0])) ? $respData['ShipmentData'][0] : [];
                $shipment = (isset($shipmentData['Shipment']) && is_array($shipmentData['Shipment'])) ? $shipmentData['Shipment'] : [];
                $scans = (isset($shipment['Scans']) && is_array($shipment['Scans'])) ? $shipment['Scans'] : [];

                if (!empty($shipment['Consignee']) && is_array($shipment['Consignee'])) {
                    $liveConsigneeCity = $shipment['Consignee']['City'] ?? null;
                    $liveConsigneeState = $shipment['Consignee']['State'] ?? null;
                    $liveConsigneePin = $shipment['Consignee']['PinCode'] ?? null;
                }

                if (!empty($scans) && is_array($scans)) {
                    // Reverse to show latest scans at top (matching portal)
                    $reversedScans = array_reverse($scans);
                    foreach ($reversedScans as $idx => $scan) {
                        $s = (isset($scan['ScanDetail']) && is_array($scan['ScanDetail'])) ? $scan['ScanDetail'] : (is_array($scan) ? $scan : []);
                        $history[] = [
                            'title' => 'Activity : ' . ($s['Scan'] ?? 'Update'),
                            'location' => $s['ScannedLocation'] ?? 'Surat_RingRd_C (Gujarat)',
                            'instructions' => $s['Instructions'] ?? '',
                            'time' => !empty($s['ScanDateTime']) ? date('M d, Y h:i a', strtotime($s['ScanDateTime'])) : date('M d, Y h:i a'),
                            'latest' => ($idx === 0)
                        ];
                    }
                }
            }
        }

        // 2. Format order_statuses if external scans unavailable
        if (empty($history)) {
            $stmtStatus = $pdo->prepare("
                SELECT order_status, created_at 
                FROM order_statuses 
                WHERE order_id = :oid 
                ORDER BY id DESC
            ");
            $stmtStatus->execute([':oid' => $order['id']]);
            $orderStatuses = $stmtStatus->fetchAll();

            $originLoc = !empty($order['warehouse_city']) ? $order['warehouse_city'] . (!empty($order['warehouse_state']) ? ' (' . $order['warehouse_state'] . ')' : '') : 'Surat_RingRd_C (Gujarat)';
            foreach ($orderStatuses as $idx => $st) {
                $history[] = [
                    'title' => 'Activity : ' . ucfirst($st['order_status']),
                    'location' => $originLoc,
                    'instructions' => '',
                    'time' => date('M d, Y h:i a', strtotime($st['created_at'])),
                    'latest' => ($idx === 0)
                ];
            }
        }

        // 3. Fallback default activity
        if (empty($history)) {
            $originLoc = !empty($order['warehouse_city']) ? $order['warehouse_city'] . (!empty($order['warehouse_state']) ? ' (' . $order['warehouse_state'] . ')' : '') : 'Surat_RingRd_C (Gujarat)';
            $history[] = [
                'title' => 'Activity : ' . ucfirst(!empty($order['status_courier']) ? $order['status_courier'] : 'Manifested'),
                'location' => $originLoc,
                'instructions' => '',
                'time' => !empty($order['created_at']) ? date('M d, Y h:i a', strtotime($order['created_at'])) : date('M d, Y h:i a'),
                'latest' => true
            ];
        }

        $courierName = !empty($order['courier_name']) ? $order['courier_name'] : (!empty($order['shipping_company_name']) ? $order['shipping_company_name'] : 'Courier Partner');
        $rawStatus = !empty($order['status_courier']) ? $order['status_courier'] : 'In Transit';

        $statusCode = 'in-transit';
        $statusLower = strtolower($rawStatus);
        if (strpos($statusLower, 'deliver') !== false)
            $statusCode = 'delivered';
        elseif (strpos($statusLower, 'out') !== false)
            $statusCode = 'out-for-delivery';
        elseif (strpos($statusLower, 'not picked') !== false || strpos($statusLower, 'pending') !== false || strpos($statusLower, 'manifest') !== false || strpos($statusLower, 'new') !== false)
            $statusCode = 'booked';

        $progress = 25;
        if ($statusCode === 'delivered')
            $progress = 100;
        elseif ($statusCode === 'out-for-delivery')
            $progress = 75;
        elseif ($statusCode === 'in-transit')
            $progress = 50;

        // Determine Origin City & Pincode
        $originCity = (!empty($order['warehouse_city']) ? $order['warehouse_city'] : 'Surat') . (!empty($order['warehouse_state']) ? ', ' . $order['warehouse_state'] : ', GJ');
        $originPin = !empty($order['warehouse_pincode']) ? $order['warehouse_pincode'] : '395007';

        // Determine Destination City & Pincode
        $destCityStr = !empty($liveConsigneeCity) ? $liveConsigneeCity : (!empty($order['cust_city']) ? $order['cust_city'] : 'Surat');
        $destStateStr = !empty($liveConsigneeState) ? $liveConsigneeState : (!empty($order['cust_state']) ? $order['cust_state'] : 'GJ');
        $destCity = $destCityStr . (!empty($destStateStr) ? ', ' . $destStateStr : '');
        $destPin = !empty($liveConsigneePin) ? $liveConsigneePin : (!empty($order['cust_pincode']) ? $order['cust_pincode'] : '395009');

        echo json_encode([
            'success' => true,
            'found' => true,
            'data' => [
                'awb' => !empty($order['awb_number']) ? $order['awb_number'] : $queryVal,
                'courier' => $courierName,
                'courierIcon' => 'bi-truck',
                'status' => ucfirst($rawStatus),
                'statusCode' => $statusCode,
                'origin' => $originCity,
                'originPincode' => $originPin,
                'destination' => $destCity,
                'destPincode' => $destPin,
                'lr_no' => $order['lr_no'] ?? null,
                'order_prefix' => $order['order_prefix'] ?? null,
                'estDelivery' => !empty($order['delivery_date']) ? date('d M Y', strtotime($order['delivery_date'])) : 'N/A',
                'steps' => [
                    ['label' => 'Booked', 'time' => !empty($order['created_at']) ? date('d M, h:i A', strtotime($order['created_at'])) : 'Completed', 'status' => 'completed'],
                    ['label' => 'Picked Up', 'time' => $progress >= 50 ? 'Completed' : 'Pending', 'status' => $progress >= 50 ? 'completed' : 'pending'],
                    ['label' => 'In Transit', 'time' => $progress >= 50 ? 'Active' : 'Pending', 'status' => $progress >= 75 ? 'completed' : ($progress >= 50 ? 'active' : 'pending')],
                    ['label' => 'Out for Delivery', 'time' => $statusCode === 'out-for-delivery' ? 'Active' : ($progress == 100 ? 'Completed' : 'Pending'), 'status' => $statusCode === 'delivered' ? 'completed' : ($statusCode === 'out-for-delivery' ? 'active' : 'pending')],
                    ['label' => 'Delivered', 'time' => !empty($order['delivery_date']) ? date('d M Y', strtotime($order['delivery_date'])) : ($statusCode === 'delivered' ? 'Completed' : 'Pending'), 'status' => $statusCode === 'delivered' ? 'completed' : 'pending']
                ],
                'progressPercent' => $progress,
                'activities' => $history
            ]
        ]);
        exit;
    }
} catch (Exception $e) {
    // Exception handling
}

echo json_encode([
    'success' => false,
    'found' => false,
    'message' => 'Tracking details not found for AWB: ' . $queryVal
]);
