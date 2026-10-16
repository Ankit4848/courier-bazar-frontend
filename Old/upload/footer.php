<!-- ============================ FOOTER ============================ -->
<footer class="footer">
  <div class="container">
    <div class="row g-4">
      <div class="col-lg-3 col-md-6">
        <a class="brand mb-3 d-inline-flex" href="<?php echo $home_url; ?>">
          <img src="assets/images/logo.png" alt="Courier Bazar" class="brand-logo">
        </a>
        <p style="max-width:22rem;">The smart shipping platform for growing businesses — compare couriers, book, track
          and get paid, all in one place.</p>
        <div class="socials mt-3">
          <?php if ($facebook_url !== '#'): ?>
            <a href="<?php echo $facebook_url; ?>" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
          <?php endif; ?>
          <?php if ($instagram_url !== '#'): ?>
            <a href="<?php echo $instagram_url; ?>" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
          <?php endif; ?>
          <?php if ($linkedin_url !== '#'): ?>
            <a href="<?php echo $linkedin_url; ?>" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a>
          <?php endif; ?>
          <?php if ($whatsapp_url !== '#'): ?>
            <a href="<?php echo $whatsapp_url; ?>" aria-label="WhatsApp"><i class="bi bi-whatsapp"></i></a>
          <?php endif; ?>
        </div>
      </div>
      <div class="col-lg-3 col-6">
        <h4>Company</h4>
        <ul class="foot-links">
          <li><a href="<?php echo $home_url; ?>"><i class="bi bi-chevron-right"></i> Home</a></li>
          <li><a href="<?php echo $about_url; ?>"><i class="bi bi-chevron-right"></i> About Us</a></li>
          <li><a href="<?php echo $services_url; ?>"><i class="bi bi-chevron-right"></i> Services</a></li>
          <li><a href="<?php echo $contact_url; ?>"><i class="bi bi-chevron-right"></i> Contact</a></li>
          <li><a href="<?php echo $login_url; ?>"><i class="bi bi-chevron-right"></i> Login</a></li>
        </ul>
      </div>
      <div class="col-lg-3 col-6">
        <h4>Legal</h4>
        <ul class="foot-links">
          <li><a href="<?php echo $terms_url; ?>"><i class="bi bi-chevron-right"></i> Terms &amp; Conditions</a></li>
          <li><a href="<?php echo $privacy_url; ?>"><i class="bi bi-chevron-right"></i> Privacy Policy</a></li>
          <li><a href="<?php echo $shipping_url; ?>"><i class="bi bi-chevron-right"></i> Shipping Policy</a></li>
          <li><a href="<?php echo $refund_url; ?>"><i class="bi bi-chevron-right"></i> Return Policy</a></li>
        </ul>
      </div>

      <div class="col-lg-3 col-md-6">
        <h4>Get in Touch</h4>
        <ul class="foot-links foot-contact">
          <li><i class="bi bi-geo-alt-fill"></i><span><?php echo $office_address; ?></span></li>
          <li><i class="bi bi-telephone-fill"></i><span>
              <a href="<?php echo $phone_url; ?>"><?php echo $phone_number; ?></a> /
              <a href="<?php echo $phone_url_alt; ?>"><?php echo $phone_number_alt; ?></a>
              <?php if (!empty($phone_number_alt2)): ?>
                / <a href="<?php echo $phone_url_alt2; ?>"><?php echo $phone_number_alt2; ?></a>
              <?php endif; ?>
            </span></li>
          <li><i class="bi bi-envelope-fill"></i><span><a
                href="<?php echo $email_url; ?>"><?php echo $email_address; ?></a></span></li>
        </ul>
      </div>
    </div>
  </div>
  <div class="footer-bottom">
    <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
      <span>&copy; <span class="js-year">2026</span> Courier Bazar. All rights reserved.</span>
      <span class="text-uppercase small" style="letter-spacing:.1em;">Ship Smarter, Deliver Faster</span>
    </div>
  </div>
</footer>

<button class="to-top" aria-label="Back to top"><i class="bi bi-arrow-up"></i></button>

<!-- Global Front-Side Tracking Modal -->
<div class="modal fade tracking-modal" id="trackingModal" tabindex="-1" aria-labelledby="trackingModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <div>
          <div class="track-modal-title" id="trackingModalLabel">
            <i class="bi bi-crosshair text-mint me-1"></i> Live Shipment Tracking
          </div>
          <p class="text-white-50 small mb-0">Real-time status updates powered by Courier Bazar</p>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-4" id="trackingModalContent">
        <!-- Dynamically populated by tracking.js -->
      </div>
      <div class="modal-footer bg-light border-top d-flex justify-content-between">
        <span class="text-muted small"><i class="bi bi-shield-check text-mint me-1"></i> 25+ Logistics Partners Synchronized</span>
        <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-4" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<?php if (isset($load_image_slot) && $load_image_slot): ?>
  <script src="assets/js/image-slot.js"></script>
<?php endif; ?>
<script src="assets/js/script.js"></script>
<script src="assets/js/tracking.js"></script>
</body>

</html>