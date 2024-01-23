<?php @session_start();

require_once'../../../library/sw-config.php';
if(empty($_SESSION['SESSION_USER']) && empty($_SESSION['SESSION_ID'])){
  header('location:../../login/');
  exit;
}
else{
  require_once'../../login/login_session.php';
switch (htmlentities(@$_GET['action'])){
case 'setting':
    echo'
    <form id="validate" class="form-horizontal update-setting" enctype="multipart/form-data" autocomplete="of">
        <div class="form-group">
          <label class="col-sm-2 control-label">Nama </label>
          <div class="col-sm-6">
            <input type="tex" name="site_name" class="form-control" value="'.$site_name.'" required="">
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">Deskripsi </label>
          <div class="col-sm-6">
            <textarea name="site_description" class="form-control" rows="3" required="required">'.$site_description.'</textarea>
          </div>
        </div>


        <div class="form-group">
          <label class="col-sm-2 control-label">No Telp</label>
          <div class="col-sm-6">
            <input type="text" name="site_phone"  class="form-control" value="'.$site_phone.'" required="required">
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">Alamat </label>
          <div class="col-sm-6">
            <input type="text" name="site_address"  class="form-control" value="'.$site_address.'" required="required">
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">Email</label>
          <div class="col-sm-6">
            <input type="text" name="site_email"  class="form-control" value="'.$site_email.'" required="required">
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">Email Domain</label>
          <div class="col-sm-6">
            <input type="text" name="site_email_domain" class="form-control" value="'.$site_email_domain.'" required="required">
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">Alamat Webite</label>
          <div class="col-sm-6">
            <input type="text" name="site_url" id="site_url" class="form-control" value="'.$site_url.'" required="required">
          </div>
        </div>
        <hr>
        <div class="form-group">
          <label class="col-sm-2 control-label">Logo Website</label>
          <div class="col-sm-6">';
            if($site_logo == NULL){
             echo'<img height="50" src="../assets/img/default-50x50.jpg">';}
            else{
                echo'<img height="50" src="../content/'.$site_logo.'">';
              }echo'<br><br>
              <input type="file" class="btn btn-default"  name="site_logo">
              <p class="text-red">*Kosongkan apabila tidak mengganti</p>
          </div>
        </div>

      <!-- /.box-body -->
      <div class="box-footer">
        <label class="col-sm-2 control-label"></label>
        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">';
        if($level_user ==1){
          echo'
          <button type="submit" class="btn bg-blue"><i class="fa fa fa-check"></i> Simpan</button>';}
        else{
          echo'<button type="button" class="btn bg-blue access-failed"><i class="fa fa fa-check"></i> Simpan</button>';
        }
        echo'
          <button type="reset" class="btn btn-danger">Reset</a>
        </div>
      </div>
      <!-- /.box-footer -->
  </form>';

break;
}}