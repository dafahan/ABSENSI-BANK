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
  <link href="'.$site_url.''.$canonical.'" rel="canonical"/>

  <!--Title-->
  <title>Administrator '.$site_name.'</title>
  <meta name="description" content="Halaman Administrator '.$site_name.', '.$site_description.'"/>
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
  <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="./assets/css/AdminLTE.min.css">
  <link rel="stylesheet" href="./assets/css/skin-blue-light.css">
  <link rel="stylesheet" href="./assets/css/font-awesome.css">
  <link rel="stylesheet" href="./assets/css/sw-custom.css">
  <link rel="stylesheet" href="./assets/plugins/datepicker/datepicker3.css">
  <link rel="stylesheet" href="./assets/plugins/timepicker/bootstrap-timepicker.min.css">
  <link rel="stylesheet" type="text/css" href="./assets/css/simple-lightbox.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">';
  if($mod =='pendaftar'){
    echo'
    <link rel="stylesheet" href="./assets/plugins/select2/dist/css/select2.min.css">';}
  if($mod =='setting-pendaftaran'){
    echo'
    <link rel="stylesheet" href="./assets/plugins/datepicker/datepicker3.css">';
  }
  if($mod=='absensi'){
  echo'
    <link rel="stylesheet" href="../mod/assets/js/plugins/magnific-popup/magnific-popup.css">';
  }
  echo'
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <!-- </head> -->
</head>
<body class="sidebar-mini skin-blue-light fixed">';
echo'<div class="wrapper">
    <div class="loading"></div>
<header class="main-header">
    <!-- Logo -->
    <a href="./" class="logo">
      <span class="logo-mini">
        <b style="color:#FFFFFF">AO</b>
      </span>
      <span class="logo-lg">
        <img src="'.$site_url.'/content/'.$site_logo.'"  oncontextmenu="return false;" height="50">
      </span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      
      <div class="navbar-custom-menu pull-left">
        <ul class="nav navbar-nav">
            <li><a href="#">'.tanggal_ind($date).'</a></li>
        </ul>
      </div>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">';

        $query="SELECT presence.employees_id,presence.time_in,presence.time_out,employees.employees_name FROM presence,employees WHERE presence.employees_id=employees.id AND presence.presence_date='$date' ORDER BY presence.presence_id DESC LIMIT 10";
        $result_notif = $connection->query($query);
        
        echo'
        <li><a href="../" target="_blank"><i class="fa fa-desktop" aria-hidden="true"></i></a></li>

        <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">'.$result_notif->num_rows.'</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">Anda memiliki '.$result_notif->num_rows.' notifikasi</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">';
                while ($row= $result_notif->fetch_assoc()) {
                  echo'
                  <li>
                    <a href="absensi&op=views&id='.epm_encode($row['employees_id']).'">
                      '.$row['employees_name'].'<br>
                      <i class="fa fa-sign-in text-aqua"></i>Absen Masuk : '.$row['time_in'].'<br>';
                  if($row['time_out']=='00:00:00'){}else{
                      echo'
                      <i class="fa fa-sign-out text-aqua"></i>Absen Pulang : '.$row['time_out'].'';}
                    echo'
                    </a>
                  </li>';
                }
                echo'
                </ul>
              </li>
            </ul>
          </li>

        <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">'.strip_tags(substr($row_user['fullname'],0,10)).' <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">';?>
                <li><a href="javascript:void();" onClick="location.href='./logout';"><i class="fa fa-sign-out"></i> Logout</a></li>
              </ul>
            </li>
          
        </ul>
      </div>
    </nav>
  </header>
<?PHP }?>