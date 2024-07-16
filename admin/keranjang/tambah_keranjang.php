<?php
include('config.php');

if (isset($_POST['btnkeranjang'])) {
    $id_barang = $_POST['selectbarang'];
    $jumlah_barang = $_POST['jumlahbarang'];

    $select = mysqli_query($koneksi, "SELECT * FROM tb_barang WHERE id_barang = '$id_barang'") or die(mysqli_error($koneksi));

    if ($select) {
        while ($data = mysqli_fetch_array($select)) {
            $id = $data['id_barang'];
            $nama = $data['nama_barang'];
            $stok = $data['stok'];
            $harga_jual = $data['harga_jual'];
        }
        $selectKeranjang = mysqli_query($koneksi, "SELECT * FROM tb_keranjang WHERE id_baranglaku = '$id_barang'") or die(mysqli_error($koneksi));

        if ($selectKeranjang) {
            if (mysqli_num_rows($selectKeranjang) == 0) {
                $hargaitem = $jumlah_barang * $harga_jual;
                $tambahKeranjang = mysqli_query($koneksi, "INSERT INTO tb_keranjang (id_baranglaku, jumlah_baranglaku, harga_baranglaku) VALUES ('$id_barang', '$jumlah_barang', '$hargaitem')") or die(mysqli_error($koneksi));

                if ($tambahKeranjang) {
                    echo '<script> window.onload = function(){
                                location.href = "index.php?page=transaksi"}
                            </script>';
                } else {
                    echo '<script> window.onload = function(){
                            alert("Gagal menambahkan barang");
                            location.href = "index.php?page=transaksi"}
                            </script>';
                }
            } else {

                while ($datakeranjang = mysqli_fetch_array($selectKeranjang)) {
                    $jumlahedit = $datakeranjang['jumlah_baranglaku'];
                    $hargaedit = $datakeranjang['harga_baranglaku'];
                    $hargaitem = $jumlah_barang * $harga_jual + $hargaedit;
                    $jumlahbaru = $jumlahedit + $jumlah_barang;
                    $tambahKeranjang = mysqli_query($koneksi, "UPDATE tb_keranjang SET jumlah_baranglaku='" . $jumlahbaru . "', harga_baranglaku='" . $hargaitem . "' WHERE id_baranglaku = '" . $id_barang . "'") or die(mysqli_error($koneksi));

                    if ($tambahKeranjang) {
                        echo '<script> window.onload = function(){
                                location.href = "index.php?page=transaksi"}
                            </script>';
                    } else {
                        echo '<script> window.onload = function(){
                            alert("Gagal menambahkan barang");
                            location.href = "index.php?page=transaksi"}
                            </script>';
                    }
                }
            }
        }
    }
}
