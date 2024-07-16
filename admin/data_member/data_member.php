<?php
//memasukkan file config.php
include('config.php');
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Data Member</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item active">Data Member</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section dashboard">
    <div class="row">

      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">

            <a href="index.php?page=tambah_member"><button type="submit" name="btntambah" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#basicModal"><span class="bi bi-plus-square"> Tambah</span></button></a>

            <p></p>


            <div style="position: relative; overflow:auto;">
              <!-- Table with stripped rows -->
              <table class="table datatable table-striped table-bordered">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col" style="max-width: 60px; word-wrap: break-word;">ID Member</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Jenis Kelamin</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">No. HP</th>
                    <th scope="col">Poin</th>
                    <!-- <th scope="col">AVO</th> -->
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  //query ke database SELECT tabel mahasiswa urut berdasarkan id yang paling besar
                  $sql = mysqli_query($koneksi, "SELECT * FROM tb_member WHERE NOT id_member = '999999999999999' ORDER BY avo DESC") or die(mysqli_error($koneksi));
                  //jika query diatas menghasilkan nilai > 0 maka menjalankan script di bawah if...
                  if (mysqli_num_rows($sql) > 0) {
                    //membuat variabel $no untuk menyimpan nomor urut
                    $no = 1;

                    //melakukan perulangan while dengan dari dari query $sql
                    while ($data = mysqli_fetch_assoc($sql)) {

                  ?>

                      <tr style="max-height: 80px">
                        <td><?php echo ($no); ?></td>
                        <td><?php echo $data['id_member']; ?></td>
                        <td><?php echo $data['nama_member']; ?></td>
                        <td><?php echo $data['kelamin'] ?></td>
                        <td><?php echo $data['alamat']; ?></td>
                        <td><?php echo $data['no_hp']; ?></td>
                        <td><?php echo $data['poin']; ?></td>
                        <!-- <td><?php echo $data['avo']; ?></td>               -->

                    <?php

                      if ($data["id_member"] == "999999999999999") {
                        echo '
                    <td>
                    <div style="margin: 2px;">
                    <a> <button name="btnedit" class="btn btn-secondary btn-sm" style="width: 80px;" disabled> <span class="bi bi-pencil"> Edit</span> </button></a>
                    </div>
                    <div style="margin: 2px;">
                    <a> <button disabled class="btn btn-danger btn-sm"  style="width: 80px;"><span class="bi bi-trash"> Hapus</span></button></a>
                    </div>

                    </td>';
                      } else {
                        echo '
                    <td>
                    <div style="margin: 2px;">
                    <a href="index.php?page=edit_member&id=' . $data['id_member'] . '" > <button name="btnedit" class="btn btn-secondary btn-sm" style="width: 80px;"> <span class="bi bi-pencil"> Edit</span> </button></a>
                    </div>
                    <div style="margin: 2px;">
                    <a href="index.php?page=hapus_member&id=' . $data['id_member'] . '" class="btn btn-danger btn-sm"  style="width: 80px;" onclick="return confirm(\'Yakin ingin menghapus data ini?\')"><span class="bi bi-trash"> Hapus</span></a>
                    </div>

                    </td>';

                        $no++;
                      }
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