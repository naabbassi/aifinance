@extends('web/layout')
@section('title')
    AIF :: Blog - {{ $post->title }}
@endsection
@section('content')
	<!-- Breadcrumb Area Start -->
	<section class="breadcrumb-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<h4 class="title">
						Blog
					</h4>
					<ul class="breadcrumb-list">
						<li>
							<a href="index.html"><i class="fas fa-home"></i>Home</a>
						</li>
						<li>
							<span><i class="fas fa-chevron-right"></i> </span>
						</li>
						<li>
							<a href="blog.html">Blog</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</section>
    <!-- Breadcrumb Area End -->
    <section class="blog-page single-blog-area">
        <div class="row">
            <div class="container">
            <div class="col-lg-12">
                <div class="single-blog blog-details">
                    <div class="thumb">
                        <img src="{{ Storage::url($post->pic)}}" alt="">
                        <div class="date">
                            @php
                                $originalDate = $post->created_at;
                                $day = date("d", strtotime($originalDate));
                                $month = date("M", strtotime($originalDate));
                            @endphp
                            {{$day}} <span>{{$month}}</span>
                        </div>
                    </div>
                    <div class="content">
                        <h3 class="post-title">
                           {{ $post->title }}
                        </h3>
                        <div class="post-meta">
                            <ul>
                                <li><i class="fas fa-user"></i> By <a href="#">{{ $post->author }}</a></li>
                                <li><a href=""><i class="fas fa-eye"></i> 3.1k</a></li>
                            </ul>
                        </div>
                        <div class="post-details">{!! $post->content !!}</div>
                    </div>
                </div>
            </div>
        </div>         
    </div>
    </section>
@endsection