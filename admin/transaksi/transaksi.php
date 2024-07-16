<?php
include 'config.php';
date_default_timezone_set('Asia/Jakarta');
$tgld = date('m-d-Y H:i:s', strtotime('now'));
$tglsaatini = date('m/d/Y', strtotime('now'));
$today = date("Ymd");

// cari id transaksi terakhir yang berawalan tanggal hari ini
$query = "SELECT max(nomor_transaksi) AS last FROM tb_transaksi WHERE nomor_transaksi LIKE '$today%'";
$hasil = mysqli_query($koneksi, $query);
$data  = mysqli_fetch_array($hasil);
$lastNoTransaksi = $data['last'];

// baca nomor urut transaksi dari id transaksi terakhir 
$lastNoUrut = substr($lastNoTransaksi, 8, 4);

// nomor urut ditambah 1
$nextNoUrut = $lastNoUrut + 1;

// membuat format nomor transaksi berikutnya
$nextNoTransaksi = $today . sprintf('%04s', $nextNoUrut);

?>

<!-- vendor select2 -->
<link rel="stylesheet" href="assets/vendor/select2/dist/css/select2.min.css">
<script src="assets/vendor/select2/dist/js/jquery-3.5.1.min.js"></script>
<script src="assets/vendor/select2/dist/js/select2.min.js"></script>

<style>
  @media screen and (max-width: 768px) {

    #hitung-item,
    #hitung-duit {
      text-align: center !important;
    }
  }
</style>

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
          <div class="card-body row g-4" style="display:flex; flex-direction: row;">
            <!-- <form class="row g-3" style="margin: auto;" method="POST" action="index.php?page=proses_transaksi"> -->

            <div class="col-md-6 col-6">
              <h5><?php echo 'Tanggal : ' . $tglsaatini . ''; ?></h5>
            </div>
            <div class="col-md-6 col-6">
              <h5 style="text-align: right;"><input type="hidden" style="border: none; background-color: transparent; text-align: right;" name="notransaksi" value="<?php echo '' . $nextNoTransaksi . '' ?>"> <?php echo 'No : ' . $nextNoTransaksi . '' ?></h5>
            </div>
            <div class="col-md-6">
              <?php
              $hitungitem = mysqli_query($koneksi, "SELECT SUM(jumlah_baranglaku) AS hi FROM tb_keranjang");
              while ($data = mysqli_fetch_array($hitungitem)) {

                $totalitem = $data['hi'];
              }
              ?>
              <h2 class="text-primary" id="hitung-item" style="font-size: 2.8rem; font-weight: bold;">Item: <?= $totalitem; ?></h2>
            </div>
            <div class="col-md-6">
              <?php
              $hitungduit = mysqli_query($koneksi, "SELECT SUM(harga_baranglaku) AS ht FROM tb_keranjang");
              while ($data = mysqli_fetch_array($hitungduit)) {

                $pendapatan = $data['ht'];
              }
              $format_indonesia = number_format($pendapatan, 0, ',', '.');
              ?>
              <h2 id="hitung-duit" style="text-align: right; font-size: 2.8rem; font-weight: bold;" class="text-primary">Total: Rp.<?php echo $format_indonesia ?></h2>
            </div>
            <div class="col-md-6">
              <form action="index.php?page=tambah_keranjang" method="POST">
                <div id="divcaribarang" style="padding-top: 10px;">
                  <div class="col-md-12">
                    <label for="select" style="font-weight: bold;" class="form-label">Input Barang</label>
                    <select class="form-select select2" id="select" name="selectbarang" aria-label="Default select example" required style="width: 100%;">
                      <option value="" selected disabled>-- Pilih --</option>
                      <?php
                      $sql = mysqli_query($koneksi, "SELECT * FROM tb_barang");
                      while ($data = mysqli_fetch_array($sql)) {

                        $hargabrg = $data['harga_jual'];
                        $format_indonesia = number_format($hargabrg, 0, ',', '.'); ?>
                        <option style=" text-align: center;" value="<?= $data['id_barang'] ?>">
                          <?= $data['id_barang']; ?> | <?= $data['nama_barang']; ?> | Rp.<?php echo ($format_indonesia) ?>
                        </option>
                      <?php
                      }
                      ?>

                    </select>
                  </div>
                  <div class="col-md-12 mt-3">
                    <label for="jumlah-barang" class="form-label" style="font-weight: bold;">Jumlah Barang</label>
                    <input id="jumlah-barang" name="jumlahbarang" type="number" min="1" value="1" class="form-control">
                  </div>
                  <div class="col-md-12 mt-4">
                    <div class="text-center">
                      <button type="submit" id="btn-keranjang" name="btnkeranjang" style="width: 100%;" class="btn btn-primary bi bi-cart-plus"> Tambahkan Ke Keranjang</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
            <div class="col-md-6">
              <div id="panelpencarian" style="padding-top: 10px;">
                <div class="form-label" style="font-weight: bold;">
                  Keranjang Transaksi
                </div>
                <div class="table-wrapper-scroll-y my-custom-scrollbar" style=" position: relative; overflow:auto; max-height:300px;">
                  <table class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th style="width: 20px;" scope="col">Aksi</th>
                        <th style="width: 50px;" scope="col">ID Barang</th>
                        <th scope="col">Nama Barang</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col" style="width: 100px;">harga</th>
                      </tr>
                    </thead>
                    <tbody id="tbodyk">
                      <?php
                      //query ke database SELECT tabel mahasiswa urut berdasarkan id yang paling besar
                      $sql = mysqli_query($koneksi, "SELECT * FROM tb_keranjang INNER JOIN tb_barang ON tb_keranjang.id_baranglaku = tb_barang.id_barang") or die(mysqli_error($koneksi));
                      //jika query diatas menghasilkan nilai > 0 maka menjalankan script di bawah if...
                      if (mysqli_num_rows($sql) > 0) {
                        //membuat variabel $no untuk menyimpan nomor urut
                        $no = 1;
                        //melakukan perulangan while dengan dari dari query $sql
                        while ($data = mysqli_fetch_array($sql)) {
                          $idBarangl = $data['id_barang'];
                          $namaBarangl = $data['nama_barang'];
                          $jumlah_laku = $data['jumlah_baranglaku'];
                          $harga_laku = $data['harga_baranglaku'];

                          $format_indonesia = number_format($harga_laku, 0, ',', '.');
                          echo '
                            <tr>
                            <td><a href="index.php?page=hapus_keranjang&id_barang=' . $data['id_barang'] . '"><button class="btn btn-danger bi bi-trash"></button></a></td>
                            <td>' . $idBarangl . '</td>
                            <td style="padding-top 500px !important;">' . $namaBarangl . '</td>
                            <td>' . $jumlah_laku . '</td>
                            <td>' . $format_indonesia . '</td>
                            </tr>';
                        }
                      } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="card-body">
            <form action="index.php?page=proses_transaksi" method="POST">
              <div class="row">
                <input type="hidden" name="noTransaksi" value="<?php echo ($nextNoTransaksi); ?>">
                <input type="hidden" name="tglTransaksi" value="<?php echo ($tglsaatini); ?>">
                <input type="hidden" name="admin" value="<?php echo $_SESSION['id_user']; ?>">
                <input type="hidden" name="hargatotal" id="hargatotalitem" value="<?php echo ($totalitem); ?>">
                <input type="hidden" name="pendapatan" id="pendapatanku" value="<?php echo ($pendapatan); ?>">

                <div class="col-md-6">
                  <label for="inputbayar" style="margin-bottom: 10px; font-weight: bold;" class="form-check-label">Jumlah Barang</label>
                  <div class="input-group has-validation">
                    <span class="input-group-text bi bi-box" style="padding: 0 17px;" id="inputGroupPrepend"></span>
                    <input class="form-control" aria-describedby="inputGroupPrepend" type="text" name="jumbarang" id="totalbarangsaatini" value="<?php echo ($totalitem); ?>" readonly>
                  </div>
                  <label for="hargatotalsaatini" style="margin-bottom: 10px; margin-top: 10px; font-weight: bold;" class="">Total Harga</label>
                  <div class="input-group has-validation">
                    <span class="input-group-text" id="inputGroupPrepend">Rp.</span>
                    <?php $pid = number_format($pendapatan, 0, ',', '.') ?>
                    <input class="form-control" type="text" name="totalharga" id="hargatotalsaatini" placeholder="Jumlah Kembalian" value="<?php echo $pid; ?>" readonly>
                  </div>
                </div>

                <div class="col-md-6">
                  <label for="inputbayar" style="margin-bottom: 10px; font-weight: bold;" class="form-check-label">Nominal Pembayaran</label>
                  <div class="input-group has-validation">
                    <span class="input-group-text" id="inputGroupPrepend">Rp.</span>
                    <input type="text" name="inputbayar" class="form-control" id="inputbayar" placeholder="Input Pembayaran" required>
                  </div>
                  <label for="inputkembalian" style="margin-bottom: 10px; margin-top: 10px; font-weight: bold;" class="">Jumlah Kembalian</label>
                  <div class="input-group has-validation">
                    <span class="input-group-text" id="inputGroupPrepend">Rp.</span>
                    <input class="form-control" type="text" name="inputkembalian" id="inputkembalian" placeholder="Jumlah Kembalian" readonly>
                  </div>
                </div>
                <div class="col-md-12" style="margin-top: 40px; margin-bottom: 20px;">
                  <div class="text-center" style="margin: auto; position: center;">
                    <a href="index.php?page=reset_keranjang" onclick="return confirm('Yakin ingin membatalkan transaksi ini?')">
                      <button type="button" name="btnreset" style="margin-right: 10px; width: 100px; padding-right: 18px;" class="btn btn-danger bi bi-arrow-repeat"> Reset</button>
                    </a>

                    <button type="submit" name="btnsimpan" style=" width: 100px;" class="btn btn-primary bi bi-check-circle"> Selesai</button>
                  </div>
                </div>
              </div>
            </form>
          </div>

        </div>

      </div>

      </form>
    </div>
  </section>

  <!-- <script type="text/javascript">
    function hitung() {
      if (document.getElementById("inputbayar").value == '') {
        document.getElementById("inputkembalian").value = "0"
      } else {

        document.getElementById("inputkembalian").value = parseInt(document.getElementById("inputbayar").value) - parseInt(document.getElementById("pendapatanku").value);
      }
    }
  </script> -->

</main><!-- End #main -->


<!-- script untuk select barang -->
<script type="text/javascript">
  $(document).ready(function() {
    $('.select2').select2({
      placeholder: 'Pilih Barang',
      allowClear: 'true'
    });
  });
</script>

<script type="text/javascript">
  //format rupiah
  let rupiahkembalian = document.getElementById("inputkembalian");
  let rupiahbayar = document.getElementById("inputbayar");
  let kmb = '';
  rupiahbayar.addEventListener("keyup", function(e) {

    if (document.getElementById("inputbayar").value == '') {
      document.getElementById("inputkembalian").value = ""
    } else {

      let strBayar = document.getElementById("inputbayar").value;
      let splitStrBayar = strBayar.split(".");
      let intBayar = splitStrBayar.join("");
      rupiahkembalian.value = parseInt(intBayar) - parseInt(document.getElementById("pendapatanku").value);

      kmb = rupiahkembalian.value;

      if (kmb < 0) {
        rupiahkembalian.value = "Duit Kurang Bos"
      } else {
        rupiahbayar.value = convertRupiah(this.value);
        rupiahkembalian.value = convertRupiah(rupiahkembalian.value);
      }
    }
  });
  rupiahbayar.addEventListener('keydown', function(event) {
    return isNumberKey(event);
  })

  function convertRupiah(angka, prefix) {
    var number_string = angka.replace(/[^,\d]/g, "").toString(),
      split = number_string.split(","),
      sisa = split[0].length % 3,
      rupiah = split[0].substr(0, sisa),
      ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    if (ribuan) {
      separator = sisa ? "." : "";
      rupiah += separator + ribuan.join(".");
    }

    rupiah = split[1] != undefined ? rupiah + "." + split[1] : rupiah;
    return prefix == undefined ? rupiah : rupiah ? prefix + rupiah : "";
  }

  function isNumberKey(evt) {
    key = evt.which || evt.keyCode;
    if (key != 188 // Comma
      &&
      key != 8 // Backspace
      &&
      key != 17 && key != 86 & key != 67 // Ctrl c, ctrl v
      &&
      (key < 48 || key > 57) // Non digit
    ) {
      evt.preventDefault();
      return;
    }
  }
</script>