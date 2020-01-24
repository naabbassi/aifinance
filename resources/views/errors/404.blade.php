@extends('errors/layout')
@section('title')
    AIF :: 404
@endsection
@section('content')
	<!-- 404 Area Start -->
	<section class="four-zero-four">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="content">
						<img src="/assets/images/404.png" alt="">
						<div class="inner-content">
							<h4 class="title">
									Oops, <br>
									Something went wrong !
							</h4>
							<p class="sub-title">
									The page you're looking for isn't exist.
							</p>
              <a href="{{ url()->previous() }}"  class="mybtn1"><i class="fas fa-angle-double-left"></i> BACK TO Previous Page</a>
              <a href="{{ route('home')}}" class="mybtn1"><i class="fas fa-home"></i> Go to home</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- 404 Area End -->
@endsection