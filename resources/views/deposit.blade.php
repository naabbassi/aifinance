@extends('layout');
@section('title')
    AIF :: Deposit
@endsection
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Deposits</h1>
                <div class="section-header-breadcrumb">
                  <div class="breadcrumb-item active"><a href="/dashboard">Dashboard</a></div>
                  <div class="breadcrumb-item">My Deposits</div>
                </div>
              </div>
                <div class="row">
                        {{-- deposits table --}}
                        <div class="col-12 col-md-12 col-lg-6 ">
                          <div class="card">
                            <div class="card-header">
                              <h4>My Deposits</h4>
                            </div>
                            <div class="card-body p-0">
                              <div class="table-responsive">
                                <table class="table table-striped">
                                  <tbody><tr>
                                    <th>Amount</th>
                                    <th>Members</th>
                                    <th>Due Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                  </tr>
                                  @foreach ($deposits as $item)
                                  <tr>
                                        <td class="align-middle">
                                          {{$item->usd }} $
                                        </td>
                                        <td>
                                          {{$item->btc }} ₿
                                        </td>
                                        <td>
                                            {{ date_format($item->created_at,'d M. Y') }}
                                        </td>
                                        @if ($item->type == 'true')
                                            <td><div class="badge badge-success">Accepted</div></td>    
                                            @else
                                            <td><div class="badge badge-warning">Pending</div></td>
                                        @endif
                                        <td><a href="#" class="btn btn-primary">Detail</a></td>
                                      </tr>
                                @endforeach
                                </tbody></table>
                              </div>
                            </div>
                          </div>
                        </div>
                        {{-- Investment section --}}
                        <div class="col-12 col-md-12 col-lg-6 ">
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
                                    <input type="range" class="custom-range" id="range" value="250" min="0" max="50000" >
                                    <div class="row mt-4">
                                      <div class="col-6 col-md-6 col-lg-3">
                                        <div class="card card-primary">
                                          <div class="card-body">
                                            <h6 class="text-center text-dark" id="usd"></h6>
                                            <p class="text-center">Investment</p>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-6 col-md-6 col-lg-3">
                                          <div class="card card-primary">
                                            <div class="card-body">
                                              <h6 class="text-center text-dark" id="rate"></h6>
                                              <p class="text-center">Btc Rate</p>
                                            </div>
                                          </div>
                                        </div> 
                                      <div class="col-6 col-md-6 col-lg-3">
                                          <div class="card card-primary">
                                            <div class="card-body">
                                              <h6 class="text-center text-dark" id="btc"></h6>
                                              <p class="text-center">amount in Bitcoin</p>
                                            </div>
                                          </div>
                                        </div> 
                                      <div class="col-6 col-md-6 col-lg-3">
                                          <div class="card card-primary">
                                            <div class="card-body">
                                              <h6 class="text-center text-dark" id="revenue"></h6>
                                              <p class="text-center">Mon.revenue</p>
                                            </div>
                                          </div>
                                        </div> 
                                        <div class="col-6 " id="qrcode"></div>
                                        <div class="col-6">
                                          <h6 class="text-info">Wallet Address and amount to pay: </h6><p class="text-danger" id="link"></p>
                                        </div>
                                      </div>
                              </div>
                            </div>
                          </div>
                </div>    
        </section>
    </div>
    <style>
      #qrcode {
        
        margin-bottom: 4em;
        width:200px;
        height:200px;
              }
              .rates{
                margin-top: 1em !important;
              }
              .link{

              }
    </style>

@endsection
@section('script')
<script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
<script>
    var qrcode = new QRCode("qrcode");
    var exchangeRate = 0;
    var val = 0;
    var walletAddress = "bitcoin:3FkenCiXpSLqD8L79intRNXUgjRoH9sjXa?";
    $(document).on('input', '#range', function() {
        val = $(this).val();
        generateQR(val);
    });
    (function(){
      generateQR(250);
    })();
  function generateQR(amount){
    let url = 'https://bitpay.com/api/rates';
    fetch(url)
      .then(res => res.json())
      .then((out) => {
        exchangeRate = (out[2]['rate']);
        var btc =(amount / exchangeRate).toFixed(5);
        qrcode.makeCode(walletAddress + btc);
        document.getElementById('rate').innerHTML = '1 BTC = ' + out[2]['rate'] + ' $';
        document.getElementById('usd').innerHTML = amount + ' $';
        document.getElementById('btc').innerHTML = btc + '₿';
        document.getElementById('link').innerHTML = walletAddress + btc;
        document.getElementById('revenue').innerHTML = (amount * 0.075).toFixed(0) +' $';
      })
      .catch(err => { throw err });
    }
</script>
@endsection