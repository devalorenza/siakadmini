<!DOCTYPE html>
<html>
<head>
    <title>Input Mahasiswa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

<h1>Input Data Mahasiswa</h1>

<div class="card">

<form action="proses.php" method="POST">

<input type="text" name="nama" placeholder="Nama" required>
<input type="text" name="nim" placeholder="NIM" required>
<input type="text" name="jurusan" placeholder="Jurusan" required>

<h3>Nilai</h3>

<input type="number" name="nilai1" placeholder="Nilai Bisnis Digital" required>
<input type="number" name="nilai2" placeholder="Nilai OOP" required>
<input type="number" name="nilai3" placeholder="Nilai UI/UX" required>

<button type="submit">Simpan</button>

</form>

<br>
<a href="index.php">⬅ Kembali</a>

</div>

</div>

</body>
</html>