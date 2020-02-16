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
                    <div class="card-header-action">
                      <a href="#" class="btn btn-outline-primary" data-toggle="modal" data-target=".issue-modal"><i class="fas fa-plus"></i> New Ticket</a>
                    </div>
                  </div>
              <div class="card-body p-0">
                  <div class="table-responsive">
                      <table class="table table-striped" id="issueTable">
                        <tbody><tr>
                          <th>Ticket Nr</th>
                          <th>Type</th>
                          <th>Status</th>
                          <th>Created At</th>
                          <th>Action</th>
                        </tr>
                        @foreach ($issues as $item)
                        <tr>
                              <td class="align-middle">{{{Str::limit({$item->id,7)}}</td>
                              <td>
                                @switch($item->type)
                                    @case("d")
                                        <span class="badge badge-info">Deposit</span>
                                        @break
                                    @case('c')
                                          <span class="badge badge-primary">Custom</span>
                                          @break
                                    @case('r')
                                          <span class="badge badge-secondary">Revenue</span>
                                          @break
                                    @case('w')
                                          <span class="badge badge-secondary">Withdraw</span>
                                          @break
                                    @default
                                        
                                @endswitch
                              </td>
                              <td>
                                @if($item->status)
                                      <span class="badge badge-success">open</span>
                                    @else
                                      <span class="badge badge-danger">closed</span>
                                @endif
                              </td>
                              <td>
                                  {{ date_format($item->created_at,'d M. Y') }}
                              </td>
                              <td>
                                  <div class="dropdown">
                                      <a href="#" data-toggle="dropdown" class="btn btn-light" aria-expanded="false">⋮</a>
                                      <div class="dropdown-menu" >
                                        <a href="/tickets/issue/open/{{$item->id}}" class="dropdown-item has-icon"><i class="fas fa-book-open"></i> Show Details</a>
                                        <div class="dropdown-divider"></div>
                                        <a href="#" class="dropdown-item has-icon text-danger" id="closeIssue" data-id="{{$item->id}}"><i class="far fa-bell-slash"></i> Close this issue</a>
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
            <label class="col-form-label">Tell us about the issue :</label>
            <textarea class="summernote" id="issueMessage"   placeholder="Tell us about issue"></textarea>
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
      $('#summernote').summernote({
        placeholder: 'Hello bootstrap 4',
        tabsize: 2,
        height: 100
      });
      $("#issueTable").on('click','#closeIssue',function(e) {
            var id = e.currentTarget.dataset.id;
        swal({
            title: 'Are you sure to close this issue?',
            text: '',
            icon: 'warning',
            buttons: true,
            dangerMode: true,
          })
          .then((result) => {
            if (result) {
                closeIssue(id)
                swal('The issue has been closed!', {
                icon: 'success',
              });
            }
          });
      });
      function closeIssue(id){
        $.ajax({
        method: "POST",
          data:{
            '_token': '{{csrf_token()}}',
            id: id
          },
        url: "{{ route('home') }}/issue/closeIssue",
        }).done(function(result) {
          if(result){
            return true;
          } else{
            return false;
          }
         });
      }
      function submitIssueForm(e){
        $.ajax({
        method: "POST",
          data:{
            '_token': '{{csrf_token()}}',
            id: 0,
            type:'c',
            message:document.getElementById('issueMessage').value
          },
        url: "{{ route('home') }}/issue/submit",
        }).done(function(result) {
          console.log(result)
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
          document.getElementById('issueMessage').value = "";
         })
      }
    </script>
@endsection