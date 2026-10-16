<?php
$page_title = "Courier Bazar — Ship Smarter, Deliver Faster";
$page_desc = "Courier Bazar — India's smart shipping aggregator. Compare courier rates, book pickups, print labels, track shipments and manage COD across 25+ courier partners from one dashboard.";
$current_page = 'home';
$load_image_slot = true;
include 'upload/header.php';
?>

<main>
  <!-- ============================ HERO ============================ -->
  <section class="hero">
    <div class="container">
      <div class="row align-items-center g-5">
        <div class="col-lg-6">
          <span class="hero-badge">
            <span class="pill">New</span>
            <span>COD remittance now in 2 days</span>
            <i class="bi bi-chevron-right ms-1 opacity-75" style="font-size:0.75rem;"></i>
          </span>
          <h1 class="mb-3">Ship smarter.<br><span class="grad-text">Deliver faster.</span></h1>
          <p class="lead hero-sub mb-4" style="max-width:34rem;">Courier Bazar is the shipping platform for growing
            businesses — compare rates across 25+ couriers, book pickups, print labels and track every order from one
            clean dashboard.</p>

          <form id="trackForm"
            class="hero-track-form d-flex gap-2 flex-wrap flex-sm-nowrap align-items-center reveal in">
            <div class="track-input-group flex-fill">
              <i class="bi bi-search track-icon"></i>
              <input id="trackInput" type="text" class="form-control-ssa" placeholder="e.g. SSA4471208IN" required>
            </div>
            <button type="submit" class="btn-ssa-primary text-nowrap">
              <span>Track Shipment</span>
              <i class="bi bi-arrow-right"></i>
            </button>
          </form>

          <div class="track-hint-list">
            <span class="badge-trust"><i class="bi bi-shield-check text-mint me-1 fs-6"></i> Live Tracking</span>
            <span class="badge-trust"><i class="bi bi-lightning-charge-fill text-amber me-1 fs-6"></i> 25+ Courier
              Partners</span>
          </div>

          <div class="hero-stats">
            <div class="stat-item">
              <div class="num">25+</div>
              <div class="lbl">Courier partners</div>
            </div>
            <div class="stat-item">
              <div class="num">29K+</div>
              <div class="lbl">Pincodes covered</div>
            </div>
            <div class="stat-item">
              <div class="num">40%</div>
              <div class="lbl">Avg. shipping saved</div>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="hero-media-wrap">
            <div class="media-frame float-soft" style="box-shadow:var(--shadow-lg);">
              <img src="assets/images/img-1.png" style="position:absolute;inset:0;width:100%;height:100%" />

            </div>
            <div class="chip-float" style="left:-16px; bottom:38px;">
              <span class="cf-ic" style="background:linear-gradient(135deg,#6f8a5f,#4f7a53);"><i
                  class="bi bi-cash-coin"></i></span>
              <div>
                <div class="cf-n">₹40 cr+</div>
                <div class="cf-l">COD remitted / mo</div>
              </div>
            </div>
            <div class="chip-float" style="right:-12px; top:24px;">
              <span class="cf-ic" style="background:linear-gradient(135deg,#2a251c,#16130d);"><i
                  class="bi bi-graph-up-arrow"></i></span>
              <div>
                <div class="cf-n">98.6%</div>
                <div class="cf-l">Delivery success</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ======================= PARTNER STRIP ======================= -->
  <section class="partner-strip py-4">
    <div class="container">
      <p class="text-center text-muted-2 small text-uppercase mb-3" style="letter-spacing:.14em;">Integrated with
        India's leading courier partners</p>
      <div class="marquee">
        <div class="marquee-track">
          <span class="m-item"><i class="bi bi-truck"></i> Delhivery</span>
          <span class="m-item"><i class="bi bi-box-seam"></i> Blue Dart</span>
          <span class="m-item"><i class="bi bi-truck"></i> DTDC</span>
          <span class="m-item"><i class="bi bi-lightning-charge"></i> Ecom Express</span>
          <span class="m-item"><i class="bi bi-truck"></i> XpressBees</span>
          <span class="m-item"><i class="bi bi-envelope-paper"></i> India Post</span>
          <span class="m-item"><i class="bi bi-lightning-charge"></i> Shadowfax</span>
          <span class="m-item"><i class="bi bi-box-seam"></i> Ekart</span>
          <!-- duplicate for seamless loop -->
          <span class="m-item"><i class="bi bi-truck"></i> Delhivery</span>
          <span class="m-item"><i class="bi bi-box-seam"></i> Blue Dart</span>
          <span class="m-item"><i class="bi bi-truck"></i> DTDC</span>
          <span class="m-item"><i class="bi bi-lightning-charge"></i> Ecom Express</span>
          <span class="m-item"><i class="bi bi-truck"></i> XpressBees</span>
          <span class="m-item"><i class="bi bi-envelope-paper"></i> India Post</span>
          <span class="m-item"><i class="bi bi-lightning-charge"></i> Shadowfax</span>
          <span class="m-item"><i class="bi bi-box-seam"></i> Ekart</span>
        </div>
      </div>
    </div>
  </section>

  <!-- ========================= FEATURES (BENTO) ==================== -->
  <section class="section">
    <div class="container">
      <div class="section-head text-center mx-auto mb-5 reveal">
        <span class="eyebrow"><i class="bi bi-stars"></i> Why Courier Bazar</span>
        <div class="rule"></div>
        <h2>Everything you need to ship, in one place</h2>
        <p class="lead-muted">Stop juggling courier panels and spreadsheets. Run your entire shipping operation from a
          single, delightfully simple dashboard.</p>
      </div>
      <div class="bento reveal">
        <div class="b-cell b-wide">
          <div class="bento-card feat">
            <span class="blob"></span>
            <i class="bi bi-bar-chart-steps" style="font-size:2rem;"></i>
            <h3 class="mt-3">Smart rate comparison</h3>
            <p class="mb-0" style="max-width:30rem;">Instantly compare price, speed and delivery success across every
              courier — and let our engine auto-pick the best one for each order.</p>
          </div>
        </div>
        <div class="b-cell">
          <div class="bento-card">
            <span class="icon-tile b" style="width:48px;height:48px;font-size:1.3rem;"><i
                class="bi bi-printer"></i></span>
            <h3 class="h5">Bulk labels</h3>
            <p class="mb-0">Print hundreds of shipping labels and manifests in one click.</p>
          </div>
        </div>
        <div class="b-cell">
          <div class="bento-card">
            <span class="icon-tile m" style="width:48px;height:48px;font-size:1.3rem;"><i
                class="bi bi-geo-alt"></i></span>
            <h3 class="h5">Live tracking</h3>
            <p class="mb-0">Real-time status with branded tracking pages for your buyers.</p>
          </div>
        </div>
        <div class="b-cell">
          <div class="bento-card">
            <span class="icon-tile a" style="width:48px;height:48px;font-size:1.3rem;"><i
                class="bi bi-cash-stack"></i></span>
            <h3 class="h5">Faster COD</h3>
            <p class="mb-0">Cash-on-delivery remittance to your account in as fast as 2 days.</p>
          </div>
        </div>
        <div class="b-cell">
          <div class="bento-card dark">
            <span class="blob"></span>
            <span class="icon-tile" style="width:48px;height:48px;font-size:1.3rem;background:rgba(255,255,255,.14);"><i
                class="bi bi-shield-check"></i></span>
            <h3 class="h5">NDR &amp; returns</h3>
            <p class="mb-0" style="color:rgba(255,255,255,.75);">Reduce failed deliveries with automated NDR follow-ups
              and easy returns.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ===================== SOLUTIONS PREVIEW ====================== -->
  <section class="section bg-soft">
    <div class="container">
      <div class="section-head text-center mx-auto mb-5 reveal">
        <span class="eyebrow"><i class="bi bi-grid"></i> Solutions</span>
        <div class="rule"></div>
        <h2>Built for every kind of shipper</h2>
        <p class="lead-muted">From first order to enterprise scale — the tools grow with you.</p>
      </div>
      <div class="row g-4">
        <div class="col-md-6 col-lg-4 reveal">
          <div class="card-cb solution-card p-4">
            <span class="icon-tile v"><i class="bi bi-bar-chart-steps"></i></span>
            <h3>Rate Comparison</h3>
            <p>Compare live rates, TAT and serviceability across 25+ couriers before every booking.</p>
            <a href="services.php" class="link-more">Learn more <i class="bi bi-arrow-right"></i></a>
          </div>
        </div>
        <div class="col-md-6 col-lg-4 reveal">
          <div class="card-cb solution-card p-4">
            <span class="icon-tile b"><i class="bi bi-lightning-charge"></i></span>
            <h3>Bulk Shipping</h3>
            <p>Import orders, assign couriers and generate labels in bulk — thousands at a time.</p>
            <a href="services.php" class="link-more">Learn more <i class="bi bi-arrow-right"></i></a>
          </div>
        </div>
        <div class="col-md-6 col-lg-4 reveal">
          <div class="card-cb solution-card p-4">
            <span class="icon-tile m"><i class="bi bi-geo-alt"></i></span>
            <h3>Live Tracking</h3>
            <p>Automated tracking with branded pages, SMS and email updates for your customers.</p>
            <a href="services.php" class="link-more">Learn more <i class="bi bi-arrow-right"></i></a>
          </div>
        </div>
        <div class="col-md-6 col-lg-4 reveal">
          <div class="card-cb solution-card p-4">
            <span class="icon-tile a"><i class="bi bi-cash-coin"></i></span>
            <h3>COD Remittance</h3>
            <p>Get your cash-on-delivery collections settled quickly and transparently.</p>
            <a href="services.php" class="link-more">Learn more <i class="bi bi-arrow-right"></i></a>
          </div>
        </div>
        <div class="col-md-6 col-lg-4 reveal">
          <div class="card-cb solution-card p-4">
            <span class="icon-tile d"><i class="bi bi-arrow-repeat"></i></span>
            <h3>Returns &amp; NDR</h3>
            <p>Automate non-delivery follow-ups and offer frictionless returns to reduce RTO.</p>
            <a href="services.php" class="link-more">Learn more <i class="bi bi-arrow-right"></i></a>
          </div>
        </div>
        <div class="col-md-6 col-lg-4 reveal">
          <div class="card-cb solution-card p-4">
            <span class="icon-tile v"><i class="bi bi-plug"></i></span>
            <h3>API &amp; Integrations</h3>
            <p>Plug into Shopify, WooCommerce, Amazon and more, or build on our shipping API.</p>
            <a href="services.php" class="link-more">Learn more <i class="bi bi-arrow-right"></i></a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ======================== HOW IT WORKS ======================== -->
  <section class="section">
    <div class="container">
      <div class="section-head text-center mx-auto mb-5 reveal">
        <span class="eyebrow"><i class="bi bi-signpost-split"></i> How it works</span>
        <div class="rule"></div>
        <h2>From order to doorstep in four steps</h2>
      </div>
      <div class="row g-4">
        <div class="col-md-6 col-lg-3 reveal">
          <div class="card-cb step-card p-4 h-100">
            <div class="step-num">1</div>
            <h3>Connect &amp; import</h3>
            <p class="mb-0">Sync your store or upload orders in bulk — your catalog lands in one place.</p>
          </div>
        </div>
        <div class="col-md-6 col-lg-3 reveal">
          <div class="card-cb step-card p-4 h-100">
            <div class="step-num">2</div>
            <h3>Compare &amp; choose</h3>
            <p class="mb-0">See live rates and delivery times, then pick the best courier — or automate it.</p>
          </div>
        </div>
        <div class="col-md-6 col-lg-3 reveal">
          <div class="card-cb step-card p-4 h-100">
            <div class="step-num">3</div>
            <h3>Print &amp; pickup</h3>
            <p class="mb-0">Generate labels and manifests, then schedule a pickup — no courier calls needed.</p>
          </div>
        </div>
        <div class="col-md-6 col-lg-3 reveal">
          <div class="card-cb step-card p-4 h-100">
            <div class="step-num">4</div>
            <h3>Track &amp; get paid</h3>
            <p class="mb-0">Follow every shipment live and receive COD remittance straight to your bank.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ======================= WHY CHOOSE US ======================== -->
  <section class="section bg-soft">
    <div class="container">
      <div class="row align-items-center g-5">
        <div class="col-lg-6 reveal">
          <div class="media-comp">
            <img class="media-splash" src="assets/images/brand-splash.svg" alt="">
            <div class="media-stage">
              <div class="media-dots"></div>
              <div class="media-bracket"></div>
              <div class="media-frame">
                <img src="assets/images/img-2.png"
                  style="    object-fit: cover;position:absolute;inset:0;width:100%;height:100%" />
              </div>
              <div class="badge-float">
                <span class="bf-num grad-text">2 days</span>
                <span class="bf-lbl">COD<br>remittance</span>
              </div>
              <div class="card-float with-icon">
                <span class="cf-icon" style="background:linear-gradient(135deg,#6f8a5f,#4f7a53);"><i
                    class="bi bi-geo-alt"></i></span>
                <div>
                  <div class="cf-title" style="font-size:.95rem;">Out for delivery</div>
                  <div class="cf-sub">Arriving today, 6 PM</div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6 reveal">
          <span class="eyebrow"><i class="bi bi-patch-check"></i> Why choose us</span>
          <div class="rule"></div>
          <h2 class="mb-3">Lower costs, fewer RTOs, happier buyers</h2>
          <p class="lead-muted mb-4">Courier Bazar routes each shipment to the courier most likely to deliver it —
            cheaply and on time — so you save on freight and lose fewer orders to returns.</p>
          <div class="row g-3 mb-4">
            <div class="col-sm-6 d-flex gap-2"><i class="bi bi-check-circle-fill text-mint fs-5"></i><span>Save up to
                40% on freight</span></div>
            <div class="col-sm-6 d-flex gap-2"><i class="bi bi-check-circle-fill text-mint fs-5"></i><span>29,000+
                serviceable pincodes</span></div>
            <div class="col-sm-6 d-flex gap-2"><i class="bi bi-check-circle-fill text-mint fs-5"></i><span>AI courier
                recommendation</span></div>
            <div class="col-sm-6 d-flex gap-2"><i class="bi bi-check-circle-fill text-mint fs-5"></i><span>Dedicated
                support team</span></div>
          </div>
          <a href="register.php" class="btn btn-brand">Create free account <i class="bi bi-arrow-right ms-1"></i></a>
        </div>
      </div>
    </div>
  </section>

  <!-- ========================= STATS ============================= -->
  <section class="section">
    <div class="container">
      <div class="stats-band section-sm px-4 reveal">
        <div class="row g-4 text-center">
          <div class="col-6 col-lg-3">
            <div class="stat">
              <div class="num counter" data-target="12" data-suffix="M+">0</div>
              <div class="lbl">Shipments delivered</div>
            </div>
          </div>
          <div class="col-6 col-lg-3">
            <div class="stat">
              <div class="num counter" data-target="25" data-suffix="+">0</div>
              <div class="lbl">Courier partners</div>
            </div>
          </div>
          <div class="col-6 col-lg-3">
            <div class="stat">
              <div class="num counter" data-target="29000" data-suffix="+">0</div>
              <div class="lbl">Pincodes covered</div>
            </div>
          </div>
          <div class="col-6 col-lg-3">
            <div class="stat">
              <div class="num counter" data-target="18000" data-suffix="+">0</div>
              <div class="lbl">Businesses shipping</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ===================== INTEGRATIONS / NETWORK ================= -->
  <section class="section bg-soft">
    <div class="container">
      <div class="row align-items-center g-5">
        <div class="col-lg-6 reveal order-lg-2">
          <div class="media-comp">
            <img class="media-splash" src="assets/images/brand-splash.svg" alt="">
            <div class="media-stage">
              <div class="media-dots"></div>
              <div class="media-bracket"></div>
              <div class="media-frame">
                <img src="assets/images/img-3.png" style="position:absolute;inset:0;width:100%;height:100%" />
              </div>
              <div class="badge-float">
                <span class="bf-num grad-text">25+</span>
                <span class="bf-lbl">Couriers<br>in one API</span>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6 reveal order-lg-1">
          <span class="eyebrow"><i class="bi bi-plugin"></i> Integrations</span>
          <div class="rule"></div>
          <h2 class="mb-3">Connect your stack in minutes</h2>
          <p class="lead-muted mb-4">Sync orders automatically from the platforms you already sell on, and reach every
            courier through a single, reliable connection.</p>
          <div class="row g-3">
            <div class="col-6 col-md-4">
              <div class="integration-pill"><i class="bi bi-bag-check"></i> Shopify</div>
            </div>
            <div class="col-6 col-md-4">
              <div class="integration-pill"><i class="bi bi-wordpress"></i> WooCommerce</div>
            </div>
            <div class="col-6 col-md-4">
              <div class="integration-pill"><i class="bi bi-amazon"></i> Amazon</div>
            </div>
            <div class="col-6 col-md-4">
              <div class="integration-pill"><i class="bi bi-cart3"></i> Flipkart</div>
            </div>
            <div class="col-6 col-md-4">
              <div class="integration-pill"><i class="bi bi-shop"></i> Magento</div>
            </div>
            <div class="col-6 col-md-4">
              <div class="integration-pill"><i class="bi bi-code-slash"></i> REST API</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ======================= INDUSTRIES ========================== -->
  <section class="section">
    <div class="container">
      <div class="section-head text-center mx-auto mb-5 reveal">
        <span class="eyebrow"><i class="bi bi-buildings"></i> Who we serve</span>
        <div class="rule"></div>
        <h2>Industries shipping with Courier Bazar</h2>
      </div>
      <div class="row g-4 justify-content-center">
        <div class="col-6 col-md-4 col-lg-2 reveal">
          <div class="industry-card"><i class="bi bi-cart-check"></i>
            <h3>E-commerce</h3>
          </div>
        </div>
        <div class="col-6 col-md-4 col-lg-2 reveal">
          <div class="industry-card"><i class="bi bi-gem"></i>
            <h3>D2C Brands</h3>
          </div>
        </div>
        <div class="col-6 col-md-4 col-lg-2 reveal">
          <div class="industry-card"><i class="bi bi-shop"></i>
            <h3>Retail</h3>
          </div>
        </div>
        <div class="col-6 col-md-4 col-lg-2 reveal">
          <div class="industry-card"><i class="bi bi-diagram-3"></i>
            <h3>Marketplaces</h3>
          </div>
        </div>
        <div class="col-6 col-md-4 col-lg-2 reveal">
          <div class="industry-card"><i class="bi bi-capsule"></i>
            <h3>Pharma</h3>
          </div>
        </div>
        <div class="col-6 col-md-4 col-lg-2 reveal">
          <div class="industry-card"><i class="bi bi-tools"></i>
            <h3>Manufacturing</h3>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ====================== TESTIMONIALS ========================= -->
  <section class="section bg-soft">
    <div class="container">
      <div class="section-head text-center mx-auto mb-5 reveal">
        <span class="eyebrow"><i class="bi bi-chat-quote"></i> Loved by shippers</span>
        <div class="rule"></div>
        <h2>Trusted by growing businesses</h2>
      </div>
      <div class="row g-4">
        <div class="col-md-6 col-lg-4 reveal">
          <div class="card-cb testi-card">
            <div class="stars"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i></div>
            <blockquote>"We cut shipping costs by a third in the first month and our RTO dropped noticeably. The rate
              comparison alone pays for itself."</blockquote>
            <div class="d-flex align-items-center gap-3">
              <span class="testi-avatar">RA</span>
              <div>
                <div class="name">Rhea Advani</div>
                <div class="meta">Founder, Bloom Cosmetics</div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-4 reveal">
          <div class="card-cb testi-card">
            <div class="stars"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i></div>
            <blockquote>"Managing 8 couriers used to mean 8 logins. Now it's one dashboard, bulk labels, and COD in our
              account in two days."</blockquote>
            <div class="d-flex align-items-center gap-3">
              <span class="testi-avatar">MK</span>
              <div>
                <div class="name">Manish Kapoor</div>
                <div class="meta">Ops Lead, Zenith Traders</div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-4 reveal">
          <div class="card-cb testi-card">
            <div class="stars"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i></div>
            <blockquote>"The branded tracking page made our customers stop emailing 'where is my order'. Support has
              been genuinely excellent too."</blockquote>
            <div class="d-flex align-items-center gap-3">
              <span class="testi-avatar">SP</span>
              <div>
                <div class="name">Sana Pathak</div>
                <div class="meta">Marketing, Vantage Living</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ========================== FAQ ============================== -->
  <section class="section">
    <div class="container">
      <div class="row g-5">
        <div class="col-lg-5 reveal">
          <span class="eyebrow"><i class="bi bi-question-circle"></i> FAQ</span>
          <div class="rule"></div>
          <h2 class="mb-3">Questions, answered</h2>
          <p class="lead-muted">Everything about pricing, couriers, COD and integrations. Still unsure? Talk to our
            team.</p>
          <a href="contact.php" class="btn btn-outline-brand mt-2">Contact us</a>
        </div>
        <div class="col-lg-7 reveal">
          <div class="accordion accordion-cb" id="faqHome">
            <div class="accordion-item">
              <h3 class="accordion-header" id="fh1"><button class="accordion-button collapsed" type="button"
                  data-bs-toggle="collapse" data-bs-target="#fhc1">Is there a setup fee or monthly commitment?</button>
              </h3>
              <div id="fhc1" class="accordion-collapse collapse" data-bs-parent="#faqHome">
                <div class="accordion-body">No. You can start for free and pay per shipment. Higher-volume plans unlock
                  better rates and dedicated support, with no lock-in.</div>
              </div>
            </div>
            <div class="accordion-item">
              <h3 class="accordion-header" id="fh2"><button class="accordion-button collapsed" type="button"
                  data-bs-toggle="collapse" data-bs-target="#fhc2">Which couriers can I ship with?</button></h3>
              <div id="fhc2" class="accordion-collapse collapse" data-bs-parent="#faqHome">
                <div class="accordion-body">Courier Bazar integrates 25+ partners including Delhivery, Blue Dart, DTDC,
                  Ecom Express, XpressBees, Shadowfax and India Post — all through one account.</div>
              </div>
            </div>
            <div class="accordion-item">
              <h3 class="accordion-header" id="fh3"><button class="accordion-button collapsed" type="button"
                  data-bs-toggle="collapse" data-bs-target="#fhc3">How fast is COD remittance?</button></h3>
              <div id="fhc3" class="accordion-collapse collapse" data-bs-parent="#faqHome">
                <div class="accordion-body">Cash-on-delivery collections are remitted to your bank account in as fast as
                  2 days, with a transparent statement for every order.</div>
              </div>
            </div>
            <div class="accordion-item">
              <h3 class="accordion-header" id="fh4"><button class="accordion-button collapsed" type="button"
                  data-bs-toggle="collapse" data-bs-target="#fhc4">Can I connect my online store?</button></h3>
              <div id="fhc4" class="accordion-collapse collapse" data-bs-parent="#faqHome">
                <div class="accordion-body">Yes — connect Shopify, WooCommerce, Magento, Amazon and Flipkart to
                  auto-import orders, or use our REST API and webhooks for custom setups.</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ========================== CTA ============================== -->
  <section class="section pt-0">
    <div class="container">
      <div class="cta-banner reveal">
        <div class="row align-items-center g-4">
          <div class="col-lg-8">
            <h2 class="mb-2">Start shipping smarter today</h2>
            <p class="mb-0 lead">Create a free account in minutes — no card, no setup fee. Your first label is on us.
            </p>
          </div>
          <div class="col-lg-4 text-lg-end">
            <a href="register.php" class="btn btn-light-brand btn-lg"><i class="bi bi-rocket-takeoff me-2"></i>Get
              started free</a>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>

<?php
include 'upload/footer.php';
?>