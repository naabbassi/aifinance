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
                                                <a href="#" class="dropdown-item has-icon" onclick="editFaq({{$item->id}})"><i class="far fa-edit"></i> Edit</a>
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
          <button type="button" class="close" onclick="closeModal()">
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
            <button type="reset" class="btn btn-primary ml-2" onclick="closeModal()">Cancel</button>
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
      async function editFaq(id){
        this.editFaqID = id;
        result = await fetch("{{ route('home') }}/admin/faq/get/" + id,{
          method: 'POST', // or 'PUT'
            body: JSON.stringify({'_token': '{{csrf_token()}}'}), // data can be `string` or {object}!
            headers: {
              'Content-Type': 'application/json'
            }
        })
        if(result.status == 200){
          result = await result.json();
          document.getElementById('question').value = result.question;
          $('.summernote').summernote('pasteHTML', result.answer);
          $('.faq-modal').modal('show');
        }
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
          if(result){
            $('.faq-modal').modal('hide');
            if(result == 'true'){
                swal('Report the issue', 'Your issue reqistered successfully', 'success');
                document.getElementById('question').value = "";
                $('.summernote').summernote('reset');
            } else {
                swal('Report the issue', result, 'info');
            }
          } else{
            swal('Report the issue', 'Opps! apparently something went wrong', 'info');
          }
         })
      }
      function closeModal(){
           document.getElementById('question').value = "";
           $('.summernote').summernote('reset');
           $('.faq-modal').modal('hide');
      }
    </script>
@endsection