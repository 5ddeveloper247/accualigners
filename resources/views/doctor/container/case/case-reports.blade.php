@extends('doctor.root.index')

@section('title', "Report | Case")


@section('content')
    @php

        $requiredSections = [
            'Header' => 'doctor.components.side-nav',
            'Footer' => 'doctor.components.footer'
        ];

        $componentsJsCss = [
            'adminPanel.general',
            'adminPanel.validation',
            'adminPanel.select2',
            'adminPanel.jquery-collapse-tab',
            'adminPanel.jquery-date-pickers',
            //'adminPanel.chartist',
        ];

        $viewRoute = route('doctor.case.index');
        $setting = setting_h();
        $default_currency = $setting->currency;
        $report_url = route('doctor.case.reports', ['case'=>$case->id]);
        //dd($reportByDate);
    @endphp

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-12 col-12 mb-1">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('doctor.dashbord')}}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{$viewRoute}}">Cases</a></li>
                                <li class="breadcrumb-item active">Reports</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">

                <section id="column-visibility">
                    <div class="row">

                        <div class="col-12">
                            <div class="row mb-1">
                                <div class="col-12 text-center">

                                    <img class="media-object rounded-circle width-100" src="{{$case->patient->picture}}" alt="User image">
                                    <p>{{$case->name}}</p>
                                    
                                </div>
                            </div> 
                        </div>

                        <div class="col-12">

                            <div class="card">
                                <div class="card-header">

                                    <div class="row">
                                        <div class="col-6">
                                            <h5 class="card-title">Case # {{$case->id}} History</h5>
                                        </div>
                                        <div class="col-6">
                                            <select class="form-content select2 right" id="tray_no" onchange="location = '{{$report_url}}/' + this.options[this.selectedIndex].value;">
                                                @if ($case->no_of_trays > 0)
                                                    @for ($i = 1; $i <= $case->no_of_trays ; $i++)
                                                        <option value="{{$i}}" @if(Request()->route('tray_no') && Request()->route('tray_no') == $i) selected @endif >Aligner #{{$i}}</option>                                                        
                                                    @endfor
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                

                                    
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <ul class="nav nav-tabs nav-underline no-hover-bg">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="base-wearing-time" data-toggle="tab" aria-controls="wearing-time" href="#wearing-time" aria-expanded="true">Wearing Time</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="base-teeth-selfie" data-toggle="tab" aria-controls="teeth-selfie" href="#teeth-selfie" aria-expanded="false">Teeth Selfie</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="base-graph-report" data-toggle="tab" aria-controls="graph-report" href="#graph-report" aria-expanded="false">Graph Report</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content px-1 pt-1">
                                            <div role="tabpanel" class="tab-pane active" id="wearing-time" aria-expanded="true" aria-labelledby="base-wearing-time">
                                                
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="dp-inline" id="datepicker-inl"></div>
                                                    </div>
                                                    <div class="col-6" id="report-by-date-component">
                                                        @include('doctor.container.case.components.report.report-by-date-component', ['reportByDate'=>$reportByDate])
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <div class="tab-pane" id="teeth-selfie" aria-labelledby="base-teeth-selfie">
                                                <div class="row">
                                                    @isset($selfies)
                                                        @foreach ($selfies as $selfie)
                                                            @php($image = storageUrl_h($selfie->path.$selfie->name))
                                                            <div class="col-2 mb-1 text-center">
                                                                <a href="{{$image}}" target="_blank">
                                                                    <img src="{{$image}}" class="img-fluid">
                                                                </a>
                                                                <small>{{$selfie->created_at}}</small>
                                                            </div>
                                                        @endforeach
                                                    @endisset
                                                    
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="graph-report" aria-labelledby="base-graph-report">
                                                <div class="row">
                                                    <div class="col-8">
                                                        <div class="form-group text-center">
                                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                                <button type="button" class="btn btn-primary report-btn-date report-by-btn" data-type="date">Date</button>
                                                                <button type="button" class="btn btn-outline-primary report-btn-week report-by-btn" data-type="week">Week</button>
                                                                <button type="button" class="btn btn-outline-primary report-btn-month report-by-btn" data-type="month">Month</button>
                                                            </div>
                                                        </div>
                                                        <canvas id="myChart" class="width:100%;height:auto;max-height:250px"></canvas>
                                                    </div>
                                                    <div class="col-4" id="report-by-date-component">
                                                        
                                                        <div class="callout-square p-1 mb-1">
                                                            <p>
                                                                <span class="float-left">7-Days Duration</span>
                                                                <strong class="float-right">{{$sevenDayReport}} min</strong>
                                                            </p>
                                                        </div> 

                                                        <hr>
                                                        
                                                        <div class="callout-square p-1 mb-1">
                                                            <p>
                                                                <span class="float-left">30-Days Duration</span>
                                                                <strong class="float-right">{{$thirtyDayReport}} min</strong>
                                                            </p>
                                                        </div> 

                                                        <hr>
                                                        
                                                        <div class="callout-square p-1 mb-1">
                                                            <p>
                                                                <span class="float-left">90-Days Duration</span>
                                                                <strong class="float-right">{{$nintyDayReport}} min</strong>
                                                            </p>
                                                        </div> 

                                                        <hr>

                                                    </div>

                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </section>

            </div>
        </div>
    </div>

@stop

@section('extra-script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
    <script>

        var myChart;

        draw_graph(@json($graphReport));

        function draw_graph(reportData) {

            view_titles = [];
            view_color = [];
            view_vals = [];

            var total_view = 0;

            $.each(reportData, function (idx, val) {
                console.log(val);
                view_titles.push(val['title']);

                view_color.push('rgb(0, 32, 92)');
                view_vals.push(parseFloat(val['average_minuts']));
                total_view+= parseFloat(val['average_minuts']);


            });

            var barChartData = {
                labels: view_titles,
                datasets: [{
                    label: 'Total average duration: '+total_view+' min',
                    backgroundColor: this.view_color,
                    data: this.view_vals,
                }]

            };

            var ctx = document.getElementById('myChart').getContext('2d');
            if (myChart) {
                myChart.destroy();
            }
            myChart = new Chart(ctx, {
                type: 'bar',
                data: barChartData,
                options: {
                    title: {
                        display: false,
                        text: 'Chart.js Bar Chart - Stacked'
                    },
                    tooltips: {
                        mode: 'index',
                        intersect: false,
                        callbacks: {
                            label: function(tooltipItem, data){
                                var label= data.datasets[tooltipItem.datasetIndex].label.split(':')[0];
                                var value= data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
                                return label + ': ' + value ;
                            }
                        }
                    },
                    responsive: true,
                    scales: {
                        xAxes: [{
                            stacked: true,
                        }],
                        /*yAxes: [{
                            stacked: true
                        }]*/    
                    }
                },
                plugins:[{
                    beforeInit: function (chart, options) {
                        chart.legend.afterFit= function () {
                            this.height= this.height + 30;
                        }
                    }
                }]
            });

            return true;
        }

        window.onload = function() {
            var ctx = document.getElementById('myChart').getContext('2d');
        };

        $(document).ready(function () {

            var created_at = "{{isset($reportByDate[0]->created_at) && !empty($reportByDate[0]->created_at) ? date('Y/m/d', strtotime($reportByDate[0]->created_at)) : ''}}"

            if(created_at && created_at != ''){
                var dat = new Date(created_at);
                var maxdat = new Date(created_at);
                maxdat.setDate(maxdat.getDate() + parseInt("{{!empty($case->no_of_days) ? $case->no_of_days : 1}}"));
                $('#datepicker-inl').datepicker("setDate", dat);
                $('#datepicker-inl').datepicker("option", "minDate", dat);
                $('#datepicker-inl').datepicker("option", "maxDate", maxdat);
            }
            
            var case_id = "{{$case->id}}";

            $("#datepicker-inl").on("change",function(){
                var date = $(this).val();
                var tray_no = $("#tray_no").val();

                var data = {
                    _token: '{{csrf_token()}}',
                    case_id: case_id,
                    tray_no: tray_no,
                    date: date
                }

                $.ajax({
                    url: '{{route("doctor.case.report-by-date")}}',
                    type: "POST",
                    dataType: 'json',
                    data: data,
                    success: function (responseCollection) {
                        
                        $("#report-by-date-component").html(responseCollection['data']['html']);

                    }, error: function (e) {
                        var responseCollection = e.responseJSON;
                        console.log(e.responseJSON);
                        toastr.error(responseCollection['message'], "Error!", {
                            positionClass: "toast-bottom-left",
                            containerId: "toast-bottom-left"
                        });
                    }
                }); //end of ajax
            });

            $(".report-by-btn").on("click",function(){
                var report_by = $(this).data('type');
                var tray_no = $("#tray_no").val();

                var data = {
                    _token: '{{csrf_token()}}',
                    case_id: case_id,
                    tray_no: tray_no,
                    report_by: report_by
                }

                $.ajax({
                    url: '{{route("doctor.case.graph-report")}}',
                    type: "POST",
                    dataType: 'json',
                    data: data,
                    success: function (responseCollection) {
                        draw_graph(responseCollection['data']);
                        $(".report-by-btn").removeClass('btn-primary');
                        $(".report-by-btn").addClass('btn-outline-primary');
                        $('.report-btn-'+report_by).addClass('btn-primary')
                        $('.report-btn-'+report_by).removeClass('btn-outline-primary')
                    }, error: function (e) {
                        var responseCollection = e.responseJSON;
                        console.log(e.responseJSON);
                        toastr.error(responseCollection['message'], "Error!", {
                            positionClass: "toast-bottom-left",
                            containerId: "toast-bottom-left"
                        });
                    }
                }); //end of ajax
            });

        });


    </script>
    
@stop