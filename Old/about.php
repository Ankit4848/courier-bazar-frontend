<?php
$page_title = "About Us — Courier Bazar";
$page_desc = "About Courier Bazar — our mission to make shipping simple and affordable for every business through one smart courier aggregation platform.";
$current_page = 'about';
$load_image_slot = true;
include 'upload/header.php';
?>

<main>
  <!-- PAGE HERO -->
  <section class="page-hero">
    <div class="container">
      <nav class="breadcrumb-cb" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo $home_url; ?>">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">About Us</li>
        </ol>
      </nav>
      <h1 class="mt-2">We're making shipping <span class="grad-text">effortless</span></h1>
      <p class="lead mb-0" style="max-width:44rem;">Courier Bazar started with one frustration: sending a parcel
        shouldn't mean juggling a dozen courier panels. So we built a single platform that does it all.</p>
    </div>
  </section>

  <!-- STORY -->
  <section class="section">
    <div class="container">
      <div class="row align-items-center g-5">
        <div class="col-lg-6 reveal">
          <div class="media-comp">
            <img class="media-splash" src="assets/images/brand-splash.svg" alt="">
            <div class="media-stage">
              <div class="media-dots"></div>
              <div class="media-bracket"></div>
              <div class="media-frame">
                <img src="assets/images/img-4.png" style="position:absolute;inset:0;width:100%;height:100%" />
              </div>
              <div class="badge-float">
                <span class="bf-num grad-text">2019</span>
                <span class="bf-lbl">Shipping<br>since</span>
              </div>
              <div class="card-float">
                <div class="cf-title">Ship Smarter, Deliver Faster</div>
                <div class="rule"></div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6 reveal">
          <span class="eyebrow"><i class="bi bi-book"></i> Our story</span>
          <div class="rule"></div>
          <h2 class="mb-3">One dashboard for every courier</h2>
          <p class="lead-muted">We began as a small team helping local sellers ship affordably. Sellers were losing
            money to high freight rates and losing orders to failed deliveries — simply because comparing couriers was
            too hard.</p>
          <p>Today, Courier Bazar connects thousands of businesses to 25+ courier partners through one clean platform
            — with smart rate comparison, automated tracking, faster COD and reliable support at every step.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- MISSION / VISION -->
  <section class="section bg-soft">
    <div class="container">
      <div class="row g-4">
        <div class="col-lg-6 reveal">
          <div class="card-cb p-4 p-lg-5 h-100">
            <span class="icon-tile v"><i class="bi bi-bullseye"></i></span>
            <h2 class="h3 mb-2">Our Mission</h2>
            <p class="mb-0 lead-muted">To make fast, affordable, reliable shipping accessible to every business — from a
              first-time seller to an enterprise brand — through one simple platform.</p>
          </div>
        </div>
        <div class="col-lg-6 reveal">
          <div class="card-cb p-4 p-lg-5 h-100">
            <span class="icon-tile b"><i class="bi bi-eye"></i></span>
            <h2 class="h3 mb-2">Our Vision</h2>
            <p class="mb-0 lead-muted">To become the shipping backbone of digital commerce — where any parcel finds its
              fastest, cheapest, most dependable route automatically.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- CORE VALUES -->
  <section class="section">
    <div class="container">
      <div class="section-head text-center mx-auto mb-5 reveal">
        <span class="eyebrow"><i class="bi bi-heart"></i> What guides us</span>
        <div class="rule"></div>
        <h2>Our Core Values</h2>
      </div>
      <div class="row g-4">
        <div class="col-md-6 col-lg-3 reveal">
          <div class="card-cb value-card h-100">
            <div class="num mb-2">01</div>
            <h3 class="h5">Customer obsession</h3>
            <p class="mb-0">Every feature starts with a seller's real problem, not a roadmap slide.</p>
          </div>
        </div>
        <div class="col-md-6 col-lg-3 reveal">
          <div class="card-cb value-card h-100">
            <div class="num mb-2">02</div>
            <h3 class="h5">Radical transparency</h3>
            <p class="mb-0">Clear rates, clear COD statements, no hidden charges — ever.</p>
          </div>
        </div>
        <div class="col-md-6 col-lg-3 reveal">
          <div class="card-cb value-card h-100">
            <div class="num mb-2">03</div>
            <h3 class="h5">Reliability</h3>
            <p class="mb-0">Shipping is mission-critical. Our platform is built to stay up and deliver.</p>
          </div>
        </div>
        <div class="col-md-6 col-lg-3 reveal">
          <div class="card-cb value-card h-100">
            <div class="num mb-2">04</div>
            <h3 class="h5">Keep it simple</h3>
            <p class="mb-0">Powerful tools that anyone can use on day one, without a manual.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- STATS -->
  <section class="section pt-0">
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

  <!-- TEAM -->
  <section class="section">
    <div class="container">
      <div class="section-head text-center mx-auto mb-5 reveal">
        <span class="eyebrow"><i class="bi bi-people"></i> Our team</span>
        <div class="rule"></div>
        <h2>The people behind Courier Bazar</h2>
      </div>
      <div class="row g-4">
        <div class="col-6 col-lg-3 reveal">
          <div class="card-cb team-card h-100">
            <div class="team-photo">AB</div>
            <div class="body">
              <h3>Arjun Bhatt</h3>
              <div class="role">Founder &amp; CEO</div>
              <div class="team-socials mt-2"><a href="#" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a><a
                  href="#" aria-label="Email"><i class="bi bi-envelope"></i></a></div>
            </div>
          </div>
        </div>
        <div class="col-6 col-lg-3 reveal">
          <div class="card-cb team-card h-100">
            <div class="team-photo">NS</div>
            <div class="body">
              <h3>Neha Shah</h3>
              <div class="role">Head of Operations</div>
              <div class="team-socials mt-2"><a href="#" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a><a
                  href="#" aria-label="Email"><i class="bi bi-envelope"></i></a></div>
            </div>
          </div>
        </div>
        <div class="col-6 col-lg-3 reveal">
          <div class="card-cb team-card h-100">
            <div class="team-photo">RV</div>
            <div class="body">
              <h3>Rohan Verma</h3>
              <div class="role">Head of Product</div>
              <div class="team-socials mt-2"><a href="#" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a><a
                  href="#" aria-label="Email"><i class="bi bi-envelope"></i></a></div>
            </div>
          </div>
        </div>
        <div class="col-6 col-lg-3 reveal">
          <div class="card-cb team-card h-100">
            <div class="team-photo">PI</div>
            <div class="body">
              <h3>Priya Iyer</h3>
              <div class="role">Customer Success</div>
              <div class="team-socials mt-2"><a href="#" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a><a
                  href="#" aria-label="Email"><i class="bi bi-envelope"></i></a></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- TIMELINE -->
  <section class="section bg-soft">
    <div class="container">
      <div class="row g-5">
        <div class="col-lg-4 reveal">
          <span class="eyebrow"><i class="bi bi-clock-history"></i> Our journey</span>
          <div class="rule"></div>
          <h2 class="mb-3">Milestones so far</h2>
          <p class="lead-muted mb-0">From a scrappy idea to a shipping platform trusted by thousands.</p>
        </div>
        <div class="col-lg-8 reveal">
          <div class="timeline">
            <div class="timeline-item">
              <div class="year">2019</div>
              <h3>Courier Bazar is born</h3>
              <p class="mb-0">We launch with a handful of courier integrations to help local sellers ship affordably.
              </p>
            </div>
            <div class="timeline-item">
              <div class="year">2021</div>
              <h3>Rate engine &amp; API</h3>
              <p class="mb-0">Smart rate comparison and a developer API open the door to fast-scaling D2C brands.</p>
            </div>
            <div class="timeline-item">
              <div class="year">2023</div>
              <h3>25+ couriers, faster COD</h3>
              <p class="mb-0">Our network crosses 25 partners and 29,000 pincodes, with 2-day COD remittance.</p>
            </div>
            <div class="timeline-item">
              <div class="year">2025</div>
              <h3>12M+ shipments delivered</h3>
              <p class="mb-0">Thousands of businesses now run their entire logistics on Courier Bazar.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA -->
  <section class="section pt-0">
    <div class="container">
      <div class="cta-banner reveal">
        <div class="row align-items-center g-4">
          <div class="col-lg-8">
            <h2 class="mb-2">Join thousands of smarter shippers</h2>
            <p class="mb-0 lead">Create your free account and send your first shipment today.</p>
          </div>
          <div class="col-lg-4 text-lg-end"><a href="<?php echo $register_url; ?>" class="btn btn-light-brand btn-lg"><i
                class="bi bi-rocket-takeoff me-2"></i>Get started free</a></div>
        </div>
      </div>
    </div>
  </section>
</main>

<?php
include 'upload/footer.php';
?>