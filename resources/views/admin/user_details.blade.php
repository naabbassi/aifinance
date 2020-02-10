@extends('admin/layout')
@section('title')
    AIF :: User Profile
@endsection
@section('content')
<div class="card">
  <div class="card-header">
    <h4>User Details</h4>
</div>
  <div class="card-body">
    <div id="accordion">
      <div class="accordion">
          <div class="accordion-header bg-success text-white" role="button" data-toggle="collapse" data-target="#panel-body-1" aria-expanded="false">
            <h4 class="">Personal Information</h4>
          </div>
          <div class="accordion-body collapse " id="panel-body-1" data-parent="#accordion">
            <form method="POST" action="/admin/users/update/{{$user->id}}">
              @csrf
              <div class="row">
                <div class="form-group col-6">
                  <label for="name">First Name</label>
                  <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" autofocus>
                  @error('name')
                    <small class="form-text text-danger ">{{ $message }}</small>
                   @enderror
                </div>
                <div class="form-group col-6">
                  <label for="family">Last Name</label>
                  <input id="family" type="text" class="form-control" name="family" value="{{ $user->family }}">
                  @error('family')
                    <small class="form-text text-danger ">{{ $message }}</small>
                   @enderror
                </div>
              </div>
              <div class="row">
                  <div class="form-group col-6">
                      <label >Birthday</label>
                      @php
                          $date = new DateTime($user->birthday);
                      @endphp
                      <input type="date" name="birthday" class="form-control" value="{{ $date->format('Y-m-d')}}">
                      @error('birthday')
                    <small class="form-text text-danger ">{{ $message }}</small>
                   @enderror
                    </div>
                <div class="form-group col-6">
                    <label>Gender</label>
                    <select class="form-control selectric" name="sex">
                        <option @if($user->sex == 'm') selected @endif value="m">Man</option>
                        <option @if($user->sex == 'w') selected @endif value="w">Woman</option>
                      </select>
                      @error('sex')
                        <small class="form-text text-danger ">{{ $message }}</small>
                      @enderror
                  </div>
                </div>
              <div class="row">
                <div class="form-group col-6">
                  <label>Country</label>
                  <select class="form-control selectric" name="country">
                    @foreach ($countries as $item)
                    <option @if($user->country == $item->id) selected @endif value={{$item->id}}>{{$item->name}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group col-6">
                    <label>Phone</label>
                    <input type="text" name="phone" class="form-control" value="{{ $user->phone }}">
                    @error('phone')
                    <small class="form-text text-danger ">{{ $message }}</small>
                   @enderror
                  </div>
                  <div class="form-group col-6">
                    <label class="d-block">Is Admin</label>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="is_admin" {{$user->isAdmin == 1 ? 'checked' : null}}>
                      <label class="form-check-label" for="defaultCheck1">
                        Is Admin
                      </label>
                    </div>
                  </div>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-primary ">
                  Update information
                </button>
              </div>
            </form>
          </div>
        </div>
        <div class="accordion">
          <div class="accordion-header bg-danger" role="button" data-toggle="collapse" data-target="#panel-body-2" aria-expanded="false">
            <h4 class="text-white">Change Password</h4>
          </div>
          <div class="accordion-body collapse " id="panel-body-2" data-parent="#accordion">
          <form method="POST" action="/admin/users/{{$user->id}}">
              @csrf
              <div class="row">
                <div class="form-group col-6">
                  <label>New Password</label>
                  <input  type="password" class="form-control" name="password" value="{{ old('password') }}">
                  @error('password')
                    <small class="form-text text-danger ">{{ $message }}</small>
                   @enderror
                </div>
                <div class="form-group col-6">
                  <label >Repeat Password</label>
                  <input  type="password" class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}">
                  @error('password_confirmation')
                    <small class="form-text text-danger ">{{ $message }}</small>
                   @enderror
                </div>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-primary ">
                  Change Password
                </button>
              </div>
            </form>
          </div>
        </div>
      
        <div class="accordion">
          <div class="accordion-header" role="button" data-toggle="collapse" data-target="#panel-body-3" aria-expanded="false">
            <h4>Deposits</h4>
          </div>
          <div class="accordion-body collapse " id="panel-body-3" data-parent="#accordion">
            <div class="table-responsive">
              <table class="table table-striped" id="depositTable">
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
            <span href="#" class="badge badge-secondary ">
              Approved Amount : {{money_format('%i',$sum)}}
           </span>
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