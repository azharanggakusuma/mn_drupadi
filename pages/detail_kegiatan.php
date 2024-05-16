<?php
include "../conn.php";

date_default_timezone_set('Asia/Jakarta');
$tanggal = date('Y-m-d H:i:s');
$ip = $_SERVER['REMOTE_ADDR'];
$browser = $_SERVER['HTTP_USER_AGENT'];
$halaman = $_SERVER['PHP_SELF'];

$query = "INSERT INTO tb_pengunjung (tanggal, ip, browser, halaman) VALUES ('$tanggal', '$ip', '$browser', '$halaman')";
$pengunjung = mysqli_query($conn, $query);

// Function to extract YouTube video ID from URL
function getYoutubeVideoId($url)
{
  $parsed_url = parse_url($url);
  if (isset($parsed_url['query'])) {
    parse_str($parsed_url['query'], $query_params);
    if (isset($query_params['v'])) {
      return $query_params['v'];
    }
  }

  // Check if it's in the format "https://www.youtube.com/embed/VIDEO_ID"
  if (preg_match('/\/embed\/([^\/]+)/', $url, $matches)) {
    return $matches[1];
  }

  // Check if it's a regular watch URL like "https://www.youtube.com/watch?v=VIDEO_ID"
  if (preg_match('/\/watch\?v=([^\/]+)/', $url, $matches)) {
    return $matches[1];
  }

  // Check if it's in the format "https://youtu.be/VIDEO_ID"
  if (preg_match('/youtu\.be\/([^\/?]+)/', $url, $matches)) {
    return $matches[1];
  }

  // If not matched, return false
  return false;
}

// Periksa apakah parameter id_kegiatan ada dalam URL
if (isset($_GET['id_kegiatan'])) {
  // Ambil id_kegiatan dari URL
  $id_kegiatan = $_GET['id_kegiatan'];

  // Query untuk mendapatkan informasi kegiatan berdasarkan id_kegiatan
  $query = "SELECT * FROM tb_kegiatan WHERE id_kegiatan = '$id_kegiatan'";
  $result = mysqli_query($conn, $query);

  // Periksa apakah kegiatan ditemukan
  if (mysqli_num_rows($result) > 0) {
    $kegiatan = mysqli_fetch_assoc($result);
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="shortcut icon" href="../assets/img/drupadi.ico" type="image/x-icon">
      <title>Detail Kegiatan</title>

      <!-- Tailwind CSS -->
      <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" type="text/css" />

      <!-- Daisy UI -->
      <link href="https://cdn.jsdelivr.net/npm/daisyui@4.6.0/dist/full.min.css" rel="stylesheet" type="text/css" />

      <!-- Animate CSS -->
      <link href="https://cdn.jsdelivr.net/npm/animate.css@4.1.1/animate.min.css" rel="stylesheet">

      <!-- Library AOS -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">

      <!-- JQuery -->
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

      <style>
        .navbar {
          z-index: 1;
          /* Set a higher z-index */
        }

        /* Responsive iframe container */
        .iframe-container {
          position: relative;
          overflow: hidden;
          padding-top: 56.25%;
          /* 16:9 aspect ratio */
          z-index: 0;
        }

        .iframe-container iframe {
          position: absolute;
          top: 0;
          left: 0;
          width: 100%;
          height: 100%;
        }

        #loading {
          position: fixed;
          top: 50%;
          left: 50%;
          transform: translate(-50%, -50%);
          z-index: 9999;
          /* Pastikan z-index lebih tinggi dari konten lain */
        }

        .justify {
          text-align: justify;
          text-justify: inter-word;
          /* Untuk mendapatkan tampilan teks yang rapih */
        }
      </style>

      <script src="./node_modules/preline/dist/preline.js"></script>
    </head>

    <body>
      <div id="app" class="hidden animate__animated animate__fadeIn animate__delay-0.5s">
        <!-- Start Navbar -->
        <?php include "components/navbar.php" ?>
        <!-- End Navbar -->

        <br><br><br>

        <!-- Start Hero -->
        <?php include "components/hero_detail_kegiatan.php" ?>
        <!-- End Hero -->

        <div class="bg-gray-100 min-h-screen flex items-center justify-center">

          <!-- Blog Article -->
          <?php include "components/blog_article.php" ?>
          <!-- End Blog Article -->

          <!-- Start Footer -->
          <?php include "components/footer.php" ?>
          <!-- End Footer -->
        </div>

        <!-- Start Loading -->
        <?php include "../components/loading.php" ?>
        <!-- End Loading -->

    </body>

    </html>

    <?php
  } else {
    echo "Kegiatan tidak ditemukan.";
  }
} else {
  echo "Parameter id_kegiatan tidak ditemukan dalam URL.";
}
?>