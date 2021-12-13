<?php 
require_once('../models/m_posting.php');
$posting = new Posting($connection);
if(isset($_GET['state']) && $_GET['state'] == 'tambah') { ?>

   <form action="#" method="POST" enctype="multipart/form-data">
      <div class="form-group">
         <label for="title_post">Judul</label>
         <input type="text" name="title_post" id="title_post" class="form-control" placeholder="Masukkan Judul Berita/Artikel" maxlength="100" required>
      </div>
      <div class="form-group">
         <label for="date_post">Tanggal Post</label>
         <input type="date" name="date_post" id="date_post" class="form-control" required>
      </div>
      <div class="form-group">
         <label for="text_summernote">Konten Post</label>
         <textarea name="text_post" id="text_summernote" class="form-control" rows="5" required></textarea>
      </div>
      <div class="form-group">
         <label for="picture_post">Gambar Sampul</label>
         <input type="file" name="picture_post" id="picture_post" required>
         <p class="help-block">▪️ Tipe yang diizinkan .jpg/.jpeg/.png/</p>
         <p class="help-block">▪️ Maksimal ukuran 2MB</p>
      </div>
      <button type="submit" name="simpan-berita" class="btn btn-primary">Simpan</button>
   </form>

   <?php
      if(isset($_POST['simpan-berita'])) {
         $title = $_POST['title_post'];
         $date = $_POST['date_post'];
         $text = htmlspecialchars(addslashes($_POST['text_post']));
         $picture = $_FILES['picture_post'];         
         // LOGIC FILE UPLOAD         
         $uploadOk = 1;
         $imageFileType = strtolower(pathinfo(basename($picture['name']), PATHINFO_EXTENSION));
         $pict_filename = 'foto_konten_'.date('YmdHis').'.'.$imageFileType;
         $check = getimagesize($picture['tmp_name']);
         $msg = '';
         if($check !== false) {
            $uploadOk = 1;
         } else {
            $msg = 'error check';
            $uploadOk = 0;
         }

         if($picture['size'] > 2000000) {
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
            if(move_uploaded_file($picture['tmp_name'], '../images/image_contents/'.$pict_filename)) {
               // echo "file has been uploaded";
               // echo $pict_filename;
               $posting->tambah($title, $pict_filename, $date, $text);
               header('location: ?page=berita-artikel');
            } else {
               echo "error upload image file";
            }
         }
         // END LOGIC FILE UPLOAD
      }
   ?>

<?php } else if (isset($_GET['state']) && $_GET['state'] == 'ubah') { 
   $data = $posting->tampil($_GET['id_post'])->fetch_object();
?>

   <form action="#" method="POST" enctype="multipart/form-data">
      <div class="form-group">
         <label for="title_post">Judul</label>
         <input type="text" name="title_post" id="title_post" value="<?= $data->title ?>" class="form-control" placeholder="Masukkan Judul Berita/Artikel" maxlength="100" required>
      </div>
      <div class="form-group">
         <label for="date_post">Tanggal Post</label>
         <input type="date" name="date_post" id="date_post" value="<?= $data->date_post ?>" class="form-control" required>
      </div>
      <div class="form-group">
         <label for="text_summernote">Konten Post</label>
         <textarea name="text_post" id="text_summernote" class="form-control" rows="5" required><?= htmlspecialchars_decode($data->text_post) ?></textarea>
      </div>
      <div class="form-group">
         <label for="picture_post">Gambar Sampul</label><br>
         <img src="../images/image_contents/<?= $data->picture_post ?>" alt="foto-lama" class="margin-bottom-md img-responsive" style="max-height: 100px;">
         <input type="hidden" name="picture_old" value="<?= $data->picture_post ?>">
         <input type="file" name="picture_post" id="picture_post">
         <p class="help-block">▪️ Tipe yang diizinkan .jpg/.jpeg/.png/</p>
         <p class="help-block">▪️ Maksimal ukuran 2MB</p>
      </div>
      <button type="submit" name="simpan-berita" class="btn btn-primary">Simpan</button>
   </form>

   <?php
      if(isset($_POST['simpan-berita'])) {
         $id_post = $_GET['id_post'];
         $title = $_POST['title_post'];
         $date = $_POST['date_post'];
         $text = htmlspecialchars(addslashes($_POST['text_post']));
         $picture = $_FILES['picture_post'];
         $picture_old = $_POST['picture_old'];
         $pict_filename = '';
         $uploadOk = 1;
         $msg = '';
      
         // LOGIC FILE UPLOAD
         if($picture['name'] == '') {
            $pict_filename = $picture_old;
            $uploadOk = 1;
         } else {
            $imageFileType = strtolower(pathinfo(basename($picture['name']), PATHINFO_EXTENSION));
            $pict_filename = 'foto_konten_'.date('YmdHis').'.'.$imageFileType;
            $check = getimagesize($picture['tmp_name']);
            if($check !== false) {
               $uploadOk = 1;
            } else {
               $msg = 'error check';
               $uploadOk = 0;
            }

            if($picture['size'] > 2000000) {
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
               unlink('../images/image_contents/'.$picture_old);
               if(!move_uploaded_file($picture['tmp_name'], '../images/image_contents/'.$pict_filename)) { 
                  echo "error upload image file";       
               }
            }
         }
         // END LOGIC FILE UPLOAD
  
         if($uploadOk == 1) {
            $posting->edit($id_post, $title, $pict_filename, $date, $text);
            header('location: ?page=berita-artikel');            
         }
      }
   ?>


<?php } else {?>

   <h1>Data <small>Berita/Artikel</small></h1>
   <div class="row">
      <div class="col-lg-12 margin-bottom-md">
         <a href="?page=berita-artikel&state=tambah" class="btn btn-success">Tambah Berita/Artikel</a>
      </div>
      <div class=" col-lg-12">
         <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
            <tr>
               <th>Id Post </th>
               <th>Judul</th>
               <th>Tanggal Posting</th>
               <th>Opsi</th>
            </tr>
            <?php
            $tampil = $posting->tampil(); 
            while($data = $tampil->fetch_object()) { ?>
            <tr>
               <td><?= $data->id_post ?></td>
               <td><?= $data->title ?></td>
               <td><?= $data->date_post ?></td>
               <td align="center"> 
                  <a href="../?page=home&id_post=<?= $data->id_post ?>" target="_blank" class="btn btn-primary btn-xs"><i class="fa fa-desktop"></i> Detail</a>
                  <a class="btn btn-info btn-xs" href="?page=berita-artikel&state=ubah&id_post=<?= $data->id_post ?>"><i class="fa fa-edit"></i>edit</a>
                  <button class="btn btn-danger btn-xs" onclick="deleteData('<?= htmlspecialchars($data->id_post) ?>')"><i class="fa fa-trash-o"></i>hapus</button>
               </td>
            </tr>
            <?php } ?>
            </table>
         </div>
      </div>
   </div>

   <!-- HAPUS DATA -->
   <form id="form-delete" action="#" method="POST">
      <input type="hidden" name="id_post">
      <input type="hidden" name="submit-delete">
   </form>

   <?php 
      if(isset($_POST['submit-delete'])) {
         $id_post = $_POST['id_post'];
         // read picture name and delete
         $picture_cover = $posting->tampil_gambar($id_post)->fetch_object()->picture_post;
         if(unlink('../images/image_contents/'.$picture_cover)) {
            $posting->hapus($id_post);
            header('location: ?page=berita-artikel');
         } else {
            echo "Berita/Artikel gagal dihapus";
         }
      }
   ?>

   <script type="text/javascript">
      function deleteData(id_post) {
         let checkDelete = confirm('Apakah anda yakin ingin menghapus?');
         document.querySelector('#form-delete input[name=id_post]').value = id_post;

         if(checkDelete) {
            document.querySelector('#form-delete').submit();
            console.log('berhasil dihapus')
         }
      }
   </script>
<?php } ?>
