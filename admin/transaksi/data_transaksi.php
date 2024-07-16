<?php
//memasukkan file config.php
include('config.php');
?>

<main id="main" class="main">

	<div class="pagetitle">
		<h1>Data Transaksi</h1>
		<nav>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="index.php">Home</a></li>
				<li class="breadcrumb-item active">Data Transaksi</li>
			</ol>
		</nav>
	</div><!-- End Page Title -->

	<section class="section dashboard">
		<div class="row">

			<div class="col-lg-12">

				<div class="card">
					<div class="card-body">
						<div class="row g-3">
							<div class="col-md-6">
								<form action="" method="POST" class="form-inline">
									<h5>Tampilkan Berdasarkan Bulan :</h5>
									<div>
										<div class="form-check-inline">
											<input class="form-control" type="month" id="filtertanggal" onchange="formattgl();" name="filtertanggal" style="width: 200px;">
										</div>
										<div class="form-check-inline">
											<button type="submit" id="tombolfilter" onclick="filtertransaksi()" style="margin-bottom: 3px;" name="btnfilter" class="btn btn-outline-primary">Filter</button>
										</div>
									</div>
								</form>
							</div>
							<div class="col-md-6">
								<a href="index.php?page=cetak_transaksi"><button style="float: right;" class="btn btn-outline-primary"><span class="bi bi-printer"> Cetak Data Transaksi</span></button></a>
								<!-- <a href=""><button style="float: right;" onclick="window.print()" class="btn btn-outline-primary"><span class="bi bi-printer"> Cetak Data Transaksi</span></button></a> -->
							</div>
							<p></p>
						</div>

						<?php
						?>

						<div style="position: relative; overflow:auto;">
							<!-- Table with stripped rows -->
							<table class="table datatable table-striped table-bordered" id="datatables">
								<thead>
									<tr>
										<th scope="col">#</th>
										<th scope="col" style="width: 70px;">No. Transaksi</th>
										<th scope="col">Tanggal</th>
										<th scope="col" style="width: 300px;">Barang</th>
										<th scope="col">Total Harga</th>
										<th scope="col">Bayar</th>
										<th scope="col">kembalian</th>
										<th scope="col">Admin</th>
										<th scope="col">Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$filter = $_POST['filtertanggal'];
									if ($filter == '') {
										//query ke database SELECT tabel mahasiswa urut berdasarkan id yang paling besar
										$sql = mysqli_query($koneksi, "SELECT *, GROUP_CONCAT('<li>',nama_barang,' (',jumlah,')</li>' SEPARATOR '') as tr_list, GROUP_CONCAT(jumlah SEPARATOR ', ') as jumlah_list FROM detail_transaksi INNER JOIN tb_transaksi ON detail_transaksi.no_transaksi = tb_transaksi.nomor_transaksi INNER JOIN tb_barang ON detail_transaksi.idbarang = tb_barang.id_barang INNER JOIN tb_user ON tb_transaksi.admin = tb_user.id_user GROUP BY no_transaksi ORDER BY no_transaksi DESC") or die(mysqli_error($koneksi));
										//jika query diatas menghasilkan nilai > 0 maka menjalankan script di bawah if...
										if (mysqli_num_rows($sql) > 0) {
											//membuat variabel $no untuk menyimpan nomor urut
											$no = 1;
											//melakukan perulangan while dengan dari dari query $sql
											while ($data = mysqli_fetch_assoc($sql)) {
												$notr = $data['no_transaksi'];
												$tgl = $data['tanggal_transaksi'];
												$jumbrg = $data['tr_list'];
												$listjumlah = $data['jumlah_list'];
												$totalbayar = $data['harga_total'];
												$bayar = $data['bayar'];
												$kembalian = $data['kembalian'];
												$admin = $data['nama'];

												$harga_indonesia = number_format($totalbayar, 0, ',', '.');
												$bayar_indonesia = number_format($bayar, 0, ',', '.');
												$kembalian_indonesia = number_format($kembalian, 0, ',', '.');



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
												$waktu = date('H:i:s', strtotime($tgl));

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

												$tglfull = '' . $hari . ', ' . $tggl . ' ' . $bulan . ' ' . $thn . '';

												// $tgli = date('$hari $tggl', strtotime($tgl)).' '.$bulan.' '. date('Y', strtotime($tgl));

												echo '
							<tr style="max-height: 80px">
							<td>' . $no++ . '</td>
							<td>' . $notr . '</td>
							<td>' . $tglfull . '</td>
							
							<td style="max-width: 400px;"><ul>';
												echo '' . $jumbrg . '</ul></td>
														
							<td>Rp.' . $harga_indonesia . '</td>
							<td>Rp.' . $bayar_indonesia . '</td>
							<td>Rp.' . $kembalian_indonesia . '</td>
							<td>' . $admin . '</td>
							<td>               
							
							<a href="index.php?page=struk_penjualan&no=' . $notr . '"><button name="btnedit" style="" class="btn btn-secondary btn-sm mb-2"><span class="bi bi-printer"></span> </button>
							<a href="index.php?page=hapus_transaksi&id=' . $notr . '" class="btn btn-danger btn-sm bi bi-trash" style="" onclick="return confirm(' . "'Hapus data ini?'" . ')"></a>
							'; ?>
											<?php echo '
							</td> 
							';
											}
										}
										$hitungjumlah = mysqli_query($koneksi, "SELECT SUM(jumlah) as jml FROM detail_transaksi");
										while ($jj = mysqli_fetch_assoc($hitungjumlah)) {
											$jumlahnya = $jj['jml'];
										}


										$hitungduit = mysqli_query($koneksi, "SELECT * FROM tb_transaksi");
										while ($data = mysqli_fetch_array($hitungduit)) {

											$pendapatan[] = $data['harga_total'];
										}
										$harganya = array_sum($pendapatan);
										$format_indonesia = number_format($harganya, 0, ',', '.');
									} else {
										//query ke database SELECT tabel mahasiswa urut berdasarkan id yang paling besar
										$sql = mysqli_query($koneksi, "SELECT *, GROUP_CONCAT('<li>',nama_barang,' (',jumlah,')</li>' SEPARATOR '') as tr_list, GROUP_CONCAT(jumlah SEPARATOR ', ') as jumlah_list FROM detail_transaksi INNER JOIN tb_transaksi ON detail_transaksi.no_transaksi = tb_transaksi.nomor_transaksi INNER JOIN tb_barang ON detail_transaksi.idbarang = tb_barang.id_barang INNER JOIN tb_user ON tb_transaksi.admin = tb_user.id_user WHERE tanggal_transaksi LIKE '%" . $filter . "%' GROUP BY no_transaksi ORDER BY no_transaksi DESC") or die(mysqli_error($koneksi));
										//jika query diatas menghasilkan nilai > 0 maka menjalankan script di bawah if...
										if (mysqli_num_rows($sql) > 0) {
											//membuat variabel $no untuk menyimpan nomor urut
											$no = 1;
											//melakukan perulangan while dengan dari dari query $sql
											while ($data = mysqli_fetch_assoc($sql)) {
												$notr = $data['no_transaksi'];
												$tgl = $data['tanggal_transaksi'];
												$namabarang[] = $data['nama_barang'];
												$jumlahbrg[] = $data['jumlah'];
												$countdt = count($namabarang);
												$jumbrg = $data['tr_list'];
												$listjumlah = $data['jumlah_list'];
												$totalbayar = $data['hargatotal'];
												$bayar = $data['bayar'];
												$kembalian = $data['kembalian'];
												$id_member = $data['id_member'];
												$nama_member = $data['nama_member'];
												$keter = $data['keterangan'];
												$admin = $data['nama'];

												$harga_indonesia = number_format($totalbayar, 0, ',', '.');
												$bayar_indonesia = number_format($bayar, 0, ',', '.');
												$kembalian_indonesia = number_format($kembalian, 0, ',', '.');


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
												$waktu = date('H:i:s', strtotime($tgl));

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

												$tglfull = '' . $hari . ', ' . $tggl . ' ' . $bulan . ' ' . $thn . '';

												// $tgli = date('$hari $tggl', strtotime($tgl)).' '.$bulan.' '. date('Y', strtotime($tgl));

												echo '
							<tr style="max-height: 80px">
							<td>' . $no++ . '</td>
							<td>' . $notr . '</td>
							<td>' . $tglfull . '</td>
							
							<td style="width: 400px;"><ul>';
												echo '' . $jumbrg . '</ul></td>
							
							<td>Rp.' . $harga_indonesia . '</td>
							<td>Rp.' . $bayar_indonesia . '</td>
							<td>Rp.' . $kembalian_indonesia . '</td>
							<td>' . $admin . '</td>
							<td>               
							
							<a href="index.php?page=struk_penjualan&no=' . $notr . '"><button name="btnedit" class="btn btn-secondary btn-sm mb-2" style=""><span class="bi bi-printer"></span></button>
							
							<a href="index.php?page=hapus_transaksi&id=' . $notr . '" class="btn btn-danger btn-sm bi bi-trash" style="" onclick="return confirm(' . "'Hapus data ini?'" . ')"></a>
							'; ?>
									<?php echo '
							</td> 
							';
											}
										}
										$hitungjumlah = mysqli_query($koneksi, "SELECT SUM(jumlah) as jml FROM detail_transaksi WHERE tanggal LIKE '%" . $filter . "%'");
										while ($jj = mysqli_fetch_assoc($hitungjumlah)) {
											$jumlahnya = $jj['jml'];
										}

										$hitungduit = mysqli_query($koneksi, "SELECT * FROM tb_transaksi WHERE tanggal_transaksi LIKE '%" . $filter . "%' ");
										while ($data = mysqli_fetch_array($hitungduit)) {

											$pendapatan[] = $data['harga_total'];
										}
										$harganya = array_sum($pendapatan);
										$format_indonesia = number_format($harganya, 0, ',', '.');
									}


									?>
								</tbody>

							</table>
							<!-- End Table with stripped rows -->
						</div>
						<?php

						?>
						<div class="row" style="margin-top: 20px;">
							<div class="col-md-6">
								<h5>Barang terjual : <?php if ($jumlahnya == 0) {
															echo '0';
														} else {
															echo $jumlahnya;
														} ?></h5>
							</div>
							<div class="col-md-6">
								<h5 style="text-align: right;">Total Penjualan : Rp.<?php echo $format_indonesia ?></h5>
							</div>
						</div>

					</div>
				</div>
			</div>

	</section>
</main>