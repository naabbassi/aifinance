@extends('layout')
@section('title')
    AIF :: My Dashboard 
@endsection
@section('content')
 <!-- Main Content -->
 <div class="main-content">
    <section class="section">
      {{-- mini Charts --}}
      <div class="row">
        {{--  Balance chart --}}
        <div class="col-12 col-md-4 col-lg-4">
          <div class="card card-statistic-2">
            <div class="card-chart">
              <canvas id="balance-chart" height="80"></canvas>
            </div>
            <div class="card-icon shadow-primary bg-primary">
              <i class="fas fa-dollar-sign"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>My Deposite</h4>
              </div>
              <div class="card-body">
                $187,13
              </div>
            </div>
          </div>
        </div>
        {{-- Reevenue --}}
        <div class="col-lg-4 col-md-4 col-sm-12">
          <div class="card card-statistic-2">
            <div class="card-chart">
              <canvas id="sales-chart" height="80"></canvas>
            </div>
            <div class="card-icon shadow-primary bg-primary">
              <i class="fas fa-gem"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>My Revenue</h4>
              </div>
              <div class="card-body">
                4,732
              </div>
            </div>
          </div>
        </div>
        {{-- Reevenue --}}
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="card card-statistic-2">
              <div class="card-chart">
                <canvas id="sales-chart" height="80"></canvas>
              </div>
              <div class="card-icon shadow-primary bg-primary">
                <i class="fas fa-gem"></i>
              </div>
              <div class="card-wrap">
                <div class="card-header">
                  <h4>My Revenue</h4>
                </div>
                <div class="card-body">
                  4,732
                </div>
              </div>
            </div>
          </div>
        {{-- Network chart --}}
        <div class="col-12 col-md-12 col-lg-6">
            <div class="card">
              <div class="card-header">
                <h4>My Network investment</h4>
              </div>
              <div class="card-body p-2">
                <canvas id="myChart" height="158"></canvas>
              </div>
            </div>
          </div>
          <div class="col-12 col-md-12 col-lg-6 mb-4">
              <div class="hero align-items-center bg-primary text-white" >
                <div class="hero-inner">
                  <h2>Invite your members</h2>
                  <p class="lead">In order to expand your network and achieve more profit, invite your member just in way send them your invitation link</p>
                  <div class="mt-4">
                    <a href="#" class="btn btn-lg btn-outline-white btn-icon icon-left mt-2  mr-2"><i class="fas fa-user-plus"></i> Send Invitation</a>
                    <a href="#" class="btn btn-lg btn-outline-white btn-icon icon-left mt-2"><i class="far fa-question-circle"></i> More Information</a>
                  </div>
                </div>
              </div>
            </div>
            <p>{{  Hash::make('password') }}</p>
      </div>
    </section>
  </div>
@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
<script src="/js/page/index.js"></script>
@endsection