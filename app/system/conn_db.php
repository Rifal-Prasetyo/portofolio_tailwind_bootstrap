<?php 

$host = '127.0.0.1';
$user = 'root';
$pass = '';
$database = 'tugasakhir';
$conn = null;
try {
    $conn = new PDO("mysql:host=$host;dbname=$database", $user, $pass);
} catch (PDOException $error) {
    echo 'koneksi gagal. periksa konfigurasi anda'. $error->getMessage();
}