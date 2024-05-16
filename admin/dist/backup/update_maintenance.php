<?php
include "../../conn.php";

// Ambil nilai saat ini dari database
$queryCurrentStatus = "SELECT status_maintenance FROM tb_maintenance";
$resultCurrentStatus = mysqli_query($conn, $queryCurrentStatus);

if ($resultCurrentStatus) {
  $row = mysqli_fetch_assoc($resultCurrentStatus);
  $currentMaintenanceStatus = $row['status_maintenance'];

  // Tentukan nilai baru untuk status berdasarkan nilai saat ini
  $newMaintenanceStatus = ($currentMaintenanceStatus == 1) ? 0 : 1;

  // Update nilai status
  $queryUpdate = "UPDATE tb_maintenance SET status_maintenance = $newMaintenanceStatus";
  $resultUpdate = mysqli_query($conn, $queryUpdate);

  if ($resultUpdate) {
    echo "Maintenance status changed successfully.";
  } else {
    echo "Failed to change maintenance status.";
  }
} else {
  echo "Failed to get current value.";
}

// Tutup koneksi
mysqli_close($conn);
?>