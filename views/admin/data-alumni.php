<div class="row">
  <div class="col-lg-12">
    <h1>DATA<small> ALUMNI</small></h1>
    <ol class="breadcrumb">
      <li><a href="../admin/index.php?page=dashboard"><i class="icon-dashboard"></i> Dashboard</a></li>
      <li class="active"><i class="icon-file-alt"></i> Data Alumni</li>
    </ol>
  </div>
</div><!-- /.row -->

<?php
// require_once('../config/+koneksi.php');
require_once('../models/m_alumni.php');

$connection = new Database($host, $user, $pass, $database);

$alumni = new Alumni($connection);
if(@$_GET['act'] == '') 
?>




<div class="row">
  <div class=" col-lg-12">

    <div class="table-responsive">
      <table class="table table-bordered table-hover table-striped">
        <tr>
          <th>No. </th>
          <th>Nama alumni</th>
          <th>tgl lahir</th>
          <th>Jenis kelamin</th>
          <th>Alamat</th>
          <th>tlpn</th>
          <th>tgl masuk</th>
          <th>tgl lulus</th>
          <th>opsi</th>
        </tr>
           <?php

        $tampil = $alumni->tampil();
        while($data = $tampil->fetch_object()) {
          ?>
        <tr>
          <td><?php echo $data->id_alumni; ?></td>
          <td><?php echo $data->nama_alumni; ?></td>
          <td><?php echo $data->tgl_lahir; ?></td>
          <td><?php echo $data->jenis_kelamin; ?></td>
          <td><?php echo $data->alamat; ?></td>
          <td><?php echo $data->tlp; ?></td>
          <td><?php echo $data->tgl_masuk; ?></td>
          <td><?php echo $data->tgl_lulus; ?></td>
          <td align="center"> 
              <button class="btn btn-info btn-xs" data-toggle="modal" data-target="#modal-edit" onclick="editData(<?= htmlspecialchars(json_encode($data)) ?>)"><i class="fa fa-edit"></i>edit</button>
              <button class="btn btn-danger btn-xs" onclick="deleteData('<?= htmlspecialchars($data->nama_alumni).'\',\''. htmlspecialchars($data->id_alumni) ?>')"><i class="fa fa-trash-o"></i>hapus</button>
          </td>
        </tr>
          <?php
          } ?>

       </table>
    </div>
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-tambah">Tambah data</button>

     <!-- MODAL TAMBAH -->
     <div id="modal-tambah" class="modal fade" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Tambah Data Alumni</h4>
            </div>

            <form id="form-create" action="#" method="post">
              <div class="modal-body ">
                <div class="form-group">
                  <label class="control-label" for="id_alumni">Id Alumni</label>
                  <input type="text" name="id_alumni" class="form-control" id="id_alumni" required="">
                </div>

                <div class="form-group">
                  <label class="control-label" for="nama_alumni">Nama Alumni</label>
                  <input type="text" name="nama_alumni" class="form-control" id="nama_alumni" required="">
                </div>

                <div class="form-group">
                  <label class="control-label" for="tgl_lahir">Tanggal Lahir</label>
                  <input type="date" name="tgl_lahir" class="form-control" id="tgl_lahir" required="">
                </div>                

                <div class="form-group">
                  <label class="control-label" for="jenis_kelamin">Jenis Kelamin</label>
                  <input type="text" name="jenis_kelamin" class="form-control" id="jenis_kelamin" required="">
                </div>

                <div class="form-group">
                  <label class="control-label" for="alamat">Alamat</label>
                  <input type="text" name="alamat" class="form-control" id="alamat" required="">
                </div>

                <div class="form-group">
                  <label class="control-label" for="tlp">Telepon</label>
                  <input type="number" name="tlp" class="form-control" id="tlp" required="">
                </div>

                <div class="form-group">
                  <label class="control-label" for="tgl_masuk">Tanggal Masuk</label>
                  <input type="date" name="tgl_masuk" class="form-control" id="tgl_masuk" required="">
                </div>

                <div class="form-group">
                  <label class="control-label" for="tgl_lulus">Tanggal Lulus</label>
                  <input type="date" name="tgl_lulus" class="form-control" id="tgl_lulus" required="">
                </div>

             </div>
            <div class="modal-footer">
                <button type="reset" class="btn btn-danger">Reset</button>
                <input type="submit" class="btn btn-success" name="tambah" value="Simpan">
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- END MODAL TAMBAH -->

      <!-- MODAL EDIT -->
      <div id="modal-edit" class="modal fade" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Data Alumni</h4>
              </div>
              <form action="#" method="POST" id="form-edit">
                <div class="modal-body" id="modal-edit">
                  <div class="form-group">
                    <label class="control-label" for="nama_alumni">Nama Alumni</label>
                    <input type="hidden" name="id_alumni" id="id_alumni">
                    <input type="text" name="nama_alumni" class="form-control" id="nama_alumni" required="">
                  </div>
                  <div class="form-group">
                    <label class="control-label" for="tgl_lahir">Tgl Lahir</label>
                    <input type="date" name="tgl_lahir" class="form-control" id="tgl_lahir" required>
                  </div>
                  <div class="form-group">
                    <label class="control-label" for="jenis_kelamin">Jenis Kelamin</label>
                    <input type="text" name="jenis_kelamin" class="form-control" id="jenis_kelamin" required>
                  </div>
                  <div class="form-group">
                    <label class="control-label" for="alamat">Alamat</label>
                    <input type="text" name="alamat" class="form-control" id="alamat" required>
                  </div>
                  <div class="form-group">
                    <label class="control-label" for="tlp">Telepon</label>
                    <input type="number" name="tlp" class="form-control" id="tlp" required>
                  </div>
                  <div class="form-group">
                    <label class="control-label" for="tgl_masuk">Tgl Masuk</label>
                    <input type="date" name="tgl_masuk" class="form-control" id="tgl_masuk" required>
                  </div>
                  <div class="form-group">
                    <label class="control-label" for="tgl_lulus">Tgl Lulus</label>
                    <input type="date" name="tgl_lulus" class="form-control" id="tgl_lulus" required>
                  </div>
                <div class="modal-footer">
                  <input type="submit" class="btn btn-success" name="editDataAlumni" value="Simpan">
                </div>
              </form>
            </div>
        </div>
      </div>
      <!-- END MODAL EDIT -->

      <!-- FORM DELETE -->
      <form id="form-delete" action="#" method="POST">
          <input type="hidden" name="id_alumni">
          <input type="hidden" name="deleteDataAlumni">
      </form>
      <!-- END FORM DELETE -->
  </div>
  <?php
    if(isset($_POST['tambah'])) {
      $id_alumni = $connection->conn->real_escape_string($_POST['id_alumni']);
      $nama_alumni = $connection->conn->real_escape_string($_POST['nama_alumni']);
      $tgl_lahir = $connection->conn->real_escape_string($_POST['tgl_lahir']);
      $jenis_kelamin = $connection->conn->real_escape_string($_POST['jenis_kelamin']);
      $alamat = $connection->conn->real_escape_string($_POST['alamat']);
      $tlp = $connection->conn->real_escape_string($_POST['tlp']);
      $tgl_masuk = $connection->conn->real_escape_string($_POST['tgl_masuk']);
      $tgl_lulus = $connection->conn->real_escape_string($_POST['tgl_lulus']);
      
      $alumni->tambah($id_alumni, $nama_alumni, $tgl_lahir, $jenis_kelamin, $alamat, $tlp, $tgl_masuk, $tgl_lulus);
      header("location: ?page=data-alumni");
    }
    
    if(isset($_POST['editDataAlumni'])) {
      $id_alumni = $connection->conn->real_escape_string($_POST['id_alumni']);
      $nama_alumni = $connection->conn->real_escape_string($_POST['nama_alumni']);
      $tgl_lahir = $connection->conn->real_escape_string($_POST['tgl_lahir']);
      $jenis_kelamin = $connection->conn->real_escape_string($_POST['jenis_kelamin']);
      $alamat = $connection->conn->real_escape_string($_POST['alamat']);
      $tlp = $connection->conn->real_escape_string($_POST['tlp']);
      $tgl_masuk = $connection->conn->real_escape_string($_POST['tgl_masuk']);
      $tgl_lulus = $connection->conn->real_escape_string($_POST['tgl_lulus']);

      $alumni->edit($id_alumni, $nama_alumni, $tgl_lahir, $jenis_kelamin, $alamat, $tlp, $tgl_masuk, $tgl_lulus);
      header("location: ?page=data-alumni");
    }

    if(isset($_POST['deleteDataAlumni'])) {
      $id_alumni = $connection->conn->real_escape_string($_POST['id_alumni']);
      $alumni->hapus($id_alumni);
      header("location: ?page=data-alumni");
    }
  ?>
</div>

  <script src="../assets/js/jquery-1.10.2.js"></script>
  <script type="text/javascript">
  // SET DATA TO MODAL FORM EDIT
  function editData(data) {
    $('#form-edit input[name=id_alumni]').val(data.id_alumni)
    $('#form-edit input[name=nama_alumni]').val(data.nama_alumni)
    $('#form-edit input[name=tgl_lahir]').val(data.tgl_lahir)
    $('#form-edit input[name=jenis_kelamin]').val(data.jenis_kelamin)
    $('#form-edit input[name=alamat]').val(data.alamat)
    $('#form-edit input[name=tlp]').val(data.tlp)
    $('#form-edit input[name=tgl_masuk]').val(data.tgl_masuk)
    $('#form-edit input[name=tgl_lulus]').val(data.tgl_lulus)
    // console.table(data)
  }  

  // DELETE DATA ALUMNI
  function deleteData(nama_alumni, id_alumni) {
    let checkDelete = confirm('Apakah Anda ingin menghapus data "'+ nama_alumni+'" ?');
    $('#form-delete input[name=id_alumni]').val(id_alumni);
    if(checkDelete) {
      console.log('Berhasil dihapus');
      console.log($('#form-delete input[name=id_alumni]').val());
      $('#form-delete').submit();
      // location.reload();
    }
  }
  </script>