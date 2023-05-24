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
            'adminPanel.validation',
            'adminPanel.select2',
            'adminPanel.switchery-checkbox',
            'adminPanel.file-input-button',
            'adminPanel.input-mask',
            'adminPanel.dropzone',
        ];

        $viewRoute = route('doctor.case.index');
        //$currency = trans('siteConfig.default_currency');

        $currency = $settings->currency;
        $aligner_kit_price = $settings->aligner_kit_price;
        $case_fee = $settings->case_fee;
        $complete_treatment_plan = $settings->complete_treatment_plan;
        $installment_amount = (int) $complete_treatment_plan - (int) $case_fee;
    @endphp

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-12 col-12 mb-1">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('doctor.dashbord')}}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{$viewRoute}}">Cases</a></li>
                                <li class="breadcrumb-item active">Case View</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <div class="row">
                    <div class="col-12 col-md-12">
                        <div class="card">
                            <div class="card-header">
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body pt-0">
                                    <div class="row">
                                        <div class="col-md col-12 text-center">
                                            <p class="text-light lighten-2 mb-0">Case Number</p>
                                            <h5 class="font-large-1 text-bold-400">{{ $edit_values->id }}</h5>
                                            <p class="text-light lighten-2 mb-0">Case Date: <strong>{{date('d-M-Y h:i:s a', $edit_values->created_date)}}</strong></p>
                                        </div>
    
                                        <div
                                            class="col-md col-12 border-right-blue-grey border-right-lighten-5 text-center">
                                            <p class="text-light mb-0">Patient Name</p>
                                            <h5 class="font-large-1 text-bold-400">{{ $edit_values->name }}</h5>
                                        </div>
    
                                        <div
                                            class="col-md col-12 border-right-blue-grey border-right-lighten-5 text-center">
                                            <p class="text-light mb-0">Patient Email</p>
                                            <h5 class="font-large-1 text-bold-400">{{ $edit_values->email }}</h5>
                                        </div>
    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <section id="column-visibility">
                    <div class="row">

                        {{-- <div class="col-12">
                            <div class="row mb-1">
                                <div class="col-12 text-center">

                                    <img class="media-object rounded-circle width-100" src="{{$edit_values->patient->picture}}" alt="User image">
                                    <p>{{$edit_values->name}}</p>
                                    
                                </div>
                            </div> 
                        </div> --}}

                        <div class="col-xl-8 col-md-8 col-sm-12">

                            @if((!empty($edit_values->video_uploaded) || !empty($edit_values->video_embedded)) && !empty($edit_values->no_of_trays) && $edit_values->no_of_trays > 0 )

                                {{-- Video/GIF Image --}}
                                <div class="card">
                                    <div class="card-content collapse show">
                                        <div class="card-body card-dashboard">
                                            <div class="row">
                                                <div class="col-9">
                                                    <h3 class="card-title mb-0">Treatment plan</h3>
                                                </div>
                                                <div class="col-2">
                                                     <a href="{{url('doctor/case/download-attachment/'.$edit_values->id.'?type=TREATMENT-PLAN-PDF')}}" class="btn btn-sm btn-success" data-toggle="tooltip" data-original-title="Download Treatment Plan PDF">Download Treatment Plan</a>
                                                </div>

                                                @if(!empty($edit_values->video_uploaded))
                                                    <div class="col-12 videoPlayer">
                                                        @if ($edit_values->video_uploaded_type == 'VIDEO')
                                                            <video id="vid0" src="{{storageUrl_h($edit_values->video_uploaded)}}" controls="controls" crossorigin="anonymous" class="vid"></video>
                                                        @else
                                                            <img src="{{storageUrl_h($edit_values->video_uploaded)}}" class="img-fluid">
                                                        @endif
                                                    </div>

                                                @elseif (!empty($edit_values->video_embedded))
                                                <?php  
                                                $videos_embedded = !empty($edit_values->video_embedded) ? json_decode($edit_values->video_embedded) : [];
                                                ?>
                                                @forelse($videos_embedded as $key => $video_embedded)
                                                    <div class="col-12 p-1">
                                                        <iframe width="100%" height="450" src="{{$video_embedded}}" title="YouTube video player" frameborder="0" allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture" autoplay allowfullscreen></iframe>
                                                    </div>
                                                @empty
                                                <p class="text-center">No Treatment plan Found</p>
                                                @endforelse
                                                @endif

                                            </div> 
                                        </div>
                                    </div>
                                </div>

                                
                                    <div class="card">
                                        <div class="card-content collapse show">
                                            <div class="card-body card-dashboard">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <h3 class="card-title">Order Clears Aligner</h3>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                                                        <img src="{{asset("link/files/app-assets/images/aligner.png")}}" class="width-100">
                                                    </div>
                                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                                                        <h4 class="card-title mb-1">Clears Aligner</h4>
                                                        <small>Aligner Total Cost: 
                                                            <span style="">{{ $installment_amount . ' '. $currency}}</span> 
                                                        </small>
                                                        <br/>
                                                        <small>No Of Trays: {{$edit_values->no_of_trays}}</small>
                                                        @if($edit_values->status === "first-installment")
                                                        <small>Remaing Payment: {{ $installment_amount / 2 }}</small>
                                                        @endif
                                                    </div>
                                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 text-right mt-2">
                                                        {{ ($edit_values->status === "first-installment") ? $installment_amount / 2 : $installment_amount }} {{$currency}}
                                                    </div>
                                                </div>
                                                <hr/>
                                                <div class="row">
                                                    <div class="col-12 mb-2 mt-2">
                                                        @if (empty($edit_values->aligner_kit_order_id))
                                                        <a href="{{route('doctor.case.order-aligner.index', ['case'=>$edit_values->id])}}" class="btn btn-success">Agree & Order! </a>
                                                        <a href="#advice_comment_section" class="btn btn-danger">Modify?</a>
                                                        @endif
                                                        <a href="{{route('doctor.case.order-missing-tray.index', ['case'=>$edit_values->id])}}" class="btn btn-info alignerMissingBtn">Missing Aligners? </a>
                                                    </div>
                                                    {{--<div class="col-md-12 my-5">
                                                        <div class="label alignerMissingDiv" id="alignerMissingDiv">
                                                            Missing tray?

                                                                <input class="form-control my-1" value="{{$edit_values->no_of_missing_trays}}" id="no_of_missing_trays" type="text" name="no_of_missing_trays" placeholder="Missing Trays">
                                                                <button type="submit" id="btn_no_of_missing_trays" class="btn btn-primary">Submit</button>

                                                        </div>
                                                    </div>--}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                <div class="card" id="advice_comment_section">
                                    <div class="card-content collapse show">
                                        <div class="card-body card-dashboard">
                                            
                                            <div class="row" id="concerns_div">
                                                <div class="col-12 mb-2">
                                                    <h1 class="card-title">Case Processing Update / Concerns</h1>
                                                    @if($edit_values->has_concern) <div class="badge badge-pill badge-border badge-glow border-danger danger badge-square">Dentist has concern</div> @endif

                                                </div>

                                                @isset($edit_values->concerns)
                                                    @foreach ($edit_values->concerns as $concern)
                                                        @include('doctor.container.case.components.case-concern', ['concern' => $concern])
                                                    @endforeach
                                                @endisset
                                            </div>


                                            <div class="row">
                                                <div class="col-12 mb-2">
                                                    <hr/>
                                                    <h2 class="card-title">Add Comments</h2>
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <textarea type="text" name="advice_comment" id="advice_comment" class="form-control" required
                                                                    data-validation-required-message="Comment is required"></textarea>
                                                        </div>
                                                    </div>
                                                    <button type="button" class="btn btn-primary" id="advice_comment_button"><i class="ft-navigation"></i> Add Comments</button>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            @endif

                            <div class="card">
                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">
                                        
                                        <div class="row">
                                            <div class="col-12 mb-2">
                                                <h3 class="card-title">Clinical Conditions</h3>
                                                @isset($edit_values->clinical_conditions)
                                                    @foreach ($edit_values->clinical_conditions as $clinical_condition)
                                                        <div class="badge badge-pill badge-border badge-glow border-primary primary badge-square">{{$clinical_condition->clinical_condition->name}}</div>    
                                                    @endforeach
                                                @endisset
                                            </div>
                                            <div class="col-12 mb-2">
                                                <h3 class="card-title mb-1">Clinical Comments</h3>
                                                {!! $edit_values->clinical_comment !!}
                                            </div>
                                        </div>

                                        <hr/>

                                        <div class="row">
                                            <div class="col-12 mb-0">
                                                <h3 class="card-title">Prescription Comment</h3>
                                            </div>

                                            <div class="col-6 col-md-3 mb-1">
                                                <h5 class="card-title mb-0">Arch to treat</h5>
                                                <small>{{$edit_values->arch_to_treat}}</small>
                                            </div>
                                            <div class="col-6 col-md-3 mb-1">
                                                <h5 class="card-title mb-0">A-P Relationship</h5>
                                                <small>{{$edit_values->a_p_relationship}}</small>
                                            </div>
                                            <div class="col-6 col-md-2 mb-1">
                                                <h5 class="card-title mb-0">Overjet</h5>
                                                <small>{{$edit_values->overjet}}</small>
                                            </div>
                                            <div class="col-6 col-md-2 mb-1">
                                                <h5 class="card-title mb-0">Overbite</h5>
                                                <small>{{$edit_values->overbite}}</small>
                                            </div>
                                            <div class="col-6 col-md-2 mb-1">
                                                <h5 class="card-title mb-0">Midline</h5>
                                                <small>{{$edit_values->midline}}</small>
                                            </div>

                                            <div class="col-6 col-md-12 mb-1">
                                                <h5 class="card-title mb-1">Prescription Comment</h5>
                                                {!! $edit_values->prescription_comment !!}
                                            </div>
                                        </div>

                                        <hr/>

                                        @php
                                            $attachmentGroups = collect($edit_values->attachments)->groupBy('attachment_type');
                                            //dd($attachmentGroups['IMAGE']);
                                        @endphp

                                        <div class="row">
                                            <div class="col-12 mb-0">
                                                <h3 class="card-title">Image Attachments</h3>
                                            </div>
                                            @isset($attachmentGroups['IMAGE'])
                                                @foreach ($attachmentGroups['IMAGE'] as $attachment)
                                                    @php($image = storageUrl_h($attachment->path.$attachment->name))
                                                    <div class="col-12 col-md-2 mb-1">
                                                        <img src="{{$image}}" class="img-fluid">
                                                        <small><a href="{{$image}}" download>Download Images</a></small>
                                                    </div>
                                                @endforeach
                                            @endisset
                                            
                                        </div>

                                        <div class="row">
                                            <div class="col-12 mb-0">
                                                <h3 class="card-title">X-Ray Attachments</h3>
                                            </div>
                                            @isset($attachmentGroups['X_RAY'])
                                                @foreach ($attachmentGroups['X_RAY'] as $attachment)
                                                    @php($image = storageUrl_h($attachment->path.$attachment->name))
                                                    <div class="col-12 col-md-2 mb-1">
                                                        <img src="{{$image}}" class="img-fluid">
                                                        <small><a href="{{$image}}" download>Download Images</a></small>
                                                    </div>
                                                @endforeach
                                            @endisset
                                            
                                        </div>

                                        <div class="row">
                                            <div class="col-12 mb-0">
                                                <h3 class="card-title">Jaw Scan (Upper & Lower)</h3>
                                            </div>
                                            @isset($attachmentGroups['UPPER_JAW'])
                                                @foreach ($attachmentGroups['UPPER_JAW'] as $attachment)
                                                    @php($image = storageUrl_h($attachment->path.$attachment->name))
                                                    <div class="col-12 col-md-2 mb-1">
                                                        <!--<img src="{{$image}}" class="img-fluid">-->
                                                        <small><a href="{{$image}}" download>STL - UPPER JAW (Click to download)</a></small>
                                                    </div>
                                                @endforeach
                                            @endisset

                                            @isset($attachmentGroups['LOWER_JAW'])
                                                @foreach ($attachmentGroups['LOWER_JAW'] as $attachment)
                                                    @php($image = storageUrl_h($attachment->path.$attachment->name))
                                                    <div class="col-12 col-md-2 mb-1">
                                                        <!--<img src="{{$image}}" class="img-fluid">-->
                                                        <small><a href="{{$image}}" download>STL - LOWER JAW (Click to download)</a></small>
                                                    </div>
                                                @endforeach
                                            @endisset
                                            
                                        </div>

                                        <div class="row">
                                            <div class="col-12 mb-0">
                                                <h3 class="card-title">Other Files</h3>
                                            </div>
                                            @isset($attachmentGroups['OTHER'])
                                                @foreach ($attachmentGroups['OTHER'] as $attachment)
                                                    @php($image = storageUrl_h($attachment->path.$attachment->name))
                                                    <div class="col-12 col-md-2 mb-1">
                                                        <img src="{{storageUrl_h('images/file.png')}}" class="img-fluid" title="{{$attachment->name}}">
                                                        <small><a href="{{$image}}" download>Download File</a></small>
                                                    </div>
                                                @endforeach
                                            @endisset
                                            
                                        </div>

                                        <hr/>

                                        <div class="row">
                                            <div class="col-12 mb-1">
                                                <h5 class="card-title mb-1">Comments</h5>
                                                {!! $edit_values->comment !!}
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>

                        
                        <div class="col-xl-4 col-md-4 col-sm-12">

                            <div class="row">
                                {{-- General Information --}}
                                {{-- <div class="col-12">
                                    <div class="card">
                                        <div class="card-content collapse show">
                                            <div class="card-body card-dashboard">
                                                <div class="row">
                                                    <div class="col-12">


                                                        <h3 class="card-title">General Information</h3>
                                                        
                                                        <label>Email</label>
                                                        <p>{{$edit_values->email}}</p>
                                                        
                                                        <label>Phone</label>
                                                        <p>{{$edit_values->phone_no}}</p>
                                                        
                                                        <label>Case Date</label>
                                                        <p>{{date('d-M-Y h:i:s a', $edit_values->created_date)}}</p>

                                                        
                                                    </div>
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}

                                {{-- Appointment History --}}
                                {{-- <div class="col-12">    
                                    <div class="card">
                                        <div class="card-content collapse show">
                                            <div class="card-body card-dashboard">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <h3 class="card-title">Appointment History</h3>
                                                    </div>

                                                    @foreach ($appointments as $appointment)    
                                                        <div class="col-12 bg-primary p-1 rounded mb-1">
                                                            <div class="row">
                                                                <div class="col-3">
                                                                    <img src="{{asset("link/files/app-assets/images/calendar.png")}}" class="img-fluid">
                                                                </div>
                                                                <div class="col-9">
                                                                    <h4 class="white mb-0">{{$appointment->doctor->name}}</h4>
                                                                    <small class="white">{{date('h:i a', $appointment->appointment_time)}} | {{date('d M Y', $appointment->appointment_time)}}</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach


                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                </div>--}}
                                
                                
                                 {{-- Clears Aligner --}}
                                @isset($edit_values->aligner->created_at)
                                <div class="col-12">    
                                    <div class="card">
                                        <div class="card-content collapse show">
                                            <div class="card-body card-dashboard">
                                                <div class="row">
                                                    <div class="col-12 mb-1">
                                                        <div class="row">
                                                            <div class="col-4">
                                                                <h3 class="card-title float-left mb-0">Order Details</h3>
                                                                <br/>
                                                                <small class="float-left">Order # {{$edit_values->aligner->id}}</small>
                                                            </div>
                                                            @if (false)
                                                                <div class="col-8">
                                                                    <div class="float-right">
                                                                        <input type="checkbox" name="aligner_kit_delivery"
                                                                            id="aligner_kit_delivery" class="switchery float-right" data-color="primary"
                                                                            @if($edit_values->aligner->status == "DISPATCHED" || $edit_values->aligner->status == "DELIVERED") checked disabled @endif >
                                                                    </div>
                                                                    <br/>
                                                                    <small class="float-right">Switch If you send kit for delivery</small>
                                                                </div>
                                                            @endif
                                                            
                                                        </div>
                                                    </div>

                                                    <div class="col-12 bg-primary p-1 rounded">
                                                        <div class="row">
                                                            <div class="col-3">
                                                                <img src="{{asset("link/files/app-assets/images/impression-kit-icon.png")}}" class="img-fluid">
                                                            </div>
                                                            <div class="col-9">
                                                                <h4 class="white mb-0">Aligner Trays Kit</h4>
                                                                <small class="white">@if($edit_values->aligner->status == "DISPATCHED" || $edit_values->aligner->status == "DELIVERED") Delivered @else Pending @endif</small>
                                                                <br/>
                                                                <small class="white">{{date('h:i a', strtotime($edit_values->aligner->created_at))}} | {{date('d M Y', strtotime($edit_values->aligner->created_at))}}</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endisset
                                

                                {{-- Impression Kit --}}
                                @isset($edit_values->impression_kit->created_at)
                                    <div class="col-12">    
                                        <div class="card">
                                            <div class="card-content collapse show">
                                                <div class="card-body card-dashboard">
                                                    <div class="row">
                                                        <div class="col-12 mb-1">
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <h3 class="card-title float-left mb-0">Impression Kit</h3>
                                                                    <br/>
                                                                    <small class="float-left">Order # {{$edit_values->impression_kit->id}}</small>
                                                                </div>

                                                                @if (false)
                                                                    <div class="col-6">
                                                                        <div class="float-right">
                                                                            <input type="checkbox" name="impression_kit_received"
                                                                                id="impression_kit_received" class="switchery float-right" data-color="primary"
                                                                                @if($edit_values->impression_kit_received == 1) checked @endif >
                                                                        </div>
                                                                        <br/>
                                                                        <small class="float-right">Switch if you received kit</small>
                                                                    </div>
                                                                @endif
                                                                
                                                            </div>
                                                        </div>

                                                        <div class="col-12 bg-primary p-1 rounded">
                                                            <div class="row">
                                                                <div class="col-3">
                                                                    <img src="{{asset("link/files/app-assets/images/impression-kit-icon.png")}}" class="img-fluid">
                                                                </div>
                                                                <div class="col-9">
                                                                    <h4 class="white mb-0">Impression Kit</h4>
                                                                    <small class="white">@if($edit_values->impression_kit_received) Received @else Pending @endif</small>
                                                                    <br/>
                                                                    <small class="white">{{date('h:i a', strtotime($edit_values->impression_kit->created_at))}} | {{date('d M Y', strtotime($edit_values->impression_kit->created_at))}}</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endisset

                                {{-- Payments --}}
                                <div class="col-12">    
                                    <div class="card">
                                        <div class="card-content collapse show">
                                            <div class="card-body card-dashboard">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <h3 class="card-title">Payments Details</h3>
                                                    </div>

                                                    <div class="col-12 bg-primary p-1 rounded mb-1">
                                                        <div class="row">
                                                            <div class="col-4 text-center">
                                                                <h3 class="white">{{$edit_values->processing_fee_amount}}</h3>
                                                                <small class="white">{{$currency}}</small>
                                                            </div>
                                                            <div class="col-8">
                                                                <h4 class="white mb-0">Digital Model Charges</h4>
                                                                <small class="white">
                                                                    @if ($edit_values->processing_fee_paid)
                                                                        Paid
                                                                    @else
                                                                        Pending
                                                                    @endif
                                                                </small>
                                                                <br/>
                                                                @if(!empty($edit_values->processing_fee_payment_at)) <small class="white">{{date('h:i a', strtotime($edit_values->processing_fee_payment_at))}} | {{date('d M Y', strtotime($edit_values->processing_fee_payment_at))}}</small> @endif
                                                            </div>
                                                        </div>
                                                    </div>

                                                    @isset($edit_values->aligner->total_amount)
                                                        <div class="col-12 bg-primary p-1 rounded mb-1">
                                                            <div class="row">
                                                                <div class="col-4 text-center">
                                                                    <h3 class="white">{{$edit_values->aligner->total_amount}}</h3>
                                                                    <small class="white">{{$currency}}</small>
                                                                </div>
                                                                <div class="col-8">
                                                                    <h4 class="white mb-0">{{$edit_values->aligner->quantity}} Tray Charges</h4>
                                                                    <small class="white">
                                                                        @if (strtoupper($edit_values->aligner->status) != 'PENDING')
                                                                            Paid
                                                                        @else
                                                                            Pending
                                                                        @endif
                                                                    </small>
                                                                    <br/>
                                                                    @if(!empty($edit_values->processing_fee_payment_at)) <small class="white">{{date('h:i a', strtotime($edit_values->aligner->payment_at))}} | {{date('d M Y', strtotime($edit_values->aligner->payment_at))}}</small> @endif
                                                                </div>
                                                            </div>
                                                        </div>    
                                                    @endisset
                                                    
                                                    @if($edit_values->payment_status === "first-installment")
                                                    <a class="btn btn-md btn-success" href="{{route('doctor.case.order-aligner.indexSecondInstallment', ['case'=>$edit_values->id])}}" data-toggle="tooltip" data-original-title="Pay Processing Fee">Pay Remaining Charges</a>
                                                    @endif

                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                {{-- Embedded Url --}}
                                <div class="col-12">    
                                    <div class="card">
                                        <div class="card-content collapse show">
                                            <div class="card-body card-dashboard">
                                                <div class="row">
                                                    <div class="col-12 mb-1">
                                                        <h3 class="card-title mb-0">Embedded Url</h3>
                                                        <a href="{{ $edit_values->embedded_url }}" target="_blank">{{ $edit_values->embedded_url }}</a>
                                                    </div>

                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- No of trays --}}
                                <div class="col-12">    
                                    <div class="card">
                                        <div class="card-content collapse show">
                                            <div class="card-body card-dashboard">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <h3 class="card-title mb-0">Add Number Of Trays Required</h3>
                                                    </div>
 
                                                    <div class="col-12 p-1 rounded">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <div class="controls">
                                                                        <input type="text" name="no_of_trays" id="no_of_trays" class="form-control" required
                                                                                data-validation-required-message="No of trays is required"
                                                                                data-validation-containsnumber-regex="((\d+)?)"
                                                                            data-validation-containsnumber-message="Enter a valid number"
                                                                                value="{{ old('no_of_trays', isset($edit_values) ? $edit_values->no_of_trays : NULL) }}" readonly
                                                                                @if(isset($edit_values->aligner->status) && strtoupper($edit_values->aligner->status) != "PENDING") readonly title="Can not update, order has been paid" @endif >
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @if (false)
                                                                <div class="col-12">
                                                                    <button type="button" class="btn btn-primary" id="no_of_trays_button" @if(isset($edit_values->aligner->status) && strtoupper($edit_values->aligner->status) != "PENDING") disabled @endif ><i class="ft-save"></i> Submit</button>
                                                                </div>    
                                                            @endif
                                                            
                                                        </div>
                                                    </div>

                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- No of Days --}}
                                <div class="col-12">    
                                    <div class="card">
                                        <div class="card-content collapse show">
                                            <div class="card-body card-dashboard">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <h3 class="card-title mb-0">Add Number Of Hours For Wear In (24Hr)</h3>
                                                    </div>
 
                                                    <div class="col-12 p-1 rounded">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <div class="controls">
                                                                        <input type="text" name="no_of_days" id="no_of_days" class="form-control" required
                                                                                data-validation-required-message="No of hours is required"
                                                                                data-validation-containsnumber-regex="((\d+)?)"
                                                                            data-validation-containsnumber-message="Enter a valid number" readonly
                                                                                value="{{ old('no_of_days', isset($edit_values) ? $edit_values->no_of_days : NULL) }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @if (false)
                                                                <div class="col-12">
                                                                    <button type="button" class="btn btn-primary" id="no_of_days_button"><i class="ft-save"></i> Submit</button>
                                                                </div>
                                                            @endif
                                                            
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
                </section>

            </div>
        </div>
    </div>

@stop

@section('extra-script')

    <script>

        $(document).ready(function () {
            $(".alignerMissingDiv").hide();
            $(".alignerMissingBtn").click(function(){
                $(".alignerMissingDiv").show();
            });

            $("body").on("change", "#aligner_kit_delivery", function () {

                if($(this).prop('checked') == true){
                    var data = {
                        _token: '{{csrf_token()}}',
                        case_id: "{{$edit_values->id}}",
                        aligner_kit_delivery: 1
                    }

                    $.ajax({
                        url: '{{route("doctor.case.aligner-kit-delivery")}}',
                        type: "POST",
                        dataType: 'json',
                        data: data,
                        success: function (responseCollection) {
                            
                            toastr.success('Updated successfully', "Success!", {
                                positionClass: "toast-bottom-left",
                                containerId: "toast-bottom-left"
                            });

                            setTimeout(location.reload.bind(location), 500);

                        }, error: function (e) {
                            var responseCollection = e.responseJSON;
                            console.log(e.responseJSON);
                            toastr.error(responseCollection['message'], "Error!", {
                                positionClass: "toast-bottom-left",
                                containerId: "toast-bottom-left"
                            });
                        }
                    }); //end of ajax
                }

            });

            $("body").on("change", "#impression_kit_received", function () {

                var val = $(this).prop('checked') == true ? 1 : 0;

                var data = {
                    _token: '{{csrf_token()}}',
                    case_id: "{{$edit_values->id}}",
                    impression_kit_received: val
                }

                $.ajax({
                    url: '{{route("doctor.case.impression-kit-received")}}',
                    type: "POST",
                    dataType: 'json',
                    data: data,
                    success: function (responseCollection) {
                        
                        toastr.success('Updated successfully', "Success!", {
                            positionClass: "toast-bottom-left",
                            containerId: "toast-bottom-left"
                        });

                        setTimeout(location.reload.bind(location), 500);

                    }, error: function (e) {
                        var responseCollection = e.responseJSON;
                        console.log(e);

                        toastr.error(responseCollection['message'], "Error!", {
                            positionClass: "toast-bottom-left",
                            containerId: "toast-bottom-left"
                        });
                    }
                }); //end of ajax


            });

            $("body").on("click", "#video_embedded_btn", function () {

                var video_embedded = $("#video_embedded").val();

                var data = {
                    _token: '{{csrf_token()}}',
                    case_id: "{{$edit_values->id}}",
                    video_embedded: video_embedded
                }

                $.ajax({
                    url: '{{route("doctor.case.embedded-video")}}',
                    type: "POST",
                    dataType: 'json',
                    data: data,
                    success: function (responseCollection) {
                        
                        toastr.success('Updated successfully', "Success!", {
                            positionClass: "toast-bottom-left",
                            containerId: "toast-bottom-left"
                        });

                    }, error: function (e) {
                        var responseCollection = e.responseJSON;
                        console.log(e);

                        toastr.error(responseCollection['message'], "Error!", {
                            positionClass: "toast-bottom-left",
                            containerId: "toast-bottom-left"
                        });
                    }
                }); //end of ajax


            });

            $("body").on("click", "#no_of_days_button", function () {

                var no_of_days = $("#no_of_days").val();

                var data = {
                    _token: '{{csrf_token()}}',
                    case_id: "{{$edit_values->id}}",
                    no_of_days: no_of_days
                }

                $.ajax({
                    url: '{{route("doctor.case.no-of-days-update")}}',
                    type: "POST",
                    dataType: 'json',
                    data: data,
                    success: function (responseCollection) {
                        
                        toastr.success('Updated successfully', "Success!", {
                            positionClass: "toast-bottom-left",
                            containerId: "toast-bottom-left"
                        });

                    }, error: function (e) {
                        var responseCollection = e.responseJSON;
                        console.log(e);

                        toastr.error(responseCollection['message'], "Error!", {
                            positionClass: "toast-bottom-left",
                            containerId: "toast-bottom-left"
                        });
                    }
                }); //end of ajax


            });

            $("body").on("click", "#no_of_trays_button", function () {

                var no_of_trays = $("#no_of_trays").val();

                var data = {
                    _token: '{{csrf_token()}}',
                    case_id: "{{$edit_values->id}}",
                    no_of_trays: no_of_trays
                }

                $.ajax({
                    url: '{{route("doctor.case.no-of-trays-update")}}',
                    type: "POST",
                    dataType: 'json',
                    data: data,
                    success: function (responseCollection) {
                        
                        toastr.success('Updated successfully', "Success!", {
                            positionClass: "toast-bottom-left",
                            containerId: "toast-bottom-left"
                        });

                    }, error: function (e) {
                        var responseCollection = e.responseJSON;
                        console.log(e);

                        toastr.error(responseCollection['message'], "Error!", {
                            positionClass: "toast-bottom-left",
                            containerId: "toast-bottom-left"
                        });
                    }
                }); //end of ajax


            });

            $("body").on("click", "#advice_comment_button", function () {

                var advice_comment = $("#advice_comment").val();

                var data = {
                    _token: '{{csrf_token()}}',
                    case_id: "{{$edit_values->id}}",
                    message: advice_comment
                }

                $.ajax({
                    url: '{{route("doctor.case.add-advice")}}',
                    type: "POST",
                    dataType: 'json',
                    data: data,
                    success: function (responseCollection) {
                        console.log(responseCollection);
                        toastr.success('Updated successfully', "Success!", {
                            positionClass: "toast-bottom-left",
                            containerId: "toast-bottom-left"
                        });

                        $("#concerns_div").append(responseCollection['data']['html']);
                        $("#advice_comment").val('');

                    }, error: function (e) {
                        var responseCollection = e.responseJSON;
                        console.log(e);

                        toastr.error(responseCollection['message'], "Error!", {
                            positionClass: "toast-bottom-left",
                            containerId: "toast-bottom-left"
                        });
                    }
                }); //end of ajax


            });

            $("body").on("click", "#delete_video", function () {

                var val = $(this).val();

                var data = {
                    _token: '{{csrf_token()}}',
                    case_id: "{{$edit_values->id}}",
                }

                $.ajax({
                    url: '{{route("doctor.case.delete-video")}}',
                    type: "POST",
                    dataType: 'json',
                    data: data,
                    success: function (responseCollection) {
                        
                        toastr.success('Removed successfully', "Success!", {
                            positionClass: "toast-bottom-left",
                            containerId: "toast-bottom-left"
                        });

                        setTimeout(location.reload.bind(location), 500);

                    }, error: function (e) {
                        var responseCollection = e.responseJSON;
                        toastr.error(responseCollection['message'], "Error!", {
                            positionClass: "toast-bottom-left",
                            containerId: "toast-bottom-left"
                        });
                    }
                }); //end of ajax


            });

            $("body").on("change", "#video_type", function () {

                var val = $(this).val();
                console.log(val);
                if(val == 'video_embedded'){
                    $(".video_embedded").show();
                    $(".video_uploaded").hide();
                }else{
                    $(".video_embedded").hide();
                    $(".video_uploaded").show();
                }

            });

        });
        
        
        // $("body").on("click", "#btn_no_of_missing_trays", function () {

        //         var no_of_missing_trays = $("#no_of_missing_trays").val();

        //         var data = {
        //             _token: '{{csrf_token()}}',
        //             case_id: "{{$edit_values->id}}",
        //             no_of_missing_trays: no_of_missing_trays
        //         }

        //         $.ajax({
        //             url: '{{route("doctor.case.missing-tray-update")}}',
        //             type: "POST",
        //             dataType: 'json',
        //             data: data,
        //             success: function (responseCollection) {
                        
        //                 toastr.success('Updated successfully', "Success!", {
        //                     positionClass: "toast-bottom-left",
        //                     containerId: "toast-bottom-left"
        //                 });

        //             }, error: function (e) {
        //                 var responseCollection = e.responseJSON;
        //                 console.log(e);

        //                 toastr.error(responseCollection['message'], "Error!", {
        //                     positionClass: "toast-bottom-left",
        //                     containerId: "toast-bottom-left"
        //                 });
        //             }
        //         }); //end of ajax


        //     });



     document.addEventListener('contextmenu', event => event.preventDefault());

    </script>
    
@stop