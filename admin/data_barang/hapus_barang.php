<?php
if (isset($_GET['id_barang'])) {
    $id = $_GET['id_barang'];
    $gambar = $_GET['pic'];
    # code...
    $query = mysqli_query($koneksi, "DELETE FROM tb_barang WHERE id_barang='$id'");
    if ($query) {
        if ($gambar == '') {
            echo '<script>alert("Berhasil menghapus data."); location.href="index.php?page=data_barang";</script>';
        } else {
            unlink('./gambar/' . $gambar);
            echo '<script>alert("Berhasil menghapus data."); location.href="index.php?page=data_barang";</script>';
        }
    } else {
        echo '<script>alert("Gagal menghapus data."); location.href="index.php?page=data_barang";</script>';
    }
}
