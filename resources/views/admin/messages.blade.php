@extends('admin/layout')
@section('title')
    Admin :: Messages
@endsection
@section('content')
<div class="section">
<div class="section-header">
    <h1>Messages</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="/admin">Admin Panel</a></div>
          <div class="breadcrumb-item">Messages</div>
        </div>
</div>
<div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4>Messages</h4>
          </div>
          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table table-striped" id="issueTable">
                <tbody><tr>
                  <th>Msg ID</th>
                  <th>Sender</th>
                  <th>Email</th>
                  <th>Message</th>
                  <th>At</th>
                  <th>Action</th>
                </tr>
                @foreach ($msgs as $item)
                <tr>
                      <td class="align-middle">
                        {{ $item->id }}
                      </td>
                      <td>{{ $item->name}}</td>
                      <td>{{ $item->email}}</td>
                      <td>{{ Str::limit($item->message,20) }}</td>
                      <td>{{ $item->created_at }}</td>
                      <td class="options">
                          <div class="dropdown">
                              <a href="#" data-toggle="dropdown" class="btn btn-light" aria-expanded="false"> ⋮ </a>
                              <div class="dropdown-menu" x-placement="top-start" style="position: absolute; transform: translate3d(0px, -6px, 0px); top: 0px; left: 0px; will-change: transform;">
                                <a href="/admin/messages/{{$item->id}}" class="dropdown-item has-icon "><i class="fas fa-book-open"></i> View Message</a>
                                <div class="dropdown-divider"></div>
                              <a href="#" class="dropdown-item has-icon text-danger" id="closeIssue" data-id="{{$item->id}}"><i class="far fa-bell-slash"></i>Delete Message</a>
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
    
@endsection