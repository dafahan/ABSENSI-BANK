<?php
session_start();
if(!empty($_SESSION['SESSION_USER']) && !empty($_SESSION['SESSION_ID'])){
  header('location:../admin/');
  exit;
}
else {
  require_once'../../library/sw-config.php';
?>
<!DOCTYPE html>
<html lang="id-ID" xml:lang="id-ID">
<head>

  <!--Title-->
  <title>Login Admin <?php echo $site_name; ?></title>

  <?php
    include_once '../../library/seo-meta-all.php';
  ?>

  <!-- CSS -->
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/css/AdminLTE.min.css">
  <link rel="stylesheet" href="../assets/css/skin-blue-light.css">
  <link rel="stylesheet" href="../assets/css/font-awesome.css">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<?php echo'
  <body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <div style="background:#08355e;border-radius:30px;padding:10px 15px" class="section text-center">
        <h1 style="color:#FFFFFF;font-size:24px;">Login Administrator</h1>
        <a href="'.$site_url.'"><img src="'.$site_url.'/content/'.$site_logo.'" height="70"></a>
      </div>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
      <p class="login-box-msg">Masukkan email dan password Anda untuk login ke sistem</p>

        <div class="form-group has-feedback">
          <input type="text" id="username" name="username" class="form-control" placeholder="Username">
          <span class="fa fa-user form-control-feedback"></span>
        </div>
       
        <div class="form-group has-feedback">
          <input type="password" id="password" name="password" class="form-control" placeholder="Password">
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>

        <div class="row">
          <div class="col-md-12">
            <span id="stat"></span>
          </div>
          <div class="col-xs-12">
            <button type="submit" class="btn btn-primary btn-block" id="login"><i class="fa fa-user"></i> Login</button>
            <a href="../../" class="btn btn-warning btn-block"><i class="fa fa-home"></i> Home</a>
          </div>
          <!-- /.col -->
        </div>

      </div>
    <!-- /.login-box-body -->
  </div>
  <!-- /.login-box -->';
?>

    <footer class="text-muted text-center">
      Redeveloped by <a href="https://mycoding.id" rel="dofollow" target="_blank">MC Project</a> - <a href="https://401xd.com" rel="dofollow" target="_blank">401XD Group</a><br/><div style="display: none;"><a class="credits" href="https://s-widodo.com" rel="nofollow" target="_blank"></a></div>
    </footer>

    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/adminlte.js"></script>
    <script src="../assets/js/demo.js"></script>
    <script src="./jquery-login.js"></script>
  </body>
</html>
<?php }?>