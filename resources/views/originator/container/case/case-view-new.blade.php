@php
    $title = 'Case';
@endphp
@extends('originator.root.dashboard_side_bar', ['title' => $title])
@section('title', 'Case')
@php
    $componentsJsCss = ['adminPanel.general', 'adminPanel.validation', 'adminPanel.select2', 'adminPanel.switch-checkbox', 'adminPanel.input-mask', 'adminPanel.datetime-picker', 'adminPanel.file-input-button'];
    $edit_id = false;
    $viewRoute = route('admin.case.index');
    $form_action = route('admin.case.store');
    if (Request()->route('case')) {
        $edit_id = Request()->route('case');
        $form_action = route('admin.case.update', $edit_id);
    }
@endphp
<link rel="stylesheet" href="{{ asset('vendors/css/case-style.css') }}"/>
<style>
    .item1 {
        border: 1px solid #e3e3e3 !important;
    }

    body {
        display: none;
    }

    #example1 tr td {
        width: 100px;
    }

    .switch_status {
        position: relative;
        display: inline-block;
        width: 45px;
        height: 34px;
    }

    .switch_status input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider_status {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
        height: 27px;

    }

    .slider_status:before {
        position: absolute;
        content: "";
        height: 20px;
        width: 20px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
        transform: translateY(1px);

    }

    .aws:checked + .slider_status {
        background-color: #00205C;
        transform: translateY(3px);

    }

    .aws:focus + .slider_status {
        box-shadow: 0 0 1px #00205C;
    }

    .aws:checked + .slider_status:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translate(18px, 1px);
        height: 20px;

    }

    /* Rounded sliders */
    .slider_status.round {
        border-radius: 34px;
    }

    .slider_status.round:before {
        border-radius: 50%;
    }

    .tablerow tr td {
        line-height: 4px !important;
        font-size: 13px !important;
        white-space: nowrap;
    }

    .tablerow tr td a {
        color: #00205C;
        padding: 10px 18px;
        font-size: 13px;
        cursor: pointer;
        font-weight: bold;
        width: 34px;
        text-decoration: underline;
    }

    .table thead th {
        font-weight: 600;
        font-size: 13px !important;
        border-bottom: 0;
        padding-left: 1rem
    }

    .add_image {
        float: right;
        border: 2px solid #f2f2f2;
        background: #ffffff;
        color: #323c32;
        width: 30px;
        height: 30px;
        cursor: pointer;
        line-height: 22px;
        text-align: center;
        font-size: 20px;
        margin-bottom: 5px;
    }

    .remove_image {
        float: right;
        border: 2px solid #f2f2f2;
        background: #ffffff;
        color: red;
        width: 30px;
        height: 30px;
        cursor: pointer;
        line-height: 22px;
        text-align: center;
        font-size: 20px;
        margin-bottom: 5px;
    }

    .accordion {
        margin: 0px !important;
    }

    .item1 {

        margin: 0px !important;

    }

    .mrgtab {
        margin-top: -50px;
    }

    /* .primaryDesignbtn {
    padding-left: 0rem!important;
    margin-top: 7px!important;
} */
    .primaryDesignbtn {
        /* padding-left:  0rem!important;
    line-height:  7px!important; */
    }

    #connect_to_doctor {
        width: 86px !important;
        display: inline-block;
        background: white;
        text-align: center;
        border: 2px solid #00205c;
        border-radius: 10px;
        line-height: 35px;
        font-size: 15px;
        cursor: pointer;
        color: #00205c;
        transition: all 0.5s ease-in-out;
    }

    #connect_to_doctor:hover {
        background: #00205c;
        color: white !important;
    }

    .connectPopup {
        position: fixed;
        bottom: 0px;
        top: 0px;
        left: 0;
        right: 0;
        background-color: rgb(4 4 4 / 60%);
        height: auto;
        z-index: 999999;
    }

    .connectPopup select {
        width: 100%;
        height: 43px;
        font-size: 18px;
        padding-left: 20px;
        margin-bottom: 20px;
        margin-top: 20px;
        color: #12101cbf;
        border: 1px solid #5f5a5a;
        border-radius: 10px;
    }

    .checkboxstyle {
        height: 15px !important;
    }

    .classma td select {
        display: block !important;
    }

</style>
<div class="mobile-menu-overlay"></div>
<!-- saadullah -->

<div class="main-container">
    <div class="m-3">
        <div class="row">
            <div class="col-xl-12 ">
                <div class="row">
                    <div class="col-md-4 onedo ">
                        <div class="">
                            <div class="widget-data">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item removeka  {{ Request()->has('draftview')?  '':'activecase' }} " onclick="changeClass(1)">
                                        <a class="nav-link textcolor " id="home-tab" data-toggle="tab" href="#home"
                                           role="tab" aria-controls="home" aria-selected="true"
                                           style="">Active</a>
                                    </li>
                                    <li class="nav-item addka changecolor {{ Request()->has('draftview')?  'activecase':'' }} " onclick="changeClass(2)">
                                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile"
                                           role="tab" aria-controls="profile" aria-selected="false">Draft</a>
                                    </li>
                                    <li class="nav-item ">
                                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact"
                                           role="tab" aria-controls="contact" aria-selected="false"></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 fourdo mb-30">
                        <div class="carx2 input">

                            <form action="{{ url('admin/case') }}" id="filter-form" method="get">
                                <input type="text" class="form-control" name="filter" placeholder="Search..."
                                       value="{{Request()->has('filter') ? Request()->get('filter') : ''}}">
                                <div class="searchicons">
                                    <button type="submit" style="background: none;border:none;">
                                        <i class="bi bi-search" style="margin-right:12px;"></i>|
                                    </button>
                                    |
                                    <a
                                        href="{{ Request()->has('filter') ? url(Request()->path()) : 'JavaScript:void(0);' }}">
                                        <i class="bi bi-sliders"></i>
                                    </a>
                                </div>
                            </form>

                        </div>
                    </div>

                    <div class="col-md-4 mb-30 threedo bgcolorbordertxt">

                        <a class="btn bgcolor float-right m-1 text-white  addcase">Add Case <i
                                class="bi bi-plus-circle"></i></a>

                        <a class="btn bg border border-dark  btn-xl color mb-5 m-1 paginate_button border-radius-8 bgcolorborder  float-right delete1"
                           style="font-size:22px;">Delete<i
                                class="bi bi-trash3"></i></a>

                        <!-- <a class="btn bgcolorborder hitme d-none m-1 float-right pooopdo addkado" style="font-size:22px;">Delete<i class="bi bi-trash3"></i></a> -->

                        <a class="ete checkboxbandka cursor cleardo float-right"
                           style="margin-top: 4px;font-size:22px;display: none;">Clear<i
                                class="bi bi-eraser-fill"></i></a>
                    </div>
                </div>

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade {{ Request()->has('draftview')?  '':'show active' }}" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="tabdata">
                                    <div class=" table-responsive">
                                        <table class="table tablerow complete" id="example"
                                               style="width: 100% !important;">
                                            <thead>
                                            <tr>
                                                <th class=" checkboxbandka " style="display: none;">
                                                    <input type="checkbox" id="btnCheckAll"/>
                                                </th>
                                                <th>Case_ID</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Gender</th>
                                                <th style="white-space:nowrap;">Treatment Plan</th>
                                                <th>Aligners</th>
                                                <th>Status</th>
                                                <th>Link Doctor</th>
                                                <th>View</th>
                                                <th>Edit</th>
                                            </tr>

                                            </thead>
                                            <tbody class="tablerow">
                                            @php($a = 1)
                                            @foreach ($cases as $case)
                                                @if ($case->payment_status != 'pending')
                                                    <tr data-aeshaz-select-id="{{ $case->id }}">
                                                        <td class=" checkboxbandka" style="display: none;">

                                                            <input type="checkbox" id="a{{ $a++ }}"
                                                                   value="{{ $case->id }}">
                                                        </td>
                                                        </td>
                                                        <td>{{ $case->id }}</td>
                                                        <td>{{ ucwords($case->name) }}</td>
                                                        <td>{{ ucfirst($case->email) }}</td>
                                                        <td>{{ $case->phone_no }}</td>
                                                        <td>{{ ucfirst($case->gender) }}</td>

                                                        <td><a
                                                                class="{{ $case->processing_fee_paid ? 'painbtn' : 'inprogressbtn' }}">
                                                                {{ $case->processing_fee_paid ? 'Paid' : 'Unpaid' }}</a>
                                                        </td>

                                                        <td><a
                                                                class=" @if (isset($case->aligner->payment_name) && !empty($case->aligner->payment_name)) painbtn  @else inprogressbtn @endif">
                                                                @if (isset($case->aligner->payment_name) && !empty($case->aligner->payment_name))
                                                                    Paid
                                                                @else
                                                                    Unpaid
                                                                @endif
                                                            </a></td>

                                                        <td class="maindo"><a class="inprogressbtn">

                                                                @if ($case->status == 'CANCELED')
                                                                    {{ ucfirst(strtolower($case->status)) }}
                                                                @elseif ($case->status == 'PENDING')
                                                                    {{ ucfirst(strtolower($case->status)) }}
                                                                @else
                                                                    @if ($case->status == 'CLOSED')
                                                                        {{ ucfirst(strtolower('Complete')) }}
                                                                    @elseif(empty($case->video_uploaded) && empty($edit_values->video_embedded))
                                                                        {{ ucfirst(strtolower('Acculigners Lab')) }}
                                                                    @elseif (
                                                                        (!empty($case->video_uploaded) || !empty($edit_values->video_embedded)) &&
                                                                            !$case->has_concern &&
                                                                            empty($case->aligner_kit_order_id))
                                                                        {{ ucfirst(strtolower('Review to dentist')) }}
                                                                    @elseif ($case->has_concern)
                                                                        {{ ucfirst(strtolower('Review to you')) }}
                                                                    @elseif (!empty($case->aligner_kit_order_id) && isset($case->aligner->status))
                                                                        @if ($case->aligner->status == 'DELIVERED')
                                                                            {{ ucfirst(strtolower($case->aligner->status)) }}
                                                                        @elseif ($case->aligner->status == 'CANCELED')
                                                                            {{ ucfirst(strtolower($case->aligner->status)) }}
                                                                        @else
                                                                            {{ ucfirst(strtolower('Order in production')) }}
                                                                        @endif
                                                                    @endif
                                                                @endif

                                                            </a></td>
                                                        <td>
                                                        <!-- <label class="switch_status" >
                                                        <input type="checkbox" id="status_change" @if ($case->processing_fee_paid == 1) checked @endif class="aws" onclick="change_status({{ $case->id }},this)" >
                                                        <span class="slider_status round"></span>
                                                      </label> -->
                                                            @if ($case->doctor_id == 57)
                                                                <span id="connect_to_doctor"
                                                                      onclick="connectDoctor({{ $case->id }})">Connect</span>
                                                            @endif
                                                        </td>
                                                        <td class="align-middle"
                                                            style="width: 45px;font-size:9px !important;">
                                                            <a href="{{ url(Request()->path() . '/' . $case->id) }}"
                                                               data-toggle="tooltip"
                                                               data-original-title="View Case">View Details</a>
                                                        <!-- <div class="btn-group align-top">
                                                 <a href="{{ url(Request()->path() . '/' . $case->id . '/edit') }}" class="btn btn-sm btn-success RolePermissionUpdate" data-toggle="tooltip" data-original-title="Edit Case">Edit</a>
                                                <a href="{{ url(Request()->path() . '/' . $case->id) }}" class="btn btn-sm btn-info RolePermissionUpdate" data-toggle="tooltip" data-original-title="View Case">View</a>
                                                <a class="btn btn-sm btn-danger delete-confirm-alert RolePermissionDelete" href="javascript:void(0)" data-id="{{ $case->id }}" data-toggle="tooltip" data-original-title="Delete Case">Delete</a>
                                             </div> -->
                                                        </td>
                                                        <td><a class="btn_edit"
                                                               onclick="editFunction({{ $case->id }})"><i
                                                                    class="bi bi-pencil-square"></i></a></td>
                                                    <!-- <td>
                                                    <i class="bi bi-three-dots-vertical dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="cursor:pointer"></i>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <a class="dropdown-item" style="text-align: center;padding: 0;text-decoration: none;" onclick="editFunction({{ $case->id }})">Edit</a>
                                                        <a class="dropdown-item" style="text-align: center;padding: 0;text-decoration: none;" onclick="deleteClinicDoctor()">Delete</a>
                                                    </div>
                                                </td> -->

                                                    </tr>
                                                @endif
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade {{ Request()->has('draftview')?  'show active':'' }}" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="tabdata">
                                    <div class=" table-responsive">
                                        <table class="table tablerow" id="example1">
                                            <thead>
                                            <tr>
                                                <th>Case_ID</th>
                                                <th>Name</th>
                                                <th>Phone</th>
                                                <th>Gender</th>
                                                <th style="white-space:nowrap;">Treatment Plan</th>
                                                <th>Aligners</th>
                                                <th>Status</th>
                                                <th>Link Doctor</th>
                                                <th>View</th>
                                                <th>Edit</th>
                                                <th>Make Payment</th>
                                            </tr>
                                            </thead>
                                            <tbody class="tablerow">
                                            @php($b = 1)
                                            @foreach ($cases as $case)
                                                @if ($case->payment_status == 'pending')
                                                    <tr data-aeshaz-select-id="{{ $case->id }}">
                                                        <td class=" checkboxbandka" style="display: none;">
                                                            <input type="checkbox" id="b{{ $b++ }}"
                                                                   value="{{ $case->id }}">
                                                        </td>

                                                        <td>{{ $case->id }}</td>
                                                        <td>{{ ucwords($case->name) }}</td>
                                                        <td>{{ $case->phone_no }}</td>
                                                        <td>{{ ucfirst($case->gender) }}</td>
                                                        <td><a
                                                                class="{{ $case->processing_fee_paid ? 'painbtn' : 'inprogressbtn' }}">
                                                                {{ $case->processing_fee_paid ? 'Paid' : 'Unpaid' }}</a>
                                                        </td>

                                                        <td><a
                                                                class=" @if (isset($case->aligner->payment_name) && !empty($case->aligner->payment_name)) painbtn  @else inprogressbtn @endif">
                                                                @if (isset($case->aligner->payment_name) && !empty($case->aligner->payment_name))
                                                                    Paid
                                                                @else
                                                                    Unpaid
                                                                @endif
                                                            </a></td>

                                                        <td class="maindo"><a class="inprogressbtn"
                                                                              style="padding: 8px 12px;">

                                                                @if ($case->status == 'CANCELED')
                                                                    {{ ucfirst(strtolower($case->status)) }}
                                                                @elseif ($case->status == 'PENDING')
                                                                    {{ ucfirst(strtolower($case->status)) }}
                                                                @else
                                                                    @if (empty($case->video_uploaded) && empty($edit_values->video_embedded))
                                                                        {{ ucfirst(strtolower('Acculigners Lab')) }}
                                                                    @elseif (
                                                                        (!empty($case->video_uploaded) || !empty($edit_values->video_embedded)) &&
                                                                            !$case->has_concern &&
                                                                            empty($case->aligner_kit_order_id))
                                                                        {{ ucfirst(strtolower('Review to dentist')) }}
                                                                    @elseif ($case->has_concern)
                                                                        {{ ucfirst(strtolower('Review to you')) }}
                                                                    @elseif (!empty($case->aligner_kit_order_id) && isset($case->aligner->status))
                                                                        @if ($case->aligner->status == 'DELIVERED')
                                                                            {{ ucfirst(strtolower($case->aligner->status)) }}
                                                                        @elseif ($case->aligner->status == 'CANCELED')
                                                                            {{ ucfirst(strtolower($case->aligner->status)) }}
                                                                        @else
                                                                            {{ ucfirst(strtolower('Order in production')) }}
                                                                        @endif
                                                                    @endif
                                                                @endif

                                                            </a></td>
                                                        <td>
                                                        <!-- <label class="switch_status" >
                                                        <input type="checkbox" id="status_change" @if ($case->processing_fee_paid == 1) checked @endif class="aws" onclick="change_status({{ $case->id }},this)" >
                                                        <span class="slider_status round"></span>
                                                      </label> -->
                                                            @if ($case->doctor_id == 57)
                                                                <span id="connect_to_doctor"
                                                                      onclick="connectDoctor({{ $case->id }})">Connect</span>
                                                            @endif
                                                        </td>
                                                        <td class="align-middle"
                                                            style="width: 45px;font-size:9px !important;">
                                                            <a href="{{ url(Request()->path() . '/' . $case->id) }}"
                                                               data-toggle="tooltip"
                                                               data-original-title="View Case">View Details</a>

                                                        </td>
                                                        <td><a class="btn_edit"
                                                               onclick="editFunction({{ $case->id }})"><i
                                                                    class="bi bi-pencil-square"></i></a></td>
                                                        <td>
                                                            <label class="switch_status">
                                                                <input type="checkbox" id="status_change"
                                                                       @if ($case->processing_fee_paid == 1) checked
                                                                       @endif
                                                                       class="aws"
                                                                       onclick="change_status({{ $case->id }},this)">
                                                                <span class="slider_status round"></span>
                                                            </label>
                                                        </td>

                                                    </tr>
                                                    @php($a++)
                                                @endif
                                            @endforeach
                                            @if ($a == 0)
                                                <tr>
                                                    <td colspan="5">
                                                        <h3 class="align center" style="color:#d3d3d3;">No data to show
                                                        </h3>
                                                    </td>
                                                </tr>
                                            @endif


                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab"></div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- js -->
<script src="{{ asset('vendors/scripts/core.js') }} "></script>
<script src="{{ asset('vendors/scripts/script.min.js') }} "></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script>
    function bndka() {
        $('.pop1').fadeOut('slow');
    }

    $('.addcase').click(function () {
        // $('.pop1').removeClass('d-none');
        $('.pop1').fadeIn('slow');

    });

    function bndka1() {
        $('.pop2').addClass('d-none');
    }

    // $('.delete').click(function() {

    //     $('.pop2').removeClass('d-none');
    // });

    $(document).ready(function () {
        $("#example").DataTable();
    });
</script>

</body>

</html>
<div class="pop1 scrolldo" style="display:none">
    <div class="">

        <form class="form-horizontal" method="post" id="frmcase" action="" enctype="multipart/form-data"
              novalidate>
            <div class="col-md-5">
            </div>
            <div class="col-md-7 bg-white popadd float-right">
                <div class="page6box py-3 p-2">
                </div>
                <div class="row px-4 mb-5 ">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12 col bold m-auto">
                                <h4 class="textcolor">Add New Case</h4>
                                <p class="greytext">Complete the information related to case</p>
                                <i class="fa-solid float-right bandeka cursor fa-xmark" onclick="bndka();"></i>

                            </div>
                        </div>
                    </div>

                    {{-- <div class="col-md-12 px-4 brdall py-4">
                        <div class="row  ">
                            <div class="col-md-12 bold ">
                                <h4 class="textcolor ">Patient's Detail</h4>

                                <i class="fa-solid fa-chevron-down float-right mt-1"></i>
                            </div>
                        </div> --}}
                    {{--  <div class="row pb-4 mt-3">
                         <div class="col-md-6 bold ">
                             <span>Patient's Name*</span><span id="name_v_msg"
                                 style="margin-left: 25px;font-size: 10px;color: red;font-weight: bold;font-family:'Inter';"></span>
                             <input type="hidden" name="ElementId" id="ElementId" value="" />
                             <input type="text" name="name" id="name" class="form-control"
                                 placeholder="Enter Here">
                         </div>
                         <div class="col-md-6 bold ">
                             <span>Patient's Email(Optional)</span><span id="email_v_msg"
                                 style="margin-left: 25px;font-size: 10px;color: red;font-weight: bold;font-family:'Inter';"></span>
                             <input type="email" name="email" id="email" class="form-control"
                                 placeholder="Enter Here">
                         </div>
                     </div>
                     <div class="row  pb-4">
                         <div class="col-md-6 bold ">
                             <span>Patient's Phone No(Optional)</span><span id="phone_v_msg"
                                 style="margin-left: 25px;font-size: 10px;color: red;font-weight: bold;font-family:'Inter';"></span>
                             <input type="number" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" name="phone_no"
                                 id="phone_no"class="form-control" placeholder="Enter Here">
                         </div>
                         <div class="col-md-6 bold ">
                             <span>Patient's DOB(Optional)</span><span id="dob_v_msg"
                                 style="margin-left: 25px;font-size: 10px;color: red;font-weight: bold;font-family:'Inter';"></span>
                             <input type="date" name="dob" id="dob" class="form-control"
                                 pattern="\d{2}/\d{2}/\d{4}" placeholder="mm/dd/yyyy">
                         </div>
                     </div>
                     <div class="row  pb-4">
                         <div class="col-md-12 bold address">
                             <span>Address(Optional)</span>
                             <input type="" name="address" id="address" class="form-control"
                                 placeholder="Type Here">
                         </div>

                     </div> --}}
                    {{-- </div> --}}
                    <div class="col-md-12 px-4 my-3 py-4">
                        <div class="row  pb-4">
                            <div class="content col-md-12">
                                <!--mujtaba-->
                                <div class="accordion">
                                    <div class="item1">
                                        <p class="number">01</p>
                                        <p class="text">Patient's Detail</p>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor" class="icon">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
                                        </svg>
                                        <div class="hidden-box">
                                            <div class="row pb-4 mt-3">
                                                <div class="col-md-6 bold ">
                                                    <span>Patient's Name*</span>
                                                    <input type="hidden" name="ElementId" id="ElementId"
                                                           value=""/>
                                                    <input type="text" name="name" id="name"
                                                           class="form-control" placeholder="Enter Here">
                                                    <span id="name_v_msg"
                                                          style="margin-left: 25px;font-size: 10px;color: red;font-weight: bold;font-family:'Inter';"></span>
                                                </div>
                                                <div class="col-md-6 bold ">
                                                    <span>Patient's Email(Optional)</span>
                                                    <input type="email" name="email" id="email"
                                                           class="form-control" placeholder="Enter Here">
                                                    <span id="email_v_msg"
                                                          style="margin-left: 25px;font-size: 10px;color: red;font-weight: bold;font-family:'Inter';"></span>
                                                </div>
                                            </div>
                                            <div class="row  pb-4">
                                                <div class="col-md-6 bold ">
                                                    <span>Patient's Phone No(Optional)</span>
                                                    <input type="text" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}"
                                                           name="phone_no" id="phone_no" class="form-control"
                                                           placeholder="Enter Here">
                                                    <span id="phone_v_msg"
                                                          style="margin-left: 25px;font-size: 10px;color: red;font-weight: bold;font-family:'Inter';"></span>
                                                </div>
                                                <div class="col-md-6 bold ">
                                                    <span>Patient's DOB(Optional)</span>
                                                    <input type="date" name="dob" id="dob"
                                                           class="form-control" pattern="\d{2}/\d{2}/\d{4}"
                                                           placeholder="mm/dd/yyyy">
                                                    <span id="dob_v_msg"
                                                          style="margin-left: 25px;font-size: 10px;color: red;font-weight: bold;font-family:'Inter';"></span>
                                                </div>
                                            </div>
                                            <div class="row  pb-4">
                                                <div class="col-md-12 bold address">
                                                    <span>Address(Optional)</span>
                                                    <input type="" name="address" id="address"
                                                           class="form-control" placeholder="Type Here">
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="item1">
                                        <p class="number">02</p>
                                        <p class="text">Treatment Details</p>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor" class="icon">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
                                        </svg>
                                        <div class="hidden-box">
                                            <div class="row  ">
                                                <div class="col-md-4 " style="margin-bottom: 1.5rem!important;">


                                                    <label for="">Arch to treat*</label>
                                                    <div class="btn-group ">
                                                        <input type="checkbox" id="arch_to_treat" value="1"
                                                               name="arch_to_treat" data-toggle="toggle"
                                                               data-onstyle="outline-primary"
                                                               data-offstyle="outline-secondary" data-style="ios">
                                                    </div>
                                                </div>

                                                <div class="col-md-4 " style="margin-bottom: 1.5rem!important;">

                                                    <label for="">A-P Relation*</label>
                                                    <div class="btn-group ">
                                                        <input type="checkbox" id="a_p_relationship"
                                                               name="a_p_relationship" data-toggle="toggle"
                                                               data-onstyle="outline-primary"
                                                               data-offstyle="outline-secondary " data-style="ios"
                                                               class="primaryDesignbtn">
                                                    </div>

                                                </div>

                                                <div class="col-md-4 " style="margin-bottom: 1.5rem!important;">
                                                    <label for="">OverJet *<span
                                                            style="visibility:hidden;">overflow</span></label>

                                                    <div class="btn-group ">
                                                        <input type="checkbox" id="overjet" name="overjet"
                                                               data-toggle="toggle" data-onstyle="outline-primary"
                                                               data-offstyle="outline-secondary" data-style="ios">


                                                    </div>

                                                </div>
                                                <div class="col-md-4 " style="margin-bottom: 1.5rem!important;">
                                                    <label for="">Overbite *<span
                                                            style="visibility:hidden;">overflow</span></label>

                                                    <div class="btn-group ">
                                                        <input type="checkbox" id="overbite" name="overbite"
                                                               data-toggle="toggle" data-onstyle="outline-primary"
                                                               data-offstyle="outline-secondary" data-style="ios">


                                                    </div>

                                                </div>
                                                <div class="col-md-4 " style="margin-bottom: 1.5rem!important;">
                                                    <label for="">MidLine* <span
                                                            style="visibility:hidden;">overflow</span></label>

                                                    <div class="btn-group ">
                                                        <input type="checkbox" id="midline" name="midline"
                                                               data-toggle="toggle" data-onstyle="outline-primary"
                                                               data-offstyle="outline-secondary" data-style="ios">


                                                    </div>

                                                </div>
                                            </div>
                                            <div class="row  ">
                                                <div class="col-md-12 "
                                                     style="margin-top: 2rem!important;margin-bottom: 2rem!important;">
                                                    <p style="line-height: 0px;">Clinic Comment* <span id="clinic_msg"
                                                                                                       style="margin-left: 25px;font-size: 10px;color: red;font-weight: bold;font-family:'Inter';"></span>
                                                    </p>
                                                    <textarea class="form-control" placeholder="Type Here..."
                                                              style="height:80px!important;" type="text"
                                                              id="clinical_comment" name="clinical_comment" required
                                                              data-validation-required-message="Clinical Comment is required"></textarea>

                                                    <p style="line-height: px;" class="mt-2">Prescription Comment*
                                                        <span id="prescription_msg"
                                                              style="margin-left: 25px;font-size: 10px;color: red;font-weight: bold;font-family:'Inter';"></span>
                                                    </p>
                                                    <textarea id="prescription_comment" name="prescription_comment"
                                                              class="form-control" placeholder="Type Here..."
                                                              style="height:80px!important;" required
                                                              data-validation-required-message="Prescription Comment is required"></textarea>


                                                   <p style="line-height: px;" class="mt-2">Additional comments*
                                                        <span id="additional_msg"
                                                                      style="margin-left: 25px;font-size: 10px;color: red;font-weight: bold;font-family:'Inter';"></span>
                                                    </p>
                                                    <textarea id="additional_comment" name="additional_comment"
                                                                      class="form-control" placeholder="Type Here..."
                                                                      style="height:80px!important;" required
                                                                      data-validation-required-message="Additional Comment is required"></textarea>

                                                </div>
                                            </div>
                                            <!-- <div class="row  pb-4">

                                            <div class="col-md-12 p-0">
                                                <a class="btn bgcolor text-white casebtn float-right mx-2">Save</a>
                                                <a class="btn bgcolorborder float-right" style="font-size:22px;" onclick="bndka();">Cancel</a>

                                            </div>
                                        </div> -->


                                            </ul>
                                        </div>
                                    </div>
                                    <div class="item1 twoitemsdo">
                                        <p class="number">03</p>
                                        <p class="text">Clinical Condition</p>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor" class="icon">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
                                        </svg>
                                        <div class="hidden-box">
                                            <div class="card-body">
                                                <div class="row mrgtab ">
                                                    <div class="col-md-6">
                                                        @php($a = 1)
                                                        @foreach ($ClinicalConditions as $ClinicalCondition)
                                                            @if ($a == 5 || $a == 9)
                                                    </div>
                                                    <div class="col-md-6">
                                                        @endif
                                                        <input type="checkbox" class="checkboxstyle image_disable"
                                                               name="clinical_conditions[]"
                                                               id="conidion{{ $a }}"
                                                               value="{{ $ClinicalCondition->id }}"/>
                                                        <span
                                                            style="font-size: 17px;margin:10px;">{{ ucwords($ClinicalCondition->name) }}
                                                        </span><br>
                                                        @php($a++)
                                                        @endforeach
                                                    </div>

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="item1">
                                        <p class="number">04</p>
                                        <p class="text">Image Attachments </p>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor" class="icon">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
                                        </svg>
                                        <div class="hidden-box">
                                            <div class="card-body">
                                                <div class="col-md-12 p-0 px-2  pb-3" id="Attach_Img">
                                                    @for ($i = 1; $i <= 9; $i++)
                                                        @php($img_col = isset($attachments['IMAGE']) ? collect($attachments['IMAGE'])->firstWhere('sort_order', $i) : null)
                                                        @php($media = !empty($img_col) ? $img_col['full_path'] : asset('link/files/app-assets/images/case/images/Base' . $i . '.png'))
                                                        <div
                                                            class="row py-2 m-1 attachImg add_new_{{ $i }} {{ $i != 1 ? 'd-none' : '' }}"
                                                            style="border: 1px dashed black;border-radius: 5px;">
                                                            <div class="col-md-2 p-0 ">
                                                                <img src="{{ asset('vendors/images/drag.png') }}"
                                                                     width="40" class="mx-2 mt-3">
                                                            </div>
                                                            <div class="col-md-8 p-0">
                                                                <h5 style="font-size: 15px;" class="mt-2"> Select a
                                                                    file to upload</h5>
                                                                <span style="font-size: 11px;">JPG, PNG or PDF, file
                                                                    size no more than 10MB</span>
                                                            </div>
                                                            <div class="col-md-2 mt-2 p-0 pt-2">
                                                                <!-- <a class="textcolor attachImg"  style="font-size: 15px;color:#00205C;text-decoration: underline; cursor:pointer;"> Browse</a> -->
                                                                <!-- <input type="file" id="picture" name="picture" class="fileInput" accept="image/*" value="" hidden> -->
                                                                <label class="btn">
                                                                    <input type="file" id="image_attach"
                                                                           accept="image/*,application/pdf"
                                                                           name="IMAGE_[]"
                                                                           class="hidden upload-attachment {{ 'IMAGE_' . $i }} image_disable disable_input"
                                                                           data-type="IMAGE"
                                                                           data-sort="{{ $i }}"
                                                                           onchange="preViewImage2(this)"
                                                                           hidden multiple>
                                                                    <img src="{{ $media }}"
                                                                         id="{{ 'IMAGE_' . $i }}" alt="Image"
                                                                         class="img-thumbnail image_attach">
                                                                    <input type="hidden" value="{{ $media }}"
                                                                           id="img_src_{{ $i }}">
                                                                    <input type="hidden" value=""
                                                                           id="img_id_{{ $i }}"
                                                                           class="get_id">
                                                                </label>
                                                            </div>
                                                        </div>
                                                    @endfor

                                                </div>
                                                <!-- <span class="add_image">+</span><span class="remove_image">-</span> -->
                                            </div>
                                        </div>


                                    </div>
                                    </dv>
                                    <div class="item1">
                                        <p class="number">05</p>
                                        <p class="text">X-Rays Attachments</p>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor" class="icon">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
                                        </svg>
                                        <div class="hidden-box" style="margin-bottom: 20px;">
                                            @for ($i = 1; $i <= 2; $i++)
                                                @php($img_col = isset($attachments['X_RAY']) ? collect($attachments['X_RAY'])->firstWhere('sort_order', $i) : null)
                                                @php($media = !empty($img_col) ? $img_col['full_path'] : asset('link/files/app-assets/images/case/upload.png'))
                                                <div class="row py-2 m-1"
                                                     style="border: 1px dashed black;border-radius: 5px;">

                                                    <div class="col-md-2 p-0">
                                                        <img src="{{ asset('vendors/images/drag.png') }}"
                                                             width="40" class="mx-2 mt-3">
                                                    </div>

                                                    <div class="col-md-8 p-0">
                                                        <h5 style="font-size: 15px;" class="mt-2"> Select a file
                                                        </h5>
                                                        <span style="font-size: 11px;">JPG, PNG or PDF, file size no
                                                            more than 10MB</span>
                                                    </div>

                                                    <div class="col-md-2 mt-2 p-0 pt-2">
                                                        <label class="btn">
                                                            <input type="file" accept="image/*,application/pdf"
                                                                   id="upload_attach" name="X_RAY_[]"
                                                                   class="hidden upload-attachment image_disable disable_input"
                                                                   data-type="X_RAY" data-sort="{{ $i }}"
                                                                   onchange="preViewImage2(this)" multiple hidden>
                                                            <img src="{{ $media }}" id="{{ 'X_RAY_' . $i }}"
                                                                 alt="Image" class="img-thumbnail">
                                                            <input type="hidden" value=""
                                                                   id="xray_img_id_{{ $i }}" class="get_id">
                                                        </label>

                                                    </div>
                                                </div>
                                        @endfor

                                        <!-- <div class="row  pb-4">

                                            <div class="col-md-12 mt-5 ">
                                                <a class="btn bgcolor text-white casebtn float-right mx-2">Save</a>
                                                <a class="btn bgcolorborder float-right" style="font-size:22px;" onclick="bndka();">Cancel</a>

                                            </div>
                                        </div> -->

                                        </div>
                                        <!-- <span class="add_xray">+</span><span class="remove_xray">-</span> -->


                                    </div>
                                    </dv>
                                    <div class="item1">
                                        <p class="number">06</p>
                                        <p class="text">Jaw scan(Upper/Lower)</p>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor" class="icon">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
                                        </svg>
                                        <div class="hidden-box">
                                            <div class="card-body">
                                                <div class="col-md-12 p-0 px-2  pb-3">
                                                    @for ($i = 1; $i <= 2; $i++)
                                                        @php($jaw_type = $i == 1 ? 'UPPER_JAW' : 'LOWER_JAW')
                                                        @php($img_col = isset($attachments[$jaw_type]) ? collect($attachments[$jaw_type])->firstWhere('sort_order', $i) : null)
                                                        @php($media = !empty($img_col) ? $img_col['full_path'] : asset('link/files/app-assets/images/case/jaw/Base' . $i . '.png'))
                                                        <div class="row py-2 m-1"
                                                             style="border: 1px dashed black;border-radius: 5px;">

                                                            <div class="col-md-2 p-0 ">
                                                                <img src="{{ asset('vendors/images/drag.png') }}"
                                                                     width="40" class="mx-2 mt-3">
                                                            </div>
                                                            <div class="col-md-8 p-0">

                                                                <h5 style="font-size: 15px;" class="mt-2"> Select a
                                                                    file or drag and drop here</h5>
                                                                <span style="font-size: 11px;">JPG, PNG or PDF, file
                                                                    size no more than 10MB</span>
                                                            </div>
                                                            <div class="col-md-2 mt-2 p-0 pt-2">
                                                                <label class="btn">
                                                                    <input type="file"
                                                                           accept=".STL,.stl"
                                                                           id="jaw_{{ $i }}"
                                                                           name="{{ $jaw_type . '_' . $i }}"
                                                                           class="hidden upload-attachment disable_input"
                                                                           data-type="{{ $jaw_type }}"
                                                                           onchange="preViewJawImage(this)"
                                                                           data-sort="{{ $i }}" hidden>
                                                                    <img src="{{ $media }}"
                                                                         id="{{ $jaw_type . '_' . $i }}"
                                                                         alt="Image" class="img-thumbnail">
                                                                </label>
                                                            </div>
                                                        </div>
                                                </div>
                                                <div class="col-md-12 p-0  pb-3">
                                                    <div class="row py-2">
                                                        <div class="col-md-12 p-0 ">
                                                            <!-- <h6 class="px-3">Upload a file:</h6> -->
                                                            <div class="table-responsive">
                                                                <table class="table">
                                                                    <thead class="classma">
                                                                    <td><img src="{{ asset('vendors/images/jaw.png') }}"
                                                                             width="20"
                                                                             id="imgShow{{ $i }}"/>
                                                                    </td>
                                                                    <td style="font-size: 10px;padding:0px;">
                                                                        Untitled
                                                                    </td>
                                                                    <td style="font-size: 10px;padding:0px;">
                                                                        Preview
                                                                    </td>
                                                                    <td style="font-size: 10px;padding:0px;">1.7MB
                                                                    </td>
                                                                    <td
                                                                        style="font-size: 10px;padding:0px;font-size: 10px;">
                                                                        <select
                                                                            style="font-size: 10px;padding:0px;font-size: 10px;"
                                                                            id="select{{ $i }}"
                                                                            onchange="saveJawImage(this,'{{ $i }}',true)"
                                                                            class="form-select form-control select_tag disable_input">
                                                                            <option selected value=""
                                                                                    style="font-size: 10px;">Select Jaw
                                                                            </option>
                                                                            <option value="1"
                                                                                    style="font-size: 10px;">Upper
                                                                            </option>
                                                                            <option value="2"
                                                                                    style="font-size: 10px;">Lower
                                                                            </option>
                                                                        </select>
                                                                    </td>
                                                                    </thead>
                                                                </table>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    @endfor
                                                </div>
                                            </div>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="item1">
                                        <p class="number">07</p>
                                        <p class="text">Other files</p>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor" class="icon">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
                                        </svg>
                                        <div class="hidden-box">
                                            <div class="card-body ">
                                                <div class="col-md-12 linkdokna p-0 px-2  pb-3">
                                                    Attach URL
                                                    <input type="url" class="form-control"
                                                           placeholder="Embedded URL" id="embedded_url"
                                                           name="embedded_url">
                                                    <img src="{{ asset('vendors/images/link.png') }}" width="20">
                                                </div>
                                                <div class="col-md-12 p-0 px-2 pb-3">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <span>Patient Consent Form</span> <span
                                                                class="float-right"></span>
                                                            <!-- Download Form <i class="bi bi-download"></i> -->
                                                        </div>
                                                    </div>
                                                    <div class="row py-2 m-1 dashedborder"
                                                         style="border: 1px dashed black;border-radius: 5px;">
                                                        <div class="col-md-2 p-0 ">
                                                            <img src="{{ asset('vendors/images/drag.png') }}"
                                                                 width="40" class="mx-2 mt-3">
                                                        </div>
                                                        <div class="col-md-8 p-0">
                                                            <h5 style="font-size: 15px;" class="mt-2"> Select a file
                                                                to upload</h5>
                                                            <span style="font-size: 11px;">JPG, PNG or PDF, file size
                                                                no more than 10MB</span>
                                                        </div>
                                                        <div class="col-md-2 mt-2 p-0 pt-2">
                                                            <label class="btn">
                                                                <input type="file"
                                                                       accept="image/*,application/pdf"
                                                                       name="OTHER"
                                                                       class="hidden upload-attachment"
                                                                       data-type="PATIENT_FORM"
                                                                       data-sort="1" hidden
                                                                       onchange="preViewImage(this)">
                                                                <img
                                                                    src="{{ asset('link/files/app-assets/images/case/upload.png') }}"
                                                                    id="PATIENT_FORM_1" alt="Image"
                                                                    class="img-thumbnail" style="width: 35px;"/>
                                                                <input type="hidden" value=""
                                                                       id="embedded_url_1" class="get_id">
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12 mt-3">
                                                            <span>Other Files</span>
                                                        </div>
                                                    </div>
                                                    <div class="row py-2 m-1"
                                                         style="border: 1px dashed black;border-radius: 5px;">

                                                        <div class="col-md-2 p-0 ">
                                                            <img src="{{ asset('vendors/images/drag.png') }}"
                                                                 width="40" class="mx-2 mt-3">
                                                        </div>
                                                        <div class="col-md-8 p-0">

                                                            <h5 style="font-size: 15px;" class="mt-2"> Select a file
                                                                to upload</h5>
                                                            <span style="font-size: 11px;">JPG, PNG or PDF, file size
                                                                no more than 10MB</span>
                                                        </div>
                                                        <div class="col-md-2 mt-2 p-0 pt-2">
                                                            <label class="btn">
                                                                <input type="file"
                                                                       accept="image/*,application/pdf"
                                                                       name="OTHER"
                                                                       class="upload-attachment" data-type="OTHER"
                                                                       data-sort="2" hidden
                                                                       onchange="preViewImage2(this)" multiple>
                                                                <img
                                                                    src="{{ asset('link/files/app-assets/images/case/upload.png') }}"
                                                                    id="OTHER_2" alt="Image"
                                                                    class="img-thumbnail" style="width: 35px;">
                                                                <input type="hidden" value="2"
                                                                       id="embedded_url_2" class="get_id">
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <input type="hidden" name="attachment_ids" id="attachment_ids">

                                </div>
                            </div>
                            <div class="main mb-5 m-4" style="width:100%;">
                                <button type="submit"
                                        class="btn btn-xl btn-primary bgcolor text-white casebtn float-right"
                                        id="btn_submit">Submit
                                </button>
                                <a class="bg border border-radius-8 btn btn-xl color float-right mb-5 mx-2"
                                   style="font-size:22px;"
                                   onclick="bndka();">Cancel</a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
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
<!-- ____________connectPopup________ -->

<div class="connectPopup d-none">
    <div class="row ">
        <div class="col-md-4">
        </div>
        <div class="col-md-4 bg-white popadd deleteform">
            <div class="page6box py-3 ">
            </div>
            <div class="row px-4 mb-5 ">
                <div class="col-md-12">
                    <div class="row">
                        <h3 style="font-size: 15px;margin-bottom:12px;margin-top:3px; color:#140075;" align="center">
                            *Please Select Doctor to Assign The Case</h3>
                        <form action=""></form>
                        <select name="clinic_doc" id="clinic_doc">
                            <option value="">Select Doctor</option>
                            @foreach ($doctors as $clinic_Doctor)
                                <option value="{{ $clinic_Doctor->doctor->id }}">
                                    {{ ucwords($clinic_Doctor->doctor->name) }}</option>
                            @endforeach
                        </select>
                        <input type="hidden" id="connect_case_id" name="connect_case_id" value=""/>
                    </div>
                </div>
                <div class="col-md-12">
                    <button class="btn  text-white casebtn float-right"
                            style="    width: 112px;height: 35px;margin-left: 10px;background: #140075;"
                            onclick="connect_case()"> Assign Case
                    </button>
                    <a class="btn cancelbtn  text-white  float-right" onclick="closeConnectPopup();">Cancel</a>
                    </form>

                </div>
            </div>
        </div>
    </div>

</div>
<!-- ____________End connectPopup________ -->


<!-- <script src="{{ asset('vendors/js/script.js') }}"></script> -->
<script>
    const iconUpDown = document.querySelectorAll(".icon");
    iconUpDown.forEach(icon => {
        icon.addEventListener("click", e => {
            icon.classList.toggle("icon-rotate")
            icon.parentElement.classList.toggle("open");
        })
    })
</script>


<script src="{{ asset('vendors/dist/accordion.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    new Accordion('.accordion-container');
</script>


<script src="{{ asset('vendors/js/popper.min.js') }}"></script>
<script src="{{ asset('vendors/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('vendors/js/main.js') }}"></script>
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css"
      rel="stylesheet">
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
<script defer src="https://static.cloudflareinsights.com/beacon.min.js/vaafb692b2aea4879b33c060e79fe94621666317369993"
        integrity="sha512-0ahDYl866UMhKuYcW078ScMalXqtFJggm7TmlUtp0UlD4eQk0Ixfnm5ykXKvGJNFjLMoortdseTfsRT8oCfgGA=="
        data-cf-beacon='{"rayId":"79e5541319b8de47","token":"cd0b4b3a733644fc843ef0b185f98241","version":"2023.2.0","si":100}'
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    var records1 = "{{ $a }}";
    var records2 = "{{ $b }}";

    function bndka() {
        // $('.pop1').addClass('d-none');
        $('.pop1').fadeOut('slow');

    }

    $('.addcase').click(function () {
        resetAddCase();
        $('#select1').attr('disabled', false);
        $('#select2').attr('disabled', false);
        for (var x = 1; x <= 9; x++) {
            $('#conidion' + x).prop('disabled', false);
        }
        $('#name , #phone_no , #email , #address , #dob').removeAttr('readonly');
        $('#additional_comment')
            .prop('disabled', false);
        $('.disable_input , #arch_to_treat , #a_p_relationship , #overjet , #overbite , #midline , #clinical_comment , #prescription_comment')
            .prop('disabled', false);
        $('.add_image , .remove_image').show();
        $('.pop1').fadeIn('slow');
    });

    function bndka1() {
        $('.pop2').addClass('d-none');
    }

    $('.delete1').click(function () {
        $(".checkboxbandka").delay(200).fadeIn();
        $('.checkboxbandka').removeClass('d-none');
        var recordId = [];
        var a = 0;
        var b = 0;
        for (i = 1; i < records1; i++) {
            if ($("#a" + i).is(':checked') == true) {
                recordId[a] = $("#a" + i).val();
                a++;
            }
        }
        for (i = 1; i < records2; i++) {
            if ($("#b" + i).is(':checked') == true) {
                recordId[b] = $("#b" + i).val();
                b++;
            }
        }
        if (recordId.length != 0) {
            $(".pop2").removeClass("d-none");
        }
    });

    $('.cleardo').click(function () {

        $('.checkboxbandka').addClass('d-none');

        $('#btnCheckAll').prop('checked', false);

        if (records1.length > 0) {

            for (i = 1; i < records1; i++) {
                $("#a" + i).prop('checked', false);
            }
        }

        if (records2.length > 0) {
            for (i = 1; i < records2; i++) {
                $("#b" + i).prop('checked', false);
            }
        }
    });

    $(document).ready(function () {
        $("#example").DataTable();
    });
    var base_url = "{{ url('admin') }}";
    var case_id = '{{ isset($edit_values->id) ? $edit_values->id : '' }}';

    $('.date-picker').daterangepicker({
        singleDatePicker: !0,
        showDropdowns: !0
    });

    $('body').on('change', '.upload-attachment', function () {

        var sort = $(this).data('sort');
        var type = $(this).data('type');
        readURL(this, type, sort);

    });

    function changeClass(id) {
        if (id == 1) {
            $('.addka').removeClass('activecase');
            $(".removeka").addClass('activecase');
        } else if (id == 2) {
            $('.removeka').removeClass('activecase');
            $(".addka").addClass('activecase');
        }
    }

    function change_status(id, input) {

        if (input.checked) {
            check = "paid";
        } else {
            check = "unpaid";
        }
        $.ajax({
            type: "POST",
            url: base_url + "/case/change/status",
            data: {
                'id': id,
                'check': check
            },
            // beforeSend: function () {
            //     ajaxLoader();
            // },
            beforeSend: function () {
                ajaxLoader();
            },
            xhr: function () {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function (evt) {
                        if (evt.lengthComputable) {
                            console.log(evt)
                            var percentComplete = evt.loaded / evt.total;
                            percentComplete = parseInt(percentComplete * 100);
                            ajaxLoaderprograss(percentComplete);
                        }
                }, false);
                return xhr;
            },

            success: function (data) {
                if (data.msg == "success1") {
                    toastr.success('Treatment Plan Status Set to Paid', '', {
                        timeOut: 2000
                    });
                    setTimeout(function () {
                        location.reload(true)
                    }, 1000);

                } else if (data.msg == "success2") {

                    toastr.success('Treatment Plan Status Set to Unpaid', '', {
                        timeOut: 2000
                    });
                    setTimeout(function () {
                        location.reload(true)
                    }, 1000);

                } else {
                    toastr.error('Something Went Wrong, Try again', '', {
                        timeOut: 2000
                    });
                }
                //  setTimeout(function () {location.reload(true)}, 1000);
            },
            error: function (message, error) {
                $('#loader').fadeOut();
                toastr.error('Something Went Wrong', '', {
                    timeOut: 2000
                });
            }
        });
    }


    /*___________connectPopUp__open__close______________ */
    function connectDoctor(caseId) {
        $('.connectPopup').removeClass('d-none');
        $('#connect_case_id').val(caseId);
    }

    function closeConnectPopup() {
        $('.connectPopup').addClass('d-none');
    }

    /*Ajax Call to connect case with doctor*/

    function connect_case() {
        var caseId = $('#connect_case_id').val();
        var doctor_id = $('#clinic_doc').val();

        if (doctor_id == '') {
            toastr.error('Please select doctor first', 'Validation Error', {timeOut: 5000});
            return false;
        }
        $.ajax({
            type: "POST",
            url: base_url + "/connect/case",
            data: {
                'id': caseId,
                'doctor_id': doctor_id
            },
            // beforeSend: function () {
            //     ajaxLoader();
            // },
            beforeSend: function () {
                ajaxLoader();
            },
            xhr: function () {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function (evt) {
                        if (evt.lengthComputable) {
                            console.log(evt)
                            var percentComplete = evt.loaded / evt.total;
                            percentComplete = parseInt(percentComplete * 100);
                            ajaxLoaderprograss(percentComplete);
                        }
                }, false);
                return xhr;
            },

            success: function (data) {
                if (data.done == true) {

                    toastr.success('Case assigned Successfully', 'Case Assigned', {
                        timeOut: 2000
                    });
                    setTimeout(function () {
                        location.reload(true)
                    }, 1000);

                } else if (data.done == false) {

                    toastr.success('Error in assigning case', 'Error', {
                        timeOut: 2000
                    });
                    setTimeout(function () {
                        location.reload(true)
                    }, 1000);

                } else {

                    toastr.error('Something Went Wrong, Try again', '', {
                        timeOut: 2000
                    });
                }
                //  setTimeout(function () {location.reload(true)}, 1000);
            },
            error: function (message, error) {
                $('#loader').fadeOut();
                toastr.error('Something Went Wrong', '', {
                    timeOut: 2000
                });
            }
        });
    }
</script>
<script src="{{ asset('vendors/scripts/case_ajax.js') }} "></script>


