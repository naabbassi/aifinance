@extends('errors/layout')
@section('title')
    AIF :: 404
@endsection
@section('content')
    <div class="col-12" style="height: 100% !important;">
        <div class="empty-state " style="height: 100% !important; padding-top:20%">
            <div class="empty-state-icon bg-danger">
              <i class="fas fa-times"></i>
            </div>
            <h2>HTTP Request Failed - 404</h2>
            <p class="lead">
              We tried it, but failed when requesting data to the server, sorry. (Code: <a href="#" class="bb">404</a>)
            </p>
            <a href="{{ url()->previous() }}" class="btn btn-info mt-4"><i class="fas fa-arrow-circle-left"></i> Go Back to Previous Page</a>
          <a href="{{ route('home')}}" class="btn btn-dark mt-4"><i class="fas fa-home"></i> Go Back to home</a>
          </div>
      </div>
@endsection