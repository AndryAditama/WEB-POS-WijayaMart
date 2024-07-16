<?php
//memasukkan file config.php
include('config.php');
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Struk Penjualan</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item">Struk Penjualan</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <?php
            $profil = mysqli_query($koneksi, "SELECT * FROM profil_toko") or die(mysqli_error($koneksi));
            while ($profiltoko = mysqli_fetch_array($profil)) {
              $namatoko = $profiltoko['nama_toko'];
              $alamattoko = $profiltoko['alamat'];
              $nohp = $profiltoko['no_hp'];
              $email = $profiltoko['email'];
            }
            ?>

            <h5 class="card-title text-center">Struk Penjualan</h5>

            <div class="col-lg-5" id="cetakstrukk" style="margin: auto; width: 400px; ">
              <div id="cetakstruk" style="border: 1px solid; padding: 15px; background-color: white; width: 100%; height: 100%;">
                <div class="col-12" style="text-align: center;">
                  <b style="font-size: 18px;"><?php echo $namatoko; ?></b><br>
                  <b><?php echo $alamattoko; ?></b><br>
                  <div style="font-size: 14px; ">
                    Email : <?php echo $email; ?><br>
                    No.HP : <?php echo $nohp; ?>
                  </div><br>
                </div>
                <?php
                if (isset($_GET['no'])) {
                  $notr = $_GET['no'];
                  $tr = mysqli_query($koneksi, "SELECT * FROM detail_transaksi INNER JOIN tb_transaksi ON detail_transaksi.no_transaksi = tb_transaksi.nomor_transaksi INNER JOIN tb_barang ON detail_transaksi.idbarang = tb_barang.id_barang INNER JOIN tb_user ON tb_transaksi.admin = tb_user.id_user WHERE no_transaksi = $notr");
                  while ($a = mysqli_fetch_array($tr)) {
                    $atgl = $a['tanggal_transaksi'];
                    $anotransaksi = $a['nomor_transaksi'];
                    $amember = $a['nama_member'];
                    $aadmin = $a['nama'];
                  }
                ?>
                  <div style="font-size: 14px;">
                    <span>No : </span><span id="notr"><?php echo $anotransaksi; ?></span><span style="float: right;">Tgl : <?php echo $atgl; ?></span><br>
                    <span style="float: right;">Admin : <?php echo $aadmin; ?></span><br>
                  </div>
                  <hr width="100%" color="black" style="height: 2px;">
                <?php

                }
                ?>
                <div>
                  <table style="width: 100%;" id="ctk">

                    <tbody>

                      <?php
                      if (isset($_GET['no'])) {
                        $notr = $_GET['no'];

                        $query = mysqli_query($koneksi, "SELECT * FROM detail_transaksi INNER JOIN tb_transaksi ON detail_transaksi.no_transaksi = tb_transaksi.nomor_transaksi INNER JOIN tb_barang ON detail_transaksi.idbarang = tb_barang.id_barang INNER JOIN tb_user ON tb_transaksi.admin = tb_user.id_user WHERE no_transaksi = $notr ORDER BY id ASC") or die(mysqli_error($koneksi));
                        if ($query == false) {
                          die("Terjadi Kesalahan : " . mysqli_error($koneksi));
                        }
                        while ($data = mysqli_fetch_array($query)) {

                          $notransaksi = $data['nomor_transaksi'];
                          $tanggal = $data['tanggal_transaksi'];
                          $idbarang = $data['idbarang'];
                          $barang = $data['nama_barang'];
                          $harga_jual = $data['harga_jual'];
                          $satuan = $data['satuan'];
                          $jumlah = $data['jumlah'];
                          $hargaperbarang = $data['harga'];
                          $hargatotal = $data['harga_total'];
                          $bayar = $data['bayar'];
                          $kembalian = $data['kembalian'];
                          $admin = $data['nama'];

                          $hargajual = number_format($harga_jual, 0, ',', '.');
                          $hargaindo = number_format($hargaperbarang, 0, ',', '.');
                          $totalindo = number_format($hargatotal, 0, ',', '.');
                          $bayarindo = number_format($bayar, 0, ',', '.');
                          $kembalindo = number_format($kembalian, 0, ',', '.');

                          //var_dump($notransaksi, $tanggal, $idbarang, $barang, $jumlah, $hargasatuanmember, $hargasatuannormal, $poinbonus, $hargaperbarang, $hargatotal, $bayar, $kembalian, $pelanggan, $namapelanggan, $totalpoin, $admin, $keterangan);



                      ?>


                          <tr style="font-size: 14px; border-bottom: 1px dotted grey">
                            <td style="width: 250px;"><?php echo $barang; ?><br><?php echo $hargajual; ?> x<?php echo $jumlah; ?></td>
                            <td style="width: 50px;"><br> = </td>
                            <td style="float: right; width: 100px; text-align: right;"><?php echo $jumlah; ?> <?php echo $satuan; ?><br> Rp.<?php echo $hargaindo; ?></td>
                          </tr>
                    </tbody>
                <?php
                        }
                      } ?>
                  </table>

                  <div style="font-size: 14px; padding-top: 3px;">
                    <div style="height: 80px; width: 50%; float: left;">
                      <span>Total : Rp.<?php echo $totalindo; ?></span><br>
                    </div>
                    <div style="height: 80px; width: 50%; float: right; text-align: right; padding-left: 30px;">
                      <span>Bayar : Rp.<?php echo $bayarindo; ?></span><br>
                      <span>Kembali : Rp.<?php echo $kembalindo; ?></span><br>
                    </div>
                    <div style="text-align: center;">
                      <br>
                      <span>Belanja lebih dekat, harga hemat</span>
                    </div>
                  </div>

                </div>
              </div>

              <p></p>
              <div class="text-center">
                <b style="margin-bottom: 20px;">Cetak Sebagai</b><br>

                <button id="cetak" class="btn btn-primary bi bi-images" style="width: 110px;"> JPG</button>
                <span style="margin: 8px;"></span>
                <a href="transaksi/cetak_struk_pdf.php?cetak=pdf&no=<?php echo $notransaksi; ?>"><button type="submit" name="btnupdate" style="width: 110px;" class="btn btn-primary bi bi-file-earmark-pdf"> PDF</button></a><br>
                <p style="margin-top: 20px;">
                  <a href="index.php?page=data_transaksi"><button type="button" class="btn btn-outline-secondary bi bi-arrow-left-square"> Kembali</button></a>
                </p>
              </div>


            </div>
            <div id="preview" style="width: 900px; height: 1200px; position: fixed;">

            </div>

          </div>
        </div>

      </div>
    </div>
  </section>

</main><!-- End #main -->

<script src="transaksi/html2canvas.js" type="text/javascript"></script>">
<script>
  document.getElementById("cetak").addEventListener("click", function() {
    html2canvas(document.getElementById("cetakstruk")).then(function(canvas) {
      var notr = document.getElementById("notr").innerHTML;
      var anchorTag = document.createElement("a");
      document.body.appendChild(anchorTag);
      document.getElementById("preview").appendChild(canvas);
      anchorTag.download = "" + notr + ".jpg";
      anchorTag.href = canvas.toDataURL();
      anchorTag.target = '_blank';
      anchorTag.click();
    });
  });
</script>