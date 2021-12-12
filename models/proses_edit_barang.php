<?php

require_once('/config/+koneksi.php');
require_once('/models/database.php');
require_once('/models/m_barang.php');

$connection = new Database($host, $user, $pass, $database);
$brg = new Barang($connection);

$id_alumni = $_POST['id_alumni'];
$nama_alumni = $connection->conn->real_escape_string($_POST['nama_alumni']);
$tgl_lahir = $connection->conn->real_escape_string($_POST['tgl_lahir']);
$jenis_kelamin = $connection->conn->real_escape_string($_POST['jenis_kelamin']);
$alamat = $connection->conn->real_escape_string($_POST['alamat']);
$tlp = $connection->conn->real_escape_string($_POST['tlp']);
$tgl_masuk = $connection->conn->real_escape_string($_POST['tgl_masuk']);
$tgl_lulus = $connection->conn->real_escape_string($_POST['tgl_lulus']);



if($pict == '') {
	$brg->edit("UPDATE alumni SET nama_alumni = '$nama_alumni', tanggal_lahir = '$tgl_lahir', jenis_kelamin = '$jenis_kelamin', alamat = '$alamat', tlp = '$tlp', tgl_masuk = '$tgl_masuk', tgl_lulus = '$tgl_lulus' WHERE id_alumni = '$id_alumni' ");
	 echo "<script>window.location='?page=barang';</script>";


    	$brg->edit("UPDATE alumni SET nama_alumni = '$nama_alumni', '$tgl_lahir', '$jenis_kelamin', '$alamat', '$tlp', '$tgl_masuk', '$tgl_lulus' WHERE id_alumni = '$id_alumni' ");
	 		echo "<script>window.location='?page=barang';</script>";
    } else {
    	echo "<script>alert('upload gambar gagal!')</script>";
    }
     

}


?>