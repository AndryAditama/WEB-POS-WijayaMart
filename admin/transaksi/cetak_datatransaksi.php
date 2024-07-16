<?php
//memasukkan file config.php
include('config.php');
?>

<main id="main" class="main">

			<div class="pagetitle">
			<h1>Cetak Data Transaksi</h1>
			<nav>
				<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="index.php">Home</a></li>
				<li class="breadcrumb-item">Cetak Data Transaksi</li>
				</ol>
			</nav>
			</div><!-- End Page Title -->

			<section class="section">
			<div class="row">
				<div class="col-lg-12">
					<div class="card">
						<div class="card-body">

				
						<h5 class="card-title text-center">Cetak Data Transaksi</h5>
						<p></p>
                         <div class="col-lg-6" style="margin: auto;">
							
                         <?php
                            date_default_timezone_set('Asia/Jakarta');
                            $tgld = date('Y-m',strtotime('now')); 
                         ?>								
								
                                <div class="col-12">
                                       
                                    <div class="text-center" style="margin-bottom: 24px;">
                                    <label for="inputNanme4" class="form-label">Cetak Semua Data Transaksi</label>
                                    <br>
                                    <a href="transaksi/cetak_data_transaksi.php"><button  class="btn btn-outline-primary"><span class="bi bi-printer"> Cetak Data</span></button></a>
                                        
                                    </div> 
                            <form method="POST" action="transaksi/cetak_data_transaksi_bulanan.php">
                                    <div class="text-center">
                                        <label for="inputNanme4" class="form-label">Cetak Data Transaksi Berdasarkan Bulan :</label><br>
                                        <center><input class="form-control" type="month" id="filtertanggal" name="filtertanggal" style="width: 300px;" required></center>
                                    </div>
                                    <p></p>
                                    <div class="text-center" style="margin-bottom: 24px;">
                                        <a href="index.php?page=data_transaksi"><button type="button" class="btn btn-outline-secondary bi bi-arrow-left-square"> Kembali</button></a>
                                        <span style="margin: 8px;"></span>
                                        <button type="submit" name="btncetak" class="btn btn-outline-primary"><span class="bi bi-printer"> Cetak Data</span></button></a>
                                    </div> 
                                </div>
                            </form>
                        </div>
                        

                        </div>
					</div>

				</div>
			</div>
        </section>

    </main><!-- End #main -->

    

    
            

