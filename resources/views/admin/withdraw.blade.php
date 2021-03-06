@extends('admin/layout')
@section('title')
    Admin :: Withdraws
@endsection
@section('content')
<div class="section">
        <div class="section-header">
            <h1>Withdraws</h1>
                <div class="section-header-breadcrumb">
                  <div class="breadcrumb-item active"><a href="/admin">Admin Panel</a></div>
                  <div class="breadcrumb-item">Withdraws</div>
                </div>
        </div>
        <div class="row">
              {{-- deposits table --}}
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Withdraws</h4>
                  </div>
                  <div class="card-body p-0">
                    <div class="table-responsive">
                      <table class="table table-striped">
                        <tbody><tr>
                          <th>#</th>
                          <th>User</th>
                          <th>Amount</th>
                          <th>Withdraw Type</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                        @foreach ($withdraw as $i => $item)
                        <tr>
                              <td>{{ $i+1 }}</td>
                        <td><a href="/admin/users/{{$item->uid}}">{{ App\User::find($item->uid)->fullname() }}</a></td>
                        <td>{{$item->amount}}$</td>
                              <td>
                                @switch($item->type)
                                    @case('w')
                                    <span class="badge badge-danger">Wallet</span>
                                        @break
                                    @case('d')
                                    <span class="badge badge-success">Deposit</span>
                                        @break
                                    @default
                                    <span class="badge badge-warning">Unknown</span>
                                @endswitch
                              </td>
                              <td>
                                @switch($item->status)
                                    @case('0')
                                    <span class="badge badge-warning">Pending</span>
                                        @break
                                    @case('1')
                                    <span class="badge badge-success">Confirmed</span>
                                        @break
                                    @default
                                    <span class="badge badge-danger">Unknown</span>
                                @endswitch
                              </td>
                              <td class="options">
                                  <div class="dropdown">
                                      <a href="#" data-toggle="dropdown" class="btn btn-primary " aria-expanded="false"> ⋮ </a>
                                      <div class="dropdown-menu" x-placement="top-start" style="position: absolute; transform: translate3d(0px, -6px, 0px); top: 0px; left: 0px; will-change: transform;">
                                        <a href="#" class="dropdown-item has-icon text-info" onclick="getWithdrawDetails('{{$item->id}}')"><i class="fas fa-eye"></i> View</a>
                                        <div class="dropdown-divider"></div>
                                        <a href="#" class="dropdown-item has-icon text-danger" onclick="confirmWithdraw('{{$item->id}}')"><i class="far fa-trash-alt"></i> Confirm</a>
                                      </div>
                                    </div>
                              </td>
                            </tr>
                      @endforeach
                      </tbody>
                    </table>
                    {{-- <div class="p-2">{!! $deposits->render() !!}</div> --}}
                    </div>
                  </div>
                </div>
              </div>
    
        </div>
    </div>
        <!-- Modal -->
<div class="modal fade details-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Withdraw's Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p class="font-weight-bold">Amount : <span id="amount" class="font-weight-bold"></span></p>
        <p class="font-weight-bold">Type : <span id="type"></span></p>
        <p class="font-weight-bold">wallet : <span id="wallet" class="font-weight-bold text-primary"></span></p>
        <p class="font-weight-bold">status : <span id="status"></span></p>
        <p class="font-weight-bold">Date : <span id="date"></span></p>
        <p class="font-weight-bold">approved by : <span id="approvedBy"></span></p>
      </div>
    </div>
  </div>
</div>

@endsection
@section('script')
    <script>
      async function getWithdrawDetails(e){
        const data = {
            '_token': '{{csrf_token()}}',
            id: e
          }
      const response = await fetch('{{ route("home") }}/admin/withdraw/details',
         {
            method: 'POST', // or 'PUT'
            body: JSON.stringify(data), // data can be `string` or {object}!
            headers: {
              'Content-Type': 'application/json'
            }
          });
        if(response.status == 200){
          result = await response.json();
          br = '<br>';
          result = result[0];
         document.getElementById('amount').innerHTML = result.amount;
         document.getElementById('type').innerHTML = result.type == 'w' ? 'withdraw to Wallet' : 'withdraw to deposit';
         document.getElementById('wallet').innerHTML = result.address;
         document.getElementById('status').innerHTML = result.status ? 'Approved' : 'Pending';
         document.getElementById('date').innerHTML = result.created_at;
         document.getElementById('approvedBy').innerHTML = result.approvedBy;
         $('.details-modal').modal('show');
        }
      }

      async function confirmWithdraw(e){
        const data = {
            '_token': '{{csrf_token()}}',
            id: e
          };
          const response = await fetch('{{ route("home") }}/admin/withdraw/confirm',{
            method:'PUT',
            body : JSON.stringify(data),
            headers:{
              'Content-Type':'application/json'
            }
          });
          if(response.status == 200){
            swal('Withdraw Confirmation', 'withdraw is confirmed', 'success');
          }
      }
    </script>
@endsection