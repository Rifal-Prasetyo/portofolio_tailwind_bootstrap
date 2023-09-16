<?php 
session_start();
if(!isset($_SESSION["login"]) ) {
    echo 'jangan macam-macam';
	die();
}
ini_set('error_reporting', E_ALL);
ini_set( 'display_errors', 1 );
include "conn_db.php";
if($conn) {

    $query = "SELECT * FROM music_list";
    $stmt = $conn->prepare($query);
    $stmt->execute();
  
    $listmusic = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
  
}
?>
<thead>
            <tr class="table-warning">
              <th scope="col">No</th>
              <th scope="col">Judul</th>
              <th scope="col">Musik</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            foreach ($listmusic as $list) :
            ?>
            <tr>
              <th scope="row">1</th>
              <td><?= $list['judul']; ?></td>
              <td>
                <a href="<?= $list['link']; ?>" class="btn btn-info" class="tw-text-white"
                  >dengarkan</a
                >
              </td>
              <td>
                <div class="tw-flex">
                  <button onclick="showPopup('music_list', <?= $list['id'] ;?>)"
                    ><span class="badge text-bg-danger"
                      >hapus<i data-feather="trash"></i></span
                  ></button>
                </div>
              </td>
            </tr>
              <?php 
              endforeach
              ?>
          </tbody>