<?php session_start();
if(empty($connection)){
  header('location:../../');
} else {
  include_once 'mod/sw-panel.php';
echo'
  <div class="content-wrapper">';
switch(@$_GET['op']){ 
    default:
echo'
<section class="content-header">
  <h1>Administrator</h1>
    <ol class="breadcrumb">
      <li><a href="./"><i class="fa fa-dashboard"></i> Beranda</a></li>
      <li class="active">Administrator</li>
    </ol>
</section>';
echo'
<section class="content">
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title"><b>Administrator</b></h3>
          <div class="box-tools pull-right">';
          if($level_user ==1){
            echo'
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAdd"><i class="fa fa-plus"></i> Tambah Baru</button>';}else{
            echo' <button type="button" class="btn btn-primary access-failed"><i class="fa fa-plus"></i> Tambah Baru</button>';
            }
          echo'
          </div>
        </div>
<div class="box-body">
<table id="swdatatable" class="table table-bordered">
  <thead>
  <tr>
    <th style="width: 10px">No</th>
    <th>Nama</th>
    <th>Username</th>
    <th>Email</th>
    <th>Registrasi</th>
    <th>Level</th>
    <th style="width:120px" class="text-center">Aksi</th>
  </tr>
  </thead>
  <tbody>';
  $query="SELECT user.user_id,user.username,user.fullname,user.email,user.registered,user.level,user.level,user_level.level_id,user_level.level_name FROM user,user_level WHERE user.level=user_level.level_id order by user.user_id DESC";
  $result = $connection->query($query);
  if($result->num_rows > 0){
  $no=0;
 while ($row_a= $result->fetch_assoc()) {
    $no++;
    echo'
    <tr>
      <td class="text-center">'.$no.'</td>
      <td>'.$row_a['fullname'].'</td>
      <td>'.$row_a['username'].'</td>
      <td>'.$row_a['email'].'</td>
      <td>'.tgl_indo($row_a['registered']).' - '.jam_indo($row_a['registered']).'</td>
      <td>'.$row_a['level_name'].'</td>
      <td class="text-right">
        <div class="btn-group btn-group-xs">';
        if($level_user==1){
        echo'
        <a href="#modalEdit" class="btn btn-warning btn-xs enable-tooltip" title="Edit" data-toggle="modal"';?> onclick="getElementById('txtid').value='<?PHP echo $row_a['user_id'];?>';getElementById('txtnama').value='<?PHP echo $row_a['fullname'];?>';getElementById('txtuser').value='<?PHP echo $row_a['username'];?>';getElementById('txtemail').value='<?PHP echo $row_a['email'];?>';getElementById('txtlevel').value='<?PHP echo $row_a['level'];?>';"><i class="fa fa-pencil-square-o"></i> Ubah</a><?PHP }
        else{
            // cek level 2 berdasarkan id login
            if($user_id ==$SESSION_ID){
             echo'<a href="#modalEdit" class="btn btn-warning btn-xs enable-tooltip" title="Edit" data-toggle="modal"';?> onclick="getElementById('txtid').value='<?PHP echo $row_a['user_id'];?>';getElementById('txtnama').value='<?PHP echo $row_a['fullname'];?>';getElementById('txtuser').value='<?PHP echo $row_a['username'];?>';getElementById('txtemail').value='<?PHP echo $row_a['email'];?>';getElementById('txtlevel').value='<?PHP echo $row_a['level'];?>';"><i class="fa fa-pencil-square-o"></i> Ubah</a><?PHP
            }else{
               echo'<button class="btn btn-sm btn-warning access-failed" title="Ubah"><i class="fa fa-pencil-square-o"></i> Ubah</button>';
            }
        }
        
        if($level_user==1){
          echo'
            <button data-id="'.epm_encode($row_a['user_id']).'" class="btn btn-sm btn-danger delete" title="Hapus"><i class="fa fa-trash-o"></i> Hapus</button>';
          }else{
          echo'
            <button class="btn btn-sm btn-danger access-failed" title="Hapus"><i class="fa fa-trash-o"></i> Hapus</button>';
          }
        echo'
        </div>

      </td>
    </tr>';}}
  echo'
  </tbody>
</table>
      </div>
    </div>
  </div> 
</section>


<!-- Add -->
<div class="modal fade" id="modalAdd" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
    
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Tambah Baru</h4>
      </div>
      <form id="validate" class="form add-user">
      <input type="hidden" name="aksi" required" value="add" readonly>
      <input type="hidden" name="modul" required" value="'.$mod.'" readonly>
      <div class="modal-body">

        <div class="form-group">
            <label>Nama</label>
            <input type="text" class="form-control" name="fullname" required>
        </div>

        <div class="form-group">
            <label>Username</label>
            <input type="text" class="form-control" name="username" required>
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" class="form-control" name="email" required>
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control" name="password" required>
        </div>

        <div class="form-group">
          <label>Level</label>
           <select class="form-control" name="level" required="">
            <option value="">- Pilih -</option>';
            $query="SELECT * from user_level order by level_name ASC";
            $result = $connection->query($query);
            while($row = $result->fetch_assoc()) { 
              echo'<option value="'.$row['level_id'].'">'.$row['level_name'].'</option>';
            }echo'
          </select>
        </div>

      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary pull-left"><i class="fa fa-check"></i> Simpan</button>
        <button type="button" class="btn btn-danger pull-right" data-dismiss="modal"><i class="fa fa-remove"></i> Batal</button>
      </div>
    </form>
    </div>
  </div>
</div>



<!-- Edit -->
<div class="modal fade" id="modalEdit" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
    
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit User</h4>
      </div>
      <form id="validate2" class="form update-user">
      <input type="hidden" name="id" id="txtid" required" value="" readonly>
      <div class="modal-body">

        <div class="form-group">
            <label>Nama</label>
            <input type="text" class="form-control" id="txtnama" name="fullname" required>
        </div>

        <div class="form-group">
            <label>Username</label>
            <input type="text" class="form-control" id="txtuser" name="username" required>
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" class="form-control" id="txtemail" name="email" required>
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control" name="password">
            <small class="text-danger">Kosongan jika tidak ingin diubah passwordnya</small>
        </div>

        <div class="form-group">';
        if($level_user ==1){
          echo'
          <label>Level</label>
           <select class="form-control" name="level" id="txtlevel" required="">
            <option value="">- Pilih -</option>';
            $query="SELECT * from user_level order by level_name ASC";
            $result = $connection->query($query);
            while($row = $result->fetch_assoc()) { 
              echo'<option value="'.$row['level_id'].'">'.$row['level_name'].'</option>';
            }echo'
          </select>';}else{
            echo'<input type="hidden" name="level" id="txtlevel" required readonly>';
          }
        echo'
        </div>


      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary pull-left"><i class="fa fa-check"></i> Simpan</button>
        <button type="button" class="btn btn-danger pull-right" data-dismiss="modal"><i class="fa fa-remove"></i> Batal</button>
      </div>
    </form>
    </div>
  </div>
</div>';
break;
}?>

</div>
<?php }?>