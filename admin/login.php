<?php
//koneksi ke database mysql,
$koneksi = mysqli_connect("localhost", "root", "", "wijayamart");

//cek jika koneksi ke mysql gagal, maka akan tampil pesan berikut
if (mysqli_connect_errno()) {
  echo "Gagal melakukan koneksi ke MySQL: " . mysqli_connect_error();
}
?>

<!DOCTYPE html>
<html lang="en">

<ead>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Wijaya Mart</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <?php
  $query = mysqli_query($koneksi, "SELECT * FROM profil_toko");
  if ($query == false) {
    die("Terjadi Kesalahan : " . mysqli_error($koneksi));
  }
  while ($data = mysqli_fetch_array($query)) {
    $id_toko = $data['id_profil'];
    $namatk = $data['nama_toko'];
    $alamat = $data['alamat'];
    $currentImage = $data['logo'];

  ?>
    <!-- Favicons -->
    <link href="logo/<?php echo ($currentImage); ?>" rel="icon">



    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: NiceAdmin - v2.2.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
    </head>

    <body>

      <main>
        <div class="container">

          <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
              <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                  <div class="d-flex justify-content-center py-4">
                    <span class="logo d-flex align-items-center w-auto">Silahkan Login Dulu!</span>
                    </a>
                  </div><!-- End Logo -->

                  <div class="card mb-3">

                    <div class="card-body">

                      <div class="d-flex flex-column align-items-center" style="margin-top: 10px;">
                        <img src="logo/<?php echo "$currentImage"; ?>" alt="<?php echo ($namatk) ?>" style="width: 100px;">
                      </div>
                    <?php
                  }
                    ?>
                    <form class="row g-3 needs-validation" method="POST" action="login.php" novalidate>

                      <div class="col-12">
                        <label for="yourUsername" class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" id="yourUsername" required>
                        <div class="invalid-feedback">Please enter your username.</div>
                      </div>

                      <div class="col-12">
                        <label for="yourPassword" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="yourPassword" required>
                        <div class="invalid-feedback">Please enter your password!</div>
                      </div>

                      <div class="col-12" style="margin-top: 20px; margin-bottom: 20px;">
                        <button name="btnlogin" class="btn btn-primary w-100" type="submit">Login</button>
                      </div>
                    </form>
                    <?php
                    //proses masuk
                    try {
                      if (isset($_POST['btnlogin'])) { //jika tombol login diklik
                        //lakukan pengecekan username dan password apakah tersedia dalam database
                        $cek = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE username = '" . $_POST['username'] . "' AND password = '" . $_POST['password'] . "'");
                        $hasil = mysqli_fetch_array($cek);
                        $count = mysqli_num_rows($cek);

                        if ($count > 0) {
                          $id_user = $hasil['id_user'];
                          $nama_user = $hasil['nama']; //mengambil nama user yang login
                          session_start();
                          $_SESSION['nama'] = $nama_user; //jika berhasil login akan diarahkan ke index.php
                          $_SESSION['id_user'] = $id_user;
                          echo '<script> window.onload = function(){
                                    alert("Login Berhasil");
                                    location.href = "index.php"}
                                    </script>';
                        } else {
                          echo '<script> window.onload = function(){
                                alert("Login Gagal");
                                location.href = "login.php"}
                                </script>';
                        }
                      }
                    } catch (\Throwable $th) {
                      echo '<script> window.onload = function(){
                            alert("Login Gagal");
                            location.href = "login.php"}
                            </script>';
                    }

                    ?>
                    </div>
                  </div>

                  <div class="credits">
                    <!-- All the links in the footer should remain intact. -->
                    <!-- You can delete the links only if you purchased the pro version. -->
                    <!-- Licensing information: https://bootstrapmade.com/license/ -->
                    <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
                    Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
                  </div>

                </div>
              </div>
            </div>

          </section>

        </div>
      </main><!-- End #main -->

      <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

      <!-- Vendor JS Files -->
      <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
      <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
      <script src="assets/vendor/chart.js/chart.min.js"></script>
      <script src="assets/vendor/echarts/echarts.min.js"></script>
      <script src="assets/vendor/quill/quill.min.js"></script>
      <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
      <script src="assets/vendor/tinymce/tinymce.min.js"></script>
      <script src="assets/vendor/php-email-form/validate.js"></script>

      <!-- Template Main JS File -->
      <script src="assets/js/main.js"></script>

    </body>

</html>