@extends('layouts.apps')
@section('title-header', 'Dashboard')
@section('content')        
                <div class="container-fluid">
                    <div class="row">                        
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-header" data-background-color="green">
                                    <i class="material-icons">store</i>
                                </div>
                                <div class="card-content">
                                    <p class="category">Total Ruangan</p>
                                    <h3 class="title">{{\App\Room::count()}} ruang</h3>
                                </div>
                            </div>                            
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-header" data-background-color="purple">
                                    <i class="material-icons">event</i>
                                </div>
                                <div class="card-content">
                                    <p class="category">Jumlah Kegiatan</p>
                                    <h3 class="title">{{\App\Agenda::count()}} agenda</h3>
                                </div>                                
                            </div>                            
                        </div>  
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-header" data-background-color="red">
                                    <i class="material-icons">event</i>
                                </div>
                                <div class="card-content">
                                    <p class="category">Kegiatan Hari ini</p>
                                    <h3 class="title">{{$todayAgenda}} agenda</h3>
                                </div>                                
                            </div>                            
                        </div>                    
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header card-chart" data-background-color="green">
                                    <div class="ct-chart" id="dailySalesChart"></div>
                                </div>
                                <div class="card-content">
                                    <h4 class="title">Kegiatan Minggu ini</h4>
                                    <!-- <p class="category">
                                        <span class="text-success"><i class="fa fa-long-arrow-up"></i> 55% </span> increase in today sales.</p> -->
                                </div>
                                <!-- <div class="card-footer">
                                    <div class="stats">
                                        <i class="material-icons">access_time</i> updated 4 minutes ago
                                    </div>
                                </div> -->
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header card-chart" data-background-color="orange">
                                    <div class="ct-chart" id="emailsSubscriptionChart"></div>
                                </div>
                                <div class="card-content">
                                    <h4 class="title">Kegiatan Tahun Ini</h4>
                                    <!-- <p class="category">Last Campaign Performance</p> -->
                                </div>
                                <!-- <div class="card-footer">
                                    <div class="stats">
                                        <i class="material-icons">access_time</i> campaign sent 2 days ago
                                    </div>
                                </div> -->
                            </div>
                        </div>                        
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="card card-nav-tabs">
                                <div class="card-header" data-background-color="purple">
                                    <div class="nav-tabs-navigation">
                                        <div class="nav-tabs-wrapper">
                                            <span class="nav-tabs-title">Ruangan:</span>
                                            <ul class="nav nav-tabs" data-tabs="tabs">
                                                <li class="active">
                                                    <a href="#profile" data-toggle="tab">
                                                        <i class="material-icons">pin_drop</i> Semua
                                                        <div class="ripple-container"></div>
                                                    </a>
                                                </li>
                                                @foreach($allRoom as $data)
                                                <li class="">
                                                    <a href="#{{$data['name']}}" data-toggle="tab">
                                                        <i class="material-icons">place</i> {{ $data['name']}}
                                                        <div class="ripple-container"></div>
                                                    </a>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-content">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="profile">
                                            <table class="table">
                                                <tbody>
                                                    @foreach($allAgenda as $data)
                                                    <tr>
                                                        <td>
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" name="optionsCheckboxes" checked disabled>
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td>{{$data['name']}} ( <b>{{$data['pic']}}</b>/{{$data['contact']}} )</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        @foreach($allRoom as $data)
                                        <div class="tab-pane" id="{{$data['name']}}">
                                            <table class="table">
                                                <tbody>
                                                    @foreach($data->agenda as $agenda)
                                                    <tr>
                                                        <td>
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" name="optionsCheckboxes" checked disabled>
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td>{{$agenda['name']}} ( <b>{{$agenda['pic']}}</b>/{{$agenda['contact']}} )</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>                        
                    </div>
                </div>
            </div>
            
@endsection

@section('js')
<script src="/js/demo.js"></script>
<script type="text/javascript">
    $(document).ready(function() {

        // Javascript method's body can be found in assets/js/demos.js
        // demo.initDashboardPageCharts();
        displayChart();

    });

    function displayChart(){
        dataDailySalesChart = {
            labels: ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum\'at', 'Sabtu'],
            series: [
                {!! json_encode($agendaOfTheWeek) !!}
            ]
        };

        optionsDailySalesChart = {
            lineSmooth: Chartist.Interpolation.cardinal({
                tension: 0
            }),
            low: 0,
            high: {{$maxAgendaWeek}},
            chartPadding: {
                top: 0,
                right: 0,
                bottom: 0,
                left: 0
            },
        }

        var dailySalesChart = new Chartist.Line('#dailySalesChart', dataDailySalesChart, optionsDailySalesChart);
        md.startAnimationForLineChart(dailySalesChart);

        var dataEmailsSubscriptionChart = {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'],
            series: [
                {!! json_encode($agendaOfTheYear) !!}

            ]
        };
        var optionsEmailsSubscriptionChart = {
            axisX: {
                showGrid: false
            },
            low: 0,
            high: {{$maxAgendaYear}},
            chartPadding: {
                top: 0,
                right: 5,
                bottom: 0,
                left: 0
            }
        };
        var responsiveOptions = [
            ['screen and (max-width: 640px)', {
                seriesBarDistance: 5,
                axisX: {
                    labelInterpolationFnc: function(value) {
                        return value[0];
                    }
                }
            }]
        ];
        var emailsSubscriptionChart = Chartist.Bar('#emailsSubscriptionChart', dataEmailsSubscriptionChart, optionsEmailsSubscriptionChart, responsiveOptions);
    }
</script>
@endsection