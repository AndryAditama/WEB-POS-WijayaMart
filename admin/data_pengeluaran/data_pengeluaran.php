<?php
//memasukkan file config.php
include('config.php');
?>

<main id="main" class="main">

	<div class="pagetitle">
		<h1>Data Pengeluaran</h1>
		<nav>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="index.php">Home</a></li>
				<li class="breadcrumb-item active">Data Pengeluaran</li>
			</ol>
		</nav>
	</div><!-- End Page Title -->

	<section class="section dashboard">
		<div class="row">

			<div class="col-lg-12">

				<div class="card">
					<div class="card-body">

						<a href="index.php?page=tambah_pengeluaran"><button type="submit" name="btntambah" class="btn btn-success"><span class="bi bi-plus-square"> Tambah</span></button></a>

						<p></p>


						<div style="position: relative; overflow:auto;">
							<!-- Table with stripped rows -->
							<table class="table datatable table-striped table-bordered">
								<thead>
									<tr>
										<th scope="col">#</th>
										<th scope="col">Pengeluaran</th>
										<th scope="col">Jumlah</th>
										<th scope="col">Tanggal</th>
										<th scope="col">Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php
									//query ke database SELECT tabel mahasiswa urut berdasarkan id yang paling besar
									$sql = mysqli_query($koneksi, "SELECT * FROM tb_pengeluaran ORDER BY id_pengeluaran DESC, id_pengeluaran DESC") or die(mysqli_error($koneksi));
									//jika query diatas menghasilkan nilai > 0 maka menjalankan script di bawah if...
									if (mysqli_num_rows($sql) > 0) {
										//membuat variabel $no untuk menyimpan nomor urut
										$no = 1;
										//melakukan perulangan while dengan dari dari query $sql
										while ($data = mysqli_fetch_assoc($sql)) {
											$id = $data['id_pengeluaran'];
											$peng = $data['pengeluaran'];
											$jum = $data['jumlah'];
											$tgl = $data['tanggal'];

											$format_indonesia = number_format($jum, 2, ',', '.');

											switch (date('m', strtotime($tgl))) {
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
											$tggl = date('d', strtotime($tgl));
											$thn = date('Y', strtotime($tgl));

											switch (date('l', strtotime($tgl))) {
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
						<td>' . $peng . '</td>
						<td>Rp.' . $format_indonesia . '</td>
						<td>' . $tglfull . '</td>
						<td>               
						
						<a href="index.php?page=edit_pengeluaran&id=' . ($id) . '"><button name="btnedit" class="btn btn-secondary btn-sm"><span class="bi bi-pencil"> Edit</span> </button>
						
						<span style="margin: 2px;"></span>
						<a href="index.php?page=hapus_pengeluaran&id=' . $id . '" class="btn btn-danger btn-sm" onclick="return confirm(' . "'Hapus data ini?'" . ')"><span class="bi bi-trash"> Hapus</span></a>
						'; ?>
									<?php echo '
						

						</td> 
						
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

	</section>
</main>