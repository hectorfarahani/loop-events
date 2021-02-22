document.addEventListener('DOMContentLoaded', function (event) {

  const $importBtn = document.getElementById('loop-events-json-import');
  const nonce = document.getElementById('_wpnonce');

  $importBtn.addEventListener('click', function (e) {
    const jsonData = document.getElementById('loop-events-json').files[0];
    const formData = new formData();

    const spinner = showLoader();

    e.target.insertAdjacentElement('afterend', spinner);

    formData.append('action', 'loop_events_settings');
    formData.append('nonce', nonce.value);
    formData.append('events', jsonData);

    fetch(ajaxurl, {
      method: 'POST',
      'body': formData
    })
      .then((response) => response.json())
      .then((res) => {
        e.target.parentNode.removeChild(spinner);
        const badge = showResults(res.success, res.data.results);
        e.target.insertAdjacentElement('afterend', badge);
        setTimeout(function () {
          e.target.parentNode.removeChild(badge);
        }, 500);
      });
  });

  function showLoader() {
    const loader = document.createElement('div');
    loader.className = 'loop-event-loader';
    return loader;
  }

  function showResults(status, text) {
    const badge = document.createElement('div');
    badge.className = status ? 'loop-event-badge-success' : 'loop-event-badge-error';
    badge.textContent = text;
    return badge;
  }
});
