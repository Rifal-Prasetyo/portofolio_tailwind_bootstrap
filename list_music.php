<?php 

include './app/system/conn_db.php';

if($conn) {
    $query = "SELECT * FROM music_list";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $listmusic = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($listmusic);
} 
