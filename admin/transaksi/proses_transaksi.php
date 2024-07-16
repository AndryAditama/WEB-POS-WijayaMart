
<?php include('config.php'); ?>
<?php

if (isset($_POST['btnsimpan'])) {

  $notr = $_POST['noTransaksi'];
  $tgltr = date('Y-m-d H:i:s', strtotime('now'));
  $admintr = $_POST['admin'];
  $brg = $_POST['jumbarang'];
  $tohar = $_POST['pendapatan'];
  $inputbayar = $_POST['inputbayar'];
  $inputkembalian = $_POST['inputkembalian'];

  $uangBayar = str_replace(".", "", $inputbayar);
  var_dump($uangBayar);
  $uangBayarint = (int) $uangBayar;
  var_dump($uangBayarint);

  $uangKembali = str_replace(".", "", $inputkembalian);
  var_dump($uangKembali);
  $uangKembaliint = (int) $uangKembali;
  var_dump($uangKembaliint);

  $cekKeranjang = mysqli_query($koneksi, "SELECT * FROM tb_keranjang") or die(mysqli_error($koneksi));
  if (mysqli_num_rows($cekKeranjang) > 0) {
    $insertTransaksi = mysqli_query($koneksi, "INSERT INTO tb_transaksi (nomor_transaksi, tanggal_transaksi, harga_total, bayar, kembalian, admin) VALUES ('$notr', '$tgltr', '$tohar', '$uangBayarint', '$uangKembaliint', '$admintr')") or die(mysqli_error($koneksi));

    if ($insertTransaksi) {

      $selectKeranjang = mysqli_query($koneksi, "SELECT * FROM tb_keranjang") or die(mysqli_error($koneksi));
      while ($rowKeranjang = mysqli_fetch_array($selectKeranjang)) {
        $idbrg = $rowKeranjang['id_baranglaku'];
        $jumlahbrg = $rowKeranjang['jumlah_baranglaku'];
        $hargabrg = $rowKeranjang['harga_baranglaku'];

        $insertDetailTransaksi = mysqli_query($koneksi, "INSERT INTO detail_transaksi (no_transaksi, idbarang, jumlah, harga, tanggal) VALUES ('$notr', '$idbrg', '$jumlahbrg', '$hargabrg', '$tgltr')") or die(mysqli_error($koneksi));

        if ($insertDetailTransaksi) {


          $selectBarang = mysqli_query($koneksi, "SELECT * FROM tb_barang WHERE id_barang = '$idbrg'") or die(mysqli_error($koneksi));

          if ($selectBarang) {
            if (mysqli_num_rows($selectBarang) > 0) {
              while ($row = mysqli_fetch_array($selectBarang)) {

                $stokSekarang = $row["stok"];

                $stokBaru = $stokSekarang - $jumlahbrg;

                $updatebarang = mysqli_query($koneksi, "UPDATE tb_barang SET stok = '" . $stokBaru . "' WHERE id_barang = '" . $idbrg . "'") or die(mysqli_error($koneksi));

                if ($updatebarang) {
                  $hapusKeranjang = mysqli_query($koneksi, "DELETE FROM tb_keranjang") or die(mysqli_error($koneksi));

                  if ($hapusKeranjang) {
                    echo '<script>alert("Transaksi Berhasil")
                            document.location="index.php?page=struk_penjualan&no=' . $notr . '"</script>';
                  } else {
                    echo '<script>alert("Transaksi Berhasil")
                            document.location="index.php?page=transaksi"</script>';
                  }
                }
              }
            }
          }
        }
      }
    }
  } else {
    echo '<script>alert("Keranjang Kosong")
          document.location="index.php?page=transaksi"</script>';
  }
}
?>