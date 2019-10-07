@extends('layout');
@section('title')
    AIF :: Deposit
@endsection
@section('content')
        <div class="section">
            <div class="section-header">
                <h1>Deposits</h1>
                <div class="section-header-breadcrumb">
                  <div class="breadcrumb-item active"><a href="/dashboard">Dashboard</a></div>
                  <div class="breadcrumb-item">My Deposits</div>
                </div>
              </div>
                <div class="row">
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
                                    <label for="customRange2 p-2">Move the range to change the amount</label>
                                    <input type="range" class="custom-range pb-2" id="range" value="250" min="250" max="50000" >
                                    <form action="/deposit/submit_deposit" method="post">
                                      @csrf
                                    <div class="row mt-2">
                                      <div class="col-6 col-md-6 col-xl-3">
                                        <div class="card card-primary">
                                          <div class="card-body">
                                            <h6 class="text-center text-dark" ><input type="number" name="usd" id="usd" class="form-control"></h6>
                                            <p class="text-center">Amount in USD</p>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-6 col-md-6 col-xl-3">
                                          <div class="card card-primary">
                                            <div class="card-body">
                                              <h6 class="text-center text-dark" id="rate"></h6>
                                              <p class="text-center">Btc Rate</p>
                                            </div>
                                          </div>
                                        </div> 
                                      <div class="col-6 col-md-6 col-xl-3">
                                          <div class="card card-primary">
                                            <div class="card-body">
                                              <h6 class="text-center text-dark" id="btc" value="{{ old('btc')}}"></h6>
                                              <input type="hidden" name="btc" id="btc_input" >
                                              <p class="text-center">amount in Bitcoin</p>
                                            </div>
                                          </div>
                                        </div> 
                                      <div class="col-6 col-md-6 col-xl-3">
                                          <div class="card card-primary">
                                            <div class="card-body">
                                              <h6 class="text-center text-dark" id="revenue"></h6>
                                              <p class="text-center">Mon.revenue</p>
                                            </div>
                                          </div>
                                        </div> 
                                        <div class="col-12 col-md-12 col-xl-6 " id="qrcode"></div>
                                        <div class="col-12 col-md-12 col-xl-6 p-4">
                                          <form action="/financial/deposit/submit_request" method="post">
                                            <div class="form-group">
                                              <label for="">Your Wallet Address: <a href=""></a></label>
                                            <input class="form-control" type="text" name="wallet_address" id="address" value="{{ old('wallet_address')}}">
                                                  @error('wallet_address')
                                                    <small class="form-text text-danger">{{ $message }}</small>
                                                  @enderror
                                                <h6 class="text-dark p-2">Wallet Address and amount to pay: </h6>
                                                <h6 class="text-info p-2" id="link"></h6>
                                                <input class="btn btn-primary" type="submit" value="Submit your payment">
                                            </div>
                                          </form>
                                        </div>
                                      </div>
                              </div>
                            </div>
                          </div>

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
                                      <th>Due to</th>
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
                                            @switch($item->type)
                                            @case('w')
                                            <span class="text-success">Withdraw</span>
                                            @break
                                            @case('d')
                                            <span class="text-info">Deposit</span>
                                            @break
                                            @default
                                            .... 
                                            @endswitch
                                            
                                          </td>
                                          <td>
                                              {{ date_format($item->created_at,'d M. Y') }}
                                          </td>
                                          @if ($item->status)
                                              <td><div class="badge badge-success">Accepted</div></td>    
                                              @else
                                              <td><div class="badge badge-warning">Pending</div></td>
                                          @endif
                                          <td>
                                              <div class="dropdown">
                                                  <a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle" aria-expanded="false">Options</a>
                                                  <div class="dropdown-menu" x-placement="top-start" style="position: absolute; transform: translate3d(0px, -6px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                    <a href="#" class="dropdown-item has-icon text-info"><i class="fas fa-eye"></i> View</a>
                                                    <a href="#" class="dropdown-item has-icon text-warning"><i class="fas fa-exclamation"></i> Report an issue</a>
                                                  </div>
                                                </div>
                                          </td>
                                        </tr>
                                  @endforeach
                                  </tbody>
                                </table>
                                <div class="p-2">{!! $deposits->render() !!}</div>
                                </div>
                              </div>
                            </div>
                          </div>
                </div>    
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
    </style>
@endsection
@section('script')
<script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
<script>
    var qrcode = new QRCode("qrcode");
    var exchangeRate = 0;
    var val = 0;
    var walletAddress = "1P9DcGZEjxBd8oUGfi862JdBYVrw3cg8ML";
    $(document).on('input', '#range', function() {
        val = $(this).val();
        generateQR(val);
    });
    $(document).on('input', '#usd', function() {
        val = $(this).val();
        document.getElementById('range').value = val;
        generateQR(val);
    });
    (function(){
      generateQR(250);
    })();
  function generateQR(amount){
    let url = 'https://api.coincap.io/v2/rates/bitcoin';
    fetch(url)
      .then(res => res.json())
      .then((out) => {
        exchangeRate = Number.parseFloat(out.data.rateUsd).toFixed(4);
        var btc =(amount / exchangeRate).toFixed(5);
        qrcode.makeCode(walletAddress + btc);
        document.getElementById('rate').innerHTML = '1 BTC = ' + exchangeRate + '$';
        document.getElementById('usd').value = amount ;
        document.getElementById('btc').innerHTML = btc + '₿';
        document.getElementById('btc_input').value = (amount / exchangeRate);
        document.getElementById('link').innerHTML = walletAddress;
        document.getElementById('revenue').innerHTML = (amount * 0.075).toFixed(0) +' $';
      })
      .catch(err => { throw err });
    }
</script>
@endsection