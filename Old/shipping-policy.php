<?php
$page_title = "Shipping Policy — Courier Bazar";
$page_desc = "Shipping Policy explaining how CourierBazar / Courier Bazar handles shipment bookings, pickups, transit, tracking, delivery, and related services.";
$current_page = 'shipping-policy';
$load_image_slot = false;
include 'upload/header.php';
?>
<div>
  <!-- PAGE HERO -->
  <section class="page-hero">
    <div class="container">
      <nav class="breadcrumb-cb" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo $home_url; ?>">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Shipping Policy</li>
        </ol>
      </nav>
      <h1 class="mt-2">Shipping <span class="grad-text">Policy</span></h1>
      <p class="lead mb-0" style="max-width:44rem;">
        CourierBazar provides shipping, courier, logistics, pickup, tracking, and delivery services for eligible
        locations and shipments. This Shipping Policy explains how shipment bookings, pickups, transit, tracking,
        delivery, and related services are handled.
      </p>
    </div>
  </section>

  <!-- CONTENT SECTION -->
  <section class="section">
    <div class="container">
      <div class="row">
        <!-- MAIN BODY CONTENT -->
        <div class="col-12">
          <div class="policy-card">

            <div id="sec-1" class="mb-5">
              <h2 class="policy-section-title"><span class="sec-num">1</span> Service Coverage</h2>
              <p>CourierBazar provides shipping services to eligible serviceable locations.</p>
              <p>Service availability may depend on:</p>
              <ul>
                <li>Pickup PIN code</li>
                <li>Delivery PIN code</li>
                <li>Shipment type</li>
                <li>Package size and weight</li>
                <li>Service capacity</li>
                <li>Applicable operational restrictions</li>
              </ul>
              <p class="mb-0">Some remote or restricted locations may have limited service availability or longer
                delivery timelines.</p>
            </div>

            <div id="sec-2" class="mb-5">
              <h2 class="policy-section-title"><span class="sec-num">2</span> Shipment Booking</h2>
              <p>To book a shipment, customers may be required to provide:</p>
              <ul>
                <li>Sender name and contact details</li>
                <li>Pickup address</li>
                <li>Recipient name and contact details</li>
                <li>Delivery address</li>
                <li>Package description</li>
                <li>Shipment weight and dimensions</li>
                <li>Declared value, where applicable</li>
                <li>Required shipping documents</li>
              </ul>
              <p class="mb-0">Customers must ensure that all information is accurate and complete.</p>
            </div>

            <div id="sec-3" class="mb-5">
              <h2 class="policy-section-title"><span class="sec-num">3</span> Pickup</h2>
              <p>Pickup availability depends on the selected service, location, booking time, and operational capacity.
              </p>
              <p>Pickup dates and times are estimates and may be changed due to operational requirements, weather
                conditions, holidays, or other circumstances.</p>
              <p class="mb-0">The shipment must be ready and properly packed at the scheduled pickup location.</p>
            </div>

            <div id="sec-4" class="mb-5">
              <h2 class="policy-section-title"><span class="sec-num">4</span> Shipment Processing</h2>
              <p>After pickup, the shipment may undergo:</p>
              <ul>
                <li>Booking verification</li>
                <li>Weight and dimension verification</li>
                <li>Security or compliance checks</li>
                <li>Sorting and routing</li>
                <li>Transfer through logistics facilities</li>
                <li>Dispatch to the destination network</li>
              </ul>
              <p class="mb-0">Actual or volumetric weight may be used to determine the final shipping charge, where
                applicable.</p>
            </div>

            <div id="sec-5" class="mb-5">
              <h2 class="policy-section-title"><span class="sec-num">5</span> Estimated Delivery Time</h2>
              <p>Delivery timelines depend on the origin, destination, selected service, shipment type, and operational
                conditions.</p>
              <p>Estimated delivery dates are not guaranteed and may be affected by:</p>
              <ul>
                <li>Weather conditions</li>
                <li>Traffic or transportation disruptions</li>
                <li>Public holidays</li>
                <li>Remote-area delivery</li>
                <li>Incorrect or incomplete addresses</li>
                <li>Recipient unavailability</li>
                <li>Security checks</li>
                <li>Government restrictions</li>
                <li>Unforeseen operational events</li>
              </ul>
            </div>

            <div id="sec-6" class="mb-5">
              <h2 class="policy-section-title"><span class="sec-num">6</span> Shipment Tracking</h2>
              <p>Where tracking is available, customers can use the shipment tracking number or AWB number to view
                shipment status.</p>
              <p class="mb-0">Tracking information may be updated at different stages of the shipping process. Status
                updates are provided for informational purposes and may not always reflect real-time movement.</p>
            </div>

            <div id="sec-7" class="mb-5">
              <h2 class="policy-section-title"><span class="sec-num">7</span> Delivery Attempts</h2>
              <p>If the recipient is unavailable or delivery cannot be completed, the delivery partner may make
                additional delivery attempts where operationally possible.</p>
              <p class="mb-0">The number of delivery attempts may vary based on the service, location, and
                delivery-partner policy.</p>
            </div>

            <div id="sec-8" class="mb-5">
              <h2 class="policy-section-title"><span class="sec-num">8</span> Failed Delivery and Return-to-Origin
              </h2>
              <p>A shipment may be returned to the sender when delivery cannot be completed due to:</p>
              <ul>
                <li>Incorrect or incomplete address</li>
                <li>Recipient refusal</li>
                <li>Recipient unavailability</li>
                <li>Unreachable recipient</li>
                <li>Serviceability restrictions</li>
                <li>Missing required information</li>
                <li>Non-compliant or restricted shipment contents</li>
              </ul>
              <p class="mb-0">Applicable return-to-origin charges may be charged to the sender.</p>
            </div>

            <div id="sec-9" class="mb-5">
              <h2 class="policy-section-title"><span class="sec-num">9</span> Shipping Charges</h2>
              <p>Shipping charges may be calculated based on:</p>
              <ul>
                <li>Origin and destination</li>
                <li>Actual weight</li>
                <li>Volumetric weight</li>
                <li>Package dimensions</li>
                <li>Service type</li>
                <li>Delivery speed</li>
                <li>Applicable taxes</li>
                <li>Additional handling or special-service requirements</li>
              </ul>
              <p class="mb-0">Any additional charges resulting from corrected weight, dimensions, address changes,
                special handling, or other verified shipment requirements may be applied.</p>
            </div>

            <div id="sec-10" class="mb-5">
              <h2 class="policy-section-title"><span class="sec-num">10</span> Packaging Requirements</h2>
              <p>Customers must ensure that shipments are:</p>
              <ul>
                <li>Securely packed</li>
                <li>Properly sealed</li>
                <li>Correctly labeled</li>
                <li>Suitable for transportation</li>
                <li>Protected against normal handling and transit conditions</li>
              </ul>
              <p>Fragile or sensitive items must be packed with appropriate protective material.</p>
              <p class="mb-0">CourierBazar may refuse a shipment that is improperly packed, unsafe, leaking, damaged, or
                otherwise unsuitable for transportation.</p>
            </div>

            <div id="sec-11" class="mb-5">
              <h2 class="policy-section-title"><span class="sec-num">11</span> Restricted and Prohibited Shipments
              </h2>
              <p>Customers must not send illegal, dangerous, hazardous, prohibited, or restricted items.</p>
              <p class="mb-0">CourierBazar may reject, hold, return, or report any shipment that does not comply with
                applicable laws or service requirements.</p>
            </div>

            <div id="sec-12" class="mb-5">
              <h2 class="policy-section-title"><span class="sec-num">12</span> Delivery Address Changes</h2>
              <p>Requests to change the delivery address may be accepted only when operationally possible.</p>
              <p>Address changes may result in:</p>
              <ul>
                <li>Delivery delays</li>
                <li>Additional shipping charges</li>
                <li>Changes to service availability</li>
                <li>Cancellation or return-to-origin in some cases</li>
              </ul>
            </div>

            <div id="sec-13" class="mb-5">
              <h2 class="policy-section-title"><span class="sec-num">13</span> Shipment Delays</h2>
              <p>CourierBazar will make reasonable efforts to deliver shipments within the estimated timeline. However,
                delays may occur due to circumstances beyond reasonable control.</p>
              <p class="mb-0">CourierBazar is not responsible for indirect or consequential losses arising from delivery
                delays, except where required by applicable law.</p>
            </div>

            <div id="sec-14">
              <h2 class="policy-section-title"><span class="sec-num">14</span> Contact Us</h2>
              <p>For shipment booking, pickup, tracking, delivery, or shipping-related assistance, contact:</p>

              <div class="policy-contact-box mt-3">
                <h3 class="mt-0 mb-3 fs-5">CourierBazar</h3>
                <div class="policy-contact-item">
                  <i class="bi bi-envelope-fill"></i>
                  <div>
                    <div class="small text-muted fw-bold">Email Support</div>
                    <a href="<?php echo $email_url; ?>"
                      class="text-decoration-none fw-semibold"><?php echo $email_address; ?></a>
                  </div>
                </div>
                <div class="policy-contact-item">
                  <i class="bi bi-telephone-fill"></i>
                  <div>
                    <div class="small text-muted fw-bold">Phone Number</div>
                    <a href="<?php echo $phone_url; ?>"
                      class="text-decoration-none fw-semibold"><?php echo $phone_number; ?></a>
                    <?php if (!empty($phone_number_alt)): ?>
                      / <a href="<?php echo $phone_url_alt; ?>"
                        class="text-decoration-none fw-semibold"><?php echo $phone_number_alt; ?></a>
                    <?php endif; ?>
                  </div>
                </div>
                <div class="policy-contact-item">
                  <i class="bi bi-geo-alt-fill"></i>
                  <div>
                    <div class="small text-muted fw-bold">Registered Address</div>
                    <span><?php echo $office_address; ?></span>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<?php
include 'upload/footer.php';
?>