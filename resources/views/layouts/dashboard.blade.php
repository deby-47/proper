@extends('layouts.app')

@section('content')

    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
            <div class="header-body">
                <!-- Card stats -->
                <div class="row">

                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt--7 tall">
        <div class="row">
            <div class="col-xl-12 mb-12 mb-xl-0">
                <div class="card bg-white-default shadow">
                    <div class="card-header bg-transparent">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="text-uppercase text-light ls-1 mb-1">Overview</h6>
                                <h2 class="text-white mb-0">OPD</h2>
                            </div>
                            <div class="col">

                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Chart -->
                        <div class="chart" style="height: 1000px">
                            <canvas id="chart-bar" class="chart-canvas" heigth="1000px"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth')
    </div>
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
    <script>
        var OrdersChart = (function() {
            var $chart = $('#chart-bar');
            var $ordersSelect = $('[name="ordersSelect"]');
            function initChart($chart) {
                var pointBackgroundColors = [];
                var ordersChart = new Chart($chart, {
                    type: 'horizontalBar',
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    callback: function (tick) {
                                        return tick.substring(0, 20);
                                    }
                                    //callback: function(value) {
                                    //    if (!(value % 10)) {
                                    //        return value
                                    //    }
                                    //}
                                }
                            }],
                            xAxes: [{
                                ticks: {
                                    beginAtZero: true,
                                    max: 100
                                }
                            }]
                        },
                        tooltips: {
                                    callbacks: {
                                        title: function (tooltipItems, data) {
                                            return data.labels[tooltipItems[0].index]
                                        }
                                    }
                                },
                        responsive: true,
                        maintainAspectRatio: false
                    },
                    data: {
                        labels: @json($opd),
                        datasets: [{
                            label: 'Nilai IKPA',
                            data: @json($n_ikpa),
                            borderWidth: 1,
                            backgroundColor: pointBackgroundColors
                        }]
                    }
                });
                for (i = 0; i < ordersChart.data.datasets[0].data.length; i++) {
                    if (ordersChart.data.datasets[0].data[i] < 30) {
                        pointBackgroundColors.push("red");
                    }
                    else {
                        pointBackgroundColors.push("blue");
                    }
                }
                ordersChart.update();
                $chart.data('chart', ordersChart);
            }
            if ($chart.length) {
                initChart($chart);
            }
        })();
    </script>
@endpush
