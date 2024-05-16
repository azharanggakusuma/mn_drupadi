<?php
include "conn.php";

$sql = "SELECT * FROM tb_kegiatan";
$dataKegiatan = mysqli_query($conn, $sql);

date_default_timezone_set('Asia/Jakarta');
$tanggal = date('Y-m-d H:i:s');
$ip = $_SERVER['REMOTE_ADDR'];
$browser = $_SERVER['HTTP_USER_AGENT'];
$halaman = $_SERVER['PHP_SELF'];

$query = "INSERT INTO tb_pengunjung (tanggal, ip, browser, halaman) VALUES ('$tanggal', '$ip', '$browser', '$halaman')";
$pengunjung = mysqli_query($conn, $query);

// Periksa nilai tb_maintenance
$result = mysqli_query($conn, "SELECT status_maintenance FROM tb_maintenance LIMIT 1");

if ($result) {
  $row = mysqli_fetch_assoc($result);
  $maintenanceMode = $row['status_maintenance'];

  // Cek apakah maintenanceMode adalah false
  if ($maintenanceMode) {
    header("Location: maintenance.php"); // Arahkan ke halaman maintenance
    exit();
  }
} else {
  echo "Gagal mendapatkan data maintenance status.";
}
?>

<!DOCTYPE html>
<html class="scroll-smooth" lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="assets/img/drupadi.ico" type="image/x-icon">
  <title>Kelompok Modul Nusantara Drupadi - PMM 4 Undiksha</title>
  <!-- Daisy UI -->
  <link href="https://cdn.jsdelivr.net/npm/daisyui@4.6.0/dist/full.min.css" rel="stylesheet" type="text/css" />
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Animate CSS -->
  <link href="https://cdn.jsdelivr.net/npm/animate.css@4.1.1/animate.min.css" rel="stylesheet">

  <!-- Library AOS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">

  <!-- Animate CSS -->
  <link href="https://cdn.jsdelivr.net/npm/animate.css@4.1.1/animate.min.css" rel="stylesheet">

  <!-- Library AOS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">

  <!-- JQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <style>
    #loading {
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      z-index: 9999;
    }

    /*.backdrop-blur {
      backdrop-filter: blur(10px);
      background-color: rgba(255, 255, 255, 0.5);
    }*/
  </style>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            inter: ['Inter', 'sans-serif'],
          },
          animation: {
            'infinite-scroll': 'infinite-scroll 100s linear infinite',
          },
          keyframes: {
            'infinite-scroll': {
              from: { transform: 'translateX(0)' },
              to: { transform: 'translateX(-100%)' },
            }
          }
        },
      },
    };
  </script>

  <script src="./node_modules/preline/dist/preline.js"></script>
</head>

<body>

  <div id="app" class="hidden animate__animated animate__fadeIn animate__delay-0.5s">
    <!-- Start Navbar -->
    <?php include "components/navbar.php" ?>
    <!-- End Navbar -->

    <br><br><br>

    <!-- Start Hero -->
    <?php include "components/hero.php" ?>
    <!-- End Hero -->

    <!-- Logo Carousel -->
    <?php include "components/carousel.php" ?>
    <!-- Logo Carousel -->

    <!-- Start About -->
    <?php include "components/about.php" ?>
    <!-- End About -->

    <!-- Start Kegiatan -->
    <?php include "components/card_kegiatan.php" ?>
    <!-- End Kegiatan -->

    <!-- Start Galery -->
    <?php include "components/galery.php" ?>
    <!-- End Galery -->

    <!-- Start Timeline -->
    <?php //include "components/timeline.php" ?>
    <!-- End Timeline -->

    <!-- FAQ -->
    <?php include "components/faq.php" ?>
    <!-- End FAQ -->

    <!-- Start Contact -->
    <?php include "components/contact.php" ?>
    <!-- End Contact -->

    <!-- Start Footer -->
    <?php include "components/footer.php" ?>
    <!-- End Footer -->
  </div>

  <!-- Start Loading -->
  <?php include "components/loading.php" ?>
  <!-- End Loading -->

  <script>
    AOS.init();
  </script>

</body>

</html>