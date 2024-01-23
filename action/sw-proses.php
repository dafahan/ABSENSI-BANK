<?php session_start();
    require_once'../library/sw-config.php'; 
    require_once'../library/sw-function.php';
    require_once'../mod/out/sw-cookies.php';
    $ip_login  = $_SERVER['REMOTE_ADDR'];
    $time_login = date('Y-m-d H:i:s');
    $iB = getBrowser();
    $browser = $iB['name'].'-'.$iB['version'];
    $allowed_ext = array("png", "jpg", "jpeg");
    //$created_cookies = rand(19999,9999).rand(888888,111111).date('ymdhisss');
    $salt = '$%DEf0&TTd#%dSuTyr47542"_-^@#&*!=QxR094{a911}+';

    $expired_cookie = time()+60*60*24*7;

switch (@$_GET['action']){

case 'login':
  $error = array();
  if (empty($_POST['email'])) { 
        $error[] = 'Email tidak boleh kosong';
    } else { 
      $email = mysqli_real_escape_string($connection,$_POST['email']);
      $created_cookies =  md5($email);
  }

  if (empty($_POST['password'])) { 
        $error[] = 'Password tidak boleh kosong';
    } else {
      $password = hash('sha256',$salt.$_POST['password']);

  }

if (empty($error)){
    $update_user = mysqli_query($connection,"UPDATE employees SET created_login='$time_login',  created_cookies='$created_cookies' WHERE employees_password='$password'");

    $query_login ="SELECT id,employees_email,employees_name,created_cookies FROM employees WHERE employees_email='$email' AND employees_password='$password'";
    $result_login       = $connection->query($query_login);
    $row                = $result_login->fetch_assoc();

    $COOKIES_MEMBER         =  epm_encode($row['id']);
    $COOKIES_COOKIES        =  $row['created_cookies'];
      
  $pesan = '<html lang="id-ID" xml:lang="id-ID"><body>';
  $pesan .= 'Saat ini '.$row['employees_name'].' baru saja login<br>';
  $pesan .= 'Detail Akun:';
  $pesan .= 'Nama: '.$row['employees_name'].'<br>Email: '.$row['employees_email'].'<br>Ip: '.$ip_login.'<br>Tgl Login: '.$time_login.'<br>Browser: '.$browser.'<br><br><br>';
  $pesan .= 'Hormat kami,<br>'.$site_name.'<br>Email otomatis, Mohon tidak membalas email ini';

  $pesan   .= "</body></html>";
  $to       = $row['employees_email'];
  $subject  = ''.$row['employees_name'].' Sedang Online';
  $headers  = "From: " . $site_name." <".$site_email_domain.">\r\n";
  $headers .= "MIME-Version: 1.0\r\n";
  $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

  if($result_login->num_rows > 0){
      echo'success';
      setcookie('COOKIES_MEMBER', $COOKIES_MEMBER, $expired_cookie, '/');
      setcookie('COOKIES_COOKIES', $COOKIES_COOKIES, $expired_cookie, '/');
  }
  else {
    echo'Email dan password yang Anda masukkan salah!';
    }
  }

  else{       
  	echo'Bidang inputan tidak boleh ada yang kosong!';
  }

break;

/* ------------- REGISTRASI ---------------*/
case 'registrasi':

$query = mysqli_query($connection, "SELECT max( employees_code) as kodeTerbesar FROM employees");
$data = mysqli_fetch_array($query);
$kode_karyawan = $data['kodeTerbesar'];
$urutan = (int) substr($kode_karyawan, 3, 3);
$urutan++;
$huruf = "OM";
$kode_karyawan = $huruf . sprintf("%03s", $urutan);
$employees_code = ''.$kode_karyawan.'-'.$year.'';

$error = array();

  if (empty($_POST['employees_name'])) {
      $error[] = 'tidak boleh kosong';
    } else {
      $employees_name= mysqli_real_escape_string($connection, $_POST['employees_name']);
  }

  if (empty($_POST['employees_email'])) {
      $error[] = 'tidak boleh kosong';
    } else {
      $employees_email= mysqli_real_escape_string($connection, $_POST['employees_email']);
      $created_cookies = md5($employees_email);
  }


  if (empty($_POST['employees_password'])) {
      $error[] = 'tidak boleh kosong';
    } else {
      $employees_password= mysqli_real_escape_string($connection,hash('sha256',$salt.$_POST['employees_password']));
      $password_send = mysqli_real_escape_string($connection,$_POST['employees_password']);
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

  if (empty($error)) {
    $pesan = '<html lang="id-ID" xml:lang="id-ID"><body>';
    $pesan .= 'Pendaftaran Akun di '.$site_name.' berhasil dengan detail sebagai berikut:';
    $pesan .= 'Detail Akun:';
    $pesan .= 'Nama: '.$employees_name.'<br>Email: '.$employees_email.'<br>Password: '.$password_send.'<br>Id: '.$ip.'<br>Browser: '.$browser.'';
    $pesan .= 'Hormat kami,<br>'.$site_name.'<br>Email otomatis, Mohon tidak membalas email ini';
    $pesan .= "</body></html>";
    $to     = $employees_email;
    $subject = 'Registrasi Akun Berhasil';
    $headers = "From: ".$site_name."<".$site_email_domain.">\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

if (filter_var($employees_email, FILTER_VALIDATE_EMAIL)) {
  $query="SELECT employees_email from employees where employees_email='$employees_email'";
  $result= $connection->query($query) or die($connection->error.__LINE__);
  if(!$result ->num_rows >0){
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
              '',
              '$date',
              '$created_cookies')";
    if($connection->query($add) === false) { 
        die($connection->error.__LINE__); 
        echo'Data tidak berhasil disimpan!';
    } else{
        echo'success';
        mail($to, $subject, $pesan, $headers);
    }}
    else   {
      echo'Sepertinya Email "'.$employees_email.'" sudah terdaftar!';
    }}

    else {
     echo'Email yang anda masukkan salah!';
    }}

    else{           
        echo'Bidang inputan masih ada yang kosong..!';
    }
break;


/* ------------- FORGOT ---------------*/
case 'forgot':
  $pass="1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ";
  $panjang_pass='8';$len=strlen($pass); 
  $start=$len-$panjang; $xx=rand('0',$start); 
  $yy=str_shuffle($pass);

$error = array();

  if (empty($_POST['employees_email'])) {
      $error[] = 'tidak boleh kosong';
    } else {
      $employees_email= mysqli_real_escape_string($connection, $_POST['employees_email']);
  }


  $passwordbaru = substr($yy, $xx, $panjang_pass);
  $employees_password = mysqli_real_escape_string($connection,hash('sha256',$salt.$passwordbaru));

  if (empty($error)) {
    $pesan = '<html lang="id-ID" xml:lang="id-ID"><body>';
    $pesan .= 'Permintaan ganti password akun Anda di '.$site_name.', dengan email '.$employees_email.' telah berhasil.<br>';
    $pesan .= 'Password Anda: <b>'.$passwordbaru.'</b><br><br>Silakan gunakan password diatas untuk login, Anda dapat merubahnya di pengaturan akun.<br><br>';
    $pesan .= 'Hormat kami,<br>'.$site_name.'<br>Email otomatis, Mohon tidak membalas email ini';
    $pesan .= "</body></html>";
    $to     = $employees_email;
    $subject = 'Reset Password Berhasil';
    $headers = "From: " . $site_name." <".$site_email_domain.">\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

if (filter_var($employees_email, FILTER_VALIDATE_EMAIL)) {
  $query="SELECT employees_email from employees where employees_email='$employees_email'";
  $result= $connection->query($query) or die($connection->error.__LINE__);
  if($result ->num_rows >0){
    $row = $result->fetch_assoc();

    $update ="UPDATE employees SET employees_password='$employees_password' WHERE employees_email='$row[employees_email]'";
    if($connection->query($update) === false) { 
        die($connection->error.__LINE__); 
        echo'Penyetelan password baru gagal, silahkan nanti coba kembali!';
    } else{
        echo'success';
        mail($to, $subject, $pesan, $headers);
    }}
    else   {
       echo'Untuk Email "'.$email.'" belum terdaftar, silahkan cek kembali!';
    }}

    else {
     echo'Email yang Anda masukkan salah!';
    }}

    else{           
        echo'Bidang inputan masih ada yang kosong..!';
    }
break;

// ------------- Absen -------------*/
case 'present':
$latitude = $_GET['latitude'];
$files = $_FILES["webcam"]["name"];
$lokasi_file = $_FILES['webcam']['tmp_name'];  
$ukuran_file = $_FILES['webcam']['size'];
$extension = getExtension($files);
$extension = strtolower($extension);
if($extension=="jpg" || $extension=="jpeg" ){$src = imagecreatefromjpeg($lokasi_file);}
else if($extension=="png"){$src = imagecreatefrompng($lokasi_file);}
else {$src = imagecreatefromgif($lokasi_file);}
list($width,$height)=getimagesize($lokasi_file);

$width_new  = 400;
$height_new = 300;
$ratio_ori  = $width / $height_new;
$tmp=imagecreatetruecolor($width_new,$height_new);
imagecopyresampled($tmp,$src,0,0,0,0,$width_new,$height_new,$width,$height);

if (empty($_GET['latitude'])) {
      $error[] = 'tidak boleh kosong';
    } else {
      $latitude= mysqli_real_escape_string($connection, $_GET['latitude']);
  }
  // Cek User yang sudah login -----------------------------------------------
  $query_u="SELECT employees.id,employees.employees_code,employees.employees_name,employees.shift_id,shift.shift_id,shift.time_in,shift.time_out FROM employees,shift WHERE employees.shift_id=shift.shift_id AND employees.id='$row_user[id]'";
  $result_u = $connection->query($query_u);
  if($result_u->num_rows > 0){
      $row_u = $result_u->fetch_assoc();

      // Cek data Absen Berdasarkan tanggal sekarang
      $query  ="SELECT employees_id,time_in FROM presence WHERE employees_id='$row_u[id]' AND presence_date='$date'";
      $result = $connection->query($query);
      $row = $result->fetch_assoc();
      if($result->num_rows > 0){
        // Update Absensi Pulang
        $query  ="SELECT time_out,employees_id FROM presence WHERE employees_id='$row_u[id]' AND presence_date='$date'";
        $result = $connection->query($query);
        $row = $result->fetch_assoc();
          if($result->num_rows > 0){
            if($row['time_out']=='00:00:00'){
            //Update Jam Pulang
            	$filename =''.seo_title($row_user['employees_name']).'-out-'.$date.'-'.$row_user['id'].'.jpg';
      			$directory= "../content/present/".$filename;

              $update ="UPDATE presence SET time_out='$time',picture_out='$filename' WHERE employees_id='$row_u[id]' AND presence_date='$date'";
              if($connection->query($update) === false) { 
                  die($connection->error.__LINE__); 
                  echo'Sepetinya sitem kami sedang error!';
              } else{
                  //Jam Pulang
                  echo'success/Selamat "'.$row_user['employees_name'].'" berhasil Absen Pulang pada Tanggal '.tanggal_ind($date).' dan Jam : '.$time.', Hati-hati dijalan saat pulang "'.$row_a['employees_name'].'"!';
                  imagejpeg($tmp,$directory,80);
              }
            }
          else{
            echo'Sebelumnya "'.$row_user['employees_name'].'" sudah pernah Absen Pulang pada Tanggal '.tanggal_ind($date).' dan Jam '.$row['time_out'].'.!';
          }
        }
      }else{
        // Add Absen Masuk ---------------------------------------
        	$filename =''.seo_title($row_user['employees_name']).'-in-'.$date.'-'.$row_user['id'].'.jpg';
      		$directory= "../content/present/".$filename;
          $add ="INSERT INTO presence (employees_id,
                            presence_date,
                            time_in,
                            time_out,
                            picture_in,
                            picture_out,
                            present_id,
                            presence_address,
                            information) values('$row_u[id]',
                            '$date',
                            '$time',
                            '00:00:00',
                            '$filename',
                            '', /*picture out kosong*/
                            '1', /*hadir*/
                            '$latitude',
                            '')";
                  
          if($connection->query($add) === false) { 
              die($connection->error.__LINE__); 
              echo'Sepertinya Sistem Kami sedang error!';
          } else{
              echo'success/Selamat Anda berhasil Absen Masuk pada Tanggal '.tanggal_ind($date).' dan Jam : '.$time.', Semangat bekerja "'.$row_u['employees_name'].'" !';
              imagejpeg($tmp,$directory,80);
        }
      } 

  }
  else{
    // Jika user tidak ditemukan
    echo'User tidak ditemukan';die($connection->error.__LINE__); 
  }
 
break;
// ----------- UPDATE PROFILE -------------------//
case 'profile':
  $error = array();

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


  if (empty($error)) { 
    $update="UPDATE employees SET employees_name='$employees_name',
            position_id='$position_id',
            shift_id='$shift_id',
            building_id='$building_id' WHERE id='$row_user[id]'"; 
    if($connection->query($update) === false) { 
        die($connection->error.__LINE__); 
        echo'Data tidak berhasil disimpan!';
    } else{
        echo'success';
    }}
    else{           
        echo'Bidang inputan tidak boleh ada yang kosong..!';
  }
break;


// ----------- UPDATE PASSWORD -------------------//
case 'update-password':
 $error = array();
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
    $to     = $email_siswa;
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

/* -------- UPDATE PHOTO ----------------*/
case 'update-photo':
  $file_name   = $_FILES['file'] ['name'];
  $size        = $_FILES['file'] ['size'];
  $error       = $_FILES['file'] ['error'];
  $tmpName     = $_FILES['file']['tmp_name'];
  $filepath      = '../content/karyawan/';
  $valid       = array('jpg','png','gif','jpeg'); 
  if(strlen($file_name)){   
       // Perintah untuk mengecek format gambar
       list($txt,$ext) = explode(".", $file_name);
       $file_ext = substr($file_name, strripos($file_name, '.'));

       if(in_array($ext,$valid)){   
         if($size<500000){   
           // Perintah pengganti nama files
           //$photo_new   = strip_tags(md5($file_name));
           $photo_new   =''.$row_user['employees_code'].'-'.strip_tags(md5($file_name)).'-'.seo_title($time).'-'.$file_ext.'';
           $pathFile    = $filepath.$photo_new;

            $query = "SELECT photo FROM employees WHERE id='$row_user[id]'"; 
                $result = $connection->query($query);
                $rows= $result->fetch_assoc();
                $photo = $rows['photo'];
                if(file_exists("../content/$photo")){
                  unlink( "../content/karyawan/$photo");
                 }
           $update ="UPDATE employees SET photo='$photo_new' WHERE id=$row_user[id]";
            if($connection->query($update) === false) { 
               echo'Pengaturan tidak dapat disimpan, coba ulangi beberapa saat lagi.!';
               die($connection->error.__LINE__); 
            } else   {
              echo'success';
               move_uploaded_file($tmpName, $pathFile);
            }
          }
         else{ // Jika Gambar melebihi size 
              echo'File terlalu besar maksimal files 5MB.!';  
           }         
       }
       else{
          echo 'File yang di unggah tidak sesuai dengan format, File harus jpg, jpeg, gif, png.!';
        }
     }   
break;


/* -------  LOAD DATA HISTORY ----------*/
case 'history':
if(isset($_POST['from']) OR isset($_POST['to'])){
      $from = date('Y-m-d', strtotime($_POST['from']));
      $to   = date('Y-m-d', strtotime($_POST['to']));

      $filter ="presence_date BETWEEN '$from' AND '$to'";
  } 
  else{
      $filter ="MONTH(presence_date) ='$month'";
}

echo'<table class="table rounded" id="swdatatable">
    <thead>
        <tr>
            <th scope="col" class="align-middle text-center" width="10">No</th>
            <th scope="col" class="align-middle">Tanggal</th>
            <th scope="col" class="align-middle">Jam Masuk</th>
            <th scope="col" class="align-middle">Jam Pulang</th>
            <th scope="col" class="align-middle hidden-sm">Status</th>
            <th scope="col" class="align-middle">Aksi</th>
        </tr>
    </thead>
    <tbody>';
    $no=0;
    $query_shift ="SELECT time_in,time_out FROM shift WHERE shift_id='$row_user[shift_id]'";
    $result_shift = $connection->query($query_shift);
    $row_shift = $result_shift->fetch_assoc();
    $shift_time_in = $row_shift['time_in'];
    $newtimestamp = strtotime(''.$shift_time_in.' + 05 minute');
    $newtimestamp = date('H:i:s', $newtimestamp);

    $query_absen ="SELECT presence_id,presence_date,picture_in,time_in,picture_out,time_out,present_id,presence_address,information,TIMEDIFF(TIME(time_in),'$shift_time_in') AS selisih,if (time_in>'$shift_time_in','Terlambat',if(time_in='00:00:00','Tidak Masuk','Tepat Waktu')) AS status FROM presence WHERE employees_id='$row_user[id]' AND $filter ORDER BY presence_id DESC";
    $result_absen = $connection->query($query_absen);
    if($result_absen->num_rows > 0){
        while ($row_absen = $result_absen->fetch_assoc()) {

          $query_status ="SELECT present_name FROM  present_status WHERE present_id='$row_absen[present_id]'";
          $result_status = $connection->query($query_status);
          $row_aa= $result_status->fetch_assoc();
            $no++;
            if($row_absen['information']==''){
              $information = '';
            }else{
              $information = '<br>'.$row_absen['information'].'';
            }

      if($row_absen['status']=='Terlambat'){
          $status=' <small class="badge badge-danger">Telat</small>';
        }
        elseif ($row_absen['status']='Tepat Waktu') {
          $status=' <small class="badge badge-success">'.$row_absen['status'].'</small>';
        }
        else{
          $status=' <small class="badge badge-danger">Tidak Masuk</small>';
        }
        echo'
        <tr>
            <th class="text-center">'.$no.'</th>
            <th scope="row">'.tgl_ind($row_absen['presence_date']).'</th>
            <td><a class="image-link" href="./content/present/'.$row_absen['picture_in'].'">
            <span class="badge badge-success">'.$row_absen['time_in'].'</span></a></td>
            <td><a class="image-link" href="./content/present/'.$row_absen['picture_out'].'">
            <span class="badge badge-danger">'.$row_absen['time_out'].'</span></a></td>
            <td class="hidden-sm">'.$row_aa['present_name'].''.$status.''.$information.'</td>
            <td class="text-center">
              <button type="button" class="btn btn-success btn-sm modal-update" data-id="'.$row_absen['presence_id'].'" data-masuk="'.$row_absen['time_in'].'" data-pulang="'.$row_absen['time_out'].'" data-date="'.tgl_indo($row_absen['presence_date']).'" data-information="'.$row_absen['information'].'" data-status="'.$row_absen['present_id'].'" data-toggle="modal" data-target="#modal-show"><i class="fas fa-pencil-alt"></i></button>
            </td>
        </tr>';
    }}
    echo'
    </tbody>
</table>
<hr>';
      $query_hadir="SELECT presence_id FROM presence WHERE employees_id='$row_user[id]' AND $filter AND present_id='1' ORDER BY presence_id DESC";
      $hadir= $connection->query($query_hadir);

      $query_sakit="SELECT presence_id FROM presence WHERE employees_id='$row_user[id]' AND $filter AND present_id='2' ORDER BY presence_id";
      $sakit = $connection->query($query_sakit);

      $query_izin="SELECT presence_id FROM presence WHERE employees_id='$row_user[id]' AND $filter AND present_id='3' ORDER BY presence_id";
      $izin = $connection->query($query_izin);

      $query_telat ="SELECT presence_id FROM presence WHERE employees_id='$row_user[id]' AND $filter AND time_in>'$shift_time_in'";
      $telat = $connection->query($query_telat);
echo'
<div class="container">
<div class="row">
  <div class="col-md-3">
    <p>Hadir : <span class="badge badge-success">'.$hadir->num_rows.'</span></p>
  </div>

  <div class="col-md-3">
    <p>Telat : <span class="label badge badge-danger">'.$telat->num_rows.'</span></p>
  </div>
  

  <div class="col-md-3">
    <p>Sakit : <span class="badge badge-warning">'.$sakit->num_rows.'</span></p>
  </div>

  <div class="col-md-3">
    <p>Izin : <span class="badge badge-info">'.$izin->num_rows.'</span></p>
  </div>
</div>
</div>';?>

<script>
  $('#swdatatable').dataTable({
    "iDisplayLength":35,
    "aLengthMenu": [[35, 40, 50, -1], [35, 40, 50, "All"]]
  });
  $('.image-link').magnificPopup({type:'image'});
</script>
<?php
  break;


// ----------- UPDATE HISTORY -------------------//
case 'update-history':
  $error = array();
  if (empty($_POST['presence_id'])) {
      $error[] = 'tidak boleh kosong';
    } else {
      $presence_id = mysqli_real_escape_string($connection, $_POST['presence_id']);
  }

 /* if (empty($_POST['time_in'])) {
      $error[] = 'tidak boleh kosong';
    } else {
      $time_in= mysqli_real_escape_string($connection, $_POST['time_in']);
  }

  if (empty($_POST['time_out'])) {
      $error[] = 'tidak boleh kosong';
    } else {
      $time_out= mysqli_real_escape_string($connection, $_POST['time_out']);
  }*/


  if (empty($_POST['present_id'])) {
      $error[] = 'tidak boleh kosong';
    } else {
      $present_id= mysqli_real_escape_string($connection, $_POST['present_id']);
  }

  $information = mysqli_real_escape_string($connection, $_POST['information']);
 
  if (empty($error)) { 
    $update="UPDATE presence SET present_id='$present_id',
                    information='$information' WHERE presence_id='$presence_id' AND employees_id='$row_user[id]'"; 
    if($connection->query($update) === false) { 
        die($connection->error.__LINE__); 
        echo'Data tidak berhasil disimpan!';
    } else{
        echo'success';
    }}
    else{           
        echo'Bidang inputan tidak boleh ada yang kosong..!';
  }
break;

}?>