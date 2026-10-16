/* =================================================================
   COURIER BAZAR — Real Portal Live Tracking Engine
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
    }, 2500);
  }

  // Fetch tracking data asynchronously from backend API (track_api.php)
  function fetchTrackingData(awbInput, callback) {
    if (!awbInput) return;
    var cleaned = awbInput.trim();

    fetch('track_api.php?awb=' + encodeURIComponent(cleaned))
      .then(function (res) {
        return res.json();
      })
      .then(function (resData) {
        callback(resData);
      })
      .catch(function (err) {
        callback({
          success: false,
          found: false,
          message: 'Unable to connect to tracking server. Please try again later.'
        });
      });
  }

  // Render tracking details or error state into container
  function renderTrackingDetails(resData, container, requestedAwb) {
    if (!container) return;

    if (!resData || !resData.success || !resData.data || !resData.found) {
      var errMsg = (resData && resData.message) ? resData.message : ('No tracking details found for AWB: ' + (requestedAwb || ''));
      container.innerHTML = '' +
        '<div class="text-center py-5 px-3">' +
        '  <div class="mb-3">' +
        '    <i class="bi bi-exclamation-triangle text-amber display-4"></i>' +
        '  </div>' +
        '  <h4 class="h5 fw-bold text-ink mb-2">Tracking Details Not Found</h4>' +
        '  <p class="text-muted mb-4 mx-auto" style="max-width:28rem;">' + errMsg + '</p>' +
        '  <div class="p-3 bg-surface-alt rounded-3 d-inline-block text-start small border">' +
        '    <span class="fw-bold d-block mb-1 text-ink"><i class="bi bi-info-circle me-1 text-brand"></i> Tips for Tracking:</span>' +
        '    <ul class="mb-0 ps-3 text-muted">' +
        '      <li>Verify the AWB or Order ID format</li>' +
        '      <li>Ensure the shipment has been manifested or dispatched</li>' +
        '      <li>For assistance, contact seller or Courier Bazar support</li>' +
        '    </ul>' +
        '  </div>' +
        '</div>';
      return;
    }

    var data = resData.data;
    var statusClass = "status-" + (data.statusCode || "in-transit");

    var stepsHtml = (data.steps || []).map(function (s) {
      var stepCls = s.status;
      var icon = s.status === "completed" ? '<i class="bi bi-check-lg"></i>' : (s.status === "active" ? '<i class="bi bi-geo-alt-fill"></i>' : '<i class="bi bi-circle-fill" style="font-size:0.5rem;"></i>');
      return '' +
        '<div class="step-node ' + stepCls + '">' +
        '  <div class="step-icon-circle">' + icon + '</div>' +
        '  <div class="step-label">' + s.label + '</div>' +
        '  <div class="step-time">' + s.time + '</div>' +
        '</div>';
    }).join("");

    var activitiesHtml = (data.activities || []).map(function (act) {
      var instrHtml = act.instructions ? '<div class="activity-instructions text-muted small mt-1"><i class="bi bi-info-circle me-1 text-amber"></i>' + act.instructions + '</div>' : '';
      return '' +
        '<div class="activity-item ' + (act.latest ? 'latest' : '') + '">' +
        '  <div class="activity-dot"></div>' +
        '  <div class="activity-card">' +
        '    <div class="d-flex justify-content-between align-items-start gap-2">' +
        '      <div class="activity-title">' + act.title + '</div>' +
        '      <div class="activity-date">' + act.time + '</div>' +
        '    </div>' +
        '    <div class="activity-location"><i class="bi bi-geo-alt text-muted me-1"></i>' + act.location + '</div>' +
        '    ' + instrHtml +
        '  </div>' +
        '</div>';
    }).join("");

    var html = '' +
      '<div class="track-banner-card">' +
      '  <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3 pb-3 border-bottom">' +
      '    <div>' +
      '      <span class="text-muted small text-uppercase fw-bold">Waybill / AWB Number</span>' +
      '      <div class="h4 mb-0 font-monospace text-ink fw-bold d-flex align-items-center gap-2">' +
      '        ' + data.awb +
      '        <button class="btn btn-sm btn-outline-secondary py-0 px-2 rounded-2 border-0" id="btnCopyAwb" title="Copy AWB">' +
      '          <i class="bi bi-copy"></i>' +
      '        </button>' +
      '      </div>' +
      '    </div>' +
      '    <div class="d-flex align-items-center gap-2">' +
      '      <div class="courier-badge-box">' +
      '        <i class="bi ' + (data.courierIcon || 'bi-truck') + ' text-brand"></i> ' + data.courier +
      '      </div>' +
      '      <span class="status-pill ' + statusClass + '">' +
      '        <span class="pulse-dot"></span>' + data.status +
      '      </span>' +
      '    </div>' +
      '  </div>' +
      '  <div class="track-route-box">' +
      '    <div class="track-city-node">' +
      '      <div class="track-city-sub"><i class="bi bi-record-circle text-mint me-1"></i> Origin</div>' +
      '      <div class="track-city-name">' + data.origin + '</div>' +
      '      <div class="track-city-sub">Pincode: ' + data.originPincode + '</div>' +
      '    </div>' +
      '    <div class="track-route-line d-none d-md-flex">' +
      '      <div class="track-route-icon"><i class="bi bi-truck"></i></div>' +
      '    </div>' +
      '    <div class="track-city-node end">' +
      '      <div class="track-city-sub"><i class="bi bi-geo-alt-fill text-amber me-1"></i> Destination</div>' +
      '      <div class="track-city-name">' + data.destination + '</div>' +
      '      <div class="track-city-sub">Pincode: ' + data.destPincode + '</div>' +
      '    </div>' +
      '  </div>' +
      '</div>' +

      '<!-- Stepper Timeline -->' +
      '<div class="tracking-steps mb-4">' +
      '  <div class="tracking-steps-progress" style="width:' + (data.progressPercent || 50) + '%;"></div>' +
      '  ' + stepsHtml +
      '</div>' +

      '<!-- Activity History Feed -->' +
      '<div class="activity-section">' +
      '  <h5 class="h6 text-uppercase fw-bold text-muted mb-3" style="letter-spacing:0.06em;">' +
      '    <i class="bi bi-clock-history me-1"></i> Live Activity & Scan History' +
      '  </h5>' +
      '  <div class="activity-timeline">' +
      '    ' + (activitiesHtml || '<div class="text-muted small">No scan updates recorded yet.</div>') +
      '  </div>' +
      '</div>';

    container.innerHTML = html;

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
  }

  // Handle tracking initialization
  function initTracking() {
    var heroTrackForm = document.getElementById("trackForm");
    var heroTrackInput = document.getElementById("trackInput");
    var trackingModalEl = document.getElementById("trackingModal");

    function openModalWithAWB(awb) {
      if (!awb) return;
      var modalBody = document.getElementById("trackingModalContent");

      if (modalBody) {
        modalBody.innerHTML = '<div class="text-center py-5"><div class="spinner-border text-brand mb-3" role="status"></div><p class="text-muted mb-0">Fetching live shipment tracking data...</p></div>';
      }

      if (trackingModalEl && typeof bootstrap !== "undefined") {
        var bsModal = bootstrap.Modal.getOrCreateInstance(trackingModalEl);
        bsModal.show();
      }

      fetchTrackingData(awb, function (resData) {
        if (modalBody) {
          renderTrackingDetails(resData, modalBody, awb);
        }
      });
    }

    if (heroTrackForm) {
      heroTrackForm.addEventListener("submit", function (e) {
        e.preventDefault();
        var awb = heroTrackInput ? heroTrackInput.value.trim() : "";
        if (!awb) return;

        var submitBtn = heroTrackForm.querySelector("button[type='submit']");
        var origBtnHtml = submitBtn ? submitBtn.innerHTML : "";

        if (submitBtn) {
          submitBtn.disabled = true;
          submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status"></span>Searching...';
        }

        setTimeout(function () {
          if (submitBtn) {
            submitBtn.disabled = false;
            submitBtn.innerHTML = origBtnHtml;
          }
          openModalWithAWB(awb);
        }, 300);
      });
    }

    // Check if on track.php
    var pageTrackForm = document.getElementById("pageTrackForm");
    var pageTrackInput = document.getElementById("pageTrackInput");
    var pageTrackResultContainer = document.getElementById("pageTrackResult");

    if (pageTrackResultContainer) {
      var urlParams = new URLSearchParams(window.location.search);
      var awbParam = urlParams.get("awb") || "";

      if (awbParam) {
        if (pageTrackInput) pageTrackInput.value = awbParam;
        pageTrackResultContainer.innerHTML = '<div class="text-center py-5"><div class="spinner-border text-brand mb-3" role="status"></div><p class="text-muted mb-0">Loading live tracking details...</p></div>';

        fetchTrackingData(awbParam, function (resData) {
          renderTrackingDetails(resData, pageTrackResultContainer, awbParam);
        });
      } else {
        pageTrackResultContainer.innerHTML = '<div class="text-center py-5 text-muted"><i class="bi bi-search display-5 d-block mb-3 opacity-50"></i>Enter an AWB or Order Number above to view real-time tracking information.</div>';
      }

      if (pageTrackForm) {
        pageTrackForm.addEventListener("submit", function (e) {
          e.preventDefault();
          var awbVal = pageTrackInput ? pageTrackInput.value.trim() : "";
          if (!awbVal) return;

          var newUrl = window.location.pathname + "?awb=" + encodeURIComponent(awbVal);
          window.history.pushState({ path: newUrl }, '', newUrl);

          pageTrackResultContainer.innerHTML = '<div class="text-center py-5"><div class="spinner-border text-brand mb-3" role="status"></div><p class="text-muted mb-0">Updating live tracking data...</p></div>';

          fetchTrackingData(awbVal, function (resData) {
            renderTrackingDetails(resData, pageTrackResultContainer, awbVal);
          });
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
