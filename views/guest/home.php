<?php 
require_once('models/m_posting.php');
$posting = new Posting($connection);
if(isset($_GET['id_post'])) { 
$data = $posting->tampil($_GET['id_post'])->fetch_object();
?>

<div class="content-article">
   <h2 class="text-capitalize"><?= $data->title ?></h2>
   <div class="date-post"><?= date('d F, Y', strtotime($data->date_post)) ?></div>
   <div class="row margin-top-sm">
      <div class="col-sm-12">
         <img src="images/image_contents/<?= $data->picture_post ?>" alt="cover-content" class="thumbnail img-responsive center-block" style="max-height: 350px;">
      </div>
      <div class="col-sm-12">
         <p><?= htmlspecialchars_decode($data->text_post) ?></p>
      </div>
   </div>
   <hr>
</div>

<?php } else if(isset($_POST['pencarian'])) {
   if($_POST['kata_kunci'] == '') {
      header('location: ?page=home');
   }
   $tampil = $posting->cari($_POST['kata_kunci']);
   while($data = $tampil->fetch_object()) {
?>
      <div class="content-article">
         <h2 class="text-capitalize"><?= $data->title ?></h2>
         <div class="date-post"><?= date('d F, Y', strtotime($data->date_post)) ?></div>
         <div class="row margin-top-sm">
            <div class="col-md-4">
               <img src="images/image_contents/<?= $data->picture_post ?>" alt="cover-content" class="thumbnail img-cover-content">
            </div>
            <div class="col-md-8">
               <p><?= substr(strip_tags(htmlspecialchars_decode($data->text_post)), 0, 800) ?> &nbsp;<a href="?page=home&id_post=<?= $data->id_post ?>"><b>Lebih lanjut ...</b></a></p>
            </div>
         </div>
         <hr>
      </div>
   <?php } 
} else { 
   $num = @$_GET['num'] == null || $_GET['num'] == '' ? '0' : $_GET['num'];
   $tampil = $posting->tampil(null, $num);
   $ttl_data = $posting->tampil()->num_rows;

   while($data = $tampil->fetch_object()) {
   ?>
      <div class="content-article">
         <h2 class="text-capitalize"><?= $data->title ?></h2>
         <div class="date-post"><?= date('d F, Y', strtotime($data->date_post)) ?></div>
         <!-- content desc => substr(105) ... -->
         <div class="row margin-top-sm">
            <div class="col-md-4">
               <img src="images/image_contents/<?= $data->picture_post ?>" alt="cover-content" class="thumbnail img-cover-content">
            </div>
            <div class="col-md-8">
               <p><?= substr(strip_tags(htmlspecialchars_decode($data->text_post)), 0, 800) ?> &nbsp;<a href="?page=home&id_post=<?= $data->id_post ?>"><b>Lebih lanjut ...</b></a></p>
            </div>
         </div>
         <hr>
      </div>
   <?php } ?>
<!-- PAGINATION -->
   <?php 
   $num_page = ceil($ttl_data/5);
   if($num_page <> 0) {?>
   <div aria-label="Page navigation">
      <div class="text-center">
         <ul class="pagination">
            <li>
               <a href="?page=home&num=<?= $num == 0 ? $num : $num-5 ?>" aria-label="Previous">
               <span aria-hidden="true">&laquo;</span>
               </a>
            </li>
            <?php 
               for($i=0; $i<$num_page; $i++) {?>
                  <li <?= $i+1 == ($num+5)/5 ? 'class="active"' : ''?>><a href="?page=home&num=<?= $i*5 ?>"><?= $i+1 ?></a></li>
            <?php
               }?>
            <?php if($num+5 < $ttl_data) {?>
            <li>
               <a href="?page=home&num=<?= $num+5 ?>" aria-label="Next">
               <span aria-hidden="true">&raquo;</span>
               </a>
            </li>
            <?php } ?>
         </ul>
      </div>
   </div>
   <?php } ?>
   <!-- END PAGINATION -->
<?php } ?>
