@extends('admin/layout')
@section('title')
    Admin :: Deposits
@endsection 
@section('content')
    <div class="section">
        <div class="section-header">
            <h1>Deposits</h1>
                <div class="section-header-breadcrumb">
                  <div class="breadcrumb-item active"><a href="/admin">Admin Panel</a></div>
                  <div class="breadcrumb-item">My Deposits</div>
                </div>
        </div>
        <div class="row">
              {{-- deposits table --}}
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Deposits</h4>
                    <div class="card-header-action">
                      <span href="#" class="badge badge-secondary">
                          Approved Amount : {{money_format('%i',$depositsSum)}}
                      </span>
                    </div>
                  </div>
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
                            <td><a class="badge btn btn-outline-info" href="/admin/users/{{$item->uid}}">{{$user->name.' '.$user->family}}</a></td>
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
                    {{-- <div class="p-2">{!! $deposits->render() !!}</div> --}}
                    </div>
                  </div>
                </div>
              </div>
  
        </div>
    </div>
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