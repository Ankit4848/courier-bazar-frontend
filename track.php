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
              <input id="pageTrackInput" type="text" class="form-control-ssa" placeholder="Enter AWB or Order ID" value="<?php echo isset($_GET['awb']) ? htmlspecialchars($_GET['awb']) : ''; ?>" required>
            </div>
            <button type="submit" class="btn-ssa-primary text-nowrap">
              <span>Track Order</span>
              <i class="bi bi-arrow-right"></i>
            </button>
          </form>

          <div class="d-flex flex-wrap align-items-center justify-content-center gap-3 text-muted small">
            <span><i class="bi bi-shield-check text-mint me-1"></i> Live Real-Time Updates</span>
            <span><i class="bi bi-lightning-charge-fill text-amber me-1"></i> 25+ Courier Integrations</span>
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
            <div class="bg-white p-4 p-md-5 rounded-4 border shadow-sm text-center">
              <div class="mb-3">
                <div class="d-inline-flex align-items-center justify-content-center bg-brand-subtle rounded-circle" style="width:68px;height:68px;">
                  <i class="bi bi-geo-alt-fill text-brand fs-2"></i>
                </div>
              </div>
              <h3 class="h5 fw-bold text-ink mb-2">Real-Time Multi-Carrier Tracking</h3>
              <p class="text-muted mx-auto mb-0" style="max-width:32rem;">
                Enter your AWB number, Order ID, or LR number above to check real-time GPS scans, transit checkpoints, and expected delivery date across 25+ courier partners.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

<?php
include 'upload/footer.php';
?>
