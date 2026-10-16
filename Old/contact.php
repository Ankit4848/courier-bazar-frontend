<?php
$page_title = "Contact Us — Courier Bazar";
$page_desc = "Contact Courier Bazar — talk to our shipping experts, request a demo, call us or email hello@courierbazar.in. Office in Baratooti, North Delhi.";
$current_page = 'contact';
$load_image_slot = false;
include 'upload/header.php';
?>

  <main>
    <!-- PAGE HERO -->
    <section class="page-hero">
      <div class="container">
        <nav class="breadcrumb-cb" aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo $home_url; ?>">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
          </ol>
        </nav>
        <h1 class="mt-2">Let's talk <span class="grad-text">shipping</span></h1>
        <p class="lead mb-0" style="max-width:44rem;">Questions about rates, integrations or a demo? Our team replies fast — or call us directly.</p>
      </div>
    </section>

    <!-- INFO CARDS -->
    <section class="section pb-0">
      <div class="container">
        <div class="row g-4">
          <div class="col-md-6 col-lg-3 reveal"><div class="card-cb contact-info-card h-100"><span class="ci-icon" style="background:linear-gradient(135deg,#2a251c,#16130d);"><i class="bi bi-telephone-fill"></i></span><div><h3>Call Us</h3><p><a href="tel:+919311294942">+91 93112 94942</a><br><a href="tel:+919015196248">+91 90151 96248</a></p></div></div></div>
          <div class="col-md-6 col-lg-3 reveal"><div class="card-cb contact-info-card h-100"><span class="ci-icon" style="background:linear-gradient(135deg,#7a6a50,#6b5c45);"><i class="bi bi-envelope-fill"></i></span><div><h3>Email Us</h3><p><a href="mailto:hello@courierbazar.in">hello@courierbazar.in</a></p></div></div></div>
          <div class="col-md-6 col-lg-3 reveal"><div class="card-cb contact-info-card h-100"><span class="ci-icon" style="background:linear-gradient(135deg,#6f8a5f,#4f7a53);"><i class="bi bi-geo-alt-fill"></i></span><div><h3>Visit Us</h3><p>4891/92, Phoota Road, Baratooti, North Delhi, Delhi - 110006</p></div></div></div>
          <div class="col-md-6 col-lg-3 reveal"><div class="card-cb contact-info-card h-100"><span class="ci-icon" style="background:linear-gradient(135deg,#2a251c,#16130d);"><i class="bi bi-clock-fill"></i></span><div><h3>Business Hours</h3><p>Mon–Sat: 9:30 am – 7:30 pm<br>Sunday: Closed</p></div></div></div>
        </div>
      </div>
    </section>

    <!-- FORM + MAP -->
    <section class="section">
      <div class="container">
        <div class="row g-4 g-lg-5">
          <div class="col-lg-7 reveal">
            <div class="card-cb p-4 p-lg-5">
              <span class="eyebrow"><i class="bi bi-chat-dots"></i> Get in touch</span>
              <div class="rule"></div>
              <h2 class="h3 mb-4">Send us a message</h2>

              <div id="contactSuccess" class="alert alert-success d-none" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>Thanks for reaching out! Our team will get back to you shortly.
              </div>

              <form class="needs-validation" novalidate data-success="contactSuccess">
                <div class="row g-3">
                  <div class="col-md-6">
                    <label for="cName" class="form-label">Full Name</label>
                    <input type="text" class="form-control" id="cName" placeholder="Your name" required>
                    <div class="invalid-feedback">Please enter your name.</div>
                  </div>
                  <div class="col-md-6">
                    <label for="cEmail" class="form-label">Email Address</label>
                    <input type="email" class="form-control" id="cEmail" placeholder="you@company.com" required>
                    <div class="invalid-feedback">Please enter a valid email address.</div>
                  </div>
                  <div class="col-md-6">
                    <label for="cPhone" class="form-label">Phone Number</label>
                    <input type="tel" class="form-control" id="cPhone" placeholder="+91 " pattern="[0-9+\s()-]{7,}" required>
                    <div class="invalid-feedback">Please enter a valid phone number.</div>
                  </div>
                  <div class="col-md-6">
                    <label for="cSubject" class="form-label">Subject</label>
                    <select class="form-select" id="cSubject" required>
                      <option value="" selected disabled>Choose a topic…</option>
                      <option>Request a demo</option>
                      <option>Pricing &amp; plans</option>
                      <option>Courier &amp; rates</option>
                      <option>COD remittance</option>
                      <option>API &amp; integrations</option>
                      <option>Support</option>
                      <option>Other</option>
                    </select>
                    <div class="invalid-feedback">Please choose a subject.</div>
                  </div>
                  <div class="col-12">
                    <label for="cMessage" class="form-label">Message</label>
                    <textarea class="form-control" id="cMessage" rows="5" placeholder="Tell us about your shipping volume and what you need…" required minlength="10"></textarea>
                    <div class="invalid-feedback">Please enter a message (at least 10 characters).</div>
                  </div>
                  <div class="col-12 form-check ms-2">
                    <input class="form-check-input" type="checkbox" id="cConsent" required>
                    <label class="form-check-label" for="cConsent">I agree to be contacted about my enquiry.</label>
                    <div class="invalid-feedback">Please confirm to continue.</div>
                  </div>
                  <div class="col-12">
                    <button type="submit" class="btn btn-brand btn-lg"><i class="bi bi-send me-2"></i>Send Message</button>
                  </div>
                </div>
              </form>
            </div>
          </div>

          <div class="col-lg-5 reveal">
            <div class="map-embed h-100" style="min-height:440px;">
              <iframe title="Courier Bazar location — Baratooti, North Delhi" src="https://www.google.com/maps?q=4891%2F92%2C%20Phoota%20Road%2C%20Baratooti%2C%20North%20Delhi%2C%20Delhi%20110006&output=embed" loading="lazy" referrerpolicy="no-referrer-when-downgrade" allowfullscreen></iframe>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

<?php
include 'upload/footer.php';
?>
