<?php
include "../../conn.php";

if (isset($_POST['id_kegiatan'])) {
  $id_kegiatan = $_POST['id_kegiatan'];
  $penulis = $_POST['penulis'];
  $judul_kegiatan = $_POST['judul_kegiatan'];
  $tanggal_kegiatan = $_POST['tanggal_kegiatan'];
  $lokasi_kegiatan = $_POST['lokasi_kegiatan'];
  $deskripsi_kegiatan = $_POST['deskripsi_kegiatan'];
  $dokumentasi_kegiatan = $_POST['dokumentasi_kegiatan'];
  $status_logbook = $_POST['status_logbook'];
  $gambar_kegiatan = $_POST['gambar_kegiatan'];

  $file_upload = $_FILES['gambar_kegiatan'];
  if ($file_upload['name'] != "") {
    $gambar_kegiatan = $file_upload['name'];

    $update = "UPDATE tb_kegiatan SET penulis = '$penulis', judul_kegiatan = '$judul_kegiatan', tanggal_kegiatan = '$tanggal_kegiatan', lokasi_kegiatan = '$lokasi_kegiatan', deskripsi_kegiatan = '$deskripsi_kegiatan', dokumentasi_kegiatan = '$dokumentasi_kegiatan', status_logbook = '$status_logbook', gambar_kegiatan = '$gambar_kegiatan' WHERE id_kegiatan = '$id_kegiatan'";

    move_uploaded_file($file_upload['tmp_name'], "uploads/" . $gambar_kegiatan);
  } else {
    $update = "UPDATE tb_kegiatan SET penulis = '$penulis', judul_kegiatan = '$judul_kegiatan', tanggal_kegiatan = '$tanggal_kegiatan', lokasi_kegiatan = '$lokasi_kegiatan', deskripsi_kegiatan = '$deskripsi_kegiatan', dokumentasi_kegiatan = '$dokumentasi_kegiatan', status_logbook = '$status_logbook' WHERE id_kegiatan = '$id_kegiatan'";
  }

  if (mysqli_query($conn, $update)) {
    header("Location: form_edit.php?id_kegiatan=$id_kegiatan&status=success");
    exit();
  } else {
    header("Location: form_edit.php?id_kegiatan=$id_kegiatan&status=error");
    exit();
  }
} else {
  header("Location: index.php");
  exit();
}
?>