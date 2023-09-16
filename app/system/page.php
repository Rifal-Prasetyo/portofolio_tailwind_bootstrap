<?php
$limiter = $_POST['limit'] ;
ini_set('error_reporting', E_ALL);
ini_set( 'display_errors', 1 );
include "conn_db.php";
if($conn) {
  $query = "SELECT COUNT(*) FROM blog";
  $stmt = $conn->prepare($query);
  $stmt->execute();

  $hasil1 = $stmt->fetch(PDO::FETCH_ASSOC);
  $hitung = $hasil1['COUNT(*)'];

    $jumlahDataPerHalaman = 6;
    $jumlahData = $hitung;
    $jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
    $halamanAktif = (isset($limiter)) ? $limiter : 1;
    $awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

    $query = "SELECT * FROM blog LIMIT $awalData, $jumlahDataPerHalaman";
    $stmt = $conn->prepare($query);
    $stmt->execute();
  
    $listblog = $stmt->fetchAll(PDO::FETCH_ASSOC);

  
}
?>
<nav aria-label="...">
  <ul class="pagination pagination-sm">
    <li class="page-item active" aria-current="page">
      <span class="page-link">1</span>
    </li>
    <?php 
    for ($i = 1; $i <= $jumlahHalaman; $i++) {
        echo `<li class="page-item"><a class="page-link" onclick='normal($i)'>3</a></li>`;
    }
    ?>
    
  </ul>
</nav>