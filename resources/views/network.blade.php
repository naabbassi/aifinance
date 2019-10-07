@extends('layout')
@section('title')
    AIF :: My Network
@endsection
@section('content')
      <div class="section">
          <div class="section-header">
              <h1>My Network</h1>
              <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/dashboard">Dashboard</a></div>
                <div class="breadcrumb-item">My Network</div>
              </div>
            </div>
            {{-- levels --}}
            <div class="row">
                <div class="col-12 col-md-4 text-center">
                    <div class="alert alert-success alert-has-icon">
                        <div class="alert-icon"><i class="fas fa-donate"></i></div>
                        <div class="alert-body">
                          <div class="alert-title">My Deposit</div>
                        <h5 >{{$sum}} $</h5>
                        </div>
                      </div>
                </div>
                <div class="col-12 col-md-4 text-center">
                    <div class="alert alert-primary alert-has-icon">
                        <div class="alert-icon"><i class="fas fa-coins"></i></div>
                        <div class="alert-body">
                          <div class="alert-title">My Network Deposit</div>
                        <h5 >{{$netDeposit}} $</h5>
                        </div>
                      </div>
                </div>
                <div class="col-12 col-md-4 text-center">
                    <div class="alert alert-dark alert-has-icon">
                        <div class="alert-icon"><i class="fas fa-network-wired"></i></div>
                        <div class="alert-body">
                          <div class="alert-title">My Network Scale</div>
                        <h5 >{{$netCount}}</h5>
                        </div>
                      </div>
                </div>
            </div>
            <div class="card"><div class="card-header"><h4>Level 1</h4></div><div class="card-body"><div class="row items" id="1"></div></div></div>
            <div class="card"><div class="card-header"><h4>Level 2</h4></div><div class="card-body"><div class="row items" id="2"></div></div></div>
            <div class="card"><div class="card-header"><h4>Level 3</h4></div><div class="card-body"><div class="row items" id="3"></div></div></div>
            <div class="card"><div class="card-header"><h4>Level 4</h4></div><div class="card-body"><div class="row items" id="4"></div></div></div>
            <div class="card"><div class="card-header"><h4>Level 5</h4></div><div class="card-body"><div class="row items" id="5"></div></div></div>
            <div class="card"><div class="card-header"><h4>Level 6</h4></div><div class="card-body"><div class="row items" id="6"></div></div></div>
            <div class="card"><div class="card-header"><h4>Level 7</h4></div><div class="card-body"><div class="row items" id="7"></div></div></div>
            <div class="card"><div class="card-header"><h4>Level 8</h4></div><div class="card-body"><div class="row items" id="8"></div></div></div>
            <div class="card"><div class="card-header"><h4>Level 9</h4></div><div class="card-body"><div class="row items" id="9"></div></div></div>
            <div class="card"><div class="card-header"><h4>Level 10</h4></div><div class="card-body"><div class="row items" id="10"></div></div></div>
      </div>
@endsection
@section('script')
<script type="text/javascript">
  (function(){
    getNet('{{ Auth::user()->id}}',1);
  })()
    $('.items').on('click','#item', function (e) {
      deselct();
      e.currentTarget.classList.add('card-warning');
      e.currentTarget.classList.remove('card-primary');
        var id = e.currentTarget.dataset.id;
        var level = e.currentTarget.dataset.level;
        level++;
        getNet(id,level);
        });

      function getNet(id,level){
        $.ajax({
        method: "POST",
          data:{
            '_token': '{{csrf_token()}}',
            id: id,
            level:level-1
          },
        url: "{{ route('home') }}/getnet",
        }).done(function(result) {
          hide(level);
          if(result){
            $('#'+level).html(result);
          } else{
            swal('Info', 'Selected person has yet nobody in his network!', 'info');
          }
         });
      }
      function hide(level){
        for(var i=level;i < 10; i++){
            $('#'+i).html("");
          }
      }
      function deselct(){
        var selectedItems = document.querySelectorAll(".card-warning");

      selectedItems.forEach(function(item) {
        item.classList.remove('card-warning');
        item.classList.add('card-primary');
});
      }
</script>
@endsection