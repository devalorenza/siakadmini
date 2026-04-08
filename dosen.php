<?php
require_once 'User.php';

class Dosen extends User {
    private $nidn;

    public function __construct($nama, $id, $nidn) {
        parent::__construct($nama, $id);
        $this->nidn = $nidn;
    }

    public function info() {
        return "Dosen: $this->nama (NIDN: $this->nidn)";
    }
}
?>