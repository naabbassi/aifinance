@extends('layout')
@section('title')
    AIF:Dashboard 
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
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="card">
              <div class="card-header">
                <h4>My Network investment</h4>
              </div>
              <div class="card-body p-2">
                <canvas id="myChart" height="158"></canvas>
              </div>
            </div>
          </div>

          <div class="col-12 col-md-6 col-lg-6">
              <div class="card card-hero">
                <div class="card-header">
                  <div class="card-icon">
                    <i class="fab fa-bitcoin"></i>
                  </div>
                  <h3>Investment</h3>
                  <div class="card-description">Calculate your monthly revenue instantly</div>
                </div>
                <div class="card-body">
                      <label for="customRange2">Move the range to change the amount</label>
                      <input type="range" class="custom-range" id="range" value="1000" min="0" max="5000" id="customRange2">
                      <div class="row">
                        <div class="col-6 col-md-6 col-lg-6">
                          <div class="card ">
                            <div class="card-body">
                              <h3 class="text-center">1000 $</h3>
                              <p class="text-center">Investment</p>
                            </div>
                          </div>
                        </div>
                        <div class="col-6 col-md-6 col-lg-6">
                            <div class="card">
                              <div class="card-body">
                                <h2 class="text-center">60 $</h2>
                                <p class="text-center">monthly revenue</p>
                              </div>
                            </div>
                          </div>    
                        </div>
                </div>
              </div>
            </div>
      </div>
      <div class="row">
          <div class="col-12 mb-4">
              <div class="hero text-white hero-bg-image hero-bg-parallax" data-background="../assets/img/bitcoin.jpg" style="background-image: url(&quot;../assets/img/unsplash/andre-benz-1214056-unsplash.jpg&quot;);">
                <div class="hero-inner">
                  <h2>Invite your members</h2>
                  <p class="lead">In order to expand your network and achieve more profit, invite your member just in way send them your invitation link</p>
                  <div class="mt-4">
                    <a href="#" class="btn btn-outline-white btn-lg btn-icon icon-left"><i class="fas fa-user-plus"></i> Send Invitation</a>
                    <a href="#" class="btn btn-outline-white btn-lg btn-icon icon-left"><i class="far fa-question-circle"></i> More Information</a>
                  </div>
                </div>
              </div>
            </div>
      </div>
    </section>
  </div>
  <script>
    var slider = $("#range");
    var revenue = $("#revenue");
    var amount = $("#amount");
    amount.val = slider.val;
    revenue.val = 3434;

  </script>
@endsection