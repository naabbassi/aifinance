@extends('admin/layout')
@section('title')
    Admin :: Users
@endsection
@section('content')
<div class="section">
    <div class="section-header">
        <h1>Users</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="/admin">Admin Panel</a></div>
              <div class="breadcrumb-item">Users</div>
            </div>
    </div>
    <div class="row">
          {{-- deposits table --}}
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4>Users</h4>
              </div>
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table table-striped">
                    <tbody><tr>
                      <th>User</th>
                      <th>Email</th>
                      <th>Owner</th>
                      <th>Type</th>
                      <th>User Type</th>
                      <th>User Activate</th>
                      <th>Deposit</th>
                      <th>Action</th>
                    </tr>
                    @foreach ($users as $user)
                    <tr>
                          <td class="align-middle">
                            {{$user->fullname()}}
                          </td>
                          <td class="align-middle">
                            {{$user->email }}
                          </td>
                          <td class="align-middle">
                            @if ($user->owner)
                            {{$user->owner }} 
                            @else 
                              <span class="text-danger">Administrator</span>
                            @endif
                          </td>
                          <td>
                            @switch($user->type)
                              @case('1')
                                <span class="text-success">Real</span>
                              @break
                              @case('0')
                                <span class="text-danger" >Fake</span>
                              @break
                              @default
                                .... 
                            @endswitch
                          </td>
                          <td>
                              @if ($user->isAdmin)
                                <span class="badge badge-success">Admin</span>
                                @else
                                <span class="badge badge-info" >User</span>
                              @endif
                          </td>
                          <td>
                            @switch($user->enabled)
                              @case('1')
                                <span class="text-success">Active</span>
                              @break
                              @case('0')
                                <span class="text-danger" >Disabled</span>
                              @break
                              @default
                                .... 
                            @endswitch
                          </td>
                          <td>{{$user->deposit()->sum('amount')}}$</td>
                          <td class="options">
                              <div class="dropdown">
                                  <a href="#" data-toggle="dropdown" class="btn btn-primary " aria-expanded="false"> ⋮ </a>
                                  <div class="dropdown-menu" x-placement="top-start" style="position: absolute; transform: translate3d(0px, -6px, 0px); top: 0px; left: 0px; will-change: transform;">
                                  <a href="/admin/users/{{$user->id}}" class="dropdown-item has-icon text-info"><i class="fas fa-eye"></i> View</a>
                                    <div class="dropdown-divider"></div>
                                  <a href="#" class="dropdown-item has-icon text-danger"  onclick="disableUser('{{$user->id}}')" ><i class="fas fa-exclamation"></i>{{ $user->enabled ? 'Disable User' : 'Enable User'}}</a>
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
      function disableUser(userId){
        swal({
          title: 'Are you sure to to change the user status?',
          text: '',
          icon: 'warning',
          buttons: true,
          dangerMode: true,
        })
        .then((change) => {
          if (change) {
            applyStatusChange(userId)
          }
        });
      }
      async function applyStatusChange(userId){
        result = await fetch("{{ route('home') }}/admin/users/active/" + userId,{
          method: 'POST', // or 'PUT'
            body: JSON.stringify({'_token': '{{csrf_token()}}'}), // data can be `string` or {object}!
            headers: {
              'Content-Type': 'application/json'
            }
        });
        if(result.status == 200){
          swal('Report the issue', 'User activation status is changed', 'success');
        }
      }
    </script>
@endsection