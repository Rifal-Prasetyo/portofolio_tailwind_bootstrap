<?php 
$search = $_POST['search'] ;
ini_set('error_reporting', E_ALL);
ini_set( 'display_errors', 1 );
include "conn_db.php";
if($conn) {
    if($search === 'all') {
    $query = "SELECT * FROM blog ORDER BY id DESC";
    } else {
        $query = "SELECT * FROM blog WHERE title LIKE '%$search%'";
    }
    $stmt = $conn->prepare($query);
    $stmt->execute();
  
    $listblog = $stmt->fetchAll(PDO::FETCH_ASSOC);

  
}

?>
<thead>
            <tr class="table-primary">
              <th scope="col">id</th>
              <th scope="col">Judul</th>
              <th scope="col">Gambar</th>
              <th scope="col-4">Konten</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            foreach($listblog as $blog) {
            ?>
            <tr>
              <th scope="row"><?= $blog['id'] ?> </th>
              <td><?= $blog['title'] ?></td>
              <td><a href="../app/system/img/<?= $blog['image'] ?>" target="_blank" class="btn btn-info">Lihat</a></td>
              <td>
              <?= $blog['highlight'] ?>
              </td>
              <td>
                <div class="tw-flex">
                  <a href="edit_blog.php?where=blog&edit=<?= $blog['id'] ?>" class="tw-mr-2"
                    ><span class="badge text-bg-warning"
                      >edit<i data-feather="edit-2"></i></span></a
                  ><a  onclick="showPopup('blog', <?= $blog['id']; ?>)"
                    ><span class="badge text-bg-danger"
                      >hapus<i data-feather="trash"></i></span
                  ></a>
                </div>
              </td>
            </tr>
            <?php 
            }
            ?>
          </tbody>