<div id="loading" class="flex items-center space-x-2 hidden">
  <div aria-label="Loading..." role="status">
    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
      class="animate-spin w-16 h-16 stroke-slate-500" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
      <circle cx="50" cy="50" r="32" stroke-width="8" stroke="#000000"
        stroke-dasharray="50.26548245743669 50.26548245743669" fill="none" stroke-linecap="round">
        <animateTransform attributeName="transform" type="rotate" repeatCount="indefinite" dur="1s" keyTimes="0;1"
          values="0 50 50;360 50 50"></animateTransform>
      </circle>
    </svg>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const loadingElement = document.getElementById('loading');

    // Tampilkan loading saat halaman dimuat
    loadingElement.classList.remove('hidden');

    // Sembunyikan loading setelah halaman selesai dimuat
    window.addEventListener('load', function () {
      loadingElement.classList.add('hidden');

      // Tampilkan konten setelah loading selesai
      document.getElementById('app').classList.remove('hidden');
    });
  });
</script>