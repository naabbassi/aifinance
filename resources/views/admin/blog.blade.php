@extends('admin/layout')
@section('title')
    AIF :: Admin - Blog
@endsection
@section('content')
    <div class="section">
        <div class="section-header">
                <h1>Blog Posts</h1>
                <div class="section-header-breadcrumb">
                  <div class="breadcrumb-item active"><a href="/dashboard">Dashboard</a></div>
                  <div class="breadcrumb-item">Blog</div>
                </div>
        </div>
        <div class="row">
                <div class="card col-12">
                    <div class="card-header">
                        <h4>Blog</h4>
                        <div class="card-header-action">
                          <a href="#" class="btn btn-outline-primary" data-toggle="modal" data-target=".faq-modal"><i class="fas fa-plus"></i> New FAQ</a>
                        </div>
                      </div>
                      <div class="card-body p-0">
                          <div class="table-responsive">
                              <table class="table table-striped" id="walletTable">
                                <tbody><tr>
                                  <th>Title</th>
                                  <th>Author</th>
                                  <th>Created At</th>
                                  <th>Action</th>
                                </tr>
                                @foreach ($blogs as $item)
                                <tr>
                                      <td>{{$item->title}}</td>
                                      <td>{{$item->author}}</td>
                                      <td>{{$item->created_at}}</td>
                                      <td>
                                          <div class="dropdown">
                                              <a href="#" data-toggle="dropdown" class="btn btn-primary" aria-expanded="false">⋮</a>
                                              <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, -6px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                <a href="#" class="dropdown-item has-icon" onclick="editFaq({{$item->id}})"><i class="far fa-edit"></i> Edit</a>
                                                <div class="dropdown-divider"></div>
                                                <a href="#" class="dropdown-item has-icon text-danger" id="deleteItem" onclick="deleteItem({{$item->id}})"><i class="far fa-trash-alt"></i> Delete</a>
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
          <h5 class="modal-title ">Submit new blog post</h5>
          <button type="button" class="close" onclick="closeModal()">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form onsubmit="event.preventDefault(); submitIssueForm();">
            <div class="form-group">
              <label for="">Title</label>
              <input type="text" name="title" id="title" class="form-control">
            </div>
            <div class="form-group">
                <label class="col-form-label">Content :</label>
                <textarea class="summernote"  name="content" id="content" ></textarea>
            </div>
            <div class="form-group">
                <label class="col-form-label">Picture :</label>
                <input type="file" name="pic" id="pic" class="form-control">
            </div>
            <div class="form-group" >
                <label class="col-form-label">Author :</label>
                <input type="text" name="author" id="author" class="form-control">
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
      editItemId = 0;
      token = '{{csrf_token()}}';
      async function editFaq(id){
        this.editItemId = id;
        result = await fetch("{{ route('home') }}/admin/blog/" + id ,{
          method: 'POST', // or 'PUT'
            body: JSON.stringify({'_token': '{{csrf_token()}}'}), // data can be `string` or {object}!
            headers: {
              'Content-Type': 'application/json'
            }
        })
        if(result.status == 200){
          result = await result.json();
          document.getElementById('title').value = result.title;
          document.getElementById('author').value = result.author;
          $('.summernote').summernote('code', result.content);
          $('.faq-modal').modal('show');
        }
      }

      async function submitIssueForm(){
        const formData = new FormData()
        formData.append('file',  document.getElementById('pic').files[0])
        formData.append('title', document.getElementById('title').value);
        formData.append('author', document.getElementById('author').value);
        formData.append('content', $('.summernote').summernote('code'));
        formData.append('id', editItemId);
        formData.append('_token', this.token)
        result = await fetch("{{ route('home') }}/admin/blog",{
          method: "POST",
          body: formData
        });
        if(result.status == 200){
          result = result.json();
          $('.faq-modal').modal('hide');
          swal('Report the issue', 'Your issue reqistered successfully', 'success');
          document.getElementById('title').value = "";
          $('.summernote').summernote('reset');
        } else {
          swal('Report the issue', 'Something went wrong - Error:' + result.status, 'info');
        }
        this.editItemId = 0;
      }
      function closeModal(){
           document.getElementById('title').value = "";
           $('.summernote').summernote('reset');
           $('.faq-modal').modal('hide');
      }
      async function deleteItem(id){
        result = await fetch("{{ route('home') }}/admin/blog/" + id, {
          method: "DELETE",
          '_token': this.token
        });
        if(result.status == 200){
          swal('Delete Post', 'Item deleted successfuly', 'success');
        }
      }
    </script>
@endsection