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
          {{--  Deposit  --}}
          <div class="card col-12 col-md-12 col-lg-12 p-0">
              <span class="badge badge-secondary">Deposits</span>
              <div class="card-body p-0">
                  <div class="table-responsive">
                    <table class="table table-striped" id="depositTable">
                      <tbody><tr>
                        <th>Amount</th>
                        <th>Due to</th>
                        <th>Due Date</th>
                        <th>Status</th>
                        <th>User</th>
                        <th>Action</th>
                      </tr>
                      @foreach ($deposits as $item)
                      <tr>
                            <td class="align-middle">
                              {{$item->amount }} $
                            </td>
                            <td>
                              @switch($item->type)
                                @case('w')
                                  <span>Withdraw</span>
                                @break
                                @case('d')
                                  <span >Request</span>
                                @break
                                @default
                                  .... 
                              @endswitch
                            </td>
                            <td>
                                {{ date_format($item->created_at,'d M. Y') }}
                            </td>
                            <td>
                              @if ($item->status)
                                  <span class="badge badge-success">Accepted</span>
                                @else
                                  <span class="badge badge-warning">Pending</span>
                              @endif  
                            </td>
                            @php
                                $user =  App\user::find($item->uid);
                            @endphp
                          <td><a class="badge btn btn-outline-info" href="/admin/user/{{$item->uid}}">{{$user->name.' '.$user->family}}</a></td>
                            <td class="options">
                                <div class="dropdown">
                                    <a href="#" data-toggle="dropdown" class="btn btn-primary " aria-expanded="false"> ⋮ </a>
                                    <div class="dropdown-menu" x-placement="top-start" style="position: absolute; transform: translate3d(0px, -6px, 0px); top: 0px; left: 0px; will-change: transform;">
                                      <a href="#" class="dropdown-item has-icon text-info"><i class="fas fa-eye"></i> View</a>
                                      <div class="dropdown-divider"></div>
                                    <a href="#" class="dropdown-item has-icon text-warning" id="confirmItem" data-id="{{$item->id}}"  ><i class="fas fa-exclamation"></i>Confirm Payment</a>
                                    </div>
                                  </div>
                            </td>
                          </tr>
                    @endforeach
                    </tbody>
                  </table>
                  </div>
                </div>
          </div>
          {{--  Open Tickets Table --}}
          <div class="card col-12 col-md-12 col-lg-12 p-0">
            <span class="badge badge-secondary">Open Tickets</span>
              <div class="card-body p-0">
                  <div class="table-responsive">
                    <table class="table table-striped" id="depositTable">
                      <tbody><tr>
                        <th>Issue Type</th>
                        <th>User</th>
                        <th>Created At</th>
                        <th>Action</th>
                      </tr>
                      @foreach ($tickets as $item)
                      <tr>
                            <td>
                              @switch($item->type)
                                @case('w')
                                  <span class="badge btn btn-sm btn-outline-success">Withdraw</span>
                                @break
                                @case('r')
                                  <span class="badge btn btn-sm btn-outline-success">Revenue</span>
                                @break
                                @case('c')
                                  <span class="badge btn btn-sm btn-outline-success">Custom</span>
                                @break
                                @default
                                  .... 
                              @endswitch
                            </td>
                            @php
                                $user =  App\user::find($item->uid);
                            @endphp
                          <td><a class="badge btn btn-sm btn-outline-info" href="/admin/users/{{$item->uid}}">{{$user->name.' '.$user->family}}</a></td>
                            <td>
                                {{ date_format($item->created_at,'d M. Y') }}
                            </td>
                            <td class="options">
                                <div class="dropdown">
                                    <a href="#" data-toggle="dropdown" class="btn btn-primary " aria-expanded="false"> ⋮ </a>
                                    <div class="dropdown-menu" x-placement="top-start" style="position: absolute; transform: translate3d(0px, -6px, 0px); top: 0px; left: 0px; will-change: transform;">
                                      <a href="/admin/tickets/{{$item->id}}" class="dropdown-item has-icon text-info"><i class="fas fa-eye"></i> View</a>
                                    </div>
                                  </div>
                            </td>
                          </tr>
                    @endforeach
                    </tbody>
                  </table>
                  </div>
                </div>
          </div>
</div>
      </section>
@endsection 
@section('script')
    <script>
      $("#depositTable").on('click','#confirmItem',function(e) {
        var id = e.currentTarget.dataset.id;
      swal({
          title: 'Are you sure to confirm this payment?',
          text: '',
          icon: 'warning',
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            confirmAction(id)
          }
        });
      })
      const confirmAction = async (e) => {
        const data = {
            '_token': '{{csrf_token()}}',
            deposit_id: e
          }
      const response = await fetch('{{ route("home") }}/admin/deposit/confirm/',
         {
            method: 'POST', // or 'PUT'
            body: JSON.stringify(data), // data can be `string` or {object}!
            headers: {
              'Content-Type': 'application/json'
            }
          });
      if(await response){
        swal('Deposit Confirmation!', 'Confirmation done successfully', 'success');
      } else {
        swal('Deposit Confirmation!', 'Opps! apparently something went wrong', 'info');
      }
  }
    </script>
@endsection