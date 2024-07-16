<?php
include 'config.php';

if (isset($_GET['id_user'])) {
  $id = $_GET['id_user'];
  $cek = mysqli_query($koneksi, "SELECT * FROM tb_transaksi WHERE admin='$id'");

  if (mysqli_num_rows($cek) == 0) {
    $query = mysqli_query($koneksi, "DELETE FROM tb_user WHERE id_user='$id'");
    if ($query) {
      echo '<script>alert("Berhasil menghapus data."); location.href="index.php?page=admin";</script>';
    } else {
      echo '<script>alert("Gagal menghapus data."); location.href="index.php?page=admin";</script>';
    }
  } else {
    echo '<script>alert("Admin ini Pernah Melakukan Transaksi."); location.href="index.php?page=admin";</script>';
  }
}
