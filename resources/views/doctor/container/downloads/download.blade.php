
@extends('doctor.root.index')

@section('title', "Case")


@section('content')

@php

    $requiredSections = [
        'Header' => 'doctor.components.side-nav',
        'Footer' => 'doctor.components.footer'
    ];

    $componentsJsCss = [
        'adminPanel.general',
        'adminPanel.datatable',
        'adminPanel.sweetalert',
    ];

@endphp

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
          <div class="content-header-left col-md-12 col-12 mb-1">
            <div class="row breadcrumbs-top">
              <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{route('doctor.dashbord')}}">Dashboard</a></li>
                  <li class="breadcrumb-item active">Downloads</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <div class="content-body">

            
            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="card">
                        <div class="card-content collapse show">
                            <div class="card-body pt-0 mt-4">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <h2>Patient Consent Form</h2>
                                    </div>
                                    <div class="col-md-6 col-12 text-md-right">
                                        <a class="btn btn-primary" href="https://accualigners.app/INFORMED_CONSENT_FORM_FOR_PATIENTS.pdf" download>Download Now</a>
                                    </div>
                                    <div class="col-md-12 col-12 text-center">
                                        
                                        
                                        <iframe src="https://accualigners.app/INFORMED_CONSENT_FORM_FOR_PATIENTS.pdf" class="w-100 mt-2" height="600"></iframe>
                                    </div>
                                    
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
