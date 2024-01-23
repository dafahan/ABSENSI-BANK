<?php //error_reporting(0);
  ob_start();
  session_start();
  include_once 'library/sw-config.php';
  include_once 'library/sw-function.php';
  //ob_start("minify_html");
  $dbhostsql      = DB_HOST;
  $dbusersql      = DB_USER;
  $dbpasswordsql  = DB_PASSWD;
  $dbnamesql      = DB_NAME;
  $connection     = mysqli_connect($dbhostsql, $dbusersql, $dbpasswordsql, $dbnamesql) or die( mysqli_error($connection));

   if(!isset($_COOKIE['COOKIES_MEMBER']) && !isset($_COOKIE['COOKIES_COOKIES'])){
     //header('location:./login/');

    }
  else{
    $COOKIES_COOKIES='';
    $COOKIES_MEMBER ='';
    if(!empty($_COOKIE['COOKIES_COOKIES'])) {
      $COOKIES_COOKIES   =  $_COOKIE['COOKIES_COOKIES'];
    }
    if(!empty($_COOKIE['COOKIES_MEMBER'])) {
      $COOKIES_MEMBER     =  epm_decode($_COOKIE['COOKIES_MEMBER']);
    }
    require_once'mod/out/sw-cookies.php';
  }

  $website_url        = $row_site['site_url'];
  $website_name       = $row_site['site_name'];
  $website_phone      = $row_site['site_phone'];
  $website_addres     = $row_site['site_address'];
  $meta_description   = $row_site['site_description'];
  $meta_keyword       = $row_site['site_description'];
  $website_logo       = $row_site['site_logo'];
  $website_email      = $row_site['site_email'];

  if(!empty($_GET['alert'])){$alert = mysqli_escape_string($connection, @$_GET['alert']);}
  $messages ='';if(!empty($_SESSION['messages'])){$messages = $_SESSION['messages'];}
  
$mod = "home";
if(!empty($_GET['mod'])){$mod = mysqli_escape_string($connection,@$_GET['mod']);}
else {$mod ='home';}
if(file_exists("mod/$mod.php")){
    require_once("mod/$mod.php");
}else{
    require_once("mod/home.php");
  }
ob_end_flush();
?>