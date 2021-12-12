<?php 
require_once('../models/m_profil.php');
$profil = new Profil($connection);
$tampil = $profil->tampil()->fetch_object();
if(isset($_POST['simpan-profil'])) {
   $id_profil = $_POST['id_profil'];
   $desc_profil = htmlspecialchars(addslashes($_POST['desc_profil']));
   $location = htmlspecialchars($_POST['location']);
   $picture_profil = $_FILES['picture_profil'];
   $pict_old = $_POST['pict_old'];
   $pict_filename = '';
   $uploadOk = 1;
   $msg = '';

   // IMAGE UPLOAD
   if($picture_profil['name'] == '') {
      $pict_filename = $pict_old;
      $uploadOk = 1;
   } else {
      $imageFileType = strtolower(pathinfo(basename($picture_profil['name']), PATHINFO_EXTENSION));
      $pict_filename = 'foto_profil_'.date('YmdHis').'.'.$imageFileType;
      $check = getimagesize($picture_profil['tmp_name']);
      if($check !== false) {
         $uploadOk = 1;
      } else {
         $msg = 'error check';
         $uploadOk = 0;
      }

      if($picture_profil['size'] > 2000000) {
         $msg = 'error size';
         $uploadOk = 0;
      }

      if($imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType != 'jpeg') {
         $msg = 'error extension';
         $uploadOk = 0;
      }

      if($uploadOk == 0) {
         echo $msg;
      } else {
         unlink('../images/image_profil/'.$pict_old);
         if(!move_uploaded_file($picture_profil['tmp_name'], '../images/image_profil/'.$pict_filename)) { 
            echo "error upload image file";       
         }
      }
   }
   // END IMAGE UPLOAD

   if($uploadOk == 1) {
      $profil->edit($id_profil, $pict_filename, $desc_profil, $location);
      header('location: ?page=profil&alert_msg=success');
   } else {
      header('location: ?page=profil&alert_msg=fail');
   }
}
?>

<?php
   if(@$_GET['alert_msg'] == 'success') {
      echo '<div class="alert alert-success margin-top-sm" role="alert">Profil Berhasil Diubah</div>';
   }
   if(@$_GET['alert_msg'] == 'fail') {
      echo '<div class="alert alert-danger margin-top-sm" role="alert">Profil Gagal Diubah</div>';
   }
?>

<form action="#" method="POST" enctype="multipart/form-data">
   <div class="form-group">
      <label for="text_summernote">Deskripsi Profil Sekolah</label>
      <textarea name="desc_profil" id="text_summernote" class="form-control" rows="5" required><?= htmlspecialchars_decode($tampil->desc_profil) ?></textarea>
   </div>
   <div class="form-group">
      <label for="location">Lokasi Sekolah</label>
      <input type="hidden" name="id_profil" value="<?= $tampil->id_profil ?>">
      <input type="text" name="location" id="location" value="<?= $tampil->location ?>" placeholder="https://goo.gl/maps/GZ6e9Lud7pQdSM5C7" class="form-control" required>
   </div>
   <div class="form-group">
      <label for="picture_profil">Gambar Profil</label>
      <img src="../images/image_profil/<?= $tampil->picture_profil ?>" class="img-responsive margin-bottom-md" style="max-width: 300px" alt="foto-profil">
      <input type="hidden" name="pict_old" value="<?= $tampil->picture_profil ?>">
      <input type="file" name="picture_profil" id="picture_profil">
      <p class="help-block">▪️ Tipe yang diizinkan .jpg/.jpeg/.png/</p>
      <p class="help-block">▪️ Maksimal ukuran 2MB</p>
   </div>
   <button type="submit" name="simpan-profil" class="btn btn-primary">Simpan</button>
</form>
