<?php 
session_start();
if(!isset($_SESSION["login"]) ) {
    echo 'jangan macam-macam';
	die();
}
ini_set('error_reporting', E_ALL);
ini_set( 'display_errors', 1 );
include 'conn_db.php';
$id = $_POST['id'];
$title = $_POST['title'];
$noimage = $_POST['noimage'];
$image = upload_image($noimage);
$category = $_POST['category'];
$slug = slugify($title);
$highlight = potong($_POST['content']);
$content = $_POST['content'];


if($conn) {
    $query = "UPDATE `blog` SET `title` = '$title', `image` = '$image', `category` = '$category', `slug` = '$slug', `highlight` = '$highlight', `content` = '$content'  WHERE `blog`.`id` = $id";
    $stmt = $conn->prepare($query);
    $stmt->execute();

    header('location: /tugasakhir/admin/dashboard.php');
    $_SESSION['flash-2'] = true;
} else {
    echo "<script>
    alert('Kesalahan');
    </script>";
}

//Image Process
function upload_image($check) {
    $upload = $_FILES['image']['name'];
    if($upload == "") {
        return $check;
        exit();
    }
    $namafile = $_FILES['image']['name'];
    $ukuranFile = $_FILES['image']['size'];
    $error = $_FILES['image']['error'];
    $tmpName = $_FILES['image']['tmp_name']; 

    // cek apakah tidak ada gambaryang diupload
		 if ($error === 4) {
            echo "<script>
                alert('pilih gmbar dahulu');
                </script>";
            return false; 
        }
       // cek apakah yang diupload hanya gambar
       $ektensiGambarValid = ['jpg', 'jpeg', 'png', 'bmp'];  
       $ekstensiGambar =  explode( '.', $namafile);
       $ekstensiGambar =  strtolower(end($ekstensiGambar));
       if (!in_array($ekstensiGambar, $ektensiGambarValid) ) {
           echo "<script>
               alert('yang anda masukkan bukan gambar')
               </script>";
           return false;
       }

       // cek ukuran file
       if( $ukuranFile > 1000000) {
           echo "<script>
               alert('ukuran gambar terlalu besar')
               </script>";
           return false;
       }

       // lolos pengecekan, gambar siap di upload 
       // generate nma gambar baru
       $namaFileBaru = uniqid();
       $namaFileBaru .= '.';
       $namaFileBaru .= $ekstensiGambar; 


       move_uploaded_file($tmpName, 'img/'. $namaFileBaru);
           return $namaFileBaru;

}



//slug service
function slugify($string) {
    $string = strtolower($string);
    $string = preg_replace('/[^a-z0-9-]+/', '-', $string);
    $string = trim($string, '-');
  
    return $string;
  }

// Cut 
function potong($string) {
    if (strlen($string) > 100) {
      $string = substr($string, 0, 100);
      $string .= "...";
    }
  
    return $string;
  }
?>