<?php
function curl($url){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}

// Alamat localhost getWisata
$send = curl("http://localhost/rekayasaweb/getWisata.php");
$data = json_decode($send, TRUE);

// Jika data kosong atau error
if (!$data) {
    echo "<p>Gagal mengambil data dari API.</p>";
    exit;
}
?>

<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Tabel Wisata</title>
    <style>
        body { font-family: "Times New Roman", Times, serif; padding: 20px; }
        h2 { background:#deff00; padding:8px 12px; display:inline-block; }
        table { border-collapse: collapse; width: 720px; margin-top: 18px; }
        th, td { border: 1px solid #000; padding: 10px; font-size: 18px; }
        th { background: #f2f2f2; text-align: left; }
        td.tarif { text-align: center; }
    </style>
</head>
<body>

<h2>Data Wisata</h2>

<table>
    <thead>
        <tr>
            <th>ID WISATA</th>
            <th>KOTA</th>
            <th>LANDMARK</th>
            <th>TARIF</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($data as $row): ?>
        <tr>
            <td><?php echo $row["id_wisata"]; ?></td>
            <td><?php echo strtoupper($row["kota"]); ?></td>
            <td><?php echo strtoupper($row["landmark"]); ?></td>
            <td class="tarif">
                <?php 
                    if (is_numeric($row["tarif"])) {
                        echo number_format($row["tarif"], 0, ',', '.');
                    } else {
                        echo strtoupper($row["tarif"]);
                    }
                ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>