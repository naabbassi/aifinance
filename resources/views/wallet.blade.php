@extends('layout')
@section('title')
    AIF :: My Wallets
@endsection 
@section('content')
<div class="main-content">
        <div class="section">
            <div class="section-header">
                <h1>My Wallets</h1>
                <div class="section-header-breadcrumb">
                  <div class="breadcrumb-item active"><a href="/dashboard">Dashboard</a></div>
                  <div class="breadcrumb-item">Wallet</div>
                </div>
              </div>
              <div class="row">
                <div class="col-12 col-md-12 col-lg-6">
                  <div class="card">
                    <div class="card-header">
                      <h4>Add Wallet</h4>
                    </div>
                    <div class="card-body">
                      <form action="/finance/wallet/new" method="POST">
                        @csrf
                        <div class="form-group">
                          <label for="address">Wallet address</label>
                          <input type="text" class="form-control" name="address" placeholder="Enter your wallet address">
                          <small class="form-text text-muted">Be sure that you enter the wallet address correctly.</small>
                          @error('address')
                             <small class="form-text ">{{ $message }}</small>
                          @enderror
                        </div>
                        <div class="form-group">
                          <label for="title">Wallet Name</label>
                          <input type="text" class="form-control" name="title" placeholder="Set a name to your wallet...">
                          @error('title')
                             <small class="form-text ">{{ $message }}</small>
                          @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </form>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-md-12 col-lg-6">
                  <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                              <tbody><tr>
                                <th>Wallet Name</th>
                                <th>Address</th>
                                <th>Created At</th>
                                <th>Action</th>
                              </tr>
                              @foreach ($wallets as $item)
                              <tr>
                                    <td class="align-middle">
                                      {{$item->title }}
                                    </td>
                                    <td>
                                      {{ substr($item->address, 0, 10) }} ...
                                    </td>
                                    <td>
                                        {{ date_format($item->created_at,'d M. Y') }}
                                    </td>
                                    <td>
                                    <a href="/finance/wallet/edit/{{$item->id}}" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Edit the Wallet"><i class="far fa-edit"></i></a>
                                      <a href="/finacne/wallet/delete/{{$item->id}}" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Delete the Wallet"><i class="far fa-trash-alt"></i></a>
                                      <a href="/finacne/wallet/show/{{$item->id}}" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Show wallet details"><i class="far fa-eye"></i></a>
                                    </td>
                                  </tr>
                            @endforeach
                            </tbody></table>
                          </div>
                    </div>
                  </div>
                </div>
              </div>
        </div>
</div>
@endsection