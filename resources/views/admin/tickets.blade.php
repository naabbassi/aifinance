@extends('admin/layout')
@section('title')
    Admin :: Tickets
@endsection
@section('content')
<div class="section">
        <div class="section-header">
            <h1>Tickets</h1>
                <div class="section-header-breadcrumb">
                  <div class="breadcrumb-item active"><a href="/admin">Admin Panel</a></div>
                  <div class="breadcrumb-item">Tickets</div>
                </div>
        </div>
        <div class="row">
              {{-- deposits table --}}
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Tickets</h4>
                  </div>
                  <div class="card-body p-0">
                    <div class="table-responsive">
                      <table class="table table-striped" id="issueTable">
                        <tbody><tr>
                          <th>Ticket ID</th>
                          <th>Issue Type</th>
                          <th>User</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                        @foreach ($tickets as $item)
                        <tr>
                              <td class="align-middle">
                                {{ $item->id }}
                              </td>
                              <td>
                                @switch($item->type)
                                    @case('c')
                                    <span class="badge badge-info">Custome</span>
                                        @break
                                    @case('d')
                                    <span class="badge badge-success">Deposit</span>
                                        @break
                                    @case('r')
                                    <span class="badge badge-secondary">Revenue</span>
                                        @break
                                    @case('w')
                                    <span class="badge badge-secondary">Withdraw</span>
                                        @break
                                    @default
                                    <span class="badge badge-danger">Unknown</span>
                                @endswitch
                              </td>
                              <td class="align-middle">
                                @php
                                    $user = App\user::find($item->uid)
                                @endphp
                                <a href="/admin/user/{{$item->uid}}">{{$user->name }}</a>
                              </td>
                              <td>
                                  @if ($item->status)
                                    <span class="badge badge-success">Open</span>
                                    @else
                                    <span class="badge badge-danger" >Close</span>
                                  @endif
                              </td>
                              <td class="options">
                                  <div class="dropdown">
                                      <a href="#" data-toggle="dropdown" class="btn btn-light" aria-expanded="false"> ⋮ </a>
                                      <div class="dropdown-menu" x-placement="top-start" style="position: absolute; transform: translate3d(0px, -6px, 0px); top: 0px; left: 0px; will-change: transform;">
                                        <a href="/admin/tickets/{{$item->id}}" class="dropdown-item has-icon "><i class="fas fa-book-open"></i> View Ticket</a>
                                        <div class="dropdown-divider"></div>
                                      <a href="#" class="dropdown-item has-icon text-danger" id="closeIssue" data-id="{{$item->id}}"><i class="far fa-bell-slash"></i>Close the Ticket</a>
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
     $("#issueTable").on('click','#closeIssue',function(e) {
            var id = e.currentTarget.dataset.id;
        swal({
            title: 'Are you sure to close this issue?',
            text: '',
            icon: 'warning',
            buttons: true,
            dangerMode: true,
          })
          .then((result) => {
            if (result) {
                closeIssue(id)
                swal('The issue has been closed!', {
                icon: 'success',
              });
            }
          });
      });
      function closeIssue(id){
        $.ajax({
        method: "POST",
          data:{
            '_token': '{{csrf_token()}}',
            id: id
          },
        url: "{{ route('home') }}/issue/closeIssue",
        }).done(function(result) {
          if(result){
            return true;
          } else{
            return false;
          }
         });
      }</script>
@endsection 