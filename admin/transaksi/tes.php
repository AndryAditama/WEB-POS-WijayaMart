<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Cara Membuat Pencarian Data Table Dengan JavaScript</title>
</head>
<body>
<input type='text' id='input' onkeyup='searchTable()'>
<table id='table'>
<?php
   echo "<thead>
   <tr>
      <th>Nama</th>
      <th>Jenis Kelamin</th>
   </tr>
   </thead>
   <tbody>
   <tr>
      <td>Rindi</td>
      <td>Wanita</td>
   </tr>
   <tr>
      <td>Gofur</td>
      <td>Pria</td>
   </tr>
   <tr>
      <td>Faiqunnuha</td>
      <td>Pria</td>
   </tr>
   </tbody>";
?>
</table>
</body>
<script>
function searchTable() {
    var input;
    var saring;
    var status; 
    var tbody; 
    var tr; 
    var td;
    var i; 
    var j;
    input = document.getElementById("input");
    saring = input.value.toUpperCase();
    tbody = document.getElementsByTagName("tbody")[0];;
    tr = tbody.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td");
        for (j = 0; j < td.length; j++) {
            if (td[j].innerHTML.toUpperCase().indexOf(saring) > -1) {
                status = true;
            }
        }
        if (status) {
            tr[i].style.display = "";
            status = false;
        } else {
            tr[i].style.display = "none";
        }
    }
}
</script>
</html>

            
<?php
             require_once __DIR__ . '/vendor/autoload.php';
             $mpdf = new \Mpdf\Mpdf();
         
             //koneksi ke database mysql,
             $koneksi = mysqli_connect("localhost","root","","db_halalmart");
         
             //cek jika koneksi ke mysql gagal, maka akan tampil pesan berikut
             if (mysqli_connect_errno()){
                 echo "Gagal melakukan koneksi ke MySQL: " . mysqli_connect_error();
             }

             ob_start();
            ?>
            <?php
              $profil = mysqli_query($koneksi, "SELECT * FROM profil_toko") or die (mysqli_error($koneksi));
              while($profiltoko = mysqli_fetch_array($profil)){
                  $namatoko = $profiltoko['nama_toko'];
                  $alamattoko = $profiltoko['alamat'];
                  $nohp = $profiltoko['no_hp'];
                  $email = $profiltoko['email'];

              }
            ?>
				
			
						
            <div style="width: 370px;">
              <div style="border: 1px solid; padding: 5px;">
					<div style="text-align: center;">
                    <b style="font-size: 18px;"><?php echo $namatoko; ?></b><br>
                    <b><?php echo $alamattoko; ?></b><br>
                    <div style="font-size: 14px; ">
                    Email : <?php echo $email; ?><br>
                    No.HP : <?php echo $nohp; ?>
                    </div><br>
									</div>
                  <?php
                    if (isset($_GET['no'])){
                      $notr = $_GET['no'];
                      $tr = mysqli_query($koneksi, "SELECT * FROM detail_transaksi INNER JOIN tb_transaksi ON detail_transaksi.no_transaksi = tb_transaksi.notransaksi INNER JOIN tb_barang ON detail_transaksi.idbarang = tb_barang.id_barang INNER JOIN tb_member ON tb_transaksi.pelanggan = tb_member.id_member INNER JOIN tb_user ON tb_transaksi.admin = tb_user.id_user WHERE no_transaksi = $notr");
                      while ($a = mysqli_fetch_array($tr)) {
                        $atgl = $a['tanggal_transaksi'];
                        $anotransaksi = $a['notransaksi'];
                        $amember = $a['nama_member'];
                        $aadmin = $a['nama'];
                        $aket = $a['keterangan'];
                        $apoin = $a['poinbonus'];
                        $poinsaatini = $a['poin'];
                      }
                      ?>
                      <div style="font-size: 14px; padding: 3px;">
                        <span>No : <?php echo $anotransaksi; ?></span><span style="float: right; text-align: right;">Tgl : <?php echo $atgl; ?></span><br>
                        <span>Member : <?php if ($amember == "" || $amember == "zzzz") {
                          echo '-';
                        }else{ echo $amember;} ?></span>
                        <span style="float: right;">Admin : <?php echo $aadmin; ?></span><br>
                        <span>Poin saat ini : <?php echo $poinsaatini; ?></span>
                        <span style="float: right;"><?php echo $aket; ?></span>
                      </div><br>
                      <?php
                      
                    }
                    ?>


                  <?php
                      if (isset($_GET['no'])){
                        $notr = $_GET['no'];

                        $query = mysqli_query($koneksi, "SELECT * FROM detail_transaksi INNER JOIN tb_transaksi ON detail_transaksi.no_transaksi = tb_transaksi.notransaksi INNER JOIN tb_barang ON detail_transaksi.idbarang = tb_barang.id_barang INNER JOIN tb_member ON tb_transaksi.pelanggan = tb_member.id_member INNER JOIN tb_user ON tb_transaksi.admin = tb_user.id_user WHERE no_transaksi = $notr ORDER BY id ASC") or die(mysqli_error($koneksi));
                          if($query == false){
                          die ("Terjadi Kesalahan : ". mysqli_error($koneksi));
                          }
                          while ($data = mysqli_fetch_array ($query)){
                            
                            $notransaksi = $data['notransaksi'];
                            $tanggal = $data['tanggal_transaksi'];
                            $idbarang = $data['idbarang'];
                            $barang = $data['nama_barang'];
                            $jumlah = $data['jumlah'];
                            $hargasatuanmember = $data['harga_member'];
                            $hargasatuannormal = $data['harga_normal'];
                            $poinbonus = $data['poinbonus'];
                            $hargaperbarang = $data['harga_total'];
                            $hargatotal = $data['hargatotal'];
                            $bayar = $data['bayar'];
                            $kembalian = $data['kembalian'];
                            $pelanggan = $data['pelanggan'];
                            $namapelanggan = $data['nama_member'];
                            $totalpoin = $data['poinbonus'];
                            $admin = $data['nama'];
                            $keterangan = $data['keterangan'];

                            
                            $hargaindo = number_format($hargaperbarang, 0, ',', '.');
                            $totalindo = number_format($hargatotal, 0, ',', '.');
                            $bayarindo = number_format($bayar, 0, ',', '.');
                            $kembalindo = number_format($kembalian, 0, ',', '.');

                            //var_dump($notransaksi, $tanggal, $idbarang, $barang, $jumlah, $hargasatuanmember, $hargasatuannormal, $poinbonus, $hargaperbarang, $hargatotal, $bayar, $kembalian, $pelanggan, $namapelanggan, $totalpoin, $admin, $keterangan);
                          
                      
                        
                      ?>
                  
                  <div>
                    <table style="width: 100%; border: 1px solid;">                    
                      <tbody>
                        <tr style="font-size: 14px; word-wrap: break-word;">
                          <td style="width: 250px;"><?php echo $barang; ?></td>
                          <td style="width: 50px;">x<?php echo $jumlah; ?></td>
                          <td style="float: right; width: 100px; text-align: right;">Rp.<?php echo $hargaindo; ?></td>
                        </tr>
                      </tbody>
                      <?php 
                      }
                    } ?>
                    </table>
                    <hr width="100%" color="black" >
                    <div style="font-size: 14px; padding: 3px;">
                      <div style="height: 80px; width: 100%;">
                        <span style="text-align: left;">Bonus poin   : <?php echo $poinbonus; ?></span><span style="text-align: right; float: right;">Bayar   : Rp.<?php echo $bayarindo; ?></span><br>
                        <span style="text-align: left;">Total        : Rp.<?php echo $totalindo; ?></span>
                        
                        <span style="text-align: right;float: right;">Kembali : Rp.<?php echo $kembalindo; ?></span><br>
                      </div>
                      <div style="text-align: center;">
                        <span>Terimakasih Telah Berbelanja</span><br>
                        <span>Semoga Sehat Selalu.</span>
                      </div>
                      
                    </div>
                    
                  </div>
              </div>
                <?php
                    $nama_dokumen = 'Struk '.$anotransaksi.' '.$tanggal.'';
                    $html = ob_get_contents();
                    ob_end_clean();
                    
                    $mpdf->WriteHTML(utf8_encode($html));
                    $mpdf->Output("".$nama_dokumen.".pdf" ,'D');
                ?>