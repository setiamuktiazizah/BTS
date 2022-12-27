@extends('dashboard.layouts.main')

@section('container')
        <div aria-label="breadcrumb" class="container py-2 ">
            <ol class="breadcrumb ">
                <li class="breadcrumb-item"><a href="#" class=" text-black">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
        </div>

        <!-- Tambahin disini.... -->
        <div class="container pb-5">
            <h3 class="">Welcome, Admin.</h3>

            <div class="row mt-3 ms-0">
                <div class="col-md-3 bg-white d-flex flex-column rounded me-5 text-white">
                    <h2 class="text-dark">10</h2>
                    <p class="pb-0 mb-0 text-dark">BTS</p>
                    <a href="/bts" class="btn  my-2 text-decoration-none text-white d-flex justify-content-between border-top bg-primary">Show more <i class="bi bi-chevron-right "></i></a>
                </div>
                <div class="col-md-3 bg-white d-flex flex-column rounded me-5 text-white">
                    <h2 class="text-dark">10</h2>
                    <p class="pb-0 mb-0  text-dark">Operator</p>
                    <a href="/operator" class="btn  my-2 text-decoration-none text-white d-flex justify-content-between border-top bg-primary">Show more <i class="bi bi-chevron-right "></i></a>
                </div>
                <div class="col-md-3 bg-white d-flex flex-column rounded me-5 text-white">
                    <h2 class="text-dark">{{ $jumlah_monitoring }}</h2>
                    <p class="pb-0 mb-0 text-dark">Monitoring</p>
                    <a href="/monitoring" class="btn  my-2 text-decoration-none text-white d-flex justify-content-between border-top bg-primary">Show more <i class="bi bi-chevron-right "></i></a>
                </div>

            </div>

            <div class="row mt-4 ms-0">
                <div class="col-md-10 bg-white rounded">
                    <h4 class="mt-2 mb-4">Monitoring</h4>
                    <canvas id="monitoringChart" width="400" height="200" class="mb-3"></canvas>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-4 me-3">
                    <div class="card" style="min-height: 447px; max-height: 447px">
                        <div class="card-header bg-info fw-bold">
                            Recent Activity
                        </div>
                        <ul class="list-group list-group-flush">
                            @foreach ($activities as $row)
                                <li class="list-group-item">
                                    <p class="text-black-50">{{ $row->at }}</p>
                                    <p class="mb-0"><i class="bi 
                                        @if ($row->action == 'add')
                                            bi-plus-circle
                                        @elseif ($row->action == 'edit')
                                            bi-pencil-square
                                        @elseif ($row->action == 'delete')
                                            bi-trash
                                        @endif 
                                    "></i> <a href="/profile/{{ $row->user->id }}" class="fw-bold text-decoration-none text-black" id="profileLink">{{ $row->user->name }}</a> {{ $row->action }} {{  $row->object }}</p>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="col-md-4 h-100 d-flex flex-column" >
                    <div class="card " style="min-height: 447px; max-height: 447px; overflow: scroll;">
                        <div class="card-header bg-info fw-bold">
                            Online Users (last 30 minutes)
                        </div>
                        <ul class="list-group list-group-flush mb-auto">
                            @foreach ($online_users as $row)
                                <li class="list-group-item">
                                    <a class="mb-0 text-decoration-none text-black" href="/profile/{{ $row->user->id }}"><i class="bi bi-person-circle"></i> <span class="fw-bold">{{ $row->user->name }}</span> </a>
                                </li>
                            @endforeach
                            
                        </ul>
                    </div>
                </div>
            </div>

            
        </div>

        
        <script>
            const url = '{{ url('/api/chart') }}';
            const Tahun = new Array();
            const Jumlah = new Array();

            $(document).ready(function(){
                $.get(url, function(response){
                    response.forEach(function(data){
                        Tahun.push(data.tahun);
                        Jumlah.push(data.jumlah);
                    });
                    var jumlahMax = Math.max.apply(Math, Jumlah);
                    var ctx = document.getElementById("monitoringChart").getContext('2d');
                        var myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: Tahun,
                            datasets: [{
                                label: 'Monitoring',
                                data: Jumlah,
                                borderWidth: 1,
                                backgroundColor: 'rgba(13, 110, 253, 0.8)',
                                barPercentage: 0.5
                            }]
                        },
                        options: {
                            scales: {
                                yAxis: {
                                    min: 0,
                                    max: jumlahMax + 2
                                }
                            },
                            plugins: {
                                legend: {
                                    display: false
                                }
                            }
                        }
                    });
                });
            });
        </script>
@endsection