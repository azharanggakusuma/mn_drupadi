<?php
include "conn.php";

// Ambil nilai saat ini dari database
$queryCurrentStatus = "SELECT status_maintenance FROM tb_maintenance";
$resultCurrentStatus = mysqli_query($conn, $queryCurrentStatus);

if ($resultCurrentStatus) {
  $row = mysqli_fetch_assoc($resultCurrentStatus);
  $currentMaintenanceStatus = $row['status_maintenance'];

  // Cek apakah maintenance mode aktif (nilai = 0 atau true)
  if ($currentMaintenanceStatus == 0) {
    header("Location: index.php"); // Redirect ke index.php
    exit();
  }
} else {
  echo "Gagal mendapatkan nilai saat ini: " . mysqli_error($conn);
}

// Tutup koneksi
mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/img/logo-pmm-2.png" type="image/x-icon">
    <title>Maintenance</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-white dark:bg-gray-900">

    <div class="flex flex-col justify-center items-center h-screen">
        <div class="mb-5 max-w-md">
            <img src="assets/img/maintenance.svg" alt="maintenance image" width="250px">
        </div>
        <div class="text-center max-w-2xl">
            <h1 class="mb-3 text-2xl font-bold leading-tight text-gray-900 sm:text-4xl lg:text-5xl dark:text-white">
                Maintenance
            </h1>
            <p class="mb-5 text-base font-normal text-gray-500 md:text-lg dark:text-gray-400">
                Maaf, halaman ini sedang dalam perawatan untuk meningkatkan kualitas layanan kami.
                Kami berupaya keras untuk segera mengembalikan halaman ini ke dalam kondisi yang lebih baik.
                Silakan kembali lagi nanti. Terima kasih atas kesabaran dan pengertian Anda.
            </p>
            <!--
            <button class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 inline-flex items-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800"
                onclick="goBack()">
                <svg class="mr-2 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                        clip-rule="evenodd"></path>
                </svg>
                Kembali
            </button>
            -->
        </div>
    </div>

    <script>
        /*
        function goBack() {
            window.history.back();
        }*/
    </script>

</body>

</html>
