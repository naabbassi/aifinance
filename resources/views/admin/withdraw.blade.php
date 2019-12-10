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
                        <td><a href="/admin/users/{{$item->uid}}">{{ App\User::find($item->uid)->name}}</a></td>
                              <td>
                                @switch($item->type)
                                    @case('w')
                                    <span class="badge badge-danger">Wallet</span>
                                        @break
                                    @case('d')
                                    <span class="badge badge-success">Deposit</span>
                                        @break
                                    @default
                                    <span class="badge badge-danger">Unknown</span>
                                @endswitch
                              </td>
                              <td>
                                @switch($item->status)
                                    @case('0')
                                    <span class="badge badge-warning">Pending</span>
                                        @break
                                    @case('d')
                                    <span class="badge badge-success">Done</span>
                                        @break
                                    @default
                                    <span class="badge badge-danger">Unknown</span>
                                @endswitch
                              </td>

                            <td>{{$item->amount}}$</td>
                              <td class="options">
                                  <div class="dropdown">
                                      <a href="#" data-toggle="dropdown" class="btn btn-primary " aria-expanded="false"> ⋮ </a>
                                      <div class="dropdown-menu" x-placement="top-start" style="position: absolute; transform: translate3d(0px, -6px, 0px); top: 0px; left: 0px; will-change: transform;">
                                        <a href="#" class="dropdown-item has-icon text-info"><i class="fas fa-eye"></i> View</a>
                                        <div class="dropdown-divider"></div>
                                      <a href="#" class="dropdown-item has-icon text-warning" data-toggle="modal" data-target=".issue-modal"  ><i class="fas fa-exclamation"></i> Report an issue</a>
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