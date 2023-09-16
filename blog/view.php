<?php 
ini_set('error_reporting', E_ALL);
ini_set( 'display_errors', 1 );
$get = $_GET['link'];
$judul = "Blog";
require_once '../app/template/header.php';
include '../app/system/conn_db.php';
if ($conn){
    $query = "SELECT * FROM blog WHERE slug='$get'";
    $stmt = $conn->prepare($query);
    $stmt->execute();

    $tampil = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
<div class="container">
    <div class="tw-w-full d-flex justify-content-center">
        <div class=" tw-w-1/2">
            <div class="tw-bg-slate-200 tw-w-full tw-p-4">
                <a href="all_blog.php" class="btn btn-success"><i data-feather="home"></i>Kembali</a>
            </div>
            <h1 class="t tw-font-bold tw-my-4 tw-text-slate-700"><?= $tampil['title'] ?></h1>
            <img src="../app/system/img/<?= $tampil['image'] ?>" alt="Image" srcset="" class="t tw-rounded-lg tw-mb-2 " style="aspect-ratio: 16 / 9 ; object-fit: cover;">
            <p
                class="tw-px-2 tw-py-1 tw-bg-orange-300 tw-m-0 tw-w-1/4 tw-rounded-sm tw-mb-4 tw-relative tw-left-0 tw-top-0 tw-text-white tw-text-center"
              >
                <?= $tampil['category'] ?>
              </p>
            <p class="fs-4 tw-font-roboto">
                <?= $tampil['content'] ?>
            </p>
        </div>
    </div>
</div>
<?php 
require_once '../app/template/footer.php';
?>