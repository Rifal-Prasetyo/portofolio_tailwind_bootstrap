<?php 
include 'conn_db.php';
$judul = $_POST['title'];
$link = $_POST['music-link'];
if(!$judul && !$link) {
    echo 'tidak boleh kosong';
}

if($conn) {
    $query = "INSERT INTO music_list VALUES (NULL, '$judul', '$link')";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $_SESSION['flash'] = true;
  header("location: /tugasakhir/admin/dashboard.php");
} else {
    echo 'gagal ditambahkan';
}
?>