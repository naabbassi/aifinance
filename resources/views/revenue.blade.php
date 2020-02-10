@extends('layout')
@section('title')
    AIF :: My Revenue
@endsection
@section('content')
        <div class="section">
                <div class="section-header">
                    <h1>My Revenue</h1>
                    <div class="section-header-breadcrumb">
                        <div class="breadcrumb-item active"><a href="/dashboard">Dashboard</a></div>
                        <div class="breadcrumb-item">My Revenue</div>
                    </div>
                </div>
            <div class="row">
                <div class="col-12">
                        <div class="card">
                                <div class="card-header">
                                  <h4>My Revenue</h4>
                                  <div class="card-header-action">
                                    <span href="#" class="badge badge-secondary">
                                    Total : {{$sum}}$
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
                                          <th>Transaction</th>
                                          <th>Amount</th>
                                          <th>Due to</th>
                                          <th>Due Date</th>
                                          <th>Action</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        @foreach ($list as $indexKey => $item)
                                            <tr>
                                                <td class="align-middle">{{$indexKey+1}}</td>
                                                <td>{{Str::limit($item->id,7)}}</td>
                                                <td class="align-middle">{{$item->items()->sum('amount')}}$</td>
                                                <td >
                                                  @switch($item->type)
                                                      @case('d')
                                                          <span class="badge badge-primary">Deposit</span>
                                                          @break
                                                      @case('r')
                                                         <span class="badge badge-info">Reward</span>
                                                          @break
                                                      @case('nr')
                                                        <span class="badge badge-success">Network Reward</span>
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
                                                          <a href="/finance/revenue/details/{{$item->id}}" class="dropdown-item has-icon text-info"><i class="far fa-eye"></i> Details</a>
                                                        </div>
                                                      </div>
                                                </td>
                                              </tr>
                                        @endforeach
                                      </tbody>
                                    </table>
                                   <div class="p-2"> {!! $list->render() !!}</div>
                                  </div>
                                </div>
                              </div>
                </div>
            </div>
        </div>
            <!-- Issue Modal modal -->
<div class="modal fade issue-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Report an issue</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form onsubmit="event.preventDefault(); submitIssueForm();">
            <div class="form-group row">
              <label class="col-form-label">Tell us about the issue :</label>
              <textarea class="summernote" id="issueMessage" rows="10" style="height:100px;" placeholder="Tell us about issue"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Send request</button>
            <button type="reset" class="btn btn-primary ml-2" data-dismiss="modal" aria-label="Close">Cancel</button>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection 
@section('script')
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.js"></script>
    <script>
          //issue form
          var IssueItemId=0;
      function setIssueId(e){
        this.IssueItemId = e;
        console.log(e)
        $('.issue-modal').modal('show');
      }
      function submitIssueForm(e){
        $.ajax({
        method: "POST",
          data:{
            '_token': '{{csrf_token()}}',
            id: this.IssueItemId,
            type:'r',
            message:document.getElementById('issueMessage').value
          },
        url: "{{ route('home') }}/issue/submit",
        }).done(function(result) {
          if(result){
            $('.issue-modal').modal('hide');
            if(result == 'true'){
                swal('Report the issue', 'Your issue reqistered successfully', 'success');
            } else {
                swal('Report the issue', result, 'info');
            }
          } else{
            swal('Report the issue', 'Opps! apparently something went wrong', 'info');
          }
         })
      }</script>
@endsection