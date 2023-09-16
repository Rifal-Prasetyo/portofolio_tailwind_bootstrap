<?php
session_start();
if(!isset($_SESSION["login"]) ) {
	header("Location: login.php");
	exit;
}
$judul = 'Buat Blog';
require_once '../app/template/header.php';
include '../app/system/conn_db.php';

?>
    <div class="container" style="margin-top: 3rem;">
        <a href="dashboard.php" class="btn btn-success tw-mb-10"><i data-feather="home"></i>Kembali ke Dashboard</a>
        <div class="tw-w-full">

            <h3 class="fs-4 tw-font-bold">Buat Blog</h3>
            <form action="../app/system/add_blog.php" enctype="multipart/form-data" method="POST">
              <div class="mb-3">
                <label for="title" class="form-label">Judul</label>
                <input
                  type="text"
                  class="form-control"
                  id="title"
                  name="title"
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
                <option selected>Pilih</option>
                <option value="Progamming">Progamming</option>
                <option value="Iseng">Iseng</option>
                <option value="Lain">Lain</option>
              </select>
              <div class="mb-3">
              <label for="x" class="form-label">Konten</label>
              <input id="x" value="Masukkan konten" type="hidden" name="content">
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