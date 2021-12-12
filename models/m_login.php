<?php
class Login{

     private $mysqli;

     function __construct($conn) {
     	$this->mysqli = $conn;

     }

     public function check_auth($username, $password) {
     	$db = $this->mysqli->conn;
     	$sql = "SELECT * FROM login WHERE username = '$username' AND password = '$password'";
     	$query = $db->query($sql) or die ($db->error);
     	return $query;
     }  

}
?> 
