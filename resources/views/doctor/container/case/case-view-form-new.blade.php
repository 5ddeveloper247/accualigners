<style>
    .number_val {
        padding: 11px !important;
    }

    body {
        display: none;
    }

    .pop3,
    .pop4 {
        position: fixed;
        bottom: 0px;
        top: 0px;
        left: 0;
        right: 0;
        background-color: rgb(4 4 4 / 60%);
        height: 100vh;
        z-index: 999999;
    }

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

    .payment {
        display: flex !important;
    }

    .fun2 {
        width: 20%;
    }

    .classfixka {
        position: relative;
        top: 2rem;
    }

    @media(max-width:500px) {
        .fun2 {
            width: 100% !important;
        }

        .item {
            position: absolute;
            top: 15px;
            width: 250px;
            right: -20px;
        }

        .classfixka {
            position: relative;
            top: -21px;
        }

        .item img {
            display: none;
        }

        .item a {
            position: absolute;
            bottom: -28px;
            right: 20px;
        }
    }
</style>
@php
    $title = 'Case Details';
@endphp
@extends('originator.root.dashboard_side_bar', ['title' => $title])
@section('title', 'Case Details')
@php
    
    $viewRoute = route('doctor.case.index');
    //$currency = trans('siteConfig.default_currency');
    $setting = setting_h();
    $default_currency = $setting->currency;
    $currency = $settings->currency;
    $aligner_kit_price = $settings->aligner_kit_price;
    $case_fee = $settings->case_fee;
    $complete_treatment_plan = $settings->complete_treatment_plan;
    $installment_amount = (int) $complete_treatment_plan - (int) $case_fee;
@endphp

<link rel="stylesheet" href="{{ asset('vendors/css/case-style.css') }}" />

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
                            @if (isset($order))
                                <a class="mt-2 px-3 py-2">{{ $order->status }}</a>
                            @endif
                        </div>
                    </div>
                    <div class="col-xl-3 mt-2 ">
                        <div class=" ViewDetails">
                            <a class="text-white cursor float-right mx-3 py-2 px-3"
                                @if (!isset($order)) disabled @endif
                                @if (isset($order)) onclick="view('{{ $order->id }}') @endif">View
                                Details</a>
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
                <div class="c1data p-3 m-2">
                    <h5 class="mt-3"> Case Number</h5>
                    <p style="color: #4B5563;" class="mt-2"> {{ $edit_values->id }}</p>
                </div>
            </div>
            <div class="fun2  p-0">
                <div class="c1data p-3 m-2">
                    <h5 class="mt-3"> Case Date</h5>
                    <p style="color: #4B5563;" class="mt-2"> {{ date('d-M-Y', $edit_values->created_date) }}</p>
                </div>
            </div>
            <div class="fun2 p-0">
                <div class="c1data p-3 m-2">
                    <h5 class="mt-3"> Case Time</h5>
                    @php
                        $ip = request()->ip();
                        $api_key = '4eb0722e7f464951aef4c772283952fb'; // replace with your actual API key
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
                <div class="c1data p-3 m-2">
                    <h5 class="mt-3">Patient Name</h5>
                    <p style="color: #4B5563;" class="mt-2">{{ ucwords($edit_values->name) }}</p>
                </div>
            </div>
            <div class="fun2  p-0">
                <div class="c1data p-3 m-2" style="overflow-wrap: break-word;height: 120px;">
                    <h5 class="mt-3">Patient Email</h5>
                    <p style="color: #4B5563;" class="mt-2"
                        style="color: #4B5563;font-size: 14px;float: left;margin-left: -12px;">
                        {{ ucfirst($edit_values->email) }}</p>
                </div>
            </div>
        </div>

    </div>
    @if (
        (!empty($edit_values->video_uploaded) || !empty($edit_values->video_embedded)) &&
            !empty($edit_values->no_of_trays) &&
            $edit_values->no_of_trays > 0)

        {{-- Video/GIF Image --}}
        <div class="row mt-3 m-0">
            <div class="col-md-12  bordertop borderbottom   p-0">
                <div class="row m-0 ">
                    <div class="col-md-8  ">
                        <div class="row">
                            <div class="col-xl-6 py-2 ">
                                <h4 class="px-3"> Treatment plan</h4>
                            </div>
                            <div class="col-xl-6 py-2">
                                <a href="{{ url('doctor/case/download-attachment/' . $edit_values->id . '?type=TREATMENT-PLAN-PDF') }}"
                                    data-toggle="tooltip" data-original-title="Download Treatment Plan PDF"> Download
                                    Treatment Plan <img src="{{ asset('vendors/images/download.png') }}"
                                        width="15"></a>
                            </div>
                        </div>
                        <div class="row">
                            @if (!empty($edit_values->video_uploaded))
                                <div class="col-xl-12 py-2 ">
                                    @if ($edit_values->video_uploaded_type == 'VIDEO')
                                        <video id="vid0" src="{{ storageUrl_h($edit_values->video_uploaded) }}"
                                            style="width:100% !important;" controls="controls" crossorigin="anonymous"
                                            class="vid" playsinline autoplay muted loop></video>
                                    @else
                                        <img src="{{ storageUrl_h($edit_values->video_uploaded) }}" class="img-fluid">
                                    @endif
                                </div>
                            @elseif (!empty($edit_values->video_embedded))
                                <?php
                                $videos_embedded = !empty($edit_values->video_embedded) ? json_decode($edit_values->video_embedded) : [];
                                ?>
                                @forelse($videos_embedded as $key => $video_embedded)
                                    <div class="col-12 p-1">
                                        <iframe width="100%" height="450" src="{{ $video_embedded }}"
                                            title="YouTube video player" frameborder="0"
                                            allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                            autoplay allowfullscreen></iframe>
                                    </div>
                                @empty
                                    <p class="text-center">No Treatment plan Found</p>
                                @endforelse
                            @endif
                        </div>
                        <div class="row m-0">
                            <h5 class="my-2">Order</h5>
                            <div class="col-xl-12  border bg-light" style="border-radius:12px;">
                                <div class="row ">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-2 col col-sm-6"image>
                                                <img class="py-3 px-1" src="{{ asset('vendors/images/aligner.png') }}">
                                            </div>
                                            <div class="col-md-7 col-sm-6 col p-0">
                                                <br>
                                                <p class="mt-5" style="display: inline;">Aligner</p><br>
                                                <p style="font-size: 11px;color:grey;">
                                                    Total Cost: <span style="color:black;font-weight: bold;"
                                                        class="total_price">{{ $installment_amount }}
                                                        {{ strtoupper($currency) }}</span>
                                                    <!-- Number of trays:<span style="color:black;font-weight: bold;">10</span> -->
                                                </p>
                                            </div>
                                            <div class="col-md-2 p-0 col col-sm-6">
                                                <div class="float-right ">
                                                    <br>
                                                    <p style="font-size: 11px;color:grey;">
                                                        Total Price: <span style="color:black;font-weight: bold;"
                                                            class="total_price">{{ $installment_amount }}
                                                            {{ strtoupper($currency) }}</span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <th><br><span style="font-size: 11px;font-weight:bold;"> 1980 AED</span></th>
                                                <th><br><span style="font-size: 11px;color:grey;"> Number of trays:</span></th>-->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mb-2 mt-2">
                            @if (empty($edit_values->aligner_kit_order_id))
                                <button class="btn bgcolor text-white" onclick="open_modal('first')">Agree & Order!
                                </button>
                                <a href="#advice_comment_section" class="btn  bgcolor text-white"
                                    id="advice_comment_section">Modify?</a>
                            @endif
                            @if (isset($edit_values->aligner->status))
                                <a href="#advice_comment_section" class="btn bgcolor text-white"
                                    id="advice_comment_section">Missing Aligners? </a>
                            @endif
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12 borderbottom bordertop">
                                <div class="recuitment my-3">
                                    <img src="{{ asset('vendors/images/profileimg.png') }}">
                                    <span style="font-size: 18px;font-weight:bold;line-height: 45px;;">Chat with the
                                        Dentist</span>

                                    @if ($edit_values->has_concern)
                                        <div id="dr_concern"
                                            style="border: 2px solid red;padding: 6px;color: red;float:right"
                                            class="badge badge-pill badge-border badge-glow border-danger danger badge-square">
                                            Doctor has concern</div>
                                    @endif
                                </div>
                            </div>
                            <div id="append" style="overflow:scroll !important; height:450px;width:100%;"></div>
                            <!-- @isset($edit_values->concerns)
                            @foreach ($edit_values->concerns as $concern)
                            @if ($concern->message_by == 'ADVISER')
                            -->
                                <!-- <div class="col-md-12 remove_ajax">
                                                <div class="row mt-3">
                                                    <div class="col-md-1 p-0 ">
                                                        <div class="proimgda mx-2">
                                                            <img src="{{ asset('vendors/images/logo.png') }}" width="40">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-9 p-0 ">
                                                        <div class="textdo mx-2 p-3">
                                                            <p>
                                                            {!! $concern->message !!}
                                                            </p>
                                                            <span style="    font-size: 13px;
                                                 color: #afafaf;"> -->
                                <?php
                                $timestamp = strtotime($concern->created_at);
                                $date = new DateTime("@$timestamp");
                                $date->setTimeZone($user_timezone);
                                $time = $date->format('h:i A');
                                ?>
                                <!-- {{ $time }}
                                                         </span>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div> -->

                            <!--@else-->
                                <!-- <div class="col-md-12 remove_ajax">
                                                <div class="row mt-3">
                                                    <div class="col-md-2 p-0 ">
                                                    </div>

                                                    <div class="col-md-9 p-0 myapp ">
                                                        <div class=" text-white mx-2 p-3">
                                                            <p>
                                                            {!! $concern->message !!}
                                                            </p>
                                                            <span style="    font-size: 13px;color: #afafaf;">
                                                            <?php
                                                            $timestamp = strtotime($concern->created_at);
                                                            $date = new DateTime("@$timestamp");
                                                            $date->setTimeZone($user_timezone);
                                                            $time = $date->format('h:i A');
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
                                            </div> -->

                                <!--
                            @endif
                            @endforeach
                        @endisset -->
                            <div class="col-md-12 p-3">
                                <div class="row mt-3 typehere">
                                    <div class="col-md-12 dall" style="position: relative;">
                                        <input type="" class="form-control" placeholder="Type Something..."
                                            id="advice_comment">
                                        <a class="bgcolor text-white py-2 px-4"
                                            style="position: absolute;bottom: 2px;right:17px;cursor:pointer;"
                                            id="advice_comment_button">Send</a>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
    @endif
    <div
        class="col-md-4 borderleft {{ !empty($edit_values->video_uploaded) || (!empty($edit_values->video_embedded) && !empty($edit_values->no_of_trays) && $edit_values->no_of_trays > 0) ? '' : 'float-right' }}">
        <div class="row">
            <div class="col-md-12">
                <div class="addlinkdo mt-3">
                    <h6 class="d-inline">Order Payment</h6>
                </div>
            </div>
        </div>
        <div class="row mt-1 " style="background:#f8fbff;">
            <div class="col-md-12 p-0 px-2   borderbottom pb-3">
                <div class="row py-2 m-1" style="border:1px solid rgb(232, 232, 232);border-radius: 8px;">
                    <div class="col-md-9 col-9 p-0 ">
                        <div class="moto px-2 mt-2">
                            <h5 class="mt-3">Digital model charges</h5>
                            @if (!empty($edit_values->processing_fee_payment_at))
                                <span
                                    style="font-size: 13px;
                                    ">{{ date('d M Y', strtotime($edit_values->processing_fee_payment_at)) }}
                                    | {{ date('h:i a', strtotime($edit_values->processing_fee_payment_at)) }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-3 col-3 p-0 pt-3 col">
                        @if ($edit_values->digital_scan_fee != 0 && $edit_values->pay_digital_scan != 0)
                            <a class="painbtn  " style="padding:6px 8px!important;font-size: 12px;"> Delivered</a>
                        @else
                            @if ($edit_values->pay_digital_scan == 1)
                                <span class=""
                                    style="font-size: 13px;color:red;cursor:pointer;float:left;margin-bottom:8px;"
                                    onclick="open_modal('five')">Pay now</span>
                            @endif
                            <a class="inprogressbtn  " style="padding:6px 8px!important;font-size: 12px;"> Pending</a>
                        @endif
                        <p class="mt-2" style="font-size: 15px;font-weight: bold;">
                            {{ $edit_values->processing_fee_amount }} <span
                                style="font-size: 12px;font-weight:300;">{{ strtoupper($currency) }}</span></p>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="addlinkdo mt-3">
                    <h6 class="d-inline">Treatment plan</h6>

                </div>
            </div>
        </div>
        <div class="row mt-1 ">
            <div class="col-md-12 p-0 px-2   borderbottom pb-3">
                <div class="row py-2 m-1" style="border:1px solid rgb(232, 232, 232);border-radius: 8px;">
                    <div class="col-md-4 p-0 col">
                        <div class="moto px-2 mt-2">
                            <h6 class="mt-3">Milestone 1</h6>
                        </div>
                    </div>
                    <div class="col-md-4 p-0 col  pt-3">
                        <div class="pending px-3">
                            @if ($edit_values->processing_fee_paid)
                                <a class="painbtn  " style="padding:6px 8px!important;font-size: 12px;"> Paid</a>
                            @else
                                <a class="inprogressbtn  " style="padding:6px 8px!important;font-size: 12px;">
                                    Pending</a>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-3 p-0 pt-3 col">
                        @if (!$edit_values->processing_fee_paid)
                            <span class="" style="font-size: 15px;color:red;cursor:pointer;"
                                onclick="open_modal('fourth')">Pay now</span>
                        @endif
                        <p class=""
                            style="font-size: 15px;font-weight: bold;
                                            ">
                            1000 <span style="font-size: 12px;font-weight:300;">AED</span></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="addlinkdo mt-3">
                    <h6 class="d-inline">
                        Aligners Production
                    </h6>
                </div>
            </div>
        </div>


        <div class="row mt-1 ">
            <div class="col-md-12 p-0 px-2   borderbottom pb-3">
                <div class="row py-2 m-1" style="border:1px solid rgb(232, 232, 232);border-radius: 8px;">
                    <div class="col-md-4 p-0 col">
                        <div class="moto px-2 mt-2">
                            <h6 class="mt-3">Milestone 1</h6>
                        </div>
                    </div>
                    <div class="col-md-4 p-0 col pt-3">
                        <div class="pending px-3">
                            @if (isset($edit_values->aligner->status))
                                @if (strtoupper($edit_values->aligner->status) != 'PENDING')
                                    <a class="painbtn" style="padding:6px 8px!important;font-size: 12px;">Paid</a>
                                @endif
                            @else
                                <a class="inprogressbtn" style="padding:6px 8px!important;font-size: 12px;">
                                    Pending</a>
                            @endif

                        </div>
                    </div>
                    <div class="col-md-3 p-0 pt-3 col">
                        @if (
                            (!empty($edit_values->video_uploaded) || !empty($edit_values->video_embedded)) &&
                                !empty($edit_values->no_of_trays) &&
                                $edit_values->no_of_trays > 0)
                            @if ($edit_values->processing_fee_paid && empty($edit_values->aligner_kit_order_id))
                                <span class="" style="font-size: 15px;color:red;cursor:pointer;"
                                    onclick="open_modal('first')" class="agree_order"> Pay now</span>
                            @endif
                        @endif

                        <p class=""
                            style="font-size: 15px;font-weight: bold;
                                            ">
                            {{ $installment_amount / 2 }} <span style="font-size: 12px;font-weight:300;">
                                {{ strtoupper($currency) }}</span></p>
                    </div>

                </div>
            </div>
        </div>

        @if ($edit_values->payment_status === 'second-installment')
            <div class="row mt-1 ">
                <div class="col-md-12 p-0 px-2   borderbottom pb-3">
                    <div class="row py-2 m-1" style="border:1px solid rgb(232, 232, 232);border-radius: 8px;">
                        <div class="col-md-4 p-0 col">
                            <div class="moto px-2 mt-2">
                                <h6 class="mt-3">Milestone 2</h6>
                            </div>
                        </div>
                        <div class="col-md-4 p-0  col pt-3">
                            <div class="pending px-3">
                                <a class="painbtn" style="padding:6px 8px!important;font-size: 12px;"> Paid</a>
                            </div>
                        </div>
                        <div class="col-md-3 p-0 pt-3 col">
                            <p class=""
                                style="font-size: 15px;font-weight: bold;
                                            ">
                                {{ $installment_amount / 2 }} <span
                                    style="font-size: 12px;font-weight:300;">{{ strtoupper($currency) }}</span></p>
                        </div>

                    </div>
                </div>
            </div>
        @else
            <div class="row mt-1 ">
                <div class="col-md-12 p-0 px-2   borderbottom pb-3">
                    <div class="row py-2 m-1" style="border:1px solid rgb(232, 232, 232);border-radius: 8px;">
                        <div class="col-md-4 p-0 col">
                            <div class="moto px-2 mt-2">
                                <h6 class="mt-3">Milestone 2</h6>
                            </div>
                        </div>
                        <div class="col-md-4 p-0  col pt-3">
                            <div class="pending px-3">
                                <a class="inprogressbtn" style="padding:6px 8px!important;font-size: 12px;">
                                    Pending</a>
                            </div>
                        </div>
                        <div class="col-md-3 p-0 pt-3 col">
                            @if (isset($edit_values->aligner->status))
                                @if (strtoupper($edit_values->aligner->status) != 'PENDING')
                                    <a href="" class="" style="font-size: 15px;color:red;"
                                        onclick="open_modal('second')"> Pay now</a>
                                @endif
                            @endif
                            <p class=""
                                style="font-size: 15px;font-weight: bold;
                                            ">
                                {{ $installment_amount / 2 }} <span
                                    style="font-size: 12px;font-weight:300;">{{ strtoupper($currency) }}</span></p>
                        </div>

                    </div>
                </div>
            </div>


        @endif

        @if ($edit_values->no_of_missing_trays != null || $edit_values->missing_trays_amount != null)
            <div class="row mt-1 ">
                <div class="col-md-12 p-0 px-2   borderbottom pb-3">
                    <div class="row py-2 m-1" style="border:1px solid rgb(232, 232, 232);border-radius: 8px;">
                        <div class="col-md-4 p-0 col">
                            <div class="moto px-2 mt-2">
                                <h6 class="mt-3">Milestone 3</h6>
                                <span style="font-size: 13px;
                                    "></span>
                            </div>
                        </div>
                        <div class="col-md-4 p-0  col pt-3">
                            <div class="pending px-3">
                                @if ($edit_values->no_of_missing_trays != 0)
                                    <a class="inprogressbtn" style="padding:6px 8px!important;font-size: 12px;">
                                        Pending</a>
                                @else
                                    <a class="painbtn  " style="padding:6px 8px!important;font-size: 12px;"> Paid</a>
                                @endif

                            </div>
                        </div>
                        <div class="col-md-3 p-0 pt-3 col">
                            @if ($edit_values->no_of_missing_trays != 0)
                                <a href="" class="" style="font-size: 15px;color:red;"
                                    onclick="open_modal('third')"> Pay Now</a>
                            @endif
                            <p class=""
                                style="font-size: 15px;font-weight: bold;
                                            ">
                                {{ $edit_values->no_of_missing_trays == 0 ? $edit_values->missing_trays_amount : $edit_values->no_of_missing_trays * $aligner_kit_price }}
                                <span style="font-size: 12px;font-weight:300;">{{ strtoupper($currency) }}</span>
                            </p>
                        </div>

                    </div>
                </div>
            </div>
        @endif
        <div class="row mt-4 ">
            <div class="col-md-12   p-0 px-2  pb-3">
                <h5 class="px-2 pb-2"> Treatment Instructions</h5>
            </div>
            {{-- <div class="col-md-12   p-0 px-3  pb-3">
                                    <label> Embeded URL</label>
                                    <input type="text" class="form-control" placeholder="Enter Here">
                                </div> 
                                <div class="col-md-12   p-0 px-3  pb-3">
                                        
                                <a class="float-right" style="color:#00205C;text-decoration:underline;">Add More</a>
                                </div> --}}
            <div class="col-md-12   p-0 px-3  pb-3">
                <label> Number of trays required*</label>
                <input type="text" name="no_of_trays" id="no_of_trays" class="form-control"
                    placeholder="Enter Here"
                    value="{{ old('no_of_trays', isset($edit_values) ? $edit_values->no_of_trays + $edit_values->no_of_missing_trays : null) }}"
                    readonly
                    @if (isset($edit_values->aligner->status) && strtoupper($edit_values->aligner->status) != 'PENDING') readonly title="Can not update, order has been paid" @endif>
            </div>
            <div class="col-md-12  py-3">
                @if (false)
                    <button class="bgcolor float-right px-3 py-3 text-white">Submit</button>
                @endif

            </div>
            <div class="col-md-12   p-0 px-3  pb-3">
                <label> Number of hours to wear in a day</label>
                <input type="text" name="no_of_days" id="no_of_days" class="form-control"
                    placeholder="Enter Here" required data-validation-required-message="No of hours is required"
                    data-validation-containsnumber-regex="((\d+)?)"
                    data-validation-containsnumber-message="Enter a valid number" readonly
                    value="{{ old('no_of_days', isset($edit_values) ? $edit_values->no_of_days : null) }}">

            </div>
            <div class="col-md-12  py-3">
                @if (false)
                    <button class="bgcolor float-right px-3 py-3 text-white" id="no_of_days_button">Submit</button>
                @endif

            </div>
        </div>
    </div>
</div>




<div class="{{ !empty($edit_values->video_uploaded) || (!empty($edit_values->video_embedded) && !empty($edit_values->no_of_trays) && $edit_values->no_of_trays > 0) ? '' : 'main-container' }}">
    <div class="row mt-3 m-0">
        <div class="col-md-12 mb-2 p-2">
            <h5>Case Requirements</h5>
        </div>
        <div class="col-md-12 mt-3 border borderradius">
            <h5 class="mt-3">Treatment Details</h5>

            <div class="col-md-12 ">
                <div class="row borderbottom pb-4">
                    <div class="col-md-2 p-0">
                        <div class="c1data px-3 py-3 m-2">
                            <p style="color: #4B5563;font-size:12px;" class="mt-2 m-0"> Arch to treat</p>
                            <h5 class="pt-2" style="color: black;font-size:12px;">{{ $edit_values->arch_to_treat }}
                            </h5>

                        </div>
                    </div>
                    <div class="col-md-2 p-0">
                        <div class="c1data px-3 py-3 m-2">
                            <p style="color: #4B5563;font-size:12px;" class="mt-2 m-0"> A-P Relation</p>
                            <h5 class="pt-2" style="color: black;font-size:12px;">
                                {{ $edit_values->a_p_relationship }}</h5>

                        </div>
                    </div>
                    <div class="col-md-2 p-0">
                        <div class="c1data px-3 py-3 m-2">
                            <p style="color: #4B5563;font-size:12px;" class="mt-2 m-0">Overjet</p>
                            <h5 class="pt-2" style="color: black;font-size:12px;">{{ $edit_values->overjet }}</h5>

                        </div>
                    </div>
                    <div class="col-md-2 p-0">
                        <div class="c1data px-3 py-3 m-2">
                            <p style="color: #4B5563;font-size:12px;" class="mt-2 m-0"> Arch to treat</p>
                            <h5 class="pt-2" style="color: black;font-size:12px;">{{ $edit_values->overbite }}</h5>

                        </div>
                    </div>
                    <div class="col-md-2 p-0">
                        <div class="c1data px-3 py-3 m-2">
                            <p style="color: #4B5563;font-size:12px;" class="mt-2 m-0"> MidLine</p>
                            <h5 class="pt-2" style="color: black;font-size:12px;">{{ $edit_values->midline }}</h5>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 pt-3">
                <div class="row borderbottom">
                    <div class="col-md-10">
                        <h5 class="mt-2">Clinic Comment
                        </h5>
                        <p style="color:#1f1e1e;">{!! ucfirst($edit_values->clinical_comment) !!} </p>
                    </div>
                </div>
                <div class="row borderbottom">
                    <div class="col-md-10 my-4">
                        <h5 class="mt-2">Prescription Comment
                        </h5>
                        <p style="color:#1f1e1e;">{!! ucfirst($edit_values->prescription_comment) !!}</p>
                    </div>
                </div>
                <!-- <div class="row borderbottom pt-3 ">
                        <div class="col-md-10">
                            <h5 class="mt-2">Additional Comment
                            </h5>
                            <p style="color:#1f1e1e;">There is strong evidence to suggest that the combined mix of colours, sounds and smells we find outdoors act together to stimulate our senses, which helps increase our overall wellbeing. </p>
                        </div>
                    </div> -->
            </div>

            <div class="col-md-12 ">
                <div class="row py-3 border borderround m-2">
                    <div class="col-md-12 crowding">
                        <h5>Clinical Condition</h5>
                        @isset($edit_values->clinical_conditions)
                            @foreach ($edit_values->clinical_conditions as $clinical_condition)
                                <button class="mt-3"> {{ ucwords($clinical_condition->clinical_condition->name) }}
                                </button>
                            @endforeach
                        @endisset
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
                                    @php($image = storageUrl_h($attachment->path . $attachment->name))
                                    <div class="col-md-3 text-center my-3">
                                        <img src="{{ $image }}" class="" style="width: 100%;height:80%;">
                                        <a href="{{ $image }}" target="_blank"
                                            download="{{ $image }}">Download <img
                                                src="{{ asset('vendors/images/download.png') }}" width="15"
                                                class="mx-2"></a>
                                    </div>
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
                                    @php($image = storageUrl_h($attachment->path . $attachment->name))
                                    <div class="col-md-3 text-center my-3">
                                        <img src="{{ $image }}" style="width: 100%;height:80%;">
                                        <a href="{{ $image }}" target="_blank"
                                            download="{{ $image }}">Download <img
                                                src="{{ asset('vendors/images/download.png') }}" width="15"
                                                class="mx-2"></a>
                                    </div>
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
                                    @php($image = storageUrl_h($attachment->path . $attachment->name))
                                    <div class="col-md-3 text-center my-3">
                                        <img src="{{ asset('vendors/images/stl.png') }}" style="width: 100%;height:80%;">
                                        <a href="{{ $image }}" target="_blank" download="{{ $image }}"
                                            style="font-size: 11px;font-family: 'Inter';line-height: 25px;font-weight: 700;">{{ ucwords($attachment->attachment_type) }}<img
                                                src="{{ asset('vendors/images/download.png') }}" width="15"
                                                class="mx-2"></a>
                                    </div>
                                @endforeach
                            @endisset
                            @isset($attachmentGroups['LOWER_JAW'])
                                @foreach ($attachmentGroups['LOWER_JAW'] as $attachment)
                                    @php($image = storageUrl_h($attachment->path . $attachment->name))
                                    <div class="col-md-3 text-center my-3">
                                        <img src="{{ asset('vendors/images/stl.png') }}" style="width: 100%;height:80%;">
                                        <a href="{{ $image }}" target="_blank" download="{{ $image }}"
                                            style="font-size: 11px;font-family: 'Inter';line-height: 25px;font-weight: 700;">{{ ucwords($attachment->attachment_type) }}
                                            <img src="{{ asset('vendors/images/download.png') }}" width="15"
                                                class="mx-2"></a>
                                    </div>
                                @endforeach
                            @endisset
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 ">
                <div class="row py-3 border borderround m-2">
                    <div class="col-md-12 crowding borderbottom pb-3">
                        <h5>Attach URL</h5>
                        <a href="{{ $edit_values->embedded_url }}"
                            style="text-decoration: underline;">{!! $edit_values->embedded_url !!}</a>
                    </div>
                    @isset($attachmentGroups['OTHER'])
                        @foreach ($attachmentGroups['OTHER'] as $attachment)
                            @php($image = storageUrl_h($attachment->path . $attachment->name))
                            @if ($attachment->sort_order == 1)
                                <div class="col-md-12 mt-3">
                                    <h5>Patient Consent form</h5>
                                    <div class="row">
                                        <div class="col-md-3 text-center my-3">
                                            <img src="{{ storageUrl_h('images/file.png') }}"
                                                title="{{ $attachment->name }}">
                                            <a href="{{ $image }}" target="_blank"
                                                download="{{ $image }}">Download <img
                                                    src="{{ asset('vendors/images/download.png') }}" width="15"
                                                    class="mx-2"></a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if ($attachment->sort_order == 2)
                                <div class="col-md-12 bordertop pt-3 mt-3">
                                    <h5>Other files</h5>
                                    <div class="row">
                                        <div class="col-md-3 text-center my-3">
                                            <img src="{{ storageUrl_h('images/file.png') }}"
                                                title="{{ $attachment->name }}">
                                            <a href="{{ $image }}" target="_blank"
                                                download="{{ $image }}">Download <img
                                                    src="{{ asset('vendors/images/download.png') }}" width="15"
                                                    class="mx-2"></a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endisset
                </div>
            </div>

        </div>
    </div>
</div>
</div>
    <!-- js -->
    <script src="{{ asset('vendors/scripts/core.js') }} "></script>
    <script src="{{ asset('vendors/scripts/script.min.js') }} "></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>

    <script>
        function bndka() {
            $('.pop1').removeClass('d-none');

        }


        function bndka1() {
            $('.pop1').addClass('d-none');
            $('.pop3').addClass('d-none');
            $('.pop4').addClass('d-none');
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
    @if (isset($order))
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
                                                <th style="font-size: 10px!important;" class="case_empty"
                                                    id="case_id">2</th>
                                                <td style="font-size: 8px!important;">Order ID:</td>
                                                <th style="font-size: 10px!important;" class="case_empty"
                                                    id="order_id">1</th>
                                                <td style="font-size: 8px!important;">Dentist’s Name:</td>
                                                <th style="font-size: 10px!important;" class="case_empty"
                                                    id="dentist_name">Mujtaba Fatih</th>
                                                <td style="font-size: 8px!important;">Number of trays:</td>
                                                <th style="font-size: 10px!important;" class="case_empty"
                                                    id="no_of_tray">10</th>
                                                <td style="font-size: 8px!important;">Shipping Charges:</td>
                                                <th style="font-size: 10px!important;" class="case_empty"
                                                    id="shipping_charges">0 AED</th>
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
                                                {{ csrf_field() }}
                                                @method('PUT')
                                                <h5 class="textcolor px-2">Order Status</h5>
                                        </div>
                                        <div class="col-md-12  mt-3 p-0 ">
                                            <div class="maindo table-responsive">
                                                <table class="table">
                                                    <thead class="bxtekdo brdall" style="background-color: #f4f5f8;">
                                                        <td>
                                                            <img src="{{ asset('vendors/images/aligner.png') }}"
                                                                width="50" height="20">
                                                        </td>

                                                        <!-- <th style="font-size: 8px!important;">
                                                Aligner
                                                <br> <span style="font-size:8px;font-weight: 300;" id="unit_price">Unit Price:</span><span class="case_empty" id="unit_price"> 99 AED </span>
                                            </th> -->
                                                        <td style="font-size: 13px!important;">

                                                            <br> <span style="font-size:13px;font-weight: 300;">
                                                                Quantity:</span><span class="case_empty"
                                                                id="quantity">1</span>
                                                        </td>
                                                        {{-- <th style="font-size: 8px!important;">
                                                <br> <span style="font-size:8px;font-weight: 300;">Shipping:</span><span class="case_empty" id="shipping2">10 AED<span>
                                            </th>     --}}
                                                        <td style="font-size: 13px!important;">
                                                            <span style="font-size:13px;font-weight: 300;"> </span>



                                                        </td>
                                                        <td style="font-size: 13px!important;">

                                                            <br> <span style="font-size:13px;font-weight: 300;"> Total
                                                                Price:</span><span class="case_empty"
                                                                id="total_price"> 99 AED </span>

                                                        </td>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>

                                        <div class="col-md-12  mt-3 p-0 ">
                                            <div class="row">
                                                <div class="col-md-6 mb-4 bold ">
                                                    <span>Status</span>
                                                    <select name="status" class="form-select form-control"
                                                        id="select_box" disabled>
                                                        <option value="PENDING" id="pending">
                                                            {{ ucfirst(strtolower('PENDING')) }} </option>
                                                        <option value="CONFIRMED" id="confirmed">
                                                            {{ ucfirst(strtolower('CONFIRMED')) }}</option>
                                                        <option value="DISPATCHED" id="dispatch">
                                                            {{ ucfirst(strtolower('DISPATCHED')) }}</option>
                                                        <option value="DELIVERED" id="delivred">
                                                            {{ ucfirst(strtolower('DELIVERED')) }}</option>
                                                        <option value="CANCELED" id="canceled">
                                                            {{ ucfirst(strtolower('CANCELED')) }}</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 bold enterurl">
                                                    <span>Enter URL</span>
                                                    <input type="" name="order_url" class="form-control"
                                                        placeholder="Link" id="url" disabled>
                                                    <img src="{{ asset('vendors/images/link.png') }}"
                                                        style="background-color:white;">
                                                </div>

                                            </div>
                                        </div>
                                        <!-- <div class="col-md-12 p-0">
                                    <a class="bgcolor float-right updateimg text-white py-2 px-3" id="update" style="cursor:pointer">Update <img src="{{ asset('vendors/images/update.png') }}" class="mt-1"></a>
                                </div> -->

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
                                            <p
                                                style="display: inline;font-size: 12px; display: inline;color: #8c8d8d;">
                                                Email:

                                            </p>
                                            <span id="email" class="case_empty">
                                                Test@gmail.com
                                            </span>

                                        </div>
                                        <div class="col-md-12 mt-1 addressdo ">
                                            <p
                                                style="display: inline;font-size: 12px;     display: inline;color: #8c8d8d;">
                                                Phone:
                                            </p>
                                            <span id="phone" class="case_empty">
                                                +9236562356
                                            </span>

                                        </div>
                                        <div class="col-md-12 mt-1 addressdo  my-2">

                                            <div class="">
                                                <p
                                                    style="display: inline;font-size: 12px;     display: inline;color: #8c8d8d;">
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
                                                    <p
                                                        style="display: inline;font-size: 12px;     display: inline;color: #8c8d8d;">
                                                        Country:</p>
                                                    <span id="country" class="case_empty">
                                                        UAE
                                                    </span>

                                                </div>
                                                <div class="col-md-12 mt-1 addressdo">
                                                    <p
                                                        style="display: inline;font-size: 12px;     display: inline;color: #8c8d8d;">
                                                        State:
                                                    </p>
                                                    <span id="state" class="case_empty">Fujairah
                                                    </span>

                                                </div>
                                                <div class="col-md-12 mt-1 addressdo ">
                                                    <p
                                                        style="display: inline;font-size: 12px;     display: inline;color: #8c8d8d;">
                                                        City:
                                                    </p>
                                                    <span style="color:black;" id="city" class="case_empty">
                                                        Dibba Al-Fujairah
                                                    </span>

                                                </div>
                                                <div class="col-md-12 mt-1 addressdo ">
                                                    <p
                                                        style="display: inline;font-size: 12px;     display: inline;color: #8c8d8d;">
                                                        Address:
                                                    </p>
                                                    <span style="color:black;" id="address" class="case_empty">
                                                        Itaque est amet sit deserunt repudiandae velit in consectetur
                                                        minus qui
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

    <!-- /*______________pop up form______________*/ -->
    <div class="pop3 d-none"id="payment" style="overflow:scroll;">
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
                                <span style="font-weight:bold;font-size: 13px;" id="item_name">Clears Aligner</span>
                            </div>
                            <div class="col-md-6 px-2 p-0 aresure  bold m-auto">
                                <h6 class="t text-dark ">
                                    <input type="hidden" name="payment_price_actual">
                                    <p class="mt-3 d-inline float-right">

                                        Total Price: <span style="font-weight:bold;font-size: 15px;"
                                            class="total_price" id="payment_price"> {{ $installment_amount }}
                                            {{ strtoupper($currency) }}</span></p>
                            </div>


                        </div>
                        <div class="row address">
                            <div class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-12 address"
                                style="padding:20px !important;">
                                <label class="text-dark address">Clinic Address<span class="required">*</span></label>
                                <select selected class="select2 form-control address" id="address_id"
                                    name="address_id" required>
                                    <option value="SelectAddress">Select Address</option>
                                    @foreach ($ClinicDoctors as $ClinicDoctor)
                                        @isset($ClinicDoctor->clinic)
                                            <option value="{{ $ClinicDoctor->clinic->address_id }}">
                                                {{ ucwords($ClinicDoctor->clinic->name) }}</option>
                                        @endisset
                                    @endforeach
                                </select>

                            </div>
                        </div>
                        <div class="row mt-4 bordertop ">
                            <div class="col-md-12 p-2 p-0 aresure bold m-auto">
                                <h6 class="t text-dark mt-3">
                                    Payment Details
                                </h6>
                                <p>Select Payment Method</p>
                                <select selected class="form-select form-control" id="payment_change">
                                    <option value="stripe">Card Payment </option>
                                    <option value="invoice">Cheque/Cash</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-4 bordertop stripe-div">
                            <div class="col-md-12 p-2 p-0 aresure  bold m-auto">
                                <p class="t text-dark">Card Number</p>
                                <div class="row">
                                    <div class="col-md-3 col p-2 px-3">
                                        <div class="payment">

                                            <div class="cardwidth" style="width:35px;">
                                                <input type="text" maxlength="1" name="1" id="c_1"
                                                    value=""class="form-control number_val" placeholder="-">
                                            </div>
                                            <div class="cardwidth" style="width:35px;">
                                                <input type="text" maxlength="1" name="2" id="c_2"
                                                    value="" class="form-control number_val" placeholder="-">
                                            </div>
                                            <div class="cardwidth" style="width:35px;">
                                                <input type="text" maxlength="1" name="3" id="c_3"
                                                    value=""class="form-control number_val" placeholder="-">
                                            </div>
                                            <div class="cardwidth" style="width:35px;">
                                                <input type="text" maxlength="1" name="4" id="c_4"
                                                    value="" class="form-control number_val" placeholder="-">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col p-2 px-3">
                                        <div class="payment">
                                            <div class="cardwidth" style="width:35px;">
                                                <input type="text" maxlength="1" name="5" id="c_5"
                                                    value="" class="form-control number_val" placeholder="-">
                                            </div>
                                            <div class="cardwidth" style="width:35px;">
                                                <input type="text" maxlength="1" name="6" id="c_6"
                                                    value="" class="form-control number_val" placeholder="-">
                                            </div>
                                            <div class="cardwidth" style="width:35px;">
                                                <input type="text" maxlength="1" name="7" id="c_7"
                                                    value="" class="form-control number_val" placeholder="-">
                                            </div>
                                            <div class="cardwidth" style="width:35px;">
                                                <input type="text" maxlength="1" name="8" id="c_8"
                                                    value="" class="form-control number_val" placeholder="-">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-3 col p-2 px-3">
                                        <div class="payment">
                                            <div class="cardwidth" style="width:35px;">
                                                <input type="text" maxlength="1" name="9" id="c_9"
                                                    value="" class="form-control number_val" placeholder="-">
                                            </div>
                                            <div class="cardwidth" style="width:35px;">
                                                <input type="text" maxlength="1" name="10" id="c_10"
                                                    value="" class="form-control number_val" placeholder="-">
                                            </div>
                                            <div class="cardwidth" style="width:35px;">
                                                <input type="text" maxlength="1" name="11" id="c_11"
                                                    value="" class="form-control number_val" placeholder="-">
                                            </div>
                                            <div class="cardwidth" style="width:35px;">
                                                <input type="text" maxlength="1" name="12" id="c_12"
                                                    value="" class="form-control number_val" placeholder="-">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col p-2 px-3">
                                        <div class="payment">
                                            <div class="cardwidth" style="width:35px;">
                                                <input type="text" maxlength="1" name="13" id="c_13"
                                                    value="" class="form-control number_val" placeholder="-">
                                            </div>
                                            <div class="cardwidth" style="width:35px;">
                                                <input type="text" maxlength="1" maxlength="1" name="14"
                                                    id="c_14" value="" class="form-control number_val"
                                                    placeholder="-">
                                            </div>
                                            <div class="cardwidth" style="width:35px;">
                                                <input type="text" maxlength="1" name="15" id="c_15"
                                                    value="" class="form-control number_val" placeholder="-">
                                            </div>
                                            <div class="cardwidth" style="width:35px;">
                                                <input type="text" maxlength="1" name="16" id="c_16"
                                                    value=""class="form-control number_val" placeholder="-">
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
                        <button class="btn  text-white bgcolor float-right d-none"
                            id="pay_now_invoice">Submit</button>
                        <button class="btn  text-white bgcolor float-right stripe-div" id="pay_now"
                            style="margin-top: 17px;">Pay Now</button>
                        <a class="btn cancelbtn  text-white  float-right stripe-div" onclick="bndka1();">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" name="" id="check_payment" />

    <form id="stripe_form">
        <input type="hidden" name="" id="order_payment" />
        <input type="hidden" name="" id="order_currency" />
        <input type="hidden" name="" id="stripe_token" />
        <input type="hidden" name="" id="aligner_kit_price" />
        <input type="hidden" value="{{ $edit_values->no_of_trays }}" name="" id="no_of_trays" />
        <input type="hidden" name="" value="0" id="shipping_charges" />
    </form>
    <script>
        var base_url = "{{ url('doctor') }}";
        var adminBase_url = "{{ url('admin/') }}";
        /*  _____________________Stripe Payment Ajax_____________________ */


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
                            //  var id=$('#order_case_id').val();
                            var payment = $('#order_payment').val();
                            var currency = $('#order_currency').val();
                            var aligner_kit_price = $('#aligner_kit_price').val();
                            var shipping_charges = $('#shipping_charges').val();
                            var no_of_trays = $('#no_of_trays').val();


                            if (currency === '') {
                                toastr.error('Currency is not mentioned, Try again', '', {
                                    timeOut: 2000
                                });
                                return;
                            }


                            if (check == 'first') {
                                var address_id = $('#address_id').val();

                                if (address_id == "SelectAddress" || address_id === "") {
                                    toastr.error('Please Select Clinic from the dropdown', {
                                        timeOut: 3000
                                    });
                                    return;
                                }
                                if (shipping_charges === '') {
                                    toastr.error('Shipping chrages are not mentioned, Try again', '', {
                                        timeOut: 2000
                                    });
                                    return;
                                }

                                $.ajax({
                                    type: "POST",
                                    url: base_url + "/case/agree_order/store_new",
                                    data: {
                                        '_token': '{{ csrf_token() }}',
                                        'id': "{{ $edit_values->id }}",
                                        'total_amount': payment,
                                        'currency': currency,
                                        'stripeToken': token,
                                        'address_id': address_id,
                                        'aligner_kit_price': aligner_kit_price,
                                        'no_of_trays': no_of_trays,
                                        'shipping_charges': shipping_charges,
                                    },
                                    beforeSend: function() {
                                        ajaxLoader();
                                    },
                                    success: function(data) {
                                        console.log(data);
                                        if (data.success == 'Payment') {
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
                                    },
                                    error: function(message, error) {
                                        $('#loader').fadeOut();
                                        $.each(message['responseJSON'].errors, function(key, value) {
                                            toastr.error(value, {
                                                timeOut: 3000
                                            });
                                        });
                                    }
                                });
                            } else if (check == 'second') {
                                if (no_of_trays === '') {
                                    toastr.error('No of trays are not mentioned, Try again', '', {
                                        timeOut: 2000
                                    });
                                    return;
                                }
                                $.ajax({
                                    type: "POST",
                                    url: base_url +
                                        "/case/order-aligner/invoice-store/second-installment_new",
                                    data: {
                                        '_token': '{{ csrf_token() }}',
                                        'id': "{{ $edit_values->id }}",
                                        'total_amount': payment,
                                        'stripeToken': token,
                                        'address_id': address_id,
                                        'aligner_kit_price': aligner_kit_price,
                                        'no_of_trays': no_of_trays,
                                        'shipping_charges': shipping_charges,
                                    },
                                    beforeSend: function() {
                                        ajaxLoader();
                                    },
                                    success: function(data) {
                                        if (data.success == 'Payment') {
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
                                    },
                                    error: function(message, error) {
                                        $('#loader').fadeOut();
                                        $.each(message['responseJSON'].errors, function(key, value) {
                                            toastr.error(value, {
                                                timeOut: 3000
                                            });
                                        });
                                    }
                                });
                            } else if (check == 'third') {

                                $.ajax({
                                    type: "POST",
                                    url: base_url + "/case/order-missing-tray/stripe-store_new",
                                    beforeSend: function() {
                                        ajaxLoader();
                                    },
                                    data: {
                                        '_token': '{{ csrf_token() }}',
                                        'id': "{{ $edit_values->id }}",
                                        'total_amount': "{{ $edit_values->no_of_missing_trays * $settings->aligner_kit_price }}",
                                        'aligner_kit_price': aligner_kit_price,
                                        'stripeToken': token,
                                        'address_id': address_id,
                                        'no_of_trays': "{{ $edit_values->no_of_missing_trays }}",
                                        'tray_number': "{{ $edit_values->no_of_missing_trays }}",
                                        'tray_quantity': "{{ $edit_values->no_of_missing_trays }}",
                                        'shipping_charges': shipping_charges,
                                    },
                                    success: function(data) {
                                        if (data.success == 'Payment') {
                                            $('#loader').fadeOut();
                                            toastr.success('Payment Added Successfully', '', {
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
                                    },
                                    error: function(message, error) {
                                        $('#loader').fadeOut();
                                        $.each(message['responseJSON'].errors, function(key, value) {
                                            toastr.error(value, {
                                                timeOut: 3000
                                            });
                                        });
                                    }
                                });
                            } else if (check == 'fourth') {

                                $.ajax({
                                    type: "POST",
                                    url: base_url + "/case/payment/store",
                                    data: {
                                        'id': "{{ $edit_values->id }}",
                                        'amount': payment,
                                        'currency': currency,
                                        'stripeToken': token,
                                    },
                                    beforeSend: function() {
                                        ajaxLoader();
                                    },
                                    success: function(data) {
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
                                    },
                                    error: function(message, error) {
                                        $('#loader').fadeOut();
                                        $.each(message['responseJSON'].errors, function(key, value) {
                                            toastr.error(value, {
                                                timeOut: 3000
                                            });
                                        });
                                    }
                                });

                            } else if (check == 'five') {
                                $.ajax({
                                    type: "POST",
                                    url: base_url + "/case/payment/store_digitalScan",
                                    data: {
                                        'id': "{{ $edit_values->id }}",
                                        'amount': payment,
                                        'currency': currency,
                                        'stripeToken': token,
                                    },
                                    beforeSend: function() {
                                        ajaxLoader();
                                    },
                                    success: function(data) {
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
                                    },
                                    error: function(message, error) {
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

            var check = $('#check_payment').val();
            var payment = $('#order_payment').val();
            var currency = $('#order_currency').val();
            var aligner_kit_price = $('#aligner_kit_price').val();
            var shipping_charges = $('#shipping_charges').val();
            var no_of_trays = $('#no_of_trays').val();


            if (check == 'first') {
                var address_id = $('#address_id').val();

                if (address_id === "" || address_id === "Select Address") {
                    toastr.error('Please Select Clinic from the dropdown', {
                        timeOut: 3000
                    });
                    return;
                }
                $.ajax({
                    type: "POST",
                    url: base_url + "/case/agree_order/store_inovice_new",
                    beforeSend: function() {
                        ajaxLoader();
                    },
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'id': "{{ $edit_values->id }}",
                        'total_amount': payment,
                        'aligner_kit_price': aligner_kit_price,
                        'no_of_trays': no_of_trays,
                        'address_id': address_id,
                        'shipping_charges': shipping_charges,
                    },
                    success: function(data) {
                        if (data.success == 'Payment') {
                            $('#loader').fadeOut();
                            toastr.success('Invoice Added Successfully', '', {
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
                    },
                    error: function(message, error) {
                        $('#loader').fadeOut();
                        $.each(message['responseJSON'].errors, function(key, value) {
                            toastr.error(value, {
                                timeOut: 3000
                            });
                        });
                    }
                });
            } else if (check == 'second') {
                $.ajax({
                    type: "POST",
                    url: base_url + "/case/order-aligner/invoice-store/second-installment-new",
                    beforeSend: function() {
                        ajaxLoader();
                    },
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'id': "{{ $edit_values->id }}",
                        'total_amount': payment,
                        'aligner_kit_price': aligner_kit_price,
                        'no_of_trays': no_of_trays,
                        'address_id': address_id,
                        'shipping_charges': shipping_charges,
                    },
                    success: function(data) {
                        if (data.success == 'Payment') {
                            $('#loader').fadeOut();
                            toastr.success('Invoice Added Successfully', '', {
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
                    },
                    error: function(message, error) {
                        $('#loader').fadeOut();
                        $.each(message['responseJSON'].errors, function(key, value) {
                            toastr.error(value, {
                                timeOut: 3000
                            });
                        });
                    }
                });
            } else if (check == 'third') {
                $.ajax({
                    type: "POST",
                    url: base_url + "/case/order-missing-tray/invoice-store-new",
                    beforeSend: function() {
                        ajaxLoader();
                    },
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'id': "{{ $edit_values->id }}",
                        'total_amount': "{{ $edit_values->no_of_missing_trays * $settings->aligner_kit_price }}",
                        'aligner_kit_price': aligner_kit_price,
                        'no_of_trays': no_of_trays,
                        'address_id': address_id,
                        'shipping_charges': shipping_charges,
                    },
                    success: function(data) {
                        if (data.success == 'Payment') {
                            $('#loader').fadeOut();
                            toastr.success('Invoice Added Successfully', '', {
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
                    },
                    error: function(message, error) {
                        $('#loader').fadeOut();
                        $.each(message['responseJSON'].errors, function(key, value) {
                            toastr.error(value, {
                                timeOut: 3000
                            });
                        });
                    }
                });
            } else if (check == 'fourth') {

                $.ajax({
                    type: "POST",
                    url: base_url + "/case/payment/invoice",
                    beforeSend: function() {
                        ajaxLoader();
                    },
                    data: {
                        'id': "{{ $edit_values->id }}",
                    },
                    success: function(data) {
                        if (data.data = 'success') {
                            $('#loader').fadeOut();
                            toastr.success('Invoice Added Successfully', '', {
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
                    },
                    error: function(message, error) {
                        $('#loader').fadeOut();
                        $.each(message['responseJSON'].errors, function(key, value) {
                            toastr.error(value, {
                                timeOut: 3000
                            });
                        });
                    }
                });

            } else if (check == 'five') {
                $.ajax({
                    type: "POST",
                    url: base_url + "/case/payment/invoice_digitalScan",
                    beforeSend: function() {
                        ajaxLoader();
                    },
                    data: {
                        'id': "{{ $edit_values->id }}",
                    },
                    success: function(data) {
                        if (data.data = 'success') {
                            $('#loader').fadeOut();
                            toastr.success('Invoice Added Successfully', '', {
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
                    },
                    error: function(message, error) {
                        $('#loader').fadeOut();
                        $.each(message['responseJSON'].errors, function(key, value) {
                            toastr.error(value, {
                                timeOut: 3000
                            });
                        });
                    }
                });

            }
        });
    </script>
    <script>
        $(document).on('change', '#payment_change', function(e) {
            if ($(this).val() == 'stripe') {
                $('.stripe-div').show();
                $('#pay_now_invoice').addClass('d-none');
            } else {
                $('.stripe-div').hide();
                $('#pay_now_invoice').removeClass('d-none');
            }
        });

        function open_modal(val) {
            event.preventDefault();
            $('.address').hide();
            if (val == 'first') {
                $('.address').show();
                $('#check_payment').val('first');
                $.ajax({
                    url: '{{ route('doctor.case.agree_order') }}',
                    type: "POST",
                    dataType: 'json',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'id': "{{ $edit_values->id }}"
                    },
                    beforeSend: function() {
                        ajaxLoader();
                    },
                    success: function(responseCollection) {
                        $('#loader').fadeOut();
                        console.log(responseCollection);
                        var currency = responseCollection['settings'].currency;
                        var aligner_kit_price = responseCollection['settings'].aligner_kit_price;
                        var case_fee = responseCollection['settings'].case_fee;
                        var complete_treatment_plan = responseCollection['settings'].complete_treatment_plan;
                        var installment_amount = (complete_treatment_plan - case_fee);
                        var payment_order = (installment_amount / 2) + ' ' + currency;
                        var payment = (installment_amount / 2);

                        responseCollection['ClinicDoctors']
                        $('#payment_price').text(payment_order);
                        $('#order_payment').val(' ');
                        $('#order_payment').val(payment);
                        $('#aligner_kit_price').val(' ');
                        $('#aligner_kit_price').val(aligner_kit_price);

                        $('#order_currency').val(' ');
                        $('#order_currency').val(currency);

                        $('.pop3').removeClass('d-none');
                    },
                    error: function(e) {
                        var responseCollection = e.responseJSON;
                        console.log(e);
                        $('#loader').fadeOut();
                        toastr.error(responseCollection['message'], "Error!", {
                            positionClass: "toast-bottom-left",
                            containerId: "toast-bottom-left"
                        });

                    }
                });
            } else if (val == 'second') {
                $('#check_payment').val('second');
                $.ajax({
                    url: '{{ route('doctor.case.order-aligner.indexSecondInstallment.new') }}',
                    type: "POST",
                    dataType: 'json',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'id': "{{ $edit_values->id }}"
                    },
                    beforeSend: function() {
                        ajaxLoader();
                    },
                    success: function(responseCollection) {
                        $('#loader').fadeOut();
                        console.log(responseCollection);
                        var currency = responseCollection['settings'].currency;
                        var aligner_kit_price = responseCollection['settings'].aligner_kit_price;
                        var case_fee = responseCollection['settings'].case_fee;
                        var complete_treatment_plan = responseCollection['settings'].complete_treatment_plan;
                        var installment_amount = (complete_treatment_plan - case_fee);
                        var payment_order = (installment_amount / 2) + ' ' + currency;
                        var payment = (installment_amount / 2);

                        responseCollection['ClinicDoctors']
                        $('#payment_price').text(payment_order);
                        $('#order_payment').val(' ');
                        $('#order_payment').val(payment);
                        $('#aligner_kit_price').val(' ');
                        $('#aligner_kit_price').val(aligner_kit_price);

                        $('#order_currency').val(' ');
                        $('#order_currency').val(currency);

                        $('.pop3').removeClass('d-none');
                    },
                    error: function(e) {
                        var responseCollection = e.responseJSON;
                        console.log(e);
                        $('#loader').fadeOut();
                        toastr.error(responseCollection['message'], "Error!", {
                            positionClass: "toast-bottom-left",
                            containerId: "toast-bottom-left"
                        });

                    }
                });
            } else if (val == 'second') {
                $('#check_payment').val('second');
                $.ajax({
                    url: '{{ route('doctor.case.order-aligner.indexSecondInstallment.new') }}',
                    type: "POST",
                    dataType: 'json',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'id': "{{ $edit_values->id }}"
                    },
                    beforeSend: function() {
                        ajaxLoader();
                    },
                    success: function(responseCollection) {
                        $('#loader').fadeOut();
                        console.log(responseCollection);
                        var currency = responseCollection['settings'].currency;
                        var aligner_kit_price = responseCollection['settings'].aligner_kit_price;
                        var case_fee = responseCollection['settings'].case_fee;
                        var complete_treatment_plan = responseCollection['settings'].complete_treatment_plan;
                        var installment_amount = (complete_treatment_plan - case_fee);
                        var payment_order = (installment_amount / 2) + ' ' + currency;
                        var payment = (installment_amount / 2);

                        responseCollection['ClinicDoctors']
                        $('#payment_price').text(payment_order);
                        $('#order_payment').val(' ');
                        $('#order_payment').val(payment);
                        $('#aligner_kit_price').val(' ');
                        $('#aligner_kit_price').val(aligner_kit_price);

                        $('#order_currency').val(' ');
                        $('#order_currency').val(currency);

                        $('.pop3').removeClass('d-none');
                    },
                    error: function(e) {
                        var responseCollection = e.responseJSON;
                        console.log(e);
                        $('#loader').fadeOut();
                        toastr.error(responseCollection['message'], "Error!", {
                            positionClass: "toast-bottom-left",
                            containerId: "toast-bottom-left"
                        });

                    }
                });
            } else if (val == 'third') {

                $('#check_payment').val('third');
                $.ajax({
                    url: '{{ route('doctor.case.order-missing-tray.index.new') }}',
                    type: "POST",
                    dataType: 'json',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'id': "{{ $edit_values->id }}"
                    },
                    beforeSend: function() {
                        ajaxLoader();
                    },
                    success: function(responseCollection) {
                        $('#loader').fadeOut();
                        console.log(responseCollection);
                        var currency = responseCollection['settings'].currency;
                        var aligner_kit_price = responseCollection['settings'].aligner_kit_price;
                        var case_fee = responseCollection['settings'].case_fee;
                        var complete_treatment_plan = responseCollection['settings'].complete_treatment_plan;
                        var installment_amount = (complete_treatment_plan - case_fee);
                        var payment_order = (installment_amount / 2) + ' ' + currency;
                        var payment = (installment_amount / 2);
                        var payment =
                            "{{ $edit_values->no_of_missing_trays * $settings->aligner_kit_price }}";
                        //  responseCollection['ClinicDoctors']

                        $('#payment_price').text(payment + ' ' + currency);
                        $('#item_name').text('Missing Aligners');

                        $('#order_payment').val(' ');
                        $('#order_payment').val(payment);
                        $('#aligner_kit_price').val(' ');
                        $('#aligner_kit_price').val(aligner_kit_price);

                        $('#order_currency').val(' ');
                        $('#order_currency').val(currency);

                        $('.pop3').removeClass('d-none');
                    },
                    error: function(e) {
                        var responseCollection = e.responseJSON;
                        console.log(e);
                        $('#loader').fadeOut();
                        toastr.error(responseCollection['message'], "Error!", {
                            positionClass: "toast-bottom-left",
                            containerId: "toast-bottom-left"
                        });
                    }
                });
            } else if (val == "fourth") {

                $('#check_payment').val('fourth');
                $.ajax({
                    url: '{{ url('doctor/case/payment/index_new') }}',
                    type: "POST",
                    dataType: 'json',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'id': "{{ $edit_values->id }}"
                    },
                    beforeSend: function() {
                        ajaxLoader();
                    },
                    success: function(responseCollection) {
                        $('#loader').fadeOut();
                        console.log(responseCollection);
                        var currency = responseCollection.setting.currency;

                        //  responseCollection['ClinicDoctors']

                        $('#payment_price').text(responseCollection.case.processing_fee_amount + currency);
                        $('#item_name').text('Treatment Plan');

                        $('#order_payment').val(' ');
                        $('#order_payment').val(responseCollection.case.processing_fee_amount);
                        //  $('#aligner_kit_price').val(' ');

                        $('#order_currency').val(' ');
                        $('#order_currency').val(currency);
                        $('.pop3').removeClass('d-none');
                    },
                    error: function(e) {
                        var responseCollection = e.responseJSON;
                        $('#loader').fadeOut();
                        toastr.error(responseCollection['message'], "Error!", {
                            positionClass: "toast-bottom-left",
                            containerId: "toast-bottom-left"
                        });
                    }
                });

            } else if (val == "five") {
                $('#check_payment').val('five');
                $.ajax({
                    url: '{{ url('doctor/case/payment/index_new') }}',
                    type: "POST",
                    dataType: 'json',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'id': "{{ $edit_values->id }}"
                    },
                    beforeSend: function() {
                        ajaxLoader();
                    },
                    success: function(responseCollection) {
                        $('#loader').fadeOut();
                        console.log(responseCollection);
                        var currency = responseCollection.setting.currency;

                        //  responseCollection['ClinicDoctors']

                        $('#payment_price').text('1000' + currency);
                        $('#item_name').text('Digital Scan');
                        $('#order_payment').val(responseCollection.case.processing_fee_amount);
                        $('#order_currency').val(currency);
                        $('.pop3').removeClass('d-none');
                    },
                    error: function(e) {
                        var responseCollection = e.responseJSON;
                        $('#loader').fadeOut();
                        toastr.error(responseCollection['message'], "Error!", {
                            positionClass: "toast-bottom-left",
                            containerId: "toast-bottom-left"
                        });
                    }
                });

            }

        }
        /*  Validation Input Fields */
        $('.number_val').on('keyup', function(e) {
            var id = $(this).attr("id");
            var val = $(this).val();

            if (/^\d+$/.test(val) && val.length == 1) {
                $('#' + id).css('border', 'green 2px solid');
            } else {
                $('#' + id).css('border', 'red 2px solid');
            }
        });
        $('#month_year').on('keyup', function(e) {

            var id = $(this).attr("id");
            var val = $(this).val();
            var pattern = /^\d{1,2}\/\d{1,2}$/;

            if (pattern.test(val)) {
                $('#' + id).css('border', 'green 2px solid');
            } else {
                $('#' + id).css('border', 'red 2px solid');
            }
        });

        $('#csv').on('keyup', function(e) {

            var id = $(this).attr("id");
            var val = $(this).val();
            var pattern = /^\d+$/;
            var pattern2 = /^\d{3,4}$/;

            if (pattern.test(val) && pattern2.test(val)) {
                $('#' + id).css('border', 'green 2px solid');
            } else {
                $('#' + id).css('border', 'red 2px solid');
            }
        });

        function view(id) {
            $('#order_id').val(' ');
            $('#order_id').val(id);
            var id_int = (parseInt(id));
            //   alert(id_int);
            $('#order_details').removeClass('d-none');
            $.ajax({
                url: base_url + '/order_edit/' + id_int,
                method: "GET",
                // data: json,
                beforeSend: function() {
                    ajaxLoader();
                },
                success: function(response) {
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
                    $('#shipping_charges').text(response.data.edit_values.shipping_charges +
                        '{{ $default_currency }}');
                    //  console.log(response.data.edit_values.discount);
                    //  if(response.data.edit_values.discount > 0){
                    //      var unit_amount=response.data.edit_values.unit_amout;
                    //      var string_unit=unit_amount.toString();
                    //      var full= string_unit+'<?php echo $default_currency; ?>';
                    //      $('#unit_price').text(full);
                    //  }else{
                    //      var unit_amount=response.data.edit_values.unit_amout - (response.data.edit_values.discount/response.data.edit_values.quantity);
                    //      $('#unit_price').text(unit_amount+'<?php echo $default_currency; ?>');
                    //  }
                    $('#quantity').text(response.data.edit_values.quantity);
                    $('#shipping2').text(response.data.edit_values.shipping_charges + '<?php echo $default_currency; ?>');
                    $('#total_price').text(response.data.edit_values.total_amount + '<?php echo $default_currency; ?>');
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
                },
                error: function(xhr, status, error) {
                    // Handle errors
                    toastr.error('Something Went Wrong, Try Again', '', {
                        timeOut: 2000
                    });
                    $('#order_details').addClass('d-none');
                    $('#loader').fadeOut();
                }
            });
        }
        // $('#agree_order').on('click',function(e){
        //       e.preventDefault();
        //       $('#check_payment').val('first');
        // });
    </script>
    <script>
        $("body").on("click", "#advice_comment_button", function() {

            var advice_comment = $("#advice_comment").val();

            var data = {
                _token: '{{ csrf_token() }}',
                case_id: "{{ $edit_values->id }}",
                message: advice_comment
            }

            $.ajax({
                url: '{{ route('doctor.case.add-advice') }}',
                type: "POST",
                dataType: 'json',
                data: data,
                beforeSend: function() {
                    ajaxLoader();
                },
                success: function(responseCollection) {
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
                    // if(responseCollection['data']['concern'].message_by=='ADVISER')

                    //                  $html=`<div class="col-md-12 remove_ajax">
                //                        <div class="row mt-3 m-0">
                //                            <div class="col-md-1 p-0 ">
                //                                <div class="proimgda mx-2">
                //                                <img src="{{ asset('vendors/images/logo.png') }}">

                //                                </div>
                //                            </div>
                //                            <div class="col-md-9 p-0 ">
                //                                <div class="textdo mx-2 p-3">
                //                                    <p> 
                //                                  ${responseCollection['data']['concern'].message}
                //                                    </p>
                //                                    <span style="font-size: 13px;color: #afafaf;">
                //                                    ${hours+':'+minutes+' '+ meridiem}
                //                                    </span>
                //                                </div>
                //                            </div>
                //                        </div>
                //                    </div>`;
                    //     else{

                    //                    $html =`<div class="col-md-12 remove_ajax">
                //                        <div class="row mt-3">
                //                            <div class="col-md-2 p-0 ">
                //                            </div>
                //                            <div class="col-md-9 p-0 myapp ">
                //                                <div class=" text-white mx-2 p-3">
                //                                    <p>
                //                                    ${responseCollection['data']['concern'].message}
                //                                    </p>
                //                                    <span style="font-size: 13px;color: #afafaf;">
                //                                  ${hours+':'+minutes+' '+ meridiem}
                //                                </span>
                //                                </div>
                //                            </div>
                //                             <div class="col-md-1 p-0 ">
                //                                <div class="proimgda mx-2">
                //                                    <img src="{{ asset('vendors/images/logo.png') }}">
                //                                </div>
                //                             </div>
                //                        </div>
                //                    </div>`;
                    //     }               
                    //      $("#append").append($html);
                    refresh();

                    $("#advice_comment").val('');

                },
                error: function(e) {
                    var responseCollection = e.responseJSON;
                    console.log(e);
                    $('#loader').fadeOut();

                    toastr.error(responseCollection['message'], "Error!", {
                        positionClass: "toast-bottom-left",
                        containerId: "toast-bottom-left"
                    });

                }
            });
        });

        setTimeout(function() {

            refresh();
        }, 5000);

        function refresh() {

            $.ajax({
                url: '{{ url('doctor/case/get-advices') }}',
                type: "POST",
                dataType: 'json',
                data: {
                    '_token': "{{ csrf_token() }}",
                    'case_id': "{{ $edit_values->id }}"
                },
                success: function(responseCollection) {
                    $('#loader').fadeOut();
                    console.log(responseCollection);
                    $('.remove_ajax').remove();

                    $.each(responseCollection.concern, function(key, value) {
                        console.log(value.id);
                        //    console.log(key + ": " + value);
                        var date = new Date(value.created_at);
                        var time = date.toLocaleTimeString([], {
                            hour: '2-digit',
                            minute: '2-digit'
                        });

                        if (value.message_by == 'PATIENT') {

                            $html = `<div class="col-md-12 remove_ajax">
                       <div class="row ml-0 mr-0 mt-3">
                           <div class="col-md-2 p-1 p-md-0 d-none d-md-block">
                           </div>
                           <div class="col-md-9 col-9 p-1 p-md-0 myapp ">
                               <div class=" text-white mx-2 p-3">
                                   <p>
                                   ${value.message}
                                   </p>
                                   <span style="font-size: 13px;color: #afafaf;">
                                 ${time}
                               </span>
                               </div>
                           </div>
                            <div class="col-md-1 col-3 p-0 ">
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
                           <div class="col-md-2 p-1 p-md-0 d-none d-md-block">
                           </div>
                       </div>
                   </div>`;
                            $("#append").prepend($html);


                        }

                    });
                },
                error: function(e) {
                    var responseCollection = e.responseJSON;
                    console.log(e);
                    $('#loader').fadeOut();

                    toastr.error(responseCollection['message'], "Error!", {
                        positionClass: "toast-bottom-left",
                        containerId: "toast-bottom-left"
                    });

                }
            });

        }
    </script>
