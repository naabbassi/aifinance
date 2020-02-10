@extends('layout')
@section('title')
    AIF :: My Revenue
@endsection
@section('content')
        <div class="section">
                <div class="section-header">
                    <h1>Revenue Details</h1>
                    <div class="section-header-breadcrumb">
                        <div class="breadcrumb-item active"><a href="/dashboard">Dashboard</a></div>
                        <div class="breadcrumb-item">My Revenue</div>
                    </div>
                </div>
            <div class="row">
                <div class="col-12">
                        <div class="card">
                                <div class="card-header">
                                  <h4>Revenue Details</h4>
                                  <div class="card-header-action">
                                    <span href="#" class="badge badge-secondary">
                                    Total : {{$details->sum('amount')}}$
                                    </span>
                                  </div>
                                </div>
                                <div class="card-body p-0">
                                  <div class="table-responsive">
                                    <table class="table table-striped">
                                      <thead>
                                        <tr>
                                          <th class="text-center">
                                            #
                                          </th>
                                          <th>Source</th>
                                          <th>Description</th>
                                          <th>Amount</th>
                                          <th>Due to</th>
                                          <th>Due Date</th>
                                          <th>Action</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        @foreach ($details as $i => $item)
                                            <tr>
                                            <td>{{$i + 1 }}</td>
                                            <td title="{{$item->source}}">{{Str::limit($item->source,7)}}</td>
                                            <td>{{$revenue->description}}</td>
                                                <td class="align-middle">{{$item->amount}}$</td>
                                                <td >
                                                  @switch($revenue->type)
                                                      @case('d')
                                                          <span class="badge badge-primary">Deposit</span>
                                                          @break
                                                      @case('r')
                                                      <span class="badge badge-info">Reward</span>
                                                          @break
                                                      @default
                                                      <span class="badge badge-primary"></span>
                                                  @endswitch  
                                                </td>
                                                <td>{{ date_format($item->created_at,'d M Y')}}</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <a href="#" data-toggle="dropdown" class="btn btn-primary " aria-expanded="false"> ⋮ </a>
                                                        <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, -6px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                          <a href="#" class="dropdown-item has-icon" onclick="setIssueId('{{$item->id}}')"><i class="fas fa-exclamation"></i> Report an issue</a>
                                                          <div class="dropdown-divider"></div>
                                                          <a href="/finance/details/{{$item->id}}" class="dropdown-item has-icon text-info"><i class="far fa-eye"></i> Details</a>
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
            </div>
        </div>
@endsection 
