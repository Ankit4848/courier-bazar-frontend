<?php
$page_title = "Return & Refund Policy — Courier Bazar";
$page_desc = "Return and Refund Policy for CourierBazar / Courier Bazar detailing shipment cancellation, return-to-origin (RTO), undelivered parcels, and shipping service refunds.";
$current_page = 'refund-policy';
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
          <li class="breadcrumb-item active" aria-current="page">Return &amp; Refund Policy</li>
        </ol>
      </nav>
      <h1 class="mt-2">Return &amp; <span class="grad-text">Refund Policy</span></h1>
      <p class="lead mb-0" style="max-width:44rem;">
        CourierBazar is a shipping and logistics service provider. We do not sell products directly and therefore do not
        offer product returns or exchanges. This policy explains the process for shipment cancellation,
        return-to-origin, undelivered shipments, and service-related claims.
      </p>
    </div>
  </section>
  <section class="section">
    <div class="container">
      <div class="row">
        <!-- MAIN BODY CONTENT -->
        <div class="col-12">
          <div class="policy-card">

            <div id="sec-1" class="mb-5">
              <h2 class="policy-section-title"><span class="sec-num">1</span> Shipment Cancellation</h2>
              <p>A shipment cancellation request may be submitted before the shipment is picked up or handed over to
                the relevant delivery partner.</p>
              <p>Once a shipment has been picked up, dispatched, or entered the transportation network, cancellation
                may not be possible.</p>
              <p class="mb-0">If cancellation is approved before pickup, any applicable refund will be processed
                according to the payment method and applicable service charges.</p>
            </div>

            <div id="sec-2" class="mb-5">
              <h2 class="policy-section-title"><span class="sec-num">2</span> Return-to-Origin (RTO)</h2>
              <p>A shipment may be returned to the sender when:</p>
              <ul>
                <li>The recipient refuses delivery</li>
                <li>The delivery address is incorrect or incomplete</li>
                <li>The recipient is unavailable after permitted delivery attempts</li>
                <li>The recipient cannot be contacted</li>
                <li>Delivery is not possible due to serviceability restrictions</li>
                <li>The shipment violates applicable policies or legal requirements</li>
                <li>The shipment cannot be delivered for any other operational reason</li>
              </ul>
              <p class="mb-0">Return-to-Origin charges may apply. Any applicable RTO charges will be communicated or
                charged according to the selected service, shipment details, and applicable rate card.</p>
            </div>

            <div id="sec-3" class="mb-5">
              <h2 class="policy-section-title"><span class="sec-num">3</span> Undelivered Shipments</h2>
              <p>If a shipment cannot be delivered, CourierBazar or its delivery partner may attempt to contact the
                sender or recipient for additional information.</p>
              <p class="mb-0">The sender is responsible for providing accurate and complete pickup, delivery, and
                contact information. Delays or additional charges may apply when incorrect or incomplete information
                is provided.</p>
            </div>

            <div id="sec-4" class="mb-5">
              <h2 class="policy-section-title"><span class="sec-num">4</span> Product Returns</h2>
              <p>CourierBazar only provides shipping and logistics services. The return or replacement of a product is
                the responsibility of the seller, merchant, or sender.</p>
              <p>Customers who wish to return a purchased product should contact the seller or merchant directly and
                follow that seller’s return policy.</p>
              <p class="mb-0">CourierBazar may provide reverse-logistics services when requested and where
                serviceable. Reverse-shipment charges may apply.</p>
            </div>

            <div id="sec-5" class="mb-5">
              <h2 class="policy-section-title"><span class="sec-num">5</span> Refunds for Shipping Services</h2>
              <p>Refund eligibility depends on the circumstances of the shipment and the applicable service terms.</p>
              <p>A refund may be considered when:</p>
              <ul>
                <li>A paid shipment is cancelled before pickup, subject to applicable deductions</li>
                <li>A service charge was collected incorrectly</li>
                <li>A verified service issue qualifies for a refund under the applicable service agreement</li>
              </ul>
              <p>Refunds will not normally be provided for:</p>
              <ul>
                <li>Delays caused by weather, natural events, public emergencies, government restrictions, or other
                  circumstances beyond reasonable control</li>
                <li>Incorrect or incomplete shipment information provided by the sender</li>
                <li>Delivery delays caused by recipient unavailability</li>
                <li>Shipments rejected due to prohibited or restricted contents</li>
                <li>Charges that are valid under the applicable rate card or service agreement</li>
              </ul>
            </div>

            <div id="sec-6" class="mb-5">
              <h2 class="policy-section-title"><span class="sec-num">6</span> Damaged or Lost Shipments</h2>
              <p>Any concern regarding a damaged, missing, or lost shipment should be reported as soon as possible
                after delivery or after the shipment status indicates a potential issue.</p>
              <p>The sender may be required to provide:</p>
              <ul>
                <li>Tracking or shipment number</li>
                <li>Proof of shipment value</li>
                <li>Invoice or purchase proof</li>
                <li>Photos of the package and damaged contents</li>
                <li>Packaging details</li>
                <li>Any other information required for investigation</li>
              </ul>
              <p class="mb-0">Claims will be reviewed according to the applicable service terms, declared value,
                shipment documentation, and relevant laws.</p>
            </div>

            <div id="sec-7">
              <h2 class="policy-section-title"><span class="sec-num">7</span> Contact Us</h2>
              <p>For cancellation, return-to-origin, reverse-logistics, refund, or claim-related assistance, contact:
              </p>

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
                  <i class="bi bi-info-circle-fill"></i>
                  <div>
                    <div class="small text-muted fw-bold">Important Note</div>
                    <span class="small">Please include your shipment or tracking number when contacting support.</span>
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