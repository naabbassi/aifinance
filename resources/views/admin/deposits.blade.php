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
                    <h4>My Deposits</h4>
                    <div class="card-header-action">
                        <span href="#" class="badge badge-secondary">
                            Approved Amount :
                        </span>
                      </div>
                  </div>
                  <div class="card-body p-0">
                    <div class="table-responsive">
                      <table class="table table-striped">
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
                                      <a href="#" class="dropdown-item has-icon text-warning" data-toggle="modal" data-target=".issue-modal"  onclick="setIssueId({{$item->id}})" ><i class="fas fa-exclamation"></i> Report an issue</a>
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