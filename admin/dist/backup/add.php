<?php
include '../../conn.php';

$response = array(); // Create an associative array for the response

if ($_POST) {
  $file_upload = $_FILES['gambar_kegiatan'];
  if ($file_upload['name'] != "") {
    $penulis = $_POST['penulis'];
    $judul_kegiatan = $_POST['judul_kegiatan'];
    $tanggal_kegiatan = $_POST['tanggal_kegiatan'];
    $lokasi_kegiatan = $_POST['lokasi_kegiatan'];
    $deskripsi_kegiatan = $_POST['deskripsi_kegiatan'];
    $dokumentasi_kegiatan = $_POST['dokumentasi_kegiatan'];
    $status_logbook = $_POST['status_logbook'];
    $gambar_kegiatan = $file_upload['name'];

    $result = mysqli_query($conn, "INSERT INTO tb_kegiatan(penulis, judul_kegiatan, tanggal_kegiatan, lokasi_kegiatan, deskripsi_kegiatan, dokumentasi_kegiatan, status_logbook, gambar_kegiatan) VALUES('$penulis', '$judul_kegiatan', '$tanggal_kegiatan', '$lokasi_kegiatan', '$deskripsi_kegiatan', '$dokumentasi_kegiatan', '$status_logbook', '$gambar_kegiatan')");

    if ($result) {
      move_uploaded_file($file_upload['tmp_name'], "uploads/" . $gambar_kegiatan);
      $response['status'] = 'success';
      $response['message'] = 'Data added successfully!';
    } else {
      $response['status'] = 'error';
      $response['message'] = 'Failed to add data!';
    }
  }
}

// Return the JSON response
header('Content-Type: application/json');
echo json_encode($response);
exit;
?>