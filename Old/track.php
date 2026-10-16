<?php
$page_title = "Track Shipment — Courier Bazar";
$page_desc = "Track your shipment in real-time across 25+ courier partners including Delhivery, Blue Dart, XpressBees, Shadowfax, DTDC and more with Courier Bazar.";
$current_page = 'track';
include 'upload/header.php';
?>

<main>
  <!-- ============================ HERO TRACKING SEARCH ============================ -->
  <section class="hero py-5" style="background: linear-gradient(180deg, var(--surface-alt) 0%, var(--surface) 100%);">
    <div class="container py-4">
      <div class="row justify-content-center text-center">
        <div class="col-lg-8">
          <span class="hero-badge mb-3 d-inline-flex">
            <span class="pill">Live</span>
            <span>25+ Logistics Partners Integrated</span>
          </span>
          <h1 class="h2 mb-3">Track Your <span class="grad-text">Shipment</span></h1>
          <p class="lead hero-sub mb-4 mx-auto" style="max-width:36rem;">
            Enter your AWB / Waybill or Order Tracking Number below to view live transit updates, courier details, and estimated delivery dates.
          </p>

          <form id="pageTrackForm" class="hero-track-form d-flex gap-2 flex-wrap flex-sm-nowrap align-items-center mx-auto mb-3" style="max-width: 40rem;">
            <div class="track-input-group flex-fill">
              <i class="bi bi-search track-icon"></i>
              <input id="pageTrackInput" type="text" class="form-control-ssa" placeholder="Enter AWB e.g. SSA4471208IN" value="<?php echo isset($_GET['awb']) ? htmlspecialchars($_GET['awb']) : ''; ?>" required>
            </div>
            <button type="submit" class="btn-ssa-primary text-nowrap">
              <span>Track Order</span>
              <i class="bi bi-arrow-right"></i>
            </button>
          </form>

          <div class="d-flex flex-wrap align-items-center justify-content-center gap-2 text-muted small">
            <span class="fw-bold">Try Sample AWBs:</span>
            <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill py-0 px-2 font-monospace demo-awb-btn" data-awb="SSA4471208IN">SSA4471208IN</button>
            <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill py-0 px-2 font-monospace demo-awb-btn" data-awb="DEL98765432">DEL98765432</button>
            <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill py-0 px-2 font-monospace demo-awb-btn" data-awb="BD4729104IN">BD4729104IN</button>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ============================ TRACKING RESULTS SECTION ============================ -->
  <section class="section py-5">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-10">
          <div id="pageTrackResult">
            <!-- Dynamic tracking results rendered by tracking.js -->
            <div class="text-center py-5">
              <div class="spinner-border text-brand mb-3" role="status"></div>
              <p class="text-muted">Fetching live tracking information...</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ============================ HELP & FAQ ============================ -->
  <section class="section bg-surface-alt py-5 border-top border-bottom">
    <div class="container">
      <div class="row g-4 align-items-center">
        <div class="col-lg-6">
          <h3 class="h4 mb-3">Need assistance with your package?</h3>
          <p class="text-muted mb-4">
            If your shipment status hasn't updated in 24 hours or if you have delivery inquiries, our logistics support team is ready to assist you.
          </p>
          <div class="d-flex flex-wrap gap-3">
            <a href="<?php echo $contact_url; ?>" class="btn btn-brand">
              <i class="bi bi-headset me-2"></i>Contact Support
            </a>
            <a href="https://wa.me/919311294942" target="_blank" class="btn btn-outline-dark">
              <i class="bi bi-whatsapp me-2 text-success"></i>WhatsApp Support
            </a>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="policy-card bg-white shadow-sm border p-4 rounded-4">
            <h4 class="h6 fw-bold mb-3"><i class="bi bi-question-circle text-brand me-2"></i>Frequently Asked Questions</h4>
            <div class="mb-3">
              <strong class="d-block text-ink small">Where do I find my AWB / Tracking number?</strong>
              <span class="text-muted small">Your AWB number is sent via SMS and Email once your order is processed by the seller or merchant.</span>
            </div>
            <div>
              <strong class="d-block text-ink small">How frequently is tracking updated?</strong>
              <span class="text-muted small">Tracking status is updated in real-time as courier scans take place at sorting hubs and during transit.</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>

<script>
document.addEventListener("DOMContentLoaded", function() {
  var sampleBtns = document.querySelectorAll(".demo-awb-btn");
  sampleBtns.forEach(function(btn) {
    btn.addEventListener("click", function() {
      var awb = btn.getAttribute("data-awb");
      var input = document.getElementById("pageTrackInput");
      var form = document.getElementById("pageTrackForm");
      if (input && awb) {
        input.value = awb;
        if (form) {
          form.dispatchEvent(new Event("submit", { cancelable: true, bubbles: true }));
        }
      }
    });
  });
});
</script>

<?php
include 'upload/footer.php';
?>
