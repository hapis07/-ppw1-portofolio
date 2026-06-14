<?php
function hitungIMT($berat, $tinggi) {
    $tinggiMeter = $tinggi / 100;
    $imt = $berat / ($tinggiMeter * $tinggiMeter);

    if ($imt < 18.5) {
        $kategori = "Kurus";
    } elseif ($imt < 25.0) {
        $kategori = "Normal";
    } elseif ($imt < 30.0) {
        $kategori = "Gemuk";
    } else {
        $kategori = "Obesitas";
    }

    return [
        "imt"      => round($imt, 2),
        "kategori" => $kategori
    ];
}

$berat  = 65;  // kg
$tinggi = 170; // cm

$hasil = hitungIMT($berat, $tinggi);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kalkulator IMT</title>
</head>
<body>

<h2>Kalkulator Indeks Massa Tubuh (IMT)</h2>

<table border="1" cellpadding="8" cellspacing="0">
    <tr>
        <th>Keterangan</th>
        <th>Nilai</th>
    </tr>
    <tr>
        <td>Berat Badan</td>
        <td><?php echo $berat; ?> kg</td>
    </tr>
    <tr>
        <td>Tinggi Badan</td>
        <td><?php echo $tinggi; ?> cm</td>
    </tr>
    <tr>
        <td>Nilai IMT</td>
        <td><?php echo $hasil["imt"]; ?></td>
    </tr>
    <tr>
        <td>Kategori</td>
        <td><?php echo $hasil["kategori"]; ?></td>
    </tr>
</table>

<br>
<h3>Tabel Referensi Kategori IMT</h3>
<table border="1" cellpadding="8" cellspacing="0">
    <tr>
        <th>Kategori</th>
        <th>Rentang IMT</th>
    </tr>
    <tr>
        <td>Kurus</td>
        <td>&lt; 18.5</td>
    </tr>
    <tr>
        <td>Normal</td>
        <td>18.5 - 24.9</td>
    </tr>
    <tr>
        <td>Gemuk</td>
        <td>25.0 - 29.9</td>
    </tr>
    <tr>
        <td>Obesitas</td>
        <td>&gt;= 30.0</td>
    </tr>
</table>

</body>
</html>