<?php
session_start();
if(!isset($_SESSION["login"]) ) {
	header("Location: login.php");
	exit;
}
ini_set('error_reporting', E_ALL);
ini_set( 'display_errors', 1 );
$where = $_GET['where'];
$edit = $_GET['edit'];
// header 
$judul = "Edit Postingan";
require_once '../app/template/header.php';
include "../app/system/conn_db.php";
if($conn) {
    $query = "SELECT * FROM $where WHERE id = $edit";
    $stmt = $conn->prepare($query);
    $stmt->execute();
  
    $listblog = $stmt->fetch(PDO::FETCH_ASSOC);

  
}
?>
<div class="container" style="margin-top: 3rem;">
<a href="dashboard.php" class="btn btn-success tw-mb-10"><i data-feather="home"></i>Kembali ke Dashboard</a>
        <div class="tw-w-full">

            <h3 class="fs-4 tw-font-bold">Buat Blog</h3>
            <form action="../app/system/edit_blog.php" enctype="multipart/form-data" method="POST">
              <input type="hidden" name="id" value="<?= $listblog['id'] ?>">
              <input type="hidden" name="noimage" value="<?= $listblog['image']; ?>">
              <div class="mb-3">
                <label for="title" class="form-label">Judul</label>
                <input
                  type="text"
                  class="form-control"
                  id="title"
                  name="title"
                  value="<?= $listblog['title']; ?>"
                  aria-describedby="title"
                />
                <div id="title" class="form-text">
                  Judul harus lebih dari 10 karakter
                </div>
              </div>
              <div class="mb-3">
                <label for="image" class="form-label">image</label>
                <input
                  type="file"
                  class="form-control"
                  id="image"
                  name="image"
                />
              </div>
              
              <label for="category" class="form-label">Kategori</label>
              <select class="form-select mb-3" id="category" aria-label="Default select example" name="category">
                <option >Pilih</option>
                <option value="Progamming" <?php if($listblog['category'] === 'Progamming') { echo 'selected';} else {echo '';}; ?>>Progamming</option>
                <option value="Iseng" <?php if($listblog['category'] === 'Iseng') { echo 'selected';} else {echo '';}; ?>>Iseng</option>
                <option value="Lain" <?php if($listblog['category'] === 'Lain') { echo 'selected';} else {echo '';} ;?>>Lain</option>
              </select>
              <div class="mb-3">
              <label for="x" class="form-label">Konten</label>
              <input id="x" value="<?php echo $listblog['content'] ?>" type="hidden" name="content">
                <trix-editor input="x"></trix-editor>
              </div>
              <div class="mb-3">
                <button type="submit" name="submit" class="btn btn-primary">Kirim</button>
              </div>
            </form>
        </div>
    </div>
<?php 
require_once '../app/template/footer.php';
?>