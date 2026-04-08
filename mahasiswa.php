<?php
require_once 'User.php';
require_once 'CetakLaporan.php';

class Mahasiswa extends User implements CetakLaporan {
    private $nim;
    private $nilai = [];

    public function __construct($nama, $nim) {
        parent::__construct($nama);
        $this->nim = $nim;
    }

    public function tambahNilai($matkul, $nilai) {
        $this->nilai[$matkul] = $nilai;
    }

    public function hitungIPK() {
        $total = 0;
        $jumlah = count($this->nilai);

        foreach ($this->nilai as $n) {
            $total += $n;
        }

        return $jumlah > 0 ? $total / $jumlah : 0;
    }

    public function cetak() {
        echo "<h3>KHS Mahasiswa</h3>";
        echo "Nama: " . $this->nama . "<br>";
        echo "NIM: " . $this->nim . "<br><br>";

        foreach ($this->nilai as $matkul => $nilai) {
            echo "$matkul : $nilai <br>";
        }

        echo "<br><b>IPK: " . number_format($this->hitungIPK(), 2) . "</b>";
    }

    public function getRole() {
        return "Mahasiswa";
    }
}