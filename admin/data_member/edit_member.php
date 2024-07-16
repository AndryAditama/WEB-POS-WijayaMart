<?php include('config.php'); ?>


<main id="main" class="main">

    <div class="pagetitle">
        <h1>Edit Member</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item">Data Member</li>
                <li class="breadcrumb-item active">Edit Member</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <?php
    if (isset($_GET['id'])) {
        $idedit = $_GET['id'];
        # code...
        $query = mysqli_query($koneksi, "SELECT * FROM tb_member WHERE id_member='$idedit'");
        if ($query == false) {
            die("Terjadi Kesalahan : " . mysqli_error($koneksi));
        }
        while ($data = mysqli_fetch_array($query)) {
            //$id1 = $data['id'];
            $id_member = $data['id_member'];
            $nama = $data['nama_member'];
            $kelamin = $data['kelamin'];
            $alamat = $data['alamat'];
            $no_hp = $data['no_hp'];
            $poin = $data['poin'];
            //   $avo = $data['avo'];
        }
    }

    ?>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">

                        <h5 class="card-title text-center">Form Edit Member</h5>
                        <p></p>
                        <div class="col-lg-6" style="margin: auto;">
                            <form class="row g-3" method="POST" action="index.php?page=edit_member">
                                <!-- <input type="hidden" name="ideditt" value="<?php //echo($id1); 
                                                                                ?>"> -->
                                <input type="hidden" name="idmlama" value="<?php echo ($id_member); ?>">
                                <div class="col-12">
                                    <label for="inputNanme4" class="form-label">ID Member</label>
                                    <input type="text" name="idmem" class="form-control" id="inputNanme4" placeholder="ID Member" value="<?php echo ($id_member); ?>" required>
                                </div>
                                <div class="col-12">
                                    <label for="inputNanme4" class="form-label">Nama Member</label>
                                    <input type="text" name="namamem" class="form-control" id="inputNanme4" placeholder="Nama Member" value="<?php echo ($nama); ?>" required>
                                </div>
                                <div class="col-12">
                                    <label for="inputNanme4" class="form-label">Jenis Kelamin</label>
                                    <select name="kelaminmem" id="" class="form-control" required>
                                        <option value="">...</option>
                                        <option value="Laki-laki" <?php if ($kelamin == 'Laki-laki') {
                                                                        echo 'selected';
                                                                    } ?>>Laki-laki</option>
                                        <option value="Perempuan" <?php if ($kelamin == 'Perempuan') {
                                                                        echo 'selected';
                                                                    } ?>>Perempuan</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label for="inputPassword4" class="form-label">Alamat</label>
                                    <input type="text" name="alamatmem" class="form-control" id="inputPassword4" placeholder="Alamat" value="<?php echo ($alamat); ?>" required>
                                </div>
                                <div class="col-12">
                                    <label for="inputPassword4" class="form-label">No. HP</label>
                                    <input type="tel" name="nohpmem" class="form-control" id="inputPassword4" placeholder="No. HP" value="<?php echo ($no_hp); ?>" required>
                                </div>
                                <div class="col-12">
                                    <label for="inputPassword4" class="form-label">Poin</label>
                                    <input type="text" name="poinmem" class="form-control" id="inputPassword4" placeholder="Poin" value="<?php echo ($poin); ?>" required>
                                </div>
                                <!-- <div class="col-12">
										<label for="inputPassword4" class="form-label">AVO</label>
										<input type="text" name="avomem" class="form-control" id="inputPassword4" placeholder="AVO" value="<?php echo ($avo); ?>" required>
									</div> -->
                                <p></p>
                                <div class="text-center" style="margin-bottom: 24px;">
                                    <a href="index.php?page=data_member"><button type="button" class="btn btn-secondary bi bi-arrow-left-square"> Kembali</button></a>
                                    <span style="margin: 8px;"></span>
                                    <button type="submit" name="btnUpdate" class="btn btn-primary bi bi-check-circle"> Update</button>
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
if (isset($_POST['btnUpdate'])) {
    //$ide            = $_POST['ideditt'];
    $idm            = $_POST['idmem'];
    $namaaa            = $_POST['namamem'];
    $klmn           = $_POST['kelaminmem'];
    $alamt          = $_POST['alamatmem'];
    $hp             = $_POST['nohpmem'];
    $poinn          = $_POST['poinmem'];
    // $avoo           = $_POST['avomem'];
    $id_memberlama  = $_POST['idmlama'];

    $idlama = $id_memberlama;

    if ($idm == $idlama) {
        $update = mysqli_query($koneksi, "UPDATE tb_member SET  id_member = '" . $idm . "',
                                                                        nama_member = '" . $namaaa . "',
                                                                        kelamin = '" . $klmn . "',
                                                                        alamat = '" . $alamt . "',
                                                                        no_hp = '" . $hp . "',
                                                                        poin = '" . $poinn . "'
                                                                        WHERE id_member = '" . $idlama . "'
                                                                        ") or die(mysqli_error($koneksi));
        if ($update) {
            echo '<script>window.onload = function(){ alert("Berhasil Mengupdate Data"); document.location="index.php?page=data_member"}</script>';
        } else {
            echo '<script>window.onload = function(){ alert("Gagal Mengupdate Data"); document.location="index.php?page=edit_member"}</script>';
        }
    } else {
        $cek = mysqli_query($koneksi, "SELECT * FROM tb_member WHERE id_member='$idm'") or die(mysqli_error($koneksi));
        if (mysqli_num_rows($cek) == 0) {
            $update = mysqli_query($koneksi, "UPDATE tb_member SET  id_member = '" . $idm . "',
                                                                            nama_member = '" . $namaaa . "',
                                                                            kelamin = '" . $klmn . "',
                                                                            alamat = '" . $alamt . "',
                                                                            no_hp = '" . $hp . "',
                                                                            poin = '" . $poinn . "'
                                                                            WHERE id_member = '" . $idlama . "'
                                                                            ") or die(mysqli_error($koneksi));
            if ($update) {
                echo '<script>window.onload = function(){ alert("Berhasil Mengupdate Data"); document.location="index.php?page=data_member"}</script>';
            } else {
                echo '<script>window.onload = function(){ alert("Gagal Mengupdate Data"); document.location="index.php?page=edit_member"}</script>';
            }
        } else {
            echo '<script>alert("Gagal Update Data! Terdapat ID yang Sama."); document.location="index.php?page=data_member";</script>';
        }
    }
}
?>