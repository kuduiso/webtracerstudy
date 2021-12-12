<?php
   require_once '../models/m_kritiksaran.php';
   $kritik_saran = new Kritiksaran($connection);

   if(isset($_POST['btn_deleteKritik'])) {
      $kritik_saran->hapus($_POST['id_kritiksaran']);
      header('location: ?page=kritik-saran');
   }
?>
<!-- <div class="container"> -->
   <div class="row">
      <div class=" col-md-12">
            <h1 class="margin-bottom-sm">Kritik <small>Saran</small></h1>

            <div class="table-custom-wrap">
               <table class="table table-bordered table-hover table-striped" style="min-width: 800px;">
                  <tr>
                     <th>No. </th>
                     <th>E-mail</th>
                     <th class="td-long-wrap">Kritik/Saran</th>
                     <th>Opsi</th>
                  </tr>
                  <?php
                  $tampil = $kritik_saran->tampil();
                  $i=1;
                  while($data = $tampil->fetch_object()) {
                  ?>
                  <tr>
                     <td><?php echo $i++; ?></td>
                     <td><?php echo $data->email; ?></td>
                     <td class="td-long-wrap"><?php echo $data->text_kritiksaran; ?></td>
                     <td align="center"> 
                        <button class="btn btn-danger btn-xs" onclick="deleteData('<?= htmlspecialchars($data->email).'\',\''. htmlspecialchars($data->id_kritiksaran) ?>')"><i class="fa fa-trash-o"></i> hapus</button>
                     </td>
                  </tr>
                     <?php
                     } ?>

               </table>
            </div>
      </div>
   </div>
<!-- </div> -->
<!-- FORM DELETE -->
   <form id="form-delete" action="#" method="POST">
      <input type="hidden" name="id_kritiksaran">
      <input type="hidden" name="btn_deleteKritik">
   </form>
<!-- END FORM DELETE -->

<script type="text/javascript">
   function deleteData(email, id_kritiksaran) {
      let checkDelete = confirm('Apakah Anda ingin menghapus kritik/saran dari "'+ email+'" ?');
      document.querySelector('#form-delete input[name=id_kritiksaran]').value = id_kritiksaran;
      if(checkDelete) {
         console.log('Berhasil dihapus');         
         document.querySelector('#form-delete').submit();         
      }
   }
</script>