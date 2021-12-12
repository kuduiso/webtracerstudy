<?php
ob_start();

require_once('../config/+koneksi.php');
require_once('../config/+check_auth.php');
require_once('../models/database.php');

$connection = new Database($host, $user, $pass, $database);

$page = @$_GET['page'];
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
    <title>Web Admin</title>

    <!-- FAVICON -->
    <link rel="icon" type="image/png" href="../favicon-randusongo.png">
    <!-- Bootstrap core CSS -->
    <link href="../assets/css/bootstrap.css" rel="stylesheet">

    <!-- Add custom CSS here -->
    <link href="../assets/css/sb-admin.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/font-awesome/css/font-awesome.min.css">
    <!-- SUMMERNOTE CSS -->
    <link rel="stylesheet" href="../assets/summernote-0.8.18-dist/summernote.min.css">
  </head>

  <body style="margin-top: 50px;">

    <div id="wrapper">

      <!-- Sidebar -->
      <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="">SDN RANDUSONGO 3</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav side-nav">
            <li><a href="?page=dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-square-o-down"></i> Alumni<b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="?page=data-alumni">Data Alumni</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-square-o-down"></i> Pengaturan Web<b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="?page=berita-artikel">Berita/Artikel</a></li>
                <li><a href="?page=profil">Profil</a></li>
                <li><a href="?page=visi-misi">Visi Misi</a></li>
                <li><a href="?page=hubungi-kami">Hubungi Kami</a></li>
                <li><a href="?page=kritik-saran">Kritik/Saran</a></li>
              </ul>
            </li>
          </ul>

          <ul class="nav navbar-nav navbar-right navbar-user">
            <li class="dropdown user-dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> Admin <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="../admin/logout.php"><i class="fa fa-power-off"></i> Log Out</a></li>
              </ul>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </nav>

      <div id="page-wrapper">

          <?php
            switch ($page) {
              case 'dashboard':
                include "../views/admin/dashboard.php";
                break;

              case 'data-alumni':
                include "../views/admin/data-alumni.php";
                break;

              case 'berita-artikel':
                include "../views/admin/berita-artikel.php";
                break;

              case 'profil':
                include "../views/admin/profil.php";
                break;

              case 'visi-misi':
                include "../views/admin/visi-misi.php";
                break;

              case 'hubungi-kami':
                include "../views/admin/hubungi-kami.php";
                break;

              case 'kritik-saran':
                include "../views/admin/kritik-saran.php";
                break;
              
              default:
                include "../views/admin/dashboard.php";
                break;
            }
          ?>

      </div><!-- /#page-wrapper -->

    </div><!-- /#wrapper -->

    <!-- JavaScript -->
    <script src="../assets/js/jquery-1.10.2.js"></script>
    <script src="../assets/js/bootstrap.js"></script>
    <script src="../assets/summernote-0.8.18-dist/summernote.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function() {
          $('#text_summernote, .text_summernote').summernote({
            placeholder: 'Tuliskan berita/artikel di sini',
            tabsize: 2,
            height: 120,
            toolbar: [
              ['style', ['style']],
              ['font', ['bold', 'underline', 'clear']],
              ['color', ['color']],
              ['para', ['ul', 'ol', 'paragraph']],
              ['table', ['table']],
              ['insert', ['link', 'video']],
              ['view', ['fullscreen', 'codeview', 'help']]
            ]
          });
      });
    </script>

  </body>
</html>