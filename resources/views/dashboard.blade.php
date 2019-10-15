@extends('layout')
@section('title')
    AIF :: My Dashboard 
@endsection
@section('content')
 <!-- Main Content -->
    <section class="section">
      <div class=" row justify-content-md-center">
          <div class="col-6 col-sm-4 col-md-2 text-center">
              <div class="alert alert-success">
                  <div class="alert-body">
                    <div class="alert-title">Bitcoin</div>
                    <h6 id="bitcoin"></h6>
                  </div>
                </div>
          </div>
          <div class="col-6 col-sm-4 col-md-2 text-center">
              <div class="alert alert-success">
                  <div class="alert-body">
                    <div class="alert-title">Ethereum</div>
                    <h6 id="ether"></h6>
                  </div>
                </div>
          </div>
          <div class="col-6 col-sm-4 col-md-2 text-center">
              <div class="alert alert-success">
                  <div class="alert-body">
                    <div class="alert-title">Litecoin</div>
                    <h6 id="litecoin"></h6>
                  </div>
                </div>
          </div>
          <div class="col-6 col-sm-4 col-md-2 text-center">
              <div class="alert alert-success">
                  <div class="alert-body">
                    <div class="alert-title">XRP</div>
                    <h6 id="ripple"></h6>
                  </div>
                </div>
          </div>
          <div class="col-6 col-sm-4 col-md-2 text-center">
              <div class="alert alert-success">
                  <div class="alert-body">
                    <div class="alert-title">EOS</div>
                    <h6 id="eos"></h6>
                  </div>
                </div>
          </div>
          <div class="col-6 col-sm-4 col-md-2 text-center">
              <div class="alert alert-success">
                  <div class="alert-body">
                    <div class="alert-title">Cardano</div>
                    <h6 id="cardano"></h6>
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
                {{ money_format("%i", $depositAmount)}} $
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
                {{$revenueAmount}} $
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
                    {{$rewardAmount}} $
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
                    <a href="#" class="btn btn-lg btn-outline-white btn-icon icon-left mt-2  mr-2" onclick="show()"><i class="fas fa-user-plus"></i> Show Invitation</a>
                    <a href="#" class="btn btn-lg btn-outline-white btn-icon icon-left mt-2"><i class="far fa-question-circle"></i> More Information</a>
                  </div>
                </div>
              </div>
            </div>
      </div>
    </section>
@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
<script>
  var balance_chart = document.getElementById("deposit-chart").getContext('2d');
  var balance_chart_bg_color = balance_chart.createLinearGradient(0, 0, 0, 70);
  balance_chart_bg_color.addColorStop(0, 'rgba(63,82,227,.2)');
  balance_chart_bg_color.addColorStop(1, 'rgba(63,82,227,0)');
  var labels = '{{$depositDate}}';
  labels = labels.split(',');
  labels = labels.slice(0,labels.length-1)
  var myChart = new Chart(balance_chart, {
    type: 'line',
    data: {
      labels: labels,
      datasets: [{
        label: 'Amount',
        data: [{{$depositValue}}],
        backgroundColor: balance_chart_bg_color,
        borderWidth: 3,
        borderColor: 'rgba(63,82,227,1)',
        pointBorderWidth: 0,
        pointBorderColor: 'transparent',
        pointRadius: 3,
        pointBackgroundColor: 'transparent',
        pointHoverBackgroundColor: 'rgba(63,82,227,1)',
      }]
    },
    options: {
      layout: {
        padding: {
          bottom: -1,
          left: -1
        }
      },
      legend: {
        display: false
      },
      scales: {
        yAxes: [{
          gridLines: {
            display: false,
            drawBorder: false,
          },
          ticks: {
            beginAtZero: true,
            display: false
          }
        }],
        xAxes: [{
          gridLines: {
            drawBorder: false,
            display: false,
          },
          ticks: {
            display: false
          }
        }]
      },
    }
  });

  // Revenue Chart
var sales_chart = document.getElementById("sales-chart").getContext('2d');
var sales_chart_bg_color = sales_chart.createLinearGradient(0, 0, 0, 80);
balance_chart_bg_color.addColorStop(0, 'rgba(63,82,227,.2)');
balance_chart_bg_color.addColorStop(1, 'rgba(63,82,227,0)');
var labels = '{{$revenueDate}}';
labels = (labels.split(','))
labels = labels.slice(0,labels.length-1)
var myChart = new Chart(sales_chart, {
  type: 'line',
  data: {
    labels: labels,
    datasets: [{
      label: 'Amount',
      data: [{{$revenueValue}}],
      borderWidth: 2,
      backgroundColor: balance_chart_bg_color,
      borderWidth: 3,
      borderColor: 'rgba(63,82,227,1)',
      pointBorderWidth: 0,
      pointBorderColor: 'transparent',
      pointRadius: 3,
      pointBackgroundColor: 'transparent',
      pointHoverBackgroundColor: 'rgba(63,82,227,1)',
    }]
  },
  options: {
    layout: {
      padding: {
        bottom: -1,
        left: -1
      }
    },
    legend: {
      display: false
    },
    scales: {
      yAxes: [{
        gridLines: {
          display: false,
          drawBorder: false,
        },
        ticks: {
          beginAtZero: true,
          display: false
        }
      }],
      xAxes: [{
        gridLines: {
          drawBorder: false,
          display: false,
        },
        ticks: {
          display: false
        }
      }]
    },
  }
});
  // Reward Chart
var reward_chart = document.getElementById("reward-chart").getContext('2d');
var reward_chart_bg_color = reward_chart.createLinearGradient(0, 0, 0, 80);
balance_chart_bg_color.addColorStop(0, 'rgba(63,82,227,.2)');
balance_chart_bg_color.addColorStop(1, 'rgba(63,82,227,0)');
var labels = '{{$rewardDate}}';
labels = (labels.split(','))
labels = labels.slice(0,labels.length-1)
var myChart = new Chart(reward_chart, {
  type: 'line',
  data: {
    labels: labels,
    datasets: [{
      label: 'Amount',
      data: [{{$rewardValue}}],
      borderWidth: 2,
      backgroundColor: balance_chart_bg_color,
      borderWidth: 3,
      borderColor: 'rgba(63,82,227,1)',
      pointBorderWidth: 0,
      pointBorderColor: 'transparent',
      pointRadius: 3,
      pointBackgroundColor: 'transparent',
      pointHoverBackgroundColor: 'rgba(63,82,227,1)',
    }]
  },
  options: {
    layout: {
      padding: {
        bottom: -1,
        left: -1
      }
    },
    legend: {
      display: false
    },
    scales: {
      yAxes: [{
        gridLines: {
          display: false,
          drawBorder: false,
        },
        ticks: {
          beginAtZero: true,
          display: false
        }
      }],
      xAxes: [{
        gridLines: {
          drawBorder: false,
          display: false,
        },
        ticks: {
          display: false
        }
      }]
    },
  }
});
  
    var bitcoin = document.getElementById('bitcoin');
    var ether = document.getElementById('ether');
    var litecoin = document.getElementById('litecoin');
    var ripple = document.getElementById('ripple');
    var eos = document.getElementById('eos');
    var cardano = document.getElementById('cardano');
    const pricesWs = new WebSocket('wss://ws.coincap.io/prices?assets=bitcoin,ethereum,litecoin,ripple,eos,cardano')
    var rate;
    pricesWs.onmessage = function (msg) {
        rate =JSON.parse(msg.data);
        if(rate.bitcoin) update(bitcoin,rate.bitcoin);
        if(rate.ethereum) update(ether,rate.ethereum);
        if(rate.litecoin) update(litecoin,rate.litecoin);
        if(rate.ripple) update(ripple,rate.ripple);
        if(rate.eos) update(eos,rate.eos);
        if(rate.cardano) update(cardano,rate.cardano);
    }
    function update(el,price){
        if(el.innerHTML > price){
          el.parentNode.parentNode.classList.add('alert-danger');
          el.parentNode.parentNode.classList.remove('alert-success');
        } else {
          el.parentNode.parentNode.classList.remove('alert-danger');
          el.parentNode.parentNode.classList.add('alert-success');
        }
        el.innerHTML = Number.parseFloat(price).toFixed(4) + ' $';
  }
  const userAction = async () => {
      const bitAPI = await fetch('https://api.coincap.io/v2/rates');
      const myBit = await bitAPI.json(); 
      // do something with myJson
      update(this.bitcoin,(myBit.data.find(el => el.id == "bitcoin")).rateUsd)
      update(this.ether,(myBit.data.find(el => el.id == "ethereum")).rateUsd)
      update(this.litecoin,(myBit.data.find(el => el.id == "litecoin")).rateUsd)
      update(this.eos,(myBit.data.find(el => el.id == "eos")).rateUsd)
  }
(userAction)()
</script>
@endsection