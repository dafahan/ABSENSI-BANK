<?php

$fullurl = ($_SERVER['PHP_SELF']);
$trimmed = trim($fullurl, ".php");
$canonical = rtrim($trimmed, '/' . '/?');

if(empty($connection)){
  header('location:./404');
} else {
echo'
<!DOCTYPE html>
<html lang="id-ID" xml:lang="id-ID">
<head>

  <!--Viewport -->
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <meta content="text/html; charset=UTF-8" http-equiv="Content-Type"/>
  <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible"/>

  <!--Canonical-->
  <meta content="all" name="robots"/>
  <link href="'.$site_url.'" rel="home"/>
  <link href="'.$site_url.''.$fullurl.'" rel="canonical"/>

  <!--Title-->
  <title>'.$site_name.'</title>
  <meta name="description" content="Halaman Pengguna '.$site_name.', '.$site_description.'"/>
  <meta name="keywords" content="absensi online, aplikasi absensi, aplikasi absensi online, sistem absensi online, absensi online pemerintah, absensi online perusahaan"/>

  <!--OG-->
  <meta content="website" property="og:type"/>
  <meta content="'.$site_name.'" property="og:title"/>
  <meta content="'.$site_description.'" property="og:description"/>
  <meta content="'.$site_url.''.$canonical.'" property="og:url"/>
  <meta content="'.$site_name.'" property="og:site_name"/>
  <meta content="'.$site_name.'" property="og:headline"/>
  <meta content="'.$site_url.'/content/logo/baja.png" property="og:image"/>
  <meta content="1920" property="og:image:width"/>
  <meta content="1080" property="og:image:height"/>
  <meta content="id_ID" property="og:locale"/>
  <meta content="en_US" property="og:locale:alternate"/>
  <meta content="true" property="og:rich_attachment"/>
  <meta content="true" property="pinterest-rich-pin"/>
  <meta content="" property="fb:app_id"/>
  <meta content="" property="fb:pages"/>
  <meta content="" property="fb:admins"/>
  <meta content="" property="fb:profile_id"/>
  <meta content="'.$site_name.'" property="article:author"/>
  <meta content="summary_large_image" name="twitter:card"/>
  <meta content="@mycodingxd" name="twitter:site"/>
  <meta content="@mycodingxd" name="twitter:creator"/>
  <meta content="'.$site_url.''.$canonical.'" property="twitter:url"/>
  <meta content="'.$site_name.'" property="twitter:title"/>
  <meta content="'.$site_description.'" property="twitter:description"/>
  <meta content="'.$site_url.'/content/logo/baja.png" property="twitter:image"/>

  <!--Webapp-->
  <link href="'.$site_url.'/manifest.json" rel="manifest"/>
  <meta content="'.$site_url.'" name="msapplication-starturl"/>
  <meta content="'.$site_url.'" name="start_url"/>
  <meta content="'.$site_name.'" name="application-name"/>
  <meta content="'.$site_name.'" name="apple-mobile-web-app-title"/>
  <meta content="'.$site_name.'" name="msapplication-tooltip"/>
  <meta content="#00B4FF" name="theme_color"/>
  <meta content="#00B4FF" name="theme-color"/>
  <meta content="#FFFFFF" name="background_color"/>
  <meta content="#00B4FF" name="msapplication-navbutton-color"/>
  <meta content="#00B4FF" name="msapplication-TileColor"/>
  <meta content="#00B4FF" name="apple-mobile-web-app-status-bar-style"/>
  <meta content="true" name="mssmarttagspreventparsing"/>
  <meta content="yes" name="apple-mobile-web-app-capable"/>
  <meta content="yes" name="mobile-web-app-capable"/>
  <meta content="yes" name="apple-touch-fullscreen"/>
  <link href="'.$site_url.'/favicon.png" rel="apple-touch-icon"/>
  <link href="'.$site_url.'/favicon.png" rel="shortcut icon" type="image/x-icon"/>
  <link href="'.$site_url.'/content/logo/baja.png" rel="icon" sizes="32x32"/>
  <meta content="'.$site_url.'/content/logo/baja.png" name="msapplication-TileImage"/>
  <link href="'.$site_url.'/content/logo/baja.png" rel="apple-touch-icon"/>
  <link href="'.$site_url.'/content/logo/baja.png" rel="icon" sizes="48x48"/>
  <link href="'.$site_url.'/content/logo/baja.png" rel="icon" sizes="72x72"/>
  <link href="'.$site_url.'/content/logo/baja.png" rel="icon" sizes="96x96"/>
  <link href="'.$site_url.'/content/logo/baja.png" rel="icon" sizes="168x168"/>
  <link href="'.$site_url.'/content/logo/baja.png" rel="icon" sizes="192x192"/>
  <link href="'.$site_url.'/content/logo/baja.png" rel="icon" sizes="512x512"/>

  <!--Author-->
  <meta content="'.$site_name.'" name="author" />
  <meta content="401XD Group" name="publisher"/>

  <!--verification-->
  <meta name="yandex-verification" content=""/>
  <meta name="p:domain_verify" content=""/>
  <meta name="msvalidate.01" content=""/>
  <meta name="google-site-verification" content="" />
  <meta name="dmca-site-verification" content=""/>
  <meta name="facebook-domain-verification" content=""/>

  <!--Location-->
  <meta content="ID" name="geo.region"/>
  <meta content="Indonesia" name="geo.country"/>
  <meta content="Indonesia" name="geo.placename"/>
  <meta content="x;x" name="geo.position"/>
  <meta content="x,x" name="ICBM"/>

  <!--resource-->
  <link href="//fonts.googleapis.com" rel="preconnect dns-prefetch"/>
  <link href="//api.github.com" rel="preconnect dns-prefetch"/>
  <link href="//api.mapbox.com" rel="preconnect dns-prefetch"/>
  <link href="//cdnjs.cloudflare.com" rel="preconnect dns-prefetch"/>
  <link href="//unpkg.com" rel="preconnect dns-prefetch"/>
  <link href="//kit.fontawesome.com" rel="preconnect dns-prefetch"/>

  <!--CSS-->
  <link rel="stylesheet" href="'.$site_url.'/mod/assets/css/style.css">
  <link rel="stylesheet" href="'.$site_url.'/mod/assets/css/sw-custom.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">';
  if($mod =='history'){
    echo'
    <link rel="stylesheet" href="'.$site_url.'/mod/assets/js/plugins/datepicker/datepicker3.css">
    <link rel="stylesheet" href="'.$site_url.'/mod/assets/js/plugins/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="'.$site_url.'/mod/assets/js/plugins/magnific-popup/magnific-popup.css">';
  }

echo'
</head>

<body>
<div class="loading"><div class="spinner-border text-primary" role="status"></div></div>
  <!-- loader -->
    <div id="loader">
        <img src="'.$site_url.'/mod/assets/img/bankbaja.gif" alt="icon" class="loading-icon">
    </div>
    <!-- * loader -->';
if(isset($_COOKIE['COOKIES_MEMBER'])){
  echo'
<!-- App Header -->
    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="#" class="headerButton" data-toggle="modal" data-target="#sidebarPanel">
                <ion-icon name="menu-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">
            <img src="'.$site_url.'/content/'.$site_logo.'" alt="logo" class="logo">
        </div>
        <div class="right">
            <div class="headerButton" data-toggle="dropdown" id="dropdownMenuLink" aria-haspopup="true">';
              if($row_user['photo'] ==''){
                echo'<img src="'.$site_url.'/content/avatar.jpg" alt="image" class="imaged w40">';
              }else{
                echo'
                <img src="'.$site_url.'/content/karyawan/'.$row_user['photo'].'" alt="image" class="imaged w40">';}
              echo'
               <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">';?>
                <a class="dropdown-item" onclick="location.href='profile';" href="profile"><ion-icon size="small" name="person-outline"></ion-icon>Profil</a>
                <a class="dropdown-item" onclick="location.href='logout';" href="logout"><ion-icon size="small" name="log-out-outline"></ion-icon>Keluar</a>
              </div>
            </div>
        </div>
    </div>
<?php
echo'<!-- App Sidebar -->
    <div class="modal fade panelbox panelbox-left" id="sidebarPanel" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <!-- profile box -->
                    <div class="profileBox pt-2 pb-2">
                        <div class="image-wrapper">';
                        if($row_user['photo'] ==''){
                        echo'<img src="'.$site_url.'/content/avatar.jpg" alt="image" class="imaged w36">';
                        }else{
                        echo'<img src="'.$site_url.'/content/karyawan/'.$row_user['photo'].'" class="imaged w36">';
                        }
                          echo'
                        </div>
                        <div class="in">
                            <strong>'.ucfirst($row_user['employees_name']).'</strong>
                            <div class="text-muted">'.$row_user['employees_code'].'</div>
                        </div>
                        <a href="#" class="btn btn-link btn-icon sidebar-close" data-dismiss="modal">
                            <ion-icon name="close-outline"></ion-icon>
                        </a>
                    </div>
                    <!-- * profile box -->
              
                    <!-- menu -->
                    <div class="listview-title mt-1">MENU UTAMA</div>
                    <ul class="listview flush transparent no-line image-listview">
                        <li>
                            <a href="./" class="item">
                                <div class="icon-box bg-primary">
                                    <ion-icon name="home-outline"></ion-icon>
                                </div> Home 
                            </a>
                        </li>
                        <li>
                            <a href="./profile" class="item">
                                <div class="icon-box bg-primary">
                                    <ion-icon name="person-outline"></ion-icon>
                                </div> Profil
                            </a>
                        </li>
                        <li>
                            <a href="./present" class="item">
                                <div class="icon-box bg-primary">
                                    <ion-icon name="scan-outline"></ion-icon>
                                </div> Absen
                            </a>
                        </li>
                        <li>
                            <a href="./laporan" class="item">
                                <div class="icon-box bg-primary">
                                  <ion-icon name="document-attach-outline"></ion-icon>
                                </div> Laporan
                            </a>
                        </li>
                        <li>
                            <a href="./history" class="item">
                                <div class="icon-box bg-primary">
                                    <ion-icon name="document-text-outline"></ion-icon>
                                </div> Riwayat
                            </a>
                        </li>
                        <li>
                            <a href="./logout" class="item">
                                <div class="icon-box bg-primary">
                                    <ion-icon name="log-out-outline"></ion-icon>
                                </div> Keluar
                            </a>
                        </li>
                    </ul>
                    <!-- * menu -->
                </div>
            </div>
        </div>
    </div>
    <!-- * App Sidebar -->';
  }
 }?>