<?php
if (isset($_GET['id_barang'])) {
    $id = $_GET['id_barang'];
    # code...
    $query = mysqli_query($koneksi, "DELETE FROM tb_keranjang WHERE id_baranglaku='$id'");
    if ($query) {
        echo '<script>location.href="index.php?page=transaksi";</script>';
    } else {
        echo '<script>alert("Gagal menghapus data."); location.href="index.php?page=transaksi";</script>';
    }
}
