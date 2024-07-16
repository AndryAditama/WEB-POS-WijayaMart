<?php include('config.php'); ?>


<?php
if (isset($_POST['simpan'])) {
	$id             = $_POST['id_memberr'];
	$namaaa			= $_POST['namaa'];
	$klmn           = $_POST['kelaminn'];
	$alamt          = $_POST['alamatt'];
	$hp             = $_POST['nohp'];
	$poinn          = $_POST['point'];
	$avoo           = $_POST['avo1'];

	date_default_timezone_set('Asia/Jakarta');
	$tgld = date('Y-m-d H:i:s', strtotime('now'));

	$cek = mysqli_query($koneksi, "SELECT * FROM tb_member WHERE id_member='$id'") or die(mysqli_error($koneksi));

	if (mysqli_num_rows($cek) == 0) {

		$sql = mysqli_query($koneksi, "INSERT INTO tb_member(id_member, nama_member, kelamin, alamat, no_hp, poin, avo) VALUES ('$id', '$namaaa', '$klmn', '$alamt', '$hp', '$poinn', '$tgld')") or die(mysqli_error($koneksi));

		if ($sql) {
			echo '<script>alert("Berhasil menambahkan data."); document.location="index.php?page=data_member";</script>';
		} else {
			echo '<script>alert("Gagal Menambahkan Data."); document.location="index.php?page=data_member";</script>';
		}
	} else {
		echo '<script>alert("ID Sudah Terdaftar");</script>';
	}
}
?>
<main id="main" class="main">

	<div class="pagetitle">
		<h1>Tambah Member</h1>
		<nav>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="index.php">Home</a></li>
				<li class="breadcrumb-item">Data Member</li>
				<li class="breadcrumb-item active">Tambah Member</li>
			</ol>
		</nav>
	</div><!-- End Page Title -->

	<section class="section">
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-body">

						<h5 class="card-title text-center">Form Tambah Member</h5>
						<p></p>
						<div class="col-lg-6" style="margin: auto;">
							<form class="row g-3" method="POST" action="index.php?page=tambah_member">
								<div class="col-12">
									<label for="inputNanme4" class="form-label">ID Member</label>
									<input type="text" name="id_memberr" class="form-control" id="inputNanme4" placeholder="ID Member" required>
								</div>
								<div class="col-12">
									<label for="inputNanme4" class="form-label">Nama Member</label>
									<input type="text" name="namaa" class="form-control" id="inputNanme4" placeholder="Nama Member" required>
								</div>
								<div class="col-12">
									<label for="inputNanme4" class="form-label">Jenis Kelamin</label>
									<select name="kelaminn" id="" class="form-control" required>
										<option value="">...</option>
										<option value="Laki-laki">Laki-laki</option>
										<option value="Perempuan">Perempuan</option>
									</select>
								</div>
								<div class="col-12">
									<label for="inputEmail4" class="form-label">Alamat</label>
									<input type="text" name="alamatt" class="form-control" id="inputEmail4" placeholder="Alamat" required>
								</div>
								<div class="col-12">
									<label for="inputPassword4" class="form-label">No. HP</label>
									<input type="tel" name="nohp" class="form-control" id="inputPassword4" placeholder="No. HP" required>
								</div>
								<div class="col-12">
									<label for="inputPassword4" class="form-label">Poin</label>
									<input type="text" name="point" class="form-control" id="inputPassword4" placeholder="Poin" required>
								</div>
								<!-- <div class="col-12">
										<label for="inputPassword4" class="form-label">AVO</label>
										<input type="text" name="avo1" class="form-control" id="inputPassword4" placeholder="AVO" required>
									</div> -->
								<p></p>
								<div class="text-center" style="margin-bottom: 24px;">
									<a href="index.php?page=data_member"><button type="button" class="btn btn-secondary bi bi-arrow-left-square"> Kembali</button></a>
									<span style="margin: 8px;"></span>
									<button type="submit" name="simpan" class="btn btn-primary bi bi-check-circle"> Simpan</button>
								</div>
							</form>
						</div>
					</div>
				</div>

			</div>
		</div>
	</section>

</main><!-- End #main -->