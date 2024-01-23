<?php

	$fullurl = ($_SERVER['PHP_SELF']);
	$trimmed = trim($fullurl, ".php");
	$canonical = rtrim($trimmed, '/' . '/?');

	if(isset($_COOKIE['COOKIES_MEMBER']) && isset($_COOKIE['COOKIES_COOKIES'])){
	    header("location:./");
	} else {

	?>

	<!DOCTYPE html>
	<html lang="id-ID" xml:lang="id-ID">

	    <head>

	    	<!--Viewport -->
	    	<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
	    	<meta content="text/html; charset=UTF-8" http-equiv="Content-Type"/>
	    	<meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible"/>

	    	<!--Canonical-->
	    	<meta content="all" name="robots"/>
	    	<link href="<?php echo $site_url; ?>" rel="home"/>
	    	<link href="<?php echo $site_url; ?><?php echo $fullurl; ?>" rel="canonical"/>

	    	<!--resource-->
	    	<link href="//fonts.googleapis.com" rel="preconnect dns-prefetch"/>
	    	<link href="//api.github.com" rel="preconnect dns-prefetch"/>
	    	<link href="//api.mapbox.com" rel="preconnect dns-prefetch"/>
	    	<link href="//cdnjs.cloudflare.com" rel="preconnect dns-prefetch"/>
	    	<link href="//unpkg.com" rel="preconnect dns-prefetch"/>
			<link href="//kit.fontawesome.com" rel="preconnect dns-prefetch"/>
			
            <!--cssfont-->
            <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" rel="stylesheet"/>

            <!--css-->
            <link href="mod/assets-index/css/scroll.css" rel="stylesheet"/>
            <link href="mod/assets-index/css/bootstrap.min.css" rel="stylesheet"/>
            <link href="mod/assets-index/css/animate.css" rel="stylesheet"/>
            <link href="mod/assets-index/css/meanmenu.css" rel="stylesheet"/>
            <link href="mod/assets-index/css/magnific-popup.min.css" rel="stylesheet"/>
            <link href="mod/assets-index/css/owl.carousel.min.css" rel="stylesheet"/>
            <link href="mod/assets-index/css/odometer.css" rel="stylesheet"/>
            <link href="mod/assets-index/css/slick.css" rel="stylesheet"/>
            <link href="mod/assets-index/css/style.css" rel="stylesheet"/>
            <link href="mod/assets-index/css/responsive.css" rel="stylesheet"/>
            <link href="mod/assets-index/css/footer.css" rel="stylesheet"/>

	    </head>

	    <body>

	        <!--HEADER-->
	        <header id="header">
	        	<div class="startp-mobile-nav fixed">
	        		<div class="logo">
	        			<a href="./"><img src="<?php echo $site_url; ?>/content/<?php echo $site_logo; ?>" class="home-logo"></a>
	        		</div>
	        	</div>
	        	<div class="startp-nav fixed">
	        		<div class="container">
	        			<nav class="navbar navbar-expand-md navbar-light">
	        				<a class="navbar-brand" href="./"><img src="<?php echo $site_url; ?>/content/<?php echo $site_logo; ?>" class="home-logo"></a>
	        				<div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
	        					<ul class="navbar-nav nav ml-auto">
	        						<li class="nav-item"><a href="#panel"><i aria-hidden="true" class="fa fa-home"></i> Home </a></li>
	        						<li class="nav-item"><a href="./admin/index.php"><i class="fa fa-user"></i> Admin</a></li>
	        					</ul>
	        				</div>
	        			</nav>
	        		</div> 
	        	</div>
	        </header>

	        <!--BERANDA-->
	        <div class="main-banner">
	        	<div class="d-table">
	        		<div class="d-table-cell c">
	        			<div class="container">
	        				<div class="row h-100 justify-content-center align-items-center">
	        					<div class="col-lg-5">
	        						<div class="hero-content text-center text-blue">
	        							<p>
	        								<img src="<?php echo $site_url; ?>/content/logo/baja.png" class="img-fluid" width="500px">
	        								<a href="<?php echo $site_url; ?>/login" class="btn btn-primary"><i aria-hidden="true" class="fa fa-sign-in-alt"></i> MASUK</a>
										</p>
	        						</div>
	        					</div>
	        				</div>
	        			</div>
	        		</div>
	        	</div>
	        </div>

	        <!--FOOTER-->
			<section class="">
  <footer class="text-center text-white" style="background-color: #0a4275;">
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
      © 2024 Copyright :
      <a class="text-white">BANK BAJA</a>
    </div>
    <!-- Copyright -->
  </footer>
  <!-- Footer -->
</section>

	        <div class="go-top">
	        	<i data-feather="arrow-up"></i>
	        </div>

			<!--Scroll Indicator Load-->
			<div class='progress-container'>
				<div class='progress-bar' id='progressbar'/>
			</div>
			<script type='text/javascript'>
				//<![CDATA[
				window.addEventListener("scroll", myFunction);
				function myFunction() {
					var winScroll = document.body.scrollTop || document.documentElement.scrollTop;
					var height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
					var scrolled = (winScroll / height) * 100;
					document.getElementById("progressbar").style.width = scrolled + "%";
				}
				//]]>
			</script>

	        <!--javascript-->
	        <script src="mod/assets-index/js/jquery.min.js"></script>
	        <script src="mod/assets-index/js/jquery.meanmenu.min.js"></script>
	        <script src="mod/assets-index/js/jquery.magnific-popup.min.js"></script>
	        <script src="mod/assets-index/js/jquery.appear.js"></script>
	        <script src="mod/assets-index/js/odometer.min.js"></script>
	        <script src="mod/assets-index/js/slick.js"></script>
	        <script src="mod/assets-index/js/owl.carousel.min.js"></script>
	        <script src="mod/assets-index/js/feather.min.js"></script>
	        <script src="mod/assets-index/js/main.js"></script>

	    </body>

	</html>

<?php } ?>