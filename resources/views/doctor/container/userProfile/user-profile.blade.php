@extends('doctor.root.index')

@section('title', "Profile")


@section('content')
<style>
.btn-light {
color: #FFF !important;
background-color: #A2A2A2;
border-color: #A2A2A2;
}
</style>
@php

$requiredSections = [
'Header' => 'doctor.components.side-nav',
'Footer' => 'doctor.components.footer'
];

$componentsJsCss = [
'adminPanel.general',
'adminPanel.datatable',
'adminPanel.sweetalert',
 'adminPanel.file-input-button',
];
$profileUpdateRoute = url('doctor/profile-update/'.auth()->user()->id);
$changePasswordRoute = url('doctor/change-password/'.auth()->user()->id);
$updateClinicsRoute = url('doctor/update-clinics/'.auth()->user()->id);


@endphp

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-12 col-12 mb-1">
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('doctor.dashbord')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Account Details</li>
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
                            <div class="card-body pt-0 mt-2">
                                <div class="row">
                                    <div class="col-md-12 col-12">
                                        <h2>My Clinics</h2>
                                    </div>
                                    <hr>
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                        <form method="POST" action="{{ $updateClinicsRoute }}">
                                            {{csrf_field()}}
                                           <select class="selectpicker" name="clinics_ids[]" multiple data-live-search="true">
                                             @foreach($ClinicDoctors as $ClinicDoctor)
                                             @isset($ClinicDoctor->clinic)
                                             <option {{$ClinicDoctor->status == 1 ? 'selected': ''}} value="{{$ClinicDoctor->clinic_id}}">{{$ClinicDoctor->clinic->name}}</option>
                                             @endisset
                                             @endforeach
                                            </select>                                         
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </form>
                                     </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="card">
                        <div class="card-content collapse show">
                            <div class="card-body pt-0 mt-2">
                                <div class="row">
                                    <div class="col-md-12 col-12">
                                        <h2>My Profile</h2>
                                    </div>
                                    <hr>
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                        <form method="POST" action="{{ $profileUpdateRoute }}" enctype="multipart/form-data">
                                            {{csrf_field()}}
                                            <h3 class="card-title">Full Name</h3>
                                            <input name="name" type="text" value="{{ $doctor->name }}"
                                                class="form-control mb-2">

                                            <h3 class="card-title">Email</h3>
                                            <input name="email" type="text" value="{{ $doctor->email }}"
                                                class="form-control mb-2">

                                            <h3 class="card-title">Phone Number</h3>
                                            <input name="phone" type="text" value="{{ $doctor->phone }}"
                                                class="form-control mb-2">

                                            <h3 class="card-title">Gender</h3>
                                            <select name="gender" id="gender" class="form-control mb-2">
                                                <option>Select Gender</option>
                                                <option value="MALE" {{ $doctor->gender === "MALE" ? 'selected' : ''
                                                    }}>Male</option>
                                                <option value="FEMALE" {{ $doctor->gender === "FEMALE" ? 'selected' : ''
                                                    }}>Female</option>
                                                <option value="OTHER" {{ $doctor->gender === "OTHER" ? 'selected' : ''
                                                    }}>Other</option>

                                            </select>
                                          <h3 class="card-title">Profile Image</h3>
                                                <label class="btn">
                                                        <input type="file" name="picture" class="hidden upload-attachment" data-type="image">
                                                        <img src="{{$doctor->picture}}" id="picture" alt="Image" class="img-thumbnail">
                                                    </label>   
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="card">
                        <div class="card-content collapse show">
                            <div class="card-body pt-0 mt-2">
                                <div class="row">
                                    <div class="col-md-12 col-12">
                                        <h2>Change Password</h2>
                                    </div>
                                    <hr>
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                        <form method="POST" action="{{ $changePasswordRoute }}">
                                            {{csrf_field()}}
                                            <h3 class="card-title">New Password</h3>
                                            <input name="password" type="password" class="form-control mb-2">

                                            <h3 class="card-title">Confirm New Password</h3>
                                            <input name="password_confirmation" type="password"
                                                class="form-control mb-2">

                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </form>

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