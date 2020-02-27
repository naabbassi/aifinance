@extends('web/layout')
@section('title')
    AI Finance :: Blog
@endsection
@section('content')
    		<!-- Breadcrumb Area Start -->
		<section class="breadcrumb-area extra-padding">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<h4 class="title extra-padding">
							Blog
						</h4>
						<ul class="breadcrumb-list">
							<li><a href="/"><i class="fas fa-home"></i>Home</a></li>
							<li><span><i class="fas fa-chevron-right"></i> </span></li>
							<li><a href="/web/blog">Blog</a></li>
						</ul>
					</div>
				</div>
			</div>
		</section>
		<!-- Breadcrumb Area End -->

        <!-- Blog Page Grid Area Start -->
        <section class="blog-page">
            <div class="container">
                <div class="row">
                    @foreach ($blogs as $item)    
                    <div class="col-lg-4 col-md-6">
                        <div class="single-blog">
                            <div class="thumb">
                            <img src="{{ Storage::url($item->pic)}}" alt="">
                            </div>
                            <div class="content">
                                <h3 class="title">
                                <a href="blog/{{$item->id}}">
                                           {{$item->title}}
                                    </a>
                                </h3>
                                <div class="post-details">
                                    {{ Str::limit(strip_tags($item->content),150)}}
                                </div>
                                <div class="post-footer">
                                    <div class="post-by">
                                        <img src="/assets/images/blog/author.png" alt="">
                                        <a href="#">{{$item->author}}</a>
                                    </div>
                                    <div class="time">
                                        @php
                                            $originalDate = $item->created_at;
                                            $newDate = date("d M Y", strtotime($originalDate));
                                        @endphp 
                                        <span>
                                            {{ $newDate }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

				</div>
				<div class="row">
                    {!! $blogs->render() !!}
				</div>
            </div>
        </section>
        <!-- Blog Page Grid Area End -->

@endsection