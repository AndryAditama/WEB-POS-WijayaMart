<?php
include("koneksi.php");
$query = mysqli_query($koneksi, "DELETE FROM tb_keranjang");
if ($query) {
    echo '<script>location.href="index.php?page=transaksi";</script>';
} else {
    echo '<script>alert("Gagal menghapus data."); location.href="index.php?page=transaksi";</script>';
}
