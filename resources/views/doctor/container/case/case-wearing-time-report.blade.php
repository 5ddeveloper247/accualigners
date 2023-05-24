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
            'adminPanel.datatable',
        ];

        $viewRoute = route('doctor.case.index');
        $setting = setting_h();
        $default_currency = $setting->currency;
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
                                <li class="breadcrumb-item active">Wearing Reports</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">

                <section id="column-visibility">
                    <div class="row">

                        <div class="col-12">

                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Case # {{$case->id}} - Wearing Time</h5>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <table class="table table-striped table-bCaseed responsive ">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Duration</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach($CaseTimeLog as $time_log)
                                                <tr>
                                                    <td>{{date('m-d-Y', strtotime($time_log->created_at))}}</td>
                                                    <td>{{$time_log->duration}} min</td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
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
    
@stop