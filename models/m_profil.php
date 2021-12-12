<?php
class Profil{

   private $mysqli;

   function __construct($conn) {
      $this->mysqli = $conn;
   }

   public function tampil($id = null) {
      $db = $this->mysqli->conn;
      $sql = "SELECT * FROM profil";
      if($id != null) {
         $sql .= " WHERE id_profil = $id";
      }
      $query = $db->query($sql) or die ($db->error);
      return $query;
   }

   public function edit($id_profil, $picture_profil, $desc_profil, $location) {
      $db = $this->mysqli->conn;
      $db->query("UPDATE profil SET picture_profil = '$picture_profil', desc_profil = '$desc_profil', location = '$location' WHERE id_profil = '$id_profil'") or die ($db->error);
   }
}
?> 
