<?php
class Posting{

   private $mysqli;

   function __construct($conn) {
      $this->mysqli = $conn;
   }

   public function tampil($id = null, $num = null) {
      $db = $this->mysqli->conn;
      $sql = "SELECT * FROM blog_post";
      if($id != null) {
         $sql .= " WHERE id_post = $id";
      }
      $sql .= " ORDER BY id_post DESC";
      if($num != null) {
         $sql .= " LIMIT 5  OFFSET $num";
      }
      $query = $db->query($sql) or die ($db->error);
      return $query;
   }

   public function tambah($title, $picture_post, $date_post, $text_post) {
      $db = $this->mysqli->conn;
      $db->query("INSERT INTO blog_post(title, picture_post, date_post, text_post) VALUES('$title', '$picture_post', '$date_post', '$text_post')") or die($db->error);     
   }


   public function edit($id_post, $title, $picture_post, $date_post, $text_post) {
      $db = $this->mysqli->conn;
      $db->query("UPDATE blog_post SET title = '$title', picture_post = '$picture_post', date_post = '$date_post', text_post = '$text_post' WHERE id_post = '$id_post'") or die ($db->error);
   }

   public function hapus($id){
      $db = $this->mysqli->conn;
      $db->query("DELETE FROM blog_post WHERE id_post = '$id' ") or die ($db->error); 
   }

   public function cari($like){
      $db = $this->mysqli->conn;
      $query = $db->query("SELECT * FROM blog_post WHERE title LIKE '$like%' ") or die ($db->error); 
      return $query;
   }

}
?> 
