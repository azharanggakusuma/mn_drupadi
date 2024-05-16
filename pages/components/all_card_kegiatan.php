<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mt-10" id="kegiatanContainer">
  <?php foreach ($result as $row) { ?>
    <article class="overflow-hidden rounded-lg border border-gray-100 bg-white shadow-sm kegiatan-card"
      data-penulis="<?php echo $row['penulis']; ?>" data-lokasi="<?php echo $row['lokasi_kegiatan']; ?>"
      data-tanggal="<?php echo $row['tanggal_kegiatan']; ?>" data-judul="<?php echo $row['judul_kegiatan']; ?>">
      <div class="relative overflow-hidden">
        <img alt="" src="../admin/dist/uploads/<?php echo $row['gambar_kegiatan'] ?>" class="h-56 w-full object-cover" />
        <span
          class="absolute top-0 end-0 rounded-se-xl rounded-es-xl text-xs font-medium bg-gray-800 text-white py-1.5 px-3 dark:bg-gray-900">
          <?php echo $row['lokasi_kegiatan'] ?>
        </span>
      </div>
      <div class="p-4 sm:p-6">
        <div class="flex justify-between items-center mb-1">
          <span class="block text-xs text-gray-500">
            <?php $formatted_date = date_indonesia($row['tanggal_kegiatan']);
            echo $formatted_date; ?>
          </span>
        </div>
        <a href="#">
          <h3 class="text-xl font-bold text-gray-800 group-hover:text-gray-600 dark:text-gray-200">
            <?php echo $row['judul_kegiatan']; ?>
          </h3>
        </a>
        <p class="mt-2 line-clamp-3 text-sm/relaxed text-gray-500">
          <?php echo $row['deskripsi_kegiatan']; ?>
        </p>
        <a href="detail_kegiatan.php?id_kegiatan=<?php echo $row['id_kegiatan']; ?>"
          class="group mt-4 inline-flex items-center gap-1 text-sm font-medium text-blue-600">
          Lihat Selengkapnya
          <span aria-hidden="true" class="block transition-all group-hover:ms-0.5 rtl:rotate-180">
            &rarr;
          </span>
        </a>
      </div>
    </article>
  <?php } ?>
</div>