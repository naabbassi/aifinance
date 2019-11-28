@extends('admin/layout')
@section('title')
    AIF :: Admin - Faq
@endsection
@section('content')
    <div class="section">
        <div class="section-header">
                <h1>Frequently asked questions</h1>
                <div class="section-header-breadcrumb">
                  <div class="breadcrumb-item active"><a href="/dashboard">Dashboard</a></div>
                  <div class="breadcrumb-item">Faq</div>
                </div>
        </div>
        <div class="row">
                <div class="card col-12">
                        <div class="card-header">
                            <h4>Faq</h4>
                            <div class="card-header-action"></div>
                          </div>
                      <div class="card-body p-0">
                          <div class="table-responsive">
                              <table class="table table-striped" id="walletTable">
                                <tbody><tr>
                                  <th></th>
                                  <th>Address</th>
                                  <th>Created At</th>
                                  <th>Action</th>
                                </tr>
                                @foreach ($faq as $item)
                                <tr>
                                      <td class="align-middle">
                                        {{$item->title }}
                                      </td>
                                      <td>
                                        {{ substr($item->address, 0, 10) }} ...
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
                            </div>
                      </div>
                    </div>
        </div>
    </div>
   
@endsection