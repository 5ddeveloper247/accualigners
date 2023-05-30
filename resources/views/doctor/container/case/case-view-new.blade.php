<style>
    body {
        display: none;
    }

    .pop3 {
        position: fixed;
        bottom: 0px;
        top: 0px;
        left: 0;
        right: 0;
        background-color: rgb(4 4 4 / 60%);
        height: 100vh;
        z-index: 999999;
    }

    .accordion {
        margin: 0px !important;
    }

    .item1 {
        display: grid;
        grid-template-columns: auto 1fr auto;
        padding: 8px 8px 0 8px;
        align-items: center;
        column-gap: 24px;
        row-gap: 32px;
        border: 1px solid #e3e3e3 !important;
        position: unset;
        width: 100%;
        border-radius: 10px;
        margin-top: 0px !important;
    }

    .controlabel {
        margin-top: -10px;
        line-height: 1px;
    }

    .mrgtab {
        margin-top: -50px;
    }

    /*
.controlabel label{
    margin-top: 35px;
    line-height: 2px;
}
.controlabel {

    margin-top: -32px;
}*/
    .toggle-on {
        line-height: 15px !important;
    }

    .toggle-off.btn {
        padding-left: 0.8rem !important;
        line-height: 15px;
    }

    .classma td select {
        display: block !important;
    }
</style>
@php
    $title = 'Case';
@endphp
@extends('originator.root.dashboard_side_bar', ['title' => $title])
@section('title', 'Case')
@php
    $componentsJsCss = ['adminPanel.general', 'adminPanel.validation', 'adminPanel.select2', 'adminPanel.switch-checkbox', 'adminPanel.input-mask', 'adminPanel.datetime-picker', 'adminPanel.file-input-button'];

    $edit_id = false;
    $viewRoute = route('admin.case.index');

    if (Request()->route('case')) {
        $edit_id = Request()->route('case');
        $form_action = route('admin.case.update', $edit_id);
    }
@endphp

<link rel="stylesheet" href="{{ asset('vendors/css/case-style.css') }}"/>
<style>
    .deleteform {
        position: relative;
        top: 20px;
        height: auto;
        /* height: 750px; */
    }

    .cardwidth {
        float: left;
        margin: 5px;
        width: 39px;
    }

    .relative {
        position: relative;
    }

    .absolute {
        position: absolute;
        top: 4px;
        right: 9px;
    }

    .tablerow thead th {
        font-size: 13px !important;
        white-space: nowrap;
    }

    .tablerow td {
        font-size: 13px !important;
        white-space: nowrap;
    }

    .tablerow tr td a {
        color: #00205C;
        cursor: pointer;
        text-decoration: underline;
        font-size: 13px;
    }

    /* .sidebar-menu ul li a {
    background-color: #ffffff!important;
    width:300px!important;
}
.sidebar-menu ul li a:hover {
    background-color: #ecf0f4!important;
    width:300px!important;
} */
    /* .iconsdazama {
    position: relative!important;
    right: 61px!important;
}.iconsdazama img {
    position: relative;
    bottom: 3px;
    margin-right: 1%;
} */
    #example1 {
        width: 100% !important;
    }

    @media (max-width: 500px) {
        .deleteform {
            padding-bottom: 12rem;

        }
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

    .classma td select {
        display: block !important;
    }

    /* .sidebar-menu .dropdown-toggle {
    display: block;
    padding: 18px 15px 18px 77px;
    font-size: 16px;
    color: #fff;
    font-weight: 300;
    letter-spacing: .03em;
    position: relative;
    font-family: 'Inter', sans-serif;
} */
</style>
<div class="mobile-menu-overlay"></div>
<!-- saadullah -->

<div class="main-container">
    <div class="m-3">
        <div class="row">
            <div class="col-xl-12 ">
                <div class="row">
                    <div class="col-xl-4 onedo ">
                        <div class="">
                            <div class="widget-data">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item removeka activecase " onclick="changeClass(1)">
                                        <a class="nav-link textcolor " id="home-tab" data-toggle="tab" href="#home"
                                           role="tab" aria-controls="home" aria-selected="true"
                                           style="">Active</a>
                                    </li>
                                    <li class="nav-item addka changecolor " onclick="changeClass(2)">
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

                    <div class="col-xl-4 fourdo mb-30">
                        <div class="carx2 input">

                            <form action="{{ url('admin/case_new') }}" id="filter-form" method="get">
                                <input type="text" class="form-control" name="filter" placeholder="Search...">
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

                    <div class="col-xl-4 mb-30 threedo bgcolorbordertxt">

                        <a class="btn bgcolor float-right m-1 text-white  addcase">Add Case <i
                                class="bi bi-plus-circle"></i></a>

                        <a class="btn bgcolorborder  m-1 float-right delete1" style="font-size:22px;">Delete<i
                                class="bi bi-trash3"></i></a>

                        <!-- <a class="btn bgcolorborder hitme d-none m-1 float-right pooopdo addkado" style="font-size:22px;">Delete<i class="bi bi-trash3"></i></a> -->

                        <a class="ete checkboxbandka cursor cleardo float-right"
                           style="margin-top: 4px;font-size:22px;display: none;">Clear
                            <i class="bi bi-eraser-fill"></i>
                        </a>

                    </div>
                </div>

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
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

                                                <th>Case ID</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Gender</th>
                                                <th>Treatment Plan</th>
                                                <th>Aligners</th>
                                                <th>Status</th>
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
                                                        <td>{{ isset($case->email) ? ucwords($case->email) : 'N/A' }}
                                                        </td>
                                                        <td>{{ isset($case->phone_no) ? $case->phone_no : 'N/A' }}</td>
                                                        <td>{{ isset($case->gender) ? ucfirst($case->gender) : 'N/A' }}
                                                        </td>

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
                                                                            {{ ucfirst(strtolower('Order In Production')) }}
                                                                        @endif
                                                                    @endif
                                                                @endif

                                                            </a></td>
                                                        <td class="align-middle"
                                                            style="width: 45px;font-size:9px !important;">
                                                            <a href="{{ url('/doctor/case_detail/' . $case->id) }}"
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
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="tabdata">
                                    <div class=" table-responsive">
                                        <table class="table tablerow" id="example1">
                                            <thead>
                                            <tr>
                                                <th style="display:none;"></th>
                                                <th>Case ID</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Gender</th>
                                                <th>Treatment Plan</th>
                                                <th>Aligners</th>
                                                <th>Status</th>
                                                <th>View</th>
                                                <th>Edit</th>
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
                                                        </td>
                                                        <td>{{ $case->id }}</td>
                                                        <td>{{ ucwords($case->name) }}</td>
                                                        <td>{{ isset($case->email) ? ucwords($case->email) : 'N/A' }}
                                                        </td>
                                                        <td>{{ isset($case->phone) ? $case->phone_no : 'N/A' }}
                                                        </td>
                                                        <td>{{ isset($case->gender) ? ucfirst($case->gender) : 'N/A' }}
                                                        </td>
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
                                                                              style="">

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
                                                        <td class="align-middle"
                                                            style="width: 45px;font-size:9px !important;">
                                                            <a href="{{ url('/doctor/case_detail/' . $case->id) }}"
                                                               data-toggle="tooltip"
                                                               data-original-title="View Case">View Details</a>
                                                        </td>
                                                        <td><a class="btn_edit"
                                                               onclick="editFunction({{ $case->id }})"><i
                                                                    class="bi bi-pencil-square"></i></a></td>

                                                    </tr>
                                                    @php($a++)
                                                @endif
                                            @endforeach
                                            @if ($a == 0)
                                                <tr>
                                                    <td colspan="5">
                                                        <h3 align="center" style="color:#d3d3d3;">No data to show
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
                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab"></div>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="{{ asset('vendors/dist/accordion.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    new Accordion('.accordion-container');
</script>

<!-- js -->
<script src="{{ asset('vendors/scripts/core.js') }} "></script>
<script src="{{ asset('vendors/scripts/script.min.js') }} "></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

<script>
    function bndka() {
        // $('.pop1').addClass('d-none');
        $('.pop1').fadeOut('d-none');
    }

    $('.addcase').click(function () {
        resetAddCase();
        $('#select1').attr('disabled', false);
        $('#select2').attr('disabled', false);
        for (var x = 1; x <= 9; x++) {
            $('#conidion' + x).prop('disabled', false);
        }
        $('#name , #phone_no , #email , #address , #dob').removeAttr('readonly');
        $('.disable_input , #arch_to_treat , #a_p_relationship , #overjet , #overbite , #midline , #clinical_comment , #prescription_comment')
            .prop('disabled', false);
        $('.add_image , .remove_image').show();
        // $('.pop1').removeClass('d-none');
        $('.pop1').fadeIn('d-none');
    });

    function bndka1() {
        $('.pop2').addClass('d-none');
        $('.pop3').addClass('d-none');
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
        for (i = 1; i < records1; i++) {
            $("#a" + i).prop('checked', false);
        }
        for (i = 1; i < records2; i++) {
            $("#b" + i).prop('checked', false);
        }

    });
    $(document).ready(function () {
        $("#example").DataTable();
        $('#example1').DataTable();
    });
</script>

</body>

</html>
<div class="pop1 scrolldo" style="display:none">
    <div class="">
        <form class="form-horizontal" method="POST" id="frmcase2" action="" enctype="multipart/form-data"
              novalidate>
            @csrf
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
                                <i class="fa-solid float-right bandeka cursor fa-xmark " onclick="bndka();"></i>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-md-12 px-4 brdall py-4">
                    <div class="row  ">
                        <div class="col-md-12 bold ">
                            <h4 class="textcolor ">Patient's Detail</h4>

                            <i class="fa-solid fa-chevron-down float-right mt-1"></i>
                        </div>


                    </div>
                    <div class="row pb-4 mt-3">
                        <div class="col-md-6 bold ">
                            <span>Patient's Name*</span><span id="name_v_msg" style="margin-left: 25px;font-size: 10px;color: red;font-weight: bold;font-family:'Inter';"></span>
                            <input type="hidden" name="ElementId" id="ElementId" value=""/>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Enter Here">
                        </div>
                        <div class="col-md-6 bold ">
                            <span>Patient's Email(Optional)</span><span id="email_v_msg" style="margin-left: 25px;font-size: 10px;color: red;font-weight: bold;font-family:'Inter';"></span>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter Here">
                        </div>
                    </div>
                    <div class="row  pb-4">
                        <div class="col-md-6 bold ">
                            <span>Patient's Phone No(Optional)</span><span id="phone_v_msg" style="margin-left: 25px;font-size: 10px;color: red;font-weight: bold;font-family:'Inter';"></span>
                            <input type="number"  name="phone_no" id="phone_no"class="form-control" placeholder="Enter Here">
                        </div>
                        <div class="col-md-6 bold ">
                            <span>Patient's DOB(Optional)</span><span id="dob_v_msg" style="margin-left: 25px;font-size: 10px;color: red;font-weight: bold;font-family:'Inter';"></span>
                            <input type="date" name="dob" id="dob" class="form-control" pattern="\d{2}/\d{2}/\d{4}" placeholder="Enter Here">
                        </div>
                    </div>
                    <div class="row  pb-4">
                        <div class="col-md-12 bold address">
                            <span>Address(Optional)</span>
                            <input type=""  name="address" id="address" class="form-control" placeholder="Type Here">
                        </div>

                    </div>
                </div> --}}
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
                                                    <input type="text" name="phone_no"
                                                           id="phone_no" class="form-control" placeholder="Enter Here">
                                                    <span id="phone_v_msg"
                                                          style="margin-left: 25px;font-size: 10px;color: red;font-weight: bold;font-family:'Inter';"></span>
                                                </div>
                                                <div class="col-md-6 bold ">
                                                    <span>Patient's DOB(Optional)</span>
                                                    <input type="date" name="dob" id="dob"
                                                           class="form-control" pattern="\d{2}/\d{2}/\d{4}"
                                                           placeholder="Enter Here">
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
                                            <div class="row controlabel">
                                                <div class="col-md-4 mb-4 " style="margin-bottom: 2.5rem!important;">


                                                    <label for="">Arch to treat* <span
                                                            style="visibility:hidden;">Overflow</span></label>
                                                    <div class="btn-group mt-3">
                                                        <input type="checkbox" id="arch_to_treat" value="1"
                                                               name="arch_to_treat" data-toggle="toggle"
                                                               data-onstyle="outline-primary"
                                                               data-offstyle="outline-secondary" data-style="ios">
                                                    </div>
                                                </div>

                                                <div class="col-md-4 mb-4 " style="margin-bottom: 2.5rem!important;">
                                                    <label for="">A-P Relation* <span
                                                            style="visibility:hidden;">Overflow</span></label>
                                                    <div class="btn-group mt-3">
                                                        <input type="checkbox" id="a_p_relationship"
                                                               name="a_p_relationship" data-toggle="toggle"
                                                               data-onstyle="outline-primary"
                                                               data-offstyle="outline-secondary" data-style="ios">
                                                    </div>

                                                </div>

                                                <div class="col-md-4 mb-4 " style="margin-bottom: 2.5rem!important;">
                                                    <label for="">Overjet* <span
                                                            style="visibility:hidden;">Overflow</span></label>

                                                    <div class="btn-group mt-3">
                                                        <input type="checkbox" id="overjet" name="overjet"
                                                               data-toggle="toggle" data-onstyle="outline-primary"
                                                               data-offstyle="outline-secondary" data-style="ios">


                                                    </div>

                                                </div>
                                                <div class="col-md-4 mb-4 " style="margin-bottom: 2.5rem!important;">
                                                    <label for="">Overbite* <span
                                                            style="visibility:hidden;">Overflow</span></label>

                                                    <div class="btn-group mt-3">
                                                        <input type="checkbox" id="overbite" name="overbite"
                                                               data-toggle="toggle" data-onstyle="outline-primary"
                                                               data-offstyle="outline-secondary" data-style="ios">


                                                    </div>

                                                </div>
                                                <div class="col-md-4 mb-4 " style="margin-bottom: 2.5rem!important;">
                                                    <label for="">MidLine*<span
                                                            style="visibility:hidden;">Overflow</span></label>

                                                    <div class="btn-group mt-3">
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
                                                              style="height:80px!important;" name="prescription_comment"
                                                              name="prescription_comment" required
                                                              data-validation-required-message="Prescription Comment is required"></textarea>

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
                                                <div class="row">
                                                    <div class="col-md-6 mrgtab">
                                                        @php($a = 1)
                                                        @foreach ($ClinicalConditions as $ClinicalCondition)
                                                            @if ($a == 5 || $a == 9)
                                                    </div>
                                                    <div class="col-md-6 mrgtab">
                                                        @endif
                                                        <input type="checkbox" class="checkbox_form"
                                                               name="clinical_conditions[]"
                                                               id="conidion{{ $a }}"
                                                               value="{{ $ClinicalCondition->id }}"
                                                               style="width:20px;height:13px;margin:10px;"/>
                                                        <span
                                                            style="font-size: 17px;">{{ ucwords($ClinicalCondition->name) }}
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
                                                <?php $i = 1; ?>
                                                <div class="col-md-12 p-0 px-2    pb-3">
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
                                                                           class="hidden upload-attachment {{ 'IMAGE_' . $i }} disable_input"
                                                                           data-type="IMAGE"
                                                                           data-sort="{{ $i }}"
                                                                           onchange="preViewImage2(this)" multiple
                                                                           hidden>
                                                                    <img src="{{ $media }}"
                                                                         id="{{ 'IMAGE_' . $i }}" alt="Image"
                                                                         class="img-thumbnail image_attach"
                                                                         onclick="updateImage('{{ $i }}')">
                                                                    <input type="hidden" value="{{ $media }}"
                                                                           id="img_src_{{ $i }}">
                                                                    <input type="hidden" value=""
                                                                           id="img_id_{{ $i }}"
                                                                           class="get_id">
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
                                                    <!-- <span  class="add_image">+</span>
                                                <span class="remove_image">-</span> -->
                                                </div>
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
                                                        <span
                                                            style="font-size: 11px;
                                    ">JPG,
                                                            PNG or PDF, file size no more than 10MB</span>
                                                    </div>
                                                    <div class="col-md-2 mt-2 p-0 pt-2">
                                                        <label class="btn">
                                                            <input type="file" id="upload_attach"
                                                                   accept="image/*,application/pdf"
                                                                   name="X_RAY_[]"
                                                                   class="hidden upload-attachment disable_input"
                                                                   data-type="X_RAY" data-sort="{{ $i }}"
                                                                   onchange="preViewImage(this)"  hidden>
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

                                    </div>
                                    </dv>
                                    <div class="item1">
                                        <p class="number">06</p>
                                        <p class="text">Jaw Scan(Upper/Lower)</p>
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
                                                                           id="jaw_{{ $i }}"
                                                                           accept="image/*,application/pdf"
                                                                           name="{{ $jaw_type . '_' . $i }}"
                                                                           class="hidden upload-attachment disable_input"
                                                                           data-type="{{ $jaw_type }}"
                                                                           onchange="preViewJawImage(this)"
                                                                           data-sort="{{ $i }}" multiple hidden>
                                                                    <img src="{{ $media }}"
                                                                         id="{{ $jaw_type . '_' . $i }}" alt="Image"
                                                                         class="img-thumbnail">
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
                                                                            class="form-select form-control">
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
                                                            <span>Patient Consent form</span> <span
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
                                                                or drag and drop here</h5>
                                                            <span style="font-size: 11px;">JPG, PNG or PDF, file size
                                                                no more than 10MB</span>
                                                        </div>
                                                        <div class="col-md-2 mt-2 p-0 pt-2">
                                                            <label class="btn">
                                                                <input type="file" name="OTHER"
                                                                       accept="image/*,application/pdf"
                                                                       class="hidden upload-attachment"
                                                                       data-type="PATIENT_FORM"
                                                                       data-sort="1" hidden
                                                                       onchange="preViewImage(this)">
                                                                <input type="hidden" value=""
                                                                       id="embedded_url_1" class="get_id">
                                                                <img
                                                                    src="{{ asset('link/files/app-assets/images/case/upload.png') }}"
                                                                    id="PATIENT_FORM_1" alt="Image"
                                                                    class="img-thumbnail" style="width: 35px;"/>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12 mt-3">
                                                            <span>Other files</span>
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
                                                                or drag and drop here</h5>
                                                            <span style="font-size: 11px;">JPG, PNG or PDF, file size
                                                                no more than 10MB</span>
                                                        </div>
                                                        <div class="col-md-2 mt-2 p-0 pt-2">
                                                            <label class="btn">
                                                                <input type="file" name="OTHER"
                                                                       accept="image/*,application/pdf"
                                                                       class="upload-attachment" data-type="OTHER"
                                                                       data-sort="2" hidden multiple
                                                                       onchange="preViewImage2(this)">
                                                                <input type="hidden" value=""
                                                                       id="embedded_url_1" class="get_id">
                                                                <img
                                                                    src="{{ asset('link/files/app-assets/images/case/upload.png') }}"
                                                                    id="OTHER_2" alt="Image"
                                                                    class="img-thumbnail" style="width: 35px;">
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
                                <button type="submit" class="btn bgcolor text-white casebtn float-right"
                                        id="btn_submit">Submit
                                </button>
                                <a class="btn bgcolorborder mx-2 mb-5 float-right" style="font-size:22px;"
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
        <div class="col-md-4 bg-white popadd deleteform" style="margin-top: 14%;">
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
<!-- Prev code implementation -->
<script>
    var base_url = "{{ url('doctor') }}";
    var case_id = '{{ isset($edit_values->id) ? $edit_values->id : '' }}';
    var records1 = "{{ $a }}";
    var records2 = "{{ $b }}";
    $('.date-picker').daterangepicker({
        singleDatePicker: !0,
        showDropdowns: !0
    });
    $('body').on('change', '.upload-attachment', function () {
        console.log('in');

        var sort = $(this).data('sort');
        var type = $(this).data('type');
        readURL(this, type, sort);

    });
    // url:'{{ route('admin.case.destroy-attachment') }}',
</script>

<style>
    .deleteform {
        top: -3px !important;
        height: auto !important;
    }

    .pop2 {
        position: fixed;
        bottom: 0px;
        top: 0px;
        left: 0;
        right: 0;
        height: auto;
        background-color: rgb(4 4 4 / 60%);
        z-index: 999999;
    }
</style>

<div class="pop3 d-none " id="payment" style="overflow:scroll;">
    <div class="row m-0">
        <div class="col-md-8 m-auto bg-white popadd deleteform" style="height: 650px;">
            <div class="page6box py-3 ">
            </div>
            <div class="row px-4 mb-5 ">
                <div class="col-md-12">
                    <div class="row borderbottom mb-4 ">
                        <div class="col-md-11 col  p-0 aresure  bold m-auto">
                            <h5 class="t text-dark ">
                                Payments
                            </h5>
                            <p class="mt-3">Please enter your card details or proceed with cash</p>
                        </div>
                        <div class="col-md-1 relative col">
                            <i class="fa-solid bandeka absolute cursor fa-xmark " onclick="bndka1();"></i>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 p-0 aresure  bold m-auto">
                            <h6 class="t text-dark ">
                                Order Details
                            </h6>
                        </div>
                    </div>
                    <div class="row "
                         style="background-color: #f6f6f6;
                    border: 1px solid #d0d0d0;border-radius:8px;">

                        <div class="col-md-6 p-2 p-0 aresure  bold m-auto">

                            <p class="mt-3 d-inline">
                                Item:</p>
                            <span style="font-weight:bold;font-size: 13px;">Digital Model/ Treatment Plan</span>
                        </div>
                        <div class="col-md-6 px-2 p-0 aresure  bold m-auto">
                            <h6 class="t text-dark ">
                                <input type="hidden" name="payment_price_actual">
                                <p class="mt-3 d-inline float-right">

                                    Total Price: <span style="font-weight:bold;font-size: 15px;" id="payment_price">
                                        1980 AED</span></p>
                        </div>


                    </div>

                    <div class="row mt-4 bordertop ">
                        <div class="col-md-12 p-2 p-0 aresure bold m-auto">
                            <h6 class="t text-dark mt-3">
                                Payment Details
                            </h6>
                            <p>Select Payment method</p>
                            <select selected class="form-select form-control" id="payment_change">
                                <option value="stripe">Card Payment</option>
                                <option value="invoice">Cheque/Cash</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-4 bordertop stripe-div">
                        <div class="col-md-12 p-2 p-0 aresure  bold m-auto">
                            <p class="t text-dark">Card Number</p>
                            <div class="row">
                                <div class="col-md-3 col p-2">
                                    <div classs="payment">

                                        <div class="cardwidth">
                                            <input type="text" maxlength="1" name="1" id="c_1"
                                                   value="" class="form-control number_val " placeholder="-">
                                        </div>
                                        <div class="cardwidth">
                                            <input type="text" maxlength="1" name="2" id="c_2"
                                                   value="" class="form-control number_val" placeholder="-">
                                        </div>
                                        <div class="cardwidth">
                                            <input type="text" maxlength="1" name="3" id="c_3"
                                                   value="" class="form-control number_val" placeholder="-">
                                        </div>
                                        <div class="cardwidth">
                                            <input type="text" maxlength="1" name="4" id="c_4"
                                                   value="" class="form-control number_val" placeholder="-">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col p-2 ">
                                    <div classs="payment">
                                        <div class="cardwidth">
                                            <input type="text" maxlength="1" name="5" id="c_5"
                                                   value="" class="form-control number_val" placeholder="-">
                                        </div>
                                        <div class="cardwidth">
                                            <input type="text" maxlength="1" name="6" id="c_6"
                                                   value="" class="form-control number_val" placeholder="-">
                                        </div>
                                        <div class="cardwidth">
                                            <input type="text" maxlength="1" name="7" id="c_7"
                                                   value="" class="form-control number_val" placeholder="-">
                                        </div>
                                        <div class="cardwidth">
                                            <input type="text" maxlength="1" name="8" id="c_8"
                                                   value="" class="form-control number_val" placeholder="-">
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-3 col p-2 ">
                                    <div classs="payment">
                                        <div class="cardwidth">
                                            <input type="text" maxlength="1" name="9" id="c_9"
                                                   value="" class="form-control number_val" placeholder="-">
                                        </div>
                                        <div class="cardwidth">
                                            <input type="text" maxlength="1" name="10" id="c_10"
                                                   value="" class="form-control number_val" placeholder="-">
                                        </div>
                                        <div class="cardwidth">
                                            <input type="text" maxlength="1" name="11" id="c_11"
                                                   value="" class="form-control number_val" placeholder="-">
                                        </div>
                                        <div class="cardwidth">
                                            <input type="text" maxlength="1" name="12" id="c_12"
                                                   value="" class="form-control number_val" placeholder="-">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col p-2">
                                    <div classs="payment">
                                        <div class="cardwidth">
                                            <input type="text" maxlength="1" name="13" id="c_13"
                                                   value="" class="form-control number_val" placeholder="-">
                                        </div>
                                        <div class="cardwidth">
                                            <input type="text" maxlength="1" maxlength="1" name="14"
                                                   id="c_14" value="" class="form-control number_val"
                                                   placeholder="-">
                                        </div>
                                        <div class="cardwidth">
                                            <input type="text" maxlength="1" name="15" id="c_15"
                                                   value="" class="form-control number_val" placeholder="-">
                                        </div>
                                        <div class="cardwidth">
                                            <input type="text" maxlength="1" name="16" id="c_16"
                                                   value="" class="form-control number_val" placeholder="-">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row stripe-div">
                        <div class="col-md-6 p-2 p-0 aresure   bold m-auto">
                            <h6 class="t text-dark mt-3">
                                MM/YY
                            </h6>
                            <input type="" placeholder="MM/YY" class="form-control" id="month_year"
                                   name="month_payment">
                        </div>
                        <div class="col-md-6 p-2 p-0 aresure   bold m-auto stripe-div">
                            <h6 class="t text-dark mt-3">
                                CSV
                            </h6>
                            <input type="" maxlength="4" placeholder="CSV" class="form-control"
                                   id="csv" name="csv_payment">
                        </div>
                    </div>
                </div>

                <div class="col-md-12 delebtn" style="padding:21px !important;">
                    <button class="btn  text-white bgcolor float-right d-none" id="pay_now_invoice">Submit</button>
                    <button class="btn  text-white bgcolor float-right stripe-div" id="pay_now"
                            style="margin-top: 17px;">Pay Now
                    </button>
                    <a class="btn cancelbtn  text-white  float-right stripe-div" onclick="bndka1();">Cancel</a>
                </div>
            </div>
        </div>
    </div>
</div>
<form id="stripe_form">
    <input type="hidden" name="" id="order_payment"/>
    <input type="hidden" name="" id="order_currency"/>
    <input type="hidden" name="" id="stripe_token"/>
    <input type="hidden" name="" id="order_case_id"/>
</form>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<!-- {{-- <script src="https://js.stripe.com/v3/"></script> --}} -->

<script src="{{ asset('vendors/scripts/doctor_case_ajax.js') }} "></script>
<script>
    /*  _____________________Stripe Payment Ajax_____________________ */
    $(document).on('click', '#pay_now', function (e) {
        e.preventDefault();
        var token = '';
        var c1 = $('#c_1').val();
        var c2 = $('#c_2').val();
        var c3 = $('#c_3').val();
        var c4 = $('#c_4').val();
        var c5 = $('#c_5').val();
        var c6 = $('#c_6').val();
        var c7 = $('#c_7').val();
        var c8 = $('#c_8').val();
        var c9 = $('#c_9').val();
        var c10 = $('#c_10').val();
        var c11 = $('#c_11').val();
        var c12 = $('#c_12').val();
        var c13 = $('#c_13').val();
        var c14 = $('#c_14').val();
        var c15 = $('#c_15').val();
        var c16 = $('#c_16').val();
        var pattern = /^\d{1,2}\/\d{1,2}$/;
        var month_year = $('#month_year').val();
        var csv = $('#csv').val();

        if (c1 == '') {
            toastr.error('Please Enter valid number in card number field', {
                timeOut: 3000
            });
        } else if (c2 == '') {
            toastr.error('Please Enter valid number in card number field', {
                timeOut: 3000
            });
        } else if (c3 == '') {
            toastr.error('Please Enter valid number in card number field', {
                timeOut: 3000
            });
        } else if (c4 == '') {
            toastr.error('Please Enter valid number in card number field', {
                timeOut: 3000
            });
        } else if (c5 == '') {
            toastr.error('Please Enter valid number in card number field', {
                timeOut: 3000
            });
        } else if (c6 == '') {
            toastr.error('Please Enter valid number in card number field', {
                timeOut: 3000
            });
        } else if (c7 == '') {
            toastr.error('Please Enter valid number in card number field', {
                timeOut: 3000
            });
        } else if (c8 == '') {
            toastr.error('Please Enter valid number in card number field', {
                timeOut: 3000
            });
        } else if (c9 == '') {
            toastr.error('Please Enter valid number in card number field', {
                timeOut: 3000
            });
        } else if (c10 == '') {
            toastr.error('Please Enter valid number in card number field', {
                timeOut: 3000
            });
        } else if (c11 == '') {
            toastr.error('Please Enter valid number in card number field', {
                timeOut: 3000
            });
        } else if (c12 == '') {
            toastr.error('Please Enter valid number in card number field', {
                timeOut: 3000
            });
        } else if (c14 == '') {
            toastr.error('Please Enter valid number in card number field', {
                timeOut: 3000
            });
        } else if (c15 == '') {
            toastr.error('Please Enter valid number in card number field', {
                timeOut: 3000
            });
        } else if (c16 == '') {
            toastr.error('Please Enter valid number in card number field', {
                timeOut: 3000
            });
        } else {

            if (pattern.test(month_year)) {

                var cardNumber = c1 + c2 + c3 + c4 + ' ' + c5 + c6 + c7 + c8 + ' ' + c9 + c10 + c11 + c12 +
                    ' ' + c13 + c14 + c15 + c16;
                //  alert(month_year.split('/'));
                //  alert(cardNumber);
                //  alert(month_year.split('/')[0]);
                //  alert(month_year.split('/')[1]);

                Stripe.setPublishableKey(`{{ env('STRIPE_KEY') }}`);
                Stripe.createToken({
                    number: cardNumber,
                    cvc: csv,
                    exp_month: month_year.split('/')[0],
                    exp_year: month_year.split('/')[1]
                }, stripeResponseHandler);

                console.log(month_year.split('/')[0]);

                function stripeResponseHandler(status, response) {
                    if (response.error) {
                        toastr.error(response.error.message, {
                            timeOut: 3000
                        });
                    } else {
                        /* token contains id, last4, and card type */
                        token = response['id'];
                        var id = $('#order_case_id').val();
                        var payment = $('#order_payment').val();
                        var currency = $('#order_currency').val();

                        $.ajax({
                            type: "POST",
                            url: base_url + "/case/payment/store",
                            data: {
                                'id': id,
                                'amount': payment,
                                'currency': currency,
                                'stripeToken': token,
                            },
                            beforeSend: function () {
                                ajaxLoader();
                            },
                            success: function (data) {
                                if (data.data = 'success') {
                                    $('.pop1').addClass('d-none');
                                    $('.pop1').fadeOut('d-none');
                                    $('#payment').removeClass('d-none');
                                    //  $('#order_payment').val(data.case.processing_fee_amount);
                                    $('#loader').fadeOut();
                                    toastr.success('Payment Successfull', '', {
                                        timeOut: 2000
                                    });
                                    setTimeout(function () {
                                        location.reload(true)
                                    }, 1000);
                                } else {
                                    $('#loader').fadeOut();
                                    toastr.error('Something Went Wrong, Try Again', '', {
                                        timeOut: 2000
                                    });
                                }
                            },
                            error: function (message, error) {
                                $('#loader').fadeOut();
                                $.each(message['responseJSON'].errors, function (key, value) {
                                    toastr.error(value, {
                                        timeOut: 3000
                                    });
                                });
                            }
                        });
                    }
                }
            } else {
                toastr.error('Date should be in 03/23 fomrat,Month followed by year', {
                    timeOut: 3000
                });
                ///error date
            }
        }
    });

    $(document).on('change', '#payment_change', function (e) {
        if ($(this).val() == 'stripe') {
            $('.stripe-div').show();
            $('#pay_now_invoice').addClass('d-none');
        } else {
            $('.stripe-div').hide();
            $('#pay_now_invoice').removeClass('d-none');
        }

    });
</script>
