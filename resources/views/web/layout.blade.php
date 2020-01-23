<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="forntEnd-Developer" content="Mamunur Rashid">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>@yield('title')</title>
	<!-- favicon -->
	<link rel="shortcut icon" href="/assets/images/favicon.png" type="image/x-icon">
	<!-- bootstrap -->
	<link rel="stylesheet" href="/assets/css/bootstrap.min.css">
	<!-- Plugin css -->
	<link rel="stylesheet" href="/assets/css/plugin.css">

	<!-- stylesheet -->
	<link rel="stylesheet" href="/assets/css/style.css">
	<!-- responsive -->
	<link rel="stylesheet" href="/assets/css/responsive.css">
</head>

<body>
	<!-- preloader area start -->
	<div class="preloader" id="preloader">
		<div class="loader loader-1">
			<div class="loader-outter"></div>
			<div class="loader-inner"></div>
		</div>
	</div>
	<!-- preloader area end -->

	<!-- Header Area Start  -->
	<header class="header">
		<!-- Top Header Area Start -->
		<section class="top-header" style="background-color:#fff">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="content">
							<div class="left-content">
								<ul class="left-list">
									<li>
										<p>
											<i class="fas fa-headset"></i>	Support
										</p>
									</li>
								</ul>
							</div>
							<div class="right-content">
								<ul class="right-list">
									<li>
										<ul class="social-link">
											<li>
												<a href="#">
													<i class="fab fa-facebook-f"></i>
												</a>
											</li>
											<li>
												<a href="#">
													<i class="fab fa-twitter"></i>
												</a>
											</li>
											<li>
												<a href="#">
													<i class="fab fa-linkedin-in"></i>
												</a>
											</li>
											<li>
												<a href="#">
													<i class="fab fa-instagram"></i>
												</a>
											</li>
										</ul>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- Top Header Area End -->
		<!--Main-Menu Area Start-->
		<div class="mainmenu-area">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">                 
						<nav class="navbar navbar-expand-lg navbar-light">
							<a class="navbar-brand" href="/">
								<h3>AI Finance</h3>
							</a>
							<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_menu" aria-controls="main_menu"
								aria-expanded="false" aria-label="Toggle navigation">
								<span class="navbar-toggler-icon"></span>
							</button>
							<div class="collapse navbar-collapse fixed-height" id="main_menu">
								<ul class="navbar-nav ml-auto">
									
									<li class="nav-item">
										<a class="nav-link" href="/">Home</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" href="/web/about">About</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" href="/web/trade">Trade</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" href="/web/lend">Lend</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" href="/web/invest">Borrow</a>
									</li>
								</ul>
								<a href="/dashboard" class="mybtn1">Get Started </a>
							</div>
						</nav>
					</div>
				</div>
			</div>
		</div>
		<!--Main-Menu Area Start-->
	</header>
	<!-- Header Area End  -->
    @yield('content')
	<!-- Footer Area Start -->
	<footer class="footer" id="footer">
		<div class="subscribe-area">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="subscribe-box">
							<div class="row">
								<div class="col-lg-4 col-md-4 ">
									<div class="image-area">
										<img src="/assets/images/subimg.png" alt="">
									</div>
								</div>
								<div class="col-lg-8 col-md-8 d-flex">
									<div class="right-area">
										<h5 class="sub-title">
												Subscribe to AI Finance Newsletter
										</h5>
										<h4 class="title">
											To Get Exclusive Benefits
										</h4>
										<form action="#">
											<input type="text" placeholder="Your Email Address">
											<button type="submit">Subscribe</button>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-sm-6 col-lg-3">
					<div class="footer-widget info-link-widget">
						<h4 class="title">
							About 
						</h4>
						<ul class="link-list">
							<li>
								<a href="#">
									<i class="fas fa-angle-double-right"></i>	About Us
								</a>
							</li>
							<li>
								<a href="#">
									<i class="fas fa-angle-double-right"></i>	Contact Us
								</a>
							</li>
						</ul>
					</div>
				</div>
				<div class="col-sm-6 col-lg-3">
					<div class="footer-widget info-link-widget">
						<h4 class="title">
							My Account
						</h4>
						<ul class="link-list">
							<li>
								<a href="#">
									<i class="fas fa-angle-double-right"></i> Manage Your Account
								</a>
							</li>
							<li>
								<a href="#">
									<i class="fas fa-angle-double-right"></i> How to Deposit
								</a>
							</li>
							<li>
								<a href="#">
									<i class="fas fa-angle-double-right"></i> How to Withdraw
								</a>
							</li>
							<li>
								<a href="#">
									<i class="fas fa-angle-double-right"></i> Account Varification
								</a>
							</li>
							<li>
								<a href="#">
									<i class="fas fa-angle-double-right"></i> Safety & Security
								</a>
							</li>
							<li>
								<a href="#">
									<i class="fas fa-angle-double-right"></i> Membership Level

								</a>
							</li>
						</ul>
					</div>
				</div>
				<div class="col-sm-6 col-lg-3">
					<div class="footer-widget info-link-widget">
						<h4 class="title">
							help center 
						</h4>
						<ul class="link-list">
							<li>
								<a href="#">
									<i class="fas fa-angle-double-right"></i>Help centre
								</a>
							</li>
							<li>
								<a href="#">
									<i class="fas fa-angle-double-right"></i>FAQ
								</a>
							</li>
							<li>
								<a href="#">
									<i class="fas fa-angle-double-right"></i>Quick Start Guide
								</a>
							</li>
							<li>
								<a href="#">
									<i class="fas fa-angle-double-right"></i>Tutorials
								</a>
							</li>
							<li>
								<a href="#">
									<i class="fas fa-angle-double-right"></i>Borrow
								</a>
							</li>
							<li>
								<a href="#">
									<i class="fas fa-angle-double-right"></i>Lend

								</a>
							</li>
						</ul>
					</div>
				</div>
				<div class="col-sm-6 col-lg-3">
					<div class="footer-widget info-link-widget">
						<h4 class="title">
							Legal Info
						</h4>
						<ul class="link-list">
							<li>
								<a href="#">
									<i class="fas fa-angle-double-right"></i>Risk Warnings
								</a>
							</li>
							<li>
								<a href="#">
									<i class="fas fa-angle-double-right"></i>Privacy Notice
								</a>
							</li>
							<li>
								<a href="#">
									<i class="fas fa-angle-double-right"></i>Security
								</a>
							</li>
							<li>
								<a href="#">
									<i class="fas fa-angle-double-right"></i>Terms of Service
								</a>
							</li>
							<li>
								<a href="#">
									<i class="fas fa-angle-double-right"></i>Become Affiliate
								</a>
							</li>
							<li>
								<a href="#">
									<i class="fas fa-angle-double-right"></i>Complaints Policy

								</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="copy-bg">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="content">
							<div class="content">
								<p>Copyright © 2019.All Rights Reserved By <a href="#">AI Finance</a>
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>
	<!-- Footer Area End -->

	<!-- Back to Top Start -->
	<div class="bottomtotop">
		<i class="fas fa-chevron-right"></i>
	</div>
	<!-- Back to Top End -->
	<!-- jquery -->
	<script src="/assets/js/jquery.js"></script>
	<!-- popper -->
	<script src="/assets/js/popper.min.js"></script>
	<!-- bootstrap -->
	<script src="/assets/js/bootstrap.min.js"></script>
	<!-- plugin js-->
	<script src="/assets/js/plugin.js"></script>
	<!-- main -->
	<script src="/assets/js/main.js"></script>
</body>

</html>