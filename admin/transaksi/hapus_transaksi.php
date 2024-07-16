<?php
include 'config.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    # code...
    $query = mysqli_query($koneksi, "DELETE FROM tb_transaksi WHERE notransaksi='$id'");
    if ($query) {
        echo '<script>alert("Berhasil menghapus data."); location.href="index.php?page=data_transaksi";</script>';
    } else {
        echo '<script>alert("Gagal menghapus data."); location.href="index.php?page=data_transaksi";</script>';
    }
}
