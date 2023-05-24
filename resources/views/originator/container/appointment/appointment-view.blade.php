@extends('originator.root.index')

@section('title', "Appointment")


@section('content')

@php

    $requiredSections = [
        'Header' => 'originator.components.side-nav',
        'Footer' => 'originator.components.footer'
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
                  <li class="breadcrumb-item"><a href="{{route('admin.dashbord')}}">Dashboard</a></li>
                  <li class="breadcrumb-item active">Appointments</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <div class="content-body">
            <section id="column-visibility">
                <div class="row">
                    <div class="col-12 col-md-6 float-right mb-1">
                        <div class="aeshaz-filter">
                            <form action="{{url(Request()->path())}}" id="filter-form" method="post">
                                @csrf  
@method('PUT')
                                <div class="row mt-2 mt-md-0">
                                    <div class="col-12 col-md-6">
                                        @if(Request()->has('availability'))
                                         <input type="hidden" name="availability" value="{{Request()->availability}}" /> @endif
                                        <input type="text" id="filter-field" name="filter" class="form-control form-control-sm" placeholder="Search" aria-controls="DataTables_Table_7" value="{{ Request()->has('filter') ? Request()->filter : ''}}" >
                                    </div>
                                    <div class="col-12 col-md-6 mt-2 mt-md-0">
                                        <button type="submit" class="btn btn-md btn-primary white ml-1"> Search</button>
                                        <a href="{{Request()->has('filter') ? url(Request()->path()) : 'JavaScript:void(0);'}}" class="btn btn-md btn-outline-primary primary ml-1"> Clear</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                         <a href="{{url(Request()->path().'/create')}}" class="btn btn-md btn-primary float-right white"><i class="ft-plus"></i>Add New</a>
                    </div>

                    <div class="col-12 btn-group btn-group-md mb-1 d-none">
                        <a href="{{url(Request()->path())}}" class="btn {{!Request()->has('availability') || (Request()->has('availability') && Request()->availability=='true') ? 'btn-primary' : 'btn-secondary'}}">Upcoming Appintment</a>
                    
                        <a href="{{url(Request()->path()).'?availability=false'}}" class="btn {{Request()->has('availability') && Request()->availability=='false' ? 'btn-primary' : 'btn-secondary'}}">Previous Appintment</a>
                    </div>

                    <div class="col-12 float-right mb-1">

                        {{-- <table class="table table-striped table-bordered responsive ideaecom-datatable-pag "> --}}
                            <table class="table table-bordered border-top text-nowrap responsive" id="modal_dataTabe">
                            <thead>
                            <tr>
                                <th>Patient Name</th>
                                <th>Difficulties</th>
                                <th>Appointment Date</th>
                                <th>Appointment Date</th>
                                <th>Status</th>
                                <th>Doctor Name</th>
                                <th class="RolePermissionAction">Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($appointments as $appointment)
                                <tr data-aeshaz-select-id="{{$appointment->id}}">
                                    <td class="select-td">{{$appointment->patient_name}}</td>
                                    <td>{{$appointment->difficulties}}</td>
                                    <td>
                                        {{$appointment->appointment_time}}:00 
                                        @if($appointment->appointment_time >= 12)
                                            am
                                        @else
                                            pm
                                        @endif
                                    </td>
                                    <td>{{$appointment->appointment_date}}</td>
                                    <td>{{$appointment->status_title}}</td>
                                    <td>{{$appointment->doctor_name}}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm round btn-primary btn-glow dropdown-toggle action-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="ft-settings"></i> Action</button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item RolePermissionUpdate" href="{{url(Request()->path().'/'.$appointment->id.'/edit')}}">View</a>
                                                <a class="dropdown-item delete-confirm-alert RolePermissionDelete" href="javascript:void(0)" data-id="{{$appointment->id}}">Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>

                        {{ $appointments->appends(Request()->input())->links() }}
                    </div>

                </div>
            </section>

        </div>
    </div>
</div>

@stop
