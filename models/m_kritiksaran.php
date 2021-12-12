<?php
class Kritiksaran{

   private $mysqli;

   function __construct($conn) {
      $this->mysqli = $conn;
   }

   public function tampil($id = null) {
      $db = $this->mysqli->conn;
      $sql = "SELECT * FROM kritik_saran";
      if($id != null) {
         $sql .= " WHERE id_kritiksaran = $id";
      }
      $query = $db->query($sql) or die ($db->error);
      return $query;
   }

   public function tambah($email, $kritiksaran) {
      $db = $this->mysqli->conn;
      $db->query("INSERT INTO kritik_saran(email, text_kritiksaran) VALUES('$email', '$kritiksaran')") or die ($db->error);
   }

   public function hapus($id_kritiksaran) {
      $db = $this->mysqli->conn;
      $db->query("DELETE FROM kritik_saran WHERE id_kritiksaran = '$id_kritiksaran'") or die ($db->error);
   }
}
?> 
