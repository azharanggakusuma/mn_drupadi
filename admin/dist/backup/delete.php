<?php
include "../../conn.php";

if (isset($_GET['id_kegiatan'])) {
  $delete = "DELETE FROM tb_kegiatan WHERE id_kegiatan = " . $_GET['id_kegiatan'];

  mysqli_query($conn, $delete);
  header("location: index.php");
}
?>