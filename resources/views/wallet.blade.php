@extends('layout')
@section('title')
    AIF :: My Wallets
@endsection 
@section('content')
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
                      <h4>Add New Wallet</h4>
                    </div>
                    <div class="card-body">
                      <form action="/finance/wallet/new" method="POST">
                        @csrf
                        <div class="form-group">
                          <label for="title">Wallet Name</label>
                          <input type="text" class="form-control" name="title" placeholder="Set a name to your wallet..." value="{{ old('title') }}">
                          @error('title')
                          <small class="form-text text-danger">{{ $message }}</small>
                          @enderror
                        </div>
                        <div class="form-group">
                          <label for="address">Wallet address</label>
                          <input type="text" class="form-control" name="address" placeholder="Enter your wallet address" value="{{ old('address') }}">
                          <small class="form-text text-muted">Be sure that you enter the wallet address correctly.</small>
                          @error('address')
                              <small class="form-text text-danger">{{ $message }}</small>
                          @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                      </form>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-md-12 col-lg-6">
                  <div class="card">
                      <div class="card-header">
                          <h4>My Wallets</h4>
                          <div class="card-header-action"></div>
                        </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped" id="walletTable">
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
                                        <div class="dropdown">
                                            <a href="#" data-toggle="dropdown" class="btn btn-primary" aria-expanded="false">⋮</a>
                                            <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, -6px, 0px); top: 0px; left: 0px; will-change: transform;">
                                              <a href="/finance/wallet/edit/{{$item->id}}" class="dropdown-item has-icon"><i class="far fa-edit"></i> Edit</a>
                                              <div class="dropdown-divider"></div>
                                              <a href="#" class="dropdown-item has-icon text-danger" id="deleteItem" data-id="{{$item->id}}"><i class="far fa-trash-alt"></i> Delete</a>
                                            </div>
                                          </div>
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
@endsection
@section('script')
  <script>
    $("#walletTable").on('click','#deleteItem',function(e) {
      var id = e.currentTarget.dataset.id;
      var el = e.currentTarget.parentNode.parentNode.parentNode.parentNode;
  swal({
      title: 'Are you sure to delete this wallet?',
      text: '',
      icon: 'warning',
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
          deleteItem(id)
          swal('Deleted! Your wallet has been deleted!', {
          icon: 'success',
        });
        el.remove();
      }
    });
});
function deleteItem(id){
        $.ajax({
        method: "POST",
          data:{
            '_token': '{{csrf_token()}}',
            id: id
          },
        url: "{{ route('home') }}/finance/wallet/delete",
        }).done(function(result) {
          if(result){
            return true;
          } else{
            return false;
          }
         });
      }
  </script>
@endsection 