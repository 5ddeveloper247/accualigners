<style>
    body {
        display: none;
    }

    #advice_comment_button {
        right: 6px
    }

    .digital_scan {
        transition: all 1s ease-in-out;
    }

    .digital_scan:hover {
        background: #cdcfd2;
        color: white !important;
        cursor: pointer;
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

    .payment {
        display: flex !important;
    }

    .deleteform {
        top: 25px !important;
    }

</style>
@php
$title = 'Case Details';
@endphp
@extends('originator.root.dashboard_side_bar',['title' => $title])
@section('title', "Doctor")
@php
$viewRoute = route('admin.case.index');
$setting = setting_h();
$default_currency = $setting->currency;
@endphp
<style>
    * {
        /* outline:1px solid red; */
    }

    * {
        margin: 0px !important;
    }

    .item {
        position: absolute;
        top: 15px;
        width: 250px;
        right: -20px;
    }

    .fun2 {
        width: 20%;
    }

    .addlinkdo a {
        font-size: 9px !important;


    }

    .addlinkdo span {
        font-size: 9px !important;

    }

    .cheating {
        /* height: 450px; */
        overflow: scroll;
    }

    .attachement {
        height: 65%;
        width: 100%;
        border-radius: 10px;
    }

    .bi-dash-lg::before {
        font-size: 32px;
        border: 2px solid red;
        border-radius: 5px;
        margin: 5px;


    }

    .header-right .bi-plus::before {
        font-size: 32px;
        border: 2px solid #00205C;
        border-radius: 5px;
        margin: 5px;
    }

    @media (max-width: 500px) {
        #advice_comment_button {
            right: unset
        }

        .fun2 {
            width: 100%;
        }

        .ViewDetails a {
            margin-top: 2rem !important;
        }

        .boxdozama2 h5 {
            font-size: 13px;
        }

        .boxdozama2 {
            text-align: center;
            margin-top: 3px !important;
        }

        .dall {
            position: relative;
            /* top: 76px; */
            right: 39px;
        }

        .addlinkdo a {
            font-size: 10px;
        }

        .dall a {
            position: absolute;
            left: 150px;
        }

        .dall img {
            visibility: hidden;

        }

        .addlinkdo span {
            font-size: 10px !important;

        }

        .fullheight {
            height: 300px;
        }

        .popadd {
            height: 1200px !important;
            background-color: white !important;
        }
    }


    .ViewDetails a:hover {
        background: white;
        color: #00205C !important;
    }

    .tabledozama th {
        line-height: 19px !important;
    }

    .tabledozama td {
        white-space: nowrap !important;
    }

</style>


<div class="mobile-menu-overlay"></div>
<!-- saadullah -->
<div class="main-container">
    <div class="m-3 ">
        <div class="row">
            <div class="col-xl-12 yellowcolor py-3">
                <div class="row ">
                    <div class="col-xl-9 mt-2 ">
                        <div class="orderactive">
                            <h6 class="py-3 d-inline text-white">Order Status</h6>
                            @if(isset($order))
                            <a class="mt-2 px-3 py-2">{{ $order->status }}</a>
                            @endif
                        </div>
                    </div>
                    <div class="col-xl-3 mt-2 ">
                        <div class=" ViewDetails">
                            <a class="text-white cursor float-right mx-3 py-2 px-3" @if(!(isset($order))) disabled @endif @if(isset($order))onclick="view('{{ $order->id }}') @endif">View Details</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 py-2  mx-1">
                <div class="row mt-3">
                    <h4> Overview</h4>
                    <div class="col-xl-8 orderactive">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="fun2   p-0">
                <div class="c1data p-3 m-2" style="height: 113px;">
                    <h5 class="mt-3"> Case Number</h5>
                    <p style="color: #4B5563;" class="mt-2">{{ $edit_values->id }}</p>
                </div>
            </div>
            <div class="fun2  p-0">
                <div class="c1data p-3 m-2" style="height: 113px;">
                    <h5 class="mt-3"> Case Date</h5>
                    <p style="color: #4B5563;" class="mt-2">{{date('d-M-Y', $edit_values->created_date)}}</p>
                </div>
            </div>
            <div class="fun2 p-0">
                <div class="c1data p-3 m-2" style="height: 113px;">
                    <h5 class="mt-3"> Case Time</h5>
                    @php
                    $ip = request()->ip();
                    $api_key = "4eb0722e7f464951aef4c772283952fb"; // replace with your actual API key
                    $api_url = "https://api.ipgeolocation.io/timezone?apiKey={$api_key}&ip={$ip}";
                    $api_response = json_decode(file_get_contents($api_url), true);
                    $user_timezone = new DateTimeZone($api_response['timezone']);

                    $created_at = new DateTime($edit_values->created_at, new DateTimeZone('UTC'));
                    $created_at->setTimezone($user_timezone);
                    @endphp


                    <p style="color: #4B5563;" class="mt-2">{{ $created_at->format('H:i A') }}</p>
                </div>
            </div>

            <div class="fun2  p-0">
                <div class="c1data p-3 m-2" style="height: 113px;">
                    <h5 class="mt-3">Patient Name</h5>
                    <p style="color: #4B5563;" class="mt-2">{{ ucwords($edit_values->name) }}</p>
                </div>
            </div>
            <div class="fun2  p-0">
                <div class="c1data p-3 m-2" style="height: 113px;overflow-wrap: break-word;">
                    <h5 class="mt-3">Patient Email</h5>

                    <p style="color: #4B5563;" class="mt-2">{{ ucfirst($edit_values->email) }}</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 py-2 mx-1">
                <div class="row mt-3 ">
                    <h4> Payment detials</h4>
                    <div class="col-xl-8 orderactive">

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 c1data  p-0 {{($edit_values->pay_digital_scan)?'':'digital_scan'}}" onclick="{{($edit_values->pay_digital_scan)?'':'payDigitalScan()'}}">
                <div class="row">
                    <div class="col-md-8">
                        <div class="boxdozama2 py-3 px-3 m-2 ">
                            <h5 class="my-2 d-inline"> Digital model charges</h5>
                            @if ($edit_values->digital_scan_fee)
                            <a class="painbtn mx-3">Paid</a>
                            @else
                            <a class="inprogressbtn mx-3">{{($edit_values->pay_digital_scan)?'Requested':'Pending'}}</a>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="boxdozama2 mt-3 text-right">
                            @if ($edit_values->digital_scan_fee && !empty($edit_values->aligner))
                                <p style="font-size:13px;color:grey;" class="d-inline">{{date('h:i a',
                                                                strtotime($edit_values->aligner->created_at))}} | {{date('d M Y',
                                                                strtotime($edit_values->aligner->created_at))}}
                                    <span style="color:black;font-weight:bold;font-size:20px;">{{$edit_values->processing_fee_amount}}</span> {{strtoupper($default_currency)}}
                                </p>
                            @else
                                <p style="font-size:13px;color:grey;" class="d-inline">
                                    <span style="color:black;font-weight:bold;font-size:20px;">{{$edit_values->processing_fee_amount}}</span> {{strtoupper($default_currency)}}
                                </p>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3 m-0">
            <div class="col-md-12  bordertop borderbottom   p-0">
                <div class="row ">
                    <div class="col-md-8 ">
                        <div class="row m-0 messagedobs">
                            <div class="col-md-12 borderbottom cheating">
                                <div class="recuitment my-3">
                                    <img src="{{ asset('vendors/images/logo.png') }}" width="40">
                                    <span style="font-size: 18px;font-weight:bold;">Chat with the Dentist</span>
                                    @if($edit_values->has_concern)
                                    <div style="border: 2px solid red;padding: 6px;float:right;color: red;" class="badge badge-pill badge-border badge-glow border-danger danger badge-square">
                                        Doctor has concern
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div id="append" style="height:580px;overflow-y:scroll;overflow-x:hidden;width:100%;"></div>

                            <!-- @isset($edit_values->concerns)
                            @foreach ($edit_values->concerns as $concern)
                                @if( $concern->message_by == 'ADVISER')
                                    <div class="col-md-12">
                                        <div class="row mt-3">
                                            <div class="col-md-2 p-0 ">
                                            </div>
                                            <div class="col-md-9 p-0 myapp ">
                                                <div class=" text-white mx-2 p-3">
                                                    <p>
{!! ucwords($concern->message) !!}
                                        </p>
                                        <span style="font-size: 13px;color: #afafaf;">
<?php
                                    $timestamp = strtotime($concern->created_at);
                                    $date = new DateTime("@$timestamp");
                                    $date->setTimeZone($user_timezone);
                                    $time = $date->format("h:i A");
                                    ?>
                                    {{ $time }}
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-1 p-0 ">
                                    <div class="proimgda mx-2">
                                        <img src="{{ asset('vendors/images/logo.png') }}">
                        </div>
                    </div>
                </div>
            </div>
        @else
                                    <div class="col-md-12">
                                        <div class="row mt-3 m-0">
                                            <div class="col-md-1 p-0 ">
                                                <div class="proimgda mx-2">
                                                    <img src="{{ asset('vendors/images/logo.png') }}">
                        </div>
                    </div>
                    <div class="col-md-9 p-0 ">
                        <div class="textdo mx-2 p-3">
                            <p>
                                {!! ucwords($concern->message) !!}
                                        </p>
                                        <span style="font-size: 13px;">
<?php
                                    $timestamp = strtotime($concern->created_at);
                                    $date = new DateTime("@$timestamp");
                                    $date->setTimeZone($user_timezone);
                                    $time = $date->format("h:i A");
                                    ?>
                                    {{ $time }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
@endif
                            @endforeach
                        @endisset -->
                        </div>
                        <div class="row">
                            <!-- classfixka -->
                            <div class="col-md-12 classSentMessage">
                                <div class="row mt-3 typehere m-2">
                                    <div class="col-md-12 dall  dalldo" style="margin-bottom: 9px !important;">
                                        <input type="" class="form-control" name="advice_comment" id="advice_comment" placeholder="Type Something...">
                                        <div class="item">
                                            <!-- <img src="{{ asset('vendors/images/i1.png') }}">
                                                <img src="{{ asset('vendors/images/i2.png') }}">
                                                <img src="{{ asset('vendors/images/i3.png') }}">
                                                <img src="{{ asset('vendors/images/Emoji-smile.png') }}"> -->
                                            <a class="bgcolor text-white py-2 px-4 mt-5 mx-5" style="cursor:pointer;bottom: -28px ! important;" id="advice_comment_button">Send</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- </div> -->
                    </div>

                    <div class="col-md-4 borderleft ">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="addlinkdo mt-3">
                                    <h5 class="d-inline">Upload Video</h5>
                                    <a class="px-3" style="padding:2% 2%; cursor:pointer;" data-toggle="modal" data-target="#video_modal">Add Link</a>
                                    <span style="background:#00205C;padding:2% 2%;border-radius: 20px;color:white;cursor:pointer;" data-toggle="modal" data-target="#video_modal2">Add Video</span>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="row mt-4"> -->

                        <div class="row mt-4 m-0">
                            <!-- <div class="col-md-12 p-0 px-2  fullheight borderbottom pb-3">
                                <div class="row py-2 m-1 dashedborder" >
                                     <div class="col-md-2 p-0 ">
                                        <img src="images/drag.png" width="40" class="mx-2 mt-3">
                                     </div>
                                     <div class="col-md-8 p-0">
                                        <h5 style="font-size: 13px;" class="mt-2"> Select a file or drag and drop here</h5>
                                        <span style="font-size: 11px;">JPG, PNG or PDF, file size no more than 10MB</span>
                                     </div>
                                     <div class="col-md-2 mt-2 p-0 pt-2">
                                        <a style="font-size: 9px;color:#00205C;text-decoration: underline;"> Browse</a>
                                     </div>
                                </div>
                            </div> -->
                            @if(!empty($edit_values->video_uploaded))
                            <div class="col-12 videoPlayer video_uploaded">
                                @if ($edit_values->video_uploaded_type == 'VIDEO')
                                <video id="vid0" src="{{storageUrl_h($edit_values->video_uploaded)}}" controls="controls" crossorigin="anonymous" class="vid" style="width:100%;" playsinline autoplay muted loop></video>
                                @else
                                <img src="{{storageUrl_h($edit_values->video_uploaded)}}" class="img-fluid">
                                @endif
                            </div>
                            <style>
                                .btn-primary {
                                    background-color: #00205C !important;
                                    border-color: #00205C !important;
                                }

                                .btn-primary:hover {
                                    background-color: #0a3078 !important;
                                    border-color: #0a3078 !important;
                                }

                                .bgcolor:hover {
                                    background-color: #0a3078 !important;
                                    border-color: #0a3078 !important;
                                }

                            </style>
                            <div class="col-12 video_uploaded">
                                <button type="button" class="btn btn-block btn-primary" id="delete_video" style="margin-top: 2px !important;width: 100%; text-align:center;"><i class="ft-trash"></i> Remove
                                </button>
                            </div>
                            @endif
                        </div>
                        <!--<div class="row mt-4 ">
                            <div class="col-md-12 p-0 px-2 borderbottom pb-3">
                                <h5 class="px-2 pb-2"> Upload Treatment Plan PDF</h5>
                                <div class="row py-2 m-1 dashedborder" >
                                    <div class="col-md-2 p-0 ">
                                        <img src="images/drag.png" width="40" class="mx-2 mt-3">
                                    </div>
                                    <div class="col-md-8 p-0">
                                        <h5 style="font-size: 13px;" class="mt-2"> Select a file or drag and drop here</h5>
                                        <span style="font-size: 11px;">JPG, PNG or PDF, file size no more than 10MB</span>
                                    </div>
                                    <div class="col-md-2 mt-2 p-0 pt-2">
                                    <input type="file"><a style="font-size: 9px;color:#00205C;text-decoration: underline;"> Browse</a>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <!-- <div class="row py-2 m-1 attachImg" style="border: 1px dashed black;border-radius: 5px;"> -->
                        <div class="row mt-4 ">
                            <div class="col-md-12  p-0 px-2  pb-3">
                                <h5 class="px-2 pb-2">Upload Treatment Plan PDF</h5>
                            </div>

                            <div class="col-md-2 p-0 ">
                                <img src="{{asset('vendors/images/drag.png')}}" width="40" class="mx-2 mt-4">
                            </div>
                            <div class="col-md-8 p-3">
                                <form id="upload-attachment-form">

                                    <h5 style="font-size: 15px" class="mt-2"> Select a file to upload</h5>
                                    <span style="font-size: 11px;">JPG, PNG or PDF, file size no more than 10MB</span>
                            </div>
                            <div class="col-md-2 mt-2 p-0 pt-2">
                                <!-- <a class="textcolor attachImg"  style="font-size: 15px;color:#00205C;text-decoration: underline; cursor:pointer;"> Browse</a> -->
                                <!-- <input type="file" id="picture" name="picture" class="fileInput" accept="image/*" value="" hidden> -->
                                <label class="btn">
                                    <input type="file" multiple name="attachment[]" class="hidden upload-attachment" data-type="TREATMENT-PLAN-PDF" data-sort="1" onchange="preViewImage(this)" hidden>
                                    <img src="{{asset('link/files/app-assets/images/case/upload.png')}}" id="IMAGE_1" alt="Image" class="img-thumbnail" style="max-width:250% !important;float:right;">
                                </label>
                            </div>
                            </form>
                        </div>
                        <div class="row mt-4 ">

                            <div class="col-md-12   p-0 px-2  pb-3">
                                <h5 class="px-2 pb-2">Treatment Instructions</h5>
                            </div>

                            <div class="col-md-12   p-0 px-3  pb-3">
                                <label> Number of trays required*</label>
                                <input type="number" min="1" class="form-control" value="{{ old('no_of_trays', isset($edit_values) ? $edit_values->no_of_trays + $edit_values->no_of_missing_trays  : NULL) }}" placeholder="Enter Here" name="no_of_trays" id="no_of_trays">
                            </div>
                            <div class="col-md-12   p-0 px-3  pb-3">
                                <label> Number of hours to wear in a day</label>
                                <input type="number" min="1" max="24" class="form-control" placeholder="Enter Here" name="no_of_days" id="no_of_days" value="{{ old('no_of_days', isset($edit_values) ? $edit_values->no_of_days : NULL) }}">

                            </div>
                            <div class="col-md-12  py-3">
                                @if(isset($edit_values->aligner->status) && strtoupper($edit_values->aligner->status) != "PENDING")
                                <button class="bgcolor float-right px-3 py-2 text-white" id="missing_trays"> Update
                                </button>
                                @else
                                <button class="bgcolor float-right px-3 py-2 text-white" id="no_of_days_button"> Submit
                                </button>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3 m-0">
            <div class="col-md-12">
                <h5>Case Requirements</h5>
            </div>

            <div class="col-md-12 ">
                <div class="row borderbottom pb-4">
                    <div class="col-md-2 p-0 controlabel">
                        <div class="c1data px-3 py-3 m-2">
                            <p style="color: #4B5563;font-size:12px;" class="mt-2 m-0"> Arch to treat</p>
                            <h5 class="pt-2" style="color: black;font-size:12px;">{{$edit_values->arch_to_treat}}</h5>

                        </div>
                    </div>

                    <div class="col-md-2 p-0">
                        <div class="c1data px-3 py-3 m-2">
                            <p style="color: #4B5563;font-size:12px;" class="mt-2 m-0"> A-P Relation</p>
                            <h5 class="pt-2" style="color: black;font-size:12px;">{{$edit_values->a_p_relationship}}</h5>

                        </div>
                    </div>

                    <div class="col-md-2 p-0">
                        <div class="c1data px-3 py-3 m-2">
                            <p style="color: #4B5563;font-size:12px;" class="mt-2 m-0">Overjet</p>
                            <h5 class="pt-2" style="color: black;font-size:12px;">{{$edit_values->overjet}}</h5>
                        </div>
                    </div>

                    <div class="col-md-2 p-0">
                        <div class="c1data px-3 py-3 m-2">
                            <p style="color: #4B5563;font-size:12px;" class="mt-2 m-0"> Overbite</p>
                            <h5 class="pt-2" style="color: black;font-size:12px;">{{$edit_values->overbite}}</h5>

                        </div>
                    </div>

                    <div class="col-md-2 p-0">
                        <div class="c1data px-3 py-3 m-2">
                            <p style="color: #4B5563;font-size:12px;" class="mt-2 m-0"> MidLine</p>
                            <h5 class="pt-2" style="color: black;font-size:12px;">{{$edit_values->midline}}</h5>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12 pt-3">
                <div class="row borderbottom">
                    <div class="col-md-10">
                        <h5 class="mt-2">Clinic Comment
                        </h5>
                        <p style="color:#1f1e1e;">{!! ucfirst($edit_values->clinical_comment) !!}</p>
                    </div>
                </div>

                <div class="row borderbottom">
                    <div class="col-md-10 my-4">
                        <h5 class="mt-2">Prescription Commnet
                        </h5>
                        <p style="color:#1f1e1e;">{!! ucfirst($edit_values->prescription_comment) !!}</p>
                    </div>
                </div>

                <div class="row borderbottom pt-3 ">
                    <div class="col-md-10">
                        <h5 class="mt-2">Additional Comment
                        </h5>
                        <p style="color:#1f1e1e;">{!! ucfirst($edit_values->comment) !!} </p>
                    </div>
                </div>
            </div>

            <div class="col-md-12 ">
                <div class="row py-3 border borderround m-2">
                    <div class="col-md-12 crowding">
                        <h5>Clinical Condition</h5>
                        @isset($edit_values->clinical_conditions)
                        @foreach ($edit_values->clinical_conditions as $clinical_condition)
                        <button class="mt-3"> {{ucwords($clinical_condition->clinical_condition->name)}}</button>
                        @endforeach
                        @endisset
                        <!-- <button class="mt-3"> Misshapen Teeth</button>
                            <button class="mt-3"> CrowFlared Teethding</button>
                            <button class="mt-3">Spacing</button>
                            <button class="mt-3">Open Bite</button>
                            <button class="mt-3">Uneven Smile</button> -->
                    </div>
                </div>
            </div>
            @php
            $attachmentGroups = collect($edit_values->attachments)->groupBy('attachment_type');
            //dd($attachmentGroups['IMAGE']);
            @endphp
            <div class="col-md-12 ">
                <div class="row py-3 border borderround m-2">
                    <div class="col-md-12 crowding">
                        <h5>Image Attachments</h5>

                    </div>
                    <div class="col-md-12 ">

                        <div class="row">
                            @isset($attachmentGroups['IMAGE'])
                            @foreach ($attachmentGroups['IMAGE'] as $attachment)
                            @php($image = storageUrl_h($attachment->path.$attachment->name))
                            @if(strpos($image, 'pdf') !== false)
                            <div class="col-md-3 text-center attachement my-3">
                                <img src="{{storageUrl_h($attachment->path.'pdf.jpg')}}">
                                <a href="{{$image}}" target="_blank" download="{{ $image }}">Download <img src="{{ asset('vendors/images/download.png') }}" width="15" class="mx-2"></a>
                            </div>
                            @elseif((strpos($image, 'stl') !== false))
                            <div class="col-md-3 text-center my-3 ">
                                <img src="{{storageUrl_h($attachment->path.'stl.jpg')}}">
                                <a href="{{$image}}" target="_blank" download="{{ $image }}">Download <img src="{{ asset('vendors/images/download.png') }}" width="15" class="mx-2"></a>
                            </div>
                            @else
                            <div class="col-md-3 text-center  my-3">
                                <img src="{{$image}}">
                                <a href="{{ $image }}" target="_blank" download="{{ $image }}">Download <img src="{{ asset('vendors/images/download.png') }}" width="15" class="mx-2"></a>
                            </div>
                            @endif
                            @endforeach
                            @endisset
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 ">
                <div class="row py-3 border borderround m-2">
                    <div class="col-md-12 crowding">
                        <h5>X-Rays Attachments</h5>

                    </div>
                    <div class="col-md-12 ">
                        <div class="row">

                            @isset($attachmentGroups['X_RAY'])
                            @foreach ($attachmentGroups['X_RAY'] as $attachment)
                            @php($image = storageUrl_h($attachment->path.$attachment->name))
                            @if(strpos($image, 'pdf') !== false)
                            <div class="col-md-3 text-center my-3 ">
                                <img src="{{storageUrl_h($attachment->path.'pdf.jpg')}}" class="attachement">
                                <a href="{{$image}}" target="_blank" download="{{ $image }}">Download <img src="{{ asset('vendors/images/download.png') }}" width="15" class="mx-2"></a>
                            </div>
                            @elseif((strpos($image, 'stl') !== false))
                            <div class="col-md-3 text-center my-3 ">
                                <img src="{{storageUrl_h($attachment->path.'stl.jpg')}}" class="attachement">
                                <a href="{{$image}}" target="_blank" download="{{ $image }}">Download <img src="{{ asset('vendors/images/download.png') }}" width="15" class="mx-2"></a>
                            </div>
                            @else
                            <div class="col-md-3 text-center my-3 ">
                                <img src="{{ $image }}" class="attachement">
                                <a href="{{$image}}" target="_blank" download="{{ $image }}">Download <img src="{{ asset('vendors/images/download.png') }}" width="15" class="mx-2"></a>
                            </div>
                            @endif
                            @endforeach
                            @endisset
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 ">
                <div class="row py-3 border borderround m-2">
                    <div class="col-md-12 crowding">
                        <h5>Jaw scan (Upper / lower)</h5>
                    </div>

                    <div class="col-md-12 ">
                        <div class="row">
                            @isset($attachmentGroups['UPPER_JAW'])
                            @foreach ($attachmentGroups['UPPER_JAW'] as $attachment)
                            @php($image = storageUrl_h($attachment->path.$attachment->name))
                            @if(strpos($image, 'pdf') !== false)
                            <div class="col-md-3 text-center my-3">
                                <img src="{{storageUrl_h($attachment->path.'pdf.jpg')}}">
                                <a href="{{$image}}" target="_blank" download="{{ $image }}">{{$attachment->attachment_type}} <img src="{{ asset('vendors/images/download.png') }}" width="15" class="mx-2"></a>
                            </div>
                            @elseif((strpos($image, 'stl') !== false))
                            <div class="col-md-3 text-center my-3">
                                <img src="{{storageUrl_h($attachment->path.'stl.jpg')}}">
                                <a href="{{ $image}}" target="_blank" download="{{ $image }}">{{$attachment->attachment_type}} <img src="{{ asset('vendors/images/download.png') }}" width="15" class="mx-2"></a>
                            </div>
                            @else
                            <div class="col-md-3 text-center my-3">
                                <img src="{{$image}}">
                                <a href="{{ $image}}" target="_blank" download="{{ $image }}">{{$attachment->attachment_type}} <img src="{{ asset('vendors/images/download.png') }}" width="15" class="mx-2"></a>
                            </div>
                            @endif
                            @endforeach
                            @endisset

                            @isset($attachmentGroups['LOWER_JAW'])
                            @foreach ($attachmentGroups['LOWER_JAW'] as $attachment)
                            @php($image = storageUrl_h($attachment->path.$attachment->name))
                            @if(strpos($image, 'pdf') !== false)
                            <div class="col-md-3 text-center my-3">
                                <img src="{{storageUrl_h($attachment->path.'pdf.jpg')}}">
                                <a href="{{$image}}" target="_blank" download="{{ $image }}">{{$attachment->attachment_type}} <img src="{{ asset('vendors/images/download.png') }}" width="15" class="mx-2"></a>
                            </div>
                            @elseif((strpos($image, 'stl') !== false))
                            <div class="col-md-3 text-center my-3">
                                <img src="{{storageUrl_h($attachment->path.'stl.jpg')}}">
                                <a href="{{ $image}}" target="_blank" download="{{ $image }}">{{$attachment->attachment_type}} <img src="{{ asset('vendors/images/download.png') }}" width="15" class="mx-2"></a>
                            </div>
                            @else
                            <div class="col-md-3 text-center my-3">
                                <img src="{{$image}}">
                                <a href="{{ $image}}" target="_blank" download="{{ $image }}">{{$attachment->attachment_type}} <img src="{{ asset('vendors/images/download.png') }}" width="15" class="mx-2"></a>
                            </div>
                            @endif
                            @endforeach
                            @endisset

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 ">
                <div class="row py-3 border borderround m-2">
                    @isset($edit_values->embedded_url)
                    <div class="col-md-12 crowding borderbottom pb-3">
                        <h5>Attach URL</h5>
                        <a style="text-decoration: underline;" href="{{ $edit_values->embedded_url }}">{{ $edit_values->embedded_url }}</a>
                    </div>
                    @endisset
                    <div class="col-md-12 mt-3">
                        <h5>Patient Consent form</h5>
                        <div class="row">
                            @isset($attachmentGroups['PATIENT_FORM'])
                            @foreach ($attachmentGroups['PATIENT_FORM'] as $attachment)
                            @php($image = storageUrl_h($attachment->path.$attachment->name))

                            @if(strpos($image, 'pdf') !== false)
                            <div class="col-md-3 text-center my-3">
                                <img src="{{storageUrl_h('images/file.png')}}">
                                <a href="{{$image}}" target="_blank" download="{{$image}}">Download <img src="{{ asset('vendors/images/download.png') }}" width="15" class="mx-2"></a>
                            </div>
                            @elseif((strpos($image, 'stl') !== false))
                            <div class="col-md-3 text-center my-3">
                                <img src="{{storageUrl_h($attachment->path.'pdf.jpg')}}">
                                <a href="{{$image}}" target="_blank" download="{{$image}}">Download <img src="{{ asset('vendors/images/download.png') }}" width="15" class="mx-2"></a>

                            </div>
                            @else
                            <div class="col-md-3 text-center my-3">
                                <img src="{{$image}}">
                                <a href="{{$image}}" target="_blank" download="{{$image}}">Download <img src="{{ asset('vendors/images/download.png') }}" width="15" class="mx-2"></a>

                            </div>
                            @endif

                            @endforeach
                            @endisset
                        </div>
                    </div>
                    <div class="col-md-12 bordertop pt-3 mt-3">
                        <h5>Other files</h5>

                        <div class="row">
                            @isset($attachmentGroups['OTHER'])
                            @foreach ($attachmentGroups['OTHER'] as $attachment)
                            @php($image = storageUrl_h($attachment->path.$attachment->name))


                            @if(strpos($image, 'pdf') !== false)
                            <div class="col-md-3 text-center my-3">
                                <img src="{{storageUrl_h('images/file.png')}}">
                                <a href="{{ $image }}" target="_blank" download="{{ $image }}">Download
                                    <img src="{{ asset('vendors/images/download.png') }}" width="15" class="mx-2"></a>

                            </div>
                            @elseif((strpos($image, 'stl') !== false))

                            <div class="col-md-3 text-center my-3">
                                <img src="{{storageUrl_h($attachment->path.'stl.jpg')}}">
                                <a href="{{ $image }}" target="_blank" download="{{ $image }}">Download
                                    <img src="{{ asset('vendors/images/download.png') }}" width="15" class="mx-2"></a>

                            </div>
                            @else
                            <div class="col-md-3 text-center my-3">
                                <img src="{{ $image }}">
                                <a href="{{ $image }}" target="_blank" download="{{ $image }}">Download
                                    <img src="{{ asset('vendors/images/download.png') }}" width="15" class="mx-2"></a>
                            </div>

                            @endif
                            @endforeach
                            @endisset
                            <!-- <div class="col-md-3 text-center my-3">
                        <img src="images/t4.png">
                                      <a>Download <img src="images/download.png" width="15" class="mx-2"></a>

                        </div>    -->

                        </div>
                    </div>
                </div>
            </div>
            <!-- js -->
            <script src="{{asset('vendors/scripts/core.js')}} "></script>
            <script src="{{asset('vendors/scripts/script.min.js')}} "></script>
            <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
            <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
            <script>
                function bndka() {
                    $('.pop1').removeClass('d-none');
                }

                function bndka1() {
                    $('.pop1').addClass('d-none');
                }

                $(document).ready(function() {
                    $("#example").DataTable();
                });
                $(document).ready(function() {
                    $("#example1").DataTable();
                });

            </script>
            </body>
            </html>

            @if(isset($order))
            <div class="pop1 d-none scrolldo" id="order_details">
                <div class="row m-0">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-9 bg-white popadd fixheight" style="height:800px;">
                        <div class="page6box py-3 p-2">
                        </div>
                        <div class="row px-4 mb-5 ">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12 bold m-auto">
                                        <h4 class="textcolor">Order Detials</h4>
                                        <p class="greytext " style="font-size:12px;">Here is the order details</p>
                                        <i class="fa-solid bandeka float-right cursor fa-xmark " onclick="bndka1()"></i>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 bold m-auto">
                                        <div class="table-responsive">
                                            <table class="table tabledozama">
                                                <thead style="background-color: #f4f5f8;">
                                                    <td style="font-size: 8px!important;">Case ID:</td>
                                                    <th style="font-size: 10px!important;" class="case_empty" id="case_id">2
                                                    </th>
                                                    <td style="font-size: 8px!important;">Order ID:</td>
                                                    <th style="font-size: 10px!important;" class="case_empty" id="order_id">1
                                                    </th>
                                                    <td style="font-size: 8px!important;">Dentist’s Name:</td>
                                                    <th style="font-size: 10px!important;" class="case_empty" id="dentist_name">Mujtaba Fatih
                                                    </th>
                                                    <td style="font-size: 8px!important;">Number of trays:</td>
                                                    <th style="font-size: 10px!important;" class="case_empty" id="no_of_tray">10
                                                    </th>
                                                    <td style="font-size: 8px!important;">Shipping Charges:</td>
                                                    <th style="font-size: 10px!important;" class="case_empty" id="shipping_charges">0 AED
                                                    </th>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="row m-0">
                                    <div class="col-md-8 p-0 ">
                                        <div class="row m-1 m-0 brdall py-4 p-3" style="padding-bottom: 7rem!important;">
                                            <div class="col-md-12 p-0">
                                                <form method="post" enctype="multipart/form-data" novalidate>
                                                    {{csrf_field()}}
                                                    @method('PUT')
                                                    <h5 class="textcolor px-2">Order Status</h5>
                                            </div>
                                            <div class="col-md-12  mt-3 p-0 ">
                                                <div class="maindo table-responsive">
                                                    <table class="table">
                                                        <thead class="bxtekdo brdall" style="background-color: #f4f5f8;">
                                                            <td>
                                                                <img src="{{ asset('vendors/images/aligner.png')}}" width="50" height="20">
                                                            </td>

                                                            <!-- <th style="font-size: 8px!important;">
                                                                Aligner
                                                                <br> <span style="font-size:8px;font-weight: 300;" id="unit_price">Unit Price:</span><span class="case_empty" id="unit_price"> 99 AED </span>
                                                            </th> -->
                                                            <td style="font-size: 13px!important;">

                                                                <br> <span style="font-size:13px;font-weight: 300;"> Quantity:</span><span class="case_empty" id="quantity">1</span>
                                                            </td>
                                                            {{-- <th style="font-size: 8px!important;">
                                                                <br> <span style="font-size:8px;font-weight: 300;">Shipping:</span><span class="case_empty" id="shipping2">10 AED<span>
                                                            </th>     --}}
                                                            <td style="font-size: 13px!important;">
                                                                <span style="font-size:13px;font-weight: 300;"> </span>


                                                            </td>
                                                            <td style="font-size: 13px!important;">

                                                                <br> <span style="font-size:13px;font-weight: 300;"> Total Price:</span><span class="case_empty" id="total_price"> 99 AED </span>

                                                            </td>
                                                        </thead>
                                                    </table>
                                                </div>
                                            </div>

                                            <div class="col-md-12  mt-3 p-0 ">
                                                <div class="row">
                                                    <div class="col-md-6 mb-4 bold ">
                                                        <span>Status</span>
                                                        <select name="status" class="form-select form-control" id="select_box">
                                                            <option value="PENDING" id="pending">{{ucfirst(strtolower('PENDING'))}} </option>
                                                            <option value="CONFIRMED" id="confirmed">{{ucfirst(strtolower('CONFIRMED'))}}</option>
                                                            <option value="DISPATCHED" id="dispatch">{{ucfirst(strtolower('DISPATCHED'))}}</option>
                                                            <option value="DELIVERED" id="delivred">{{ucfirst(strtolower('DELIVERED'))}}</option>
                                                            <option value="CANCELED" id="canceled">{{ucfirst(strtolower('CANCELED'))}}</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 bold enterurl">
                                                        <span>Enter URL</span>
                                                        <input type="" name="order_url" class="form-control" placeholder="Link" id="url">
                                                        <img src="{{ asset('vendors/images/link.png') }}" style="background-color:white;">
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-md-12 p-0">
                                                <a class="bgcolor float-right updateimg text-white py-2 px-3" id="update" style="cursor:pointer">Update <img src="{{ asset('vendors/images/update.png')}}" class="mt-1"></a>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-4  ">
                                        <div class="row  brdall pt-3 m-1">
                                            <div class="col-md-12 ">
                                                <div class="cont pb-2 borderbottom">
                                                    <div class="row   ">
                                                        <div class="col-md-4 p-0 p-2 Changing">
                                                            <img src="{{ storageUrl_h('') }}" id="img">
                                                        </div>

                                                        <div class="col-md-6 p-0 pt-2 Changing">
                                                            <p id="name" class="case_empty"> Changing Gibson
                                                            </p>
                                                            <br>
                                                            <span class="case_empty" id="name_id"> ID:123664652
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mt-2">
                                                <span style="color:black;font-weight: bold;">General Info
                                                </span>
                                            </div>
                                            <div class="col-md-12 mt-1 addressdo">
                                                <p style="display: inline;font-size: 12px; display: inline;color: #8c8d8d;">
                                                    Email:

                                                </p>
                                                <span id="email" class="case_empty">
                                                    Test@gmail.com
                                                </span>

                                            </div>
                                            <div class="col-md-12 mt-1 addressdo ">
                                                <p style="display: inline;font-size: 12px;     display: inline;color: #8c8d8d;">
                                                    Phone:
                                                </p>
                                                <span id="phone" class="case_empty">
                                                    +9236562356
                                                </span>

                                            </div>
                                            <div class="col-md-12 mt-1 addressdo  my-2">

                                                <div class="">
                                                    <p style="display: inline;font-size: 12px;     display: inline;color: #8c8d8d;">
                                                        Order Date/Time:
                                                    </p>
                                                    <span id="date" class="case_empty">
                                                        2/3/23 9:Am
                                                    </span>

                                                </div>

                                                <div class="col borderbottom my-3">
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12 ">
                                                        <span style="color:black;font-weight: bold;font-size: 15px;">
                                                            Deliver Address
                                                        </span>

                                                    </div>
                                                    <div class="col-md-12 mt-1 addressdo">
                                                        <p style="display: inline;font-size: 12px;     display: inline;color: #8c8d8d;">
                                                            Country:</p>
                                                        <span id="country" class="case_empty">
                                                            UAE
                                                        </span>

                                                    </div>
                                                    <div class="col-md-12 mt-1 addressdo">
                                                        <p style="display: inline;font-size: 12px;     display: inline;color: #8c8d8d;">
                                                            State:
                                                        </p>
                                                        <span id="state" class="case_empty">Fujairah
                                                        </span>

                                                    </div>
                                                    <div class="col-md-12 mt-1 addressdo ">
                                                        <p style="display: inline;font-size: 12px;     display: inline;color: #8c8d8d;">
                                                            City:
                                                        </p>
                                                        <span style="color:black;" id="city" class="case_empty">
                                                            Dibba Al-Fujairah
                                                        </span>

                                                    </div>
                                                    <div class="col-md-12 mt-1 addressdo ">
                                                        <p style="display: inline;font-size: 12px;     display: inline;color: #8c8d8d;">
                                                            Address:
                                                        </p>
                                                        <span style="color:black;" id="address" class="case_empty">
                                                            Itaque est amet sit deserunt repudiandae velit in consectetur minus qui
                                                        </span>

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
            </div>
            @endif

            <script>
                // var case_id=
                var base_url = "{{url('admin/')}}";
                $("body").on("click", "#no_of_days_button", function() {
                    var no_of_days = $("#no_of_days").val();
                    var no_of_trays = $('#no_of_trays').val();
                    if (no_of_days == "") {
                        toastr.error(`Some values are required for updating`, 'Error');
                    } else if (no_of_days < 0 || no_of_days > 24) {
                        toastr.error(`No of hours should be between 0 to 24`, 'Error');
                    } else {
                        var data = {
                            _token: '{{csrf_token()}}'
                            , case_id: "{{$edit_values->id}}"
                            , no_of_days: no_of_days
                            , no_of_trays: no_of_trays
                        }
                        $.ajax({
                            url: '{{route("admin.case.no-of-days-update")}}'
                            , type: "POST"
                            , dataType: 'json'
                            , data: data
                            , beforeSend: function() {
                                ajaxLoader();
                            }
                            , success: function(responseCollection) {
                                toastr.success('Updated successfully', '', {
                                    timeOut: 2000
                                });
                                // toastr.success('Updated successfully', "Success!", {
                                //     positionClass: "toast-bottom-left",
                                //     containerId: "toast-bottom-left"
                                // });
                                // $("#no_of_days").val(' ');
                                // $('#no_of_trays').val(' ');
                                $('#loader').fadeOut();


                            }
                            , error: function(e) {
                                $('#loader').fadeOut();
                                var responseCollection = e.responseJSON;
                                console.log(e);
                                toastr.error(responseCollection['message'], '', {
                                    timeOut: 2000
                                });
                                // $("#no_of_days").val(' ');
                                // $('#no_of_trays').val(' ');
                                // toastr.error(responseCollection['message'], "Error!", {
                                //     positionClass: "toast-bottom-left",
                                //     containerId: "toast-bottom-left"
                                // });

                            }
                        }); //end of ajax
                    }
                });

                function preViewImage(input) {
                    //getting values in variables
                    var file = input.files[0];
                    var sort = $(input).data('sort');
                    var type = $(input).data('type');
                    //appending form
                    var form = $('#upload-attachment-form');
                    formData = new FormData(form[0]);
                    // formData= new FormData();
                    formData.append("_token", '{{csrf_token()}}');
                    formData.append("case_id", '{{$edit_values->id}}');
                    // formData.append("attachment", file);
                    formData.append("sort_order", sort);
                    formData.append("attachment_type", type);

                    //preview image on front
                    var reader = new FileReader();
                    reader.onload = function() {
                        var output = document.getElementById('IMAGE_1');
                        output.src = reader.result;
                    };
                    reader.readAsDataURL(event.target.files[0]);

                    $.ajax({
                        type: "POST"
                        , url: '{{route("admin.case.upload-attachments")}}'
                        , data: formData
                        , processData: false
                        , contentType: false
                        , beforeSend: function() {
                            ajaxLoader();
                        }
                        , success: function(responseCollection) {

                            // var id = data['data']['id']
                            $('#loader').fadeOut();

                            toastr.success(responseCollection['message'], 'Picture Uploaded Successfully', {
                                timeOut: 2000
                            });
                            // var attachment_ids_field = $('#attachment_ids');
                            // var attachment_ids = attachment_ids_field.val();
                            // attachment_ids_field.val((attachment_ids != "" ? attachment_ids+','+id : id));
                        }
                        , error: function(message, error) {
                            $('#loader').fadeOut();

                            toastr.error('Error Message', error, {
                                timeOut: 3000
                            });

                        }
                    });
                }

                function addvideolink() {
                    // var inputs = $("#video_link").val();
                    //  var video_embedded = [];
                    //  for(var i = 0; i < inputs.length; i++){
                    //     video_embedded.push($(inputs[i]).val());
                    //  }
                    var inputs = $(".video_link");
                    if (inputs == "") {
                        $('#error').text(' ');
                        $('#error').text('Please Paste the link to proceed');
                        $('#error').show();
                        return;
                    }
                    var check = true;
                    $('.video_link').each(function() {
                        var inputValue = $(this).val();
                        if (inputValue.startsWith("https://") || inputValue.startsWith("http://")) {} else {
                            check = false;
                            return;
                        }
                    });

                    if (check == false) {
                        $('#success').hide();
                        $('#error').text(' ');
                        $('#error').text('Please enter valid Link');
                        $('#error').show();
                        return;
                    }
                    var input = [];
                    for (var i = 0; i < inputs.length; i++) {
                        input.push($(inputs[i]).val());
                    }
                    if (inputs == "") {
                        $('#error').text(' ');
                        $('#error').text('Please Paste the link to proceed');
                        $('#error').show();
                        return;
                    } else {
                        var data = {
                            _token: '{{csrf_token()}}'
                            , case_id: "{{$edit_values->id}}"
                            , video_embedded: input
                        }

                        $.ajax({
                            url: "{{route('admin.case.embedded-video')}}"
                            , type: "POST"
                            , dataType: 'json'
                            , data: data
                            , beforeSend: function() {
                                ajaxLoader();
                            }
                            , success: function(response) {
                                if (response.message == 'success') {
                                    $('#error').hide();
                                    $('#success').text('link successfully Added');
                                    $('#success').show();
                                    $("#video_link").val(' ');
                                } else {
                                    $('#success').hide();
                                    $('#error').text(' ');
                                    $('#error').text('Something Went Wrong, Try again');
                                    $('#error').show();
                                    $("#video_link").val(' ');
                                }
                                // toastr.success('Updated successfully', "Success!", {
                                //     positionClass: "toast-bottom-left",
                                //     containerId: "toast-bottom-left"
                                // });
                                $('#loader').fadeOut();
                                setTimeout(function() {
                                    location.reload(true)
                                }, 1000);

                            }
                            , error: function(e) {
                                // var responseCollection = e.responseJSON;
                                console.log(e);
                                $('#success').hide();
                                $('#error').text(' ');
                                $('#error').text('Something Went Wrong, Try again');
                                $('#error').show();
                                $("#video_link").val(' ');
                                // toastr.error(responseCollection['message'], "Error!", {
                                //     positionClass: "toast-bottom-left",
                                //     containerId: "toast-bottom-left"
                                // });
                                $('#loader').fadeOut();

                            }
                        }); //end of ajax
                    }
                }

                function onClose() {
                    $('#success').text(' ');
                    $('#success').hide();
                    $('#error').text(' ');
                    $('#error').hide();
                    $('#success2').text(' ');
                    $('#success2').hide();
                    $('#error2').text(' ');
                    $('#error2').hide();
                    $("#video").val('');

                }

                function uploadvideo() {

                    $('#success2').hide();
                    $('#error2').text(' ');
                    $('#error2').text('Somthing Wnet Wrong, Try again');
                    $('#error2').hide();
                    var file = $('#video_upload').get(0).files[0];
                    if (file) {
                        var fileType = file.type;
                        if (fileType.indexOf('video') !== -1) {
                            //   console.log('Video uploaded:', file.name);
                            //   formData = new FormData(form[0]);
                            formData = new FormData();
                            formData.append("_token", '{{csrf_token()}}');
                            formData.append("case_id", '{{$edit_values->id}}');
                            formData.append('file', file);

                            $.ajax({
                                type: "POST"
                                , url: '{{route("admin.case.upload-video")}}'
                                , data: formData
                                , processData: false
                                , contentType: false
                                , beforeSend: function() {
                                    ajaxLoader();
                                }
                                , success: function(message) {
                                    $('#success2').text('Video Uploaded Successfully');
                                    $('#success2').show();
                                    $("#video").val('');
                                    $('#error2').text('');
                                    $('#error2').hide();
                                    $('#loader').fadeOut();
                                    setTimeout(function() {
                                        location.reload(true)
                                    }, 1000);
                                }
                                , error: function(message) {
                                    console.log(message.errors);
                                    // console.log(responseCollection);
                                    $('#success2').hide();
                                    $('#error2').text('');
                                    $('#error2').text('Something Went wrong,Please check file types Gif,Mp4 ');
                                    $('#error2').show();
                                    $("#video2").val('');
                                    $('#loader').fadeOut();

                                    //  toastr.error('Error Message',error, {timeOut: 3000});
                                }
                            });

                        } else if (fileType.indexOf('image') !== -1) {
                            //   console.log('Image uploaded:', file.name);
                            $('#success2').hide();
                            $('#error2').text(' ');
                            $('#error2').text('Please Uploda Video to Proceed');
                            $('#error2').show();
                            $("#video2").val(' ');
                        }
                    } else {
                        $('#success2').hide();
                        $('#error2').text(' ');
                        $('#error2').text('Please Upload a video');
                        $('#error2').show();
                    }

                }

                //  Deleting video ajax
                $("body").on("click", "#delete_video", function() {

                    var val = $(this).val();

                    var data = {
                        _token: '{{csrf_token()}}'
                        , case_id: "{{$edit_values->id}}"
                    , }

                    $.ajax({
                        url: '{{route("admin.case.delete-video")}}'
                        , type: "POST"
                        , dataType: 'json'
                        , data: data
                        , beforeSend: function() {
                            ajaxLoader();
                        }
                        , success: function(responseCollection) {

                            toastr.success(responseCollection['message'], 'Video Removed Successfully', {
                                timeOut: 2000
                            });
                            setTimeout(location.reload.bind(location), 500);
                            $('#loader').fadeOut();

                        }
                        , error: function(e) {
                            var responseCollection = e.responseJSON;
                            toastr.error(responseCollection['message'], 'Error', {
                                timeOut: 2000
                            });
                            $('#loader').fadeOut();

                        }
                    }); //end of ajax


                });

                function view(id) {
                    $('#order_id').val(' ');
                    $('#order_id').val(id);
                    var id_int = (parseInt(id));
                    //   alert(id_int);
                    $('#order_details').removeClass('d-none');
                    $.ajax({
                        url: base_url + '/order_edit/' + id_int
                        , method: "GET",
                        // data: json,
                        beforeSend: function() {
                            ajaxLoader();
                        }
                        , success: function(response) {
                            // Handle successful response
                            console.log(response.data.edit_values.id);
                            console.log(response.data.edit_values.created_at)


                            $('.case_empty').text(' ');

                            $('#case_id').text(response.data.edit_values.case_id);
                            $('#order_id').text(response.data.edit_values.id);
                            if (response.data.hasOwnProperty("doctor")) {
                                $('#dentist_name').text(response.data.doctor.name);
                            }
                            if (response.data.hasOwnProperty("case")) {
                                $('#no_of_tray').text(response.data.case.no_of_trays);
                            }
                            $('#shipping_charges').text(response.data.edit_values.shipping_charges + '{{ $default_currency }}');
                            //  console.log(response.data.edit_values.discount);
                            //  if(response.data.edit_values.discount > 0){
                            //      var unit_amount=response.data.edit_values.unit_amout;
                            //      var string_unit=unit_amount.toString();
                            //      var full= string_unit+'<?php echo($default_currency);  ?>';
                            //      $('#unit_price').text(full);
                            //  }else{
                            //      var unit_amount=response.data.edit_values.unit_amout - (response.data.edit_values.discount/response.data.edit_values.quantity);
                            //      $('#unit_price').text(unit_amount+'<?php echo($default_currency); ?>');
                            //  }
                            $('#quantity').text(response.data.edit_values.quantity);
                            $('#shipping2').text(response.data.edit_values.shipping_charges + '<?php echo($default_currency);  ?>');
                            $('#total_price').text(response.data.edit_values.total_amount + '<?php echo($default_currency);   ?>');
                            $('#name').text(response.data.edit_values.name);
                            $('#name_id').text('ID:' + response.data.edit_values.doctor_id);
                            $('#email').text(response.data.edit_values.email);
                            $('#phone').text(response.data.edit_values.phone_no);

                            //  var formattedDate = $.datepicker.formatDate('d-m-y', date);
                            //  var formattedTime = $.datepicker.formatTime('hh:mm:ss', {hour: date.getHours(), minute: date.getMinutes(), second: date.getSeconds()});
                            //  var formattedDateTime = formattedDate + ' ' + formattedTime;
                            //  console.log(formattedDateTime);

                            var date = new Date(response.data.edit_values.created_at);
                            var day = date.getDate();
                            var month = date.getMonth() + 1;
                            var year = date.getFullYear();
                            var hours = date.getHours();
                            var minutes = date.getMinutes();
                            var seconds = date.getSeconds();

                            var fulldate = day + '-' + month + '-' + year;
                            var fullhour = '  ' + hours + ':' + minutes + ':' + seconds;
                            console.log(response.data.edit_values.order_url);
                            $('#date').text(fulldate + fullhour);
                            $('#country').text(response.data.country);
                            $('#state').text(response.data.state);
                            $('#city').text(response.data.city);
                            $('#address').text(response.data.edit_values.street1);
                            $('#url').val(response.data.edit_values.order_url);
                            //  $('#name_id').text(response.data.edit_values.email);
                            //  $('#name_id').text(response.data.edit_values.email);
                            if (response.data.edit_values.hasOwnProperty("patient")) {
                                $('#img').attr('src', ' ');
                                $('#img').attr('src', response.data.edit_values.patient.picture);
                            }
                            if (response.data.edit_values.status == 'PENDING') {
                                $('#select_box').val('PENDING');
                            } else if (response.data.edit_values.status == 'CONFIRMED') {
                                $('#select_box').val('CONFIRMED');
                            } else if (response.data.edit_values.status == 'DISPATCHED') {
                                $('#select_box').val('DISPATCHED');
                            } else if (response.data.edit_values.status == 'DELIVERED') {
                                $('#select_box').val('DELIVERED');
                            } else if (response.data.edit_values.status == 'CANCELED') {
                                $('#select_box').val('CANCELED');
                            }
                            //  $('shipping_charges').val('response.data.edit_values.case_id');
                            $('#loader').fadeOut();
                        }
                        , error: function(xhr, status, error) {
                            // Handle errors
                            toastr.error('Something Went Wrong, Try Again', '', {
                                timeOut: 2000
                            });
                            $('#order_details').addClass('d-none');
                            $('#loader').fadeOut();
                        }
                    });
                }

                $(document).on('click', '#update', function(e) {
                    id = $('#order_id').val();
                    status = $('#select_box').val();
                    url = $('#url').val();
                    $.ajax({
                        url: base_url + '/order_update'
                        , type: 'POST'
                        , data: {
                            status: status
                            , order_url: url
                            , id: id
                        , }
                        , beforeSend: function() {
                            ajaxLoader();
                        }
                        , success: function(response) {
                            if (response.successMessage == 'success') {
                                toastr.success('Order Updated Successfully', '', {
                                    timeOut: 2000
                                });
                                setTimeout(function() {
                                    location.reload(true)
                                }, 1000);
                                //  window.location.reload();
                            } else {
                                toastr.error('Something went wrong please try again', '', {
                                    timeOut: 2000
                                });
                                setTimeout(function() {
                                    location.reload(true)
                                }, 1000);
                                console.log('error');
                            }
                            $('#loader').fadeOut();
                        }
                        , error: function(xhr, status, error) {
                            toastr.error('Something went wrong please try again', '', {
                                timeOut: 2000
                            });
                            setTimeout(function() {
                                location.reload(true)
                            }, 1000);
                            console.log('Request failed');
                            $('#loader').fadeOut();
                        }
                    });
                });
                $("body").on("click", "#advice_comment_button", function() {

                    var advice_comment = $("#advice_comment").val();

                    var data = {
                        _token: '{{csrf_token()}}'
                        , case_id: "{{$edit_values->id}}"
                        , message: advice_comment
                    }

                    $.ajax({
                        url: '{{route("admin.case.add-advice")}}'
                        , type: "POST"
                        , dataType: 'json'
                        , data: data
                        , beforeSend: function() {
                            ajaxLoader();
                        }
                        , success: function(responseCollection) {
                            $('#loader').fadeOut();
                            console.log(responseCollection);
                            toastr.success('Advice Added Successfully', '', {
                                timeOut: 2000
                            });

                            //    console.log(responseCollection['data']['concern'].created_date);
                            var currentTime = new Date();
                            var hours = currentTime.getHours();
                            var minutes = currentTime.getMinutes();
                            var seconds = currentTime.getSeconds();
                            var meridiem = "AM";
                            if (hours > 12) {
                                hours = hours - 12;
                                meridiem = "PM";
                            }
                            // add leading zeros to minutes and seconds
                            if (minutes < 10) {
                                minutes = "0" + minutes;
                            }
                            if (seconds < 10) {
                                seconds = "0" + seconds;
                            }
                            //  if(responseCollection['data']['concern'].message_by=='ADVISER')
                            //  $html =`<div class="col-md-12 remove_ajax">
                            //                             <div class="row mt-3">
                            //                                 <div class="col-md-2 p-0 ">
                            //                                 </div>
                            //                                 <div class="col-md-9 p-0 myapp ">
                            //                                     <div class=" text-white mx-2 p-3">
                            //                                         <p>
                            //                                         ${responseCollection['data']['concern'].message}
                            //                                         </p>
                            //                                         <span style="font-size: 13px;color: #afafaf;">
                            //                                       ${hours+':'+minutes+' '+ meridiem}
                            //                                     </span>
                            //                                     </div>
                            //                                 </div>
                            //                                  <div class="col-md-1 p-0 ">
                            //                                     <div class="proimgda mx-2">
                            //                                         <img src="{{ asset('vendors/images/logo.png') }}">
                            //                                     </div>
                            //                                  </div>
                            //                             </div>
                            //                         </div>`;
                            //          else{
                            //             $html=`<div class="col-md-12 remove_ajax">
                            //                             <div class="row mt-3 m-0">
                            //                                 <div class="col-md-1 p-0 ">
                            //                                     <div class="proimgda mx-2">
                            //                                         <img src="{{ asset('vendors/images/profileimg.jpg') }}">

                            //                                     </div>
                            //                                 </div>
                            //                                 <div class="col-md-9 p-0 ">
                            //                                     <div class="textdo mx-2 p-3">
                            //                                         <p>
                            //                                       ${responseCollection['data']['concern'].message}
                            //                                         </p>
                            //                                         <span style="font-size: 13px;color: #afafaf;">
                            //                                         ${hours+':'+minutes+' '+ meridiem}
                            //                                         </span>
                            //                                     </div>
                            //                                 </div>
                            //                             </div>
                            //                         </div>`;
                            //          }
                            $("#append").prepend($html);
                            refresh();
                            $("#advice_comment").val('');

                        }
                        , error: function(e) {
                            var responseCollection = e.responseJSON;
                            console.log(e);
                            $('#loader').fadeOut();

                            toastr.error(responseCollection['message'], "Error!", {
                                positionClass: "toast-bottom-left"
                                , containerId: "toast-bottom-left"
                            });

                        }
                    }); //end of ajax
                });

                function append_video() {
                    var random_class = Math.floor(Math.random() * 1000) + 1;
                    $('#video_append').append(`<div class="remove_${random_class}" style="display:flex;align-items:center;margin-top:10px;">
                 <input type="text" class="form-control digital-scan link_remove video_link"  name="link[]"  aria-describedby="emailHelp" placeholder="Enter Link"><br>
                 <i class="bi bi-dash-lg" style="cursor:pointer;" onclick="video_remove(${random_class})"></i>
                  </div>
                 <br>`);
                }

                function video_remove(id) {
                    $('.remove_' + id).remove();
                    return false;
                }

                /*__________________updating missing trays________________*/
                $("body").on("click", "#missing_trays", function() {


                    var data = {
                        _token: '{{csrf_token()}}'
                        , case_id: "{{$edit_values->id}}"
                        , missing_trays: $("#no_of_trays").val()
                    , }

                    $.ajax({
                        url: '{{route("admin.case.missing_aligners")}}'
                        , type: "POST"
                        , dataType: 'json'
                        , data: data
                        , beforeSend: function() {
                            ajaxLoader();
                        }
                        , success: function(data) {

                            if (data.done == true) {
                                toastr.success(data['message'], 'Success', {
                                    timeOut: 2000
                                });
                            } else {
                                toastr.error(data['message'], 'Error', {
                                    timeOut: 2000
                                });
                            }
                            $('#loader').fadeOut();

                        }
                        , error: function(e) {
                            var data = e.responseJSON;
                            toastr.error(data['message'], 'Error', {
                                timeOut: 2000
                            });
                            $('#loader').fadeOut();

                        }
                    }); //end of ajax


                });

            </script>
            <div class="modal fade" id="video_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document" style="position: absolute !important;right: 30% !important;">
                    <div class="modal-content" style="width:500px;">
                        <div class="modal-header">
                            <h5 class="modal-title" id="title">Video Add</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="onClose()">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-danger mb-2" id="error" style="display:none;"></div>
                            <div class="alert alert-success mb-2" id="success" style="display:none"></div>

                            <div class="form-group digital-scan" id="video_append">
                                <label for="exampleInputEmail1 digital-scan">Add Link</label>
                                <?php
                                $rowCount = 0;
                                $videos_embedded = !empty($edit_values->video_embedded) ? json_decode($edit_values->video_embedded) : [];
                                ?>
                                @forelse($videos_embedded as $key => $video_embedded)
                                <div class="remove_{{ $key }}" style="display:flex;align-items:center;">
                                    <input type="text" class="form-control digital-scan video_link" value="{{$video_embedded}}" name="link[]" aria-describedby="emailHelp" placeholder="Enter Link"><br>
                                    @if($key == 0)
                                    <i class="bi bi-plus" style="cursor:pointer;" onclick="append_video()"></i>
                                    @else
                                    <i class="bi bi-dash-lg" style="cursor:pointer;" onclick="video_remove('{{ $key }}')"></i>
                                    @endif
                                </div>
                                <br>
                                @empty
                                <div class="" style="display:flex;align-items:center;">
                                    <input type="text" class="form-control digital-scan video_link" name="link[]" aria-describedby="emailHelp" placeholder="Enter Link"><br>
                                    <i class="bi bi-plus" style="cursor:pointer;" onclick="append_video()"></i>
                                </div>
                                <br>
                                @endforelse
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal" onclick="onClose()">Close
                            </button>
                            <button type="button" class="btn bgcolor" style="color:white;" onclick="addvideolink()">Save
                                changes
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="video_modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document" style="position: absolute !important;right: 30% !important;">
                    <div class="modal-content" style="width:500px;">
                        <div class="modal-header">
                            <h5 class="modal-title" id="title">Video Add</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="onClose()">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-danger mb-2" id="error2" style="display:none;"></div>
                            <div class="alert alert-success mb-2" id="success2" style="display:none"></div>

                            <div class="form-group digital-scan">
                                <label for="exampleInputEmail1 digital-scan">Upload Video</label>
                                <!-- <label class="btn">
             <input type="file" multiple  name="video" id="video_upload" class="hidden upload-attachment" data-type="TREATMENT-PLAN-PDF" data-sort="1" onchange="preViewImage(this)" hidden>
            <img src="{{asset('link/files/app-assets/images/case/upload.png')}}"  alt="Image" class="img-thumbnail" style="max-width:250% !important;float:right;">
            </label>   -->
                                <div class="row">
                                    <div class="col-md-2 p-0 ">
                                        <img src="{{asset('vendors/images/drag.png')}}" width="40" class="mx-2 mt-4">
                                    </div>
                                    <div class="col-md-8 p-3">
                                        <form id="upload-attachment-form">

                                            <h5 style="font-size: 15px" class="mt-2"> Select a file to upload</h5>
                                            <span style="font-size: 11px;">JPG, PNG or PDF, file size no more than 10MB</span>
                                    </div>
                                    <div class="col-md-2 p-0">
                                        <!-- <a class="textcolor attachImg"  style="font-size: 15px;color:#00205C;text-decoration: underline; cursor:pointer;"> Browse</a> -->
                                        <!-- <input type="file" id="picture" name="picture" class="fileInput" accept="image/*" value="" hidden> -->
                                        <label class="btn mt-3">
                                            <input type="file" multiple name="video" id="video_upload" class="hidden upload-attachment" hidden>
                                            <img src="{{asset('link/files/app-assets/images/case/upload.png')}}" id="IMAGE_1" alt="Image" class="img-thumbnail">
                                        </label>

                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal" onclick="onClose()">Close
                            </button>
                            <button type="button" class="btn bgcolor" style="color:white;" onclick="uploadvideo()">Save
                                changes
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                /*_________close model__________*/
                function bndka1() {
                    $('.pop1').addClass('d-none');
                    $('.pop3').addClass('d-none');
                }

                /*_________change payment method__________*/
                $(document).on('change', '#payment_change', function(e) {
                    if ($(this).val() == 'stripe') {
                        $('.stripe-div').show();
                        $('#pay_now_invoice').addClass('d-none');
                    } else {
                        $('.stripe-div').hide();
                        $('#pay_now_invoice').removeClass('d-none');
                    }

                });

                $(document).on('click', '#pay_now', function(e) {
                    e.preventDefault();
                    var check = $('#check_payment').val();
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

                    if (csv === '') {
                        toastr.error('Please Enter csv', {
                            timeOut: 3000
                        });
                        return;
                    }


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

                            var cardNumber = c1 + c2 + c3 + c4 + ' ' + c5 + c6 + c7 + c8 + ' ' + c9 + c10 + c11 + c12 + ' ' + c13 + c14 + c15 + c16;
                            //  alert(month_year.split('/'));
                            //  alert(cardNumber);
                            //  alert(month_year.split('/')[0]);
                            //  alert(month_year.split('/')[1]);

                            Stripe.setPublishableKey(`{{ env('STRIPE_KEY') }}`);
                            Stripe.createToken({
                                number: cardNumber
                                , cvc: csv
                                , exp_month: month_year.split('/')[0]
                                , exp_year: month_year.split('/')[1]
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
                                    //  var id=$('#order_case_id').val();
                                    var payment = '1000';
                                    var currency = '{{$setting->currency}}';

                                    if (currency === '') {
                                        toastr.error('Currency is not mentioned, Try again', '', {
                                            timeOut: 2000
                                        });
                                        return;
                                    }

                                    $.ajax({
                                        type: "POST"
                                        , url: base_url + "/case/payment/store"
                                        , data: {
                                            'id': "{{$edit_values->id}}"
                                            , 'amount': payment
                                            , 'currency': currency
                                            , 'stripeToken': token
                                        , }
                                        , beforeSend: function() {
                                            ajaxLoader();
                                        }
                                        , success: function(data) {
                                            if (data.data = 'success') {
                                                $('.pop1').addClass('d-none');
                                                $('#payment').removeClass('d-none');
                                                //  $('#order_payment').val(data.case.processing_fee_amount);
                                                $('#loader').fadeOut();
                                                toastr.success('Payment Successfull', '', {
                                                    timeOut: 2000
                                                });
                                                setTimeout(function() {
                                                    location.reload(true)
                                                }, 1000);
                                            } else {
                                                $('#loader').fadeOut();
                                                toastr.error('Something Went Wrong, Try Again', '', {
                                                    timeOut: 2000
                                                });
                                            }
                                        }
                                        , error: function(message, error) {
                                            $('#loader').fadeOut();
                                            $.each(message['responseJSON'].errors, function(key, value) {
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

                /*  _____________________Invoice Payment Ajax_____________________   */
                $(document).on('click', '#pay_now_invoice', function(e) {
                    e.preventDefault();
                    var payment = '1000';
                    var currency = '{{$setting->currency}}';

                    $.ajax({
                        type: "POST"
                        , url: base_url + "/case/payment/invoice"
                        , beforeSend: function() {
                            ajaxLoader();
                        }
                        , data: {
                            'id': "{{$edit_values->id}}"
                            , 'amount': payment
                            , 'currency': currency
                        , }
                        , success: function(data) {
                            if (data.data = 'success') {
                                $('#loader').fadeOut();
                                $('.digital_scan').toastr.success('Invoice Added Successfully', '', {
                                    timeOut: 2000
                                });
                                $('.pop1').addClass('d-none');
                                $('#payment').removeClass('d-none');
                                //  $('#order_payment').val(data.case.processing_fee_amount);
                                setTimeout(function() {
                                    location.reload(true)
                                }, 1000);
                            } else {
                                $('#loader').fadeOut();
                                toastr.error('Something Went Wrong, Try Again', '', {
                                    timeOut: 2000
                                });
                            }
                        }
                        , error: function(message, error) {
                            $('#loader').fadeOut();
                            $.each(message['responseJSON'].errors, function(key, value) {
                                toastr.error(value, {
                                    timeOut: 3000
                                });
                            });
                        }
                    });
                });

                /*___________payDigitalScan__________*/
                function payDigitalScan() {
                    id = "{{$edit_values->id}}";
                    $.ajax({
                        url: base_url + "/case/allow_doct", // the URL of the server-side script that handles the request
                        type: "POST", // the type of request (POST or GET)
                        data: {
                            id: id
                        }, // the data variables that you want to send along with the request
                        beforeSend: function() {
                            ajaxLoader();
                        }
                        , success: function(response) {
                            $('#loader').fadeOut();
                            if (response.done == true) {
                                toastr.success('Dentist Will Pay Digital Scan Shortly..', 'Success', {
                                    timeOut: 3000
                                });
                            } else {
                                toastr.error('Error In Assigning Digital Scan', 'Error', {
                                    timeOut: 3000
                                });
                            }
                            setTimeout(function() {
                                location.reload();
                            }, 3000);
                        }
                        , error: function(xhr) {
                            $('#loader').fadeOut();
                            // the function that is executed if the request fails
                            console.log(xhr.responseText);
                        }
                    });

                }

            </script>
            <script>
                setTimeout(function() {
                    refresh();

                }, 5000);

                function refresh() {

                    $.ajax({
                        url: '{{url("admin/case/get-advices")}}'
                        , type: "POST"
                        , dataType: 'json'
                        , data: {
                            '_token': "{{ csrf_token() }}"
                            , 'case_id': "{{ $edit_values->id }}"
                        , }
                        , success: function(responseCollection) {
                            $('#loader').fadeOut();
                            console.log(responseCollection);
                            $('.remove_ajax').remove();

                            $.each(responseCollection.concern, function(key, value) {
                                console.log(value.id);
                                //    console.log(key + ": " + value);
                                var date = new Date(value.created_at);
                                var time = date.toLocaleTimeString([], {
                                    hour: '2-digit'
                                    , minute: '2-digit'
                                });

                                if (value.message_by == 'ADVISER') {

                                    $html = `<div class="col-md-12 remove_ajax">
                            <div class="row mt-3">
                                <div class="col-md-1 col-1 p-0 ">
                                </div>
                                <div class="col-md-9 col-9 p-0 myapp ">
                                    <div class=" text-white mx-2 p-3">
                                        <p>
                                        ${value.message}
                                        </p>
                                        <span style="font-size: 13px;color: #afafaf;">
                                      ${time}
                                    </span>
                                    </div>
                                </div>
                                 <div class="col-md-2 col-2 p-0 ">
                                    <div class="proimgda mx-2">
                                        <img src="{{ asset('vendors/images/logo.png') }}">
                                    </div>
                                 </div>
                            </div>
                        </div>`;
                                    $("#append").prepend($html);


                                } else {
                                    $html = `<div class="col-md-12 remove_ajax">
                            <div class="row mt-3 m-0">
                                <div class="col-md-1 col-2 p-0 ">
                                    <div class="proimgda mx-2">
                                    <img src="{{ asset('vendors/images/logo.png') }}">

                                    </div>
                                </div>
                                <div class="col-md-9 col-9 p-0 ">
                                    <div class="textdo mx-2 p-3">
                                        <p>
                                      ${value.message}
                                        </p>
                                        <span style="font-size: 13px;color: #afafaf;">
                                        ${time}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>`;
                                    $("#append").prepend($html);


                                }

                            });
                        }
                        , error: function(e) {
                            var responseCollection = e.responseJSON;
                            console.log(e);
                            $('#loader').fadeOut();

                            toastr.error(responseCollection['message'], "Error!", {
                                positionClass: "toast-bottom-left"
                                , containerId: "toast-bottom-left"
                            });

                        }
                    });

                }

            </script>
