<?php
require_once 'User.php';

class Dosen extends User {
    private $nidn;

    public function __construct($nama, $nidn) {
        parent::__construct($nama);
        $this->nidn = $nidn;
    }

    public function getRole() {
        return "Dosen";
    }

    public function infoDosen() {
        return "Nama: $this->nama | NIDN: $this->nidn";
    }
}