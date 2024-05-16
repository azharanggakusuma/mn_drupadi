<div id="kegiatan" class="bg-gray-100 min-h-screen flex items-center justify-center" data-aos="fade-up"
  data-aos-duration="1000" data-aos-delay="200">
  <div class="container mx-auto p-8">
    <div class="text-center mb-4 mt-4">
      <h2 class="text-2xl font-bold md:text-2xl md:leading-tight dark:text-white">Modul Nusantara</h2>
      <hr class="mt-2 border-t-2 border-blue-500 mx-auto w-16" />
    </div>

    <div class="p-4 flex justify-between items-center mb-1">
      <h2 class="text-xl font-semibold text-dark -ml-2"></h2>
      <div class="flex items-center space-x-8">
        <a href="pages/kegiatan.php" class="group mt-4 inline-flex items-center gap-1 text-sm font-medium text-blue-600">
          Lihat Kegiatan Lainnya
          <span aria-hidden="true" class="block transition-all group-hover:ms-0.5 rtl:rotate-180">&rarr;</span>
        </a>
      </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
      <?php
      $counter = 0; // Inisialisasi counter
      foreach ($dataKegiatan as $data) {
        if ($counter >= 12) {
          break; // Keluar dari loop jika sudah mencapai maksimal 3 artikel
        }
        ?>
        <article class="overflow-hidden rounded-lg border border-gray-100 bg-white shadow-sm">
          <div class="relative overflow-hidden">
            <img alt="" src="admin/dist/uploads/<?php echo $data['gambar_kegiatan'] ?>"
              class="h-56 w-full object-cover" />
            <span
              class="absolute top-0 end-0 rounded-se-xl rounded-es-xl text-xs font-medium bg-gray-800 text-white py-1.5 px-3 dark:bg-gray-900">
              <?php echo $data['lokasi_kegiatan'] ?>
            </span>
          </div>

          <div class="p-4 sm:p-6">
            <div class="flex justify-between items-center mb-1">
              <span class="block text-xs text-gray-500">
                <?php
                // Mengasumsikan $data['tanggal_kegiatan'] berisi tanggal dalam format YYYY-MM-DD
                $bulan = [
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
                ];

                $tanggal_kegiatan = new DateTime($data['tanggal_kegiatan']);
                $day = $tanggal_kegiatan->format('d');
                $month = $bulan[intval($tanggal_kegiatan->format('m'))];
                $year = $tanggal_kegiatan->format('Y');

                $formatted_date = $day . ' ' . $month . ' ' . $year;
                echo $formatted_date;
                ?>
              </span>

              <!--<div class="flex justify-end">
                    <strong
                      class="-mb-[2px] -me-[2px] inline-flex items-center gap-1 rounded-ee-xl rounded-ss-xl bg-blue-600 px-2 py-1 text-white">
                      <span class="text-xs font-medium sm:text-xs">
                        <?php //echo $data['lokasi_kegiatan'] ?>
                      </span>
                    </strong>
                  </div>-->
            </div>
            <a href="#">
              <h3 class="text-xl font-bold text-gray-800 group-hover:text-gray-600 dark:text-gray-200">
                <?php echo $data['judul_kegiatan'] ?>
              </h3>
            </a>

            <p class="mt-2 line-clamp-3 text-sm/relaxed text-gray-500">
              <?php echo $data['deskripsi_kegiatan'] ?>
            </p>

            <a href="pages/detail_kegiatan.php?id_kegiatan=<?php echo $data['id_kegiatan']; ?>"
              class="group mt-4 inline-flex items-center gap-1 text-sm font-medium text-blue-600">
              Lihat Selengkapnya
              <span aria-hidden="true" class="block transition-all group-hover:ms-0.5 rtl:rotate-180">&rarr;</span>
            </a>
          </div>
        </article>
        <?php
        $counter++; // Increment counter setiap kali satu artikel ditampilkan
      }
      ?>
    </div>
  </div>
</div>