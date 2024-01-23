<?php
session_start();
if(empty($_SESSION['SESSION_ADMIN']) && empty($_SESSION['SESSION_ID_ADMIN'])){
    header('location:../../login/');
 exit;}
else {
require_once'../../../library/config.php';
require_once'../../login/login_session.php';
include('../../../library/sw-function.php');
$salt = '$%DSuTyr47542@#&*!=QxR094{a911}+';
$modul='';$aksi='';
if(!empty($_POST['modul'])){$modul =htmlentities($_POST['modul']);}
if(!empty($_POST['aksi'])){$aksi = htmlentities($_POST['aksi']);}
$extensionList = array("jpg", "png", "ico");

// add
if ($modul=='abouts' AND $aksi=='update'){
$error = array();

if (empty($_POST['username'])) {
        $error[] = 'tidak boleh kosong';
    } else {
    $username = mysqli_real_escape_string($connection, $_POST['username']);
}

if (empty($_POST['fullname'])) {
        $error[] = 'tidak boleh kosong';
    } else {
    $fullname = mysqli_real_escape_string($connection,$_POST['fullname']);
}


if (empty($_POST['email'])) {
        $error[] = 'tidak boleh kosong';
    } else {
    $email = mysqli_real_escape_string($connection,$_POST['email']);
}

$password = mysqli_real_escape_string($connection,$_POST['password']);
$password_baru =mysqli_real_escape_string($connection,hash('sha256',$salt.$password));

if($password == ''){
if (empty($error)) { 

  $pesan = '<html lang="id-ID" xml:lang="id-ID"><body>';
  $pesan .= 'Saat ini '.$fullname.' telah mengganti password baru<br>';
  $pesan .= 'Detail Akun:<br>';
  $pesan .= 'Nama: '.$fullname.'<br>Email: '.$user_email .'<br>Username:'.$username.'<br><b>Password Baru: '.$password.'</b><br><br>';
  $pesan .= 'Hormat kami,<br>'.$site_name.'<br>Email otomatis, mohon tidak membalas email ini"';
  $pesan .= "</body></html>";
  $to = $user_email ;
  $subject = ''.$fullname.' sedang online';
  $headers = "From: " . $site_name." <".$site_email_domain.">\r\n";
  $headers .= "MIME-Version: 1.0\r\n";
  $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

$update = "UPDATE sw_user SET username='$username',
                      fullname='$fullname',
                      email='$email' WHERE user_id='1'"; 
if($connection->query($update) === false) { 
  die($connection->error.__LINE__); 
  _goto('../../?mod='.$modul.'&alert=error'); // error
  $_SESSION['messages'] ='Data Tidak dapat di simpan...!';
} else   {
  _goto('../../?mod='.$modul.'&alert=success'); // sukses
  $_SESSION['messages']='Password Baru berhasil di simpan..!';
  mail($to, $subject, $pesan, $headers);
  }
}
else{
  foreach ($error as $key => $values) {            
  _goto('../../?mod='.$modul.'&alert=error');
   $_SESSION['messages'] ='Bidang inputan tidak boleh ada yang kosong..!';
  }
  }
}
else{
  $update = "UPDATE sw_user SET username='$username',
                    password='$password_baru',
                    fullname='$fullname',
                    email='$email' WHERE user_id='1'"; 

if($connection->query($update) === false) { 
        _goto('../../?mod='.$modul.'&alert=error'); // error
        $_SESSION['messages'] ='Data Tidak dapat di simpan...!';
      }else{
        _goto('../../?mod='.$modul.'&alert=success'); // sukses
        $_SESSION['messages']='Data berhasil di simpan..!';
      }
    }
  }

}
