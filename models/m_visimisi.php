<?php
class Visimisi{

   private $mysqli;

   function __construct($conn) {
      $this->mysqli = $conn;
   }

   public function tampil($id = null) {
      $db = $this->mysqli->conn;
      $sql = "SELECT * FROM visi_misi";
      if($id != null) {
         $sql .= " WHERE id_visimisi = $id";
      }
      $query = $db->query($sql) or die ($db->error);
      return $query;
   }

   public function edit($id_visimisi, $visi, $misi) {
      $db = $this->mysqli->conn;
      $db->query("UPDATE visi_misi SET visi = '$visi', misi = '$misi' WHERE id_visimisi = '$id_visimisi'") or die ($db->error);
   }
}
?> 
