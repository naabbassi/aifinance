@extends('web/layout')
@section('title')
    
@endsection
@section('content')
    
	<!-- Breadcrumb Area Start -->
	<section class="breadcrumb-area extra-extra-padding">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<h4 class="title extra-padding">
						Help Center
					</h4>
					<ul class="breadcrumb-list">
						<li>
							<a href="/">
								<i class="fas fa-home"></i>
								Home
							</a>
						</li>
						<li>
							<span><i class="fas fa-chevron-right"></i> </span>
						</li>
						<li>
							<a href="web/help">Help Center</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</section>
	<!-- Breadcrumb Area End -->

	<!-- Serch Area Start -->
	<div class="serch-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="serch-box">
						<div class="row">
							<div class="col-lg-12">
								<form action="#">
									<ul class="list">
										<li class="input-field">
											<input type="text" placeholder="Serch For Articals">
										</li>
										<li class="button">
											<button type="submit" class="mybtn1">Get Started </button>
										</li>
									</ul>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Serch Area End -->

	<!-- Help Section Area Start -->
	<section class="help-section">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="help-box">
						<div class="help-box-inner">
							<div class="icon">
								<img src="/assets/images/help/help-icon1.png" alt="">
							</div>
							<div class="content">
								<h4 class="title">
									Getting Started Guides
								</h4>
								<div class="writer-profile">
									<div class="img">
										<img src="/assets/images/help/writter.png" alt="">
									</div>
									<div class="writer-content">
										<p>27 articles in this collection
										</p>
										<p>
											Written by <a href="#">
												David Kemmerer
											</a>
										</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-12">
					<div class="help-box">
						<div class="help-box-inner">
							<div class="icon">
								<img src="/assets/images/help/help-icon2.png" alt="">
							</div>
							<div class="content">
								<h4 class="title">
									Common Issues
								</h4>
								<div class="writer-profile">
									<div class="img">
										<img src="/assets/images/help/writter.png" alt="">
									</div>
									<div class="writer-content">
										<p>27 articles in this collection
										</p>
										<p>
											Written by <a href="#">
												David Kemmerer
											</a>
										</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-12">
					<div class="help-box">
						<div class="help-box-inner">
							<div class="icon">
								<img src="/assets/images/help/help-icon3.png" alt="">
							</div>
							<div class="content">
								<h4 class="title">
									FAQs
								</h4>
								<div class="writer-profile">
									<div class="img">
										<img src="/assets/images/help/writter.png" alt="">
									</div>
									<div class="writer-content">
										<p>27 articles in this collection
										</p>
										<p>
											Written by <a href="#">
												David Kemmerer
											</a>
										</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Help Section Area End -->


	<!-- Submit Request Area Start -->
	<section class="submit-request">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="submit-request-box">
						<div class="content">
							<h4 class="title">
								You have not found an answer
								to your questions?
							</h4>
							<p class="sub-title">
								You have not found an answer? Don't worry, send us a message
							</p>
							<a href="#" class="mybtn1">Submit a request</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Submit Request Area End -->

@endsection