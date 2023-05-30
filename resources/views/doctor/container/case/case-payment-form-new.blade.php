<style>
    body{
        display: none;
    }
</style>
@php
$title = 'case';
@endphp
@extends('originator.root.dashboard_side_bar',['title' => $title])
@section('title', "Case")
@php
$componentsJsCss = [
    'adminPanel.general',
    'adminPanel.validation',
    'adminPanel.select2',
    'adminPanel.switch-checkbox',
    'adminPanel.input-mask',
    'adminPanel.datetime-picker',
    'adminPanel.file-input-button',
];

$edit_id = false;
$viewRoute = route('admin.case.index');
$form_action = route('admin.case.store');

$form_action = route('doctor.case.payment.store', ['case'=>$case->id]);


if(Request()->route('case')){
    $edit_id = Request()->route('case');
    $form_action = route('admin.case.update', $edit_id);
}
@endphp

<link rel="stylesheet" href="{{asset('vendors/css/case-style.css')}}"/>
<style>
.deleteform {
    position: relative;
    top: 20px;
    height: auto;
    height: 750px;

}
.cardwidth{
    float: left;
    margin:5px;

}
.relative{
    position: relative;
}
.absolute{
    position: absolute;
    top: 4px;
    right: 9px;
}
@media(max-width:500px){
    .deleteform {
padding-bottom: 12rem;

}
}

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
                                    <li class="nav-item removeka activecase ">
                                        <a class="nav-link textcolor " id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true" style="" onclick="runka(1)">Active</a>
                                    </li>
                                    <li class="nav-item addka changecolor " onclick="runka(2)">
                                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Draft</a>
                                    </li>
                                    <li class="nav-item ">
                                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false"></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 fourdo mb-30">
                        <div class="carx2 input">

                 <form action="{{url('admin/case_new')}}" id="filter-form" method="get">
                             <input type="text" class="form-control" name="filter" placeholder="Search...">
                             <div class="searchicons">
                             <button type="submit" style="background: none;border:none;">
                             <i class="bi bi-search" style="margin-right:12px;"></i>|
                             </button>|
                             <a href="{{ Request()->has('filter') ? url(Request()->path()) : 'JavaScript:void(0);'}}">
                                <i class="bi bi-sliders"></i>
                             </a>
                        </div>
                 </form>

                        </div>
                    </div>

                    <div class="col-xl-4 mb-30 threedo bgcolorbordertxt">

                        <a class="btn bgcolor float-right m-1 text-white  addcase">Add Case <i class="bi bi-plus-circle"></i></a>

                        <a class="btn bgcolorborder  m-1 float-right delete1" style="font-size:22px;">Delete<i class="bi bi-trash3"></i></a>

                        <!-- <a class="btn bgcolorborder hitme d-none m-1 float-right pooopdo addkado" style="font-size:22px;">Delete<i class="bi bi-trash3"></i></a> -->

                        <a class="ete checkboxbandka cursor cleardo float-right"  style="margin-top: 4px;font-size:22px;display: none;">Clear
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
                                        <table class="table tablerow complete" id="example" style="width: 100% !important;">
                                            <thead>

                                                <tr>
                                                     <th class=" checkboxbandka " style="display: none;">
                                                        <input type="checkbox"  id="btnCheckAll"/>
                                                     </th>

                                                     <th>Case ID</th>
                                                     <th>Name</th>
                                                     <th>Email </th>
                                                     <th>Phone</th>
                                                     <th>Gender</th>
                                                     <th>Treatment Plan</th>
                                                     <th>Aligners</th>
                                                     <th>Status</th>
                                                     <th></th>
                                                    <th>Action</th>
                                                </tr>

                                            </thead>
                                            <tbody class="tablerow">
                                                @php($a = 1)
                                                @foreach($cases as $case)

                                                <tr data-aeshaz-select-id="{{$case->id}}">
                                                    <td class=" checkboxbandka" style="display: none;">

                                                <input type="checkbox" id="a{{$a++}}" value="{{$case->id}}"></td>
                                                    </td>
                                                    <td>{{$case->id}}</td>
                                                    <td>{{$case->name}}</td>
                                                    <td>{{$case->email}}</td>
                                                    <td>{{$case->phone_no}}</td>
                                                    <td>{{$case->gender}}</td>

                                                    <td><a class="{{ ($case->processing_fee_paid)?'painbtn':'inprogressbtn'}}">
                                                        {{($case->processing_fee_paid)?'paid':'unpaid'}}</a></td>

                                                    <td><a class=" @if (isset($case->aligner->payment_name) && !empty($case->aligner->payment_name)) paidbtn  @else inprogressbtn @endif">
                                                        @if (isset($case->aligner->payment_name) && !empty($case->aligner->payment_name)) Paid @else UnPaid @endif </a></td>

                                                    <td class="maindo"><a class="inprogressbtn" style="padding: 8px 0px;">

                                                           @if ($case->status == "CANCELED")
                                                            {{ucfirst(strtolower($case->status))}}

                                                            @elseif ($case->status == "PENDING")
                                                            {{ucfirst(strtolower($case->status))}}

                                                            @else

                                                            @if((empty($case->video_uploaded) && empty($edit_values->video_embedded)))
                                                            {{ucfirst(strtolower("Acculigners Lab"))}}

                                                            @elseif ((!empty($case->video_uploaded) ||
                                                            !empty($edit_values->video_embedded)) && !$case->has_concern &&
                                                            empty($case->aligner_kit_order_id))
                                                            {{ucfirst(strtolower("Review to dentist"))}}

                                                            @elseif ($case->has_concern)
                                                            {{ucfirst(strtolower("Review to you"))}}

                                                            @elseif (!empty($case->aligner_kit_order_id) &&
                                                            isset($case->aligner->status))

                                                            @if ($case->aligner->status == "DELIVERED")
                                                            {{ucfirst(strtolower($case->aligner->status))}}

                                                            @elseif ($case->aligner->status == "CANCELED")
                                                            {{ucfirst(strtolower($case->aligner->status))}}

                                                            @else
                                                            {{ucfirst(strtolower("Order in production"))}}
                                                            @endif

                                                            @endif
                                                            @endif

                                                        </a></td>
                                                        <td class="align-middle" style="width: 45px;font-size:9px !important;">
                                                        <a  href="{{url(Request()->path().'/'.$case->id)}}" data-toggle="tooltip" data-original-title="View Case">View Details</a>
                                            <!-- <div class="btn-group align-top">
                                                 <a href="{{url(Request()->path().'/'.$case->id.'/edit')}}" class="btn btn-sm btn-success RolePermissionUpdate" data-toggle="tooltip" data-original-title="Edit Case">Edit</a>
                                                <a href="{{url(Request()->path().'/'.$case->id)}}" class="btn btn-sm btn-info RolePermissionUpdate" data-toggle="tooltip" data-original-title="View Case">View</a>
                                                <a class="btn btn-sm btn-danger delete-confirm-alert RolePermissionDelete" href="javascript:void(0)" data-id="{{$case->id}}" data-toggle="tooltip" data-original-title="Delete Case">Delete</a>
                                            </div> -->
                                        </td>

                                                <td><a  class="btn_edit" onclick="editFunction({{$case->id}})"><i class="bi bi-pencil-square"></i></a></td>
                                                <!-- <td>
                                                    <i class="bi bi-three-dots-vertical dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="cursor:pointer"></i>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <a class="dropdown-item" style="text-align: center;padding: 0;text-decoration: none;" onclick="editFunction({{$case->id}})">Edit</a>
                                                        <a class="dropdown-item" style="text-align: center;padding: 0;text-decoration: none;" onclick="deleteClinicDoctor()">Delete</a>
                                                    </div>
                                                </td> -->
                                                </tr>

                                                @endforeach


                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="tabdata">
                                    <div class=" table-responsive">
                                        <table class="table tablerow" id="example1">
                                            <thead>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Phone</th>
                                                <th>Gender</th>
                                                <th>Action</th>
                                                <th></th>

                                            </thead>
                                            <tbody class="tablerow">
                                            @php($a=0)
                                            @foreach($cases as $case)
                                            @if($case->status == "CLOSED")
                                                <tr>
                                                     <td>{{$case->name}}</td>
                                                     <td>{{$case->phone_no}}</td>
                                                     <td>{{$case->gender}}</td>
                                                     <td class="maindo bgcolorbordertxt ">
                                                        <a class="radius textcolor bgcolorborder  ">complete </a>
                                                     </td>
                                                     <td><img src="images/dots.png"></td>
                                                </tr>
                                                @php($a++)
                                                @endif
                                                @endforeach
                                                @if($a==0)
                                                <tr>
                                                    <td colspan="5">
                                                        <h3 align="center" style="color:#d3d3d3;">No data to show</h3>
                                                    </td>
                                                </tr>
                                                @endif


                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
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
<script src="{{asset('vendors/scripts/core.js')}} "></script>
<script src="{{asset('vendors/scripts/script.min.js')}} "></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script>
    function bndka() {
        $('.pop1').addClass('d-none');
    }
    $('.addcase').click(function() {
        $('.pop1').removeClass('d-none');
    });

    function bndka1() {
        $('.pop2').addClass('d-none');
    }
    $('.delete1').click(function() {
        $(".checkboxbandka").delay(200).fadeIn();
        $('.checkboxbandka').removeClass('d-none');
        var recordId = [];
        var a = 0;
            for(i=1;i<records;i++)
            {
                if($("#a"+i).is(':checked')==true)
                {
                recordId[a] = $("#a"+i).val();
                a++;
                }
            }
        if(recordId.length != 0)
        {
         $(".pop2").removeClass("d-none");
        }
    });
      $('.cleardo').click(function() {
        $('.checkboxbandka').addClass('d-none');

    });

    $(document).ready(function() {
        $("#example").DataTable();
    });
</script>

</body>

</html>
<div class="pop1 d-none scrolldo">
    <div class="row m-0">
    <form class="form-horizontal" method="post" id="frmcase" action="" enctype="multipart/form-data" novalidate>
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
                <div class="col-md-12 px-4 brdall py-4">
                    <div class="row  ">
                        <div class="col-md-12 bold ">
                            <h4 class="textcolor ">Patient's Detail</h4>

                            <i class="fa-solid fa-chevron-down float-right mt-1"></i>
                        </div>


                    </div>
                    <div class="row pb-4 mt-3">
                        <div class="col-md-6 bold ">
                            <span>Patient's Name*</span>
                            <input type="hidden" name="ElementId" id="ElementId" value=""/>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Enter Here">
                        </div>
                        <div class="col-md-6 bold ">
                            <span>Patient's Email(Optional)</span>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter Here">
                        </div>
                    </div>
                    <div class="row  pb-4">
                        <div class="col-md-6 bold ">
                            <span>Patient's Phone No(Optional)</span>
                            <input type=""  name="phone_no" id="phone_no"class="form-control" placeholder="Enter Here">
                        </div>
                        <div class="col-md-6 bold ">
                            <span>Patient's DOB(Optional)</span>
                            <input type="" name="dob" id="dob" class="form-control" placeholder="Enter Here">
                        </div>
                    </div>
                    <div class="row  pb-4">
                        <div class="col-md-12 bold address">
                            <span>Address(Optional)</span>
                            <input type=""  name="address" id="address" class="form-control" placeholder="Type Here">
                        </div>

                    </div>
                </div>
                <div class="col-md-12 px-4 brdall my-3 py-4">
                    <div class="row  pb-4">
                        <div class="content col-md-12">
                            <!--mujtaba-->
                            <div class="accordion">
                                <div class="item1">
                                    <p class="number">01</p>
                                    <p class="text">Treatment Details</p>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="icon">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                    </svg>
                                    <div class="hidden-box">
                                        <div class="row  ">
                                            <div class="col-md-4 " style="margin-bottom: 1rem!important;">


                                                <label for="">Arch to treat*</label>
                                                <div class="btn-group mt-3">
                                                    <input type="checkbox" id="arch_to_treat" value="1" name="arch_to_treat" data-toggle="toggle" data-onstyle="outline-primary" data-offstyle="outline-secondary" data-style="ios" >
                                                </div>
                                            </div>

                                            <div class="col-md-4 " style="margin-bottom: 1rem!important;">

                                                <label for="">A-P Relation*</label>
                                                <div class="btn-group mt-3">
                                                <input type="checkbox" id="a_p_relationship" name="a_p_relationship" data-toggle="toggle" data-onstyle="outline-primary" data-offstyle="outline-secondary" data-style="ios">
                                                </div>

                                            </div>

                                            <div class="col-md-4 " style="margin-bottom: 1rem!important;">
                                                <label for="">Overjet*</label>

                                                <div class="btn-group mt-3">
                                                <input type="checkbox"  id="overjet" name="overjet" data-toggle="toggle" data-onstyle="outline-primary" data-offstyle="outline-secondary" data-style="ios">


                                                </div>

                                            </div>
                                            <div class="col-md-4 " style="margin-bottom: 1rem!important;">
                                                <label for="">Overbite*</label>

                                                <div class="btn-group mt-3">
                                                <input type="checkbox" id="overbite" name="overbite" data-toggle="toggle" data-onstyle="outline-primary" data-offstyle="outline-secondary" data-style="ios" >


                                                </div>

                                            </div>
                                            <div class="col-md-4 " style="margin-bottom: 1rem!important;">
                                                <label for="">MidLine*</label>

                                                <div class="btn-group mt-3">
                                                <input type="checkbox" id="midline" name="midline" data-toggle="toggle" data-onstyle="outline-primary" data-offstyle="outline-secondary" data-style="ios" >


                                                </div>

                                            </div>
                                        </div>
                                        <div class="row  ">
                                            <div class="col-md-12 " style="margin-top: 2rem!important;margin-bottom: 2rem!important;">
                                                <p style="line-height: 0px;">Clinic Comment*</p>
                                                <textarea class="form-control" placeholder="Type Here..." style="height:80px!important;" type="text" id="clinical_comment" name="clinical_comment" required
                                                                   data-validation-required-message="Clinical Comment is required"></textarea>
                                                <p style="line-height: px;" class="mt-2">Prescription Comment*</p>
                                                <textarea id="prescription_comment" name="prescription_comment" class="form-control" placeholder="Type Here..." style="height:80px!important;" name="prescription_comment"  name="prescription_comment" required
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
                                    <p class="number">02</p>
                                    <p class="text">Clinical Condition</p>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="icon">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                    </svg>
                                    <div class="hidden-box">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-4">
                                                @php($a=1)
                                                @foreach ($ClinicalConditions as $ClinicalCondition)
                                                @if($a==5 || $a==9)
                                                </div>
                                                <div class="col-md-4">
                                                @endif
                                                <input type="checkbox" class="" name="clinical_conditions[]" id="conidion{{$a}}" value="{{$ClinicalCondition->id}}"/>
                                                <span style="font-size: 13px;">{{$ClinicalCondition->name}} </span><br>
                                                @php($a++)
                                                @endforeach
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="item1">
                                    <p class="number">03</p>
                                    <p class="text">Image Attachments </p>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="icon">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                    </svg>
                                    <div class="hidden-box">
                                        <div class="card-body">
                                            <?php $i=1; ?>
                                            <div class="col-md-12 p-0 px-2    pb-3">
                                         @php($img_col = isset($attachments['IMAGE']) ? collect($attachments['IMAGE'])->firstWhere('sort_order', $i) : null)
                                            @php($media = !empty($img_col) ? $img_col['full_path']  : asset('link/files/app-assets/images/case/images/Base'.$i.'.png'))
                                                <div class="row py-2 m-1 attachImg" style="border: 1px dashed black;border-radius: 5px;">

                                                    <div class="col-md-2 p-0 ">
                                                        <img src="{{asset('vendors/images/drag.png')}}" width="40" class="mx-2 mt-3">
                                                    </div>
                                                    <div class="col-md-8 p-0">

                                                        <h5 style="font-size: 15px;" class="mt-2"> Select a file to upload</h5>
                                                        <span style="font-size: 11px;">JPG, PNG or PDF, file size no more than 10MB</span>
                                                    </div>
                                                    <div class="col-md-2 mt-2 p-0 pt-2">
                                                        <!-- <a class="textcolor attachImg"  style="font-size: 15px;color:#00205C;text-decoration: underline; cursor:pointer;"> Browse</a> -->
                                                        <!-- <input type="file" id="picture" name="picture" class="fileInput" accept="image/*" value="" hidden> -->
                                                            <label class="btn">
                                                                <input type="file" id="image_attach" name="IMAGE_[]" class="hidden upload-attachment {{'IMAGE_'.$i}}" data-type="IMAGE" data-sort="{{$i}}" onchange="preViewImage2(this)" multiple hidden>
                                                                <img src="{{$media}}" id="{{'IMAGE_'.$i}}" alt="Image" class="img-thumbnail">
                                                            </label>
                                                    </div>
                                                </div>
                                                <!-- <div class="row  pb-4">

                                                    <div class="col-md-12 mt-5 ">
                                                        <a class="btn bgcolor text-white casebtn float-right mx-2">Save</a>
                                                        <a class="btn bgcolorborder float-right" style="font-size:22px;" onclick="bndka();">Cancel</a>

                                                    </div>
                                                </div> -->
                                            </div>
                                        </div>
                                    </div>


                                </div>
                                </dv>
                                <div class="item1">
                                    <p class="number">04</p>
                                    <p class="text">X-Rays Attachments</p>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="icon">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                    </svg>
                                    <div class="hidden-box" style="margin-bottom: 20px;">
                                    @php($img_col = isset($attachments['X_RAY']) ? collect($attachments['X_RAY'])->firstWhere('sort_order', $i) : null)
                                    @php($media = !empty($img_col) ? $img_col['full_path']  : asset('link/files/app-assets/images/case/upload.png'))
                                    <div class="row py-2 m-1" style="border: 1px dashed black;border-radius: 5px;">

                                    <div class="col-md-2 p-0">
                                        <img src="{{asset('vendors/images/drag.png')}}" width="40" class="mx-2 mt-3">
                                    </div>
                                    <div class="col-md-8 p-0">

                                        <h5 style="font-size: 15px;" class="mt-2"> Select a file</h5>
                                        <span style="font-size: 11px;
                                    ">JPG, PNG or PDF, file size no more than 10MB</span>
                                    </div>
                                    <div class="col-md-2 mt-2 p-0 pt-2">
                                    <label class="btn">
                                        <input type="file" id="upload_attach" name="X_RAY_[]" class="hidden upload-attachment" data-type="X_RAY" data-sort="{{$i}}" onchange="preViewImage3(this)" multiple hidden>
                                        <img src="{{$media}}" id="{{'X_RAY_'.$i}}" alt="Image" class="img-thumbnail">
                                    </label>

                                    </div>
                                    </div>
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
                                    <p class="number">05</p>
                                    <p class="text">Jaw scan(Upper/Lower)</p>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="icon">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                    </svg>
                                    <div class="hidden-box">
                                        <div class="card-body">
                                            <div class="col-md-12 p-0 px-2  pb-3">
                                            @for ($i=1;$i<=2;$i++)
                                            @php($jaw_type = $i == 1 ? 'UPPER_JAW' : 'LOWER_JAW')
                                            @php($img_col = isset($attachments[$jaw_type]) ? collect($attachments[$jaw_type])->firstWhere('sort_order', $i) : null)
                                            @php($media = !empty($img_col) ? $img_col['full_path']  : asset('link/files/app-assets/images/case/jaw/Base'.$i.'.png'))
                                                <div class="row py-2 m-1" style="border: 1px dashed black;border-radius: 5px;">

                                                    <div class="col-md-2 p-0 ">
                                                        <img src="{{asset('vendors/images/drag.png')}}" width="40" class="mx-2 mt-3">
                                                    </div>
                                                    <div class="col-md-8 p-0">

                                                        <h5 style="font-size: 15px;" class="mt-2"> Select a file or drag and drop here</h5>
                                                        <span style="font-size: 11px;">JPG, PNG or PDF, file size no more than 10MB</span>
                                                    </div>
                                                    <div class="col-md-2 mt-2 p-0 pt-2">
                                                    <label class="btn">
                                                        <input type="file" id="jaw_{{$i}}" name="{{$jaw_type.'_'.$i}}" class="hidden upload-attachment" data-type="{{$jaw_type}}"    onchange="preViewJawImage(this)" data-sort="{{$i}}" hidden>
                                                        <img src="{{$media}}" id="{{$jaw_type.'_'.$i}}" alt="Image" class="img-thumbnail">
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
                                                                    <td><img src="{{asset('vendors/images/jaw.png')}}" width="20" id="imgShow{{$i}}"/></td>
                                                                    <td style="font-size: 10px;padding:0px;">Untitled</td>
                                                                    <td style="font-size: 10px;padding:0px;">Preview</td>
                                                                    <td style="font-size: 10px;padding:0px;">1.7MB</td>
                                                                    <td style="font-size: 10px;padding:0px;font-size: 10px;">
                                                                    <select style="font-size: 10px;padding:0px;font-size: 10px;" id="select{{$i}}" onchange="saveJawImage(this,'{{$i}}')" class="form-select form-control" >
                                                                            <option selected=""  style="font-size: 10px;">Select Jaw</option>
                                                                            <option  value="1" style="font-size: 10px;">Upper</option>
                                                                            <option  value="2" style="font-size: 10px;">Lower</option>
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
            <p class="number">06</p>
            <p class="text">Other files</p>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="icon">
        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
            </svg>
            <div class="hidden-box">
                <div class="card-body ">
                    <div class="col-md-12 linkdokna p-0 px-2  pb-3">
                        Attach URL
                        <input type="url" class="form-control" placeholder="Embedded URL" id="embedded_url" name="embedded_url">
                        <img src="{{asset('vendors/images/link.png')}}" width="20">
                    </div>
                    <div class="col-md-12 p-0 px-2 pb-3">
                        <div class="row">
                        <div class="col-md-12">
                            <span>Patient Consent form</span> <span class="float-right"></span>
                            <!-- Download Form <i class="bi bi-download"></i> -->
                        </div>
                        </div>
                        <div class="row py-2 m-1 dashedborder"   style="border: 1px dashed black;border-radius: 5px;">
                            <div class="col-md-2 p-0 ">
                                <img src="{{asset('vendors/images/drag.png')}}" width="40" class="mx-2 mt-3">
                            </div>
                            <div class="col-md-8 p-0">
                                <h5 style="font-size: 15px;" class="mt-2"> Select a file or drag and drop here</h5>
                                <span style="font-size: 11px;">JPG, PNG or PDF, file size no more than 10MB</span>
                            </div>
                            <div class="col-md-2 mt-2 p-0 pt-2">
                            <label class="btn">
                            <input type="file"  name="OTHER" class="hidden upload-attachment" data-type="OTHER" data-sort="1" hidden  onchange="preViewImage(this)">
                            <img src="{{asset('link/files/app-assets/images/case/upload.png')}}"
                            id="OTHER_1" alt="Image" class="img-thumbnail" style="width: 35px;"/>
                            </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mt-3">
                                <span>Other files</span>
                            </div>
                            </div>
                        <div class="row py-2 m-1" style="border: 1px dashed black;border-radius: 5px;">

                            <div class="col-md-2 p-0 ">
                                <img src="{{asset('vendors/images/drag.png')}}" width="40" class="mx-2 mt-3">
                            </div>
                            <div class="col-md-8 p-0">

                                <h5 style="font-size: 15px;" class="mt-2"> Select a file or drag and drop here</h5>
                                <span style="font-size: 11px;">JPG, PNG or PDF, file size no more than 10MB</span>
                            </div>
                            <div class="col-md-2 mt-2 p-0 pt-2">
                            <label class="btn">
                            <input type="file"  name="OTHER" class="upload-attachment" data-type="OTHER" data-sort="2" hidden  onchange="preViewImage(this)">
                            <img src="{{asset('link/files/app-assets/images/case/upload.png')}}" id="OTHER_2" alt="Image" class="img-thumbnail" style="width: 35px;">
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
                                <div class="main mb-5" style="width:100%;">
                                <button type="submit"class="btn bgcolor text-white casebtn float-right" id="btn_submit">Submit</button>
                        <a class="btn bgcolorborder mx-2 mb-5 float-right" style="font-size:22px;" onclick="bndka();">Cancel</a>

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
<script src="{{asset('vendors/js/script.js')}}"></script>
<script>
    const iconUpDown = document.querySelectorAll(".icon");
      iconUpDown.forEach(icon => {
         icon.addEventListener("click", e => {
             icon.classList.toggle("icon-rotate")
                 icon.parentElement.classList.toggle("open");
        })
    })
</script>
<script src="{{asset('vendors/js/popper.min.js')}}"></script>
<script src="{{asset('vendors/js/bootstrap.min.js')}}"></script>
<script src="{{asset('vendors/js/main.js')}}"></script>
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
<script defer src="https://static.cloudflareinsights.com/beacon.min.js/vaafb692b2aea4879b33c060e79fe94621666317369993" integrity="sha512-0ahDYl866UMhKuYcW078ScMalXqtFJggm7TmlUtp0UlD4eQk0Ixfnm5ykXKvGJNFjLMoortdseTfsRT8oCfgGA==" data-cf-beacon='{"rayId":"79e5541319b8de47","token":"cd0b4b3a733644fc843ef0b185f98241","version":"2023.2.0","si":100}' crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<!-- Prev code implementation -->
<script>

    var base_url = "{{url('doctor')}}";
    var case_id = '{{isset($edit_values->id) ? $edit_values->id : ""}}';
    var records = "{{$a}}";
        $('.date-picker').daterangepicker({
            singleDatePicker: !0,
            showDropdowns: !0
        });
        $('body').on('change', '.upload-attachment', function(){
            console.log('in');

            var sort = $(this).data('sort');
            var type = $(this).data('type');
            readURL(this, type, sort);

        });

         // url:'{{route("admin.case.destroy-attachment")}}',
</script>
<script src="{{asset('vendors/scripts/case_ajax.js')}} "></script>
<style>
.deleteform{
    top:-3px !important;
    height: auto !important;
}
    </style>
<script>
        $('#payment').removeClass('d-none');
</script>
<form role="form" action="{{ $form_action }}" method="post" class="stripe-payment card-form"
                                                data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
                                                        id="stripe-payment">
<div class="pop2 d-no ">
    <div class="row ">
        <div class="col-md-2">
        </div>

        <div class="col-md-8 bg-white popadd deleteform" style=" overflow:scroll;">
            <div class="page6box py-3 ">
            </div>
            <div class="row px-4 mb-5 ">
                <div class="col-md-12">
                    <div class="row borderbottom mb-4 ">
                        <div class="col-md-11 col  p-0 aresure  bold m-auto">
                            <h5 class="t text-dark ">
                                Payments
                                </h5>
                                <p class="mt-3">
                                    Please enter your card details or proceed with cash</p>
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
                    <div class="row " style="background-color: #f6f6f6;
                    border: 1px solid #d0d0d0;border-radius:8px;">

                        <div class="col-md-6 p-2 p-0 aresure  bold m-auto">

                                <p class="mt-3 d-inline">
                                  item:</p>
                                  <span style="font-weight:bold;font-size: 13px;">Digital Model/ Treatment Plan</span>
                        </div>
                        <div class="col-md-6 px-2 p-0 aresure  bold m-auto">
                            <h6 class="t text-dark ">

                                <p class="mt-3 d-inline float-right">
                                    Total Price: <span style="font-weight:bold;font-size: 15px;"> 1980 AED</span></p>
                        </div>


                    </div>
                    <div class="row mt-4 bordertop " >
                        <div class="col-md-12 p-2 p-0 aresure bold m-auto">
                            <h6 class="t text-dark mt-3">
                                Payment Details
                                </h6>
                                <p>Select Payment method</p>
                                <select class="form-select form-control">
                                    <option selected="">Stripe </option>
                                </select>
                        </div>
                    </div>
                    <div class="row mt-4 bordertop" >
                        <div class="col-md-12 p-2 p-0 aresure  bold m-auto">
                            <p class="t text-dark ">
                                Card Number
                                </p>
                                <div class="row" >
                                    <div class="col-md-3 col p-2 px-3">
                                    <div classs="payment">
                    <div class="cardwidth" style="width:35px;">
                        <input type="text" class="form-control" placeholder="-">
                    </div>
                    <div class="cardwidth" style="width:35px;">
                        <input type="text" class="form-control" placeholder="-">
                    </div>
                    <div class="cardwidth" style="width:35px;">
                        <input type="text" class="form-control" placeholder="-">
                    </div>
                    <div class="cardwidth" style="width:35px;">
                        <input type="text" class="form-control" placeholder="-">
                    </div>
                </div>
                     </div>
                                    <div class="col-md-3 col p-2 px-3">
                                    <div classs="payment">
                    <div class="cardwidth" style="width:35px;">
                        <input type="text" class="form-control" placeholder="-">
                    </div>
                    <div class="cardwidth" style="width:35px;">
                        <input type="text" class="form-control" placeholder="-">
                    </div>
                    <div class="cardwidth" style="width:35px;">
                        <input type="text" class="form-control" placeholder="-">
                    </div>
                    <div class="cardwidth" style="width:35px;">
                        <input type="text" class="form-control" placeholder="-">
                    </div>
                </div>
                     </div>
                                    <div class="col-md-3 col p-2 px-3">
                                    <div classs="payment">
                    <div class="cardwidth" style="width:35px;">
                        <input type="text" class="form-control" placeholder="-">
                    </div>
                    <div class="cardwidth" style="width:35px;">
                        <input type="text" class="form-control" placeholder="-">
                    </div>
                    <div class="cardwidth" style="width:35px;">
                        <input type="text" class="form-control" placeholder="-">
                    </div>
                    <div class="cardwidth" style="width:35px;">
                        <input type="text" class="form-control" placeholder="-">
                    </div>
                </div>
                     </div>
                                    <div class="col-md-3 col p-2 px-3">
                                    <div classs="payment">
                    <div class="cardwidth" style="width:35px;">
                        <input type="text" class="form-control" placeholder="-">
                    </div>
                    <div class="cardwidth" style="width:35px;">
                        <input type="text" class="form-control" placeholder="-">
                    </div>
                    <div class="cardwidth" style="width:35px;">
                        <input type="text" class="form-control" placeholder="-">
                    </div>
                    <div class="cardwidth" style="width:35px;">
                        <input type="text" class="form-control" placeholder="-">
                    </div>
                </div>
                     </div>
                                        </div>
                        </div>
                    </div>
                    <div class="row   " >
                        <div class="col-md-6 p-2 p-0 aresure   bold m-auto">
                            <h6 class="t text-dark mt-3">
                                MM/YY
                                </h6>
                             <input type="" placeholder="MM/YY" class="form-control">
                        </div>
                        <div class="col-md-6 p-2 p-0 aresure   bold m-auto">
                            <h6 class="t text-dark mt-3">
                                CSV
                                </h6>
                             <input type="" placeholder="CSV" class="form-control">
                        </div>
                    </div>
                </div>


                <div class="col-md-12 delebtn">
                    <button type="submit" class="btn  text-white bgcolor float-right ">Pay Now</button>
                    <a class="btn cancelbtn  text-white  float-right" onclick="bndka1();">Cancel</a>

                </div>
            </div>
        </div>
    </div>

</div>
</form>

