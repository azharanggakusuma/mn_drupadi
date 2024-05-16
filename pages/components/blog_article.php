<div class="max-w-3xl px-4 pt-6 lg:pt-10 pb-12 sm:px-6 lg:px-8 mx-auto">
  <div class="container mx-auto p-4 max-w-2xl">
    <!-- Avatar Media -->
    <div class="flex justify-between items-center mb-6">
      <div class="flex w-full sm:items-center gap-x-5 sm:gap-x-3">
        <div class="flex-shrink-0">
          <img class="h-12 w-12 rounded-full" src="img/people.png" alt="Image Description">
        </div>

        <div class="grow">
          <div class="flex justify-between items-center gap-x-2">
            <div>
              <!-- Penulis -->
              <div class="hs-tooltip inline-block [--trigger:hover] [--placement:bottom]">
                <div class="hs-tooltip-toggle sm:mb-1 block text-start cursor-pointer">
                  <?php
                  $penulis = $kegiatan['penulis'];
                  // Periksa apakah penulis adalah Azharangga Kusuma atau Arya Gunawan
                  $isAzharanggaKusuma = ($penulis === 'Azharangga Kusuma');
                  $isAryaGunawan = ($penulis === 'Arya Gunawan');
                  ?>
                  <span class="text-sm flex items-center">
                    <span class="font-semibold text-gray-800 dark:text-gray-200 mr-0.5">
                      <?php echo $penulis ?>
                    </span>
                    <?php if ($isAzharanggaKusuma || $isAryaGunawan): ?>
                      <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mt-0.5" viewBox="-2.4 -2.4 28.80 28.80">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                          <rect width="24" height="24" fill="none"></rect>
                          <path fill="#2563EB" fill-rule="evenodd" clip-rule="evenodd"
                            d="M9.55879 3.6972C10.7552 2.02216 13.2447 2.02216 14.4412 3.6972L14.6317 3.96387C14.8422 4.25867 15.1958 4.41652 15.5558 4.37652L16.4048 4.28218C18.3156 4.06988 19.9301 5.68439 19.7178 7.59513L19.6235 8.44415C19.5835 8.8042 19.7413 9.15774 20.0361 9.36831L20.3028 9.55879C21.9778 10.7552 21.9778 13.2447 20.3028 14.4412L20.0361 14.6317C19.7413 14.8422 19.5835 15.1958 19.6235 15.5558L19.7178 16.4048C19.9301 18.3156 18.3156 19.9301 16.4048 19.7178L15.5558 19.6235C15.1958 19.5835 14.8422 19.7413 14.6317 20.0361L14.4412 20.3028C13.2447 21.9778 10.7553 21.9778 9.55879 20.3028L9.36831 20.0361C9.15774 19.7413 8.8042 19.5835 8.44414 19.6235L7.59513 19.7178C5.68439 19.9301 4.06988 18.3156 4.28218 16.4048L4.37652 15.5558C4.41652 15.1958 4.25867 14.8422 3.96387 14.6317L3.6972 14.4412C2.02216 13.2447 2.02216 10.7553 3.6972 9.55879L3.96387 9.36831C4.25867 9.15774 4.41652 8.8042 4.37652 8.44414L4.28218 7.59513C4.06988 5.68439 5.68439 4.06988 7.59513 4.28218L8.44415 4.37652C8.8042 4.41652 9.15774 4.25867 9.36831 3.96387L9.55879 3.6972ZM15.7071 9.29289C16.0976 9.68342 16.0976 10.3166 15.7071 10.7071L11.8882 14.526C11.3977 15.0166 10.6023 15.0166 10.1118 14.526L8.29289 12.7071C7.90237 12.3166 7.90237 11.6834 8.29289 11.2929C8.68342 10.9024 9.31658 10.9024 9.70711 11.2929L11 12.5858L14.2929 9.29289C14.6834 8.90237 15.3166 8.90237 15.7071 9.29289Z" />
                        </g>
                      </svg>
                    <?php endif; ?>
                </div>
                </span>
              </div>
              <!-- End Penulis -->

              <ul class="text-xs text-gray-500">
                <li
                  class="inline-block relative pe-6 last:pe-0 last-of-type:before:hidden before:absolute before:top-1/2 before:end-2 before:-translate-y-1/2 before:w-1 before:h-1 before:bg-gray-300 before:rounded-full dark:text-gray-400 dark:before:bg-gray-600">
                  <?php
                  // Tanggal pembuatan blog (misalnya disimpan dalam $tanggal_pembuatan)
                  $tanggal_pembuatan = strtotime($kegiatan['created_at']);

                  // Waktu sekarang
                  $waktu_sekarang = time();

                  // Hitung selisih waktu dalam detik
                  $selisih_detik = $waktu_sekarang - $tanggal_pembuatan;

                  // Konversi selisih detik menjadi menit
                  $selisih_menit = floor($selisih_detik / 60);

                  // Array nama bulan dalam bahasa Indonesia
                  $bulan = array(
                    1 => "Januari",
                    2 => "Februari",
                    3 => "Maret",
                    4 => "April",
                    5 => "Mei",
                    6 => "Juni",
                    7 => "Juli",
                    8 => "Agustus",
                    9 => "September",
                    10 => "Oktober",
                    11 => "November",
                    12 => "Desember"
                  );

                  // Logika untuk menentukan teks yang akan ditampilkan
                  if ($selisih_menit < 1) {
                    $teks_waktu = 'Beberapa saat yang lalu';
                  } elseif ($selisih_menit < 60) {
                    $teks_waktu = $selisih_menit . ' menit yang lalu';
                  } elseif ($selisih_menit < (24 * 60)) {
                    $teks_waktu = floor($selisih_menit / 60) . ' jam yang lalu';
                  } elseif ($selisih_menit < (7 * 24 * 60)) {
                    $selisih_hari = floor($selisih_menit / (24 * 60));
                    $teks_waktu = $selisih_hari . ' hari yang lalu';
                  } elseif (date('Y-m', $tanggal_pembuatan) == date('Y-m')) {
                    // Jika tanggal di bulan ini
                    $teks_waktu = date('j', $tanggal_pembuatan) . ' ' . $bulan[date('n', $tanggal_pembuatan)];
                  } elseif (date('Y', $tanggal_pembuatan) == date('Y')) {
                    // Jika tanggal di tahun ini
                    $teks_waktu = date('j', $tanggal_pembuatan) . ' ' . $bulan[date('n', $tanggal_pembuatan)];
                  } else {
                    // Jika tanggal di tahun sebelumnya
                    $teks_waktu = date('j', $tanggal_pembuatan) . ' ' . $bulan[date('n', $tanggal_pembuatan)] . ' ' . date('Y', $tanggal_pembuatan);
                  }

                  echo $teks_waktu;
                  ?>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End Avatar Media -->

    <!-- Content -->
    <div class="space-y-5 md:space-y-8 mt-8">
      <div class="space-y-3">
        <h2 class="text-3xl font-bold md:text-3xl dark:text-white">
          <?php echo $kegiatan['judul_kegiatan'] ?>
        </h2>
        <span
          class="text-xs text-gray-500 inline-block relative pe-6 last:pe-0 last-of-type:before:hidden before:absolute before:top-1/2 before:end-2 before:-translate-y-1/2 before:w-1 before:h-1 before:bg-gray-300 before:rounded-full dark:text-gray-400 dark:before:bg-gray-600">
          <?php
          // Ambil nilai tanggal dari $kegiatan['tanggal_kegiatan']
          $tanggal_kegiatan = $kegiatan['tanggal_kegiatan'];

          // Ubah format tanggal
          $tanggal_format = date("d F Y", strtotime($tanggal_kegiatan));

          // Daftar nama bulan dalam bahasa Indonesia
          $bulan_array = array(
            'January' => 'Januari',
            'February' => 'Februari',
            'March' => 'Maret',
            'April' => 'April',
            'May' => 'Mei',
            'June' => 'Juni',
            'July' => 'Juli',
            'August' => 'Agustus',
            'September' => 'September',
            'October' => 'Oktober',
            'November' => 'November',
            'December' => 'Desember'
          );

          // Ubah nama bulan dalam format tanggal
          $tanggal_format = strtr($tanggal_format, $bulan_array);
          ?>
          Tanggal: <?php echo $tanggal_format; ?>
        </span>
      </div>

      <figure>
        <img class="w-full object-cover rounded-xl"
          src="../admin/dist/uploads/<?php echo $kegiatan['gambar_kegiatan'] ?>" alt="">
        <figcaption class="mt-3 text-sm text-center text-gray-500">
          (Lokasi:
          <?php echo $kegiatan['lokasi_kegiatan'] ?>)
        </figcaption>
      </figure>

      <div class="max-w-2xl mx-auto">
        <h2 class="text-3xl font-semibold text-gray-800 dark:text-white mb-4">
          Deskripsi Kegiatan
        </h2>

        <p class="text-lg text-gray-700 dark:text-gray-300 mb-6 leading-relaxed font-sans">
          <?php echo $kegiatan['deskripsi_kegiatan']; ?>
        </p>
      </div>

      <h2 class="text-3xl font-semibold text-gray-800 dark:text-white mb-4">
        Dokumentasi Kegiatan
      </h2>

      <?php if (!empty($kegiatan['dokumentasi_kegiatan'])): ?>
        <figure class="w-full object-cover rounded-xl">
          <?php
          // Check if the YouTube video URL is available
          $video_id = getYoutubeVideoId($kegiatan['dokumentasi_kegiatan']);

          if ($video_id) {
            // Embed the YouTube video using an iframe
            echo '<div class="iframe-container">';
            echo '<iframe width="560" height="315" src="https://www.youtube.com/embed/' . $video_id . '" frameborder="0" allowfullscreen></iframe>';
            echo '</div>';
          } else {
            echo 'Kesalahan URL.';
          }
          ?>
          <figcaption class="mt-3 text-sm text-center text-gray-500">
            (Dokumentasi Kegiatan)
          </figcaption>
        </figure>
      <?php else: ?>
        <p class="text-gray-500">Tidak ada dokumentasi yang tersedia untuk kegiatan ini.</p>
      <?php endif; ?>

      <div></div>
      <h2 class="text-3xl font-semibold text-gray-800 dark:text-white mb-4">
        Status Log Book
      </h2>
      <?php
      switch ($kegiatan['status_logbook']) {
        case 'In Progress':
          echo '<span class="py-1 px-1.5 inline-flex items-center gap-x-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full dark:bg-blue-500/10 dark:text-blue-500">
                        <svg class="flex-shrink-0 w-3 h-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" x2="12" y1="2" y2="6"/><line x1="12" x2="12" y1="18" y2="22"/><line x1="4.93" x2="7.76" y1="4.93" y2="7.76"/><line x1="16.24" x2="19.07" y1="16.24" y2="19.07"/><line x1="2" x2="6" y1="12" y2="12"/><line x1="18" x2="22" y1="12" y2="12"/><line x1="4.93" x2="7.76" y1="19.07" y2="16.24"/><line x1="16.24" x2="19.07" y1="7.76" y2="4.93"/></svg>
                        In Progress
                      </span>';
          break;

        case 'Completed':
          echo '<span class="py-1 px-1.5 inline-flex items-center gap-x-1 text-xs font-medium bg-green-100 text-green-800 rounded-full dark:bg-green-500/10 dark:text-green-500">
                        <svg class="flex-shrink-0 w-3 h-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                          <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                          <polyline points="22 4 12 14.01 9 11.01" />
                        </svg>
                        Completed
                      </span>';
          break;

        case 'Pending':
          echo '<span class="py-1 px-1.5 inline-flex items-center gap-x-1 text-xs font-medium bg-yellow-100 text-yellow-800 rounded-full dark:bg-yellow-500/10 dark:text-yellow-500">
                        <svg class="flex-shrink-0 w-3 h-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                          <circle cx="12" cy="12" r="10" />
                          <line x1="12" y1="8" x2="12" y2="12" />
                          <line x1="12" y1="16" x2="12" y2="16" />
                        </svg>
                        Pending
                      </span>';
          break;

        case 'Not Started':
          echo '<span class="py-1 px-1.5 inline-flex items-center gap-x-1 text-xs font-medium bg-red-100 text-red-800 rounded-full dark:bg-red-500/10 dark:text-red-500">
                        <svg class="flex-shrink-0 w-3 h-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                          <path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z" />
                          <path d="M12 9v4" />
                          <path d="M12 17h.01" />
                        </svg>
                        Not Started
                      </span>';
          break;

        case 'Nothing':
          echo '<span class="py-1 px-2 inline-flex items-center gap-x-1 text-xs bg-gray-100 text-gray-800 rounded-full dark:bg-slate-500/20 dark:text-slate-400">
  <svg class="flex-shrink-0 size-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18.36 6.64a9 9 0 1 1-12.73 0"/><line x1="12" x2="12" y1="2" y2="12"/></svg>
  Nothing
</span>';
          break;

        default:
          break;
      }
      ?>
    </div>
  </div>
  <!-- End Content -->
</div>
</div>