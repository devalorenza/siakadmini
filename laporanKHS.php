<?php
require_once 'CetakLaporan.php';

class LaporanKHS implements CetakLaporan {
    private $mahasiswa;
    private $daftarNilai = [];

    public function __construct($mahasiswa) {
        $this->mahasiswa = $mahasiswa;
    }

    public function tambahNilai($nilai) {
        $this->daftarNilai[] = $nilai;
    }

    public function hitungIPK() {
        $total = 0;
        $totalSks = 0;
        foreach ($this->daftarNilai as $n) {
            $total += $n->getBobot() * $n->matkul->sks;
            $totalSks += $n->matkul->sks;
        }
        return $totalSks ? $total / $totalSks : 0;
    }

    public function cetak() {
        echo "<div class='card'>";
        echo "<h2>Kartu Hasil Studi</h2>";
        echo "<p>Nama: " . $this->mahasiswa->getNama() . " (NIM: " . $this->mahasiswa->getNim() . ")</p>";

        echo "<table border='1' cellpadding='5' cellspacing='0'>";
        echo "<tr><th>Mata Kuliah</th><th>SKS</th><th>Nilai</th></tr>";

        foreach ($this->daftarNilai as $n) {
            echo "<tr>
                    <td>{$n->matkul->nama}</td>
                    <td>{$n->matkul->sks}</td>
                    <td>{$n->nilai}</td>
                  </tr>";
        }

        echo "</table>";
        echo "<h3>IPK: " . number_format($this->hitungIPK(), 2) . "</h3>";
        echo "</div><br>";
    }
}
?>