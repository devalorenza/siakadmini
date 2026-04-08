<?php
$conn = mysqli_connect("localhost", "root", "", "siakad");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>