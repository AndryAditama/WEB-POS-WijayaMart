<?php
//memasukkan file config.php
include('config.php');
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Edit Pengeluaran</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item">Data Pengeluaran</li>
                <li class="breadcrumb-item active">Edit Pengeluaran</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">

                        <?php
                        if (isset($_GET['id'])) {
                            $id = $_GET['id'];
                            $query = mysqli_query($koneksi, "SELECT * FROM tb_pengeluaran WHERE id_pengeluaran='$id'");
                            if ($query == false) {
                                die("Terjadi Kesalahan : " . mysqli_error($koneksi));
                            }
                            while ($data = mysqli_fetch_array($query)) {

                                $id1 = $data['id_pengeluaran'];
                                $n = $data['pengeluaran'];
                                $jumpen = $data['jumlah'];
                                $tgl = $data['tanggal'];


                                $format_indonesia = number_format($jumpen, 0, ',', '.');
                            }
                        }

                        ?>

                        <h5 class="card-title text-center">Form Edit Pengeluaran</h5>
                        <p></p>
                        <div class="col-lg-6" style="margin: auto;">
                            <form class="row g-3" method="POST" action="index.php?page=edit_pengeluaran">
                                <input type="hidden" name="idpen" value="<?php echo ($id1); ?>">
                                <div class="col-12">
                                    <label for="inputNanme4" class="form-label">Deskripsi Pengeluaran</label>
                                    <textarea class="form-control" name="pengeluaran" style="height: 100px" placeholder="Silahkan Tulis Pengeluaran Toko Anda!" required><?php echo ($n); ?></textarea>
                                </div>
                                <div class="col-12">
                                    <label for="inputEmail4" class="form-label">Jumlah Pengeluaran</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">Rp.</span>
                                        <input type="text" id="rupiah1" name="jumlah" class="form-control" placeholder="Jumlah Pengeluaran" aria-describedby="basic-addon1" value="<?php echo ($format_indonesia); ?>" required>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label for="inputPassword4" class="form-label">Tanggal Pengeluaran</label>
                                    <input type="date" name="tanggal" class="form-control" id="inputPassword4" placeholder="Tanggal Pengeluaran" value="<?php echo ($tgl); ?>" required>

                                </div>
                                <p></p>
                                <div class="text-center" style="margin-bottom: 24px;">
                                    <a href="index.php?page=data_pengeluaran"><button type="button" class="btn btn-secondary bi bi-arrow-left-square"> Kembali</button></a>
                                    <span style="margin: 8px;"></span>
                                    <button type="submit" name="simpan" class="btn btn-primary bi bi-check-circle"> Update</button>
                                </div>

                            </form>
                        </div>
                        <?php
                        if (isset($_POST['simpan'])) {
                            $idpeng         = $_POST['idpen'];
                            $peng            = $_POST['pengeluaran'];
                            $jumlah            = $_POST['jumlah'];
                            $tanggal        = $_POST['tanggal'];


                            $harga_str = str_replace(".", "", $jumlah);
                            var_dump($harga_str);
                            $harga_int = (int) $harga_str;
                            var_dump($harga_int);

                            $sql = mysqli_query($koneksi, "UPDATE tb_pengeluaran SET 
                                                                                pengeluaran = '" . $peng . "',
                                                                                jumlah = '" . $harga_int . "',
                                                                                tanggal = '" . $tanggal . "'
                                                                                WHERE id_pengeluaran = '" . $idpeng . "'

                                                                                ");

                            if ($sql) {
                                echo '<script>window.onload = function(){alert("Berhasil mengupdate data."); document.location="index.php?page=data_pengeluaran";}</script>';
                            } else {
                                echo '<script>window.onload = function(){alert("Gagal Mengupdate Data."); document.location="index.php?page=data_pengeluaran";}</script>';
                            }
                        }
                        ?>


                    </div>
                </div>

            </div>
        </div>
    </section>

</main><!-- End #main -->