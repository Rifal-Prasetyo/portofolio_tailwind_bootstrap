<?php
session_start();
// menerima data
include 'conn_db.php';
$user = $_POST['username'];
$pass = $_POST['password'];


if($conn) {
    $query = "SELECT * FROM user WHERE username = '$user'";
    $stmt = $conn->prepare($query);
    $stmt->execute();
}
$user = $stmt->fetchAll(PDO::FETCH_ASSOC);
	// cek username
	if ($user[0]['username']) {


		// cek password
		$row = $user;
		if ($row[0]["password"] == md5($pass)) {
			
			// set session
			$_SESSION["login"] = true;

			// cek remember me
			if(isset($_POST['remember'])) {
				// BUAT COOKIE
				setcookie('id', $row[0]['id'], time()+60);
				setcookie('key', hash('sha256', $row[0]['username'], time()+60));
			}
			header("Location: /tugasakhir/admin/dashboard.php");
			exit;
		}
	} else {
        header("Location: /tugasakhir/admin/login.php?fail=true");
    }
?>