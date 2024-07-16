<?php
  include 'config.php';
  date_default_timezone_set('Asia/Jakarta');
	$tgld = date('m-d-Y H:i:s',strtotime('now'));
  $tglsaatini = date('m/d/Y',strtotime('now'));
  $today = date("Ymd");

  // cari id transaksi terakhir yang berawalan tanggal hari ini
$query = "SELECT max(notransaksi) AS last FROM tb_transaksi WHERE notransaksi LIKE '$today%'";
$hasil = mysqli_query($koneksi, $query);
$data  = mysqli_fetch_array($hasil);
$lastNoTransaksi = $data['last'];
 
// baca nomor urut transaksi dari id transaksi terakhir 
$lastNoUrut = substr($lastNoTransaksi, 8, 4); 
 
// nomor urut ditambah 1
$nextNoUrut = $lastNoUrut + 1;
 
// membuat format nomor transaksi berikutnya
$nextNoTransaksi = $today.sprintf('%04s', $nextNoUrut);

?>


<main id="main" class="main">

    <div class="pagetitle">
      <h1>Transaksi</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Transaksi</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
			<div class="row">
				<div class="col-lg-12">
					<div class="card">
						<div class="card-body row g-3">
                        <form class="row g-3" style="margin: auto;" method="POST" action="index.php?page=proses_transaksi" >
                              
                            <div class="col-md-6">
                                <h5><?php echo 'Tanggal : '.$tglsaatini.''; ?></h5>                  
                            </div>
                            <div class="col-md-6">
                                <h5 style="text-align: right;"><input type="hidden"  style="border: none; background-color: transparent; text-align: right;" name="notransaksi" value="<?php echo ''.$nextNoTransaksi.''?>"> <?php echo 'No : '.$nextNoTransaksi.''?></h5>
                                <br>
                                <h2 id="totalhargaatas" style="text-align: right; font-size: 35px; font-weight: bold;" class="text-success">Total : Rp.0</h2>
                            </div>
                
                        <div>
                            <p style="font-weight: bold;">Jenis Transaksi :</p>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jk" id="inlineRadio1" value="1" onclick="ShowHideDiv()">
                                <label class="form-check-label" for="inlineRadio1">Member</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jk" id="inlineRadio2" value="2" onclick="ShowHideDiv2()">
                                <label class="form-check-label" for="inlineRadio2">Non-Member</label>
                            </div>
                        </div>
                
                <div class="col-md-6">
                    <div class="col-12" id="dvidmember" style="display: none">
                        <label for="inputNanme4" style="font-weight: bold; " class="form-label">ID Member</label>
                        <input type="text" name="idmember" id="tampungidmember" onclick="searchTableid()" onkeyup="searchTableid()" class="form-control" placeholder="Masukkan ID Member" required>
                    </div>
                    <div class="col-12" id="dvPassport" style="display: none">
                        <label for="inputNanme4" style="font-weight: bold; margin-top: 10px;" class="form-label">Nama Member</label>
                        <input type="text" id="inputmember" class="form-control" onclick="searchTable()" onkeyup="searchTable()" placeholder="Masukkan Nama Member" required>
                    </div>
                  <div>
                    <div class="col-12" id="divcaribarang" style="padding-top: 10px; display: none">
                        <label for="inputNanme4" style="font-weight: bold; " class="form-label">Input Barang</label>
                        <input type="text" id="inputbarang" onclick="caribarang()" onkeyup="caribarang()" class="form-control" value="" placeholder="Input Barang">
                    </div>
                  </div>
                  
                </div>
                
                  
                <div id="panelpencarian" style="display: none;" class="col-md-6">
                  <div class="bg-secondary" style="padding: 10px; border-top-left-radius: 10px; border-top-right-radius: 10px; ">
                    <span style="font-weight: bold; color: white; padding-left: 5px;">Hasil Pencarian :</span>
                  </div>
                  <div style="background-color: #FDF2EF; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px; height: 185px;"> 
                    
                    
                      <!-- TABEL PENCARIAN MEMBER -->
                     <div id="tabelcarimember" class="form-control table-wrapper-scroll-y my-custom-scrollbar" style="position: relative; height: 150px; overflow: auto; display: none; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px; height: 185px;">
                     
                      <table id="tabelmember" class="table table-striped table-bordered">
                        
                          <thead>
                            <tr>
                              <th style="width: 30px;" scope="col">Pilih</th>
                              <th style="width: 100px;" scope="col">ID Member</th>
                              <th style="width: 200px;" scope="col">Nama</th>
                              <th style="width: 30px;" scope="col">Poin</th>
                            </tr>
                          </thead>

                          <tbody>
                          <?php
                          $nomember = 1;
                          $sql = mysqli_query($koneksi, "SELECT * FROM tb_member ORDER BY nama ASC") or die(mysqli_error($koneksi));
                          //jika query diatas menghasilkan nilai > 0 maka menjalankan script di bawah if...
                          if(mysqli_num_rows($sql) > 0){
                            //melakukan perulangan while dengan dari dari query $sql
                            while($data = mysqli_fetch_assoc($sql)){
                              //$idtm = $data['id'];
                              $idm = $data['id_member'];
                              $peng = $data['nama'];
                              $jum = $data['poin'];                                              
                          ?>
                            <tr style="max-height: 30px">
                            <td>
                                
                                <a href="#?&idmember=<?php echo ($idm)?>" onclick="tambahmember()" id="btntambahmember" name="tomboltambahmember" class="btn btn-primary btn-sm" ><span style="margin: auto;" class="bi bi-plus"></span></a>
                                
                              </td>
                              <td><?php echo ($idm);?></td>
                              <td><?php echo ($peng)?></td>
                              <td><?php echo ($jum);?></td>
                              
                            </tr>
                          <?php
                          $nomember++; 
                           }
                          
                          }
                          ?>                          
                          </tbody>
                        </table>
                      </div>
                      <!-- End Table with stripped rows -->


                     <!-- TABEL PENCARIAN BARANG -->
                     
                     <div id="tabelcaribarang" class="form-control table-wrapper-scroll-y my-custom-scrollbar" style="position: relative; height: 150px; overflow: auto; display: none; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px; height: 185px;">
                     <table id="tablecaribarang" class="table table-striped table-bordered">
                      
                        <thead>
                          <tr>
                            <th style="width: 30px;" scope="col">Pilih</th>
                            <th scope="col">ID</th>
                            <th scope="col">Kode</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Stok</th>
                            <th scope="col">Harga Member</th>
                            <th scope="col">Harga Normal</th>
                            <th style="width: 50px;" scope="col">Poin</th>
                            <th style="width: 30px;" scope="col">Pilih</th>
                          </tr>
                        </thead>
                        <tbody class="tbodybarang">
                        <?php
                          $sql = mysqli_query($koneksi, "SELECT * FROM tb_barang ORDER BY nama ASC") or die(mysqli_error($koneksi));
                          //jika query diatas menghasilkan nilai > 0 maka menjalankan script di bawah if...
                          if(mysqli_num_rows($sql) > 0){
                            //melakukan perulangan while dengan dari dari query $sql
                            while($data = mysqli_fetch_assoc($sql)){
                              $idb = $data['id_barang'];
                              $kodeb =$data['kode_barang'];
                              $namab = $data['nama'];
                              $stokb = $data['stok'];
                              $hrgbrgmember = $data['harga_member'];
                              $hrgnormal = $data['harga_normal'];
                              $poinb = $data['poin'];                                              
                        ?>
                          <tr class="trbarang" style="max-height: 30px">
                            <td>
                              <div>
                              <a href="#?id=<?php echo ($idb)?>" id="btntambahbarang" onclick="tambahbarang()" class="btn btn-primary btn-sm" name="btnker">
                             
                              <span style="margin: auto;" class="bi bi-plus"></span></a>
                              </div>
                            </td>
                            <td class="tdbarang"><input type="hidden" value="<?php echo ($idb);?>"><?php echo ($idb);?></td>
                            <td id="kodeb" class="tdbarang"><?php echo ($kodeb);?></td>
                            <td id="namab" class="tdbarang"><?php echo ($namab);?></td>
                            <td id="stokb" class="tdbarang"><?php echo ($stokb);?></td>
                            <td id="hargam" class="tdbarang"><?php echo ($hrgbrgmember);?></td>
                            <td id="hargan" class="tdbarang"><?php echo ($hrgnormal);?></td>
                            <td id="poinb" class="tdbarang"><?php echo ($poinb);?></td>
                            
                          </tr>
                           
                          <?php
                            }
                          }?>
                                               
                        </tbody>
                      </table>
                    </div>
                    
                      <!-- End Table with stripped rows -->
                     
                  
                    </div>
                  
                
                </div class="form-control table">
                <!-- TABEL KERANJANG -->
                <div style="margin-top: 40px; position: relative; overflow: auto;">
                  <table id="tabelkeranjang" class="table table-striped table-bordered">
                  <?php $no = 1;

                  ?>
                    <thead>
                      <tr>
                        <th style="width: 50px;" scope="col">ID</th>
                        <th scope="col">Nama Barang</th>
                        <th scope="col" style="width: 120px;">Harga Satuan</th>
                        <th scope="col" style="width: 60px;">Poin</th>
                        <th style="width: 60px;" scope="col">Stok</th>
                        <th style="width: 80px;" scope="col">jumlah</th>
                        <th scope="col" style="width: 200px;">harga</th>
                        <th style="width: 100px;" scope="col">Akumulasi Poin</th>
                        <th style="width: 30px;" scope="col">Aksi</th>
                      </tr>
                    </thead>
                    <tbody id="tbodyk">
                      <tr>

                      </tr>
                    </tbody>
                  </table>
                  <!-- End Table with stripped rows -->
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-4">
                      <span style="font-weight: bold;">Jumlah Barang</span>
                      <input id="totalbarangsaatini" name="jumbarang" type="text" style="margin-top: 10px; margin-bottom: 10px;" class="form-control" value="0" readonly>
                    </div>
                    <div class="col-md-4">
                      <span style="font-weight: bold;">Total Harga</span>
                      <input id="hargatotalsaatini" name="totalharga" type="text" style="margin-top: 10px; margin-bottom: 10px;" class="form-control" value="0" readonly>
                    </div>
                    <div class="col-md-4">
                      <span style="font-weight: bold;">Poin Bonus</span>
                      <input id="bonuspoinsaatini" name="poinbonus" type="text" style="margin-top: 10px; margin-bottom: 10px;" class="form-control" value="0" readonly>
                    </div>
                    <div class="col-md-4" >
                      <span style="font-weight: bold;">barang</span>
                      <input id="barangjumlah" name="barangjumlahku" type="text" style="margin-top: 10px; margin-bottom: 10px;" class="form-control" value="" readonly>
                    </div>
                    <div class="col-md-4" >
                      <span style="font-weight: bold;">barang</span>
                      <input id="ketukarpoin" name="kettukarpoin" type="text" style="margin-top: 10px; margin-bottom: 10px;" class="form-control" value="0" readonly>
                    </div>

                    <div class="col-md-4" >
                      <span style="font-weight: bold;">barang</span>
                      <input id="ketukarpoin" name="idadminlog" type="text" style="margin-top: 10px; margin-bottom: 10px;" class="form-control" value="0" readonly>
                    </div>
                  </div>
                </div>
                <?php
                  $querydiskon = mysqli_query($koneksi,"SELECT * FROM tb_diskon");
                  while ($diskon = mysqli_fetch_array($querydiskon)){
                    $hargadiskon = $diskon['diskon'];
                    $poindiskon = $diskon['poin_diskon'];
                    ?>
                
                <div class="col-md-6">
                  <div style="height: 76px;">
                    <h3 id="tampilpoinmember" style="text-align: left; font-weight: bold;" class="text-success">Poin Member : <input type="text" id="spanpoinmember" name="tampungpoinmember" readonly style="width: 70px; border: none; font-weight: bold; background-color: #fff;" class="text-success" value="-"></h3>
                  </div>
                  <div>
                  <span id="ketpoinmember" style="text-align: left; font-weight: bold;">Tukar <span id="poinminimal"><?php echo ($poindiskon);?></span> Poin Member untuk Diskon Rp.<span id="hargadiskon"><?php echo ($hargadiskon); ?></span> </span>
                  
                  <?php
                  }
                ?>
                <div class="d-grid gap-2 mt-3">
                    <!-- <input type="text" id="tampungpoin" value=""> -->
                    <button type="button" id="tombolpoinmember" disabled onclick="tukarpoin()" style="font-weight: bolder;" class="btn btn-primary">Tukar Poin</button>
                  </div>
                  </div>
                  
                </div>
                <div class="col-md-6">
                  <label for="inputbayar" style="margin-bottom: 10px; font-weight: bold;" class="form-check-label" >Nominal Pembayaran</label>
                  <div class="input-group has-validation">
                    <span class="input-group-text" id="inputGroupPrepend">Rp.</span>
                    <input class="form-control" aria-describedby="inputGroupPrepend" type="text" name="inputbayar" id="inputbayar" placeholder="Nominal Pembayaran" onkeyup="hitungkembalian()" required>
                  </div>
                  <label style="margin-bottom: 10px; margin-top: 10px; font-weight: bold;" class="">Jumlah Kembalian</label>
                  <div class="input-group has-validation">
                    <span class="input-group-text" id="inputGroupPrepend">Rp.</span>
                    <input class="form-control" type="text" name="inputkembalian" id="inputkembalian" placeholder="Jumlah Kembalian" readonly>
                  </div>
                </div>
                
                <div class="col-md-12" style="margin-top: 40px; margin-bottom: 20px;">
                  <div class="text-center" style="margin: auto; position: center;">
										<button type="button" name="btnreset" style="margin-right: 10px; width: 100px;" class="btn btn-secondary bi bi-arrow-left-square" onclick="resetform()"> Reset</button>
										
										<button type="submit" name="btnsimpan" style=" width: 100px;"  class="btn btn-primary bi bi-check-circle"> Selesai</button>
									</div>
                </div>
              </div>
              
              <div>
            </form>  
            </div>
					</div>

				</div>
			</div>
			</section>

  </main><!-- End #main -->


  <script type="text/javascript">
    
  </script>

