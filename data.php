<?php include 'koneksi.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Mahasiswa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

<h1>Data Mahasiswa</h1>

<div class="card">

<table border="1">
<tr>
    <th>NIM</th>
    <th>Nama</th>
    <th>Jurusan</th>
</tr>

<?php
$data = mysqli_query($conn, "SELECT * FROM mahasiswa");

while ($d = mysqli_fetch_array($data)) {
    echo "<tr>
            <td>$d[nim]</td>
            <td>$d[nama]</td>
            <td>$d[jurusan]</td>
          </tr>";
}
?>

</table>

<br>
<a href="index.php">⬅ Kembali</a>

</div>

</div>

</body>
</html>