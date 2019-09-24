@extends('layout');
@section('title')
    AIF :: Edit Wallet
@endsection 
@section('content')
    <div class="main-content">
        <div class="section">
                <div class="section-header">
                        <h1>Edit Wallet</h1>
                        <div class="section-header-breadcrumb">
                          <div class="breadcrumb-item active"><a href="/dashboard">Dashboard</a></div>
                          <div class="breadcrumb-item">Edit Wallet</div>
                        </div>
                      </div>
            <div class="row">
                <div class="col-12">
                <div class="card">
                    <div class="card-body">
                    <form action="/finance/wallet/update/{{$wallet->id}}" method="POST">
                                @csrf
                                <div class="form-group">
                                  <label for="address">Wallet address</label>
                                <input type="text" class="form-control" name="address" placeholder="Enter your wallet address" value="{{$wallet->address}}">
                                  <small class="form-text text-muted">Be sure that you enter the wallet address correctly.</small>
                                  @error('address')
                                     <small class="form-text ">{{ $message }}</small>
                                  @enderror
                                </div>
                                <div class="form-group">
                                  <label for="title">Wallet Name</label>
                                <input type="text" class="form-control" name="title" placeholder="Set a name to your wallet..." value="{{$wallet->title}}">
                                  @error('title')
                                     <small class="form-text ">{{ $message }}</small>
                                  @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                              </form>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
@endsection