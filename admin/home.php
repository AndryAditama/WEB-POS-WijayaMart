<?php include 'config.php'; ?>
<main id="main" class="main">

  <div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"></li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section dashboard">
    <div class="row">
      <!-- diatas adalah tinggi card transparan -->

      <!-- Left side columns -->
      <div class="col-lg-12">
        <div class="row">

          <!-- Sales Card -->
          <div class="col-xxl-4 col-md-6">
            <div class="card info-card sales-card">
              <div class="card-body">
                <h5 class="card-title">Barang Terjual <span>| hari ini</span></h5>

                <?php
                date_default_timezone_set('Asia/Jakarta');
                $tgld = date('Y-m-d', strtotime('now'));
                $barangterjual = mysqli_query($koneksi, "SELECT SUM(jumlah) AS jml FROM detail_transaksi WHERE tanggal LIKE '%" . $tgld . "%'");
                while ($data = mysqli_fetch_array($barangterjual)) {
                  $jumlahnya = $data['jml'];
                }

                ?>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-cart-check"></i>
                  </div>
                  <div class="ps-3">
                    <h6><?php
                        if ($jumlahnya == 0) {
                          echo "0";
                        } else {
                          echo "$jumlahnya";
                        } ?>
                    </h6>

                  </div>
                </div>
              </div>

            </div>
          </div><!-- End Sales Card -->

          <!-- Revenue Card -->
          <div class="col-xxl-4 col-md-6">
            <div class="card info-card revenue-card">

              <div class="card-body">
                <h5 class="card-title">Total Penjualan <span>| Hari ini</span></h5>
                <?php
                date_default_timezone_set('Asia/Jakarta');
                $tgld = date('Y-m-d', strtotime('now'));
                $laku = mysqli_query($koneksi, "SELECT SUM(harga_total) AS hrg FROM tb_transaksi WHERE tanggal_transaksi LIKE '%" . $tgld . "%'");
                while ($data = mysqli_fetch_array($laku)) {

                  $pendapatan = $data['hrg'];
                }
                $format_indonesia = number_format($pendapatan, 0, ',', '.');
                ?>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-currency-dollar"></i>
                  </div>
                  <div class="ps-3">
                    <h6>Rp. <?php echo "$format_indonesia"; ?></h6>


                  </div>
                </div>
              </div>

            </div>
          </div><!-- End Revenue Card -->

          <!-- Customers Card -->
          <div class="col-xxl-4 col-xl-12">

            <div class="card info-card customers-card">

              <div class="card-body">
                <h5 class="card-title text-center">Grafik Penjualan Barang</h5>
                <span>Tampilkan Berdasarkan Tahun :</span>
                <div class="col-md-6">
                  <form action="" method="POST" class="form-inline">
                    <div class="form-check-inline">
                      <input class="form-control" type="text" id="filtertanggal" name="filtertahun">
                    </div>
                    <div class="form-check-inline">
                      <button type="submit" id="tombolfilter" style="margin-bottom: 3px;" name="btnfilter" class="btn btn-outline-primary">Filter</button>
                    </div>
                  </form>
                </div>

                <div class="d-flex align-items-center">
                  <canvas id="barChart" style="max-height: 400px;"></canvas>
                </div>

              </div>
            </div>

          </div><!-- End Customers Card -->

        </div>
      </div><!-- End Left side columns -->
    </div>
  </section>
  <?php
  date_default_timezone_set('Asia/Jakarta');
  $bulan1 = "01";
  $bulan2 = "02";
  $bulan3 = "03";
  $bulan4 = "04";
  $bulan5 = "05";
  $bulan6 = "06";
  $bulan7 = "07";
  $bulan8 = "08";
  $bulan9 = "09";
  $bulan10 = "10";
  $bulan11 = "11";
  $bulan12 = "12";
  $tahunNow = date("Y", strtotime("now"));


  $filterTahun = $_POST['filtertahun'];

  if ($filterTahun == '') {
    $bulan1 = $tahunNow . '-' . $bulan1;
    $bulan2 = $tahunNow . '-' . $bulan2;
    $bulan3 = $tahunNow . '-' . $bulan3;
    $bulan4 = $tahunNow . '-' . $bulan4;
    $bulan5 = $tahunNow . '-' . $bulan5;
    $bulan6 = $tahunNow . '-' . $bulan6;
    $bulan7 = $tahunNow . '-' . $bulan7;
    $bulan8 = $tahunNow . '-' . $bulan8;
    $bulan9 = $tahunNow . '-' . $bulan9;
    $bulan10 = $tahunNow . '-' . $bulan10;
    $bulan11 = $tahunNow . '-' . $bulan11;
    $bulan12 = $tahunNow . '-' . $bulan12;


    $selectB1 = mysqli_query($koneksi, "SELECT SUM(jumlah) as jml1 FROM detail_transaksi WHERE tanggal LIKE '%$bulan1%'");
    if ($selectB1) {
      while ($data = mysqli_fetch_array($selectB1)) {
        $jumlah1 = $data['jml1'];
        if ($jumlah1 == '') {
          $jumlah1 = $data['jml1'];
        }
      }
      $selectB2 = mysqli_query($koneksi, "SELECT SUM(jumlah) as jml2 FROM detail_transaksi WHERE tanggal LIKE '%$bulan2%'");
      if ($selectB2) {
        while ($data = mysqli_fetch_array($selectB2)) {
          $jumlah2 = $data['jml2'];
        }
        $selectB3 = mysqli_query($koneksi, "SELECT SUM(jumlah) as jml3 FROM detail_transaksi WHERE tanggal LIKE '%$bulan3%'");
        if ($selectB3) {
          while ($data = mysqli_fetch_array($selectB3)) {
            $jumlah3 = $data['jml3'];
          }
          $selectB4 = mysqli_query($koneksi, "SELECT SUM(jumlah) as jml4 FROM detail_transaksi WHERE tanggal LIKE '%$bulan4%'");
          if ($selectB4) {
            while ($data = mysqli_fetch_array($selectB4)) {
              $jumlah4 = $data['jml4'];
            }
            $selectB5 = mysqli_query($koneksi, "SELECT SUM(jumlah) as jml5 FROM detail_transaksi WHERE tanggal LIKE '%$bulan5%'");
            if ($selectB5) {
              while ($data = mysqli_fetch_array($selectB5)) {
                $jumlah5 = $data['jml5'];
              }
              $selectB6 = mysqli_query($koneksi, "SELECT SUM(jumlah) as jml6 FROM detail_transaksi WHERE tanggal LIKE '%$bulan6%'");
              if ($selectB6) {
                while ($data = mysqli_fetch_array($selectB6)) {
                  $jumlah6 = $data['jml6'];
                }
                $selectB7 = mysqli_query($koneksi, "SELECT SUM(jumlah) as jml7 FROM detail_transaksi WHERE tanggal LIKE '%$bulan7%'");
                if ($selectB7) {
                  while ($data = mysqli_fetch_array($selectB7)) {
                    $jumlah7 = $data['jml7'];
                  }
                  $selectB8 = mysqli_query($koneksi, "SELECT SUM(jumlah) as jml8 FROM detail_transaksi WHERE tanggal LIKE '%$bulan8%'");
                  if ($selectB8) {
                    while ($data = mysqli_fetch_array($selectB8)) {
                      $jumlah8 = $data['jml8'];
                    }
                    $selectB9 = mysqli_query($koneksi, "SELECT SUM(jumlah) as jml9 FROM detail_transaksi WHERE tanggal LIKE '%$bulan9%'");
                    if ($selectB9) {
                      while ($data = mysqli_fetch_array($selectB9)) {
                        $jumlah9 = $data['jml9'];
                      }
                      $selectB10 = mysqli_query($koneksi, "SELECT SUM(jumlah) as jml10 FROM detail_transaksi WHERE tanggal LIKE '%$bulan10%'");
                      if ($selectB10) {
                        while ($data = mysqli_fetch_array($selectB10)) {
                          $jumlah10 = $data['jml10'];
                        }
                        $selectB11 = mysqli_query($koneksi, "SELECT SUM(jumlah) as jml11 FROM detail_transaksi WHERE tanggal LIKE '%$bulan11%'");
                        if ($selectB11) {
                          while ($data = mysqli_fetch_array($selectB11)) {
                            $jumlah11 = $data['jml11'];
                          }
                          $selectB12 = mysqli_query($koneksi, "SELECT SUM(jumlah) as jml12 FROM detail_transaksi WHERE tanggal LIKE '%$bulan12%'");
                          if ($selectB12) {
                            while ($data = mysqli_fetch_array($selectB12)) {
                              $jumlah12 = $data['jml12'];
                            }

  ?>

                            <script>
                              document.addEventListener("DOMContentLoaded", () => {
                                new Chart(document.querySelector('#barChart'), {
                                  type: 'bar',
                                  data: {
                                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des'],
                                    datasets: [{
                                      label: 'Grafik Penjualan',
                                      data: [<?php echo ($jumlah1); ?>, <?php echo ($jumlah2); ?>, <?php echo ($jumlah3); ?>, <?php echo ($jumlah4); ?>, <?php echo ($jumlah5); ?>, <?php echo ($jumlah6); ?>, <?php echo ($jumlah7); ?>, <?php echo ($jumlah8); ?>, <?php echo ($jumlah9); ?>, <?php echo ($jumlah10); ?>, <?php echo $jumlah11; ?>, <?php echo ($jumlah12); ?>],
                                      backgroundColor: [
                                        'rgba(255, 99, 132, 0.2)',
                                        'rgba(255, 159, 64, 0.2)',
                                        'rgba(255, 205, 86, 0.2)',
                                        'rgba(75, 192, 192, 0.2)',
                                        'rgba(54, 162, 235, 0.2)',
                                        'rgba(153, 102, 255, 0.2)',
                                        'rgba(201, 203, 207, 0.2)'
                                      ],
                                      borderColor: [
                                        'rgb(255, 99, 132)',
                                        'rgb(255, 159, 64)',
                                        'rgb(255, 205, 86)',
                                        'rgb(75, 192, 192)',
                                        'rgb(54, 162, 235)',
                                        'rgb(153, 102, 255)',
                                        'rgb(201, 203, 207)'
                                      ],
                                      borderWidth: 1
                                    }]
                                  },
                                  options: {
                                    scales: {
                                      y: {
                                        beginAtZero: true
                                      }
                                    }
                                  }
                                });
                              });
                            </script>

                          <?php
                          }
                        }
                      }
                    }
                  }
                }
              }
            }
          }
        }
      }
    }
  } else {
    $bulan1 = $filterTahun . '-' . $bulan1;
    $bulan2 = $filterTahun . '-' . $bulan2;
    $bulan3 = $filterTahun . '-' . $bulan3;
    $bulan4 = $filterTahun . '-' . $bulan4;
    $bulan5 = $filterTahun . '-' . $bulan5;
    $bulan6 = $filterTahun . '-' . $bulan6;
    $bulan7 = $filterTahun . '-' . $bulan7;
    $bulan8 = $filterTahun . '-' . $bulan8;
    $bulan9 = $filterTahun . '-' . $bulan9;
    $bulan10 = $filterTahun . '-' . $bulan10;
    $bulan11 = $filterTahun . '-' . $bulan11;
    $bulan12 = $filterTahun . '-' . $bulan12;

    $selectB1 = mysqli_query($koneksi, "SELECT SUM(jumlah) as jml1 FROM detail_transaksi WHERE tanggal LIKE '%$bulan1%'");
    if ($selectB1) {
      while ($data = mysqli_fetch_array($selectB1)) {
        $jumlah1 = $data['jml1'];
      }
      $selectB2 = mysqli_query($koneksi, "SELECT SUM(jumlah) as jml2 FROM detail_transaksi WHERE tanggal LIKE '%$bulan2%'");
      if ($selectB2) {
        while ($data = mysqli_fetch_array($selectB2)) {
          $jumlah2 = $data['jml2'];
        }
        $selectB3 = mysqli_query($koneksi, "SELECT SUM(jumlah) as jml3 FROM detail_transaksi WHERE tanggal LIKE '%$bulan3%'");
        if ($selectB3) {
          while ($data = mysqli_fetch_array($selectB3)) {
            $jumlah3 = $data['jml3'];
          }
          $selectB4 = mysqli_query($koneksi, "SELECT SUM(jumlah) as jml4 FROM detail_transaksi WHERE tanggal LIKE '%$bulan4%'");
          if ($selectB4) {
            while ($data = mysqli_fetch_array($selectB4)) {
              $jumlah4 = $data['jml4'];
            }
            $selectB5 = mysqli_query($koneksi, "SELECT SUM(jumlah) as jml5 FROM detail_transaksi WHERE tanggal LIKE '%$bulan5%'");
            if ($selectB5) {
              while ($data = mysqli_fetch_array($selectB5)) {
                $jumlah5 = $data['jml5'];
              }
              $selectB6 = mysqli_query($koneksi, "SELECT SUM(jumlah) as jml6 FROM detail_transaksi WHERE tanggal LIKE '%$bulan6%'");
              if ($selectB6) {
                while ($data = mysqli_fetch_array($selectB6)) {
                  $jumlah6 = $data['jml6'];
                }
                $selectB7 = mysqli_query($koneksi, "SELECT SUM(jumlah) as jml7 FROM detail_transaksi WHERE tanggal LIKE '%$bulan7%'");
                if ($selectB7) {
                  while ($data = mysqli_fetch_array($selectB7)) {
                    $jumlah7 = $data['jml7'];
                  }
                  $selectB8 = mysqli_query($koneksi, "SELECT SUM(jumlah) as jml8 FROM detail_transaksi WHERE tanggal LIKE '%$bulan8%'");
                  if ($selectB8) {
                    while ($data = mysqli_fetch_array($selectB8)) {
                      $jumlah8 = $data['jml8'];
                    }
                    $selectB9 = mysqli_query($koneksi, "SELECT SUM(jumlah) as jml9 FROM detail_transaksi WHERE tanggal LIKE '%$bulan9%'");
                    if ($selectB9) {
                      while ($data = mysqli_fetch_array($selectB9)) {
                        $jumlah9 = $data['jml9'];
                      }
                      $selectB10 = mysqli_query($koneksi, "SELECT SUM(jumlah) as jml10 FROM detail_transaksi WHERE tanggal LIKE '%$bulan10%'");
                      if ($selectB10) {
                        while ($data = mysqli_fetch_array($selectB10)) {
                          $jumlah10 = $data['jml10'];
                        }
                        $selectB11 = mysqli_query($koneksi, "SELECT SUM(jumlah) as jml11 FROM detail_transaksi WHERE tanggal LIKE '%$bulan11%'");
                        if ($selectB11) {
                          while ($data = mysqli_fetch_array($selectB11)) {
                            $jumlah11 = $data['jml11'];
                          }
                          $selectB12 = mysqli_query($koneksi, "SELECT SUM(jumlah) as jml12 FROM detail_transaksi WHERE tanggal LIKE '%$bulan12%'");
                          if ($selectB12) {
                            while ($data = mysqli_fetch_array($selectB12)) {
                              $jumlah12 = $data['jml12'];
                            }
                          }
                          ?>


                          <script>
                            document.addEventListener("DOMContentLoaded", () => {
                              new Chart(document.querySelector('#barChart'), {
                                type: 'bar',
                                data: {
                                  labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des'],
                                  datasets: [{
                                    label: 'Grafik Penjualan',
                                    data: [<?php echo ($jumlah1); ?>, <?php echo ($jumlah2); ?>, <?php echo ($jumlah); ?>, <?php echo ($jumlah3); ?>, <?php echo ($jumlah4); ?>, <?php echo ($jumlah5); ?>, <?php echo ($jumlah6); ?>, <?php echo ($jumlah7); ?>, <?php echo ($jumlah8); ?>, <?php echo ($jumlah9); ?>, <?php echo ($jumlah10); ?>, <?php echo ($jumlah11); ?>, <?php echo ($jumlah12); ?>],
                                    backgroundColor: [
                                      'rgba(255, 99, 132, 0.2)',
                                      'rgba(255, 159, 64, 0.2)',
                                      'rgba(255, 205, 86, 0.2)',
                                      'rgba(75, 192, 192, 0.2)',
                                      'rgba(54, 162, 235, 0.2)',
                                      'rgba(153, 102, 255, 0.2)',
                                      'rgba(201, 203, 207, 0.2)'
                                    ],
                                    borderColor: [
                                      'rgb(255, 99, 132)',
                                      'rgb(255, 159, 64)',
                                      'rgb(255, 205, 86)',
                                      'rgb(75, 192, 192)',
                                      'rgb(54, 162, 235)',
                                      'rgb(153, 102, 255)',
                                      'rgb(201, 203, 207)'
                                    ],
                                    borderWidth: 1
                                  }]
                                },
                                options: {
                                  scales: {
                                    y: {
                                      beginAtZero: true
                                    }
                                  }
                                }
                              });
                            });
                          </script>

  <?php
                        }
                      }
                    }
                  }
                }
              }
            }
          }
        }
      }
    }
  }
  ?>

  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title text-center">Grafik Pembelian dan Penjualan</h5>
        <span>Tampilkan Berdasarkan Tahun :</span>
        <div class="col-md-6">
          <form action="" method="POST" class="form-inline">
            <div class="form-check-inline">
              <input class="form-control" type="text" id="filtertanggal" name="filtertahun2">
            </div>
            <div class="form-check-inline">
              <button type="submit" id="tombolfilter" style="margin-bottom: 3px;" name="btnfilter2" class="btn btn-outline-primary">Filter</button>
            </div>
          </form>
        </div>

        <?php
        date_default_timezone_set('Asia/Jakarta');
        $bulan1 = "01";
        $bulan2 = "02";
        $bulan3 = "03";
        $bulan4 = "04";
        $bulan5 = "05";
        $bulan6 = "06";
        $bulan7 = "07";
        $bulan8 = "08";
        $bulan9 = "09";
        $bulan10 = "10";
        $bulan11 = "11";
        $bulan12 = "12";
        $tahunNow = date("Y", strtotime("now"));



        $filterTahun = $_POST['filtertahun2'];

        if ($filterTahun == '') {
          $bulan1 = $tahunNow . '-' . $bulan1;
          $bulan2 = $tahunNow . '-' . $bulan2;
          $bulan3 = $tahunNow . '-' . $bulan3;
          $bulan4 = $tahunNow . '-' . $bulan4;
          $bulan5 = $tahunNow . '-' . $bulan5;
          $bulan6 = $tahunNow . '-' . $bulan6;
          $bulan7 = $tahunNow . '-' . $bulan7;
          $bulan8 = $tahunNow . '-' . $bulan8;
          $bulan9 = $tahunNow . '-' . $bulan9;
          $bulan10 = $tahunNow . '-' . $bulan10;
          $bulan11 = $tahunNow . '-' . $bulan11;
          $bulan12 = $tahunNow . '-' . $bulan12;


          $selectB1 = mysqli_query($koneksi, "SELECT SUM(harga_stok) as jml1 FROM tb_stok WHERE tanggal_masuk LIKE '%$bulan1%'");
          if ($selectB1) {
            while ($data = mysqli_fetch_array($selectB1)) {
              $jumlah1 = $data['jml1'];
              if ($jumlah1 == '') {
                $jumlah1 = "0";
              }
              $selB1 = mysqli_query($koneksi, "SELECT SUM(harga_total) as h1 FROM tb_transaksi WHERE tanggal_transaksi LIKE '%$bulan1%'");
              if ($selB1) {
                while ($dt = mysqli_fetch_array($selB1)) {
                  $hrg1 = $dt['h1'];
                  if ($hrg1 == '') {
                    $hrg1 = "0";
                  }
                }
              }
            }
            $selectB2 = mysqli_query($koneksi, "SELECT SUM(harga_stok) as jml2 FROM tb_stok WHERE tanggal_masuk LIKE '%$bulan2%'");
            if ($selectB2) {
              while ($data = mysqli_fetch_array($selectB2)) {
                $jumlah2 = $data['jml2'];
                if ($jumlah2 == '') {
                  $jumlah2 = "0";
                }
                $selB2 = mysqli_query($koneksi, "SELECT SUM(harga_total) as h2 FROM tb_transaksi WHERE tanggal_transaksi LIKE '%$bulan2%'");
                if ($selB2) {
                  while ($dt = mysqli_fetch_array($selB2)) {
                    $hrg2 = $dt['h2'];
                    if ($hrg2 == '') {
                      $hrg2 = "0";
                    }
                  }
                }
              }
              $selectB3 = mysqli_query($koneksi, "SELECT SUM(harga_stok) as jml3 FROM tb_stok WHERE tanggal_masuk LIKE '%$bulan3%'");
              if ($selectB3) {
                while ($data = mysqli_fetch_array($selectB3)) {
                  $jumlah3 = $data['jml3'];
                  if ($jumlah3 == '') {
                    $jumlah3 = "0";
                  }
                  $selB3 = mysqli_query($koneksi, "SELECT SUM(harga_total) as h3 FROM tb_transaksi WHERE tanggal_transaksi LIKE '%$bulan3%'");
                  if ($selB3) {
                    while ($dt = mysqli_fetch_array($selB3)) {
                      $hrg3 = $dt['h3'];
                      if ($hrg3 == '') {
                        $hrg3 = "0";
                      }
                    }
                  }
                }
                $selectB4 = mysqli_query($koneksi, "SELECT SUM(harga_stok) as jml4 FROM tb_stok WHERE tanggal_masuk LIKE '%$bulan4%'");
                if ($selectB4) {
                  while ($data = mysqli_fetch_array($selectB4)) {
                    $jumlah4 = $data['jml4'];
                    if ($jumlah4 == '') {
                      $jumlah4 = "0";
                    }
                    $selB4 = mysqli_query($koneksi, "SELECT SUM(harga_total) as h4 FROM tb_transaksi WHERE tanggal_transaksi LIKE '%$bulan4%'");
                    if ($selB4) {
                      while ($dt = mysqli_fetch_array($selB4)) {
                        $hrg4 = $dt['h4'];
                        if ($hrg4 == '') {
                          $hrg4 = "0";
                        }
                      }
                    }
                  }
                  $selectB5 = mysqli_query($koneksi, "SELECT SUM(harga_stok) as jml5 FROM tb_stok WHERE tanggal_masuk LIKE '%$bulan5%'");
                  if ($selectB5) {
                    while ($data = mysqli_fetch_array($selectB5)) {
                      $jumlah5 = $data['jml5'];
                      if ($jumlah5 == '') {
                        $jumlah5 = "0";
                      }
                      $selB5 = mysqli_query($koneksi, "SELECT SUM(harga_total) as h5 FROM tb_transaksi WHERE tanggal_transaksi LIKE '%$bulan5%'");
                      if ($selB5) {
                        while ($dt = mysqli_fetch_array($selB5)) {
                          $hrg5 = $dt['h5'];
                          if ($hrg5 == '') {
                            $hrg5 = "0";
                          }
                        }
                      }
                    }
                    $selectB6 = mysqli_query($koneksi, "SELECT SUM(harga_stok) as jml6 FROM tb_stok WHERE tanggal_masuk LIKE '%$bulan6%'");
                    if ($selectB6) {
                      while ($data = mysqli_fetch_array($selectB6)) {
                        $jumlah6 = $data['jml6'];
                        if ($jumlah6 == '') {
                          $jumlah6 = "0";
                        }
                        $selB6 = mysqli_query($koneksi, "SELECT SUM(harga_total) as h6 FROM tb_transaksi WHERE tanggal_transaksi LIKE '%$bulan6%'");
                        if ($selB6) {
                          while ($dt = mysqli_fetch_array($selB6)) {
                            $hrg6 = $dt['h6'];
                            if ($hrg6 == '') {
                              $hrg6 = "0";
                            }
                          }
                        }
                      }
                      $selectB7 = mysqli_query($koneksi, "SELECT SUM(harga_stok) as jml7 FROM tb_stok WHERE tanggal_masuk LIKE '%$bulan7%'");
                      if ($selectB7) {
                        while ($data = mysqli_fetch_array($selectB7)) {
                          $jumlah7 = $data['jml7'];
                          if ($jumlah7 == '') {
                            $jumlah7 = "0";
                          }
                          $selB7 = mysqli_query($koneksi, "SELECT SUM(harga_total) as h7 FROM tb_transaksi WHERE tanggal_transaksi LIKE '%$bulan7%'");
                          if ($selB7) {
                            while ($dt = mysqli_fetch_array($selB7)) {
                              $hrg7 = $dt['h7'];
                              if ($hrg7 == '') {
                                $hrg7 = "0";
                              }
                            }
                          }
                        }
                        $selectB8 = mysqli_query($koneksi, "SELECT SUM(harga_stok) as jml8 FROM tb_stok WHERE tanggal_masuk LIKE '%$bulan8%'");
                        if ($selectB8) {
                          while ($data = mysqli_fetch_array($selectB8)) {
                            $jumlah8 = $data['jml8'];
                            if ($jumlah8 == '') {
                              $jumlah8 = "0";
                            }
                            $selB8 = mysqli_query($koneksi, "SELECT SUM(harga_total) as h8 FROM tb_transaksi WHERE tanggal_transaksi LIKE '%$bulan8%'");
                            if ($selB8) {
                              while ($dt = mysqli_fetch_array($selB8)) {
                                $hrg8 = $dt['h8'];
                                if ($hrg8 == '') {
                                  $hrg8 = "0";
                                }
                              }
                            }
                          }
                          $selectB9 = mysqli_query($koneksi, "SELECT SUM(harga_stok) as jml9 FROM tb_stok WHERE tanggal_masuk LIKE '%$bulan9%'");
                          if ($selectB9) {
                            while ($data = mysqli_fetch_array($selectB9)) {
                              $jumlah9 = $data['jml9'];
                              if ($jumlah9 == '') {
                                $jumlah9 = "0";
                              }
                              $selB9 = mysqli_query($koneksi, "SELECT SUM(harga_total) as h9 FROM tb_transaksi WHERE tanggal_transaksi LIKE '%$bulan9%'");
                              if ($selB9) {
                                while ($dt = mysqli_fetch_array($selB9)) {
                                  $hrg9 = $dt['h9'];
                                  if ($hrg9 == '') {
                                    $hrg9 = "0";
                                  }
                                }
                              }
                            }
                            $selectB10 = mysqli_query($koneksi, "SELECT SUM(harga_stok) as jml10 FROM tb_stok WHERE tanggal_masuk LIKE '%$bulan10%'");
                            if ($selectB10) {
                              while ($data = mysqli_fetch_array($selectB10)) {
                                $jumlah10 = $data['jml10'];
                                if ($jumlah10 == '') {
                                  $jumlah10 = "0";
                                }
                                $selB10 = mysqli_query($koneksi, "SELECT SUM(harga_total) as h10 FROM tb_transaksi WHERE tanggal_transaksi LIKE '%$bulan10%'");
                                if ($selB10) {
                                  while ($dt = mysqli_fetch_array($selB10)) {
                                    $hrg10 = $dt['h10'];
                                    if ($hrg10 == '') {
                                      $hrg10 = "0";
                                    }
                                  }
                                }
                              }
                              $selectB11 = mysqli_query($koneksi, "SELECT SUM(harga_stok) as jml11 FROM tb_stok WHERE tanggal_masuk LIKE '%$bulan11%'");
                              if ($selectB11) {
                                while ($data = mysqli_fetch_array($selectB11)) {
                                  $jumlah11 = $data['jml11'];
                                  if ($jumlah11 == '') {
                                    $jumlah11 = "0";
                                  }
                                  $selB11 = mysqli_query($koneksi, "SELECT SUM(harga_total) as h11 FROM tb_transaksi WHERE tanggal_transaksi LIKE '%$bulan11%'");
                                  if ($selB11) {
                                    while ($dt = mysqli_fetch_array($selB11)) {
                                      $hrg11 = $dt['h11'];
                                      if ($hrg11 == '') {
                                        $hrg11 = "0";
                                      }
                                    }
                                  }
                                }
                                $selectB12 = mysqli_query($koneksi, "SELECT SUM(harga_stok) as jml12 FROM tb_stok WHERE tanggal_masuk LIKE '%$bulan12%'");
                                if ($selectB12) {
                                  while ($data = mysqli_fetch_array($selectB12)) {
                                    $jumlah12 = $data['jml12'];
                                    if ($jumlah12 == '') {
                                      $jumlah12 = "0";
                                    }
                                    $selB12 = mysqli_query($koneksi, "SELECT SUM(harga_total) as h12 FROM tb_transaksi WHERE tanggal_transaksi LIKE '%$bulan12%'");
                                    if ($selB12) {
                                      while ($dt = mysqli_fetch_array($selB12)) {
                                        $hrg12 = $dt['h12'];
                                        if ($hrg12 == '') {
                                          $hrg12 = "0";
                                        }
                                      }
                                    }
                                  }

        ?>

                                  <!-- Column Chart -->
                                  <div id="columnChart"></div>

                                  <script>
                                    document.addEventListener("DOMContentLoaded", () => {
                                      new ApexCharts(document.querySelector("#columnChart"), {
                                        series: [{
                                          name: 'Pembelian',
                                          data: [<?php echo $jumlah1; ?>, <?php echo $jumlah2; ?>, <?php echo $jumlah3; ?>, <?php echo $jumlah4; ?>, <?php echo $jumlah5; ?>, <?php echo $jumlah6; ?>, <?php echo $jumlah7; ?>, <?php echo $jumlah8; ?>, <?php echo $jumlah9; ?>, <?php echo $jumlah10; ?>, <?php echo $jumlah11; ?>, <?php echo $jumlah12; ?>]
                                        }, {
                                          name: 'Penjualan',
                                          data: [<?php echo $hrg1; ?>, <?php echo $hrg2; ?>, <?php echo $hrg3; ?>, <?php echo $hrg4; ?>, <?php echo $hrg5; ?>, <?php echo $hrg6; ?>, <?php echo $hrg7; ?>, <?php echo $hrg8; ?>, <?php echo $hrg9; ?>, <?php echo $hrg10; ?>, <?php echo $hrg11; ?>, <?php echo $hrg12; ?>]
                                        }],
                                        chart: {
                                          type: 'bar',
                                          height: 450
                                        },
                                        plotOptions: {
                                          bar: {
                                            horizontal: false,
                                            columnWidth: '55%',
                                            endingShape: 'rounded'
                                          },
                                        },
                                        dataLabels: {
                                          enabled: false
                                        },
                                        stroke: {
                                          show: true,
                                          width: 2,
                                          colors: ['transparent']
                                        },
                                        xaxis: {
                                          categories: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des'],
                                        },
                                        yaxis: {
                                          title: {
                                            text: 'Rp (Rupiah)'
                                          }
                                        },
                                        fill: {
                                          opacity: 1
                                        },
                                        tooltip: {
                                          y: {
                                            formatter: function(val) {
                                              return "Rp. " + val
                                            }
                                          }
                                        }
                                      }).render();
                                    });
                                  </script>
                                  <!-- End Column Chart -->

                                <?php
                                }
                              }
                            }
                          }
                        }
                      }
                    }
                  }
                }
              }
            }
          }
        } else {
          $bulan1 = $filterTahun . '-' . $bulan1;
          $bulan2 = $filterTahun . '-' . $bulan2;
          $bulan3 = $filterTahun . '-' . $bulan3;
          $bulan4 = $filterTahun . '-' . $bulan4;
          $bulan5 = $filterTahun . '-' . $bulan5;
          $bulan6 = $filterTahun . '-' . $bulan6;
          $bulan7 = $filterTahun . '-' . $bulan7;
          $bulan8 = $filterTahun . '-' . $bulan8;
          $bulan9 = $filterTahun . '-' . $bulan9;
          $bulan10 = $filterTahun . '-' . $bulan10;
          $bulan11 = $filterTahun . '-' . $bulan11;
          $bulan12 = $filterTahun . '-' . $bulan12;



          $selectB1 = mysqli_query($koneksi, "SELECT SUM(harga_stok) as jml1 FROM tb_stok WHERE tanggal_masuk LIKE '%$bulan1%'");
          if ($selectB1) {
            while ($data = mysqli_fetch_array($selectB1)) {
              $jumlah1 = $data['jml1'];
              if ($jumlah1 == '') {
                $jumlah1 = "0";
              }
              $selB1 = mysqli_query($koneksi, "SELECT SUM(harga_total) as h1 FROM tb_transaksi WHERE tanggal_transaksi LIKE '%$bulan1%'");
              if ($selB1) {
                while ($dt = mysqli_fetch_array($selB1)) {
                  $hrg1 = $dt['h1'];
                  if ($hrg1 == '') {
                    $hrg1 = "0";
                  }
                }
              }
            }
            $selectB2 = mysqli_query($koneksi, "SELECT SUM(harga_stok) as jml2 FROM tb_stok WHERE tanggal_masuk LIKE '%$bulan2%'");
            if ($selectB2) {
              while ($data = mysqli_fetch_array($selectB2)) {
                $jumlah2 = $data['jml2'];
                if ($jumlah2 == '') {
                  $jumlah2 = "0";
                }
                $selB2 = mysqli_query($koneksi, "SELECT SUM(harga_total) as h2 FROM tb_transaksi WHERE tanggal_transaksi LIKE '%$bulan2%'");
                if ($selB2) {
                  while ($dt = mysqli_fetch_array($selB2)) {
                    $hrg2 = $dt['h2'];
                    if ($hrg2 == '') {
                      $hrg2 = "0";
                    }
                  }
                }
              }
              $selectB3 = mysqli_query($koneksi, "SELECT SUM(harga_stok) as jml3 FROM tb_stok WHERE tanggal_masuk LIKE '%$bulan3%'");
              if ($selectB3) {
                while ($data = mysqli_fetch_array($selectB3)) {
                  $jumlah3 = $data['jml3'];
                  if ($jumlah3 == '') {
                    $jumlah3 = "0";
                  }
                  $selB3 = mysqli_query($koneksi, "SELECT SUM(harga_total) as h3 FROM tb_transaksi WHERE tanggal_transaksi LIKE '%$bulan3%'");
                  if ($selB3) {
                    while ($dt = mysqli_fetch_array($selB3)) {
                      $hrg3 = $dt['h3'];
                      if ($hrg3 == '') {
                        $hrg3 = "0";
                      }
                    }
                  }
                }
                $selectB4 = mysqli_query($koneksi, "SELECT SUM(harga_stok) as jml4 FROM tb_stok WHERE tanggal_masuk LIKE '%$bulan4%'");
                if ($selectB4) {
                  while ($data = mysqli_fetch_array($selectB4)) {
                    $jumlah4 = $data['jml4'];
                    if ($jumlah4 == '') {
                      $jumlah4 = "0";
                    }
                    $selB4 = mysqli_query($koneksi, "SELECT SUM(harga_total) as h4 FROM tb_transaksi WHERE tanggal_transaksi LIKE '%$bulan4%'");
                    if ($selB4) {
                      while ($dt = mysqli_fetch_array($selB4)) {
                        $hrg4 = $dt['h4'];
                        if ($hrg4 == '') {
                          $hrg4 = "0";
                        }
                      }
                    }
                  }
                  $selectB5 = mysqli_query($koneksi, "SELECT SUM(harga_stok) as jml5 FROM tb_stok WHERE tanggal_masuk LIKE '%$bulan5%'");
                  if ($selectB5) {
                    while ($data = mysqli_fetch_array($selectB5)) {
                      $jumlah5 = $data['jml5'];
                      if ($jumlah5 == '') {
                        $jumlah5 = "0";
                      }
                      $selB5 = mysqli_query($koneksi, "SELECT SUM(harga_total) as h5 FROM tb_transaksi WHERE tanggal_transaksi LIKE '%$bulan5%'");
                      if ($selB5) {
                        while ($dt = mysqli_fetch_array($selB5)) {
                          $hrg5 = $dt['h5'];
                          if ($hrg5 == '') {
                            $hrg5 = "0";
                          }
                        }
                      }
                    }
                    $selectB6 = mysqli_query($koneksi, "SELECT SUM(harga_stok) as jml6 FROM tb_stok WHERE tanggal_masuk LIKE '%$bulan6%'");
                    if ($selectB6) {
                      while ($data = mysqli_fetch_array($selectB6)) {
                        $jumlah6 = $data['jml6'];
                        if ($jumlah6 == '') {
                          $jumlah6 = "0";
                        }
                        $selB6 = mysqli_query($koneksi, "SELECT SUM(harga_total) as h6 FROM tb_transaksi WHERE tanggal_transaksi LIKE '%$bulan6%'");
                        if ($selB6) {
                          while ($dt = mysqli_fetch_array($selB6)) {
                            $hrg6 = $dt['h6'];
                            if ($hrg6 == '') {
                              $hrg6 = "0";
                            }
                          }
                        }
                      }
                      $selectB7 = mysqli_query($koneksi, "SELECT SUM(harga_stok) as jml7 FROM tb_stok WHERE tanggal_masuk LIKE '%$bulan7%'");
                      if ($selectB7) {
                        while ($data = mysqli_fetch_array($selectB7)) {
                          $jumlah7 = $data['jml7'];
                          if ($jumlah7 == '') {
                            $jumlah7 = "0";
                          }
                          $selB7 = mysqli_query($koneksi, "SELECT SUM(harga_total) as h7 FROM tb_transaksi WHERE tanggal_transaksi LIKE '%$bulan7%'");
                          if ($selB7) {
                            while ($dt = mysqli_fetch_array($selB7)) {
                              $hrg7 = $dt['h7'];
                              if ($hrg7 == '') {
                                $hrg7 = "0";
                              }
                            }
                          }
                        }
                        $selectB8 = mysqli_query($koneksi, "SELECT SUM(harga_stok) as jml8 FROM tb_stok WHERE tanggal_masuk LIKE '%$bulan8%'");
                        if ($selectB8) {
                          while ($data = mysqli_fetch_array($selectB8)) {
                            $jumlah8 = $data['jml8'];
                            if ($jumlah8 == '') {
                              $jumlah8 = "0";
                            }
                            $selB8 = mysqli_query($koneksi, "SELECT SUM(harga_total) as h8 FROM tb_transaksi WHERE tanggal_transaksi LIKE '%$bulan8%'");
                            if ($selB8) {
                              while ($dt = mysqli_fetch_array($selB8)) {
                                $hrg8 = $dt['h8'];
                                if ($hrg8 == '') {
                                  $hrg8 = "0";
                                }
                              }
                            }
                          }
                          $selectB9 = mysqli_query($koneksi, "SELECT SUM(harga_stok) as jml9 FROM tb_stok WHERE tanggal_masuk LIKE '%$bulan9%'");
                          if ($selectB9) {
                            while ($data = mysqli_fetch_array($selectB9)) {
                              $jumlah9 = $data['jml9'];
                              if ($jumlah9 == '') {
                                $jumlah9 = "0";
                              }
                              $selB9 = mysqli_query($koneksi, "SELECT SUM(harga_total) as h9 FROM tb_transaksi WHERE tanggal_transaksi LIKE '%$bulan9%'");
                              if ($selB9) {
                                while ($dt = mysqli_fetch_array($selB9)) {
                                  $hrg9 = $dt['h9'];
                                  if ($hrg9 == '') {
                                    $hrg9 = "0";
                                  }
                                }
                              }
                            }
                            $selectB10 = mysqli_query($koneksi, "SELECT SUM(harga_stok) as jml10 FROM tb_stok WHERE tanggal_masuk LIKE '%$bulan10%'");
                            if ($selectB10) {
                              while ($data = mysqli_fetch_array($selectB10)) {
                                $jumlah10 = $data['jml10'];
                                if ($jumlah10 == '') {
                                  $jumlah10 = "0";
                                }
                                $selB10 = mysqli_query($koneksi, "SELECT SUM(harga_total) as h10 FROM tb_transaksi WHERE tanggal_transaksi LIKE '%$bulan10%'");
                                if ($selB10) {
                                  while ($dt = mysqli_fetch_array($selB10)) {
                                    $hrg10 = $dt['h10'];
                                    if ($hrg10 == '') {
                                      $hrg10 = "0";
                                    }
                                  }
                                }
                              }
                              $selectB11 = mysqli_query($koneksi, "SELECT SUM(harga_stok) as jml11 FROM tb_stok WHERE tanggal_masuk LIKE '%$bulan11%'");
                              if ($selectB11) {
                                while ($data = mysqli_fetch_array($selectB11)) {
                                  $jumlah11 = $data['jml11'];
                                  if ($jumlah11 == '') {
                                    $jumlah11 = "0";
                                  }
                                  $selB11 = mysqli_query($koneksi, "SELECT SUM(harga_total) as h11 FROM tb_transaksi WHERE tanggal_transaksi LIKE '%$bulan11%'");
                                  if ($selB11) {
                                    while ($dt = mysqli_fetch_array($selB11)) {
                                      $hrg11 = $dt['h11'];
                                      if ($hrg11 == '') {
                                        $hrg11 = "0";
                                      }
                                    }
                                  }
                                }
                                $selectB12 = mysqli_query($koneksi, "SELECT SUM(harga_stok) as jml12 FROM tb_stok WHERE tanggal_masuk LIKE '%$bulan12%'");
                                if ($selectB12) {
                                  while ($data = mysqli_fetch_array($selectB12)) {
                                    $jumlah12 = $data['jml12'];
                                    if ($jumlah12 == '') {
                                      $jumlah12 = "0";
                                    }
                                    $selB12 = mysqli_query($koneksi, "SELECT SUM(harga_total) as h12 FROM tb_transaksi WHERE tanggal_transaksi LIKE '%$bulan12%'");
                                    if ($selB12) {
                                      while ($dt = mysqli_fetch_array($selB12)) {
                                        $hrg12 = $dt['h12'];
                                        if ($hrg12 == '') {
                                          $hrg12 = "0";
                                        }
                                      }
                                    }
                                  }

                                ?>

                                  <!-- Column Chart -->
                                  <div id="columnChart"></div>

                                  <script>
                                    document.addEventListener("DOMContentLoaded", () => {
                                      new ApexCharts(document.querySelector("#columnChart"), {
                                        series: [{
                                          name: 'Pembelian',
                                          data: [<?php echo $jumlah1; ?>, <?php echo $jumlah2; ?>, <?php echo $jumlah3; ?>, <?php echo $jumlah4; ?>, <?php echo $jumlah5; ?>, <?php echo $jumlah6; ?>, <?php echo $jumlah7; ?>, <?php echo $jumlah8; ?>, <?php echo $jumlah9; ?>, <?php echo $jumlah10; ?>, <?php echo $jumlah11; ?>, <?php echo $jumlah12; ?>]
                                        }, {
                                          name: 'Penjualan',
                                          data: [<?php echo $hrg1; ?>, <?php echo $hrg2; ?>, <?php echo $hrg3; ?>, <?php echo $hrg4; ?>, <?php echo $hrg5; ?>, <?php echo $hrg6; ?>, <?php echo $hrg7; ?>, <?php echo $hrg8; ?>, <?php echo $hrg9; ?>, <?php echo $hrg10; ?>, <?php echo $hrg11; ?>, <?php echo $hrg12; ?>]
                                        }],
                                        chart: {
                                          type: 'bar',
                                          height: 450
                                        },
                                        plotOptions: {
                                          bar: {
                                            horizontal: false,
                                            columnWidth: '55%',
                                            endingShape: 'rounded'
                                          },
                                        },
                                        dataLabels: {
                                          enabled: false
                                        },
                                        stroke: {
                                          show: true,
                                          width: 2,
                                          colors: ['transparent']
                                        },
                                        xaxis: {
                                          categories: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des'],
                                        },
                                        yaxis: {
                                          title: {
                                            text: 'Rp (Rupiah)'
                                          }
                                        },
                                        fill: {
                                          opacity: 1
                                        },
                                        tooltip: {
                                          y: {
                                            formatter: function(val) {
                                              return "Rp. " + val
                                            }
                                          }
                                        }
                                      }).render();
                                    });
                                  </script>
                                  <!-- End Column Chart -->

        <?php
                                }
                              }
                            }
                          }
                        }
                      }
                    }
                  }
                }
              }
            }
          }
        } ?>

      </div>
    </div>
  </div>



</main><!-- End #main -->