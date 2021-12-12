<?php
class Kontak{

   private $mysqli;

   function __construct($conn) {
      $this->mysqli = $conn;
   }

   public function tampil($id = null) {
      $db = $this->mysqli->conn;
      $sql = "SELECT * FROM kontak_kami";
      if($id != null) {
         $sql .= " WHERE id_kontak = $id";
      }
      $query = $db->query($sql) or die ($db->error);
      return $query;
   }

   public function edit($id_kontak, $alamat, $telp, $email, $instagram, $youtube) {
      $db = $this->mysqli->conn;
      $db->query("UPDATE kontak_kami SET alamat = '$alamat', telp = '$telp', email='$email', instagram='$instagram', youtube='$youtube' WHERE id_kontak = '$id_kontak'") or die ($db->error);
   }
}
?> 
