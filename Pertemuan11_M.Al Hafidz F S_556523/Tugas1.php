<?php
// Variabel profil
$nama   = "M. Al Hafidz F S";
$nim    = "25/556523/SV/25949";
$prodi  = "Teknologi Rekayasa Perangkat Lunak";
$kota   = "Yogyakarta";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Profil Mahasiswa</title>
</head>
<body>

<h2>Profil Mahasiswa</h2>

<table border="1" cellpadding="8" cellspacing="0">
    <tr>
        <th>Keterangan</th>
        <th>Data</th>
    </tr>
    <tr>
        <td>Nama</td>
        <td><?php echo $nama; ?></td>
    </tr>
    <tr>
        <td>NIM</td>
        <td><?php echo $nim; ?></td>
    </tr>
    <tr>
        <td>Program Studi</td>
        <td><?php echo $prodi; ?></td>
    </tr>
    <tr>
        <td>Asal Kota</td>
        <td><?php echo $kota; ?></td>
    </tr>
</table>

</body>
</html>