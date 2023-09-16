<?php
session_start();
if(!isset($_SESSION["login"]) ) {
    echo 'jangan macam-macam';
	exit;
}
ini_set('error_reporting', E_ALL);
ini_set( 'display_errors', 1 );
include 'conn_db.php';
$tabel = $_POST['table'];
$id = $_POST['id'];
if($conn) {
    $query = "DELETE FROM $tabel WHERE `$tabel`.`id` = $id";
    $stmt = $conn->prepare($query);
    $stmt->execute();

    header('location: /tugasakhir/admin/dashboard.php');
    $_SESSION['flash-3'] = true;
} else {
    echo "<script>
    alert('Kesalahan');
    </script>";
}