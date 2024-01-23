
<?php 
if ($mod ==''){
    header('location:../404');
    echo'kosong';
}else{
    include_once 'mod/sw-header.php';
echo'
  <div class="content-wrapper">';
switch(@$_GET['op']){ 
    default:
echo'
<section class="content-header">
  <h1>Data<small> Laporan</small></h1>
    <ol class="breadcrumb">
    </ol>
</section>';
echo'
<section class="content">
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title"><b>Data Laporan</b></h3>
          <div class="box-tools pull-right">';
            echo'
            <a href="'.$mod.'&op=edit" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Baru</a>';
            echo'
          </div>
        </div>
<div class="box-body">
<table id="swdatatable" class="table table-bordered">
  <thead>
  <tr>
    <th style="width: 10px">No</th>
    <th>Laporan</th>
  </tr>
  </thead>
  <tbody>';
  $query="SELECT employees.*,position.position_name,shift.shift_name,building.name  FROM employees,position,shift,building WHERE employees.position_id=position.position_id AND employees.shift_id=shift.shift_id AND employees.building_id=building.building_id  order by employees.id DESC";
  $result = $connection->query($query);
  if($result->num_rows > 0){
  $no=0;
 while ($row= $result->fetch_assoc()) {
    $no++;
    echo'
    <tr>
      <td class="text-center">'.$no.'</td>
      <td>'.$row['laporan'].'</td>
    </tr>';}}
  echo'
  </tbody>
  </table>
      </div>
    </div>
  </div> 
</section>';
break;


case 'add':
echo'
<section class="content-header">
  <h1>Tambah Data<small> Laporan</small></h1>
    <ol class="breadcrumb">
    </ol>
</section>';
echo'
<section class="content">
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title"><b>Tambah Data Laporan</b></h3>
        </div>

        <div class="box-body">
            <form class="form-horizontal validate add-karyawan">
                <div class="form-group">
                  <div class="col-sm-6">
                    <input type="file" id="laporan" class="btn btn-default" id="file" name="laporan" required="" accept="file/pdf, file/docx, file/xlsx, file/xls">
                  </div>
                </div>

              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <div class="col-sm-2"></div>
                <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Simpan</button>
                <a class="btn btn-danger" href="./'.$mod.'"><i class="fa fa-remove"></i> Batal</a>
              </div>
              <!-- /.box-footer -->
            </form>
        
      </div>
    </div>
  </div> 
</section>';
break;

case 'edit':
  echo'
  <section class="content-header">
    <h1>Tambah Data<small> Laporan</small></h1>
      <ol class="breadcrumb">
      </ol>
  </section>
  
  <section class="content">
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title"><b>Tambah Data Laporan</b></h3>
        </div>
  
        <div class="box-body">';
        if(!empty($_GET['id'])){
        $id     =  mysqli_real_escape_string($connection,epm_decode($_GET['id'])); 
        $query  ="SELECT * from employees WHERE id='$id'";
        $result = $connection->query($query);
        if($result->num_rows > 0){
        $row  = $result->fetch_assoc();
        echo'
        <div class="nav-tabs-custom">
          <div class="tab-content">
            <div class="tab-pane active" id="tab_1">
  
              <form class="form-horizontal validate update-karyawan">
                <div class="box-body">
  
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Foto</label>
                    <div class="col-sm-6">
                      <div class="upload-media">';
                      echo'
                      </div>
                      <input type="file" id="laporan" class="btn btn-default" id="file" name="laporan" accept="file/pdf, file/docx, file/xlsx">
                    </div>
                  </div>
  
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                  <div class="col-sm-2"></div>
                  <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Simpan</button>
                  <a class="btn btn-danger" href="./'.$mod.'"><i class="fa fa-remove"></i> Batal</a>
                </div>
                <!-- /.box-footer -->
              </form>
            </div>
          <!-- /.tab-content -->
        </div>
        <!-- nav-tabs-custom -->';
        }else{
           echo'<section class="content">
              <div class="error-page">
                <h2 class="headline text-yellow"> 404</h2>
                <div class="error-content">
                  <h3><i class="fa fa-warning text-yellow"></i> Oops! Page not found.</h3>
                  <p>
                  Saat ini data yang Anda cari tidak ditemukan<br>
                  <a class="btn btn-primary" href="./">return to dashboard</a>
                  </p>
                </div>
              </div>
            </section>';
        }}
          echo'
        </div>
      </div>
    </div> 
  </section>';
  
  break;
}?>

</div>
<?php 
  include_once 'mod/sw-footer.php'; }?>