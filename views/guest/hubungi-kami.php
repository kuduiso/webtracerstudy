<?php
require_once 'models/m_kontak.php';
$kontak = new Kontak($connection);
$tampil = $kontak->tampil()->fetch_object();
?>

<div>
   <h1>Hubungi Kami</h1>
   <ul class="margin-top-md" style="list-style-type: none;">
      <li>Alamat: <?= $tampil->alamat ?></li>
      <li>Telp: <?= $tampil->telp ?></li>
      <li>E-mail: <?= $tampil->email ?></li>
   </ul>
</div>