<div class="grid grid-cols-1 gap-4 md:grid-cols-2">
  <div>
    <label for="penulis" class="block text-sm font-medium text-gray-700 mb-2">Penulis</label>
    <select name="penulis" id="penulis"
      class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
      <option value="">Semua Penulis</option>
      <?php foreach ($authors as $author) { ?>
        <option value="<?php echo $author; ?>"><?php echo $author; ?></option>
      <?php } ?>
    </select>
  </div>
  <div>
    <label for="judul" class="block text-sm font-medium text-gray-700 mb-2">Judul Kegiatan</label>
    <select name="judul" id="judul"
      class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
      <option value="">Semua Judul</option>
      <?php foreach ($titles as $title) { ?>
        <option value="<?php echo $title; ?>"><?php echo $title; ?></option>
      <?php } ?>
    </select>
  </div>
  <div>
    <label for="lokasi" class="block text-sm font-medium text-gray-700 mb-2">Lokasi Kegiatan</label>
    <select name="lokasi" id="lokasi"
      class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
      <option value="">Semua Lokasi</option>
      <?php foreach ($locations as $location) { ?>
        <option value="<?php echo $location; ?>"><?php echo $location; ?></option>
      <?php } ?>
    </select>
  </div>
  <div>
    <label for="tanggal" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Kegiatan</label>
    <select name="tanggal" id="tanggal"
      class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
      <option value="">Semua Tanggal</option>
      <?php foreach ($dates as $date) { ?>
        <option value="<?php echo $date; ?>"><?php echo date_indonesia($date); ?></option>
      <?php } ?>
    </select>
  </div>
</div>