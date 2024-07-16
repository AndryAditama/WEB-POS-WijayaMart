<?php
//memasukkan file config.php
include('config.php');
?>

<!-- vendor select2 -->
<link rel="stylesheet" href="assets/vendor/select2/dist/css/select2.min.css">
<script src="assets/vendor/select2/dist/js/jquery-3.5.1.min.js"></script>
<script src="assets/vendor/select2/dist/js/select2.min.js"></script>


<main id="main" class="main">

    <div class="pagetitle">
        <h1>Stok Barang</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item">Stok Barang</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">

                        <h5 class="card-title text-center">Tambah Stok Barang</h5>
                        <p></p>
                        <div class="row mb-3 flex">
                            <div class="col-md-10 m-auto">
                                <form action="" method="POST">
                                    <?php
                                    date_default_timezone_set('Asia/Jakarta');
                                    $tgld = date('m/d/Y', strtotime('now'));
                                    $tgl = date('m/d/Y');
                                    $tgl1 = date("Y-m-d", strtotime('now'));

                                    ?>
                                    <label for="select" style="margin-bottom: 6px;">Pilih Barang</label>
                                    <select class="form-select select2" id="select" name="selectbarang" aria-label="Default select example" required style="width: 100%;">
                                        <option value="" selected disabled>-- Pilih --</option>
                                        <?php
                                        $sql = mysqli_query($koneksi, "SELECT * FROM tb_barang");
                                        while ($data = mysqli_fetch_array($sql)) {
                                            $hrg = $data["harga_beli"];
                                        ?>
                                            <option style=" text-align: center;" value="<?= $data['id_barang'] ?>">
                                                <?= $data['id_barang'] ?> | <?= $data['nama_barang'] ?>
                                            </option>
                                        <?php
                                        }
                                        ?>

                                    </select>
                                    <div class="row mb-3 mt-3 flex">
                                        <div class=" m-auto">
                                            <label for="stok" class="form-label">Stok Barang</label>
                                            <input type="number" class="form-control" id="stok" name="stokInput" value="" min="1" placeholder="Stok Barang" required>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label for="inputPassword4" class="form-label">Tanggal Barang Masuk</label>
                                        <input type="date" name="tanggal" class="form-control" id="inputPassword4" value="<?php echo date($tgl1) ?>" required>
                                    </div>
                                    <div class="m-auto mt-3">
                                        <button type="submit" id="tombolfilter" style="margin-bottom: 3px;" name="btntambah" class="btn btn-outline-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <?php

                        if (isset($_POST['btntambah'])) { //jika tombol update di klik maka akan melakukan pembacaan data yang diinput pada form dan menyimpan pada variabel masing-masing.
                            $tid = $_POST['selectbarang'];
                            $stok = $_POST['stokInput'];
                            $tanggalInput = $_POST['tanggal'];

                            $query = mysqli_query($koneksi, "SELECT * FROM tb_barang WHERE id_barang='$tid'");
                            if (
                                $query == false
                            ) {
                                die("Terjadi Kesalahan : " . mysqli_error($koneksi));
                            }
                            while ($data = mysqli_fetch_array($query)) {

                                $stokLama = $data['stok'];
                                $hargaBeli = $data['harga_beli'];

                                $StokUpdate = $stokLama + $stok;
                                $hargarestok = (int)$hargaBeli * (int)$stok;

                                //proses update data berdasarkan id
                                $tambahBarangMasuk = mysqli_query($koneksi, "INSERT INTO tb_stok (idbarang, stok_masuk, harga_stok, tanggal_masuk) VALUES ('$tid', '$stok', '$hargarestok', '$tanggalInput')");

                                if ($tambahBarangMasuk) {

                                    $updateStok = mysqli_query($koneksi, "UPDATE tb_barang SET stok='" . $StokUpdate . "' WHERE id_barang = '" . $tid . "'") or die(mysqli_error($koneksi));

                                    if ($updateStok) {
                                        echo '<script> window.onload = function(){
                                alert("Tambah Stok Barang Berhasil");
                                location.href = "index.php?page=stok_barang"}
                                </script>';
                                    } else {
                                        echo '<script> window.onload = function(){
                                alert("Tambah Stok Barang Gagal");
                                location.href = "index.php?page=stok_barang"}
                                </script>';
                                    }
                                } else {
                                    echo '<script> window.onload = function(){
                          alert("Tambah Stok Barang Gagal");
                          location.href = "index.php?page=stok_barang"}
                          </script>';
                                }
                            }
                        }
                        ?>

                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center">Data Barang Masuk</h5>
                        <div style="position: relative; overflow:auto; margin: 0 2.5em">
                            <!-- Table with stripped rows -->
                            <table class="table datatable table-striped table-bordered" id="datatables">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col" style="width: 70px;">ID Barang</th>
                                        <th scope="col">Nama Barang</th>
                                        <th scope="col">Stok Masuk</th>
                                        <th scope="col">Harga Restok</th>
                                        <th scope="col">Tanggal Masuk</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    //query ke database SELECT tabel mahasiswa urut berdasarkan id yang paling besar
                                    $sql = mysqli_query($koneksi, "SELECT * FROM tb_stok INNER JOIN tb_barang ON tb_stok.idbarang = tb_barang.id_barang ORDER BY id_stok DESC") or die(mysqli_error($koneksi));
                                    //jika query diatas menghasilkan nilai > 0 maka menjalankan script di bawah if...
                                    if (mysqli_num_rows($sql) > 0) {
                                        //membuat variabel $no untuk menyimpan nomor urut
                                        $no = 1;
                                        //melakukan perulangan while dengan dari dari query $sql
                                        while ($data = mysqli_fetch_assoc($sql)) {
                                            $idStok = $data['id_stok'];
                                            $idBarang = $data['idbarang'];
                                            $namaBarang = $data['nama_barang'];
                                            $hargaBeli = $data['harga_stok'];
                                            $stokMasuk = $data['stok_masuk'];
                                            $tanggalMasuk = $data['tanggal_masuk'];

                                            $harga_stok = number_format($hargaBeli, 0, ',', '.');

                                            // $format_indonesia = number_format($jum, 2, ',', '.');

                                            switch (date('m', strtotime($tanggalMasuk))) {
                                                case '01':
                                                    # code...
                                                    $bulan = 'Januari';
                                                    break;
                                                case '02':
                                                    # code...
                                                    $bulan = 'Februari';
                                                    break;
                                                case '03':
                                                    # code...
                                                    $bulan = 'Maret';
                                                    break;
                                                case '04':
                                                    # code...
                                                    $bulan = 'April';
                                                    break;
                                                case '05':
                                                    # code...
                                                    $bulan = 'Mei';
                                                    break;
                                                case '06':
                                                    # code...
                                                    $bulan = 'Juni';
                                                    break;
                                                case '07':
                                                    # code...
                                                    $bulan = 'Juli';
                                                    break;
                                                case '08':
                                                    # code...
                                                    $bulan = 'Agustus';
                                                    break;
                                                case '09':
                                                    # code...
                                                    $bulan = 'September';
                                                    break;
                                                case '10':
                                                    # code...
                                                    $bulan = 'Oktober';
                                                    break;
                                                case '11':
                                                    # code...
                                                    $bulan = 'November';
                                                    break;
                                                case '12':
                                                    # code...
                                                    $bulan = 'Desember';
                                                    break;

                                                default:
                                                    $bulan = 'kosong';
                                                    break;
                                            }
                                            $tggl = date('d', strtotime($tanggalMasuk));
                                            $thn = date('Y', strtotime($tanggalMasuk));

                                            switch (date('l', strtotime($tanggalMasuk))) {
                                                case 'Sunday':
                                                    $hari = 'Minggu';
                                                    break;
                                                case 'Monday':
                                                    $hari = 'Senin';
                                                    break;
                                                case 'Tuesday':
                                                    $hari = 'Selasa';
                                                    break;
                                                case 'Wednesday':
                                                    $hari = 'Rabu';
                                                    break;
                                                case 'Thursday':
                                                    $hari = 'Kamis';
                                                    break;
                                                case 'Friday':
                                                    $hari = 'Jumat';
                                                    break;
                                                case 'Saturday':
                                                    $hari = 'Sabtu';
                                                    break;

                                                default:
                                                    # code...
                                                    $hari = 'kosong';
                                                    break;
                                            }

                                            $tglfull = '' . $hari . ', ' . $tggl . ' ' . $bulan . ' ' . $thn . ' ';

                                            // $tgli = date('$hari $tggl', strtotime($tgl)).' '.$bulan.' '. date('Y', strtotime($tgl));

                                            echo '
						<tr>
						<td>' . $no++ . '</td>
						<td>' . $idBarang . '</td>
						<td>' . $namaBarang . '</td>
						<td>' . $stokMasuk . '</td>
						<td>Rp.' . $harga_stok . '</td>
						<td>' . $tglfull . '</td> 
						
						';
                                        }
                                    }

                                    ?>
                                </tbody>

                            </table>
                            <!-- End Table with stripped rows -->
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- <script>
        $('#select').select2();
    </script> -->

    <script type="text/javascript">
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: 'Pilih Barang',
                allowClear: 'true'
            });
        });
    </script>

    <script type="text/javascript">
        // format rupiah

        var stok = document.getElementById("stok").value;
        var hargastok = document.getElementById("hargarestok").value;

        var rupiah1 = document.getElementById("stok");
        rupiah1.addEventListener("keyup", function(e) {
            var hasil = parseInt(stok) * parseInt(hargastok);
            rupiah1.value = convertRupiah(hasil);
            document.getElementById("hargarestokinput").value = hasil;
        });
        rupiah1.addEventListener('keydown', function(event) {
            return isNumberKey(event);
        });

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

            rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
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

</main><!-- End #main -->