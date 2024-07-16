<?php include('config.php'); ?>


<?php
if (isset($_POST['simpan'])) {
	$peng			= $_POST['pengeluaran'];
	$jumlah		    = $_POST['jumlah'];
	$tanggal		= $_POST['tanggal'];


	$harga_str = str_replace(".", "", $jumlah);
	var_dump($harga_str);
	$harga_int = (int) $harga_str;
	var_dump($harga_int);

	// if (preg_match("/^[0-9]*$/", $harga_int)) {
	$sql = mysqli_query($koneksi, "INSERT INTO tb_pengeluaran(pengeluaran, jumlah, tanggal) VALUES ('$peng', '$harga_int', '$tanggal')") or die(mysqli_error($koneksi));

	if ($sql) {
		echo '<script>window.onload = function(){alert("Berhasil menambahkan data."); document.location="index.php?page=data_pengeluaran";}</script>';
	} else {
		echo '<script>window.onload = function(){alert("Gagal Menambahkan Data."); document.location="index.php?page=data_pengeluaran";}</script>';
	}
	// }else{
	//     echo '<script>window.onload = function(){alert("Gagal Menambahkan Data! Perhatikan Data Yang Diinput!"); document.location="index.php?page=tambah_pengeluaran";}</script>';
	// }
}
?>

<?php
date_default_timezone_set('Asia/Jakarta');
$tgld = date('m/d/Y', strtotime('now'));
$tgl = date('m/d/Y');
$tgl1 = date("Y-m-d", strtotime('now'));

?>

<main id="main" class="main">

	<div class="pagetitle">
		<h1>Tambah Pengeluaran</h1>
		<nav>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="index.php">Home</a></li>
				<li class="breadcrumb-item">Data Pengeluaran</li>
				<li class="breadcrumb-item active">Tambah Pengeluaran</li>
			</ol>
		</nav>
	</div><!-- End Page Title -->

	<section class="section">
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-body">

						<h5 class="card-title text-center">Form Pengeluaran</h5>
						<p></p>
						<div class="col-lg-6" style="margin: auto;">
							<form class="row g-3" method="POST" action="index.php?page=tambah_pengeluaran">

								<div class="col-12">
									<label for="inputNanme4" class="form-label">Deskripsi Pengeluaran</label>
									<textarea class="form-control" name="pengeluaran" style="height: 100px" placeholder="Silahkan Tulis Pengeluaran Toko Anda!" required></textarea>
								</div>
								<div class="col-12">
									<label for="inputEmail4" class="form-label">Jumlah Pengeluaran</label>
									<div class="input-group">
										<span class="input-group-text" id="basic-addon1">Rp.</span>
										<input type="text" id="rupiah1" name="jumlah" class="form-control" placeholder="Jumlah Pengeluaran" aria-describedby="basic-addon1" required>
									</div>
								</div>

								<div class="col-12">
									<label for="inputPassword4" class="form-label">Tanggal Pengeluaran</label>
									<input type="date" name="tanggal" class="form-control" id="inputPassword4" value="<?php echo date($tgl1) ?>" required>


								</div>
								<p></p>
								<div class="text-center" style="margin-bottom: 24px;">
									<a href="index.php?page=data_pengeluaran"><button type="button" class="btn btn-secondary bi bi-arrow-left-square"> Kembali</button></a>
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