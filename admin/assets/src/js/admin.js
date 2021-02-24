document.addEventListener('DOMContentLoaded', function (event) {

  const $importBtn = document.getElementById('loop-events-json-import');
  const nonce = document.getElementById('_wpnonce');

  $importBtn.addEventListener('click', function (e) {
    // Disable button to prevent multiple clicks.
    e.target.setAttribute('disabled', 'disabled');

    // Show loading icon.
    const spinner = showLoader();
    e.target.insertAdjacentElement('afterend', spinner);

    // Prepare request.
    const jsonData = document.getElementById('loop-events-json').files[0];
    const formData = new FormData();
    formData.append('action', 'loop_events_settings');
    formData.append('nonce', nonce.value);
    formData.append('events', jsonData);

    // Send request and handle response.
    fetch(ajaxurl, {
      method: 'POST',
      'body': formData
    })
      .then((response) => response.json())
      .then((res) => {
        // Remove loading icon.
        e.target.parentNode.removeChild(spinner);
        // Re-enable button.
        e.target.removeAttribute('disabled');
        // Show results.
        const badge = showResults(res.success, res.data.results);
        e.target.insertAdjacentElement('afterend', badge);
        // Hide shown result badge.
        setTimeout(function () {
          e.target.parentNode.removeChild(badge);
        }, 500);
      });
  });

  // Shows loading icon.
  function showLoader() {
    const loader = document.createElement('div');
    loader.className = 'loop-events-loader';
    return loader;
  }


  // Shows result as a badge and message.
  function showResults(status, text) {
    const badge = document.createElement('div');
    badge.className = status ? 'loop-event-badge-success' : 'loop-event-badge-error';
    badge.textContent = text;
    return badge;
  }
});
