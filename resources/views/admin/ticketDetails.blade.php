
@extends('admin/layout')
@section('title')
    AIF :: Ticket
@endsection
@section('content')
<div class="row align-items-center justify-content-center">
    <div class="section col-12">
        
    <div class="message-box  @if ($ticket->status == 1) scrolled @endif" id="message-box">
            @foreach ($messages as $item)
                @if ($item->type == 'u')
                        <div class="message-left">
                        <div class="message-body alert alert-white text-dark">{!!$item->message !!}</div></div>
                        <div class="message-footer">Asked by you at : <span class="text-info">{{$item->created_at}}</span></div>
                     @else
                        <div class="message-right ">
                        <div class="message-body alert alert-success">{!!$item->message !!}</div>
                        <div class="message-footer">Answered by support at : <span class="text-info">{{$item->created_at}}</span></div></div>
                @endif
            @endforeach
    </div>
    <div>  
        @if ($ticket->status == 1)
        <form action="/admin/issue/{{$ticket->id}}" method="post">
            @csrf
            <div class="form-group">
                <textarea class="summernote" name="message" cols="30" rows="10"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Send </button>
        </form>
        @endif 
    </div>
</div>
</div>
@endsection
@section('script')
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.js"></script>
<style>
    .message-body{
        border-radius:5px;
        background-color: #e2e2e2;
        padding:10px;
    }
    .message-footer{
        margin: -10px 0px 10px 10px;
        font-size:11px;
    }
    .message-left{
        margin-right: 35%;
    }
    .message-right{
        margin-left: 35%;
    }
    .message-box{
        background-color: white;
        padding: 10px;
        margin-bottom: 15px;
        border-radius: 5px;
    }
    .scrolled{
        min-height: 300px;
        height:50vh;
        overflow: scroll !important;
    }
</style>
<script>
var mBox = document.getElementById("message-box");
mBox.scrollTop = mBox.scrollHeight;
</script>
@endsection