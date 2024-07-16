<?php
//memasukkan file config.php
include('config.php');
?>

<main id="main" class="main">

			<div class="pagetitle">
			<h1>Edit Admin</h1>
			<nav>
				<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="index.php">Home</a></li>
				<li class="breadcrumb-item">Kelola Admin</li>
				<li class="breadcrumb-item active">Edit Admin</li>
				</ol>
			</nav>
			</div><!-- End Page Title -->

			<section class="section">
			<div class="row">
				<div class="col-lg-12">
					<div class="card">
						<div class="card-body">

            <?php
            if (isset($_GET['id_user'])) {
              $id = $_GET['id_user'];
              # code...
              $query = mysqli_query ($koneksi, "SELECT * FROM tb_user WHERE id_user='$id'");
                if($query == false){
                die ("Terjadi Kesalahan : ". mysqli_error($koneksi));
                }
                while ($data = mysqli_fetch_array ($query)){
                  
                  $id1 = $data['id_user'];
                  $nama = $data['nama'];
                  $username = $data['username'];
                  $password = $data['password'];
                }
                
            }
              
            ?>
				
						<h5 class="card-title text-center">Form Edit Admin</h5>
						<p></p>
            <div class="col-lg-6" style="margin: auto;">
							<form class="row g-3" method="POST" action="index.php?page=MyProfil">
								
								
									<div class="col-12">
										<label for="inputNanme4" class="form-label">Nama Admin</label>
										<input type="text" name="tnama" class="form-control" id="inputNanme4" placeholder="Nama Admin" value="<?php echo($nama);?>" required>
									</div>
									
									<div class="col-12">
										<label for="inputEmail4" class="form-label">Username</label>
										<input type="text" name="tusername" class="form-control" id="inputEmail4" placeholder="Username" value="<?php echo($username);?>" required>
									</div>
									<div class="col-12">
										<label for="inputPassword4" class="form-label">Password</label>
										<input type="text" name="tpassword" class="form-control" id="inputPassword4" placeholder="Password" value="<?php echo($password)?>" required>
									</div>
									<p></p>
                  <input type="hidden" name="tid" value=" <?php echo($id1); ?>">
                  <div class="text-center" style="margin-bottom: 24px;">
                    <a href="index.php?page=admin"><button type="button" class="btn btn-secondary bi bi-arrow-left-square"> Kembali</button></a>
                    <span style="margin: 8px;"></span>
                    <button type="submit" name="btnupdate" class="btn btn-primary bi-check-circle"> Update</button>
                  </div>
									
              </form>
            </div>
              <?php

                if(isset($_POST['btnupdate'])){ //jika tombol update di klik maka akan melakukan pembacaan data yang diinput pada form dan menyimpan pada variabel masing-masing.
                  $tid = $_POST['tid'];
                  $tnama = $_POST['tnama'];
                  $tusername = $_POST['tusername'];
                  $tpassword = $_POST['tpassword'];
                  

                  //proses update data berdasarkan id
                  $edit = mysqli_query($koneksi, "UPDATE tb_user SET nama = '".$tnama."',
                                                                    username = '".$tusername."',
                                                                    password = '".$tpassword."'
                                                                    WHERE id_user = '".$tid."'

                                                                    ");

                      if ($edit) {

                        echo '<script> window.onload = function(){
                          alert("Edit Admin Berhasil");
                          location.href = "index.php"}
                          </script>';

                      }else{
                        echo '<script> window.onload = function(){
                          alert("Edit Admin Gagal");
                          location.href = "index.php?page=Myprofil"}
                          </script>';
                      }  

                }
              ?>

						</div>
					</div>

				</div>
			</div>
			</section>

			</main><!-- End #main -->

    

    
            

