@extends('layout')
@section('title')
    AIF :: Tickets
@endsection
@section('content')
    <div class="section">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Issue Tickets</h4>
                    <div class="card-header-action"></div>
                  </div>
              <div class="card-body p-0">
                  <div class="table-responsive">
                      <table class="table table-striped" id="walletTable">
                        <tbody><tr>
                          <th>Ticket Nr</th>
                          <th>Type</th>
                          <th>Created At</th>
                          <th>Action</th>
                        </tr>
                        @foreach ($issues as $item)
                        <tr>
                              <td class="align-middle">{{date_format($item->created_at,'my')}}{{strtoupper($item->type)}}-{{$item->id}}</td>
                              <td>
                                @@switch($item->)
                                    @case(1)
                                        
                                        @break
                                    @case(2)
                                        
                                        @break
                                    @default
                                        
                                @endswitch
                              </td>
                              <td>
                                  {{ date_format($item->created_at,'d M. Y') }}
                              </td>
                              <td>
                                  <div class="dropdown">
                                      <a href="#" data-toggle="dropdown" class="btn btn-primary" aria-expanded="false">⋮</a>
                                      <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, -6px, 0px); top: 0px; left: 0px; will-change: transform;">
                                        <a href="/finance/wallet/edit/{{$item->id}}" class="dropdown-item has-icon"><i class="far fa-edit"></i> Edit</a>
                                        <div class="dropdown-divider"></div>
                                        <a href="#" class="dropdown-item has-icon text-danger" id="deleteItem" data-id="{{$item->id}}"><i class="far fa-trash-alt"></i> Delete</a>
                                      </div>
                                    </div>
                              </td>
                            </tr>
                      @endforeach
                      </tbody></table>
                      <div class="p-2">{!! $issues->render() !!}</div>
                    </div>
              </div>
            </div>
          </div>
    </div>
@endsection