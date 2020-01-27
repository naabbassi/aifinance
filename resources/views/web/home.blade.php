@extends('web/layout')
@section('title')
AI Finance :: Cryptocurrency Investment Inistitue
@endsection
@section('content')
	<!-- Hero Area Start -->
	<div class="hero-area partical-area">
		<div id="particles-js"></div>
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-6 d-flex align-self-center">
					<div class="left-content">
						<div class="content text-center">
							<h5 class="subtitle">
								Secure & Profitable
							</h5>
							<h1 class="title">
								Lend and Borrow
								Cryptocurrency
							</h1>
							<p class="text">
								Borrow, Lend and margin trade crypto
								assets on AI Finance								   
							</p>
							<div class="links">
								<a href="/dashboard" class="mybtn1 link1"><span>Start Borrowing</span> </a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Hero Area End -->

	<!-- Features Area Start -->
	<section class="features">
		<div class="container">
			<div class="row">
				<div class="col-lg-4 col-md-6">
					<div class="single-feature">
						<div class="left">
							<img src="assets/images/feat1.png" alt="">
						</div>
						<div class="right">
							<p class="sub-title">
							Monthly Interest
							</p>
							<h4 class="title">
								7%
							</h4>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="single-feature">
						<div class="left">
							<img src="assets/images/feat2.png" alt="">
						</div>
						<div class="right">
							<p class="sub-title">
								Loan Duration
							</p>
							<h4 class="title">
								0-12 Mo
							</h4>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="single-feature">
						<div class="left">
							<img src="assets/images/feat3.png" alt="">
						</div>
						<div class="right">
							<p class="sub-title">
								Fee as low as
							</p>
							<h4 class="title">
								0%
							</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Features Area End -->

	<!-- Whay Choose us Area Start -->
	<section class="why-choose-us">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-8 col-md-10">
					<div class="section-heading">
						<h5 class="subtitle">
							The Most Trusted
						</h5>
						<h2 class="title extra-padding">
							Cryptocurrency Investing Platform
						</h2>
						<p class="text">
							Here are a few reasons why you should choose AI Finance
						</p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6">
					<div class="single-why">
						<div class="left">
							<div class="icon">
								<img src="assets/images/why1.png" alt="">
							</div>
						</div>
						<div class="right">
							<h4 class="title">
								Reliable and Safe
							</h4>
							<p class="text">
								Advanced security and reliability
								of your collateral									
							</p>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="single-why">
						<div class="left">
							<div class="icon">
								<img src="assets/images/why2.png" alt="">
							</div>
						</div>
						<div class="right">
							<h4 class="title">
								Crypto as Collateral
							</h4>
							<p class="text">
								Advanced security and reliability
								of your collateral									
							</p>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="single-why">
						<div class="left">
							<div class="icon">
								<img src="assets/images/why3.png" alt="">
							</div>
						</div>
						<div class="right">
							<h4 class="title">
									Easy to Use
							</h4>
							<p class="text">
								Advanced security and reliability
								of your collateral									
							</p>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="single-why">
						<div class="left">
							<div class="icon">
								<img src="assets/images/why4.png" alt="">
							</div>
						</div>
						<div class="right">
							<h4 class="title">
									Simple Process
							</h4>
							<p class="text">
								Advanced security and reliability
								of your collateral									
							</p>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="single-why">
						<div class="left">
							<div class="icon">
								<img src="assets/images/why5.png" alt="">
							</div>
						</div>
						<div class="right">
							<h4 class="title">
									Available Worldwide
							</h4>
							<p class="text">
								Advanced security and reliability
								of your collateral									
							</p>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="single-why">
						<div class="left">
							<div class="icon">
								<img src="assets/images/why6.png" alt="">
							</div>
						</div>
						<div class="right">
							<h4 class="title">
									Variety of Currencies
							</h4>
							<p class="text">
								Advanced security and reliability
								of your collateral									
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Whay Choose us Area End -->

	<!-- Lend Area Start -->
	{{-- <section class="lend">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-8 col-md-10">
					<div class="section-heading">
						<h5 class="subtitle extra-padding">
							The Smarter Way 
						</h5>
						<h2 class="title">
							Lend and Borrow
						</h2>
						<p class="text">
							The World's First Crypto Lending Marketplace and 
							Affordable and competitive interest rates
						</p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="tab-menu-area">
						<ul class="nav nav-lend mb-3" id="pills-tab" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" id="pills-lend-tab" data-toggle="pill" href="#pills-lend" role="tab" aria-controls="pills-lend" aria-selected="true">Lend</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="pills-borrow-tab" data-toggle="pill" href="#pills-borrow" role="tab" aria-controls="pills-borrow" aria-selected="false">Borrow</a>
							</li>
						</ul>
					</div>
					<div class="tab-content" id="pills-tabContent">
						<div class="tab-pane fade show active" id="pills-lend" role="tabpanel" aria-labelledby="pills-lend-tab">
							<div class="responsive-table">
								<table class="table">
									<thead>
										<tr>
										<th scope="col">TOKEN NAME</th>
										<th scope="col">LEND APR</th>
										<th scope="col">BORROW APR</th>
										<th scope="col">LOANS ACTIVE</th>
										<th scope="col">RESERVE POOL</th>
										<th scope="col">LEND & EARN</th>
										</tr>
									</thead>
									<tbody>
										<tr>
										<td>
											<img src="assets/images/icon1.png" alt="">
											BTC
										</td>
										<td>9.8%</td>
										<td>17.9%</td>
										<td>$325,650</td>
										<td>$481,694</td>
										<td>
											<a href="#">
												Lend
											</a>
										</td>
										</tr>
										<tr>
										<td>
											<img src="assets/images/icon2.png" alt="">
											ETH
										</td>
										<td>9.8%</td>
										<td>17.9%</td>
										<td>$325,650</td>
										<td>$481,694</td>
										<td>
											<a href="#">
												Lend
											</a>
										</td>
										</tr>
										<tr>
										<td>
											<img src="assets/images/icon3.png" alt="">
											DASH
										</td>
										<td>9.8%</td>
										<td>17.9%</td>
										<td>$325,650</td>
										<td>$481,694</td>
										<td>
											<a href="#">
												Lend
											</a>
										</td>
										</tr>
										<tr>
										<td>
											<img src="assets/images/icon4.png" alt="">
											ETC
										</td>
										<td>9.8%</td>
										<td>17.9%</td>
										<td>$325,650</td>
										<td>$481,694</td>
										<td>
											<a href="#">
												Lend
											</a>
										</td>
										</tr>
										<tr>
										<td>
											<img src="assets/images/icon5.png" alt="">
											TRX
										</td>
										<td>9.8%</td>
										<td>17.9%</td>
										<td>$325,650</td>
										<td>$481,694</td>
										<td>
											<a href="#">
												Lend
											</a>
										</td>
										</tr>
										<tr>
										<td>
											<img src="assets/images/icon1.png" alt="">
											BTC
										</td>
										<td>9.8%</td>
										<td>17.9%</td>
										<td>$325,650</td>
										<td>$481,694</td>
										<td>
											<a href="#">
												Lend
											</a>
										</td>
										</tr>
									</tbody>
									</table>
							</div>
						</div>
						<div class="tab-pane fade" id="pills-borrow" role="tabpanel" aria-labelledby="pills-borrow-tab">
							<div class="responsive-table">
								<table class="table">
									<thead>
										<tr>
										<th scope="col">TOKEN NAME</th>
										<th scope="col">LEND APR</th>
										<th scope="col">BORROW APR</th>
										<th scope="col">LOANS ACTIVE</th>
										<th scope="col">RESERVE POOL</th>
										<th scope="col">LEND & EARN</th>
										</tr>
									</thead>
									<tbody>
										<tr>
										<td>
											<img src="assets/images/icon1.png" alt="">
											BTC
										</td>
										<td>9.8%</td>
										<td>17.9%</td>
										<td>$325,650</td>
										<td>$481,694</td>
										<td>
											<a href="#">
												Lend
											</a>
										</td>
										</tr>
										<tr>
										<td>
											<img src="assets/images/icon2.png" alt="">
											ETH
										</td>
										<td>9.8%</td>
										<td>17.9%</td>
										<td>$325,650</td>
										<td>$481,694</td>
										<td>
											<a href="#">
												Lend
											</a>
										</td>
										</tr>
										<tr>
										<td>
											<img src="assets/images/icon3.png" alt="">
											DASH
										</td>
										<td>9.8%</td>
										<td>17.9%</td>
										<td>$325,650</td>
										<td>$481,694</td>
										<td>
											<a href="#">
												Lend
											</a>
										</td>
										</tr>
										<tr>
										<td>
											<img src="assets/images/icon4.png" alt="">
											ETC
										</td>
										<td>9.8%</td>
										<td>17.9%</td>
										<td>$325,650</td>
										<td>$481,694</td>
										<td>
											<a href="#">
												Lend
											</a>
										</td>
										</tr>
										<tr>
										<td>
											<img src="assets/images/icon5.png" alt="">
											TRX
										</td>
										<td>9.8%</td>
										<td>17.9%</td>
										<td>$325,650</td>
										<td>$481,694</td>
										<td>
											<a href="#">
												Lend
											</a>
										</td>
										</tr>
										<tr>
										<td>
											<img src="assets/images/icon1.png" alt="">
											BTC
										</td>
										<td>9.8%</td>
										<td>17.9%</td>
										<td>$325,650</td>
										<td>$481,694</td>
										<td>
											<a href="#">
												Lend
											</a>
										</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section> --}}
	<!-- Lend Area End -->

	<!-- fact Area Start -->
	<section class="fact">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-8 col-md-10">
					<div class="section-heading">
						<h5 class="subtitle">
							Some Facts
						</h5>
						<h2 class="title">
							AI Finance In Numbers
						</h2>
						<p class="text">
								AI Finance has a variety of features that make it the best place to start trading
						</p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-4 col-md-6">
					<div class="single-fun">
						<div class="left">
							<img src="assets/images/icon6.png" alt="">
						</div>
						<div class="right">
							<h4 class="title">
								$840K
							</h4>
							<p class="sub-title">
								LOANS
							</p>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="single-fun">
						<div class="left">
							<img src="assets/images/icon7.png" alt="">
						</div>
						<div class="right">
							<h4 class="title">
								$2.42M
							</h4>
							<p class="sub-title">
								RESERVES
							</p>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="single-fun">
						<div class="left">
							<img src="assets/images/icon8.png" alt="">
						</div>
						<div class="right">
							<h4 class="title">
								3046
							</h4>
							<p class="sub-title">
								ORDERS
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- fact Area End -->

	<!-- How it work Area Start -->
	<section class="how-it-work">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-8 col-md-10">
					<div class="section-heading">
						<h5 class="subtitle">
								Try To Check Out
						</h5>
						<h2 class="title">
								How Everything Works!
						</h2>
						<p class="text">
								We help you save time and money by easily finding the best loan options. 3 simple step to get Started
						</p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-4">
					<div class="single-work">
						<div class="icon">
							<img src="assets/images/how-work1.png" alt="">
						</div>
						<div class="content">
							<span class="num">01</span>
							<h4 class="title">
								Register within a minute
							</h4>
						</div>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="single-work">
						<div class="icon">
							<img src="assets/images/how-work2.png" alt="">
						</div>
						<div class="content">
							<span class="num">02</span>
							<h4 class="title">
									Deposit & collateral
							</h4>
						</div>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="single-work">
						<div class="icon">
							<img src="assets/images/how-work3.png" alt="">
						</div>
						<div class="content">
							<span class="num">03</span>
							<h4 class="title">
									Start your investment 
							</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- How it work Area End -->

	<!-- Get Start Area Start -->
	<section class="get-start">
		<div class="container">
			<div class="row">
				<div class="col-lg-5">
					<div class="left-image">
						<img src="assets/images/get-start.png" alt="">
					</div>
				</div>
				<div class="col-lg-7">
					<div class="rihgt-area">
						<div class="section-heading">
							<h5 class="subtitle extra-padding">
								Ready To Start
							</h5>
							<h2 class="title  extra-padding">
								Lending Or Borrowing
							</h2>
							<p class="text">
									What Are You Waiting For? Make Things Happen The Way
									You Want With AI Finance!
							</p>
							<a href="#" class="mybtn1">Get Started now</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection