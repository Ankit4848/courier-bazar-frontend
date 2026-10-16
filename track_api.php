<?php
/**
 * Courier Bazar — Production Portal Live Tracking Backend API
 * Direct integration with CourierBazar Live Portal API (https://ship.courierbazar.in)
 */

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Accept');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// Suppress raw notices/warnings so JSON response is never corrupted
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
ini_set('display_errors', '0');

$rawSearch = trim((string) ($_GET['awb'] ?? ($_GET['order_id'] ?? ($_POST['awb'] ?? ($_POST['order_id'] ?? '')))));

if (empty($rawSearch)) {
    echo json_encode([
        'success' => false,
        'found' => false,
        'message' => 'Please enter a valid AWB number or Order ID.'
    ]);
    exit;
}

// =========================================================================
// LIVE PORTAL API BRIDGE (Direct Live Portal Query)
// =========================================================================
$liveUrls = [
    'https://ship.courierbazar.in/api/tracking?awb=' . urlencode($rawSearch),
];
$localUrls = [
    'http://localhost:1000/api/tracking?awb=' . urlencode($rawSearch),
    'http://127.0.0.1/CourierBazar/public/api/tracking?awb=' . urlencode($rawSearch),
    'http://localhost/CourierBazar/public/api/tracking?awb=' . urlencode($rawSearch),
    'http://127.0.0.1/CourierBazar/api/tracking?awb=' . urlencode($rawSearch),
    'http://localhost/CourierBazar/api/tracking?awb=' . urlencode($rawSearch),
];

// When this site runs on localhost, ask the local portal first so local backend
// changes show up before they are deployed.
$requestHost = strtolower(preg_replace('/:\d+$/', '', (string) ($_SERVER['HTTP_HOST'] ?? '')));
$isLocalHost = in_array($requestHost, ['localhost', '127.0.0.1', '::1', '[::1]'], true);

$portalUrls = array_merge(
    $isLocalHost ? $localUrls : $liveUrls,
    $isLocalHost ? $liveUrls : $localUrls,
    ['https://cb.softieons.me/api/tracking?awb=' . urlencode($rawSearch)]
);

$lastErrorMessage = null;

foreach ($portalUrls as $portalUrl) {
    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL => $portalUrl,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => false,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_TIMEOUT => 8,
        CURLOPT_CONNECTTIMEOUT => 4,
        CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) CourierBazar-Front/1.0',
        CURLOPT_HTTPHEADER => [
            'Accept: application/json',
            'Content-Type: application/json'
        ]
    ]);
    $portalBody = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($portalBody) {
        $portalRes = json_decode($portalBody, true);

        if (is_array($portalRes)) {
            if ((($portalRes['status'] ?? false) === true || ($portalRes['success'] ?? false) === true) && !empty($portalRes['data'])) {
                $pData = $portalRes['data'];

                $rawHistory = $pData['history'] ?? [];
                $history = [];
                if (!empty($rawHistory) && is_array($rawHistory)) {
                    // Sort descending by date if valid timestamps exist so latest scan is first
                    usort($rawHistory, function ($a, $b) {
                        $tA = !empty($a['date']) ? strtotime($a['date']) : 0;
                        $tB = !empty($b['date']) ? strtotime($b['date']) : 0;
                        if ($tA === $tB) {
                            return 0;
                        }
                        return ($tB > $tA) ? 1 : -1;
                    });

                    foreach ($rawHistory as $idx => $h) {
                        $history[] = [
                            'title' => 'Activity : ' . ($h['status'] ?? 'Update'),
                            'location' => $h['location'] ?? 'Transit Hub',
                            'instructions' => $h['instructions'] ?? ($h['tag'] ?? ''),
                            'time' => !empty($h['date']) ? $h['date'] : date('d M Y, h:i A'),
                            'latest' => ($idx === 0)
                        ];
                    }
                }

                $courierName = $pData['courier_name'] ?? ($pData['shipping_company_name'] ?? 'Courier Partner');
                $courierLower = strtolower($courierName);
                $courierIcon = 'bi-truck';
                if (strpos($courierLower, 'express') !== false || strpos($courierLower, 'xpress') !== false || strpos($courierLower, 'shadowfax') !== false) {
                    $courierIcon = 'bi-lightning-charge';
                } elseif (strpos($courierLower, 'dart') !== false || strpos($courierLower, 'box') !== false || strpos($courierLower, 'ekart') !== false) {
                    $courierIcon = 'bi-box-seam';
                } elseif (strpos($courierLower, 'post') !== false) {
                    $courierIcon = 'bi-envelope-paper';
                }

                $rawStatus = $pData['status'] ?? 'In Transit';

                // Order matters: "out for delivery" and "rto delivered" both contain
                // "deliver", which used to mark those shipments as delivered.
                $statusLower = strtolower(trim(str_replace('_', ' ', (string) $rawStatus)));
                $isReturn = strpos($statusLower, 'rto') !== false || strpos($statusLower, 'return') !== false;
                if ($isReturn) {
                    // Returning to the seller: never shown as delivered to the customer.
                    $statusCode = 'in-transit';
                    $progress = 50;
                } elseif (strpos($statusLower, 'out for delivery') !== false || $statusLower === 'dispatched') {
                    $statusCode = 'out-for-delivery';
                    $progress = 75;
                } elseif (preg_match('/^(shipment )?delivered\b/', $statusLower)) {
                    $statusCode = 'delivered';
                    $progress = 100;
                } elseif (preg_match('/not picked|pending pickup|pickup pending|ready to ship|manifest|^new$|book/', $statusLower)) {
                    $statusCode = 'booked';
                    $progress = 25;
                } else {
                    // In transit, and "pending" (a failed delivery attempt awaiting the next one).
                    $statusCode = 'in-transit';
                    $progress = 50;
                }

                $expectedDelivery = !empty($pData['expected_delivery']) && $pData['expected_delivery'] !== 'N/A'
                    ? (is_numeric(strtotime($pData['expected_delivery'])) ? date('d M Y, h:i A', strtotime($pData['expected_delivery'])) : $pData['expected_delivery'])
                    : 'N/A';

                $originCity = !empty($pData['origin_city']) ? trim($pData['origin_city'] . (!empty($pData['origin_state']) ? ', ' . $pData['origin_state'] : '')) : null;
                $originPincode = !empty($pData['origin_pincode']) ? $pData['origin_pincode'] : null;
                $destCity = !empty($pData['destination_city']) ? trim($pData['destination_city'] . (!empty($pData['destination_state']) ? ', ' . $pData['destination_state'] : '')) : null;
                $destPincode = !empty($pData['destination_pincode']) ? $pData['destination_pincode'] : null;

                // Proof of delivery links (ePOD, receiver signature, LM POD) from the portal.
                $podDocuments = [];
                foreach ((array) ($pData['pod_documents'] ?? []) as $doc) {
                    $docUrl = is_array($doc) ? (string) ($doc['url'] ?? '') : '';
                    if (preg_match('#^https?://#i', $docUrl)) {
                        $podDocuments[] = [
                            'label' => trim((string) ($doc['label'] ?? '')) ?: 'Proof of Delivery',
                            'url' => $docUrl,
                        ];
                    }
                }

                $bookedTime = !empty($rawHistory) ? end($rawHistory)['date'] : null;
                // $rawHistory is sorted newest first, so its first scan is the delivery scan.
                $deliveredTime = ($statusCode === 'delivered' && !empty($rawHistory[0]['date'])) ? $rawHistory[0]['date'] : null;

                echo json_encode([
                    'success' => true,
                    'found' => true,
                    'data' => [
                        'awb' => !empty($pData['awb_number']) ? $pData['awb_number'] : $rawSearch,
                        'courier' => $courierName,
                        'courierIcon' => $courierIcon,
                        'status' => ucfirst($rawStatus),
                        'statusCode' => $statusCode,
                        'origin' => $originCity,
                        'originPincode' => $originPincode,
                        'destination' => $destCity,
                        'destPincode' => $destPincode,
                        'lr_no' => $pData['lr_no'] ?? null,
                        'order_prefix' => $pData['order_prefix'] ?? ($pData['reference_number'] ?? null),
                        'estDelivery' => $expectedDelivery,
                        'steps' => [
                            ['label' => 'Booked', 'time' => !empty($bookedTime) ? $bookedTime : 'Completed', 'status' => 'completed'],
                            ['label' => 'Picked Up', 'time' => $progress >= 50 ? 'Completed' : ($progress >= 25 ? 'In Progress' : 'Pending'), 'status' => $progress >= 50 ? 'completed' : ($progress >= 25 ? 'active' : 'pending')],
                            ['label' => 'In Transit', 'time' => $progress >= 75 ? 'Completed' : ($progress >= 50 ? 'Active' : 'Pending'), 'status' => $progress >= 75 ? 'completed' : ($progress >= 50 ? 'active' : 'pending')],
                            ['label' => 'Out for Delivery', 'time' => $statusCode === 'out-for-delivery' ? 'Active' : ($progress == 100 ? 'Completed' : 'Pending'), 'status' => $statusCode === 'delivered' ? 'completed' : ($statusCode === 'out-for-delivery' ? 'active' : 'pending')],
                            ['label' => 'Delivered', 'time' => ($statusCode === 'delivered') ? ($deliveredTime ?: 'Completed') : ($expectedDelivery !== 'N/A' ? $expectedDelivery : 'Pending'), 'status' => $statusCode === 'delivered' ? 'completed' : 'pending']
                        ],
                        'progressPercent' => $progress,
                        'activities' => $history,
                        'podDocuments' => $podDocuments
                    ]
                ]);
                exit;
            } elseif (!empty($portalRes['message'])) {
                $lastErrorMessage = $portalRes['message'];
            }
        }
    }
}

// =========================================================================
// SHIPMENT NOT FOUND RESPONSE
// =========================================================================
echo json_encode([
    'success' => false,
    'found' => false,
    'awb' => $rawSearch,
    'message' => $lastErrorMessage ?: ('Tracking details not found for AWB / Order: ' . $rawSearch)
]);
