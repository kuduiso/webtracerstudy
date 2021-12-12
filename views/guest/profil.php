<?php
require_once 'models/m_profil.php';
$profil = new Profil($connection);
$tampil = $profil->tampil()->fetch_object();
// echo "<pre>";
// echo var_dump($tampil);
// echo "</pre>";
?>
<div>
   <h1>Profil</h1>
   <img src="images/image_profil/<?= $tampil->picture_profil ?>" alt="foto-gedung-sekolah" class="img-responsive thumbnail center-block margin-bottom-md" style="max-height: 350px">
   <p><?= htmlspecialchars_decode($tampil->desc_profil) ?></p>
   <hr>

   <h1>Lokasi Sekolah</h1>
   <a href="<?= $tampil->location ?>" target="_blank" rel="nofollow">
      <img src="images/lokasi-sekolah.jpg" alt="lokasi-sekolah" style="width: 100%">
   </a>
</div>