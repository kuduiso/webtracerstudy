<?php
   require_once 'models/m_kritiksaran.php';
   $kritik_saran = new Kritiksaran($connection);
?>
<div>
   <h2>Kritik Saran</h2>
   <p class="margin-top-lg">Kritik atau saran yang bersifat membangun bisa dikirimkan melalui kolom di bawah ini</p>
   
   <?php
      if(isset($_POST['kirim-kritikSaran'])) {
         $email = $_POST['email_address'];
         $kritikSaran = addslashes($_POST['kritik_saran']);
         $kritik_saran->tambah($email, $kritikSaran);
         header('location: ?page=kritik-saran&alert_msg=success');
      }
     
      if(@$_GET['alert_msg']) {
         echo '<div class="alert alert-success" style="max-width: 450px;" role="alert">Kritik/Saran berhasil dikirim</div>';
      }
   ?>
   
   <form action="#" method="POST" style="max-width: 450px;">
      <div class="form-group">
         <label for="email_address">Alamat E-mail</label>
         <input type="email" id="email_address" name="email_address" placeholder="Email" class="form-control" required>
      </div>
      <div class="form-group">
         <label for="kritik_saran">Kritik/Saran</label>
         <textarea name="kritik_saran" class="form-control" id="kritik_saran" rows="5" required></textarea>
      </div>
      <button type="submit" name="kirim-kritikSaran" class="btn btn-default"><b>Kirim</b></button>
   </form>
</div>