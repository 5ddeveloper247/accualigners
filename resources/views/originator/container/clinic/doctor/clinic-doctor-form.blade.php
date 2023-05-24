@extends('originator.root.index')

@section('title', "Doctors List | Clinic")


@section('content')
    @php

        $requiredSections = [
            'Header' => 'originator.components.side-nav',
            'Footer' => 'originator.components.footer'
        ];

        $componentsJsCss = [
            'adminPanel.general',
            'adminPanel.validation',
            'adminPanel.select2',
            'adminPanel.file-input-button',
            'adminPanel.input-mask',
        ];

        $clinic_id = Request()->route('clinic');
        $slug = auth()->user()->role->slug;
        $viewRoute = route($slug.'.clinic.doctor.index', $clinic_id);

        $edit_id = false;
        $form_action = route($slug.'.clinic.doctor.store',$clinic_id);

        if(Request()->route('doctor')){
            $edit_id = Request()->route('doctor');
            $form_action = route($slug.'.clinic.doctor.update', ['clinic' =>$clinic_id, 'doctor' =>$edit_id]);
        }
        $monday_time = (isset($edit_values) && !empty($edit_values->monday_time) ? explode(' - ', $edit_values->monday_time) : []);
        $tuesday_time = (isset($edit_values) && !empty($edit_values->tuesday_time) ? explode(' - ', $edit_values->tuesday_time) : []);
        $wednesday_time = (isset($edit_values) && !empty($edit_values->wednesday_time) ? explode(' - ', $edit_values->wednesday_time) : []);
        $thursday_time = (isset($edit_values) && !empty($edit_values->thursday_time) ? explode(' - ', $edit_values->thursday_time) : []);
        $friday_time = (isset($edit_values) && !empty($edit_values->friday_time) ? explode(' - ', $edit_values->friday_time) : []);
        $saturday_time = (isset($edit_values) && !empty($edit_values->saturday_time) ? explode(' - ', $edit_values->saturday_time) : []);
        $sunday_time = (isset($edit_values) && !empty($edit_values->sunday_time) ? explode(' - ', $edit_values->sunday_time) : []);
        
    @endphp

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-12 col-12 mb-1">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route($slug.'.dashbord')}}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{route($slug.'.clinic.index')}}">Clinics</a></li>
                                <li class="breadcrumb-item"><a href="{{$viewRoute}}">Doctors In Clinic</a></li>
                                <li class="breadcrumb-item active">{{ $edit_id ? 'Edit' : 'Add New' }} Doctor In Clinic</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">

                <section id="column-visibility">
                        <form class="form-horizontal" method="post" action="{{$form_action}}" enctype="multipart/form-data" novalidate>

                            <div class="row">

                                <div class="col-xl-12 col-md-12 col-sm-12">
                                    <div class="card">
                                        <div class="card-header  bg-hexagons">
                                            <h4 class="card-title">Doctor In Clinic</h4>
                                            <a class="heading-elements-toggle"><i
                                                    class="la la-ellipsis-v font-medium-3"></i></a>
                                            <div class="heading-elements">
                                                <ul class="list-inline mb-0">
                                                    <li><a class="btn btn-sm btn-outline-primary primary" data-action="collapse"><i class="ft-minus"></i></a></li>
                                                    <li><a class="btn btn-sm btn-outline-primary primary" data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                                    <li><a class="btn btn-sm btn-outline-primary primary" data-action="expand"><i class="ft-maximize"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="card-content collapse show">
                                            <div class="card-body card-dashboard">

                                                {{csrf_field()}}

                                                <div class="row">

                                                    <div class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-12 <?php if ($errors->has('doctor_id')) echo 'error'; ?>">
                                                        <label>Doctor <span class="required">*</span></label>
                                                        <div class="controls">
                                                            <select class="select2 form-control" id="doctor_id" name="doctor_id" >
                                                                @foreach($doctors as $doctor)
                                                                    <option value="{{$doctor->id}}" 
                                                                    @if(isset($patient) && $patient->id == $doctor->id) selected @endif >
                                                                    {{$doctor->name}}</option>
                                                                @endforeach
                                                            </select>
                                                            @if($errors->has('doctor_id'))
                                                                <div class="help-block text-danger doctor_id-shopwoo-error">
                                                                    <ul role="alert">
                                                                        <li>{{$errors->first('doctor_id')}}</li>
                                                                    </ul>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div> 

                                                    <div class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-12 <?php if ($errors->has('appointment_duration')) echo 'error'; ?>">
                                                        <label>Appointment Duration (Min.)</label>
                                                        <div class="controls">
                                                            <input type="text" name="appointment_duration" class="form-control"
                                                                data-validation-containsnumber-regex="((\d+)?)"
                                                                data-validation-containsnumber-message="Enter a valid number"
                                                                value="{{ old('appointment_duration', isset($edit_values) ? $edit_values->appointment_duration : NULL) }}">
                                                            @if($errors->has('appointment_duration'))
                                                                <div class="help-block text-danger appointment_duration-shopwoo-error">
                                                                    <ul role="alert">
                                                                        <li>{{$errors->first('appointment_duration')}}</li>
                                                                    </ul>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-xl-2 col-lg-2 col-md-3 col-sm-12 label-control text-left">Monday Time From:</label>
                                                    <div class="col-xl-2 col-lg-2 col-md-3 col-sm-12 controls">
                                                        <input type="text"class="form-control" placeholder="08:00" name="monday_time_from"
                                                                data-validation-regex-regex="([01]?[0-9]|2[0-3]):[0-5][0-9](:[0-5][0-9])?"
                                                                data-validation-regex-message="Enter a valid time format"
                                                                value={{old('monday_time_from', !empty($monday_time) ? $monday_time[0] : null)}}>

                                                    </div>
                                                    <label class="col-xl-1 col-lg-1 col-md-1 col-sm-12 label-control text-center">To:</label>
                                                    <div class="col-xl-2 col-lg-2 col-md-3 col-sm-12">
                                                        <input type="text" class="form-control" placeholder="13:00" name="monday_time_to"
                                                                data-validation-regex-regex="([01]?[0-9]|2[0-3]):[0-5][0-9](:[0-5][0-9])?"
                                                                data-validation-regex-message="Enter a valid time format"
                                                                value={{old('monday_time_from', !empty($monday_time) ? $monday_time[1] : null)}}>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-xl-2 col-lg-2 col-md-3 col-sm-12 label-control text-left">Tuesday Time From:</label>
                                                    <div class="col-xl-2 col-lg-2 col-md-3 col-sm-12">
                                                        <input type="text" class="form-control" placeholder="08:00" name="tuesday_time_from"
                                                                data-validation-regex-regex="([01]?[0-9]|2[0-3]):[0-5][0-9](:[0-5][0-9])?"
                                                                data-validation-regex-message="Enter a valid time format"
                                                                value={{old('tuesday_time_from', !empty($tuesday_time) ? $tuesday_time[0] : null)}}>

                                                    </div>
                                                    <label class="col-xl-1 col-lg-1 col-md-1 col-sm-12 label-control text-center">To:</label>
                                                    <div class="col-xl-2 col-lg-2 col-md-3 col-sm-12">
                                                        <input type="text" class="form-control" placeholder="13:00" name="tuesday_time_to"
                                                                data-validation-regex-regex="([01]?[0-9]|2[0-3]):[0-5][0-9](:[0-5][0-9])?"
                                                                data-validation-regex-message="Enter a valid time format"
                                                                value={{old('tuesday_time_to', !empty($tuesday_time) ? $tuesday_time[1] : null)}}>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-xl-2 col-lg-2 col-md-3 col-sm-12 label-control text-left">Wednesday Time From:</label>
                                                    <div class="col-xl-2 col-lg-2 col-md-3 col-sm-12">
                                                        <input type="text" class="form-control" placeholder="08:00" name="wednesday_time_from"
                                                                data-validation-regex-regex="([01]?[0-9]|2[0-3]):[0-5][0-9](:[0-5][0-9])?"
                                                                data-validation-regex-message="Enter a valid time format"
                                                                value={{old('wednesday_time_from', !empty($wednesday_time) ? $wednesday_time[0] : null)}}>

                                                    </div>
                                                    <label class="col-xl-1 col-lg-1 col-md-1 col-sm-12 label-control text-center">To:</label>
                                                    <div class="col-xl-2 col-lg-2 col-md-3 col-sm-12">
                                                        <input type="text" class="form-control" placeholder="13:00" name="wednesday_time_to"
                                                                data-validation-regex-regex="([01]?[0-9]|2[0-3]):[0-5][0-9](:[0-5][0-9])?"
                                                                data-validation-regex-message="Enter a valid time format"
                                                                value={{old('wednesday_time_to', !empty($wednesday_time) ? $wednesday_time[1] : null)}}>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-xl-2 col-lg-2 col-md-3 col-sm-12 label-control text-left">Thursday Time From:</label>
                                                    <div class="col-xl-2 col-lg-2 col-md-3 col-sm-12">
                                                        <input type="text" class="form-control" placeholder="08:00" name="thursday_time_from"
                                                                data-validation-regex-regex="([01]?[0-9]|2[0-3]):[0-5][0-9](:[0-5][0-9])?"
                                                                data-validation-regex-message="Enter a valid time format"
                                                                value={{old('thursday_time_from', !empty($thursday_time) ? $thursday_time[0] : null)}}>

                                                    </div>
                                                    <label class="col-xl-1 col-lg-1 col-md-1 col-sm-12 label-control text-center">To:</label>
                                                    <div class="col-xl-2 col-lg-2 col-md-3 col-sm-12">
                                                        <input type="text" class="form-control" placeholder="13:00" name="thursday_time_to"
                                                                data-validation-regex-regex="([01]?[0-9]|2[0-3]):[0-5][0-9](:[0-5][0-9])?"
                                                                data-validation-regex-message="Enter a valid time format"
                                                                value={{old('thursday_time_to', !empty($thursday_time) ? $thursday_time[1] : null)}}>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-xl-2 col-lg-2 col-md-3 col-sm-12 label-control text-left">Friday Time From:</label>
                                                    <div class="col-xl-2 col-lg-2 col-md-3 col-sm-12">
                                                        <input type="text" class="form-control" placeholder="08:00" name="friday_time_from"
                                                                data-validation-regex-regex="([01]?[0-9]|2[0-3]):[0-5][0-9](:[0-5][0-9])?"
                                                                data-validation-regex-message="Enter a valid time format"
                                                                value={{old('friday_time_from', !empty($friday_time) ? $friday_time[0] : null)}}>

                                                    </div>
                                                    <label class="col-xl-1 col-lg-1 col-md-1 col-sm-12 label-control text-center">To:</label>
                                                    <div class="col-xl-2 col-lg-2 col-md-3 col-sm-12">
                                                        <input type="text" class="form-control" placeholder="13:00" name="friday_time_to"
                                                                data-validation-regex-regex="([01]?[0-9]|2[0-3]):[0-5][0-9](:[0-5][0-9])?"
                                                                data-validation-regex-message="Enter a valid time format"
                                                                value={{old('friday_time_to', !empty($friday_time) ? $friday_time[1] : null)}}>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-xl-2 col-lg-2 col-md-3 col-sm-12 label-control text-left">Saturday Time From:</label>
                                                    <div class="col-xl-2 col-lg-2 col-md-3 col-sm-12">
                                                        <input type="text" class="form-control" placeholder="08:00" name="saturday_time_from"
                                                                data-validation-regex-regex="([01]?[0-9]|2[0-3]):[0-5][0-9](:[0-5][0-9])?"
                                                                data-validation-regex-message="Enter a valid time format"
                                                                value={{old('saturday_time_from', !empty($saturday_time) ? $saturday_time[0] : null)}}>

                                                    </div>
                                                    <label class="col-xl-1 col-lg-1 col-md-1 col-sm-12 label-control text-center">To:</label>
                                                    <div class="col-xl-2 col-lg-2 col-md-3 col-sm-12">
                                                        <input type="text" class="form-control" placeholder="13:00" name="saturday_time_to"
                                                                data-validation-regex-regex="([01]?[0-9]|2[0-3]):[0-5][0-9](:[0-5][0-9])?"
                                                                data-validation-regex-message="Enter a valid time format"
                                                                value={{old('saturday_time_to', !empty($saturday_time) ? $saturday_time[1] : null)}}>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-xl-2 col-lg-2 col-md-3 col-sm-12 label-control text-left">Sunday Time From:</label>
                                                    <div class="col-xl-2 col-lg-2 col-md-3 col-sm-12">
                                                        <input type="text" class="form-control" placeholder="08:00" name="sunday_time_from"
                                                                data-validation-regex-regex="([01]?[0-9]|2[0-3]):[0-5][0-9](:[0-5][0-9])?"
                                                                data-validation-regex-message="Enter a valid time format"
                                                                value={{old('sunday_time_from', !empty($sunday_time) ? $sunday_time[0] : null)}}>

                                                    </div>
                                                    <label class="col-xl-1 col-lg-1 col-md-1 col-sm-12 label-control text-center">To:</label>
                                                    <div class="col-xl-2 col-lg-2 col-md-3 col-sm-12">
                                                        <input type="text" class="form-control" placeholder="13:00" name="sunday_time_to"
                                                                data-validation-regex-regex="([01]?[0-9]|2[0-3]):[0-5][0-9](:[0-5][0-9])?"
                                                                data-validation-regex-message="Enter a valid time format"
                                                                value={{old('sunday_time_to', !empty($sunday_time) ? $sunday_time[1] : null)}}>
                                                    </div>
                                                </div>

                                                <div class="form-actions text-right from-submit-btn">

                                                    @if( $edit_id )
                                                        @method('PUT')
                                                        <button type="submit" class="btn btn-success"><i class="fa-save"></i> Update</button>
                                                        <a href="{{url($viewRoute)}}" class="btn btn-outline-primary primary"><i class="ft-x"></i> Cancel</a>

                                                    @else

                                                        <button type="submit" class="btn btn-primary "><i class="ft-save"></i> Save</button>
                                                        <button type="reset" class="btn btn-outline-primary primary"><i class="ft-refresh-cw"></i> Reset</button>

                                                    @endif

                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </form>
                </section>

            </div>
        </div>
    </div>

@stop
