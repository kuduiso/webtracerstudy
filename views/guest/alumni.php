<?php
   require_once 'models/m_alumni.php';
   $alumni = new Alumni($connection);
   $data_alumni = $alumni->tampil();
?>
<div>
   <h1>Data Alumni</h1>
   <div class="margin-top-lg table-responsive">
      <table class="table table-bordered">
         <thead>
            <tr>
               <th width="50px">No.</th>
               <th>Nama</th>
               <th>Tanggal Masuk</th>
               <th>Tanggal Lulus</th>
            </tr>
         </thead>
         <tbody>
            <?php foreach($data_alumni as $key => $dta) { ?>
            <tr>
               <td><?= ++$key ?></td>
               <td><?= $dta['nama_alumni'] ?></td>
               <td><?= $dta['tgl_masuk'] ?></td>
               <td><?= $dta['tgl_lulus'] ?></td>
            </tr>
            <?php } ?>
         </tbody>
      </table>
   </div>
</div>