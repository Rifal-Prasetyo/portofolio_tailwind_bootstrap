<?php 

$judul = "Semua Blog";
// $active = 'blog';
include './app/system/conn_db.php';
require_once '../app/template/header.php';
?>
<script>
    window.onload = function () {
        normal();
        page();
    };
    function normal(number) {
        if(number) {
            var limit = number;
        } else {
            var limit = 1
        }

            var xhr = new XMLHttpRequest();
            xhr.open("POST", "../app/system/blogs.php", true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Menampilkan respons dari server
                    document.getElementById("blogs").innerHTML = xhr.responseText;
                }
            };
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            var data = "limit=" + encodeURIComponent(limit) ;
            xhr.send(data);
        }
    function page(number) {
        if(number) {
            var limit = number;
        } else {
            var limit = 1
        }
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "../app/system/page.php", true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Menampilkan respons dari server
                    document.getElementById("page").innerHTML = xhr.responseText;
                }
            };
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            var data = "limit=" + encodeURIComponent(limit) ;
            xhr.send(data);
    }
</script>
<div class="container">
    <div class="tw-w-full">
        <a href="../index.php" class="btn btn-success tw-mt-6">Kembali</a>
        <h1 class="text-center tw-font-bold tw-my-4">Semua blog</h1>

        <div class="row  mb-2" id="blogs">

        </div>
    </div>
    <div class="tw-w-full d-flex justify-content-center" id="page">

    </div>
</div>

<?php 
require_once '../app/template/footer.php';
?>