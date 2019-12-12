@extends('admin/layout')
@section('title')
    Admin :: Home
@endsection
@section('content')
<section class="section">
        <div class=" row justify-content-md-center">
            <div class="col-6 col-sm-4 col-md-3 text-center">
                <div class="alert alert-success">
                    <div class="alert-body">
                      <div class="alert-title">Deposits</div>
                    <h4 >{{$depositsAmount}} $</h4>
                    </div>
                  </div>
            </div>
            <div class="col-6 col-sm-4 col-md-3 text-center">
                <div class="alert alert-info">
                    <div class="alert-body">
                      <div class="alert-title">Daily Interest</div>
                    <h4 >{{$interestsAmount}} $</h4>
                    </div>
                  </div>
            </div>
            <div class="col-6 col-sm-4 col-md-3 text-center">
                <div class="alert alert-warning">
                    <div class="alert-body">
                      <div class="alert-title">Rewards</div>
                    <h4 >{{$rewardsAmount}} $</h4>
                    </div>
                  </div>
            </div>
            <div class="col-6 col-sm-4 col-md-3 text-center">
                <div class="alert alert-danger">
                    <div class="alert-body">
                      <div class="alert-title">Network Rewards</div>
                    <h4 >{{$netRewardsAmount}} $</h4>
                    </div>
                  </div>
            </div>
        </div>
        <div class="row">
          {{--  Deposit chart --}}
          <div class="col-12 col-md-4 col-lg-4">
            <div class="card card-statistic-2">
              <div class="card-chart">
                <canvas id="deposit-chart" height="80"></canvas>
              </div>
              <div class="card-icon shadow-primary bg-primary">
                  <i class="fas fa-donate"></i>
              </div>
              <div class="card-wrap">
                <div class="card-header">
                  <h4>My Deposite</h4>
                </div>
                <div class="card-body">
                  {{-- {{ money_format("%i", $depositAmount)}} $ --}}
                </div>
              </div>
            </div>
          </div>
          {{-- Revenue Chart --}}
          <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="card card-statistic-2">
              <div class="card-chart">
                <canvas id="sales-chart" height="80"></canvas>
              </div>
              <div class="card-icon shadow-primary bg-primary">
                  <i class="fas fa-hand-holding-usd"></i>
              </div>
              <div class="card-wrap">
                <div class="card-header">
                  <h4>My Revenue</h4>
                </div>
                <div class="card-body">
                  {{-- {{$revenueAmount}} $ --}}
                </div>
              </div>
            </div>
          </div>
          {{-- Reward Chart --}}
          <div class="col-lg-4 col-md-4 col-sm-12">
              <div class="card card-statistic-2">
                <div class="card-chart">
                  <canvas id="reward-chart" height="80"></canvas>
                </div>
                <div class="card-icon shadow-primary bg-primary">
                  <i class="fas fa-gem"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>My Reward</h4>
                  </div>
                  <div class="card-body">
                      {{-- {{$rewardAmount}} $ --}}
                  </div>
                </div>
              </div>
            </div>
          {{-- Network chart --}}
          <div class="col-12 col-md-12 col-lg-7">
              <div class="card">
                <div class="card-header">
                  <h4>My Network investment</h4>
                </div>
                <div class="card-body p-2">
                  <canvas id="networkChart" height="158"></canvas>
                </div>
              </div>
            </div>
            <div class="col-12 col-md-12 col-lg-5 mb-4">
                <div class="hero align-items-center bg-primary text-white" >
                  <div class="hero-inner">
                    <h2>Invite your members</h2>
                    <p class="lead">In order to expand your network and achieve more profit, invite your member just in way send them your invitation link</p>
                    <div class="mt-4">
                      <a href="#" class="btn btn-lg btn-outline-white btn-icon icon-left mt-2  mr-2" onclick="show()"><i class="fas fa-user-plus"></i> Show Invitation</a>
                      <a href="#" class="btn btn-lg btn-outline-white btn-icon icon-left mt-2"><i class="far fa-question-circle"></i> More Information</a>
                    </div>
                  </div>
                </div>
              </div>
        </div>
      </section>
@endsection 