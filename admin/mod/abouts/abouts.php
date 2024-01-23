<?php session_start();
if(empty($connection)){
  header('location:../../');
} else {
  $gotoprocess = "mod/$mod/proses.php";
  include_once 'mod/sw-panel.php';
  $query="SELECT * FROM sw_user";
  $result = $connection->query($query);

echo'
  <div class="content-wrapper">';
switch(@$_GET['op']){ 
    default:
echo'
<section class="content-header">
  <h1>Profil Akun</h1>
    <ol class="breadcrumb">
      <li><a href="./"><i class="fa fa-dashboard"></i> Beranda</a></li>
      <li class="active">Profil Akun</li>
    </ol>
</section>';
echo'
<section class="content">
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">Profil Akun</h3>
        </div>

          <div class="box-body">';
          if($result->num_rows > 0){
            $row= $result->fetch_assoc();
          echo'
            <form id="validate" class="form-horizontal" method="post" action="'.$gotoprocess.'">
            <input type="hidden" name="aksi" required" value="update" readonly>
            <input type="hidden" name="modul" required" value="'.$mod.'" readonly>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Nama Lengkap</label>
                  <div class="col-sm-6">
                    <input type="tex" name="fullname" class="form-control" value="'.$row['fullname'].'" required="">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Email</label>
                  <div class="col-sm-6">
                  <input type="tex" name="email" class="form-control" value="'.$row['email'].'" required="">
                  </div>
                </div>


                <div class="form-group">
                  <label class="col-sm-2 control-label">Username</label>
                  <div class="col-sm-6">
                    <input type="text" name="username"  class="form-control" value="'.$row['username'].'" required="required">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Password</label>
                  <div class="col-sm-6">
                    <input type="password" name="password"  class="form-control">
                    <p class="text-red">*Kosongkan apabila tidak mengganti</p>
                  </div>
                </div>
                </div>
              <div class="box-footer">
                <label class="col-sm-2 control-label"></label>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                  <button type="submit" class="btn bg-blue"><i class="fa fa fa-check"></i> Simpan</button>
                </div>
              </div>
            </form>';}
          echo'
    </div>
  </div> 
</div>
</section>';
break;
}?>

</div>
<?php }?>