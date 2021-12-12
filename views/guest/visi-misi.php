<?php
require_once 'models/m_visimisi.php';

$visiMisi = new Visimisi($connection);
$tampil = $visiMisi->tampil()->fetch_object();
?>

<div>
<h1>Visi Sekolah</h1>
<p><?= htmlspecialchars_decode($tampil->visi) ?></p>
<hr>

<h1>Misi Sekolah</h1>
<p><?= htmlspecialchars_decode($tampil->misi) ?></p>
</div>