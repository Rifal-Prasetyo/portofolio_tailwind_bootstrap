<?php 
session_start();
if(isset($_SESSION["login"]) ) {
	header("Location: dashboard.php");
	exit;
}
$judul = 'Login';
require_once '../app/template/header.php';
include '../app/system/conn_db.php';

if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
	$id = $_COOKIE['id'];
	$key = $_COOKIE['key'];

	// ambil username berdasarkan id
  if($conn) {
    $query = "SELECT FROM user WHERE id = $id";
    $stmt = $conn->prepare($query);
    $stmt->execute();

    $check = $stmt->fetchAll(PDO::FETCH_ASSOC);

  }
	$row = $check;


	// cek cookie dan username 
	if ($key === hash('sha256', $row[0]['username'])) {
		$_SESSION['login'] = true;
	}
}



?>
    <div class="position-absolute top-50 start-50 translate-middle">
      <div
        class="tw-p-8 tw-m-4"
        style="border: 2px solid #f86f03; border-radius: 10px"
      >
        <h4 class="tw-font-bold tw-mb-4">Login ke Admin</h4>
        <?php 
        if (isset($_GET['fail'])) :
        ?>
        <p class="text-danger fs-5">Username atau Sandi anda salah</p>
        <?php endif ?>
        <form action="../app/system/auth.php" method="POST">
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Username</label>
            <input
              type="text"
              class="form-control"
              id="exampleInputEmail1"
              aria-describedby="emailHelp"
              name="username"
            />
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label"
              >Password</label
            >
            <input    
              type="password"
              class="form-control"
              id="exampleInputPassword1"
              name="password"
            />
          </div>
          <div class="mb-3 form-check">
            <input
              type="checkbox"
              class="form-check-input"
              id="exampleCheck1"
              name="remember"
            />
            <label class="form-check-label" for="exampleCheck1"
              >ingat Sandi?</label
            >
          </div>
          <button type="submit" class="btn btn-primary">Login</button>
        </form>
      </div>
    </div>
<?php 
require_once '../app/template/footer.php';
?>