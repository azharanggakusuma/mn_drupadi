<?php
include '../../conn.php';

$response = array(); // Buat array asosiatif untuk respons

if ($_POST) {
  // Dapatkan data yang dikirimkan melalui formulir
  $file_upload = $_FILES['gambar_kegiatan'];
  if ($file_upload['name'] != "") {
    $created_at = $_POST['created_at'];
    $penulis = $_POST['penulis'];
    $judul_kegiatan = $_POST['judul_kegiatan'];
    $tanggal_kegiatan = $_POST['tanggal_kegiatan'];
    $lokasi_kegiatan = $_POST['lokasi_kegiatan'];
    $deskripsi_kegiatan = $_POST['deskripsi_kegiatan'];
    $dokumentasi_kegiatan = $_POST['dokumentasi_kegiatan'];
    $status_logbook = $_POST['status_logbook'];
    $gambar_kegiatan = $file_upload['name'];

    // Dapatkan user_id dari sesi
    session_start();
    if (!isset($_SESSION['username'])) {
      $response['status'] = 'error';
      $response['message'] = 'User session not found!';
      header('Content-Type: application/json');
      echo json_encode($response);
      exit;
    }
    $username = $_SESSION['username'];
    $query = "SELECT id FROM tb_login WHERE username = '$username'";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $user_id = $row['id'];

      // Lakukan kueri SQL INSERT dengan menyertakan user_id
      $result = mysqli_query($conn, "INSERT INTO tb_kegiatan(created_at, user_id, penulis, judul_kegiatan, tanggal_kegiatan, lokasi_kegiatan, deskripsi_kegiatan, dokumentasi_kegiatan, status_logbook, gambar_kegiatan) VALUES('$created_at', '$user_id', '$penulis', '$judul_kegiatan', '$tanggal_kegiatan', '$lokasi_kegiatan', '$deskripsi_kegiatan', '$dokumentasi_kegiatan', '$status_logbook', '$gambar_kegiatan')");

      if ($result) {
        // Pindahkan file yang diunggah ke direktori uploads
        move_uploaded_file($file_upload['tmp_name'], "uploads/" . $gambar_kegiatan);
        $response['status'] = 'success';
        $response['message'] = 'Data added successfully!';
      } else {
        $response['status'] = 'error';
        $response['message'] = 'Failed to add data!';
      }
    } else {
      $response['status'] = 'error';
      $response['message'] = 'User not found!';
    }
  } else {
    $response['status'] = 'error';
    $response['message'] = 'No file uploaded!';
  }
} else {
  $response['status'] = 'error';
  $response['message'] = 'Invalid request!';
}

// Kembalikan respons JSON
header('Content-Type: application/json');
echo json_encode($response);
exit;
?>