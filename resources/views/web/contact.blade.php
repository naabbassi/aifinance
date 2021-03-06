@extends('web/layout')
@section('title')
    AIF :: Contact Us
@endsection
@section('content')
	<!-- Breadcrumb Area Start -->
	<section class="breadcrumb-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<h4 class="title">
						Contact Us
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
							<a href="/web/contact">Contact Us</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</section>
	<!-- Breadcrumb Area End -->

	<!-- Contact Area Start -->
	<section class="contact">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-8 col-md-10">
					<div class="section-heading">
						<h5 class="subtitle">
							Contact Us
						</h5>
						<h2 class="title">
							Get in Touch
						</h2>
						<p class="text"> Please complete the form below and one of our team members will 
								get in touch with you as soon as possible.
						</p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-8">
					<div class="contact-form-wrapper">
						<h4 class="title">
								Drop us a Line
						</h4>
						<form action="/web/contact" method="POST">
							@csrf
							<div class="row">
								<div class="col-lg-6">
									<div class="form-group">
										<label for="name">Name :</label>
										<input type="text" class="input-field" name="name" placeholder="Enter Your Name">
										@error('name')
											<small class="form-text text-danger ">{{ $message }}</small>
										@enderror
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<label for="email">Email :</label>
										<input type="email" class="input-field" name="email" placeholder="Enter Your Email">
										@error('email')
											<small class="form-text text-danger ">{{ $message }}</small>
										@enderror
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<label for="subjict">Subject :</label>
										<input type="text" class="input-field" name="subject" placeholder="Write Your Subjict">
										@error('subject')
											<small class="form-text text-danger ">{{ $message }}</small>
										@enderror
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<label for="phone">Phone :</label>
										<input type="phone" class="input-field" name="phone" placeholder="Enter Your Phone No">
									</div>
								</div>
								<div class="col-lg-12">
									<div class="form-group button-area">
										<label for="message">Message :</label>
										<textarea name="message" class="input-field textarea" placeholder="Write Your Message"></textarea>
										@error('message')
											<small class="form-text text-danger ">{{ $message }}</small>
										@enderror
										<button type="submit" class="btn-submit"><i class="fas fa-paper-plane"></i></button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
				<div class="col-lg-4 d-flex">
					<div class="address-area">
						<h4 class="title">
								Contact Information
						</h4>
						<ul class="address-list">
							<li>
								<p>
										<i class="fas fa-map-marker-alt"></i>ADDRESS: 11 Wall St, New York, NY 10005, USA
								</p>
							</li>
							<li>
								<p>
										<i class="fas fa-phone"></i> Phone:  +1-800-2625500
								</p>
							</li>
							<li>
								<p>
										<i class="far fa-envelope"></i>
										Email:  info[at]aifinance.io
								</p>
							</li>
							<li>
								<p>
										<i class="fas fa-globe-americas"></i>
										Website:  aifinance.io
								</p>
							</li>
						</ul>

					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Contact Area End -->
@endsection