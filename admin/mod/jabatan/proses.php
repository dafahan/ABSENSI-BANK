<?php
session_start();
if(empty($_SESSION['SESSION_USER']) && empty($_SESSION['SESSION_ID'])){
    header('location:../../login/');
 exit;}
else {
require_once'../../../library/sw-config.php';
require_once'../../login/login_session.php';
include('../../../library/sw-function.php');

switch (@$_GET['action']){
case 'add':
  $error = array();
  if (empty($_POST['position_name'])) {
      $error[] = 'tidak boleh kosong';
    } else {
      $position_name= mysqli_real_escape_string($connection, $_POST['position_name']);
  }

  if (empty($error)) { 
    $add ="INSERT INTO position (position_name) values('$position_name')"; 
    if($connection->query($add) === false) { 
        die($connection->error.__LINE__); 
        echo'Data tidak berhasil disimpan!';
    } else{
        echo'success';
    }}
    else{           
        echo'Bidang inputan tidak boleh ada yang kosong..!';
    }
break;

/* ---------------------
    Update
---------------------------------*/
case 'update':
 $error = array();
   if (empty($_POST['id'])) {
      $error[] = 'ID tidak boleh kosong';
    } else {
      $id = mysqli_real_escape_string($connection, $_POST['id']);
  }

  if (empty($_POST['position_name'])) {
      $error[] = 'tidak boleh kosong';
    } else {
      $position_name= mysqli_real_escape_string($connection, $_POST['position_name']);
  }

  if (empty($error)) { 
    $update="UPDATE position SET position_name='$position_name' WHERE position_id='$id'"; 
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
/* --------------- Delete ------------*/
case 'delete':
  $id       = mysqli_real_escape_string($connection,epm_decode($_POST['id']));
  $deleted  = "DELETE FROM position WHERE position_id='$id'";
    if($connection->query($deleted) === true) {
        echo'success';
      } else { 
        //tidak berhasil
        echo'Data tidak berhasil dihapus.!';
        die($connection->error.__LINE__);
  }
break;

}

}
