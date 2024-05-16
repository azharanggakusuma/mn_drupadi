<?php
include "../conn.php";

// Ambil data kegiatan dari database
$sql = "SELECT * FROM tb_kegiatan";
$result = mysqli_query($conn, $sql);

// Mengambil daftar penulis, lokasi, tanggal, dan judul unik dari data kegiatan
$authors = [];
$locations = [];
$dates = [];
$titles = [];
foreach ($result as $row) {
  $authors[] = $row['penulis'];
  $locations[] = $row['lokasi_kegiatan'];
  $dates[] = $row['tanggal_kegiatan'];
  $titles[] = $row['judul_kegiatan'];
}
$authors = array_unique($authors);
$locations = array_unique($locations);
$dates = array_unique($dates);
$titles = array_unique($titles);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="../assets/img/drupadi.ico" type="image/x-icon">
  <title>Modul Nusantara</title>

  <!-- Daisy UI -->
  <link href="https://cdn.jsdelivr.net/npm/daisyui@4.6.0/dist/full.min.css" rel="stylesheet" type="text/css" />
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Animate CSS -->
  <link href="https://cdn.jsdelivr.net/npm/animate.css@4.1.1/animate.min.css" rel="stylesheet">

  <!-- Library AOS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">

  <!-- JQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script src="./node_modules/preline/dist/preline.js"></script>

  <style>
    #loading {
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      z-index: 9999;
      /* Pastikan z-index lebih tinggi dari konten lain */
    }
  </style>
</head>

<body>
  <div id="app" class="hidden animate__animated animate__fadeIn animate__delay-0.5s">
    <!-- Start Navbar -->
    <?php include "components/navbar.php" ?>
    <!-- End Navbar -->

    <br><br><br>

    <!-- Start Hero -->
    <?php include "components/hero_kegiatan.php" ?>
    <!-- End Hero -->

    <div class="bg-gray-100 min-h-screen flex items-center justify-center">
      <div class="container mx-auto p-8 mt-10 mb-10">
        <!-- Start Filter -->
        <?php include "components/filter.php" ?>
        <!-- End Filter -->

        <!-- Start Kegiatan -->
        <?php include "components/all_card_kegiatan.php" ?>
        <!-- Start Kegiatan -->
      </div>
    </div>

    <?php
    function date_indonesia($date)
    {
      $dateObj = date_create($date);
      $formatter = new IntlDateFormatter('id_ID', IntlDateFormatter::LONG, IntlDateFormatter::NONE); // Mengubah format menjadi LONG
      $formatter->setPattern('d MMMM YYYY'); // Menghilangkan hari dari format
      return $formatter->format($dateObj);
    }
    ?>

    <script src="https://cdn.jsdelivr.net/npm/dayjs@1.10.6/dayjs.min.js"></script>
    <script>
      const formatDate = (date) => {
        return dayjs(date).locale('id').format('DD MMMM YYYY');
      };

      const penulisDropdown = document.getElementById('penulis');
      const lokasiDropdown = document.getElementById('lokasi');
      const tanggalDropdown = document.getElementById('tanggal');
      const judulDropdown = document.getElementById('judul');
      const kegiatanCards = document.querySelectorAll('.kegiatan-card');

      penulisDropdown.addEventListener('change', filterKegiatan);
      lokasiDropdown.addEventListener('change', filterKegiatan);
      tanggalDropdown.addEventListener('change', filterKegiatan);
      judulDropdown.addEventListener('change', filterKegiatan);

      function filterKegiatan() {
        const selectedPenulis = penulisDropdown.value;
        const selectedLokasi = lokasiDropdown.value;
        const selectedTanggal = tanggalDropdown.value;
        const selectedJudul = judulDropdown.value;

        kegiatanCards.forEach(card => {
          const cardPenulis = card.getAttribute('data-penulis');
          const cardLokasi = card.getAttribute('data-lokasi');
          const cardTanggal = card.getAttribute('data-tanggal');
          const cardJudul = card.getAttribute('data-judul');

          const shouldShow = (selectedPenulis === '' || selectedPenulis === cardPenulis) &&
            (selectedLokasi === '' || selectedLokasi === cardLokasi) &&
            (selectedTanggal === '' || selectedTanggal === cardTanggal) &&
            (selectedJudul === '' || selectedJudul === cardJudul);

          card.style.display = shouldShow ? 'block' : 'none';
        });
      }
    </script>

    <!-- Start Footer -->
    <?php include "components/footer.php" ?>
    <!-- End Footer -->

  </div>

  <!-- Start Loading -->
  <?php include "../components/loading.php" ?>
  <!-- End Loading -->
</body>

</html>