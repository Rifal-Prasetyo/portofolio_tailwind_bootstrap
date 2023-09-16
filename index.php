<?php 
session_start();
$dashboard = false;
if(!isset($_SESSION["login"]) ) {

} else {
  $dashboard = true;
}
ini_set('error_reporting', E_ALL);
ini_set( 'display_errors', 1 );

include './app/system/conn_db.php';

if($conn) {
  $query = "SELECT * FROM blog LIMIT 4";
  $stmt = $conn->prepare($query);
  $stmt->execute();

  $listblog = $stmt->fetchAll(PDO::FETCH_ASSOC);

  $query = "SELECT * FROM music_list";
  $stmt = $conn->prepare($query);
  $stmt->execute();
  $listmusic = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $listmusic = json_encode($listmusic);

}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Portofolio M Rifal Prasetyo</title>
    <link rel="stylesheet" href="./src/tailwind/output.css" />
    <link rel="stylesheet" href="./src/css/bootstrap.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <script src="https://unpkg.com/feather-icons"></script>
    <link
      href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:wght@400;600;700;800&family=Sacramento&family=Work+Sans:wght@100;400;600;700&display=swap"
      rel="stylesheet"
    />
    <style>
      .popup {
			position: fixed;
			top: 50%;
			left: 50%;
			transform: translate(-50%, -50%);
			background-color: #ffffff;
			padding: 20px;
			border: 1px solid #cccccc;
			box-shadow: 0px 0px 10px #cccccc;
			z-index: 9999;
			display: none;
		}
    </style>
  </head>
  <body class=" tw-font-montserrat" >
    <!-- POP UP  -->
    <div class="popup tw-rounded-sm tw-py-2">
      <h1 class=" tw-font-bold">Terima kasih mengunjungi website saya</h1>
      <button id="closeBtn" class="btn btn-primary">Tutup</button>
    </div>
    <!-- NAVBAR  -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container">
        <div class="container-fluid">
          <a class="navbar-brand tw-font-bold" href="#">RIFAL</a>
          <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarText"
            aria-controls="navbarText"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#home">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#about">About</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#blog">Blog</a>
              </li>
            </ul>
            <span class="navbar-text">
              <?php if($dashboard) : ?>
              <a href="admin/dashboard.php"><div class="btn btn-primary">Dashboard</div></a>
              <?php endif ?>
            </span>
          </div>
        </div>
      </div>
    </nav>

    <!-- HERO SECTION  -->
    <section id="home">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-sm-12 col- tw-w-full tw-self-center">
            <h4 class="fs-5 lh-1 tw-font-normal">
              Halo Semua, Perkenalkan saya :
            </h4>
            <h1 class="fs-1 text-info-emphasis tw-font-bold">
              Muhammad Rifal Prasetyo
            </h1>
            <p class="fs-6 lh-sm tw-font-normal">Pelajar | Belajar</p>
            <div class="d-flex mt-2">
              <a href="#about" class="btn btn-primary tw-mr-2">Hubungi Saya</a>
              <a href="https://rifalkom.my.id" class="btn btn-warning"
                >Portofolio<i
                  data-feather="link-2"
                  class="tw-ml-1 tw-text-slate-500"
                ></i
              ></a>
            </div>
            <div class=" mt-2">
              <div class=" tw-hidden " id="tampil">
                <div class="col-6 tw-bg-orange-200 tw-border-orange-700 tw-mr-2 tw-rounded-md">
                  <marquee><p id="song_info" class="tw-m-0" ></p></marquee>
                </div>
                <div class="col-6"></div>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-sm-12 col-">
            <div class="tw-relative tw-mt-10 lg:right-0">
              <img
                class="tw-max-w-full tw-mx-auto"
                src="./src/img/rifal.webp"
                alt="M Rifal Prasetyo"
                srcset=""
              />
            </div>
          </div>
        </div>
      </div>
    </section>
    <svg
      class=""
      style="margin-top: -2rem"
      xmlns="http://www.w3.org/2000/svg"
      viewBox="0 0 1440 320"
    >
      <path
        fill="#03C988"
        fill-opacity="1"
        d="M0,96L80,90.7C160,85,320,75,480,90.7C640,107,800,149,960,160C1120,171,1280,149,1360,138.7L1440,128L1440,320L1360,320C1280,320,1120,320,960,320C800,320,640,320,480,320C320,320,160,320,80,320L0,320Z"
      ></path>
    </svg>
    <section id="about">
      <div class="tw-pb-11" style="background-color: #03c988">
        <div class="container" >
          <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
              <h3 class="pb-2 tw-font-bold">Tentang Saya</h3>
              <p style="width: 80%">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor
                vero maxime suscipit nulla officiis amet a ab labore, sed ad cum!
              </p>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
              <h3 class="pb-2 tw-font-bold">Skill saya</h3>
              <p>Lorem ipsum dolor sit amet consectetur.</p>
              <div class="tw-px-3 tw-py-2 mb-2" style="">
                <div
                  style="
                    width: 50%;
                    border: 2px solid #f94c10;
                    border-radius: 4px;
                    background-color: rgba(255, 198, 13, 0.34);
                  "
                  class="p-2"
                >
                  <div class="row tw-flex">
                    <div class="col-2 tw-relative tw-w-full tw-self-center">
                      <img
                        style="width: 1.5rem; height: auto"
                        src="./src/img/logo/html-5.png"
                        alt="html"
                        srcset=""
                      />
                    </div>
                    <div class="col-10 tw-w-full">
                      <p class="tw-w-full tw-items-center" style="margin: 0">
                        HTML
                      </p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="tw-px-3 tw-py-2 mb-2" style="">
                <div
                  style="
                    width: 50%;
                    border: 2px solid #f94c10;
                    border-radius: 4px;
                    background-color: rgba(255, 198, 13, 0.34);
                  "
                  class="p-2"
                >
                  <div class="row tw-flex">
                    <div class="col-2 tw-relative tw-w-full tw-self-center">
                      <img
                        style="width: 1.5rem; height: auto"
                        src="./src/img/logo/css-3.png"
                        alt="css"
                        srcset=""
                      />
                    </div>
                    <div class="col-10 tw-w-full">
                      <p class="tw-w-full tw-items-center" style="margin: 0">
                        CSS
                      </p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="tw-px-3 tw-py-2 mb-2" style="">
                <div
                  style="
                    width: 50%;
                    border: 2px solid #f94c10;
                    border-radius: 4px;
                    background-color: rgba(255, 198, 13, 0.34);
                  "
                  class="p-2"
                >
                  <div class="row tw-flex">
                    <div class="col-2 tw-relative tw-w-full tw-self-center">
                      <img
                        style="width: 1.5rem; height: auto"
                        src="./src/img/logo/js.png"
                        alt="html"
                        srcset=""
                      />
                    </div>
                    <div class="col-10 tw-w-full">
                      <p class="tw-w-full tw-items-center" style="margin: 0">
                        JS
                      </p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="tw-px-3 tw-py-2 mb-2" style="">
                <div
                  style="
                    width: 50%;
                    border: 2px solid #f94c10;
                    border-radius: 4px;
                    background-color: rgba(255, 198, 13, 0.34);
                  "
                  class="p-2"
                >
                  <div class="row tw-flex">
                    <div class="col-2 tw-relative tw-w-full tw-self-center">
                      <img
                        style="width: 1.5rem; height: auto"
                        src="./src/img/logo/php.png"
                        alt="html"
                        srcset=""
                      />
                    </div>
                    <div class="col-10 tw-w-full">
                      <p class="tw-w-full tw-items-center" style="margin: 0">
                        PHP
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
              <h3 class="pb-2 tw-font-bold">Hubungi Saya</h3>
              <div style="width: 50%">
                <div class="tw-flex" style="">
                  <div class="row">
                    <div class="col">
                      <i data-feather="mail"></i>
                    </div>
                    <div class="col">
                      <a
                        href="mailto:gimlerdude@gmail.com"
                        class="tw-text-black tw-no-underline"
                        ><p style="margin: 0">gimlerdude@gmail.com</p></a
                      >
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <svg
      style="rotate: 180deg"
      xmlns="http://www.w3.org/2000/svg"
      viewBox="0 0 1440 320"
    >
      <path
        fill="#03C988"
        fill-opacity="1"
        d="M0,64L48,80C96,96,192,128,288,122.7C384,117,480,75,576,69.3C672,64,768,96,864,106.7C960,117,1056,107,1152,96C1248,85,1344,75,1392,69.3L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"
      ></path>
    </svg>

    <!-- BLOG SECTION  -->
    <section id="blog">
      <div class="text-center mb-5">
        <h2 class="tw-font-bold">Blog</h2>
        <p class="tw-font-medium" style="margin: 0">
          Tulisan saya saya abadikan dibawah ini
        </p>
      </div>
      <div class="container">
        <div class="row row-cols-2">
          <?php 
          foreach ($listblog as $list) :
          ?>
          <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 col- mb-4">
            <article class="tw-w-full">
              <div class="image mb-2">
                <img
                  style="width: 30rem; height: auto; aspect-ratio: 16 / 9; object-fit:cover"
                  src="app/system/img/<?= $list['image'] ?>"
                  alt="article"
                  srcset=""
                  class="tw-rounded-lg tw-relative tw-mb-1"
                />
                <p
                  class="tw-px-2 tw-py-1 tw-bg-orange-300 tw-m-0 tw-w-1/4 tw-rounded-sm tw-relative tw-left-0 tw-top-0 tw-text-white tw-text-center"
                >
                  <?=  $list['category']?>
                </p>
              </div>
              <h4 class="mb-2 tw-font-bold"><?= $list['title'] ?></h4>
              <p
                class=""
                style="
                  overflow: hidden;
                  text-overflow: ellipsis;
                  display: -webkit-box;
                  line-clamp: 2;
                  -webkit-line-clamp: 1;
                  width: 80%;
                "
              >
                <?= $list['highlight'] ?>
              </p>
              <span
                ><a href="blog/view.php?link=<?= $list['slug'] ?>"
                  >Baca Selengkapnya<i
                    data-feather="book-open"
                    class="tw-ml-2"
                  ></i></a
              ></span>
            </article>
          </div>
          <?php 
          endforeach
          ?>
        </div>
        <div class="tw-w-full d-flex justify-content-center ">
          <a href="blog/all_blog.php" class="btn btn-success tw-text-white">Tampilkan Semua</a>
        </div>
      </div>
    </section>
    <footer class="tw-p-4 tw-mt-4 tw-bg-slate-600">
      <p class="tw-text-center tw-text-white">
        &copy; 2023 Muhammad RIfal Prasetyo
      </p>
    </footer>
    <textarea id="music_list"  cols="30" rows="10" style="display: none;"><?= $listmusic ?></textarea>

    <script>
      feather.replace();
      window.onload = function() {
        document.querySelector('.popup').style.display = 'block';
      };
      

          function play() {
            const music = document.getElementById('music_list').value;
            console.log(music);
            // const music_doc = JSON.stringify(music);
            const obj = JSON.parse(music);
            console.log(obj);
            var musikArray = obj;
            var songInfo = document.getElementById('song_info');
            // Mendapatkan referensi tombol play
        
            // Mendefinisikan fungsi untuk memutar musik
            var randomIndex = Math.floor(Math.random() * musikArray.length);
            music_play();
            function music_play() {
              var randomSong = musikArray[randomIndex];
              var audio = new Audio(randomSong.link);
              console.log(musikArray);
              audio.play();
              songInfo.textContent = randomSong.judul;
              console.log(randomSong.judul + " " + randomSong.link);
              audio.addEventListener('ended', nextSong);
              }
              // ganti lagu ketika lagu selesai
              let defaultMusic = randomIndex;
            function nextSong() {
              defaultMusic++;
              if(defaultMusic >= musikArray.length) {
                  defaultMusic = 0;
              }
              let next = musikArray[defaultMusic];
              let audio = new Audio(next.link);
              audio.src = next.link;
              audio.play();
              songInfo.textContent = next.judul;
              audio.addEventListener('ended', nextSong);
              };
        
          }
        document.getElementById('closeBtn').addEventListener('click',() => {
                setTimeout(() => {
                play()
                }, 2000);
                setTimeout(showDiv, 5000);
                document.querySelector('.popup').style.display = 'none';
            });
      function showDiv() {
          var div = document.getElementById("tampil");
          div.classList.remove('hidden');
          div.classList.add('row');
          div.classList.add('toast_active');
        };
   

        
        
      </script>
    <script src="./src/js/bootstrap.min.js"></script>
  </body>
</html>
