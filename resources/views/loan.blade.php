@extends('layout')
@section('title')
    AIF :: Loan
@endsection
@section('content')
    <div class="section">
        <div class="section-header">
            <h1>Loan</h1>
                <div class="section-header-breadcrumb">
                        <div class="breadcrumb-item active"><a href="/dashboard">Dashboard</a></div>
                  <div class="breadcrumb-item">Loan</div>
                </div>
        </div>
        <div class="row">
            <div class="col-6 col-md-4">
                <canvas id="myChart" width="100" height="100"></canvas>
            </div>
            <div class="col-12 col-md-8 mt-4">
                <div class="card card-primary">
                <div class="card-header"><h4 class="text-primary">Loan information</h4></div>
                <div class="card-body">
                        <ul class="text-dark">
                            <li>Lorem ipsum dolor sit amet</li>
                            <li>Consectetur adipiscing elit</li>
                            <li>Integer molestie lorem at massa</li>
                            <li>Facilisis in pretium nisl aliquet</li>
                            <li>Nulla volutpat aliquam velit
                                <ul>
                                <li>Phasellus iaculis neque</li>
                                <li>Purus sodales ultricies</li>
                                <li>Vestibulum laoreet porttitor sem</li>
                                <li>Ac tristique libero volutpat at</li>
                                </ul>
                            </li>
                            <li>Faucibus porta lacus fringilla vel</li>
                            <li>Aenean sit amet erat nunc</li>
                            <li>Eget porttitor lorem</li>
                        </ul>
                </div>
            </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
<script>
  var ctx = document.getElementById('myChart').getContext('2d');
  var remained= '{{$remained}}';
  console.log(remained)
var myChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ['Past days','Remained days'],
        datasets: [{
            label: 'Reamined',
            data: [remained, 120 - remained],
        backgroundColor: [
                '#6777ef',
                '#cdd3d8'
            ],
            borderWidth: 8
        }]
    },
    options:{
        events:['click']
    }
});
</script>
@endsection