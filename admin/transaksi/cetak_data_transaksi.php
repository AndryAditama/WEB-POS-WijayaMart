<?php
require_once __DIR__ . '/vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf();

//koneksi ke database mysql,
$koneksi = mysqli_connect("localhost", "root", "", "wijayamart");

//cek jika koneksi ke mysql gagal, maka akan tampil pesan berikut
if (mysqli_connect_errno()) {
    echo "Gagal melakukan koneksi ke MySQL: " . mysqli_connect_error();
}

//script untuk mencetak data ke excel
// header("Content-type: application/vnd-ms-excel");
// header("Content-Disposition: attachment; filename=hasil-ekspor.xls");

$nama_dokumen = 'Data Transaksi Penjualan';
ob_start();
?>
<?php
$profil = mysqli_query($koneksi, "SELECT * FROM profil_toko") or die(mysqli_error($koneksi));
while ($profiltoko = mysqli_fetch_array($profil)) {
    $namatoko = $profiltoko['nama_toko'];
    $alamattoko = $profiltoko['alamat'];
    $nohp = $profiltoko['no_hp'];
    $email = $profiltoko['email'];
}
?>
<html>

<head>
    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">

</head>

<body>
    <div style="text-align: center;">
        <center>
            <b style="font-size: 18px;">Data Transaksi Penjualan</b><br>
            <b style="font-size: 22px;"><?php echo $namatoko; ?></b><br>
            <b style="font-size: 14px;"><?php echo $alamattoko; ?></b><br>
            <b style="font-size: 12px;">No. Telepon : <?php echo $nohp; ?>, Email : <?php echo $email; ?></b><br><br>

        </center>

    </div>

    <table border="1" style="border-width: 0,5px; border: solid; width: 100%;">
        <thead style="font-weight: bold;">
            <tr>
                <td style="font-weight: bold;">No.</td>
                <td style="font-weight: bold;">No. Transaksi</td>
                <td style="font-weight: bold;">Tanggal</td>
                <td style="font-weight: bold;">Barang</td>
                <td style="font-weight: bold;">Total Harga</td>
                <td style="font-weight: bold;">Bayar</td>
                <td style="font-weight: bold;">Kembalian</td>
                <td style="font-weight: bold;">Admin</td>
            </tr>
        </thead>
        <tbody>

            <?php
            $sql = mysqli_query($koneksi, "SELECT *, GROUP_CONCAT('<li>',nama_barang,' (',jumlah,')</li>' SEPARATOR '') as tr_list, GROUP_CONCAT(jumlah SEPARATOR ', ') as jumlah_list FROM detail_transaksi INNER JOIN tb_transaksi ON detail_transaksi.no_transaksi = tb_transaksi.nomor_transaksi INNER JOIN tb_barang ON detail_transaksi.idbarang = tb_barang.id_barang INNER JOIN tb_user ON tb_transaksi.admin = tb_user.id_user GROUP BY no_transaksi ORDER BY no_transaksi DESC") or die(mysqli_error($koneksi));

            //jika query diatas menghasilkan nilai > 0 maka menjalankan script di bawah if...
            if (mysqli_num_rows($sql) > 0) {
                //membuat variabel $no untuk menyimpan nomor urut
                $no = 1;
                //melakukan perulangan while dengan dari dari query $sql
                while ($data = mysqli_fetch_assoc($sql)) {
                    $notr = $data['no_transaksi'];
                    $tgl = $data['tanggal_transaksi'];
                    $jumbrg = $data['tr_list'];
                    $listjumlah = $data['jumlah_list'];
                    $totalbayar = $data['harga_total'];
                    $bayar = $data['bayar'];
                    $kembalian = $data['kembalian'];
                    $admin = $data['nama'];

                    $harga_indonesia = number_format($totalbayar, 0, ',', '.');
                    $bayar_indonesia = number_format($bayar, 0, ',', '.');
                    $kembalian_indonesia = number_format($kembalian, 0, ',', '.');

                    switch (date('m', strtotime($tgl))) {
                        case '01':
                            # code...
                            $bulan = 'Januari';
                            break;
                        case '02':
                            # code...
                            $bulan = 'Februari';
                            break;
                        case '03':
                            # code...
                            $bulan = 'Maret';
                            break;
                        case '04':
                            # code...
                            $bulan = 'April';
                            break;
                        case '05':
                            # code...
                            $bulan = 'Mei';
                            break;
                        case '06':
                            # code...
                            $bulan = 'Juni';
                            break;
                        case '07':
                            # code...
                            $bulan = 'Juli';
                            break;
                        case '08':
                            # code...
                            $bulan = 'Agustus';
                            break;
                        case '09':
                            # code...
                            $bulan = 'September';
                            break;
                        case '10':
                            # code...
                            $bulan = 'Oktober';
                            break;
                        case '11':
                            # code...
                            $bulan = 'November';
                            break;
                        case '12':
                            # code...
                            $bulan = 'Desember';
                            break;

                        default:
                            $bulan = 'kosong';
                            break;
                    }
                    $tggl = date('d', strtotime($tgl));
                    $thn = date('Y', strtotime($tgl));
                    $waktu = date('H:i:s', strtotime($tgl));

                    switch (date('l', strtotime($tgl))) {
                        case 'Sunday':
                            $hari = 'Minggu';
                            break;
                        case 'Monday':
                            $hari = 'Senin';
                            break;
                        case 'Tuesday':
                            $hari = 'Selasa';
                            break;
                        case 'Wednesday':
                            $hari = 'Rabu';
                            break;
                        case 'Thursday':
                            $hari = 'Kamis';
                            break;
                        case 'Friday':
                            $hari = 'Jumat';
                            break;
                        case 'Saturday':
                            $hari = 'Sabtu';
                            break;

                        default:
                            # code...
                            $hari = 'kosong';
                            break;
                    }


                    $tglfull = '' . $hari . ', ' . $tggl . ' ' . $bulan . ' ' . $thn . '';
            ?>


                    <?php
                    echo '
                <tr>
                <td>' . $no++ . '</td>
                <td>' . $notr . '</td>
                <td>' . $tglfull . '</td>
                
                <td><ul>' . $jumbrg . '</ul></td>
                
                <td>Rp.' . $harga_indonesia . '</td>
                <td>Rp.' . $bayar_indonesia . '</td>
                <td>Rp.' . $kembalian_indonesia . '</td>
                <td>' . $admin . '</td>
                </tr>
                ';

                    ?>
            <?php
                }
            }

            ?>
        </tbody>
    </table>
    <?php
    $hitungjumlah = mysqli_query($koneksi, "SELECT SUM(jumlah) as jml FROM detail_transaksi");
    while ($jj = mysqli_fetch_assoc($hitungjumlah)) {
        $jumlahnya = $jj['jml'];
    }


    $hitungduit = mysqli_query($koneksi, "SELECT SUM(harga_total) AS ht FROM tb_transaksi");
    while ($data = mysqli_fetch_array($hitungduit)) {

        $pendapatan = $data['ht'];
    }
    $format_indonesia = number_format($pendapatan, 0, ',', '.');
    ?>
    <h4>Barang Terjual : <?php echo $jumlahnya ?></h4>
    <h4>Jumlah Penjualan : Rp.<?php echo $format_indonesia ?></h4>
</body>

</html>


<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }

    table,
    th,
    td {
        border: 1px solid black;
    }

    th,
    td {
        padding: 10px;
    }

    th {
        background-color: rgb(19, 110, 170);
        color: white;
    }

    tr:hover {
        background-color: #f5f5f5;
    }
</style>

<?php
$html = ob_get_contents();
ob_end_clean();

$mpdf->WriteHTML(utf8_encode($html));
$mpdf->Output("" . $nama_dokumen . ".pdf", 'D');
?>