<?php 
session_start();
if(!isset($_SESSION["login"]) ) {
	header("Location: login.php");
	exit;
}
ini_set('error_reporting', E_ALL);
ini_set( 'display_errors', 1 );
// header 
$judul = "Dashboard Admin";
require_once '../app/template/header.php';
include '../app/system/conn_db.php';
if($conn) {
  $query = "SELECT * FROM music_list";

  $stmt = $conn->prepare($query);
  $stmt->execute();
  $listmusic = $stmt->fetchAll(PDO::FETCH_ASSOC);
}


?>
    <!-- Atas  -->
    <div class="container tw-mt-12 tw-mb-11">
      <div class="tw-w-full tw-bg-slate-50 tw-p-4 tw-justify-between tw-flex">
        <a href="../index.php" class="btn btn-primary"><i data-feather="home"></i></a>
        <a href="create_blog.php" class="btn btn-success"
          ><i data-feather="edit-3"></i>Buat Blog</a
        >
      </div>
      <!-- search div  -->
      <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">Cari Postingan</a>
          <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarScroll"
            aria-controls="navbarScroll"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarScroll">
            <div class="d-flex" role="search">
              <input
                class="form-control me-2"
                type="search"
                placeholder="Cari Postingan"
                aria-label="Search"
                id="search_input"
                oninput="search()"
                
              />
            </div>
          </div>
        </div>
      </nav>
      <!-- table post  -->
      <div class="tw-w-full tw-flex">
        <table class="table table-striped" id="table_display">
        </table>
      </div>
    </div>
    <div class="container tw-mb-11">
      <div
        class="tw-w-full tw-bg-slate-50 tw-p-4 tw-flex"
        style="justify-content: space-between"
      >
        <h4 class="tw-font-bold">Tambahkan musik sesuka anda</h4>
        <a
          href="#"
          class="btn btn-info"
          data-bs-toggle="modal"
          data-bs-target="#modalPopup"
          ><i data-feather="music"></i>Tambah Musik</a
        >
      </div>
      <div class="tw-w-full tw-flex">
        <table class="table table-striped" id="table_music">
          
        </table>
      </div>
    </div>
    <!-- Modal  -->
    <div
      class="modal fade"
      id="modalPopup"
      tabindex="-1"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">
              Tambah Musik <i data-feather="edit-3" class="tw-ml-4"></i>
            </h1>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
            <form action="../app/system/add_music.php" method="POST" >
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Judul</label>
                <input
                  type="text"
                  class="form-control"
                  id="title"
                  name="title"
                  aria-describedby="title"
                />
                
              </div>
              <div class="mb-3">
                <label for="link-music" class="form-label">link lagu</label>
                <input
                  type="text"
                  class="form-control"
                  id="link-music"
                  name="music-link"
                  aria-describedby="emailHelp"
                />
              </div>
            
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-bs-dismiss="modal"
            >
              Tutup
            </button>
            <button type="submit" class="btn btn-primary">
              Tambah musik <i data-feather="music"></i>
            </button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
      <?php 
      if(isset($_SESSION['flash'])) {
        
      ?>
      window.onload = function () {
        Swal.fire('Berhasil ditambahkan');
      }
      <?php
      
      }
      unset($_SESSION['flash']);
      ?>
      <?php 
      if(isset($_SESSION['flash-2'])) {
        
      ?>
      window.onload = function () {
        Swal.fire('Berhasil diubah');
      }
      <?php
      
      }
      unset($_SESSION['flash-2']);
      ?>
      function showPopup(a, b) {
        Swal.fire({
          title: 'Apa kamu yakin?',
          text: "Kamu tidak bisa membatalkan aksi ini jika iya",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya, Hapus'
        }).then((result) => {
          if (result.isConfirmed) {
            delete_query(a, b);
            Swal.fire(
              'Terhapus!',
              'Kueri mu berhasil kehapus.',
              'success'
            )
            if(a == 'music_list') {
            music();
            } else {
              search();
            }
          }
        })
      }
    </script>
    <script>
      window.onload = function() {
        search();
        music();
      };
          function search() {
            var search = document.getElementById('search_input').value;
            if(search) {
              var search = search;
            } else {
              var search = 'all';
            }
            console.log(search);
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "../app/system/blogs-dashboard.php", true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Menampilkan respons dari server
                    document.getElementById("table_display").innerHTML = xhr.responseText;
                }
            };
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            var data = "search=" + encodeURIComponent(search) ;
            xhr.send(data);
    }
    function music() {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "../app/system/list_music.php", true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Menampilkan respons dari server
                    document.getElementById("table_music").innerHTML = xhr.responseText;
                }
            };
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            var data = "table=ppp" ;
            xhr.send(data);
          }

    function delete_query(table, query) {

            var xhr = new XMLHttpRequest();
            xhr.open("POST", "../app/system/delete_query.php", true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Menampilkan respons dari server
                    return  xhr.responseText;
                }
            };
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            var data = "table=" + encodeURIComponent(table) + "&id=" + encodeURIComponent(query) ;
            xhr.send(data);
          }
    </script>

<?php
require_once '../app/template/footer.php'
?>
