<?php
$namaBulan = [
    1  => "Januari",
    2  => "Februari",
    3  => "Maret",
    4  => "April",
    5  => "Mei",
    6  => "Juni",
    7  => "Juli",
    8  => "Agustus",
    9  => "September",
    10 => "Oktober",
    11 => "November",
    12 => "Desember"
];

$bulanAngka = (int) date("n");
$hariIni    = (int) date("j");
$totalHari  = (int) date("t");
$tahunIni   = date("Y");

$bulanNama  = $namaBulan[$bulanAngka];
$sisaHari   = $totalHari - $hariIni;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Info Bulan Sekarang</title>
</head>
<body>

<h2>Informasi Bulan Sekarang</h2>

<table border="1" cellpadding="8" cellspacing="0">
    <tr>
        <th>Keterangan</th>
        <th>Nilai</th>
    </tr>
    <tr>
        <td>Bulan Sekarang</td>
        <td><?php echo $bulanNama . " " . $tahunIni; ?></td>
    </tr>
    <tr>
        <td>Tanggal Hari Ini</td>
        <td><?php echo $hariIni; ?></td>
    </tr>
    <tr>
        <td>Total Hari dalam Bulan Ini</td>
        <td><?php echo $totalHari; ?> hari</td>
    </tr>
    <tr>
        <td>Sisa Hari di Bulan Ini</td>
        <td><?php echo $sisaHari; ?> hari</td>
    </tr>
</table>

<br>
<p>
    Hari ini adalah tanggal <strong><?php echo $hariIni; ?></strong>
    bulan <strong><?php echo $bulanNama; ?></strong> tahun <strong><?php echo $tahunIni; ?></strong>.
    Masih tersisa <strong><?php echo $sisaHari; ?></strong> hari lagi di bulan ini.
</p>

</body>
</html>