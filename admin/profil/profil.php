<?php
//memasukkan file config.php
include('config.php');
?>



<main id="main" class="main">

    <div class="pagetitle">
        <h1>Profil Toko</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Profil Toko</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <?php
    $query = mysqli_query($koneksi, "SELECT * FROM profil_toko");
    if ($query == false) {
        die("Terjadi Kesalahan : " . mysqli_error($koneksi));
    }
    while ($data = mysqli_fetch_array($query)) {

    ?>

        <section class="section profile">
            <div class="row">
                <div class="col-xl-4">

                    <div class="card">
                        <div class="card-body profile-card d-flex flex-column align-items-center">

                            <img src="logo/<?php echo $data['logo']; ?>" alt="Profile" class="logo-toko">

                        </div>
                    </div>

                </div>



                <div class="col-xl-8">

                    <div class="card">
                        <div class="card-body pt-3">
                            <!-- Bordered Tabs -->
                            <ul class="nav nav-tabs nav-tabs-bordered">

                                <li class="nav-item">
                                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profil</button>
                                </li>

                            </ul>
                            <div class="tab-content pt-2">

                                <div class="tab-pane fade show active profile-overview" id="profile-overview">

                                    <h5 class="card-title">Profil Toko</h5>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label ">Nama Toko</div>
                                        <div class="col-lg-9 col-md-8"><?php echo " $data[nama_toko]"; ?></div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Alamat</div>
                                        <div class="col-lg-9 col-md-8"><?php echo " $data[alamat]"; ?></div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Pemilik</div>
                                        <div class="col-lg-9 col-md-8"><?php echo " $data[nama_pemilik]"; ?></div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">No. Telepon</div>
                                        <div class="col-lg-9 col-md-8"><?php echo " $data[no_hp]"; ?></div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Email</div>
                                        <div class="col-lg-9 col-md-8"><?php echo " $data[email]"; ?></div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Facebook</div>
                                        <div class="col-lg-9 col-md-8"><?php echo " $data[facebook]"; ?></div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Instagram</div>
                                        <div class="col-lg-9 col-md-8"><?php echo " $data[instagram]"; ?></div>
                                    </div>

                                </div>

                                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                                    </td>
                                    </tr>
                                <?php
                            }

                                ?>

                                <?php
                                $query = mysqli_query($koneksi, "SELECT * FROM profil_toko");
                                if ($query == false) {
                                    die("Terjadi Kesalahan : " . mysqli_error($koneksi));
                                }
                                while ($data = mysqli_fetch_array($query)) {
                                    $id_toko = $data['id_profil'];
                                    $currentImage = $data['logo'];
                                ?>

                                    <!-- Profile Edit Form -->
                                    <form method="post" action="index.php?page=edit_profil" enctype="multipart/form-data">
                                        <div class="row mb-3">
                                            <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Logo</label>
                                            <div class="col-md-8 col-lg-9">
                                                <img src="logo/<?php echo "$data[logo]"; ?>" alt="Profile">
                                                <div class="pt-2">
                                                    <!-- <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash"></i></a> -->
                                                    <input type="file" name="media_img" accept='.jpg, .jpeg, .png' id="media_img" class="btn btn-sm" title="Upload new profile image">
                                                </div>
                                            </div>
                                        </div>

                                        <input type="hidden" name="id_toko" value="<?php echo "$id_toko"; ?>">
                                        <input type="hidden" name="img_url" value="<?php echo "$data[logo]"; ?>">


                                        <div class="row mb-3">
                                            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Nama Toko</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="nama_toko" type="text" class="form-control" id="fullName" value="<?php echo "$data[nama_toko]"; ?>">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Address" class="col-md-4 col-lg-3 col-form-label">Alamat</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="alamat" type="text" class="form-control" id="Address" value="<?php echo "$data[alamat]"; ?>">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Address" class="col-md-4 col-lg-3 col-form-label">Pemilik</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="nama_pemilik" type="text" class="form-control" id="Address" value="<?php echo "$data[nama_pemilik]"; ?>">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Phone" class="col-md-4 col-lg-3 col-form-label">No. Telepon</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="no_hp" type="text" class="form-control" id="Phone" value="<?php echo "$data[no_hp]"; ?>">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="email" type="email" class="form-control" id="Email" value="<?php echo "$data[email]"; ?>">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Facebook" class="col-md-4 col-lg-3 col-form-label">Facebook</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="facebook" type="text" class="form-control" id="Facebook" value="<?php echo "$data[facebook]"; ?>">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Instagram" class="col-md-4 col-lg-3 col-form-label">Instagram</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="instagram" type="text" class="form-control" id="Instagram" value="<?php echo "$data[instagram]"; ?>">
                                            </div>
                                        </div>

                                    <?php
                                }
                                    ?>

                                    <div class="text-center">
                                        <button type="submit" name="btnedit" class="btn btn-primary"><span class="bi bi-check-circle"> Simpan Profil</span></button>
                                    </div>
                                    </form><!-- End Profile Edit Form -->



                                </div>

                            </div><!-- End Bordered Tabs -->

                        </div>
                    </div>

                </div>
            </div>
        </section>

</main><!-- End #main -->