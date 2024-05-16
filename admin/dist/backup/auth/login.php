<?php
session_start();
include("../../../conn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);
  $hashed_password = md5($password);

  $query = "SELECT * FROM tb_login WHERE username = '$username' AND password = '$hashed_password'";
  $result = $conn->query($query);

  if ($result->num_rows == 1) {
    // Login berhasil
    $_SESSION['username'] = $username;
    $_SESSION['login_success'] = true;
    echo json_encode(['status' => 'success', 'message' => 'Welcome to the Dashboard!']);
    exit();
  } else {
    // Login gagal
    $_SESSION['login_error'] = true;
    echo json_encode(['status' => 'error', 'message' => 'Invalid username or password']);
    exit();
  }
}
?>