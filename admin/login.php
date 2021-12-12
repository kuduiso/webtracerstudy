<?php
ob_start();

require_once('../config/+koneksi.php');
require_once('../models/database.php');
require_once('../models/m_login.php');

$connection = new Database($host, $user, $pass, $database);
$login = new Login($connection);
$message = '';
session_start();
echo @$_SESSION['login_admin'];

// IF HAS LOGGED IN REDIRECT TO ADMIN PAGE
if(@$_SESSION['login_admin']) {
   header('Location: index.php');
}

if(isset($_POST['submit'])) {
   $username = $connection->conn->real_escape_string($_POST['username']);
   $password = $connection->conn->real_escape_string($_POST['password']);;
   if($login->check_auth($username, $password)->num_rows) {
      // SET SESSION
      $_SESSION['login_admin'] = true;
      $message = '';
      header('Location: index.php');
   } else {
      $message = '<div class="alert alert-danger" role="alert">Username/password salah</div>';
   }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  

    <title>Web Admin | Login</title>

    <!-- FAVICON -->
    <link rel="icon" type="image/png" href="../favicon-randusongo.png">
    <!-- Bootstrap core CSS -->
    <link href="../assets/css/bootstrap.css" rel="stylesheet">

    <!-- Add custom CSS here -->
    <link href="../assets/css/sb-admin.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/font-awesome/css/font-awesome.min.css">
  </head>

  <body style="margin-top: 50px;">

   <div class="container">
      <div class="header-login">Login Admin</div>      
      <form action="#" method="POST" class="form-login center-block" style="max-width: 450px;">
         <?= $message ?>
         <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" class="form-control" placeholder="Username">
         </div>
         <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Password">
         </div>
         <button type="submit" name="submit" class="btn btn-primary">Login</button>
      </form>
   </div>   

   <!-- JavaScript -->
   <script src="../assets/js/jquery-1.10.2.js"></script>
   <script src="../assets/js/bootstrap.js"></script>

  </body>
</html>