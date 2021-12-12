<?php
ob_start();

require_once('config/+koneksi.php');
require_once('models/database.php');
require_once('models/m_kontak.php');

$connection = new Database($host, $user, $pass, $database);
$kontak = new Kontak($connection);
$tampilKontak = $kontak->tampil()->fetch_object();
$url = @$_GET['page'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>SDN RANDUSONGO 3</title>
  
    <!-- FAVICON -->
    <link rel="icon" type="image/png" href="favicon-randusongo.png">
    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">

    <!-- Add custom CSS here -->
    <link href="assets/css/sb-admin.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
</head>

<body class="container bg-pattern">

<header>  
  <!-- BANNER -->
  <div class="banner-wrap bg-success margin-top-md">
    <img src="images/banner-sdn-randusongo-3_lg.jpg" alt="banner-sdn-randusongo-3" class="header-banner-img">
    <!-- <h1>SDN BANNER</h1> -->
  </div>
  <!-- END BANNER -->

  <!-- NAVIGATION -->
  <nav class="navbar navbar-default margin-top-xs">
    <div class="container-fluids">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <li <?= $url == 'home' ? 'class="active"' : '' ?> ><a href="?page=home">Home</a></li>
          <li <?= $url == 'profil' ? 'class="active"' : '' ?> ><a href="?page=profil">Profil</a></li>
          <li <?= $url == 'alumni' ? 'class="active"' : '' ?> ><a href="?page=alumni">Alumni</a></li>
          <li <?= $url == 'visi-misi' ? 'class="active"' : '' ?> ><a href="?page=visi-misi">Visi Misi</a></li>
          <li <?= $url == 'hubungi-kami' ? 'class="active"' : '' ?> ><a href="?page=hubungi-kami">Hubungi Kami</a></li>
          <li <?= $url == 'kritik-saran' ? 'class="active"' : '' ?> ><a href="?page=kritik-saran">Kritik dan Saran</a></li>
        </ul>
        <form action="?page=home" method="POST" class="navbar-form navbar-right">
          <div class="form-group">
            <input type="text" class="form-control" name="kata_kunci" placeholder="Temukan berita/artikel">
          </div>
          <button type="submit" name="pencarian" class="btn btn-default">Cari</button>
        </form>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>
</header>
  <!-- END NAVIGATION -->

<main class="bg-main padding-md">
  <?php
  switch ($url) {
    case 'home':
      include "views/guest/home.php";
      break;

    case 'profil':
      include "views/guest/profil.php";
      break;

    case 'alumni':
      include "views/guest/alumni.php";
      break;

    case 'visi-misi':
      include "views/guest/visi-misi.php";
      break;

    case 'hubungi-kami':
      include "views/guest/hubungi-kami.php";
      break;

    case 'kritik-saran':
      include "views/guest/kritik-saran.php";
      break;
    
    default:
      include "views/guest/home.php";
      break;
  }
  ?>  
</main>

<!-- Footer -->
<footer class="bg-footer margin-top-sm margin-bottom-sm padding-sm">
  <p class="text-center text-white margin-bottom-xs">Copyright &copy; 2021 </p>
  <p class="text-center text-gray margin-bottom-xs">
    <a href="<?= $tampilKontak->instagram ?>" target="_blank" class="footer-link">Instagram</a> | <a href="<?= $tampilKontak->youtube ?>" target="_blank" class="footer-link">Youtube</a> | Ngawi, Jawa Timur 63272
  </p>
</footer>

<!-- JavaScript -->
<script src="assets/js/jquery-1.10.2.js"></script>
<script src="assets/js/bootstrap.js"></script>

</body>
</html>
