<?php session_start();
if(empty($connection)){
  header('location:../../');
} else {
  $gotoprocess = "mod/$mod/proses.php";
  include_once 'mod/sw-panel.php';
echo'
  <div class="content-wrapper">';
    switch(@$_GET['op']){ 
    default:
echo'
<section class="content-header">
  <h1>Data<small> Jam Kerja</small></h1>
    <ol class="breadcrumb">
      <li><a href="./"><i class="fa fa-dashboard"></i> Beranda</a></li>
      <li class="active">Data Jam Kerja</li>
    </ol>
</section>';
echo'
<section class="content">
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title"><b>Data Jam Kerja</b></h3>
          <div class="box-tools pull-right">';
          if($level_user==1){
            echo'
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAdd"><i class="fa fa-plus"></i> Tambah Baru</button>';}
            else{
            echo'<button type="button" class="btn btn-primary access-failed"><i class="fa fa-plus"></i> Tambah Baru</button>';
            }
            echo'
          </div>
        </div>
<div class="box-body">
<table id="swdatatable" class="table table-bordered">
  <thead>
  <tr>
    <th style="width:20px" class="text-center">No</th>
    <th>Penempatan</th>
    <th>Waktu Masuk</th>
    <th>Waktu Pulang</th>
    <th style="width:120px">Aksi</th>
  </tr>
  </thead>
  <tbody>';
  $query="SELECT shift_id,shift_name,time_in,time_out FROM shift order by shift_id DESC";
  $result = $connection->query($query);
  if($result->num_rows > 0){
  $no=0;
 while ($row= $result->fetch_assoc()) {
    $no++;
    echo'
    <tr>
      <td class="text-center">'.$no.'</td>
      <td>'.$row['shift_name'].'</td>
      <td>'.$row['time_in'].'</td>
      <td>'.$row['time_out'].'</td>
      <td>
        <div class="btn-group">';
        if($level_user==1){
        echo'
          <a href="#modalEdit" class="btn btn-warning btn-xs enable-tooltip" title="Edit" data-toggle="modal"';?> onclick="getElementById('txtid').value='<?PHP echo $row['shift_id'];?>';getElementById('txtname').value='<?PHP echo $row['shift_name'];?>';getElementById('txtin').value='<?PHP echo $row['time_in'];?>';getElementById('txtout').value='<?PHP echo $row['time_out'];?>';"><i class="fa fa-pencil-square-o"></i> Ubah</a>
        <?php echo'
        <buton data-id="'.epm_encode($row['shift_id']).'" class="btn btn-xs btn-danger delete" title="Hapus"><i class="fa fa-trash-o"></i> Hapus</button>';}
      else{
    echo'
          <button type="button" class="btn btn-warning btn-xs access-failed enable-tooltip" title="Edit"><i class="fa fa-pencil-square-o"></i> Ubah</button>
          <buton type="button" class="btn btn-xs btn-danger access-failed" title="Hapus"><i class="fa fa-trash-o"></i> Hapus</button>';
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
      <form class="form validate add-shift">
      <div class="modal-body">
        <div class="form-group">
            <label>Penempatan</label>
            <input type="text" class="form-control" name="shift_name" required>
        </div>

        <div class="form-group">
            <label>Waktu Masuk</label>
            <div class="input-group">
              <input type="text" name="time_in" class="form-control timepicker" data-date-format="HH:mm:ss" value="07:30:00" required>
              <div class="input-group-addon">
                <i class="fa fa-clock-o"></i>
              </div>
            </div>
        </div>

        <div class="form-group">
            <label>Waktu Pulang</label>
            <div class="input-group">
              <input type="text" name="time_out" class="form-control timepicker" required>
              <div class="input-group-addon">
                <i class="fa fa-clock-o"></i>
              </div>
            </div>
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

<!-- MODAL EDIT -->
<div class="modal fade" id="modalEdit" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Update Data</h4>
      </div>
      <form class="form update-shift" method="post">
       <input type="hidden" name="id" id="txtid" required" value="" readonly>
      <div class="modal-body">
          <div class="form-group">
              <label>Penempatan</label>
              <input type="text" class="form-control" id="txtname" name="shift_name" required>
          </div>

          <div class="form-group">
              <label>Waktu Masuk</label>
              <div class="input-group">
                <input type="text" name="time_in" id="txtin" class="form-control timepicker" data-date-format="HH:mm:ss" value="" required>
                <div class="input-group-addon">
                  <i class="fa fa-clock-o"></i>
                </div>
              </div>
          </div>

          <div class="form-group">
              <label>Waktu Pulang</label>
              <div class="input-group">
                <input type="text" name="time_out" id="txtout" class="form-control timepicker" required>
                <div class="input-group-addon">
                  <i class="fa fa-clock-o"></i>
                </div>
              </div>
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