<?php
include 'config.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $delete = mysqli_query($koneksi, "DELETE FROM tb_member WHERE id_member='$id'") or die(mysqli_error($koneksi));
    if ($delete) {
        echo '<script>alert("Berhasil Menghapus Data"); document.location = "index.php?page=data_member";</script>';
    } else {
        echo '<script>alert("Gagal Menghapus Data"); document.location = "index.php?page=data_member";</script>';
    }
}
