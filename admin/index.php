<?php
include('config.php');

error_reporting(0);
session_start();
if (!isset($_SESSION['nama'])) {
  if (!isset($_SESSION['id_user'])) {
    echo '<script>
        location.href = "login.php";
        </script>';
    //jika tidak ada user yg login tidak akan tampil menu
  } //mengecek apakah sudah ada user yg login

} else {
?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

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
    }
    ?>

    <title>
      <?php echo "$namatk"; ?>
    </title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="logo/<?php echo ($currentImage); ?>" rel="icon">
    <!-- <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon"> -->

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



    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

      <div class="d-flex align-items-center justify-content-between">
        <a href="index.php" class="logo d-flex align-items-center">
          <img src="logo/<?php echo "$currentImage"; ?>" alt="">
          <span class="d-none d-lg-block">
            <?php echo "$namatk"; ?>
          </span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
      </div><!-- End Logo -->



      <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">

          <li class="nav-item dropdown pe-3">

            <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">

              <span class="d-none d-md-block dropdown-toggle ps-2">
                <?php echo $_SESSION['nama'] ?>
              </span>
            </a><!-- End Profile Iamge Icon -->

            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
              <li class="dropdown-header">
                <h6>
                  <?php echo $_SESSION['nama'] ?>
                </h6>
              </li>
              <li>
                <hr class="dropdown-divider">
              </li>

              <li>
                <a class="dropdown-item d-flex align-items-center" href="index.php?page=MyProfil&id_user=<?php echo $_SESSION['id_user'] ?>">
                  <i class="bi bi-person"></i>
                  <span>Profil Saya</span>
                </a>
              </li>
              <li>
                <hr class="dropdown-divider">
              </li>

              <li>
                <a class="dropdown-item d-flex align-items-center" href="logout.php">
                  <i class="bi bi-box-arrow-right"></i>
                  <span>Log Out</span>
                </a>
              </li>

            </ul><!-- End Profile Dropdown Items -->
          </li><!-- End Profile Nav -->

        </ul>
      </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

      <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
          <a class="nav-link collapsed" href="index.php">
            <i class="bi bi-grid"></i>
            <span>Dashboard</span>
          </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-heading">Data Master</li>

        <li class="nav-item">
          <a class="nav-link collapsed" href="index.php?page=data_barang">
            <i class="bi bi-tags"></i>
            <span>Data Barang</span>
          </a>
        </li><!-- End data barang Page Nav -->

        <li class="nav-item">
          <a class="nav-link collapsed" href="index.php?page=stok_barang">
            <i class="bi bi-box-seam"></i>
            <span>Barang Masuk</span>
          </a>
        </li><!-- End data barang Page Nav -->

        <li class="nav-item">
          <a class="nav-link collapsed" href="index.php?page=transaksi">
            <i class="bi bi-cart2"></i>
            <span>Transaksi</span>
          </a>
        </li><!-- End transaksi Page Nav -->

        <li class="nav-item">
          <a class="nav-link collapsed" href="index.php?page=data_transaksi">
            <i class="bi bi-cart-check"></i>
            <span>Data Transaksi</span>
          </a>
        </li><!-- End transaksi Page Nav -->

        <!-- <li class="nav-item">
            <a class="nav-link collapsed" href="index.php?page=data_pengeluaran">
            <i class="bi bi-journal-text"></i>
              <span>Data Pengeluaran</span>
            </a>
          </li>End data pengeluaran Page Nav -->

        <li class="nav-heading">Settings</li>

        <li class="nav-item">
          <a class="nav-link collapsed" href="index.php?page=admin">
            <i class="ri ri-admin-line"></i>
            <span>Kelola Admin</span>
          </a>
        </li><!-- End admin Page Nav -->

        <li class="nav-item">
          <a class="nav-link collapsed" href="index.php?page=profil">
            <i class="bi bi-gear"></i>
            <span>Profil Toko</span>
          </a>
        </li><!-- End Profile Page Nav -->


      </ul>

    </aside><!-- End Sidebar-->
    <!-- /menu footer buttons -->
    <div class="sidebar-footer ">
      <a data-placement="top" title="home" href="index.php">
        <a data-placement="top" title="home" href="index.php">
          <a data-placement="top" title="home" href="index.php">
          </a>
    </div>
    <!-- /menu footer buttons -->

    <div class="right_col" role="main">
      <?php
      $queries = array();
      parse_str($_SERVER['QUERY_STRING'], $queries);
      error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
      switch ($queries['page']) {
        case 'profil':
          # code...
          include 'profil/profil.php';
          break;
        case 'edit_profil':
          # code...
          include 'profil/editprofil.php';
          break;
        case 'admin':
          # code...
          include 'data_admin/setting_admin.php';
          break;
        case 'tambah_admin':
          # code...
          include 'data_admin/tambah_admin.php';
          break;
        case 'edit_admin':
          # code...
          include 'data_admin/edit_admin.php';
          break;
        case 'hapus_admin':
          # code...
          include 'data_admin/hapus_admin.php';
          break;
        case 'data_pengeluaran':
          # code...
          include 'data_pengeluaran/data_pengeluaran.php';
          break;
        case 'tambah_pengeluaran':
          # code...
          include 'data_pengeluaran/tambah_pengeluaran.php';
          break;
        case 'edit_pengeluaran':
          # code...
          include 'data_pengeluaran/edit_pengeluaran.php';
          break;
        case 'hapus_pengeluaran':
          # code...
          include 'data_pengeluaran/hapus_pengeluaran.php';
          break;
        case 'data_barang':
          # code...
          include 'data_barang/data_barang.php';
          break;
        case 'tambah_barang':
          # code...
          include 'data_barang/tambah_barang.php';
          break;
        case 'edit_barang':
          include 'data_barang/edit_barang.php';
          break;
        case 'hapus_barang':
          include 'data_barang/hapus_barang.php';
          break;
        case 'stok_barang':
          include 'stok_barang/stok_barang.php';
          break;
        case 'data_member':
          include 'data_member/data_member.php';
          break;
        case 'tambah_member':
          include 'data_member/tambah_member.php';
          break;
        case 'edit_member':
          include 'data_member/edit_member.php';
          break;
        case 'hapus_member':
          include 'data_member/hapus_member.php';
          break;
        case 'tambah_keranjang':
          include 'keranjang/tambah_keranjang.php';
          break;
        case 'hapus_keranjang':
          include 'keranjang/hapus_keranjang.php';
          break;
        case 'reset_keranjang':
          include 'keranjang/reset_keranjang.php';
          break;
        case 'transaksi':
          include 'transaksi/transaksi.php';
          break;
        case 'proses_transaksi':
          include 'transaksi/proses_transaksi.php';
          break;
        case 'data_transaksi':
          include 'transaksi/data_transaksi.php';
          break;
        case 'hapus_transaksi':
          include 'transaksi/hapus_transaksi.php';
          break;
        case 'cetak_transaksi':
          include 'transaksi/cetak_datatransaksi.php';
          break;
        case 'cetak_semua_data_transaksi':
          include 'transaksi/cetak_data_transaksi.php';
          break;
        case 'cetak_data_transaksi_bulanan':
          include 'transaksi/cetak_data_transaksi_bulanan.php';
          break;
        case 'struk_penjualan':
          include 'transaksi/struk.php';
          break;
        case 'MyProfil':
          include 'Myprofil.php';
          break;

        default:
          #code...
          include 'home.php';
          break;
      }
      ?>


      <!-- ======= Footer ======= -->
      <footer id="footer" class="footer">
        <div class="copyright">
          &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
          <!-- All the links in the footer should remain intact. -->
          <!-- You can delete the links only if you purchased the pro version. -->
          <!-- Licensing information: https://bootstrapmade.com/license/ -->
          <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
          Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
      </footer><!-- End Footer -->

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
<?php
}
?>