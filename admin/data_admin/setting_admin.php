<?php
//memasukkan file config.php
include('config.php');
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Kelola Admin</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item active">Kelola Admin</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section dashboard">
    <div class="row">

      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">

            <a href="index.php?page=tambah_admin"><button type="submit" name="btntambah" class="btn btn-success"><span class="bi bi-plus-square"> Tambah</span></button></a>

            <p></p>


            <div style="position: relative; overflow:auto;">
              <!-- Table with stripped rows -->
              <table class="table datatable table-striped table-bordered">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Username</th>
                    <th scope="col">Password</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  //query ke database SELECT tabel mahasiswa urut berdasarkan id yang paling besar
                  $sql = mysqli_query($koneksi, "SELECT * FROM tb_user ORDER BY nama ASC") or die(mysqli_error($koneksi));
                  //jika query diatas menghasilkan nilai > 0 maka menjalankan script di bawah if...
                  if (mysqli_num_rows($sql) > 0) {
                    //membuat variabel $no untuk menyimpan nomor urut
                    $no = 1;
                    //melakukan perulangan while dengan dari dari query $sql
                    while ($data = mysqli_fetch_assoc($sql)) {
                      //menampilkan data perulangan
                      echo '
                  <tr>
                    <td>' . $no . '</td>
                    <td>' . $data['nama'] . '</td>
                    <td>' . $data['username'] . '</td>
                    <td>' . $data['password'] . '</td>
                    <td>               
                    
                
                <a href="index.php?page=edit_admin&id_user=' . $data['id_user'] . '" > <button name="btnedit" class="btn btn-secondary btn-sm"> <span class="bi bi-pencil"> Edit</span> </button></a>
                  <span style="margin: 2px;"></span>';

                      if ($data["id_user"] == $_SESSION["id_user"]) {
                        echo '
                        <a><button class="btn btn-danger btn-sm bi bi-trash" disabled> Hapus</button></a>';
                      } else {
                        echo '
                    <a href="index.php?page=hapus_admin&id_user=' . $data['id_user'] . '" class="btn btn-danger btn-sm" onclick="return confirm(\'Yakin ingin menghapus data ini?\')"><span class="bi bi-trash"> Hapus</span></a>';
                      }
                      echo '</td>
                  </tr>
                  ';

                      $no++;
                    }
                  }

                  ?>

                  <?php
                  if (isset($_GET['btnedit'])) {
                    $id_edit = $data['id_user'];
                    $query_edit = "SELECT * FROM tb_user WHERE id_user = '$id_edit'";
                    $sql       = mysqli_query($koneksi, $query_edit);
                    while ($dapa = mysqli_fetch_array($sql));
                    $namausr = $dapa['nama'];
                  }
                  ?>



                  <?php
                  //jika sudah mendapatkan parameter GET id dari URL
                  if (isset($_GET['id_user'])) {
                    //membuat variabel $id untuk menyimpan id dari GET id di URL
                    $id_user = $_GET['id_user'];

                    //query ke database SELECT tabel mahasiswa berdasarkan id = $id
                    $select = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE id_user='$id_user'") or die(mysqli_error($koneksi));

                    //jika hasil query = 0 maka muncul pesan error
                    if (mysqli_num_rows($select) == 0) {
                      echo '<div class="alert alert-warning">ID tidak ada dalam database.</div>';
                      exit();
                      //jika hasil query > 0
                    } else {
                      //membuat variabel $data dan menyimpan data row dari query
                      $data = mysqli_fetch_assoc($select);
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