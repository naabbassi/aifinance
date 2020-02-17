@extends('web/layout')
@section('title')
AI Finance :: Trade
@endsection
@section('content')

<!-- Breadcrumb Area Start -->
<section class="breadcrumb-area extra-extra-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="title">
                    Trade
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
                        <a href="/web/trade">Trade </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Area End -->

    	<!-- calculator Area End -->
	<div class="calculator">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="calculator-box">
						<div class="row">
							<div class="col-lg-12">
								<form action="#">
									<ul class="list">
										<li class="enter-amount">
											<label>AMOUNT</label>
											<input type="text" placeholder="Enter Amount">
										</li>
										<li class="token-name">
											<select>
												<option value="0">BTC</option>
												<option value="1">ETH</option>
												<option value="2">TRX</option>
											</select>
										</li>
										<li class="yerly-returns">
											<label>YEARLY RETURNS</label>
											<input type="text" value="45.30%" placeholder="">
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
	<!-- calculator Area End -->

	<!-- borrow Area Start -->
	<section class="lend borrow-page">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-8 col-md-10">
					<div class="section-heading">
						<h5 class="subtitle extra-padding">
							The Smarter Way 
						</h5>
						<h2 class="title extra-padding">
							Way to Borrow
						</h2>
						<p class="text">
							Deposit crypto assets & earn interest on your reserves.
							Try to check out Lending Rate
						</p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
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
									<img src="/assets/images/icon1.png" alt="">
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
									<img src="/assets/images/icon2.png" alt="">
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
									<img src="/assets/images/icon3.png" alt="">
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
									<img src="/assets/images/icon4.png" alt="">
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
									<img src="/assets/images/icon5.png" alt="">
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
									<img src="/assets/images/icon1.png" alt="">
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
	</section>
	<!-- borrow Area End -->

	<!-- Get Start Area2 Start -->
	<section class="get-start2">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-8 col-md-10">
					<div class="section-heading">
						<h5 class="subtitle">
							Get started
						</h5>
						<h2 class="title">
							In a few minutes
						</h2>
						<p class="text">
							Lendbo supports a variety of the most popular digital currencies.
							Deposit crypto assets & earn interest on your reserves.
						</p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-4">
					<div class="single-work">
						<div class="icon">
							<img src="/assets/images/gs1.png" alt="">
						</div>
						<div class="content">
							<span class="num">01</span>
							<h4 class="title">
								Fund Account
							</h4>
							<p class="text">
								Signup and add crypto tokens to your smart account
 								to get started
							</p>
						</div>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="single-work">
						<div class="icon">
							<img src="/assets/images/gs2.png" alt="">
						</div>
						<div class="content">
							<span class="num">02</span>
							<h4 class="title">
								Create Reserve
							</h4>
							<p class="text">
								Signup and add crypto tokens to your smart account
 								to get started
							</p>
						</div>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="single-work">
						<div class="icon">
							<img src="/assets/images/gs3.png" alt="">
						</div>
						<div class="content">
							<span class="num">03</span>
							<h4 class="title">
								Earn Interest
							</h4>
							<p class="text">
								Signup and add crypto tokens to your smart account
 								to get started
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Get Start Area2 End -->

	<!-- Check Questions Area Start -->
	<section class="check-questions">
		<div class="container">
			<div class="row justify-content-between">
				<div class="col-lg-5 d-flex align-self-center">
					<div class="left-image">
						<img src="/assets/images/cq-img.png" alt="">
					</div>
				</div>
				<div class="col-lg-6">
					<div class="rihgt-area">
						<div class="section-heading">
							<h5 class="subtitle extra-padding">
								If you have any
							</h5>
							<h2 class="title  extra-padding">
								Questions
							</h2>
							<p class="text">
								Our top priorities are to protect your privacy, 
								provide secure  transactions, and  safeguard your
								data. When you're ready to play, registering an
								account is required so we know you're of legal
								age and so no one else can use your account.We
								answer the most commonly asked questions
							</p>
							<a href="#" class="mybtn1">Check FAQs</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Check Questions Area End -->

@endsection