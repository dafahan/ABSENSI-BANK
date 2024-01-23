<?php
session_start();
if(empty($_SESSION['SESSION_USER']) && empty($_SESSION['SESSION_ID'])){
    header('location:../../login/');
 exit;}
else {
require_once'../../../library/sw-config.php';
require_once'../../login/login_session.php';
include('../../../library/sw-function.php');
$max_size = 2000000; //2MB
$salt = '$%DEf0&TTd#%dSuTyr47542"_-^@#&*!=QxR094{a911}+';

switch (@$_GET['action']){

case 'add':
  $error = array();
  
  if (empty($_POST['employees_code'])) {
      $error[] = 'tidak boleh kosong';
    } else {
      $employees_code= mysqli_real_escape_string($connection, $_POST['employees_code']);
  }

  if (empty($_POST['employees_email'])) {
      $error[] = 'tidak boleh kosong';
    } else {
      $employees_email= mysqli_real_escape_string($connection, $_POST['employees_email']);
  }


  if (empty($_POST['employees_password'])) {
      $error[] = 'tidak boleh kosong';
    } else {
      $employees_password= mysqli_real_escape_string($connection,hash('sha256',$salt.$_POST['employees_password']));
  }

  if (empty($_POST['employees_name'])) {
      $error[] = 'tidak boleh kosong';
    } else {
      $employees_name= mysqli_real_escape_string($connection, $_POST['employees_name']);
  }


  if (empty($_POST['position_id'])) {
      $error[] = 'tidak boleh kosong';
    } else {
      $position_id = mysqli_real_escape_string($connection, $_POST['position_id']);
  }

  if (empty($_POST['shift_id'])) {
      $error[] = 'tidak boleh kosong';
    } else {
      $shift_id = mysqli_real_escape_string($connection, $_POST['shift_id']);
  }

  if (empty($_POST['building_id'])) {
      $error[] = 'tidak boleh kosong';
    } else {
      $building_id = mysqli_real_escape_string($connection, $_POST['building_id']);
  }


  if (empty($_FILES['photo'])) { 
          $error[] = 'tidak boleh kosong';
      } else {
        $photo = $_FILES["photo"]["name"];
        $lokasi_file = $_FILES['photo']['tmp_name'];  
        $ukuran_file = $_FILES['photo']['size'];
  }


    $extension = getExtension($photo);
    $extension = strtolower($extension);
    $photo = strip_tags(md5($photo));
    $photo ="".$date."".$photo.".".$extension."";

    if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "gif")) { 
        echo'Gambar/Foto yang di unggah tidak sesuai dengan format, Berkas harus berformat JPG,JPEG,GIF..!';
    }

    else{
    if($extension=="jpg" || $extension=="jpeg" ){
    $src = imagecreatefromjpeg($lokasi_file);}
    else if($extension=="png"){$src = imagecreatefrompng($lokasi_file);}
    else {$src = imagecreatefromgif($lokasi_file);}
    list($width,$height)=getimagesize($lokasi_file);

    $width_size =400;
    $k = $width / $width_size;
    // menentukan width yang baru
    $newwidth = $width / $k;
    // menentukan height yang baru
    $newheight = $height / $k;
    $tmp=imagecreatetruecolor($newwidth,$newheight);
    //imagefill ( $thumb_p, 0, 0, $bg );
    imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);

    if (empty($error)) {
    if ($ukuran_file <= $max_size) {
    $directory='../../../content/karyawan/'.$photo.'';
    $add ="INSERT INTO employees (employees_code,
              employees_email,
              employees_password,
              employees_name,
              position_id,
              shift_id,
              building_id,
              photo,
              created_login,
              created_cookies) values('$employees_code',
              '$employees_email',
              '$employees_password',
              '$employees_name',
              '$position_id',
              '$shift_id',
              '$building_id',
              '$photo',
              '$date $time',
              '-')";
    if($connection->query($add) === false) { 
        die($connection->error.__LINE__); 
        echo'Data tidak berhasil disimpan!';
    } else{
        echo'success';
        imagejpeg($tmp,$directory,90);
    }}
    else{
        echo'Gambar yang di unggah terlalu besar Maksimal Size 2MB..!';
    }}
    else{           
        echo'Bidang inputan masih ada yang kosong..!';
    }}

break;

/* ------------------------------
    Update
---------------------------------*/
case 'update':
 $error = array();
   if (empty($_POST['id'])) {
      $error[] = 'ID tidak boleh kosong';
    } else {
      $id = mysqli_real_escape_string($connection, $_POST['id']);
  }

  if (empty($_POST['employees_code'])) {
      $error[] = 'tidak boleh kosong';
    } else {
      $employees_code= mysqli_real_escape_string($connection, $_POST['employees_code']);
  }


  if (empty($_POST['employees_name'])) {
      $error[] = 'tidak boleh kosong';
    } else {
      $employees_name= mysqli_real_escape_string($connection, $_POST['employees_name']);
  }


  if (empty($_POST['position_id'])) {
      $error[] = 'tidak boleh kosong';
    } else {
      $position_id = mysqli_real_escape_string($connection, $_POST['position_id']);
  }

  if (empty($_POST['shift_id'])) {
      $error[] = 'tidak boleh kosong';
    } else {
      $shift_id = mysqli_real_escape_string($connection, $_POST['shift_id']);
  }

  if (empty($_POST['building_id'])) {
      $error[] = 'tidak boleh kosong';
    } else {
      $building_id = mysqli_real_escape_string($connection, $_POST['building_id']);
  }


  $photo = $_FILES["photo"]["name"];
  $lokasi_file = $_FILES['photo']['tmp_name'];  
  $ukuran_file = $_FILES['photo']['size'];
  if($photo ==''){
  if (empty($error)) { 
    $update="UPDATE employees SET employees_code='$employees_code',
            employees_name='$employees_name',
            position_id='$position_id',
            shift_id='$shift_id',
            building_id='$building_id' WHERE id='$id'"; 
    if($connection->query($update) === false) { 
        die($connection->error.__LINE__); 
        echo'Data tidak berhasil disimpan!';
    } else{
        echo'success';
    }}
    else{           
        echo'Bidang inputan tidak boleh ada yang kosong..!';
    }
  }

  else{
    $query= mysqli_query($connection,"SELECT photo from employees where id='$id'");
    $data   = mysqli_fetch_assoc($query);
    $images_delete = strip_tags($data['photo']);
    $tmpfile = "../../../content/karyawan/".$images_delete;
   if(file_exists("../../../content/karyawan/$images_delete")){
      unlink ($tmpfile);
    }

    $extension = getExtension($photo);
    $extension = strtolower($extension);
    $photo = strip_tags(md5($photo));
    $photo ="".$date."".$photo.".".$extension."";

    if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "gif")) { 
        echo'Gambar/Foto yang di unggah tidak sesuai dengan format, Berkas harus berformat JPG,JPEG,GIF..!';
    }

    else{
    if($extension=="jpg" || $extension=="jpeg" ){
    $src = imagecreatefromjpeg($lokasi_file);}
    else if($extension=="png"){$src = imagecreatefrompng($lokasi_file);}
    else {$src = imagecreatefromgif($lokasi_file);}
    list($width,$height)=getimagesize($lokasi_file);

    $width_size   = 400;
    $k            = $width / $width_size;
    $newwidth     = $width / $k;
    $newheight    = $height / $k;
    $tmp          = imagecreatetruecolor($newwidth,$newheight);
    imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);

  if (empty($error)) {
    if ($ukuran_file <= $max_size) {
    $directory='../../../content/karyawan/'.$photo.'';

    $update="UPDATE employees SET employees_code='$employees_code',
            employees_name='$employees_name',
            position_id='$position_id',
            shift_id='$shift_id',
            building_id='$building_id',
            photo='$photo' WHERE id='$id'"; 
    if($connection->query($update) === false) { 
        die($connection->error.__LINE__); 
        echo'Data tidak berhasil disimpan!';
    } else{
        echo'success';
        imagejpeg($tmp,$directory,90);
    }}
    else{
        echo'Gambar yang di unggah terlalu besar Maksimal Size 2MB..!';
    }}
  }}

break;

/* --------------- Update Password ------------*/
case 'update-password':
$error = array();
  if (empty($_POST['id'])) {
      $error[] = 'ID tidak boleh kosong';
    } else {
      $id = mysqli_real_escape_string($connection, $_POST['id']);
  }

  if (empty($_POST['employees_email'])) {
      $error[] = 'tidak boleh kosong';
    } else {
      $employees_email= mysqli_real_escape_string($connection,$_POST['employees_email']);
  }

  if (empty($_POST['employees_password'])) {
      $error[] = 'tidak boleh kosong';
    } else {
      $employees_password= mysqli_real_escape_string($connection,$_POST['employees_password']);
      $password_baru =mysqli_real_escape_string($connection,hash('sha256',$salt.$employees_password));
  }

  if (empty($error)) { 

    $pesan = '<html lang="id-ID" xml:lang="id-ID"><body>';
    $pesan .= 'Saat ini ['.$employees_email.'] Sedang mengganti Password baru<br>';
    $pesan .= '<b>Password Baru Anda : '.$employees_password.'</b><br><br><br>Harap simpan baik-baik akun Anda.<br><br>';
    $pesan .= 'Hormat Kami,<br>'.$site_name.'<br>Email otomatis, Mohon tidak membalas email ini"';
    $pesan .= "</body></html>";
    $to     = $employees_email;
    $subject = 'Ubah Katasandi Baru';
    $headers = "From: " . $site_name." <".$site_email_domain.">\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

    $update="UPDATE employees SET employees_password='$password_baru' WHERE id='$id'"; 
    if($connection->query($update) === false) { 
        die($connection->error.__LINE__); 
        echo'Data tidak berhasil disimpan!';
    } else{
        echo'success';
        mail($to, $subject, $pesan, $headers);
    }}
    else{           
        echo'Bidang inputan tidak boleh ada yang kosong..!';
    }
break;


/* --------------- Delete ------------*/
case 'delete':
  $id       = mysqli_real_escape_string($connection,epm_decode($_POST['id']));

    $cari =mysqli_query($connection,"SELECT photo from employees WHERE id='$id'");
    $data =mysqli_fetch_assoc($cari);
    $images_delete = strip_tags($data['photo']);
    $directory='../../../content/karyawan/'.$images_delete.'';

  $deleted  = "DELETE FROM employees WHERE id='$id'";
    if($connection->query($deleted) === true) {
        echo'success';
        if(file_exists("../../../content/karyawan/$images_delete")){
          unlink ($directory);
        }

      } else { 
        //tidak berhasil
        echo'Data tidak berhasil dihapus.!';
        die($connection->error.__LINE__);
  }
break;

}

}
