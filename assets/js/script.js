/* =================================================================
   BMS SERVICE — Global Scripts (Vanilla JS, no dependencies)
   -----------------------------------------------------------------
   1. Navbar: shadow on scroll + active link highlight
   2. Animated counters (stats)
   3. Scroll reveal (IntersectionObserver)
   4. Scroll-to-top button
   5. Bootstrap form validation (contact / auth)
   6. Password strength meter + show/hide + match check
   7. Footer year
   ================================================================= */
(function () {
  "use strict";

  /* ---------------------------------------------------------------
     1. NAVBAR — shadow on scroll + active link
     --------------------------------------------------------------- */
  var navbar = document.querySelector(".navbar-bms");
  function onScrollNav() {
    if (!navbar) return;
    navbar.classList.toggle("scrolled", window.scrollY > 10);
  }
  window.addEventListener("scroll", onScrollNav, { passive: true });
  onScrollNav();

  // Active link based on current file name
  (function setActiveLink() {
    var path = window.location.pathname.split("/").pop() || "index.html";
    if (path === "") path = "index.html";
    var links = document.querySelectorAll(".navbar-bms .nav-link");
    links.forEach(function (a) {
      var href = a.getAttribute("href");
      if (!href) return;
      var target = href.split("/").pop();
      if (target === path) {
        a.classList.add("active");
        a.setAttribute("aria-current", "page");
      }
    });
  })();

  /* ---------------------------------------------------------------
     2. ANIMATED COUNTERS
     Elements: <span class="counter" data-target="500" data-suffix="+"></span>
     --------------------------------------------------------------- */
  function animateCounter(el) {
    var target = parseFloat(el.getAttribute("data-target")) || 0;
    var suffix = el.getAttribute("data-suffix") || "";
    var prefix = el.getAttribute("data-prefix") || "";
    var dur = 1600;
    var start = null;

    function step(ts) {
      if (!start) start = ts;
      var p = Math.min((ts - start) / dur, 1);
      // easeOutCubic
      var eased = 1 - Math.pow(1 - p, 3);
      var val = Math.floor(eased * target);
      el.textContent = prefix + val.toLocaleString() + suffix;
      if (p < 1) {
        requestAnimationFrame(step);
      } else {
        el.textContent = prefix + target.toLocaleString() + suffix;
      }
    }
    requestAnimationFrame(step);
  }

  var counters = document.querySelectorAll(".counter");
  if (counters.length && "IntersectionObserver" in window) {
    var cObserver = new IntersectionObserver(function (entries, obs) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          animateCounter(entry.target);
          obs.unobserve(entry.target);
        }
      });
    }, { threshold: 0.4 });
    counters.forEach(function (c) { cObserver.observe(c); });
  } else {
    counters.forEach(animateCounter);
  }

  /* ---------------------------------------------------------------
     3. SCROLL REVEAL
     --------------------------------------------------------------- */
  var reveals = document.querySelectorAll(".reveal");
  // stagger items that share a parent (e.g. cards in a row)
  Array.prototype.forEach.call(reveals, function (el) {
    var parent = el.parentElement;
    if (!parent) return;
    var siblings = Array.prototype.filter.call(parent.children, function (c) {
      return c.classList && c.classList.contains("reveal");
    });
    if (siblings.length > 1) {
      var idx = siblings.indexOf(el);
      el.style.setProperty("--reveal-delay", Math.min(idx, 5) * 90 + "ms");
    }
  });
  if (reveals.length && "IntersectionObserver" in window) {
    var rObserver = new IntersectionObserver(function (entries, obs) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add("in");
          obs.unobserve(entry.target);
        }
      });
    }, { threshold: 0.12 });
    reveals.forEach(function (r) { rObserver.observe(r); });
  } else {
    reveals.forEach(function (r) { r.classList.add("in"); });
  }

  /* ---------------------------------------------------------------
     4. SCROLL-TO-TOP
     --------------------------------------------------------------- */
  var toTop = document.querySelector(".to-top");
  if (toTop) {
    window.addEventListener("scroll", function () {
      toTop.classList.toggle("show", window.scrollY > 500);
    }, { passive: true });
    toTop.addEventListener("click", function () {
      window.scrollTo({ top: 0, behavior: "smooth" });
    });
  }

  /* ---------------------------------------------------------------
     5. BOOTSTRAP-STYLE FORM VALIDATION
     Any <form class="needs-validation" novalidate>
     Shows success alert (data-success target) on valid submit.
     --------------------------------------------------------------- */
  var forms = document.querySelectorAll(".needs-validation");
  Array.prototype.forEach.call(forms, function (form) {
    form.addEventListener("submit", function (event) {
      event.preventDefault();
      event.stopPropagation();

      // custom: password match check for register
      var pw = form.querySelector("[data-pw]");
      var pw2 = form.querySelector("[data-pw-confirm]");
      if (pw && pw2) {
        if (pw.value !== pw2.value) {
          pw2.setCustomValidity("mismatch");
        } else {
          pw2.setCustomValidity("");
        }
      }

      if (form.checkValidity()) {
        var successId = form.getAttribute("data-success");
        var success = successId ? document.getElementById(successId) : null;
        if (success) {
          success.classList.remove("d-none");
          success.scrollIntoView ? null : null; // avoid scrollIntoView per guidance
        }
        form.reset();
        form.classList.remove("was-validated");
        // reset any password meter
        var meterBar = form.querySelector(".pw-meter span");
        var meterHint = form.querySelector(".pw-hint");
        if (meterBar) meterBar.style.width = "0";
        if (meterHint) meterHint.textContent = "";
        return;
      }
      form.classList.add("was-validated");
    }, false);
  });

  /* ---------------------------------------------------------------
     6. PASSWORD STRENGTH + SHOW/HIDE
     --------------------------------------------------------------- */
  function scorePassword(pw) {
    var score = 0;
    if (!pw) return 0;
    if (pw.length >= 8) score++;
    if (pw.length >= 12) score++;
    if (/[A-Z]/.test(pw) && /[a-z]/.test(pw)) score++;
    if (/\d/.test(pw)) score++;
    if (/[^A-Za-z0-9]/.test(pw)) score++;
    return Math.min(score, 4);
  }

  var pwInputs = document.querySelectorAll("[data-pw]");
  Array.prototype.forEach.call(pwInputs, function (input) {
    var form = input.closest("form");
    var bar = form ? form.querySelector(".pw-meter span") : null;
    var hint = form ? form.querySelector(".pw-hint") : null;
    if (!bar) return;

    var labels = ["Too weak", "Weak", "Fair", "Good", "Strong"];
    var colors = ["#e34c4c", "#f08a3c", "#f9d819", "#04a4df", "#1fb573"];
    var widths = ["20%", "40%", "60%", "80%", "100%"];

    input.addEventListener("input", function () {
      var s = scorePassword(input.value);
      var idx = input.value.length === 0 ? 0 : s;
      bar.style.width = input.value.length === 0 ? "0" : widths[idx];
      bar.style.background = colors[idx];
      if (hint) {
        hint.textContent = input.value.length === 0 ? "" : "Password strength: " + labels[idx];
        hint.style.color = input.value.length === 0 ? "" : colors[idx];
      }
    });
  });

  // show/hide password toggles
  var toggles = document.querySelectorAll(".password-toggle");
  Array.prototype.forEach.call(toggles, function (btn) {
    btn.addEventListener("click", function () {
      var sel = btn.getAttribute("data-target");
      var field = sel ? document.querySelector(sel) : null;
      if (!field) return;
      var icon = btn.querySelector("i");
      if (field.type === "password") {
        field.type = "text";
        if (icon) { icon.classList.remove("bi-eye"); icon.classList.add("bi-eye-slash"); }
      } else {
        field.type = "password";
        if (icon) { icon.classList.remove("bi-eye-slash"); icon.classList.add("bi-eye"); }
      }
    });
  });

  /* ---------------------------------------------------------------
     7. FOOTER YEAR
     --------------------------------------------------------------- */
  var yearEls = document.querySelectorAll(".js-year");
  Array.prototype.forEach.call(yearEls, function (el) {
    el.textContent = new Date().getFullYear();
  });

})();
