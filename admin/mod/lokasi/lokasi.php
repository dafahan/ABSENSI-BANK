<?php session_start();
if(empty($connection)){
  header('location:../../');
} else {
  include_once 'mod/sw-panel.php';
  require_once'../library/phpqrcode/qrlib.php'; 
echo'
  <div class="content-wrapper">';
    switch(@$_GET['op']){ 
    default:
echo'
<section class="content-header">
  <h1>Data<small> Lokasi</small></h1>
    <ol class="breadcrumb">
      <li><a href="./"><i class="fa fa-dashboard"></i> Beranda</a></li>
      <li class="active">Data Lokasi</li>
    </ol>
</section>';
echo'
<section class="content">
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title"><b>Data Lokasi</b></h3>
          <div class="box-tools pull-right">';
          if($level_user == 1){
            echo'
            ';}
          else{
            echo'
            ';
            }
          echo'
          </div>
        </div>
<div class="box-body">
<table id="swdatatable" class="table table-bordered">
  <thead>
  <tr>
    <th style="width:20px" class="text-center">No</th>
    <th>Nama Lokasi</th>
    <th>Alamat</th>
    <th class="text-center">Jumlah Pengguna</th>
    <th style="width:170px" class="text-center">Aksi</th>
  </tr>
  </thead>
  <tbody>';
  $query="SELECT building_id,name,address FROM building order by building_id  DESC";
  $result = $connection->query($query);
  if($result->num_rows > 0){
  $no=0;
 while ($row= $result->fetch_assoc()) {
  $employees_count ="SELECT id FROM employees WHERE building_id='$row[building_id]'";
  $result_count = $connection->query($employees_count);
    $no++;
    echo'
    <tr>
      <td class="text-center">'.$no.'</td>
      <td>'.$row['name'].'</td>
      <td>'.$row['address'].'</td>
      <td class="text-center"><span class="badge bg-yellow">'.$result_count->num_rows.'</span></td>
      <td class="text-right">
      <center>
        <div class="">';
          if($level_user == 1){
          echo'
          <a href="#modalEdit" class="btn btn-warning btn-xs enable-tooltip" title="Edit" data-toggle="modal"';?> onclick="getElementById('txtid').value='<?PHP echo $row['building_id'];?>';getElementById('txtname').value='<?PHP echo $row['name'];?>';getElementById('txtaddress').value='<?PHP echo $row['address'];?>';"><i class="fa fa-pencil-square-o"></i> Ubah</a>
          <?php echo'
          ';}
        else{
        echo'
          <button type="button" class="btn btn-warning btn-xs access-failed enable-tooltip" title="Edit"><i class="fa fa-pencil-square-o"></i> Ubah</button>';
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
      <form class="form validate add-lokasi">
      <div class="modal-body">
        <div class="form-group">
            <label>Nama Lokasi</label>
            <input type="text" class="form-control" name="name" required>
        </div>

        <div class="form-group">
            <label>Alamat Kantor</label>
            <textarea class="form-control address" name="address" rows="3" required></textarea>
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
      <form class="form update-lokasi" method="post">
       <input type="hidden" name="id" id="txtid" required" value="" readonly>
      <div class="modal-body">
          <div class="form-group">
              <label>Nama Lokasi</label>
              <input type="text" class="form-control" id="txtname" name="name" required>
          </div>

          <div class="form-group">
            <label>Alamat Kantor</label>
            <textarea class="form-control address" id="txtaddress" name="address" rows="3" required></textarea>
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

case 'view':

echo'
<section class="content-header">
  <h1>Edit Data<small> Karyawan</small></h1>
    <ol class="breadcrumb">
      <li><a href="./"><i class="fa fa-dashboard"></i> Beranda</a></li>
      <li><a href="./'.$mod.'"> Data Lokasi</a></li>
      <li class="active">Kode QR</li>
    </ol>
</section>

<section class="content">
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title"><b>KODE QR Lokasi</b></h3>
        </div>

      <div class="box-body">';
      if(!empty($_GET['id'])){
      $id     =  mysqli_real_escape_string($connection,epm_decode($_GET['id'])); 
      $query  ="SELECT * from building WHERE building_id='$id'";
      $result = $connection->query($query);
      if($result->num_rows > 0){
      $row  = $result->fetch_assoc();
      $codeContents = $row['code'];
      $tempdir = '../content/building/';

      #parameter inputan
      $isi_teks = $codeContents;
      $namafile = $row['building_id'].".png";
      $quality = 'H'; //ada 4 pilihan, L (Low), M(Medium), Q(Good), H(High)
      $ukuran = 10; //batasan 1 paling kecil, 10 paling besar
      $padding = 1;
      QRCode::png($isi_teks,$tempdir.$namafile,$quality,$ukuran,$padding);

     // QRcode::png($codeContents, $tempdir.''.$codeContents.'.png', QR_ECLEVEL_L, 20, 2);
      echo'
      <div class="col-md-4" id="printarea">
         <div class="box box-widget widget-user-2">
            <div class="widget-user-header bg-warning text-center">
              <div class="text-center" style="display:inline-block">
                <img class="img-responsive text-center" src="'.$tempdir.''.$row['building_id'].'.png" alt="QR CODE" width="150">
              </div>
            </div>
            <div class="box-footer no-padding">
              <ul class="nav nav-stacked">
                <li><a href="#">Kantor : '.$row['name'].'</a></li>
                <li><a href="#">Lokasi : '.$row['address'].'</a></li>
              </ul>
            </div>

            <div class="box-footer hidden-print">
                <button type="button" class="btn btn-primary btn-print"><i class="fa fa-check"></i> Cetak</button>
                <a class="btn btn-default pull-right" href="./'.$mod.'"><i class="fa fa-remove"></i> Kembali</a>
            </div>

          </div>
        </div>
      ';
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
<?php }?>