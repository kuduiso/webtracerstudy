<?php
require_once '../models/m_visimisi.php';
// echo "Visi Misi";

$visiMisi = new Visimisi($connection);
$tampil = $visiMisi->tampil()->fetch_object();
// var_dump($tampil);

// UBAH DATA VISI-MISI
if(isset($_POST['simpan-visimisi'])) {
   $id_visimisi = $_POST['id_visimisi'];
   $visi = htmlspecialchars(addslashes($_POST['visi_sekolah']));
   $misi = htmlspecialchars(addslashes($_POST['misi_sekolah']));
   
   $visiMisi->edit($id_visimisi, $visi, $misi);
   header('location: ?page=visi-misi&alert_msg=success');
   
}

if(@$_GET['alert_msg'] == 'success') {
   echo '<div class="alert alert-success margin-top-sm" role="alert">Visi Misi Berhasil Diubah</div>';
}
?>

<form action="#" method="POST">
   <div class="form-group">
      <label for="text_summernote">Visi Sekolah</label>
      <textarea name="visi_sekolah" id="text_summernote" class="form-control" rows="5" required><?= htmlspecialchars_decode($tampil->visi) ?></textarea>
   </div>

   <div class="form-group">
      <label for="misi_sekolah">Misi Sekolah</label>
      <textarea name="misi_sekolah" id="misi_sekolah" class="form-control text_summernote" rows="5" required><?= htmlspecialchars_decode($tampil->misi) ?></textarea>
   </div>
   <input type="hidden" name="id_visimisi" value="<?= $tampil->id_visimisi ?>">

   <button type="submit" name="simpan-visimisi" class="btn btn-primary">Simpan</button>
</form>
