            <?php
            require_once __DIR__ . '/vendor/autoload.php';
            $mpdf = new \Mpdf\Mpdf();

            //koneksi ke database mysql,
            $koneksi = mysqli_connect("localhost", "root", "", "wijayamart");

            //cek jika koneksi ke mysql gagal, maka akan tampil pesan berikut
            if (mysqli_connect_errno()) {
              echo "Gagal melakukan koneksi ke MySQL: " . mysqli_connect_error();
            }

            ob_start();
            ?>
            <?php
            $profil = mysqli_query($koneksi, "SELECT * FROM profil_toko") or die(mysqli_error($koneksi));
            while ($profiltoko = mysqli_fetch_array($profil)) {
              $namatoko = $profiltoko['nama_toko'];
              $alamattoko = $profiltoko['alamat'];
              $nohp = $profiltoko['no_hp'];
              $email = $profiltoko['email'];
            }
            ?>



            <div style="width: 350px;">
              <div style="border: 1px solid; padding: 5px;">
                <div style="text-align: center;">
                  <b style="font-size: 16px;"><?php echo $namatoko; ?></b><br>
                  <b style="font-size: 14px;"><?php echo $alamattoko; ?></b><br>
                  <div style="font-size: 12px; ">
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
                    $aadmin = $a['nama'];
                  }
                ?>
                  <table style="font-size: 12px; width: 100%;">
                    <tbody>
                      <tr>
                        <td>No : <?php echo $anotransaksi; ?></td>
                        <td style="text-align: right;">Tgl : <?php echo $atgl; ?>
                          <br>
                          Admin : <?php echo $aadmin; ?>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                  <hr width="100%;" color="black" style="height: 2px;">
                  <br>
                <?php

                }
                ?>
                <div>
                  <table style=" width: 100%; font-size: 14px;">
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
                  <hr width="100%" color="black">
                  <div style="font-size: 12px;">
                    <table style="width: 100%;">
                      <tbody>
                        <tr>
                          <td><span>Total : Rp.<?php echo $totalindo; ?></span></td>
                          <td style="text-align: right;"><span>Bayar : Rp.<?php echo $bayarindo; ?></span><br>
                            <span>Kembali : Rp.<?php echo $kembalindo; ?></span><br>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                    <div style="text-align: center;">
                      <br>
                      <span>Belanja lebih dekat, harga hemat</span>
                    </div>
                  </div>

                </div>
              </div>
              <?php
              $nama_dokumen = 'Struk ' . $anotransaksi . ' ' . $tanggal . '';
              $html = ob_get_contents();
              ob_end_clean();

              $mpdf->WriteHTML(utf8_encode($html));
              $mpdf->Output("" . $nama_dokumen . ".pdf", 'D');
              ?>