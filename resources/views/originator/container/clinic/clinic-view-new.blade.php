<style>
    table th {
        width: 100px;
        text-align: center;
    }

    body {
        display: none;
    }

    .validateTime input::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
        color: gray;
        opacity: 0.3;
    }

    .table thead tr td {
        text-align: center;
    }

    table tbody tr td {

        font-family: 'Archivo';
        font-style: normal;
        font-weight: 400;
        font-size: 12px;
        line-height: 100%;
        white-space: nowrap;
    }

    table td {
        white-space: nowrap;
    }

    table th {
        white-space: nowrap;
    }

    svg {
        display: inline-block;
        width: 20px;
    }
</style>

<link rel="stylesheet" href="{{asset('vendors/dist/accordion.min.css')}}">

@php
    $title = 'Clinics';
@endphp
@extends('originator.root.dashboard_side_bar',['title' => $title])
@section('title', "Clinics")
@section('content')
    @php

        $slug = auth()->user()->role->slug;
        $viewRoute = route($slug.'.clinic.index');

        $edit_id = false;
        $form_action = route($slug.'.clinic.store');

        if(Request()->route('clinic')){
        $edit_id = Request()->route('clinic');
        $form_action = route($slug.'.clinic.update', $edit_id);
        }
    @endphp
    <!-- saadullah -->
    <style>
        .tablerow tr td {
            line-height: 20px !important;
        }
    </style>
    <div class="main-container">
        <div class="m-3">
            <div class="row">
                <div class="col-xl-12 ">
                    <div class="row">

                        <div class="col-xl-5 mb-30">
                            <div class="carx2 input">
                                <form action="{{url(Request()->path())}}" id="filter-form" method="get">
                                    <input type="text" name="filter" class="form-control" placeholder="Search..."
                                           value="{{Request()->has('filter') ? Request()->get('filter') : ''}}">
                                    <div class="searchicons">
                                        <button type="submit" style="background: none;border:none;"><i
                                                class="bi bi-search" style="margin-right:12px;"></i></button>
                                        |
                                        <a href="{{Request()->has('filter') ? url(Request()->path()) : 'JavaScript:void(0);'}}">
                                            <i class="bi bi-sliders"></i>
                                        </a>
                                    </div>

                                </form>
                            </div>
                        </div>
                        <div class="col-xl-3 ">

                        </div>
                        <div class="col-xl-4 mb-30 bgcolorbordertxt">
                            <!-- <a class="btn bgcolor text-white casebtn addcase float-right" style="margin-left:7%;">New Clinic<i class="bi bi-plus-circle"></i></a>
                            <a class="btn bgcolorborder  delete" style="font-size:22px; float:right">Delete<i class="bi bi-trash3" style=""></i></a> -->
                            <a class="btn bgcolor float-right m-1 text-white  addcase" id="addClinic"
                               onclick="editFunction()">New Clinic<i class="bi bi-plus-circle"></i></a>

                            <a class="btn btn bg border border-dark  btn-xl color  border-radius-8 bgcolorborder  m-1  float-right  delete" style="font-size:22px;">Delete<i
                                    class="bi bi-trash3"></i></a>

                            <a class="btn bgcolorborder hitme d-none m-1 float-right pooopdo addkado"
                               style="font-size:22px;">Delete<i class="bi bi-trash3"></i></a>

                            <a class="ete checkboxbandka cursor cleardo float-right"
                               style="margin-top:5px;font-size:22px;display: none;">Clear
                                <i class="bi bi-eraser-fill"></i></a>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-12 responsive ">
                            <div class="table-responsive">
                                <table class="table tablerow">
                                    <thead>
                                    <th class=" checkboxbandka " style="display: none;">
                                        <input type="checkbox" style="float: left;" id="btnCheckAll"></th>
                                    <th style="font-size: 13px !important;">Clinic ID</th>
                                    <th style="font-size: 13px !important;"><span
                                            style="visibility: hidden">Clinicde </span>Clinic
                                    </th>
                                    <th style="font-size: 13px !important;"><span
                                            style="visibility: hidden">Clinicdeied </span>Address
                                    </th>
                                    <th style="font-size: 13px !important;"><span
                                            style="visibility: hidden">deie </span>Contact Person
                                    </th>
                                    <th style="font-size: 13px !important;">Contact Person Email</th>
                                    <th style="font-size: 13px !important;">Contact Person Number</th>
                                    <!-- <th  style="font-size: 9px !important;">Associated Doctor</th> -->
                                    <th style="font-size: 13px !important;">Action</th>
                                    </thead>
                                </table>
                            </div>
                            <div class="accordion-container">
                                @php($a = 1)
                                @foreach($clinics as $clinic)
                                    <div class="ac">
                                        <h2 class="ac-header">
                                        <span class=" table-responsive">
                                               <table class="table tablerow" id="example">
                                            <thead>
                                                <tr style="width:100%;">
                                                <th class=" checkboxbandka"
                                                    style="display: none;width:3%;position: relative;top: -17px;">
                                                <input type="checkbox" id="a{{$a++}}" value="{{$clinic->id}}">
                                                    </td>
                                                    <td style="font-size: 14px !important;width:14%;">{{$clinic->id}}</td>
                                                <td style="font-size: 14px !important;width:14%;">{{ substr(ucwords($clinic->name),0,12) }}...</td>
                                                <td style="font-size: 14px !important;width:14%;">{{ isset($clinic->address) ? substr(ucwords($clinic->address->value),0 , 10) : 'N/A'}}...
                                                </td>
                                                <td style="font-size: 14px !important;width:14%;">{{ isset($clinic->address) ? substr(ucwords($clinic->address->contact_person_name),0,6) : 'N/A'}}...</td>
                                                <td style="font-size: 14px !important;width:14%;">{{ isset($clinic->address) ? substr(ucfirst($clinic->address->contact_person_email),0,6) : 'N/A'}}..</td>
                                                <td style="font-size: 14px !important;width:14%;">{{ isset($clinic->address) ? $clinic->address->contact_person_number : 'N/A'}}</td>
                                                <!-- <th  style="font-size: 9px !important;">{{($clinic->associated_doctor != null)? $clinic->associated_doctor['name'] : ''}}</th> -->
                                                    <td class="ac-trigger"
                                                        style="width:100px !important;padding-left:40%; padding:19%;float: right;"><i
                                                            class="bi bi-pencil-square"
                                                            onclick="editFunction('{{$clinic->id}}')"></i></td>
                                                </tr>
                                            </thead>
                                            </table>
                                        </span>
                                        </h2>
                                        <div class="ac-panel">
                                            @if($clinic->clinicDoctors->count())
                                                @foreach($clinic->clinicDoctors as $clinicDoctor)
                                                    @if($clinicDoctor->pivot->deleted_at == null )
                                                        <table class="table tablerow" id="example">
                                                            <tbody class="tablerow">
                                                            <tr>
                                                                <td style="font-size:20px;font-weight: bold;">{{ucwords($clinicDoctor->name)}}
                                                                    <i style="margin-top:15px;"
                                                                       class="bi bi-three-dots-vertical dropdown-toggle"
                                                                       type="button" id="dropdownMenuButton"
                                                                       data-toggle="dropdown" aria-haspopup="true"
                                                                       aria-expanded="false"></i>
                                                                    <div class="dropdown-menu"
                                                                         aria-labelledby="dropdownMenuButton">
                                                                        <a class="dropdown-item"
                                                                           style="text-align: center;padding: 0;text-decoration: none;"
                                                                           onclick="showDoctors('{{$clinicDoctor->pivot->id}}','{{$clinic->id}}')">Edit</a>
                                                                        <a class="dropdown-item"
                                                                           style="text-align: center;padding: 0;text-decoration: none;"
                                                                           onclick="deleteClinicDoctor('{{$clinicDoctor->pivot->id}}')">Delete</a>
                                                                    </div>
                                                                </td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="monday">
                                                                    <a style="text-decoration: none;">Monday<span
                                                                            class="{{($clinicDoctor->pivot->monday_time == null)? 'no':'yes'}}">{{($clinicDoctor->pivot->monday_time == null)? 'no':'yes'}}</span>
                                                                    </a>
                                                                    <br>
                                                                    <span class="spando"
                                                                          style="display: inline-block;height: 37px;">
                                                        {{$clinicDoctor->pivot->monday_time}}
                                                        </span>
                                                                </td>
                                                                <td class="tuesday">
                                                                    <a style="text-decoration: none;">Tuesday<span
                                                                            class="{{($clinicDoctor->pivot->tuesday_time == null)? 'no':'yes'}}">{{($clinicDoctor->pivot->tuesday_time == null)? 'no':'yes'}}</span>
                                                                    </a>
                                                                    <br>
                                                                    <span class="spando"
                                                                          style="display: inline-block;height: 37px;">
                                                        {{$clinicDoctor->pivot->tuesday_time}}
                                                        </span>
                                                                </td>
                                                                <td class="wednesday">
                                                                    <a style="text-decoration: none;">Wednesday<span
                                                                            class="{{($clinicDoctor->pivot->wednesday_time == null)? 'no':'yes'}}">{{($clinicDoctor->pivot->wednesday_time == null)? 'no':'yes'}}</span>
                                                                    </a>
                                                                    <br>
                                                                    <span class="spando"
                                                                          style="display: inline-block;height: 37px;">
                                                        {{$clinicDoctor->pivot->wednesday_time}}
                                                        </span>
                                                                </td>
                                                                <td class="thursday">
                                                                    <a style="text-decoration: none;">Thursday<span
                                                                            class="{{($clinicDoctor->pivot->thursday_time == null)? 'no':'yes'}}">{{($clinicDoctor->pivot->thursday_time == null)? 'no':'yes'}}</span>
                                                                    </a>
                                                                    <br>
                                                                    <span class="spando"
                                                                          style="display: inline-block;height: 37px;">
                                                        {{$clinicDoctor->pivot->thursday_time}}
                                                        </span>
                                                                </td>
                                                                <td class="friday">
                                                                    <a style="text-decoration: none;">Friday<span
                                                                            class="{{($clinicDoctor->pivot->friday_time == null)? 'no':'yes'}}">{{($clinicDoctor->pivot->friday_time == null)? 'no':'yes'}}</span>
                                                                    </a>
                                                                    <br>
                                                                    <span class="spando"
                                                                          style="display: inline-block;height: 37px;">
                                                        {{$clinicDoctor->pivot->friday_time}}
                                                        </span>
                                                                </td>
                                                                <td class="saturday">
                                                                    <a style="text-decoration: none;">Saturday<span
                                                                            class="{{($clinicDoctor->pivot->saturday_time == null)? 'no':'yes'}}">{{($clinicDoctor->pivot->saturday_time == null)? 'no':'yes'}}</span>
                                                                    </a>
                                                                    <br>
                                                                    <span class="spando"
                                                                          style="display: inline-block;height: 37px;">
                                                        {{$clinicDoctor->pivot->saturday_time}}
                                                        </span>
                                                                </td>
                                                                <td class="sunday">
                                                                    <a style="text-decoration: none;">Sunday<span
                                                                            class="{{($clinicDoctor->pivot->sunday_time == null)? 'no':'yes'}}">{{($clinicDoctor->pivot->sunday_time == null)? 'no':'yes'}}</span>
                                                                    </a>
                                                                    <br>
                                                                    <span class="spando"
                                                                          style="display: inline-block;height: 37px;">
                                                        {{$clinicDoctor->pivot->sunday_time}}
                                                        </span>
                                                                </td>

                                                                <td>
                                                                    <i style="margin-top:15px;"
                                                                       class="bi bi-three-dots-vertical dropdown-toggle"
                                                                       type="button" id="dropdownMenuButton"
                                                                       data-toggle="dropdown" aria-haspopup="true"
                                                                       aria-expanded="false"></i>
                                                                    <div class="dropdown-menu"
                                                                         aria-labelledby="dropdownMenuButton">
                                                                        <a class="dropdown-item"
                                                                           style="text-align: center;padding: 0;text-decoration: none;"
                                                                           onclick="showDoctors('{{$clinicDoctor->pivot->id}}','{{$clinic->id}}')">Edit</a>
                                                                        <a class="dropdown-item"
                                                                           style="text-align: center;padding: 0;text-decoration: none;"
                                                                           onclick="deleteClinicDoctor('{{$clinicDoctor->pivot->id}}')">Delete</a>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    @endif
                                                @endforeach
                                            @else
                                                <div class="d-flex justify-content-center py-3">
                                                    <span>No Doctor Added</span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                @endforeach
                                {{ $clinics->links() }}
                            </div>

                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab"></div>
            </div>
        </div>


    </div>

    <script src="{{ asset('vendors/dist/accordion.min.js') }}"></script>

    <script>
        new Accordion('.accordion-container');

    </script>

    <!-- js -->
    <script src="{{asset('vendors/scripts/core.js')}} "></script>
    <script src="{{asset('vendors/scripts/script.min.js')}} "></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    </body>

    </html>
    <div class="pop1  scrolldo " style="display:none">
        <div class="row m-0">
            <div class="col-md-7">
            </div>
            <div class="col-md-5 bg-white popadd">
                <div class="page6box py-3 p-2">
                </div>
                <div class="row px-4 mb-5 ">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12 bold p-0">
                                <h5 class="textcolor">Add New Clinic</h5>
                                <p style="font-size: 13px;color: #202429;font-weight: 300;">Complete the information
                                    related to the clinic</p>
                                <i class="fa-solid float-right cursor fa-xmark " onclick="bndka();"></i>

                            </div>

                        </div>
                    </div>
                    <div class="col-md-12 px-4 brdall py-4">
                        <form class="form-horizontal" method="post" id="frmclinic" action=""
                              enctype="multipart/form-data" novalidate>
                            <div class="row">
                                <h5 class="textcolor px-2">Clinic Details</h5>
                            </div>
                            <div class="row  pt-4">
                                <div class="col-md-6 bold ">
                                    <span>Clinic</span>
                                    <input type="hidden" name="ElementId" id="ElementId" value="">
                                    <input type="text" name="name" id="name" class="form-control"
                                           placeholder="Enter Here">
                                </div>
                                <div class="col-md-6 mb-4 bold ">
                                    <span>Country</span>
                                    <select class="select2 form-control" id="country_id" name="country_id"
                                            style="font-size: 12px;color: #858181;" required>
                                        <option value="">Select Country</option>
                                        @foreach($countries as $country)
                                            <option
                                                {{ isset($edit_values) ? (isset($edit_values->address) ?  ($edit_values->address->country_id == $country->id ? 'selected' : '') : ''  ) : ''  }}  value="{{$country->id}}">{{$country->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-12 mb-4 bold ">
                                    <span>Address*</span>
                                    <input type="text" name="address" id="address" class="form-control"
                                           placeholder="Enter Here" required>
                                </div>
                                <div class="col-md-6 mb-4 bold ">
                                    <span>State</span>
                                    <select class="select2 form-control" id="state_id" name="state_id" required
                                            style="font-size: 12px;color: grey;" required>
                                        <option>Select State</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-4 bold ">
                                    <span>City</span>
                                    <select class="select2 form-control" id="city_id" name="city_id" required
                                            style="font-size: 12px;color: grey;" required>
                                        <option>Select City</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-4 bold ">
                                    <span>Contact Person Name*</span>
                                    <input type="" name="contact_person_name" id="contact_person_name"
                                           class="form-control" placeholder="Enter Here" required>
                                </div>
                                <div class="col-md-6 mb-4 bold ">
                                    <span>Contact Person Email*</span>
                                    <input type="email" name="contact_person_email" id="contact_person_email"
                                           class="form-control" placeholder="Enter Here" required>
                                </div>
                                <div class="col-md-6 mb-4 bold ">
                                    <span>Contact Person Number*</span>
                                    <input type="text" name="contact_person_number" id="contact_person_number"
                                           class="form-control" placeholder="Enter Here" required>
                                </div>


                            </div>
                            <div class="row mt-3 ">

                                <div class="col-md-12 col ">
                                    <button type="submit" class="btn bgcolor text-white casebtn float-right"
                                            id="btn_submit">Submit
                                    </button>
                                    <a class="btn bg border border-radius-8  btn-xl color mb-5 bgcolorborder float-right mx-2" style="font-size:22px;"
                                       onclick="bndka();">Cancel</a>
                        </form>
                    </div>
                </div>


            </div>
            <div class="col-md-12 px-4 brdall py-4 mt-3 d-none" id="associate_doctor">

                <form class="form-horizontal" method="post" id="frmdoctor" action="" enctype="multipart/form-data"
                      novalidate>
                    <div class="row m-0 ">
                        <h5 class="textcolor px-2">Associated Doctor</h5>
                    </div>


                    <div class="col-md-12 mb-4 bold ">
                        <span>Name*</span>

                        <input type="hidden" name="doctorId" id="ClinicDocId" value="">
                        <select class="form-select form-control" id="doctor_id" name="doctor_id">
                            <option selected>Select</option>
                            @foreach($doctors as $doctor)
                                <option value="{{$doctor->id}}"
                                        @if(isset($patient) && $patient->id == $doctor->id) selected @endif >
                                    {{ucwords($doctor->name)}}</option>
                            @endforeach
                        </select>
                    </div>
                    <span style="font-weight: bold;padding-left:12px;">Timings</span>
                    <b style="padding-left: 15%;font-size:12px;color:red;display:none;" id="v_time_msg"></b>
                    <div class="row m-0 ">
                        <div class="col-md-5 mb-4 bold validateTime ">

                            <label style="font-size:14px;font-weight: 300;">
                                Monday
                            </label>
                            <input type="" name="monday_time_from" class="form-control" placeholder="08:00"
                                   autocomplete="off" id="monday_time_from" style="margin-top:3px;">
                        </div>
                        <div class="col-md-5 mb-4 bold validateTime ">

                            <span style="font-weight: bold;visibility: hidden;">Timings</span>
                            <input type="" name="monday_time_to" id="monday_time_to" class="form-control"
                                   autocomplete="off" placeholder="13:00">
                        </div>

                        <div class="col-md-2 mb-4 bold ">
                            <div class="custom-control custom-switch" style="margin-top: 2.7rem;">
                                <input type="checkbox" class="custom-control-input" id="customSwitches1"
                                       onclick="ChangeVisibility('monday',this)" autocomplete="off" checked>
                                <label class="custom-control-label" for="customSwitches1"></label>
                            </div>
                        </div>
                    </div>
                    <div class="row m-0 ">
                        <div class="col-md-5 mb-4 bold validateTime ">

                            <label style="font-size:14px;font-weight: 300;">
                                Tuesday
                            </label>
                            <input type="" name="tuesday_time_from" id="tuesday_time_from" class="form-control"
                                   autocomplete="off" placeholder="08:00" style="margin-top:3px;">
                        </div>
                        <div class="col-md-5 mb-4 bold validateTime ">

                            <span style="font-weight: bold;visibility: hidden;">Timings</span>
                            <input type="" name="tuesday_time_to" id="tuesday_time_to" class="form-control"
                                   autocomplete="off" placeholder="13:00">
                        </div>

                        <div class="col-md-2 mb-4 bold ">
                            <div class="custom-control custom-switch  " style="margin-top: 2.7rem;">
                                <input type="checkbox" class="custom-control-input" id="customSwitches2"
                                       onclick="ChangeVisibility('tuesday',this)" checked>
                                <label class="custom-control-label" for="customSwitches2"></label>
                            </div>
                        </div>
                    </div>
                    <div class="row m-0 ">
                        <div class="col-md-5 mb-4 bold validateTime ">

                            <label style="font-size:14px;font-weight: 300;">
                                Wednesday
                            </label>
                            <input type="" name="wednesday_time_from" id="wednesday_time_from" autocomplete="off"
                                   class="form-control" placeholder="08:00"
                                   data-validation-regex-regex="([01]?[0-9]|2[0-3]):[0-5][0-9](:[0-5][0-9])?"
                                   data-validation-regex-message="Enter a valid time format"
                                   style="margin-top:3px;">
                        </div>
                        <div class="col-md-5 mb-4 bold validateTime ">

                            <span style="font-weight: bold;visibility: hidden;">Timings</span>
                            <input type="" name="wednesday_time_to" id="wednesday_time_to" autocomplete="off"
                                   class="form-control" placeholder="13:00">
                        </div>

                        <div class="col-md-2 mb-4 bold ">
                            <div class="custom-control custom-switch" style="margin-top: 2.7rem;">
                                <input type="checkbox" class="custom-control-input" id="customSwitches3"
                                       onclick="ChangeVisibility('wednesday',this)" checked>
                                <label class="custom-control-label" for="customSwitches3"></label>
                            </div>
                        </div>
                    </div>
                    <div class="row m-0 ">
                        <div class="col-md-5 mb-4 bold validateTime ">

                            <label style="font-size:14px;font-weight: 300;">
                                Thursday
                            </label>
                            <input name="thursday_time_from" id="thursday_time_from" autocomplete="off"
                                   class="form-control" placeholder="08:00" style="margin-top:3px;">
                        </div>
                        <div class="col-md-5 mb-4 bold validateTime ">

                            <span style="font-weight: bold;visibility: hidden;">Timings</span>
                            <input type="" name="thursday_time_to" id="thursday_time_to" autocomplete="off"
                                   class="form-control" placeholder="13:00">
                        </div>

                        <div class="col-md-2 mb-4 bold ">
                            <div class="custom-control custom-switch" style="margin-top: 2.7rem;">
                                <input type="checkbox" class="custom-control-input" id="customSwitches4"
                                       onclick="ChangeVisibility('thursday',this)" checked>
                                <label class="custom-control-label" for="customSwitches4"></label>
                            </div>
                        </div>
                    </div>
                    <div class="row m-0 ">
                        <div class="col-md-5 mb-4 bold validateTime ">

                            <label style="font-size:14px;font-weight: 300;">
                                Friday
                            </label>
                            <input type="" name="friday_time_from" id="friday_time_from" autocomplete="off"
                                   class="form-control" placeholder="08:00" style="margin-top:3px;">
                        </div>
                        <div class="col-md-5 mb-4 bold validateTime ">

                            <span style="font-weight: bold;visibility: hidden;">Timings</span>
                            <input type="" name="friday_time_to" id="friday_time_to" autocomplete="off"
                                   class="form-control" placeholder="13:00">
                        </div>

                        <div class="col-md-2 mb-4 bold ">
                            <div class="custom-control custom-switch  " style="margin-top: 2.7rem;">
                                <input type="checkbox" class="custom-control-input" id="customSwitches5"
                                       onclick="ChangeVisibility('friday',this)" checked>
                                <label class="custom-control-label" for="customSwitches5"></label>
                            </div>
                        </div>
                    </div>
                    <div class="row m-0 ">
                        <div class="col-md-5 mb-4 bold validateTime ">

                            <label style="font-size:14px;font-weight: 300;">
                                Saturday
                            </label>
                            <input type="" name="saturday_time_from" id="saturday_time_from" autocomplete="off"
                                   class="form-control" placeholder="08:00" style="margin-top:3px;">
                        </div>
                        <div class="col-md-5 mb-4 bold validateTime ">

                            <span style="font-weight: bold;visibility: hidden;">Timings</span>
                            <input type="" name="saturday_time_to" id="saturday_time_to" autocomplete="off"
                                   class="form-control" placeholder="13:00">
                        </div>

                        <div class="col-md-2 mb-4 bold ">
                            <div class="custom-control custom-switch  " style="margin-top: 2.7rem;">
                                <input type="checkbox" class="custom-control-input" id="customSwitches6"
                                       onclick="ChangeVisibility('saturday',this)" checked>
                                <label class="custom-control-label" for="customSwitches6"></label>
                            </div>
                        </div>
                    </div>
                    <div class="row m-0 ">
                        <div class="col-md-5 mb-4 bold validateTime ">

                            <label style="font-size:14px;font-weight: 300;">
                                Sunday
                            </label>
                            <input type="" name="sunday_time_from" id="sunday_time_from" autocomplete="off"
                                   class="form-control" placeholder="08:00" style="margin-top:3px;">
                        </div>
                        <div class="col-md-5 mb-4 bold validateTime ">

                            <span style="font-weight: bold;visibility: hidden;">Timings</span>
                            <input type="" name="sunday_time_to" id="sunday_time_to" autocomplete="off"
                                   class="form-control" placeholder="13:00">
                        </div>

                        <div class="col-md-2 mb-4 bold ">
                            <div class="custom-control custom-switch  " style="margin-top: 2.7rem;">
                                <input type="checkbox" class="custom-control-input" id="customSwitches7"
                                       onclick="ChangeVisibility('sunday',this)" checked>
                                <label class="custom-control-label" for="customSwitches7"></label>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3 ">

                        <div class="col-md-12 col ">
                            <button type="submit" class="btn bgcolor text-white casebtn float-right" id="btn_submit">
                                Submit
                            </button>
                            <a class="btn bgcolorborder float-right mx-3" style="font-size:22px;" onclick="bndka();">Cancel</a>
                </form>
            </div>
        </div>
    </div>
    </div>

    </div>
    </div>
    </div>
    <div class="pop2 d-none">
        <div class="row ">
            <div class="col-md-4">
            </div>
            <div class="col-md-4 bg-white popadd deleteform">
                <div class="page6box py-3 ">
                </div>
                <div class="row px-4 mb-5 ">
                    <div class="col-md-12">
                        <div class="row borderbottom">
                            <div class="col-md-11 p-0 aresure  bold m-auto">
                                <h5 class="t text-dark ">
                                    Are you sure you wanted to delete the case!
                                </h5>
                                <p class="mt-3">Once you delete this the data will be permanently removed</p>
                            </div>
                            <div class="col-md-1">
                                <!--                            <i class="fa-solid bandeka cursor fa-xmark " onclick="bndka1();"></i>-->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 delebtn">
                        <a class="btn  text-white casebtn float-right deletebtn">Delete</a>
                        <a class="btn cancelbtn  text-white  float-right" onclick="bndka1();">Cancel</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <!-- <script src="{{asset('vendors/dist/accordion.min.js')}}"></script> -->

    <script>
        $('nav[role="navigation"]').children().first().hide();
        //   $('nav[role="navigation"]').css('justify-content','end');
        $('nav[role="navigation"]').children().eq(1).css('display', 'flex');
        $('nav[role="navigation"]').children().eq(1).css('margin-top', '20px');
        $('nav[role="navigation"]').children().eq(1).css('justify-content', 'end');
        $('nav[role="navigation"]').children().eq(1).find('p').css('margin-right', '10px');
        $('span[aria-current="page"]').children().eq(0).removeClass('bg-white');
        $('span[aria-current="page"]').children().eq(0).css('color', 'white');
        $('span[aria-current="page"]').children().eq(0).css('background', '#18205c');


        $("#contact_person_number").bind("cut copy paste", function (event) {
            event.preventDefault();
        });
        $("#contact_person_number").on("contextmenu", function (event) {
            event.preventDefault();
        });

        function ChangeVisibility(value, el) {
            if ($(el).prop('checked')) {
                $('#' + value + '_time_from').prop('readonly', false);
                $('#' + value + '_time_to').prop('readonly', false);
            } else {
                $('#' + value + '_time_from').val('');
                $('#' + value + '_time_from').prop('readonly', true);
                $('#' + value + '_time_to').val('');
                $('#' + value + '_time_to').prop('readonly', true);
            }
        }
    </script>
    <script>
        // new Accordion('.accordion-container');
        var img_asset = "{{asset('vendors/images/')}}";
        var base_url = "{{url('admin/')}}";
        var records = "{{$a}}";
        $('.hitme').click(function () {
            $('.pop2').removeClass('d-none');
        });

        $('.delete').click(function () {

            $('.checkboxbandka').delay(300).removeClass('d-none');
            $(".checkboxbandka").fadeIn(1000);
            //code for selectig each checkbox
            var recordId = [];
            var a = 0;
            for (i = 1; i < records; i++) {
                if ($("#a" + i).is(':checked') == true) {
                    recordId[a] = $("#a" + i).val();
                    a++;
                }
            }
            if (recordId.length != 0) {
                $(".pop2").removeClass("d-none");
            }
        });

        $('.cleardo').click(function () {
            $('.delete').removeClass('d-none');
            $('.hitme').addClass('d-none');
            $('.checkboxbandka').addClass('d-none');
            var a = 0;
            for (i = 1; i < records; i++) {
                // recordId[a] = $("#a"+i).val();
                $("#a" + i).prop("checked", false);
                a++;
            }

        });

        function bndka() {
            $('.pop1').fadeOut('show');
            $('#frmclinic')[0].reset();
            $('#frmdoctor')[0].reset();
            $('#v_time_msg').css({'display': 'none'});
            $('#v_time_msg').text('');
        }

        function bndka1() {
            $('.pop2').addClass('d-none');
        }

        // $('.delete').click(function() {

        //     $('.pop2').removeClass('d-none');
        // });

        //    $(document).ready(function() {
        //        $("#example").DataTable();
        //    });
    </script>
    <script>

        $(document).ready(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                }
            });

            $("body").on("change", "#country_id", function () {

                var city_id = $('#city_id');
                city_id.empty();
                var state_id = $('#state_id');
                state_id.empty();

                var country_id = $(this).val();
                data = {
                    country_id: country_id
                };

                $.ajax({
                    url: '{{route("admin.get-state-by-country")}}',
                    type: "GET",
                    data: data,
                    dataType: 'json',
                    beforeSend: function () {
                        ajaxLoader();
                    },
                    success: function (responseCollection) {
                        state_id.append($('<option>', {
                            value: '',
                            text: 'Select State'
                        }));
                        $.each(responseCollection['data'], function (i, item) {
                            console.log(item.id, item.name);
                            state_id.append($('<option>', {
                                value: item.id,
                                text: item.name
                            }));
                        });
                        $('#loader').fadeOut();


                    }, error: function (e) {
                        var responseCollection = e.responseJSON;
                        toastr.error(responseCollection['message'], "Error!", {
                            positionClass: "toast-bottom-left",
                            containerId: "toast-bottom-left"
                        });
                        $('#loader').fadeOut();

                    }
                }); //end of ajax
            });

            $("body").on("change", "#state_id", function () {

                var city_id = $('#city_id');
                city_id.empty();

                var state_id = $(this).val();
                data = {
                    state_id: state_id
                };

                $.ajax({
                    url: '{{route("admin.get-city-by-state")}}',
                    type: "GET",
                    data: data,
                    dataType: 'json',
                    beforeSend: function () {
                        ajaxLoader();

                    },
                    success: function (responseCollection) {
                        city_id.append($('<option>', {
                            value: '',
                            text: 'Select City'
                        }));
                        $.each(responseCollection['data'], function (i, item) {
                            console.log(item.id, item.name);
                            city_id.append($('<option>', {
                                value: item.id,
                                text: item.name
                            }));
                            $('#loader').fadeOut();
                        });

                    }, error: function (e) {
                        var responseCollection = e.responseJSON;
                        toastr.error(responseCollection['message'], "Error!", {
                            positionClass: "toast-bottom-left",
                            containerId: "toast-bottom-left"
                        });
                        $('#loader').fadeOut();

                    }
                }); //end of ajax
            });

        });

    </script>
    <script src="{{asset('vendors/scripts/clinic_ajax.js')}}"></script>
