@extends('errors/layout')
@section('title')
    AIF :: {{$title}}
@endsection
@section('content')
    <div class="col-12" style="height: 100% !important;">
            @if(Session::has('alert-success'))
            <div class="empty-state " style="height: 100% !important; padding-top:20%">
                    <div class="empty-state-icon bg-success">
                      <i class="fas fa-times"></i>
                    </div>
                    <h2>{{$title}}</h2>
                    <p class="lead">
                        {!! session('alert-success') !!}
                    </p>
                  <a href="{{ route('home')}}" class="btn btn-dark mt-4"><i class="fas fa-home"></i> Go Back to home</a>
             </div>
        @endif
        @if(Session::has('alert-warning'))
        <div class="empty-state " style="height: 100% !important; padding-top:20%">
                <div class="empty-state-icon bg-danger">
                  <i class="fas fa-times"></i>
                </div>
                <h2>{{$title}}</h2>
                <p class="lead">
                    {!! session('alert-warning') !!}
                </p>
              <a href="{{ route('home')}}" class="btn btn-dark mt-4"><i class="fas fa-home"></i> Go Back to home</a>
         </div>
        @endif
        
      </div>
@endsection