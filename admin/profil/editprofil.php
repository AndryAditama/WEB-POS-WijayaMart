<?php
	include 'config.php';
		if(isset($_POST['btnedit'])){ //jika tombol update di klik maka akan melakukan pembacaan data yang diinput pada form dan menyimpan pada variabel masing-masing.
		$id = $_POST['id_toko'];
		$nama_toko = $_POST['nama_toko'];
		$alamat = $_POST['alamat'];
          $nama_pemilik = $_POST['nama_pemilik'];
          $no_hp = $_POST['no_hp'];
          $email = $_POST['email'];
          $facebook = $_POST['facebook'];
          $instagram = $_POST['instagram'];

          $media_img = 'No image found';
          $img_url = $_POST['img_url'];
          $filename = $img_url;

          if($_FILES['media_img']['error'] == 0){
               $name =uniqid(time());
               $extension = pathinfo($_FILES['media_img']['name'], PATHINFO_EXTENSION);
               $filename = $name . "." . $extension;
               $hasFileUploaded = move_uploaded_file($_FILES['media_img']['tmp_name'], './logo/'. $filename);
          }

          //proses update data berdasarkan id
          $edit = mysqli_query($koneksi, "UPDATE profil_toko SET nama_toko = '".$nama_toko."',
                                                                                alamat = '".$alamat."',
                                                                                nama_pemilik = '".$nama_pemilik."',
                                                                                no_hp = '".$no_hp."',
                                                                                email = '".$email."',
                                                                                facebook = '".$facebook."',
                                                                                instagram = '".$instagram."',
                                                                                logo = '".$filename."'
                                                                                WHERE id_profil = '".$id."'

                                                                                ");
          
               if ($edit) {

                    if ($hasFileUploaded) 
                         unlink('./logo/'. $img_url);
                         echo '<script> window.onload = function(){
                              alert("Edit Profil Berhasil");
                              location.href = "index.php?page=profil"}
                              </script>';

               }else{
                    echo '<script> window.onload = function(){
                         alert("Edit Profil Gagal");
                         location.href = "index.php?page=profil"}
                         </script>';
               }      



          // $tgambar = $_FILES['media_img']['name'];
         
          // //set folder untuk menyimpan foto
          // $folder = './logo/';
          // //set nama foto
          // $sumber = $_FILES['media_img']['tmp_name'];
          // //proses pindah foto
          // move_uploaded_file($sumber, $folder.$tgambar);
          
          
          //      //proses update data berdasarkan id
          //      $edit = mysqli_query($koneksi, "UPDATE profil_toko SET nama_toko = '".$nama_toko."',
          //                                                                       alamat = '".$alamat."',
          //                                                                       nama_pemilik = '".$nama_pemilik."',
          //                                                                       no_hp = '".$no_hp."',
          //                                                                       email = '".$email."',
          //                                                                       facebook = '".$facebook."',
          //                                                                       instagram = '".$instagram."',
          //                                                                       logo = '".$tgambar."'
          //                                                                       WHERE id_profil = '".$id."'

          //                                                                  ");

          //      if($edit){ // Cek jika proses simpan ke database sukses atau tidak
          //           // Jika Sukses, Lakukan :
          //           echo '<script>
          //           window.onload = function(){
          //                     alert("edit data berhasil");
          //                     location.href = "profil.php"
          //           }
          //           </script>';
          //           }else{
          //           // Jika Gagal, Lakukan :
          //           echo '<script>
          //           window.onload = function(){
          //                     alert("edit data gagal");
          //                     location.href = "profil.php"
          //           }
          //           </script>';
          //           }

     }
