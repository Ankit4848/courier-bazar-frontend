/* =================================================================
   COURIER BAZAR — Live Front-Side Tracking System
   ================================================================= */
(function () {
  "use strict";

  // Toast notification helper
  function showCopyToast(msg) {
    var existing = document.getElementById("copyToast");
    if (!existing) {
      existing = document.createElement("div");
      existing.id = "copyToast";
      existing.className = "copy-toast";
      document.body.appendChild(existing);
    }
    existing.innerHTML = '<i class="bi bi-check-circle-fill text-mint fs-5"></i><span>' + msg + '</span>';
    existing.classList.add("show");
    setTimeout(function () {
      existing.classList.remove("show");
    }, 2800);
  }

  function escapeHtml(value) {
    return String(value == null ? '' : value)
      .replace(/&/g, '&amp;')
      .replace(/</g, '&lt;')
      .replace(/>/g, '&gt;')
      .replace(/"/g, '&quot;')
      .replace(/'/g, '&#39;');
  }

  // Determine relative path to track_api.php
  function getApiEndpoint() {
    var scripts = document.querySelectorAll("script[src*='tracking.js']");
    if (scripts.length > 0) {
      var src = scripts[scripts.length - 1].getAttribute("src") || "";
      var base = src.replace(/assets\/js\/tracking\.js.*$/, "");
      return (base || "") + "track_api.php";
    }
    return "track_api.php";
  }

  // Fetch tracking data asynchronously from backend API
  function fetchTrackingData(awbInput, callback) {
    if (!awbInput) return;
    var cleaned = awbInput.trim();
    var apiUrl = getApiEndpoint() + '?awb=' + encodeURIComponent(cleaned);

    fetch(apiUrl, {
      method: 'GET',
      headers: { 'Accept': 'application/json' }
    })
      .then(function (res) {
        if (!res.ok && res.status !== 400 && res.status !== 404) {
          throw new Error('Server status ' + res.status);
        }
        return res.json();
      })
      .then(function (resData) {
        callback(resData);
      })
      .catch(function (err) {
        callback({
          success: false,
          found: false,
          awb: cleaned,
          message: 'Unable to reach the tracking service right now. Please verify your tracking number or try again later.'
        });
      });
  }

  // Render tracking details or friendly error state into container
  function renderTrackingDetails(resData, container, requestedAwb) {
    if (!container) return;

    if (!resData || !resData.success || !resData.data || !resData.found) {
      var searchVal = (resData && resData.awb) ? resData.awb : (requestedAwb || '');
      var errMsg = (resData && resData.message) ? resData.message : ('No tracking details found for AWB / Order: ' + (searchVal || ''));

      container.innerHTML = '' +
        '<div class="text-center py-5 px-3 bg-white rounded-4 border shadow-sm">' +
        '  <div class="mb-3">' +
        '    <div class="d-inline-flex align-items-center justify-content-center bg-warning-subtle text-warning rounded-circle shadow-sm" style="width:64px;height:64px;">' +
        '      <i class="bi bi-exclamation-triangle fs-2"></i>' +
        '    </div>' +
        '  </div>' +
        '  <h4 class="h5 fw-bold text-ink mb-2">Tracking Details Not Found</h4>' +
        '  <p class="text-muted mb-4 mx-auto" style="max-width:30rem;">' + errMsg + '</p>' +
        '  <div class="p-3 bg-surface-alt rounded-3 d-inline-block text-start small border mb-3" style="max-width:28rem;">' +
        '    <span class="fw-bold d-block mb-1 text-ink"><i class="bi bi-info-circle text-brand me-1"></i> Tracking Assistance:</span>' +
        '    <ul class="mb-0 ps-3 text-muted">' +
        '      <li>Please verify your AWB or Order Number</li>' +
        '      <li>New shipments reflect updates once picked up by the courier</li>' +
        '      <li>For further help, contact Courier Bazar support</li>' +
        '    </ul>' +
        '  </div>' +
        '</div>';
      return;
    }

    var data = resData.data;
    var statusClass = "status-" + (data.statusCode || "in-transit");

    var stepsHtml = (data.steps || []).map(function (s, i, all) {
      var stepCls = s.status + (i === all.length - 1 ? ' is-final' : '');
      var icon = s.status === "completed" ? '<i class="bi bi-check-lg"></i>' : (s.status === "active" ? '<i class="bi bi-geo-alt-fill"></i>' : '<i class="bi bi-circle-fill" style="font-size:0.5rem;"></i>');
      return '' +
        '<div class="step-node ' + stepCls + '">' +
        '  <div class="step-icon-circle">' + icon + '</div>' +
        '  <div class="step-label">' + s.label + '</div>' +
        '  <div class="step-time">' + String(s.time || '').replace(', ', '<br>') + '</div>' +
        '</div>';
    }).join("");

    // The green bar ends at the furthest step that is completed or in progress, so
    // it only reaches the last step once the shipment is actually delivered.
    var steps = data.steps || [];
    var reached = 0;
    steps.forEach(function (s, i) {
      if (s.status === "completed" || s.status === "active") {
        reached = i;
      }
    });
    var trackFill = steps.length > 1 ? reached / (steps.length - 1) : 0;
    var trackEdge = steps.length ? (50 / steps.length) : 10;

    var activitiesHtml = (data.activities || []).map(function (act) {
      var instrHtml = act.instructions ? '<div class="activity-instructions text-muted small mt-1"><i class="bi bi-info-circle me-1 text-amber"></i>' + act.instructions + '</div>' : '';
      return '' +
        '<div class="activity-item ' + (act.latest ? 'latest' : '') + '">' +
        '  <div class="activity-dot"></div>' +
        '  <div class="activity-card shadow-sm">' +
        '    <div class="d-flex justify-content-between align-items-start gap-2">' +
        '      <div class="activity-title text-ink fw-bold">' + act.title + '</div>' +
        '      <div class="activity-date badge bg-light text-dark border">' + act.time + '</div>' +
        '    </div>' +
        '    <div class="activity-location mt-1"><i class="bi bi-geo-alt-fill text-danger opacity-75 me-1"></i>' + act.location + '</div>' +
        '    ' + instrHtml +
        '  </div>' +
        '</div>';
    }).join("");

    var metaBadges = '';
    if (data.order_prefix) {
      metaBadges += '<span class="badge bg-light text-dark border px-2 py-1"><span class="text-muted">Reference No:</span> <b>' + data.order_prefix + '</b></span> ';
    }
    if (data.lr_no && data.lr_no !== data.awb) {
      metaBadges += '<span class="badge bg-light text-dark border px-2 py-1"><span class="text-muted">LR No:</span> <b>' + data.lr_no + '</b></span> ';
    }
    if (data.estDelivery && data.estDelivery !== 'N/A') {
      metaBadges += '<span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1"><i class="bi bi-calendar-check me-1"></i>Expected Delivery: <b>' + data.estDelivery + '</b></span>';
    }

    // Optional Origin & Destination route info (only rendered when real origin/dest available)
    var routeBoxHtml = '';
    if (data.origin && data.destination && data.origin !== 'Origin Hub' && data.destination !== 'Destination' && data.origin !== data.destination) {
      routeBoxHtml = '' +
        '<div class="track-route-box bg-white p-3 rounded-3 border mb-3">' +
        '  <div class="track-city-node">' +
        '    <div class="track-city-sub"><i class="bi bi-record-circle text-mint me-1"></i> Origin</div>' +
        '    <div class="track-city-name">' + data.origin + '</div>' +
        (data.originPincode ? '    <div class="track-city-sub font-monospace text-muted">PIN: ' + data.originPincode + '</div>' : '') +
        '  </div>' +
        '  <div class="track-route-line d-none d-md-flex">' +
        '    <div class="track-route-icon"><i class="bi ' + (data.courierIcon || 'bi-truck') + '"></i></div>' +
        '  </div>' +
        '  <div class="track-city-node end">' +
        '    <div class="track-city-sub"><i class="bi bi-geo-alt-fill text-amber me-1"></i> Destination</div>' +
        '    <div class="track-city-name">' + data.destination + '</div>' +
        (data.destPincode ? '    <div class="track-city-sub font-monospace text-muted">PIN: ' + data.destPincode + '</div>' : '') +
        '  </div>' +
        '</div>';
    }

    // Proof of delivery documents (ePOD, receiver signature) for delivered shipments
    var podHtml = '';
    var podDocs = (data.podDocuments || []).filter(function (doc) {
      return doc && /^https?:\/\//i.test(doc.url || '');
    });
    if (podDocs.length) {
      podHtml = '' +
        '<div class="pod-box mt-3">' +
        '  <span class="text-muted small text-uppercase fw-bold d-block mb-2"><i class="bi bi-file-earmark-check me-1 text-brand"></i>Proof of Delivery</span>' +
        '  <div class="d-flex flex-wrap gap-2">' +
        podDocs.map(function (doc) {
          var icon = /signature/i.test(doc.label || '') ? 'bi-pen' : 'bi-file-earmark-text';
          return '<a href="' + escapeHtml(doc.url) + '" target="_blank" rel="noopener noreferrer" class="btn-ssa-primary btn-ssa-success">' +
            '<i class="bi ' + icon + '"></i><span>' + escapeHtml(doc.label || 'Proof of Delivery') + '</span></a>';
        }).join('') +
        '  </div>' +
        '</div>';
    }

    var html = '' +
      '<div class="track-banner-card shadow-sm mb-4">' +
      '  <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3 pb-3 border-bottom">' +
      '    <div>' +
      '      <span class="text-muted small text-uppercase fw-bold d-block mb-1">Waybill / AWB Number</span>' +
      '      <div class="h4 mb-1 font-monospace text-ink fw-bold d-flex flex-wrap align-items-center gap-2">' +
      '        <span>' + data.awb + '</span>' +
      '        <button class="btn btn-sm btn-outline-secondary py-1 px-2 rounded-2 border-0" id="btnCopyAwb" title="Copy AWB">' +
      '          <i class="bi bi-copy me-1"></i>Copy' +
      '        </button>' +
      '        <button class="btn btn-sm btn-outline-secondary py-1 px-2 rounded-2 border-0" id="btnShareTrack" title="Share Tracking Link">' +
      '          <i class="bi bi-share me-1"></i>Share' +
      '        </button>' +
      '      </div>' +
      '      <div class="d-flex flex-wrap gap-1 mt-2">' + metaBadges + '</div>' +
      '    </div>' +
      '    <div class="d-flex flex-column align-items-sm-end align-items-start gap-2">' +
      '      <div class="courier-badge-box shadow-sm">' +
      '        <i class="bi ' + (data.courierIcon || 'bi-truck') + ' text-brand"></i> ' + data.courier +
      '      </div>' +
      '      <span class="status-pill ' + statusClass + '">' +
      '        <span class="pulse-dot"></span>' + data.status +
      '      </span>' +
      '    </div>' +
      '  </div>' +
      '  ' + routeBoxHtml +
      '  ' + podHtml +
      '</div>' +

      '<!-- Stepper Timeline -->' +
      '<div class="bg-white p-3 p-md-4 rounded-4 border shadow-sm mb-4">' +
      '  <h5 class="h6 text-uppercase fw-bold text-muted mb-3" style="letter-spacing:0.06em;">' +
      '    <i class="bi bi-signpost-split me-1 text-brand"></i> Milestone Status' +
      '  </h5>' +
      '  <div class="tracking-steps mb-2" style="--track-edge:' + trackEdge + '%;--track-fill:' + trackFill + ';">' +
      '    <div class="tracking-steps-progress"></div>' +
      '    ' + stepsHtml +
      '  </div>' +
      '</div>' +

      '<!-- Tracking History Feed -->' +
      '<div class="activity-section bg-white p-3 p-md-4 rounded-4 border shadow-sm">' +
      '  <div class="d-flex justify-content-between align-items-center mb-3">' +
      '    <h5 class="h6 text-uppercase fw-bold text-muted mb-0" style="letter-spacing:0.06em;">' +
      '      <i class="bi bi-clock-history me-1 text-brand"></i> Tracking History' +
      '    </h5>' +
      '    <span class="badge bg-mint-subtle text-mint px-2 py-1"><i class="bi bi-check-circle me-1"></i>Live Sync</span>' +
      '  </div>' +
      '  <div class="activity-timeline">' +
      '    ' + (activitiesHtml || '<div class="text-muted small py-3">No scan updates recorded yet.</div>') +
      '  </div>' +
      '</div>';

    container.innerHTML = html;
    container.scrollTop = 0;
    var modalBodyParent = container.closest('.modal-body') || container;
    if (modalBodyParent) {
      modalBodyParent.scrollTop = 0;
    }

    // Copy AWB button
    var btnCopy = container.querySelector("#btnCopyAwb");
    if (btnCopy) {
      btnCopy.addEventListener("click", function () {
        if (navigator.clipboard && navigator.clipboard.writeText) {
          navigator.clipboard.writeText(data.awb);
          showCopyToast("AWB " + data.awb + " copied to clipboard!");
        } else {
          showCopyToast("AWB: " + data.awb);
        }
      });
    }

    // Share Tracking Link button
    var btnShare = container.querySelector("#btnShareTrack");
    if (btnShare) {
      btnShare.addEventListener("click", function () {
        var shareUrl = window.location.origin + window.location.pathname.replace(/[^\/]*$/, 'track.php') + '?awb=' + encodeURIComponent(data.awb);
        if (navigator.clipboard && navigator.clipboard.writeText) {
          navigator.clipboard.writeText(shareUrl);
          showCopyToast("Tracking link copied to clipboard!");
        } else {
          showCopyToast("Link: " + shareUrl);
        }
      });
    }
  }

  // ---------------- Multiple AWB search ----------------
  var MAX_AWBS = 10;

  // "A, B C" / one per line -> ["A", "B", "C"]: duplicates dropped, at most MAX_AWBS.
  function pickAwbs(raw) {
    var seen = {};
    var awbs = String(raw || '').split(/[\s,;]+/).filter(function (awb) {
      var key = awb.toUpperCase();
      if (!awb || seen[key]) return false;
      seen[key] = true;
      return true;
    });
    if (awbs.length > MAX_AWBS) {
      showCopyToast('Showing the first ' + MAX_AWBS + ' of ' + awbs.length + ' AWB numbers.');
    }
    return awbs.slice(0, MAX_AWBS);
  }

  // Marks the search currently shown in a container, so a slower, older lookup
  // cannot overwrite the results of a newer one.
  function startTrackingRun(container) {
    var run = String(Date.now()) + Math.random();
    container.setAttribute('data-track-run', run);
    return run;
  }

  // A text input drops line breaks on paste, which would glue a pasted column of
  // AWBs into one number; join the lines with commas instead.
  function allowMultiLinePaste(input) {
    if (!input) return;
    input.addEventListener('paste', function (e) {
      var text = e.clipboardData ? e.clipboardData.getData('text') : '';
      if (!/[\r\n]/.test(text)) return;
      e.preventDefault();
      var joined = text.split(/[\r\n]+/).map(function (v) { return v.trim(); }).filter(Boolean).join(', ');
      if (typeof input.setRangeText === 'function') {
        input.setRangeText(joined, input.selectionStart, input.selectionEnd, 'end');
      } else {
        input.value += joined;
      }
    });
  }

  // Tracks several AWBs at once: one summary row per shipment, filled in as each
  // lookup returns. "View Details" opens the full tracking view for that shipment.
  function trackMultiple(awbs, container) {
    var run = startTrackingRun(container);
    var results = [];

    function rowHtml(i) {
      var awb = awbs[i];
      var res = results[i];
      var info;
      var side = '';

      if (!res) {
        info = '<div class="text-muted small mt-1"><span class="spinner-border spinner-border-sm text-brand me-2" role="status"></span>Fetching live status...</div>';
      } else if (!res.success || !res.found || !res.data) {
        info = '<div class="text-muted small mt-1"><i class="bi bi-exclamation-triangle text-warning me-1"></i>' + escapeHtml(res.message || 'Tracking details not found.') + '</div>';
      } else {
        var d = res.data;
        var latest = (d.activities || [])[0];
        awb = d.awb || awb;
        info = '<div class="text-muted small mt-1"><i class="bi ' + escapeHtml(d.courierIcon || 'bi-truck') + ' me-1"></i>' + escapeHtml(d.courier) + '</div>' +
          (latest ? '<div class="small text-ink mt-1">' + escapeHtml(latest.title) + ' <span class="text-muted">&middot; ' + escapeHtml(latest.time) + '</span></div>' : '');
        side = '' +
          '<div class="multi-track-side">' +
          '  <span class="status-pill status-' + escapeHtml(d.statusCode || 'in-transit') + '"><span class="pulse-dot"></span>' + escapeHtml(d.status) + '</span>' +
          '  <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3" data-view-index="' + i + '">View Details<i class="bi bi-arrow-right ms-1"></i></button>' +
          '</div>';
      }

      return '' +
        '<div class="multi-track-main">' +
        '  <div class="multi-track-awb font-monospace fw-bold text-ink">' + escapeHtml(awb) + '</div>' +
        '  ' + info +
        '</div>' + side;
    }

    function showList() {
      var rows = awbs.map(function (awb, i) {
        return '<div class="multi-track-row" data-index="' + i + '">' + rowHtml(i) + '</div>';
      }).join('');

      container.innerHTML = '' +
        '<div class="bg-white p-3 p-md-4 rounded-4 border shadow-sm">' +
        '  <h5 class="h6 text-uppercase fw-bold text-muted mb-3" style="letter-spacing:0.06em;">' +
        '    <i class="bi bi-boxes me-1 text-brand"></i> Tracking ' + awbs.length + ' Shipments' +
        '  </h5>' +
        '  <div class="multi-track-list">' + rows + '</div>' +
        '</div>';
      container.scrollTop = 0;
    }

    function showDetails(i) {
      renderTrackingDetails(results[i], container, awbs[i]);
      container.insertAdjacentHTML('afterbegin',
        '<button type="button" class="btn btn-sm btn-light border rounded-pill px-3 mb-3" data-multi-back>' +
        '<i class="bi bi-arrow-left me-1"></i>All shipments (' + awbs.length + ')</button>');
      container.scrollTop = 0;
    }

    // Assigned (not added) so a later search replaces this handler instead of stacking.
    container.onclick = function (e) {
      if (container.getAttribute('data-track-run') !== run) return;
      var viewBtn = e.target.closest('[data-view-index]');
      if (viewBtn) {
        showDetails(parseInt(viewBtn.getAttribute('data-view-index'), 10));
      } else if (e.target.closest('[data-multi-back]')) {
        showList();
      }
    };

    showList();
    awbs.forEach(function (awb, i) {
      fetchTrackingData(awb, function (resData) {
        if (container.getAttribute('data-track-run') !== run) return;
        results[i] = resData;
        var row = container.querySelector('.multi-track-row[data-index="' + i + '"]');
        if (row) row.innerHTML = rowHtml(i);
      });
    });
  }

  // Open Global Modal and load one or more AWBs
  function openModalWithAWB(rawAwb) {
    var awbs = pickAwbs(rawAwb);
    if (!awbs.length) return;
    var awb = awbs[0];
    var trackingModalEl = document.getElementById("trackingModal");
    var modalBody = document.getElementById("trackingModalContent");
    var fullPageBtn = document.getElementById("modalFullPageBtn");

    if (fullPageBtn) {
      fullPageBtn.href = "track.php?awb=" + encodeURIComponent(awbs.join(','));
    }

    if (modalBody) {
      modalBody.scrollTop = 0;
      modalBody.innerHTML = '' +
        '<div class="text-center py-5">' +
        '  <div class="spinner-border text-brand mb-3" style="width: 3rem; height: 3rem;" role="status"></div>' +
        '  <h5 class="h6 fw-bold text-ink mb-1">Connecting to Live Tracking Hub...</h5>' +
        '  <p class="text-muted small mb-0 font-monospace">AWB: ' + escapeHtml(awb) + '</p>' +
        '</div>';
    }

    if (trackingModalEl && typeof bootstrap !== "undefined") {
      var bsModal = bootstrap.Modal.getOrCreateInstance(trackingModalEl);
      bsModal.show();
      setTimeout(function () {
        if (modalBody) modalBody.scrollTop = 0;
      }, 50);
    }

    if (!modalBody) return;

    if (awbs.length > 1) {
      trackMultiple(awbs, modalBody);
      return;
    }

    var run = startTrackingRun(modalBody);
    fetchTrackingData(awb, function (resData) {
      if (modalBody.getAttribute('data-track-run') !== run) return;
      renderTrackingDetails(resData, modalBody, awb);
      modalBody.scrollTop = 0;
    });
  }

  // Handle tracking initialization
  function initTracking() {
    // 1. Hero Tracking Form on Home / Landing page
    var heroTrackForm = document.getElementById("trackForm");
    var heroTrackInput = document.getElementById("trackInput");

    allowMultiLinePaste(heroTrackInput);

    if (heroTrackForm) {
      heroTrackForm.addEventListener("submit", function (e) {
        e.preventDefault();
        var awb = heroTrackInput ? heroTrackInput.value.trim() : "";
        if (!awb) return;

        var submitBtn = heroTrackForm.querySelector("button[type='submit']");
        var origBtnHtml = submitBtn ? submitBtn.innerHTML : "";

        if (submitBtn) {
          submitBtn.disabled = true;
          submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status"></span>Tracking...';
        }

        setTimeout(function () {
          if (submitBtn) {
            submitBtn.disabled = false;
            submitBtn.innerHTML = origBtnHtml;
          }
          openModalWithAWB(awb);
        }, 200);
      });
    }

    // 2. Dedicated Tracking Page (track.php)
    var pageTrackForm = document.getElementById("pageTrackForm");
    var pageTrackInput = document.getElementById("pageTrackInput");
    var pageTrackResultContainer = document.getElementById("pageTrackResult");

    if (pageTrackResultContainer) {
      var urlParams = new URLSearchParams(window.location.search);
      var awbParam = urlParams.get("awb") || "";

      allowMultiLinePaste(pageTrackInput);

      function loadPageTracking(rawVal) {
        var awbs = pickAwbs(rawVal);
        var awbVal = awbs[0] || "";
        if (!awbVal) {
          pageTrackResultContainer.innerHTML = '' +
            '<div class="bg-white p-4 p-md-5 rounded-4 border shadow-sm text-center">' +
            '  <div class="mb-3">' +
            '    <div class="d-inline-flex align-items-center justify-content-center bg-brand-subtle rounded-circle" style="width:68px;height:68px;">' +
            '      <i class="bi bi-geo-alt-fill text-brand fs-2"></i>' +
            '    </div>' +
            '  </div>' +
            '  <h3 class="h5 fw-bold text-ink mb-2">Real-Time Multi-Carrier Tracking</h3>' +
            '  <p class="text-muted mx-auto mb-0" style="max-width:32rem;">' +
            '    Enter your AWB number, Order ID, or LR number above to check real-time GPS scans, transit checkpoints, and expected delivery date across 25+ courier partners.' +
            '  </p>' +
            '</div>';
          return;
        }

        if (pageTrackInput) pageTrackInput.value = awbs.join(', ');

        if (awbs.length > 1) {
          trackMultiple(awbs, pageTrackResultContainer);
          return;
        }

        pageTrackResultContainer.innerHTML = '' +
          '<div class="bg-white p-5 rounded-4 border shadow-sm text-center">' +
          '  <div class="spinner-border text-brand mb-3" style="width: 3rem; height: 3rem;" role="status"></div>' +
          '  <h4 class="h5 fw-bold text-ink mb-1">Loading Live Shipment Details...</h4>' +
          '  <p class="text-muted small mb-0 font-monospace">AWB: ' + escapeHtml(awbVal) + '</p>' +
          '</div>';

        var run = startTrackingRun(pageTrackResultContainer);
        fetchTrackingData(awbVal, function (resData) {
          if (pageTrackResultContainer.getAttribute('data-track-run') !== run) return;
          renderTrackingDetails(resData, pageTrackResultContainer, awbVal);
        });
      }

      if (awbParam) {
        loadPageTracking(awbParam);
      } else {
        loadPageTracking("");
      }

      if (pageTrackForm) {
        pageTrackForm.addEventListener("submit", function (e) {
          e.preventDefault();
          var val = pageTrackInput ? pageTrackInput.value.trim() : "";
          if (!val) return;

          var newUrl = window.location.pathname + "?awb=" + encodeURIComponent(val);
          if (window.history && window.history.pushState) {
            window.history.pushState({ path: newUrl }, '', newUrl);
          }

          loadPageTracking(val);
        });
      }
    }
  }

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", initTracking);
  } else {
    initTracking();
  }
})();
