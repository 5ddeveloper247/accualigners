@extends('doctor.root.index')

@section('title', "Dashboard")

@section('content')

@php

    $requiredSections = [
        //'Header' => 'doctor.components.header',
        //'Nav' => 'doctor.components.nav',
        'Header' => 'doctor.components.side-nav',
        'Footer' => 'doctor.components.footer'
    ];

    $componentsJsCss = [
        'adminPanel.general',
        'adminPanel.chats',
        'adminPanel.dashboard-sales',
    ];

@endphp

<style>
.table.table-xl td, .table.table-xl th {
    min-width: 150px;
    text-align: center;
}
</style>
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-12 col-12 mb-1">
                <h2><i class="la la-angle-left font-medium-5"></i> Dashbord</h2>
            </div>
        </div>
        <div class="content-body">
            
            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="card">
                        <div class="card-header">
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-md-4 col-12 border-right-blue-grey border-right-lighten-5 text-center">
                                        <i class="la la-user-plus info font-large-1"></i>
                                        <h4 class="font-large-1 text-bold-400">{{$total_patients}}</h4>
                                        <p class="text-light mb-0">Total Patients</p>
                                    </div>
                                    <div class="col-md-4 col-12 text-center">
                                        <i class="la la-medkit info font-large-1"></i>
                                        <h4 class="font-large-1 text-bold-400">{{$processing_fee_paid}}</h4>
                                        <p class="text-light lighten-2 mb-0">Treatment Plan Approved</p>
                                    </div>
                                    <div class="col-md-4 col-12 text-center">
                                        <i class="la la-medkit info font-large-1"></i>
                                        <h4 class="font-large-1 text-bold-400">{{$total_active_cases}}</h4>
                                        <p class="text-light lighten-2 mb-0">Active Cases</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Cases Process</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a class="card-link text-light pull-right" href="{{route('doctor.case.index')}}">View all</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-content mt-1">
                            <div class="table-responsive">
                                <table id="recent-orders" class="table table-hover table-xl mb-0">
                                    <thead>
                                    <tr>
                                        <th class="border-top-0">Patients</th>
                                        <th class="border-top-0">Case Id</th>
                                        <th class="border-top-0">Date</th>
                                        <th class="border-top-0">Payment Status</th>
                                        <th class="border-top-0">View Case</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($active_cases as $active_case)
                                            <tr>
                                                <td class="text-truncate p-1">
                                                    {{$active_case->patient->name}}
                                                    <!--<img class="media-object rounded-circle width-50" src="{{$active_case->patient->picture}}" alt="Avatar">-->
                                                </td>
                                                <td class="text-truncate p-1">
                                                    {{ $active_case->id }}
                                                </td>
                                                <td>
                                                    {{date('d-M-Y', $active_case->created_date)}}
                                                </td>
                                                <td>
                                                    @if ($active_case->processing_fee_paid)
                                                        <button type="button" class="btn btn-sm btn-outline-success round">Paid</button>
                                                    @else
                                                        <button type="button" class="btn btn-sm btn-outline-danger round">Pending</button>
                                                    @endif
                                                </td>
                                                <td class=""><a href="{{route('doctor.case.show', $active_case->id)}}" class="btn btn-md btn-round btn-primary"><i class="ft-eye"></i></a></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
               

            </div>
            
               <div class="row">
                 <div class="col-md-12">
                        <div class="card">

                            <div class="card-header">
                                <h4 class="card-title">Advertisement</h4>
                                
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                                        <ol class="carousel-indicators">
                                            @foreach ($sliders as $idx=>$slider)    
                                                <li data-target="#carousel-example-generic" data-slide-to="{{$idx}}" class="@if($idx==0) active @endif"></li>
                                            @endforeach
                                            {{-- <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                                            <li data-target="#carousel-example-generic" data-slide-to="2"></li> --}}
                                        </ol>
                                        <div class="carousel-inner" role="listbox">
                                            @foreach ($sliders as $idx=>$slider)    
                                                <div class="carousel-item @if($idx==0) active @endif">
                                                    <img src="{{$slider->slider_image}}" alt="First slide">
                                                </div>
                                            @endforeach

                                            {{-- <div class="carousel-item">
                                                <img src="{{trans('siteConfig.path.adminPanel')}}/app-assets/images/carousel/03.jpg" alt="Second slide">
                                            </div>
                                            <div class="carousel-item">
                                                <img src="{{trans('siteConfig.path.adminPanel')}}/app-assets/images/carousel/01.jpg" alt="Third slide">
                                            </div> --}}
                                        </div>
                                        <a class="carousel-control-prev" href="#carousel-example-generic" role="button" data-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="carousel-control-next" href="#carousel-example-generic" role="button" data-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                </div>
            </div>
            

        </div>
    </div>
</div>

@stop
