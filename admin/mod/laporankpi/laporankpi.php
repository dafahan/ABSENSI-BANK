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
  <h1>Data<small> Laporan</small></h1>
    <ol class="breadcrumb">
      <li><a href="./"><i class="fa fa-dashboard"></i> Beranda</a></li>
      <li class="active">Data Laporan</li>
    </ol>
</section>';
echo'
<section class="content">';
if (isset($_POST['submit'])) {
  $year = $_POST['year'];
  $bade = $_POST['bade'];
  $npl = $_POST['npl'];
  $par = $_POST['par'];
  $behavior = $_POST['behavior'];
  $service = $_POST['service'];
  $knowledge = $_POST['knowledge'];
  $uid = $_POST['uid'];
  $sqlCheckExistence = "SELECT * FROM item_kpi 
         WHERE year = '$year' AND user_id = '$uid'";
         $result = $connection->query($sqlCheckExistence);
  

         if ($result->num_rows > 0) {
          $sqlUpdate = "UPDATE item_kpi 
          SET bade = '$bade', npl = '$npl', par = '$par', behavior = '$behavior'
          , `service` = '$service' , knowledge = '$knowledge' 
                  WHERE year = '$year' AND user_id = '$uid'";
          echo $sqlUpdate;
          $check = $connection->query($sqlUpdate);
          
 
          }else{
          $sqlInsert = "INSERT INTO item_kpi (year, bade, npl, par,user_id,knowledge,`service`,behavior) 
                  VALUES ('$year', '$bade', '$npl', '$par', '$uid','$knowledge','$service','$behavior')";
          $connection->query($sqlInsert);
 
          }
 
          echo '<script type="text/javascript">';
echo 'window.location.href="' . $_SERVER['REQUEST_URI'] . '"';
echo '</script>';
echo '<noscript>';
echo '<meta http-equiv="refresh" content="0;url=' . $_SERVER['REQUEST_URI'] . '" />';
echo '</noscript>';


}
echo'
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title"><b>Data Laporan</b></h3>
        </div>
<div class="box-body">
<table id="swdatatable" class="table table-bordered">
  <thead>
  <tr>
    <th style="width: 10px">No</th>
    <th>NIP</th>
    <th>Nama</th>
    <th>Email</th>
    <th>Jabatan</th>
    <th>Penempatan</th>
    <th>Lokasi</th>
    <th>Nilai</th>
    <th style="width:120px" class="text-right">Aksi</th>
  </tr>
  </thead>
  <tbody>';
  $query = "SELECT employees.*, position.position_name, shift.shift_name, building.name, item_kpi.score AS nilai 
          FROM employees
          INNER JOIN position ON employees.position_id = position.position_id
          INNER JOIN shift ON employees.shift_id = shift.shift_id
          INNER JOIN building ON employees.building_id = building.building_id
          LEFT JOIN item_kpi ON employees.id = item_kpi.user_id
          ORDER BY employees.id DESC";

  $result = $connection->query($query);
  if($result->num_rows > 0){
  $no=0;
 while ($row= $result->fetch_assoc()) {
    $no++;
    echo'
    <tr>
      <td class="text-center">'.$no.'</td>
      <td>'.$row['employees_code'].'</td>
      <td>'.$row['employees_name'].'</td>
      <td>'.$row['employees_email'].'</td>
      <td>'.$row['position_name'].'</td>
      <td>'.$row['shift_name'].'</td>
      <td>'.$row['name'].'</td>
      <td>'.(($row['nilai']!=null)? $row['nilai']:"0") .'</td>
      <td class="text-right">
        <div class="btn-group">';
        if($level_user==1){
          echo'
          <div class="btn-group">
          <button  class="btn btn-warning btn-xs enable-tooltip" data-toggle="modal" data-target="#detail'.$row['id'].'"><i class="fa fa-eye" aria-hidden="true"></i> Detail</button>
        </div>';}
        else{
        echo'
        <div class="btn-group">
                    <a href="./'.$mod.'&op=views&id='.epm_encode($row['id']).'" class="btn btn-warning btn-xs enable-tooltip" title="Detail"><i class="fa fa-eye" aria-hidden="true"></i> Detail</a>
                  </div>';
        }
        echo'
        </div>

      </td>
      <div class="modal fade"  id="detail'.$row['id'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document"  style="width:80vw;height:90vh;">
        <div class="modal-content"  style="width:100%;height:100%;">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Detail KPI</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" >';
          $userId = $row['id'];
          
          $query = "SELECT year FROM item_kpi WHERE user_id = $userId";
          $res = $connection->query($query);
          if ($res->num_rows > 0) {
          if ($res) {
            
            while ($rowres = $res->fetch_assoc()) {
              echo '<div class="form-group">
              <button style="width:100%;" class="btn btn-warning btn-xs enable-tooltip" data-toggle="modal" data-target="#detail'.$row['id'].'-'.$rowres['year'].'" ><i class="fa fa-eye" aria-hidden="true"></i> '.$rowres['year'].'</button>
            </div>';

            echo'
            <form method="post">
            <div class="modal fade" id="detail'.$row['id'].'-'.$rowres['year'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="position: fixed; z-index: 1051;">
            <div class="modal-dialog" role="document" >
              <div class="modal-content" >
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">'.$rowres['year'].'</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body" >';
                  
              $yearCur = $rowres['year'];
              $query = "SELECT * FROM item_kpi WHERE user_id = $userId AND year = $yearCur";
              $resu = $connection->query($query);
              if ($resu) {
                $rowS = $resu->fetch_assoc();
                
                    echo '
                    <form method="post" >
                    <div class="form-group">
                    <label for="col1">Bade (35%) </label>
                    <input type="text" value="'.((isset($rowS['bade']))? $rowS['bade']:0).'" name="bade" class="form-control" id="col1"  >
                    </div>

                    <div class="form-group">
                    <label for="col1">NPL (25%) </label>
                    <input type="text" value="'.((isset($rowS['npl']))? $rowS['npl']:0).'" name="npl" class="form-control" id="col1"  >
                    </div>

                    <div class="form-group">
                    <label for="col1">PAR (10%) </label>
                    <input type="text" value="'.((isset($rowS['par']))? $rowS['par']:0).'" name="par" class="form-control" id="col1"  >
                    </div>
                    

                    <div class="form-group">
                    <label for="col1">Kedisiplinan & Integritas (10%) </label>
                    <input type="text" value="'.((isset($rowS['behavior']))? $rowS['behavior']:0).'" name="behavior" class="form-control" id="col1"  >
                    </div>

                    <div class="form-group">
                    <label for="col1">Product Knowledge (10%) </label>
                    <input type="text" value="'.((isset($rowS['knowledge']))? $rowS['knowledge']:0).'" name="knowledge" class="form-control" id="col1"  >
                    </div>
                    
                    <div class="form-group">
                    <label for="col1">Service & Adminitrasi (10%) </label>
                    <input type="text" value="'.((isset($rowS['service']))? $rowS['service']:0).'" name="service" class="form-control" id="col1"  >
                    </div>
                    <input type="hidden" name="uid" value="'.$userId.'">
                    <input type="hidden" name="year" value="'.$yearCur.'">
                    '
                    
                    ;
              }

                echo '
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button name="submit" type="submit" class="btn btn-primary">Save changes</button>
                </div>
              </div>
            </div>
            </div>
            </form>
          
            ';
                
            }
                
                
          }
          }else{
            echo 'No Data Found';
          }
          ?>
          

          <?php
          echo '</div>
          
        </div>
      </div>
    </div>
   
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
      <li><a href="./"><i class="fa fa-dashboard"></i> Beranda</a></li>
      <li><a href="./karyawan"> Data Laporan</a></li>
      <li class="active">Tambah Laporan</li>
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
              <div class="box-body">

                <div class="form-group">
                  <label class="col-sm-2 control-label">NIP</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" name="employees_code" required>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Nama</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" name="employees_name" required>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Email</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" name="employees_email" required>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Password</label>
                  <div class="col-sm-6">
                    <input type="password" class="form-control" name="employees_password" required>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Jabatan</label>
                  <div class="col-sm-6">
                   <select class="form-control" name="position_id" required="">
                      <option value="">- Pilih -</option>';
                      $query="SELECT * from position order by position_name ASC";
                      $result = $connection->query($query);
                      while($row = $result->fetch_assoc()) { 
                      echo'<option value="'.$row['position_id'].'">'.$row['position_name'].'</option>';
                      }echo'
                  </select>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Shift</label>
                  <div class="col-sm-6">
                   <select class="form-control" name="shift_id" required="">
                      <option value="">- Pilih -</option>';
                      $query="SELECT shift_id,shift_name from shift order by shift_name ASC";
                      $result = $connection->query($query);
                      while($row = $result->fetch_assoc()) { 
                      echo'<option value="'.$row['shift_id'].'">'.$row['shift_name'].'</option>';
                      }echo'
                  </select>
                  </div>
                </div>


                <div class="form-group">
                  <label class="col-sm-2 control-label">Penempatan</label>
                  <div class="col-sm-6">
                   <select class="form-control" name="building_id" id="building" required="">
                      <option value="">- Pilih -</option>';
                      $query="SELECT building_id,name,address from building order by name ASC";
                      $result = $connection->query($query);
                      while($row = $result->fetch_assoc()) { 
                      echo'<option value="'.$row['building_id'].'">'.$row['name'].', '.$row['address'].'</option>';
                      }echo'
                  </select>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Foto</label>
                  <div class="col-sm-6">
                    <img width="80" class="preview" src="./assets/img/boxed-bg.jpg"><br><br>
                    <input type="file" id="imgInp" class="btn btn-default" id="file" name="photo" required="" accept="image/jpeg, image/jpg, image/gif" capture>
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
  <h1>Edit Data<small> Pengguna</small></h1>
    <ol class="breadcrumb">
      <li><a href="./"><i class="fa fa-dashboard"></i> Beranda</a></li>
      <li><a href="./karyawan"> Data Pengguna</a></li>
      <li class="active">Edit Pengguna</li>
    </ol>
</section>

<section class="content">
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <div class="box box-solid">
        <div class="box-header">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_1" data-toggle="tab">Profil</a></li>
            <li><a href="#tab_2" data-toggle="tab">Ubah Password</a></li>
          </ul>
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
                  <label class="col-sm-2 control-label">NIP</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" name="employees_code" value="'.$row['employees_code'].'" required>
                    <input type="hidden"  name="id" value="'.$row['id'].'" readonly required>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Nama</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" name="employees_name" value="'.$row['employees_name'].'" required>
                  </div>
                </div>

                
                <div class="form-group">
                  <label class="col-sm-2 control-label">Jabatan</label>
                  <div class="col-sm-6">
                   <select class="form-control" name="position_id" required="">
                      <option value="">- Pilih -</option>';
                      $query="SELECT * from position order by position_name ASC";
                      $result = $connection->query($query);
                      while($rowa = $result->fetch_assoc()) { 
                      if($rowa['position_id'] == $row['position_id']){
                        echo'<option value="'.$rowa['position_id'].'" selected>'.$rowa['position_name'].'</option>';
                      }else{
                        echo'<option value="'.$rowa['position_id'].'">'.$rowa['position_name'].'</option>';
                      }
                      }echo'
                  </select>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Shift</label>
                  <div class="col-sm-6">
                   <select class="form-control" name="shift_id" required="">
                      <option value="">- Pilih -</option>';
                      $query="SELECT shift_id,shift_name from shift order by shift_name ASC";
                      $result = $connection->query($query);
                      while($rowa = $result->fetch_assoc()) {
                      if($rowa['shift_id'] == $row['shift_id']){ 
                        echo'<option value="'.$rowa['shift_id'].'" selected>'.$rowa['shift_name'].'</option>';
                      }else{
                        echo'<option value="'.$rowa['shift_id'].'">'.$rowa['shift_name'].'</option>';
                      }
                      }echo'
                  </select>
                  </div>
                </div>


                <div class="form-group">
                  <label class="col-sm-2 control-label">Penempatan</label>
                  <div class="col-sm-6">
                   <select class="form-control" name="building_id" id="building" required="">
                      <option value="">- Pilih -</option>';
                      $query="SELECT building_id,name,address from building order by name ASC";
                      $result = $connection->query($query);
                      while($rowa = $result->fetch_assoc()) { 
                      if($rowa['building_id'] == $row['building_id']){ 
                        echo'<option value="'.$rowa['building_id'].'" selected>'.$rowa['address'].'</option>';
                      }else{
                        echo'<option value="'.$rowa['building_id'].'">'.$rowa['address'].'</option>';
                      }
                      }echo'
                  </select>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Foto</label>
                  <div class="col-sm-6">
                    <div class="upload-media">';
                     if($row['photo'] == NULL){
                      echo'<img width="80" class="preview" width="80" src="../assets/img/no_foto.jpg">';}
                    else{
                      echo'<img width="80" class="preview" width="80" src="../content/karyawan/'.$row['photo'].'">';
                    }echo'
                    </div>
                    <input type="file" id="imgInp" class="btn btn-default" id="file" name="photo" accept="image/jpeg, image/jpg, image/gif" capture>
                    <small>Kosongan jika tidak ingin mengubah</small>
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

          <!-- /.tab-pane -->
          <div class="tab-pane" id="tab_2">
            <form class="form-horizontal validate update-password">
              <div class="box-body">
                <div class="form-group">
                  <label class="col-sm-2 control-label">Email</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" name="employees_email" value="'.$row['employees_email'].'" readonly required>
                    <input type="hidden"  name="id" value="'.$row['id'].'" readonly required>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Password</label>
                  <div class="col-sm-6">
                    <input type="password" class="form-control" id="password" name="employees_password" required>
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
<?php }?>