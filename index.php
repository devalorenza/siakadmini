<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

require_once 'classes/Mahasiswa.php';
require_once 'classes/MataKuliah.php';
require_once 'classes/Nilai.php';
require_once 'classes/LaporanKHS.php';

// ============================
// Inisialisasi session
// ============================
if (!isset($_SESSION['mahasiswa'])) $_SESSION['mahasiswa'] = [];
if (!isset($_SESSION['matakuliah'])) $_SESSION['matakuliah'] = [];
if (!isset($_SESSION['nilai'])) $_SESSION['nilai'] = [];

// ============================
// Tambah Mahasiswa
// ============================
if (isset($_POST['tambah_mhs'])) {
    $_SESSION['mahasiswa'][] = [
        'nama' => $_POST['nama'],
        'nim' => $_POST['nim']
    ];
}

// ============================
// Tambah Mata Kuliah
// ============================
if (isset($_POST['tambah_mk'])) {
    $_SESSION['matakuliah'][] = [
        'nama' => $_POST['nama_mk'],
        'sks' => $_POST['sks']
    ];
}

// ============================
// Tambah Nilai
// ============================
if (isset($_POST['tambah_nilai'])) {
    $_SESSION['nilai'][] = [
        'nim' => $_POST['nim_mhs'],
        'mk' => $_POST['mk'],
        'nilai' => $_POST['nilai']
    ];
}

// ============================
// Reset Semua Data
// ============================
if (isset($_POST['reset'])) {
    unset($_SESSION['mahasiswa'], $_SESSION['matakuliah'], $_SESSION['nilai']);
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>SIAKAD MINI - Pink Theme</title>
    <style>
        body { font-family: Arial; background: #ffe6f0; margin:0; padding:0;}
        .container { width: 750px; margin:30px auto; background:#fff0f5; padding:25px; border-radius:12px; box-shadow:0 4px 15px rgba(0,0,0,0.1);}
        h1 { text-align:center; color:#d6336c; margin-bottom:15px;}
        h3 { color:#e75480; margin-bottom:10px;}
        input, select, button { padding:10px; margin:6px 0; width:100%; border-radius:6px; border:1px solid #e75480; font-size:14px;}
        button { background:#d6336c; color:#fff; border:none; cursor:pointer; font-weight:bold; transition:0.3s;}
        button:hover { background:#e75480;}
        table { width:100%; border-collapse:collapse; margin-top:10px;}
        th, td { border:1px solid #d6336c; padding:8px; text-align:center;}
        th { background-color:#f8bbd0; color:#fff;}
        tr:nth-child(even){ background-color:#ffe6f2;}
        .card { background:#ffd6eb; padding:15px; margin-bottom:20px; border-radius:10px; box-shadow:0 3px 10px rgba(0,0,0,0.1);}
        .flex-row { display:flex; gap:15px;}
        .flex-row>div { flex:1;}
        .logout { text-align:right; margin-bottom:15px;}
        .logout a { padding:10px 15px; background:#d6336c; color:#fff; border-radius:6px; text-decoration:none; font-weight:bold;}
        .logout a:hover { background:#e75480;}
    </style>
</head>
<body>
<div class="container">
<h1>SIAKAD MINI - Pink Theme</h1>

<!-- Tombol Logout -->
<div class="logout">
    <a href="logout.php">Logout</a>
</div>

<!-- Form Tambah Mahasiswa -->
<h3>Tambah Mahasiswa</h3>
<form method="POST">
    <div class="flex-row">
        <div><input type="text" name="nama" placeholder="Nama Mahasiswa" required></div>
        <div><input type="text" name="nim" placeholder="NIM" required></div>
    </div>
    <button name="tambah_mhs">Tambah Mahasiswa</button>
</form>

<!-- Form Tambah Mata Kuliah -->
<h3>Tambah Mata Kuliah</h3>
<form method="POST">
    <div class="flex-row">
        <div><input type="text" name="nama_mk" placeholder="Nama Mata Kuliah" required></div>
        <div><input type="number" name="sks" placeholder="SKS" required></div>
    </div>
    <button name="tambah_mk">Tambah Mata Kuliah</button>
</form>

<!-- Form Input Nilai Mahasiswa -->
<h3>Input Nilai Mahasiswa</h3>
<form method="POST">
    <div class="flex-row">
        <div>
            <select name="nim_mhs" required>
                <option value="">Pilih Mahasiswa</option>
                <?php foreach ($_SESSION['mahasiswa'] as $m) {
                    echo "<option value='{$m['nim']}'>{$m['nama']} ({$m['nim']})</option>";
                } ?>
            </select>
        </div>
        <div>
            <select name="mk" required>
                <option value="">Pilih Mata Kuliah</option>
                <?php foreach ($_SESSION['matakuliah'] as $mk) {
                    echo "<option value='{$mk['nama']}'>{$mk['nama']} ({$mk['sks']} SKS)</option>";
                } ?>
            </select>
        </div>
        <div>
            <input type="number" name="nilai" placeholder="Nilai" required>
        </div>
    </div>
    <button name="tambah_nilai">Proses / Simpan Nilai</button>
</form>

<form method="POST">
    <button name="reset">Reset Semua Data</button>
</form>

<hr>

<!-- Tampilkan KHS -->
<h2>Kartu Hasil Studi</h2>
<?php
if(empty($_SESSION['mahasiswa'])) {
    echo "<p style='color:#d6336c; font-weight:bold;'>Belum ada mahasiswa.</p>";
}
if(empty($_SESSION['matakuliah'])) {
    echo "<p style='color:#d6336c; font-weight:bold;'>Belum ada mata kuliah.</p>";
}
if(empty($_SESSION['nilai'])) {
    echo "<p style='color:#d6336c; font-weight:bold;'>Belum ada nilai mahasiswa.</p>";
}

foreach ($_SESSION['mahasiswa'] as $m) {
    $mhs = new Mahasiswa($m['nama'], $m['nim']);
    $laporan = new LaporanKHS($mhs);

    foreach ($_SESSION['nilai'] as $n) {
        if ($n['nim'] == $m['nim']) {
            $mk_data = array_filter($_SESSION['matakuliah'], fn($x) => $x['nama'] == $n['mk']);
            if (!empty($mk_data)) {
                $mk_data = array_values($mk_data)[0];
                $mk = new MataKuliah($mk_data['nama'], $mk_data['sks']);
                $nilai = new Nilai($mk, $n['nilai']);
                $laporan->tambahNilai($nilai);
            }
        }
    }
    $laporan->cetak();
}
?>
</div>
</body>
</html>