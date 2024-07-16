<?php include('config.php'); ?>


<?php
if (isset($_POST['simpan'])) {
	$nama			= $_POST['nama'];
	$username		= $_POST['username'];
	$password		= $_POST['password'];

	$cek = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE nama='$nama'") or die(mysqli_error($koneksi));

	if (mysqli_num_rows($cek) == 0) {
		$sql = mysqli_query($koneksi, "INSERT INTO tb_user(nama, username, password) VALUES ('$nama', '$username', '$password')") or die(mysqli_error($koneksi));

		if ($sql) {
			echo '<script>window.onload = function(){alert("Berhasil menambahkan data."); document.location="index.php?page=admin"};</script>';
		} else {
			echo '<script>window.onload = function(){alert("Gagal Menambahkan Data."); document.location="index.php?page=admin";</script>';
		}
	} else {
		echo '<script>alert("Data Sudah Ada"); document.location="index.php?page=admin";</script>';
	}
}
?>
<main id="main" class="main">

	<div class="pagetitle">
		<h1>Tambah Admin</h1>
		<nav>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="index.php">Home</a></li>
				<li class="breadcrumb-item">Kelola Admin</li>
				<li class="breadcrumb-item active">Tambah Admin</li>
			</ol>
		</nav>
	</div><!-- End Page Title -->

	<section class="section">
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-body">

						<h5 class="card-title text-center">Form Tambah Admin</h5>
						<p></p>
						<div class="col-lg-6" style="margin: auto;">
							<form class="row g-3" method="POST" action="index.php?page=tambah_admin">

								<div class="col-12">
									<label for="inputNanme4" class="form-label">Nama Admin</label>
									<input type="text" name="nama" class="form-control" id="inputNanme4" placeholder="Nama Admin" required>
								</div>

								<div class="col-12">
									<label for="inputEmail4" class="form-label">Username</label>
									<input type="text" name="username" class="form-control" id="inputEmail4" placeholder="Username" required>
								</div>
								<div class="col-12">
									<label for="inputPassword4" class="form-label">Password</label>
									<input type="text" name="password" class="form-control" id="inputPassword4" placeholder="Password" required>
								</div>
								<p></p>
								<div class="text-center" style="margin-bottom: 24px;">
									<a href="index.php?page=admin"><button type="button" class="btn btn-secondary bi bi-arrow-left-square"> Kembali</button></a>
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