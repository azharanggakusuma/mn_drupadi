<?php
session_start();
include("../../../conn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);
  $hashed_password = md5($password);

  // Periksa apakah username sudah ada dalam database
  $check_query = "SELECT * FROM tb_login WHERE username = '$username'";
  $check_result = $conn->query($check_query);

  if ($check_result->num_rows > 0) {
    // Username sudah ada, tampilkan pesan kesalahan
    echo json_encode(['status' => 'error', 'message' => 'Username already exists.']);
    exit();
  } else {
    // Username belum ada, tambahkan ke database
    $insert_query = "INSERT INTO tb_login (fullname, username, password) VALUES ('$fullname', '$username', '$hashed_password')";
    if ($conn->query($insert_query) === TRUE) {
      // Registrasi berhasil
      echo json_encode(['status' => 'success', 'message' => 'Registration successful. You can now login.']);
      exit();
    } else {
      // Gagal menambahkan pengguna ke database
      echo json_encode(['status' => 'error', 'message' => 'Registration failed. Please try again later.']);
      exit();
    }
  }
}
?>