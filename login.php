<?php
	ob_start();
	session_start();

	
	include("connect/db.php"); //Establishing connection with our database

	//Variable for storing our errors.
	if(isset($_POST["btn-login"]))
		{
				if(empty($_POST["password"]) || empty($_POST["email"]))
			{
				echo '<div class="alert alert-warning"> Enter Your Email & Password! </div>';
			}else
			{
			// Define $username and $password
			$email=$_POST['email'];
			$password=$_POST['password'];

			// To protect from MySQL injection
			$email = stripslashes($email);
			$password = stripslashes($password);
			$email = mysqli_real_escape_string($connection, $email);
			$password = mysqli_real_escape_string($connection,$password);
			$password = md5($password);

			//Check username and password from database
			$sql="SELECT * FROM users WHERE email='$email' and password='$password'";
			$result=mysqli_query($connection,$sql);
			$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
			$_SESSION['logon'] = true;
			$email = $row['email'];
			$user_name = $row['fname'];

			$lname = $row['lname'];


			//If username and password exist in our database then create a session.
			//Otherwise echo error.

			if(mysqli_num_rows($result) == 1)
			{

			$_SESSION['email'] = $email;
			$_SESSION['user_name'] = $user_name;
			$_SESSION['lname']  = $lname;
		
			// Initializing Session
			// Initializing Session

			header("location: profile.php"); // Redirecting To Other Page

			}else
			{
			echo '<div class="alert alert-warning">Incorrect Email and Password! </div>';
			}

			}
	}

?>
<!DOCTYPE html>
<html>

<head>

		<!-- Basic -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">	

		<title>Login | Survey Web Application</title>	

		<meta name="keywords" content="HTML5 Template" />
		<meta name="description" content="Porto - Responsive HTML5 Template">
		<meta name="author" content="okler.net">

		<!-- Favicon -->
		<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
		<link rel="apple-touch-icon" href="img/apple-touch-icon.png">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

		<!-- Web Fonts  -->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800%7CShadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="vendor/animate/animate.min.css">
		<link rel="stylesheet" href="vendor/simple-line-icons/css/simple-line-icons.min.css">
		<link rel="stylesheet" href="vendor/owl.carousel/assets/owl.carousel.min.css">
		<link rel="stylesheet" href="vendor/owl.carousel/assets/owl.theme.default.min.css">
		<link rel="stylesheet" href="vendor/magnific-popup/magnific-popup.min.css">

		<!-- Theme CSS -->
		<link rel="stylesheet" href="css/theme.css">
		<link rel="stylesheet" href="css/theme-elements.css">
		<link rel="stylesheet" href="css/theme-blog.css">
		<link rel="stylesheet" href="css/theme-shop.css">

	<link rel="stylesheet" href="css/skins/default.css">		<script src="master/style-switcher/style.switcher.localstorage.js"></script>

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="css/custom.css">

		<!-- Head Libs -->
		<script src="vendor/modernizr/modernizr.min.js"></script>
		<script type="text/javascript" src="script.js"></script>

	</head>
	<body>

		<div class="body">
			<header id="header" class="header-narrow" data-plugin-options="{'stickyEnabled': true, 'stickyEnableOnBoxed': true, 'stickyEnableOnMobile': true, 'stickyStartAt': 57, 'stickySetTop': '-57px', 'stickyChangeLogo': false}">
				<div class="header-body">
					<div class="header-top header-top-style-4">
						<div class="container">
							<div class="header-search hidden-xs">
								<form id="searchForm" action="http://preview.oklerthemes.com/porto/5.3.0/page-search-results.html" method="get">
									<!--<div class="input-group">
										<input type="text" class="form-control" name="q" id="q" placeholder="Search..." required>
										<span class="input-group-btn">
											<button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
										</span>
									</div>-->
								</form>
							</div>
							<p class="pull-left">
								<span class="mr-xs"><i class="icon-call-end icons mr-xs"></i> +(254) 456-789</span><span class="hidden-xs"></span>
							</p>
						
						</div>
					</div>
					<div class="header-container container">
						<div class="header-row">
							<div class="header-column">
								<div class="header-logo">
									<a href="index.php">
										<img alt="Porto" width="100" height="48" src="img/logo.png">
									</a>
								</div>
							</div>
							<div class="header-column">
								<div class="header-row">
									<div class="header-nav">
										<button class="btn header-btn-collapse-nav" data-toggle="collapse" data-target=".header-nav-main">
											<i class="fa fa-bars"></i>
										</button>
										<div class="header-nav-main header-nav-main-effect-1 header-nav-main-sub-effect-1 collapse">
											<nav>
												<ul class="nav nav-pills" id="mainNav">
													<li class=""><a  href="index.php">Home</a></li>
													<li class=""><a  href="about.php">About Us</a></li>
													<li class=""><a  href="contact-us.php">Contact Us</a></li>
													<li class=""><a  href="faqs.php">FAQ's</a></li>
													<li class="dropdown">
														<a class="dropdown-toggle" href="#">
															<i class="fa fa-user " > Sign Up | Sign In </i>
														</a>
														<ul class="dropdown-menu">
															<li><a href="register.php">Register</a></li>
															<li class="active"><a href="login.php">Log In</a></li>
														</ul>
													</li>
												</ul>
											</nav>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</header>

			<div role="main" class="main">

				<section class="page-header">
					<div class="container">
						<div class="row">
							<div class="col-md-12">
								<ul class="breadcrumb">
									<li><a href="#">Home</a></li>
									<li class="active">Login</li>
								</ul>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<h1>Login</h1>
							</div>
						</div>
					</div>
				</section>

				<div class="container">

					<div class="row">
						<div class="col-md-12">

							<div class="featured-boxes">
								
									<div class="col-sm-6 col-sm-offset-3">
										<div class="featured-box featured-box-primary align-left mt-xlg">
											<div class="box-content">
												<h4 class="heading-primary center mb-md">I'm a Member</h4>
												<form class="form-signin" method="post" id="login-form">
													<div id="error">
														<!--Div that shows error message -->
													</div> 
													<div class="row">
														<div class="form-group">
															<div class="col-md-12">
																<label >E-mail Address</label>
																<input type="email" name="email" id="email" value="" class="form-control input-lg" autofocus="">
																<span id="check-e" ></span>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="form-group">
															<div class="col-md-12">
																<a class="pull-right" href="#">(Lost Password?)</a>
																<label><i class="fa fa-lock"> Password</i></label>
																<input type="password" name="password" id="password" class="form-control input-lg">
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-md-6">
															<span class="remember-box checkbox">
																<label for="rememberme">
																	<input type="checkbox" id="rememberme" name="rememberme">Remember Me
																</label>
															</span>
														</div>
														 <div class="form-group">
												            <button type="submit" class="btn btn-primary pull-right" name="btn-login" id="btn-login">
												    			<span class="glyphicon glyphicon-log-in"></span> &nbsp; Sign In
															</button> 
												        </div>
														<a class="pull-right" href="register.php">(Not a Member?)</a>
													</div>
												</form>
											</div>
										</div>
									</div>
									
								

							</div>
						</div>
					</div>

				</div>

			</div>

			<?php require_once 'footer.php';?>
		</div>

		<!-- Vendor -->
		<script src="vendor/jquery/jquery.min.js"></script>
		<script src="vendor/jquery.appear/jquery.appear.min.js"></script>
		<script src="vendor/jquery.easing/jquery.easing.min.js"></script>
		<script src="vendor/jquery-cookie/jquery-cookie.min.js"></script>
		<script src="master/style-switcher/style.switcher.js" id="styleSwitcherScript" data-base-path="" data-skin-src=""></script>
		<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="vendor/common/common.min.js"></script>
		<script src="vendor/jquery.validation/jquery.validation.min.js"></script>
		<script src="vendor/jquery.easy-pie-chart/jquery.easy-pie-chart.min.js"></script>
		<script src="vendor/jquery.gmap/jquery.gmap.min.js"></script>
		<script src="vendor/jquery.lazyload/jquery.lazyload.min.js"></script>
		<script src="vendor/isotope/jquery.isotope.min.js"></script>
		<script src="vendor/owl.carousel/owl.carousel.min.js"></script>
		<script src="vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
		<script src="vendor/vide/vide.min.js"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="js/theme.js"></script>
		
		<!-- Theme Custom -->
		<script src="js/custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="js/theme.init.js"></script>

		

	</body>


</html>
