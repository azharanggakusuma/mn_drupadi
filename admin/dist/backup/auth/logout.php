<?php
session_start();

// Hapus cookie yang menandai tur telah ditampilkan
if (isset($_COOKIE['tour_shown'])) {
  setcookie('tour_shown', '', time() - 3600, "/");
}

// Hapus semua data sesi
session_destroy();

// Redirect ke halaman login
header("location: form_login.php");
exit();
?>