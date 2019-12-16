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
                        <h4>FAQ</h4>
                        <div class="card-header-action">
                          <a href="#" class="btn btn-outline-primary" data-toggle="modal" data-target=".faq-modal"><i class="fas fa-plus"></i> New FAQ</a>
                        </div>
                      </div>
                      <div class="card-body p-0">
                          <div class="table-responsive">
                              <table class="table table-striped" id="walletTable">
                                <tbody><tr>
                                  <th>Question</th>
                                  <th>Action</th>
                                </tr>
                                @foreach ($faq as $item)
                                <tr>
                                      <td>
                                        {{ substr($item->question, 0, 45) }} ...
                                      </td>
                                      <td>
                                          <div class="dropdown">
                                              <a href="#" data-toggle="dropdown" class="btn btn-primary" aria-expanded="false">⋮</a>
                                              <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, -6px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                <a href="#" class="dropdown-item has-icon" onclick="editFaq({{$item}})"><i class="far fa-edit"></i> Edit</a>
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
           <!-- FAQ Modal modal -->
<div class="modal fade faq-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title ">Submit new FAQ</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form onsubmit="event.preventDefault(); submitIssueForm();">
            <div class="form-group">
              <label for="">Question</label>
              <input type="text" name="question" id="question" class="form-control">
            </div>
            <div class="form-group" id="answer">
                <label class="col-form-label">Answer :</label>
                <textarea class="summernote"  name="answer" id="answer" ></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
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
      
      editFaqID = 0;
      function editFaq(data){
        this.editFaqID = data['id'];
        document.getElementById('question').value = data['question'];
        $('.summernote').summernote('pasteHTML', data['answer']);
        $('.faq-modal').modal('show');
      }
      function submitIssueForm(e){
        $.ajax({
        method: "POST",
          data:{
            '_token': '{{csrf_token()}}',
            id: this.editFaqID,
            question:document.getElementById('question').value,
            answer:$('.summernote').summernote('code')
          },
        url: "{{ route('home') }}/admin/faq/new",
        }).done(function(result) {
          console.log(result)
          if(result){
            $('.faq-modal').modal('hide');
            if(result == 'true'){
                swal('Report the issue', 'Your issue reqistered successfully', 'success');
                document.getElementById('question').value = "";
                document.getElementById('answer').value = "";
            } else {
                swal('Report the issue', result, 'info');
            }
          } else{
            swal('Report the issue', 'Opps! apparently something went wrong', 'info');
          }
         })
      }
    </script>
@endsection