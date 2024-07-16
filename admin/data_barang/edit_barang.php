<?php include('config.php'); ?>

<!-- <?php
        date_default_timezone_set('Asia/Jakarta');
        $tgld = date('m/d/Y', strtotime('now'));
        $tgl = date('m/d/Y');
        $tgl1 = date("Y-m-d", strtotime('now'));
        ?> -->

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Edit Barang</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item">Data Barang</li>
                <li class="breadcrumb-item active">Edit Barang</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <?php
    if (isset($_GET['id_barang'])) {
        $id = $_GET['id_barang'];
        # code...
        $query = mysqli_query($koneksi, "SELECT * FROM tb_barang WHERE id_barang='$id'");
        if ($query == false) {
            die("Terjadi Kesalahan : " . mysqli_error($koneksi));
        }
        while ($data = mysqli_fetch_array($query)) {

            $id = $data['id_barang'];
            $nama = $data['nama_barang'];
            $stok = $data['stok'];
            $hbeli = $data['harga_beli'];
            $hjual = $data['harga_jual'];
            $satuan = $data['satuan'];
            $gambar = $data['gambar'];

            $format_indonesia_beli = number_format($hbeli, 0, ',', '.');
            $format_indonesia_jual = number_format($hjual, 0, ',', '.');
        }
    }
    ?>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">

                        <h5 class="card-title text-center">Form Edit Barang</h5>
                        <p></p>
                        <div class="col-lg-6" style="margin: auto;">
                            <form class="row g-3" method="POST" action="index.php?page=edit_barang" enctype="multipart/form-data">

                                <input type="hidden" name="img_url" value="<?php echo ($gambar); ?>">
                                <div class="col-12">
                                    <label for="inputNanme4" class="form-label">Kode Barang</label>
                                    <input type="text" class="form-control" name="id_barang" value="<?php echo ($id); ?>" placeholder="Kode Barang" readonly="true">
                                </div>
                                <div class="col-12">
                                    <label for="inputNama" class="form-label">Nama Barang</label>
                                    <input type="text" class="form-control" id="inputNama" name="nama" value="<?php echo ($nama); ?>" placeholder="Nama Barang" required>
                                </div>
                                <div class="col-12">
                                    <label for="inputNanme4" class="form-label">Stok Barang</label>
                                    <input type="text" class="form-control" name="stok" value="<?php echo ($stok); ?>" placeholder="Stok Barang" required readonly="true">
                                </div>
                                <div class="col-md-6">
                                    <label for="rupiah1" class="form-label">Harga Beli</label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text" id="inputGroupPrepend">Rp.</span>
                                        <input type="text" id="rupiah1" name="harga_beli" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" value="<?php echo ($format_indonesia_beli); ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="rupiah2" class="form-label">Harga Jual</label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text" id="inputGroupPrepend">Rp.</span>
                                        <input type="text" id="rupiah2" name="harga_jual" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" value="<?php echo ($format_indonesia_jual); ?>" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label for="inputSatuan" class="form-label">Satuan</label>
                                    <input type="text" class="form-control" id="inputSatuan" name="satuan" value="<?php echo ($satuan); ?>" placeholder="Satuan Kemasan" required>
                                </div>
                                <div class="col-md-8 col-lg-9">
                                    <?php
                                    if ($gambar == '') {
                                        echo '
                                                <img src="gambar/pic.png" alt="($nama)" style="max-width:80px;">
                                                ';
                                    } else {
                                        echo '
                                                <img src="gambar/' . $gambar . '" alt="($nama)" style="max-width:80px;">
                                                ';
                                    }
                                    ?>
                                </div>
                                <input type="file" name="media_img" accept='.jpg, .jpeg, .png' id="media_img" class="btn btn-sm" title="Upload new profile image">
                        </div>
                        <p></p>
                        <div class="text-center" style="margin-bottom: 24px;">
                            <a href="index.php?page=data_barang"><button type="button" class="btn btn-secondary bi bi-arrow-left-square"> Kembali</button></a>
                            <span style="margin: 8px;"></span>
                            <button type="submit" name="btnupdate" class="btn btn-primary bi bi-check-circle">
                                Update</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
        </div>
    </section>

</main><!-- End #main -->


<?php
if (isset($_POST['btnupdate'])) {
    $id_barang = $_POST['id_barang'];
    $nama = $_POST['nama'];
    $harga_beli = $_POST['harga_beli'];
    $harga_jual = $_POST['harga_jual'];
    $satuan = $_POST['satuan'];
    $tgambar = $_FILES['media_img']['name'];
    $img_url = $_POST['img_url'];

    //convert inputan harga menjadi int (membuang titik)
    $harga_belistr = str_replace(".", "", $harga_beli);
    var_dump($harga_belistr);
    $harga_beliint = (int) $harga_belistr;
    var_dump($harga_beliint);

    $harga_jualstr = str_replace(".", "", $harga_jual);
    var_dump($harga_jualstr);
    $harga_jualint = (int) $harga_jualstr;
    var_dump($harga_jualint);

    $name = uniqid(time());
    $extension = pathinfo($_FILES['media_img']['name'], PATHINFO_EXTENSION);
    $filename = $name . "." . $extension;
    //set nama foto
    $gambar_default = 'pic.png';
    $folder = './gambar/';
    $sumber = $_FILES['media_img']['tmp_name'];
    //proses pindah foto
    move_uploaded_file($sumber, $folder . $filename);

    if ($tgambar != '') {

        $update = mysqli_query($koneksi, "UPDATE tb_barang SET nama_barang='" . $nama . "',
                                                                 harga_beli='" . $harga_belistr . "',
                                                                 harga_jual='" . $harga_jualstr . "',
                                                                 satuan='" . $satuan . "',
                                                                 gambar='" . $filename . "'
                                                                 WHERE id_barang='" . $id_barang . "'") or die(mysqli_error($koneksi));

        if ($update) {
            unlink('./gambar/' . $img_url);
            echo '<script> window.onload = function(){
                                alert("Edit Data Berhasil");
                                location.href = "index.php?page=data_barang"}
                                </script>';
        } else {
            echo '<script> window.onload = function(){
                                alert("Edit Data Gagal");
                                location.href = "index.php?page=edit_barang"}
                                </script>';
        }
    } else if ($tgambar == '') {
        $update = mysqli_query($koneksi, "UPDATE tb_barang SET nama_barang='" . $nama . "',
                                                               harga_beli='" . $harga_belistr . "',
                                                               harga_jual='" . $harga_jualstr . "',
                                                               satuan='" . $satuan . "'
                                                               WHERE id_barang='" . $id_barang . "'") or die(mysqli_error($koneksi));

        if ($update) {

            echo '<script> window.onload = function(){
                            alert("Edit Data Berhasil");
                            location.href = "index.php?page=data_barang"}
                            </script>';
        } else {
            echo '<script> window.onload = function(){
                            alert("Edit Data Gagal");
                            location.href = "index.php?page=edit_barang"}
                            </script>';
        }
    }
}
?>