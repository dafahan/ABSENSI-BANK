<?php
session_start();
if(empty($_SESSION['SESSION_USER']) && empty($_SESSION['SESSION_ID'])){
    header('location:../../login/');
 exit;}
else {
require_once'../library/sw-config.php';
include('../library/sw-function.php');
$max_size = 2000000; //2MB
$salt = '$%DEf0&TTd#%dSuTyr47542"_-^@#&*!=QxR094{a911}+';

switch (@$_GET['action']){

case 'add':
  $error = array();

  if (empty($_FILES['laporan'])) { 
          $error[] = 'tidak boleh kosong';
      } else {
        $laporan = $_FILES["laporan"]["name"];
        $lokasi_file = $_FILES['laporan']['tmp_name'];  
        $ukuran_file = $_FILES['laporan']['size'];

        $extension = getExtension($laporan);
        $extension = strtolower($extension);
        $laporan = strip_tags(md5($laporan));
        $laporan ="".$date."".$laporan.".".$extension."";

        if (empty($error)) {
          if ($ukuran_file <= $max_size) {
          $directory='../content/laporan/'.$laporan.'';
          $add ="INSERT INTO employees (laporan) values('$laporan')";
          if($connection->query($add) === false) { 
              die($connection->error.__LINE__); 
              echo'Data tidak berhasil disimpan!';
          } else{
              echo'success';
          }}
          else{
              echo'File yang di unggah terlalu besar Maksimal Size 2MB..!';
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
 
   $laporan = $_FILES["laporan"]["name"];
   $lokasi_file = $_FILES['laporan']['tmp_name'];  
   $ukuran_file = $_FILES['laporan']['size'];
   if($laporan ==''){
   if (empty($error)) { 
     $update="UPDATE employees SET laporan='$laporan' WHERE id='$id'"; 
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
     $query= mysqli_query($connection,"SELECT laporan from employees where id='$id'");
     $data   = mysqli_fetch_assoc($query);
     $file_delete = strip_tags($data['laporan']);
     $tmpfile = "../content/laporan/".$file_delete;
    if(file_exists("../content/laporan/$file_delete")){
       unlink ($tmpfile);
     }
 
     $extension = getExtension($laporan);
     $extension = strtolower($extension);
     $laporan = strip_tags(md5($laporan));
     $laporan ="".$date."".$laporan.".".$extension."";
   if (empty($error)) {
     if ($ukuran_file <= $max_size) {
     $directory='../content/laporan/'.$laporan.'';
 
     $update="UPDATE employees SET laporan='$laporan' WHERE id='$id'"; 
     if($connection->query($update) === false) { 
         die($connection->error.__LINE__); 
         echo'Data tidak berhasil disimpan!';
     } else{
         echo'success';
         imagejpeg($tmp,$directory,90);
     }}
     else{
         echo'File yang di unggah terlalu besar Maksimal Size 200MB..!';
     }}
   }
 
 break;


}

}
