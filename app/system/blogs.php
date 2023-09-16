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
<?php 
foreach ($listblog as $list) :
?> 
<div class="col-md-4">
          <article class="tw-w-full">
            <div class="image mb-2">
              <img
                style="width: 20rem; height: auto; aspect-ratio: 16 / 9; object-fit:cover"
                src="../app/system/img/<?= $list['image'] ?>"
                alt="article"
                srcset=""
                class="tw-rounded-lg tw-relative tw-mb-1"
              />
              <p
                class="tw-px-2 tw-py-1 tw-bg-orange-300 tw-m-0  tw-rounded-sm tw-relative tw-left-0 tw-top-0 tw-text-white tw-text-center" style="width: 33.3333%;"
              >
                <?=  $list['category']?>
              </p>
            </div>
            <h4 class="mb-2 tw-font-bold"><?= $list['title'] ?></h4>
            <p
              class=""
              style="
                overflow: hidden;
                text-overflow: ellipsis;
                display: -webkit-box;
                line-clamp: 2;
                -webkit-line-clamp: 1;
                width: 80%;
              "
            >
              <?= $list['highlight'] ?>
            </p>
            <span
              ><a href="../blog/view.php?link=<?= $list['slug'] ?>"
                >Baca Selengkapnya<i
                  data-feather="book-open"
                  class="tw-ml-2"
                ></i></a
            ></span>
          </article>
        </div>
<?php 
endforeach
?>