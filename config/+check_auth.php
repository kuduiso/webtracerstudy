<?php
   session_start();
   if(!@$_SESSION['login_admin']) {
      header('Location: login.php');
   }
?>