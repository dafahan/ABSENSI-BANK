<?php
  $fullurl = ($_SERVER['PHP_SELF']);
  $trimmed = trim($fullurl, ".php");
  $canonical = rtrim($trimmed, '/' . '/?');
?>

  <!--Viewport -->
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <meta content="text/html; charset=UTF-8" http-equiv="Content-Type"/>
  <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible"/>

  <!--Canonical-->
  <meta content="all" name="robots"/>
  <link href="<?php echo $site_url; ?>" rel="home"/>
  <link href="<?php echo $site_url; ?><?php echo $fullurl; ?>" rel="canonical"/>

  <!--Title-->
  <title><?php echo $site_name; ?></title>
  <meta name="description" content="<?php echo $site_description; ?>"/>
  
  <!--OG-->
  <meta content="website" property="og:type"/>
  <meta content="<?php echo $site_name; ?>" property="og:title"/>
  <meta content="<?php echo $site_description; ?>" property="og:description"/>
  <meta content="<?php echo $site_url; ?><?php echo $fullurl; ?>" property="og:url"/>
  <meta content="<?php echo $site_name; ?>" property="og:site_name"/>
  <meta content="<?php echo $site_name; ?>" property="og:headline"/>
  <meta content="<?php echo $site_url; ?>/content/logo/baja.jpg" property="og:image"/>
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
  <meta content="<?php echo $site_name; ?>" property="article:author"/>
  <meta content="summary_large_image" name="twitter:card"/>
  <meta content="@mycodingxd" name="twitter:site"/>
  <meta content="@mycodingxd" name="twitter:creator"/>
  <meta content="<?php echo $site_url; ?><?php echo $fullurl; ?>" property="twitter:url"/>
  <meta content="<?php echo $site_name; ?>" property="twitter:title"/>
  <meta content="<?php echo $site_description; ?>" property="twitter:description"/>
  <meta content="<?php echo $site_url; ?>/content/logo/baja.png" property="twitter:image"/>

  <!--Webapp-->
  <link href="<?php echo $site_url; ?>/manifest.json" rel="manifest"/>
  <meta content="<?php echo $site_url; ?>" name="msapplication-starturl"/>
  <meta content="<?php echo $site_url; ?>" name="start_url"/>
  <meta content="<?php echo $site_name; ?>" name="application-name"/>
  <meta content="<?php echo $site_name; ?>" name="apple-mobile-web-app-title"/>
  <meta content="<?php echo $site_name; ?>" name="msapplication-tooltip"/>
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
  <link href="<?php echo $site_url; ?>/favicon.png" rel="apple-touch-icon"/>
  <link href="<?php echo $site_url; ?>/favicon.png" rel="shortcut icon" type="image/x-icon"/>
  <link href="<?php echo $site_url; ?>/content/logo/baja.png" rel="icon" sizes="32x32"/>
  <meta content="<?php echo $site_url; ?>/content/logo/baja.png" name="msapplication-TileImage"/>
  <link href="<?php echo $site_url; ?>/content/logo/baja.png" rel="apple-touch-icon"/>
  <link href="<?php echo $site_url; ?>/content/logo/baja.png" rel="icon" sizes="48x48"/>
  <link href="<?php echo $site_url; ?>/content/logo/baja.png" rel="icon" sizes="72x72"/>
  <link href="<?php echo $site_url; ?>/content/logo/baja.png" rel="icon" sizes="96x96"/>
  <link href="<?php echo $site_url; ?>/content/logo/baja.png" rel="icon" sizes="168x168"/>
  <link href="<?php echo $site_url; ?>/content/logo/baja.png" rel="icon" sizes="192x192"/>
  <link href="<?php echo $site_url; ?>/content/logo/baja.png" rel="icon" sizes="512x512"/>

  <!--Author-->
  <meta content="<?php echo $site_name; ?>" name="author" />
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