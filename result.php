<?php
session_start();
if (!isset($_SESSION['data'])) {
    die("Tidak ada data yang diproses.");
}

$data = $_SESSION['data'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Pendaftaran</title>
    <style>
        table {
            width: 80%;
            margin: auto;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        h2 {
            text-align: center;
        }
    </style>
</head>
<body>
    <h2>Hasil Pendaftaran</h2>
    <table>
        <tr><th>Nama</th><td><?= htmlspecialchars($data['name']) ?></td></tr>
        <tr><th>Email</th><td><?= htmlspecialchars($data['email']) ?></td></tr>
        <tr><th>Umur</th><td><?= htmlspecialchars($data['age']) ?></td></tr>
        <tr><th>Pesan</th><td><?= nl2br(htmlspecialchars($data['message'])) ?></td></tr>
        <tr><th>Browser</th><td><?= htmlspecialchars($data['browser']) ?></td></tr>
    </table>

    <h2>Isi File</h2>
    <table>
        <tr><th>Baris</th><th>Konten</th></tr>
        <?php foreach ($data['fileContent'] as $lineNumber => $line): ?>
            <tr>
                <td><?= $lineNumber + 1 ?></td>
                <td><?= htmlspecialchars($line) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
