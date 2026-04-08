<?php
class Nilai {
    public $matkul;
    public $nilai;

    public function __construct($matkul, $nilai) {
        $this->matkul = $matkul;
        $this->nilai = $nilai;
    }

    public function getBobot() {
        if ($this->nilai >= 85) return 4;
        if ($this->nilai >= 70) return 3;
        if ($this->nilai >= 60) return 2;
        if ($this->nilai >= 50) return 1;
        return 0;
    }
}
?>