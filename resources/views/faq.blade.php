@extends('layout')
@section('title')
    AIF :: FAQ
@endsection
@section('content')
    <div class="section">
            <div class="section-header">
                    <h1>FAQ</h1>
                        <div class="section-header-breadcrumb">
                                <div class="breadcrumb-item active"><a href="/dashboard">Dashboard</a></div>
                          <div class="breadcrumb-item">faq</div>
                        </div>
                </div>
        <div class="col-12 card">
            {{-- start accordion --}}
            <div class="card-header">
                    <h4>Frequently asked questions</h4>
            </div>
            <div id="accordion">
                  @foreach ($result as  $index =>$item)
                    <div class="accordion">
                        <div class="accordion-header" role="button" data-toggle="collapse" data-target="#panel-body-{{$index}}" aria-expanded="false">
                            <h4> {{$index+1}} - {{$item->question}} </h4>
                        </div>
                        <div class="accordion-body collapse" id="panel-body-{{$index}}" data-parent="#accordion">
                            <p>{{$item->answer}}</p>
                        </div>
                    </div>
                  @endforeach
              </div>
            {{-- end accordion --}}
        </div>
    </div>
@endsection+