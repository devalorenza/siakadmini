<?php
abstract class User {
    protected $nama;
    protected $id;

    public function __construct($nama, $id) {
        $this->nama = $nama;
        $this->id = $id;
    }

    public function getNama() {
        return $this->nama;
    }

    abstract public function info();
}
?>