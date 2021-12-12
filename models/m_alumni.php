<?php
class Alumni{

     private $mysqli;

     function __construct($conn) {
     	$this->mysqli = $conn;

     }
     public function tampil($id = null) {
     	$db = $this->mysqli->conn;
     	$sql = "SELECT * FROM alumni";
     	if($id != null) {
     		$sql .= " WHERE id_alumni = $id";
     	}
     	$query = $db->query($sql) or die ($db->error);
     	return $query;
     }

     public function tambah($id_alumni, $nama_alumni, $tgl_lahir, $jenis_kelamin, $alamat, $tlp, $tgl_masuk, $tgl_lulus) {
     	$db = $this->mysqli->conn;
     	$db->query("INSERT INTO alumni VALUES('$id_alumni', '$nama_alumni', '$tgl_lahir', '$jenis_kelamin', '$alamat', '$tlp', '$tgl_masuk', '$tgl_lulus' )") or die($db->error);
             
     }


     public function edit($id_alumni, $nama_alumni, $tgl_lahir, $jenis_kelamin, $alamat, $tlp, $tgl_masuk, $tgl_lulus) {
          $db = $this->mysqli->conn;
          $db->query("UPDATE alumni SET nama_alumni = '$nama_alumni', tgl_lahir = '$tgl_lahir', jenis_kelamin = '$jenis_kelamin', alamat = '$alamat', tlp = '$tlp', tgl_masuk = '$tgl_masuk', tgl_lulus = '$tgl_lulus' WHERE id_alumni = '$id_alumni'") or die ($db->error);
     }

     public function hapus($id){
          $db = $this->mysqli->conn;
          $db->query("DELETE FROM alumni WHERE id_alumni = '$id' ") or die ($db->error); 
     }

    

}
?> 
