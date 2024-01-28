
<?php 
if ($mod ==''){
    header('location:../404');
    echo'kosong';
}else{
  $e_id = epm_decode($_COOKIE['COOKIES_MEMBER']);

    if (isset($_POST['submit'])) {
      $file_name   = $_FILES['file']['name'];
      $size        = $_FILES['file']['size'];
      $error       = $_FILES['file']['error'];
      $tmpName     = $_FILES['file']['tmp_name'];
      $filepath    = 'content/karyawan/';
      $valid       = array('pdf', 'doc', 'docx');
      $nowdate     = date('Y-m-d');
      var_dump($file_name);

      if (strlen($file_name)) {
          
          list($txt, $ext) = explode(".", $file_name);
          $file_ext = strtolower(substr($file_name, strripos($file_name, '.')));

          
              if ($size < 10000000) { // Maximum size set to 10 MB
                  // Perintah pengganti nama files
                  $file_new   = '' . $row_user['employees_code'] . '-' . strip_tags(md5($file_name)) . '-' . seo_title($nowdate) . '-file' . $file_ext . '';
                  $pathFile   = $filepath . $file_new;

                  // Example: Insert into 'laporan' table
                  $insert = "INSERT INTO laporan (files, user_id, status, tanggal) 
                            VALUES ('$file_new', '$e_id', '', '$nowdate')";
                  echo '<script>console.log("'.$insert.'");</script>';
                  if ($connection->query($insert) === false) {
                      echo 'Pengaturan tidak dapat disimpan, coba ulangi beberapa saat lagi.!';
                      die($connection->error . __LINE__);
                  } else {
                    if (move_uploaded_file($tmpName, $pathFile)) {
                      echo 'Success: File moved to ' . $pathFile;
                  } else {
                      echo 'Error moving file. Error code: ' . $_FILES['file']['error'];
                      echo 'Destination path: ' . $pathFile;
                  }
                  
                  }
              } else {
                  // Jika file melebihi size maksimal
                  echo 'File terlalu besar, maksimal 10 MB!';
              }
          
      }
        $currentUrl = "http" . (isset($_SERVER['HTTPS']) ? "s" : "") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
             header("Location: $currentUrl");
             exit(); 
      
    }
    
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
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
    Tambah Laporan
  </button>
            ';
             echo'
          </div>
        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <form method="post" enctype="multipart/form-data">

      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah tahun</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <label  for="file">Masukan FIle Laporan (PDF/WORD)</label>
      <input type="file" name="file" class="form-control" id="file" accept=".pdf, .doc, .docx" required>
        
        
      </div>
      <div class="modal-footer">
        <button type="submit" name="submit" class="btn btn-primary">Tambah</button>
      </div>
      </form>
    </div>
  </div>
</div>
<div class="box-body">
<table id="swdatatable" class="table table-bordered">
  <thead>
  <tr>
    <th style="width: 10px">No</th>
    <th>Tanggal</th>
    <th>Status</th>
  </tr>
  </thead>
  <tbody>';
  $query="SELECT * FROM laporan WHERE user_id = $e_id ORDER BY tanggal; ";
  $result = $connection->query($query);
  if($result->num_rows > 0){
  $no=0;
 while ($row= $result->fetch_assoc()) {
    $no++;
    echo'
    <tr>
      <td class="text-center">'.$no.'</td>
      <td>'.$row['tanggal'].'</td>
      <td>'.$row['status'].'</td>
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