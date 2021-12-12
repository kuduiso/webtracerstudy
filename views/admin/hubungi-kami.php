<?php
require_once '../models/m_kontak.php';
$kontak = new Kontak($connection);
$tampil = $kontak->tampil()->fetch_object();

// echo "<pre>";
// echo var_dump($tampil);
// echo "</pre>";

if(isset($_POST['simpan-kontak'])) {
   $id_kontak = $_POST['id_kontak'];
   $alamat = $_POST['alamat_sekolah'];
   $telp = $_POST['telp'];
   $email = $_POST['email'];
   $youtube = $_POST['youtube'];
   $instagram = $_POST['instagram'];

   $kontak->edit($id_kontak, $alamat, $telp, $email, $instagram, $youtube);
   header('location: ?page=hubungi-kami&alert_msg=success');
}

if(@$_GET['alert_msg'] == 'success') {
   echo '<div class="alert alert-success margin-top-sm" role="alert">Kontak Berhasil Diubah</div>';
}
?>

<form action="#" method="POST">
   <div class="form-group">
      <label for="alamat_sekolah">Alamat Sekolah</label>
      <textarea name="alamat_sekolah" id="alamat_sekolah" class="form-control" rows="3" maxlength="125" required><?= $tampil->alamat ?></textarea>
   </div>

   <div class="form-group">
      <label for="telp">No. Telephone</label>
      <input type="text" name="telp" value="<?= $tampil->telp ?>" id="telp" maxlength="20" class="form-control" required>
   </div>
   
   <div class="form-group">
      <label for="email">E-mail</label>
      <input type="email" name="email" value="<?= $tampil->email ?>" id="email" maxlength="45" class="form-control" required>
   </div>
   
   <div class="form-group">
      <label for="instagram">Instagram</label>
      <input type="text" name="instagram" value="<?= $tampil->instagram ?>" id="instagram" maxlength="55" class="form-control" required>
   </div>
   
   <div class="form-group">
      <label for="youtube">Youtube</label>
      <input type="text" name="youtube" value="<?= $tampil->youtube ?>" id="youtube" maxlength="55" class="form-control" required>
   </div>
   <input type="hidden" name="id_kontak" value="<?= $tampil->id_kontak ?>">
   <button type="submit" name="simpan-kontak" class="btn btn-primary">Simpan</button>
</form>
