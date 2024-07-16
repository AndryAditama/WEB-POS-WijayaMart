<?php
//memasukkan file config.php
include('config.php');
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Data Barang</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item active">Data Barang</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section dashboard">
    <div class="row">

      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">

            <a href="index.php?page=tambah_barang"><button type="submit" name="btntambah" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#basicModal"><span class="bi bi-plus-square">
                  Tambah</span></button></a>

            <p></p>


            <div style="position: relative; overflow:auto;">

              <!-- Table with stripped rows -->
              <table class="table datatable table-striped table-bordered">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">ID Barang</th>
                    <th scope="col">Nama Barang</th>
                    <th scope="col">Stok</th>
                    <th scope="col">Harga Beli</th>
                    <th scope="col">Harga Jual</th>
                    <th scope="col">Satuan</th>
                    <th scope="col">Gambar</th>
                    <th scope="col" style="width: 60px;">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  //query ke database SELECT tabel barang urut berdasarkan id yang paling besar
                  $sql = mysqli_query($koneksi, "SELECT * FROM tb_barang ORDER BY nama_barang ASC") or die(mysqli_error($koneksi));
                  //jika query diatas menghasilkan nilai > 0 maka menjalankan script di bawah if...
                  if (mysqli_num_rows($sql) > 0) {
                    //membuat variabel $no untuk menyimpan nomor urut
                    $no = 1;

                    //melakukan perulangan while dengan dari dari query $sql
                    while ($data = mysqli_fetch_assoc($sql)) :
                      $id_barang = $data['id_barang'];
                      $hbeli = $data['harga_beli'];
                      $hjual = $data['harga_jual'];
                      $harga_beli = number_format($hbeli, 0, ',', '.');
                      $harga_jual = number_format($hjual, 0, ',', '.');
                      //menampilkan data perulangan
                  ?>

                      <tr style="max-height: 80px">
                        <td>
                          <?php echo ($no); ?>
                        </td>
                        <td>
                          <?php echo ($id_barang); ?>
                        </td>
                        <td>
                          <?php echo $data['nama_barang']; ?>
                        </td>
                        <td>
                          <?php echo $data['stok'] ?>
                        </td>
                        <td>
                          <?php echo "Rp.$harga_beli"; ?>
                        </td>
                        <td>
                          <?php echo "Rp.$harga_jual"; ?>
                        </td>
                        <td>
                          <?php echo $data['satuan']; ?>
                        </td>
                        <td>
                          <center>
                            <?php if ($data['gambar'] == '') {
                              echo '<img src="gambar/pic.png" alt="' . $data['nama_barang'] . '" style="max-height: 60px;"> </td> ';
                            } else {
                              echo '<img src="gambar/' . $data['gambar'] . '" alt="' . $data['nama_barang'] . '" style="max-height: 60px;"></center> </td>
                  ';
                            }
                            ?>
                        <?php
                        echo '
                <td class="text-center">
                <div>

                <a href="index.php?page=edit_barang&id_barang=' . $data['id_barang'] . '" > <button name="btnedit" class="btn btn-warning btn-sm"> <span class="bi bi-pencil"></span> </button></a>
                
                <a href="index.php?page=hapus_barang&id_barang=' . $data['id_barang'] . '&pic=' . $data['gambar'] . '" class="btn btn-danger btn-sm" onclick="return confirm(\'Yakin ingin menghapus data ini?\')"><span class="bi bi-trash"></span></a>
                </div>

                </td>
                </tr>
                ';

                        $no++;

                      endwhile;
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

  <!-- <script type="text/javascript">
    document.getElementById("inputStok").addEventListener("keyup", function(e) {
      var hargabeli = document.getElementById("hdHargaBeli").value;
      var stoktambah = document.getElementById("inputStok").value;
      var viewHargaBeli = document.getElementById("viewTotalHargaBeli");
      var hdHargaBeli = document.getElementById("hdHargaBeli");
      var hasil = parseInt(hargabeli) * parseInt(stoktambah);
      viewHargaBeli.value = convertRupiah(hasil);
      hdHargaBeli.value = hasil;
    });

    document.getElementById("inputStok").addEventListener('keydown', function(event) {
      return isNumberKey(event);
    });

    function convertRupiah(angka, prefix) {
      var number_string = angka.replace(/[^,\d]/g, "").toString(),
        split = number_string.split(","),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

      if (ribuan) {
        separator = sisa ? "." : "";
        rupiah += separator + ribuan.join(".");
      }

      rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
      return prefix == undefined ? rupiah : rupiah ? prefix + rupiah : "";
    }

    function isNumberKey(evt) {
      key = evt.which || evt.keyCode;
      if (key != 188 // Comma
        &&
        key != 8 // Backspace
        &&
        key != 17 && key != 86 & key != 67 // Ctrl c, ctrl v
        &&
        (key < 48 || key > 57) // Non digit
      ) {
        evt.preventDefault();
        return;
      }
    }
  </script> -->
</main>