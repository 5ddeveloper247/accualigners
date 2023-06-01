@extends('originator.root.index')

@section('title', "Case")


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
'adminPanel.switchery-checkbox',
'adminPanel.file-input-button',
'adminPanel.input-mask',
'adminPanel.dropzone',
];

$viewRoute = route('admin.case.index');
$setting = setting_h();
$default_currency = $setting->currency;

@endphp
<style>
 .dropzone {
    min-height: 235px !important;
 }
</style>
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-12 col-12 mb-1">
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashbord')}}">Dashboard</a></li>
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

                                <img class="media-object rounded-circle width-100"
                                    src="{{$edit_values->patient->picture}}" alt="User image">
                                <p>{{$edit_values->name}}</p>

                            </div>
                        </div>
                    </div> --}}

                    <div class="col-xl-8 col-md-8 col-sm-12">
                        <div class="card">
                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">
                                    <div class="row" id="concerns_div">
                                        <div class="col-12 mb-2">
                                            <h1 class="card-title">Case Processing Update</h1>
                                        
                                         @if($edit_values->has_concern) <div
                                                class="badge badge-pill badge-border badge-glow border-danger danger badge-square">
                                                Doctor has concern</div>
                                         @endif

                                        </div>

                                        @isset($edit_values->concerns)
                                        @foreach ($edit_values->concerns as $concern)
                         @include('originator.container.case.components.case-concern', ['concern' => $concern])
                                        @endforeach
                                        @endisset
                                    </div>

                                    <div class="row">
                                        <div class="col-12 mb-2">
                                            <hr />
                                            <h2 class="card-title">Add Advice</h2>
                                            <div class="form-group">
                                                <div class="controls">
                                                    <textarea type="text" name="advice_comment" id="advice_comment"
                                                        class="form-control" required
                                                        data-validation-required-message="Comment is required"></textarea>
                                                </div>
                                            </div>
                                            <button type="button" class="btn btn-primary" id="advice_comment_button"><i
                                                    class="ft-plus"></i> Add </button>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">

                                    <div class="row">
                                        <div class="col-12 mb-2">
                                            <h3 class="card-title">Clinical Conditions</h3>
                                            @isset($edit_values->clinical_conditions)
                                            @foreach ($edit_values->clinical_conditions as $clinical_condition)
                                            <div
                                                class="badge badge-pill badge-border badge-glow border-primary primary badge-square">
                                                {{$clinical_condition->clinical_condition->name}}</div>
                                            @endforeach
                                            @endisset
                                        </div>
                                        <div class="col-12 mb-2">
                                            <h3 class="card-title mb-1">Clinical Comments</h3>
                                            {!! $edit_values->clinical_comment !!}
                                        </div>
                                    </div>

                                    <hr />

                                    <div class="row">
                                        <div class="col-12 mb-0">
                                            <h3 class="card-title">Prescription Comment</h3>
                                        </div>

                                        <div class="col-3 mb-1">
                                            <h5 class="card-title mb-0">Arch to treat</h5>
                                            <small>{{$edit_values->arch_to_treat}}</small>
                                        </div>
                                        <div class="col-3 mb-1">
                                            <h5 class="card-title mb-0">A-P Relationship</h5>
                                            <small>{{$edit_values->a_p_relationship}}</small>
                                        </div>
                                        <div class="col-2 mb-1">
                                            <h5 class="card-title mb-0">Overjet</h5>
                                            <small>{{$edit_values->overjet}}</small>
                                        </div>
                                        <div class="col-2 mb-1">
                                            <h5 class="card-title mb-0">Overbite</h5>
                                            <small>{{$edit_values->overbite}}</small>
                                        </div>
                                        <div class="col-2 mb-1">
                                            <h5 class="card-title mb-0">Midline</h5>
                                            <small>{{$edit_values->midline}}</small>
                                        </div>

                                        <div class="col-12 mb-1">
                                            <h5 class="card-title mb-1">Prescription Comment</h5>
                                            {!! $edit_values->prescription_comment !!}
                                        </div>
                                    </div>

                                    <hr />

                                    @php
                                    $attachmentGroups = collect($edit_values->attachments)->groupBy('attachment_type');
                                    //dd($attachmentGroups['IMAGE']);
                                    @endphp

                                    <div class="row">
                                        <div class="col-10 mb-0">
                                            <h3 class="card-title">Image Attachments</h3>
                                        </div>
                                        <div class="col-2 mb-0">                                        
                                        <a href="{{url('admin/case/download-attachment/'.$edit_values->id)}}" class="btn btn-sm btn-success" data-toggle="tooltip" data-original-title="Download All Case Attachments">Download</a>
                                        </div>
                                        @isset($attachmentGroups['IMAGE'])
                                        @foreach ($attachmentGroups['IMAGE'] as $attachment)
                                        @php($image = storageUrl_h($attachment->path.$attachment->name))
                                        @if(strpos($image, 'pdf') !== false)
                                         <div class="col-2 mb-1">
                                            <img src="{{storageUrl_h($attachment->path.'pdf.jpg')}}" class="img-fluid">
                                            <small><a href="{{$image}}" download>Download Images</a></small>
                                        </div>
                                        @elseif((strpos($image, 'stl') !== false))
                                         <div class="col-2 mb-1">
                                            <img src="{{storageUrl_h($attachment->path.'stl.jpg')}}" class="img-fluid">
                                            <small><a href="{{$image}}" download>Download Images</a></small>
                                        </div>
                                        @else
                                        <div class="col-2 mb-1">
                                            <img src="{{$image}}" class="img-fluid">
                                            <small><a href="{{$image}}" download>Download Images</a></small>
                                        </div>
                                        @endif
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
                                         @if(strpos($image, 'pdf') !== false)
                                         <div class="col-2 mb-1">
                                            <img src="{{storageUrl_h($attachment->path.'pdf.jpg')}}" class="img-fluid">
                                            <small><a href="{{$image}}" download>Download Images</a></small>
                                        </div>
                                        @elseif((strpos($image, 'stl') !== false))
                                         <div class="col-2 mb-1">
                                            <img src="{{storageUrl_h($attachment->path.'stl.jpg')}}" class="img-fluid">
                                            <small><a href="{{$image}}" download>Download Images</a></small>
                                        </div>
                                        @else
                                        <div class="col-2 mb-1">
                                            <img src="{{$image}}" class="img-fluid">
                                            <small><a href="{{$image}}" download>Download Images</a></small>
                                        </div>
                                        @endif
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
                                         @if(strpos($image, 'pdf') !== false)
                                         <div class="col-2 mb-1">
                                            <img src="{{storageUrl_h($attachment->path.'pdf.jpg')}}" class="img-fluid">
                                            <small><a href="{{$image}}" download>Download Images</a></small>
                                        </div>
                                        @elseif((strpos($image, 'stl') !== false))
                                         <div class="col-2 mb-1">
                                            <img src="{{storageUrl_h($attachment->path.'stl.jpg')}}" class="img-fluid">
                                            <small><a href="{{$image}}" download>Download Images</a></small>
                                        </div>
                                        @else
                                        <div class="col-2 mb-1">
                                            <img src="{{$image}}" class="img-fluid">
                                            <small><a href="{{$image}}" download>Download Images</a></small>
                                        </div>
                                        @endif
                                        @endforeach
                                        @endisset

                                        @isset($attachmentGroups['LOWER_JAW'])
                                        @foreach ($attachmentGroups['LOWER_JAW'] as $attachment)
                                        @php($image = storageUrl_h($attachment->path.$attachment->name))
                                        @if(strpos($image, 'pdf') !== false)
                                         <div class="col-2 mb-1">
                                            <img src="{{storageUrl_h($attachment->path.'pdf.jpg')}}" class="img-fluid">
                                            <small><a href="{{$image}}" download>Download Images</a></small>
                                        </div>
                                        @elseif((strpos($image, 'stl') !== false))
                                         <div class="col-2 mb-1">
                                            <img src="{{storageUrl_h($attachment->path.'stl.jpg')}}" class="img-fluid">
                                            <small><a href="{{$image}}" download>Download Images</a></small>
                                        </div>
                                        @else
                                        <div class="col-2 mb-1">
                                            <img src="{{$image}}" class="img-fluid">
                                            <small><a href="{{$image}}" download>Download Images</a></small>
                                        </div>
                                        @endif
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
                                         @if(strpos($image, 'pdf') !== false)
                                         <div class="col-2 mb-1">
                                            <img src="{{storageUrl_h($attachment->path.'pdf.jpg')}}" class="img-fluid">
                                            <small><a href="{{$image}}" download>Download Images</a></small>
                                        </div>
                                        @elseif((strpos($image, 'stl') !== false))
                                         <div class="col-2 mb-1">
                                            <img src="{{storageUrl_h($attachment->path.'stl.jpg')}}" class="img-fluid">
                                            <small><a href="{{$image}}" download>Download Images</a></small>
                                        </div>
                                        @else
                                        <div class="col-2 mb-1">
                                            <img src="{{$image}}" class="img-fluid">
                                            <small><a href="{{$image}}" download>Download Images</a></small>
                                        </div>
                                        @endif
                                        @endforeach
                                        @endisset

                                    </div>

                                    <hr />

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


                         {{-- Clears Aligner --}}
                            @isset($edit_values->aligner->created_at)
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-content collapse show">
                                        <div class="card-body card-dashboard">
                                            <div class="row">
                                                <div class="col-12 mb-1">
                                                    <div class="row">
                                                         <div class="col-12">
                                                            <h3 class="card-title float-left mb-0">Order Status</h3>
                                                            <br />
                                                            <small class="float-left">Order #
                                                                {{$edit_values->aligner->id}}</small>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            {{--<div class="float-right">
                                                                <input type="checkbox" name="aligner_kit_delivery"
                                                                    id="aligner_kit_delivery"
                                                                    class="switchery float-right" data-color="primary"
                                                                    @if($edit_values->aligner->status == "DISPATCHED" ||
                                                                $edit_values->aligner->status == "DELIVERED") checked
                                                                disabled @endif >
                                                            </div>
                                                            <br />
                                                            <small class="float-right">Switch If you send kit for
                                                                delivery</small>--}}
                                                            <form class="form-horizontal" method="post" action="{{route('admin.order.update', $edit_values->aligner->id)}}" enctype="multipart/form-data" novalidate>
                                                            {{csrf_field()}}
                                                            @method('PUT')    
                                                            <div class="controls">
                                                                <select name="status" class="select2 form-control">
                                                                    <option value="PENDING" @if($edit_values->aligner->status == "PENDING") selected @endif >{{ucfirst(strtolower('PENDING'))}}</option>
                                                                    <option value="CONFIRMED" @if($edit_values->aligner->status == "CONFIRMED") selected @endif >{{ucfirst(strtolower('CONFIRMED'))}}</option>
                                                                    <option value="DISPATCHED" @if($edit_values->aligner->status == "DISPATCHED") selected @endif >{{ucfirst(strtolower('DISPATCHED'))}}</option>
                                                                    <option value="DELIVERED" @if($edit_values->aligner->status == "DELIVERED") selected @endif >{{ucfirst(strtolower('DELIVERED'))}}</option>
                                                                    <option value="CANCELED" @if($edit_values->aligner->status == "CANCELED") selected @endif >{{ucfirst(strtolower('CANCELED'))}}</option>
                                                                </select>
                                                                <button type="submit" class="btn btn-primary mt-2"><i class="ft-save"></i> Update</button>
                                                            </div>
                                                            </form>    
                                                                
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="col-12 bg-primary p-1 rounded">
                                                    <div class="row">
                                                        <div class="col-3">
                                                            <img src="{{asset("link/files/app-assets/images/impression-kit-icon.png")}}"
                                                                class="img-fluid">
                                                        </div>
                                                        <div class="col-9">
                                                            <h4 class="white mb-0">Aligner Trays Kit</h4>
                                                            <small class="white">{{$edit_values->aligner->status}}</small>
                                                            <br />
                                                            <small class="white">{{date('h:i a',
                                                                strtotime($edit_values->aligner->created_at))}} |
                                                                {{date('d M Y',
                                                                strtotime($edit_values->aligner->created_at))}} | <a style="color: wheat;" href="{{url('admin/order/'.$edit_values->aligner->id.'/edit')}}">Viwe details</a></small>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endisset

                            {{-- Appointment History --}}
                            {{--<div class="col-12">
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
                                                            <img src="{{asset("
                                                                link/files/app-assets/images/calendar.png")}}"
                                                                class="img-fluid">
                                                        </div>
                                                        <div class="col-9">
                                                            <h4 class="white mb-0">{{$appointment->doctor->name}}</h4>
                                                            <small class="white">{{date('h:i a',
                                                                $appointment->appointment_time)}} | {{date('d M Y',
                                                                $appointment->appointment_time)}}</small>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach


                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>--}}

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
                                                            <br />
                                                            <small class="float-left">Order #
                                                                {{$edit_values->impression_kit->id}}</small>
                                                        </div>

                                                        <div class="col-6">
                                                            <div class="float-right">
                                                                <input type="checkbox" name="impression_kit_received"
                                                                    id="impression_kit_received"
                                                                    class="switchery float-right" data-color="primary"
                                                                    @if($edit_values->impression_kit_received == 1)
                                                                checked @endif >
                                                            </div>
                                                            <br />
                                                            <small class="float-right">Switch if you received
                                                                kit</small>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 bg-primary p-1 rounded">
                                                    <div class="row">
                                                        <div class="col-3">
                                                            <img src="{{asset("
                                                                link/files/app-assets/images/impression-kit-icon.png")}}"
                                                                class="img-fluid">
                                                        </div>
                                                        <div class="col-9">
                                                            <h4 class="white mb-0">Impression Kit</h4>
                                                            <small
                                                                class="white">@if($edit_values->impression_kit_received)
                                                                Received @else Pending @endif</small>
                                                            <br />
                                                            <small class="white">{{date('h:i a',
                                                                strtotime($edit_values->impression_kit->created_at))}} |
                                                                {{date('d M Y',
                                                                strtotime($edit_values->impression_kit->created_at))}}</small>
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
                                                            <h3 class="white">{{$edit_values->processing_fee_amount}}
                                                            </h3>
                                                            <small class="white">{{$default_currency}}</small>
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
                                                            <br />
                                                            <small class="white">{{date('h:i a',
                                                                strtotime($edit_values->created_at))}} | {{date('d M Y',
                                                                strtotime($edit_values->created_at))}}</small>
                                                        </div>
                                                    </div>
                                                </div>

                                                @isset($edit_values->aligner->total_amount)
                                                <div class="col-12 bg-primary p-1 rounded mb-1">
                                                    <div class="row">
                                                        <div class="col-4 text-center">
                                                            <h3 class="white">{{$edit_values->aligner->total_amount}}
                                                            </h3>
                                                            <small class="white">{{$default_currency}}</small>
                                                        </div>
                                                        <div class="col-8">
                                                            <h4 class="white mb-0">{{$edit_values->aligner->quantity}}
                                                                Tray Charges</h4>
                                                            <small class="white">
                                                                @if (strtoupper($edit_values->aligner->status) !=
                                                                'PENDING')
                                                                Paid
                                                                @else
                                                                Pending
                                                                @endif
                                                            </small>
                                                            <br />
                                                            <small class="white">{{date('h:i a',
                                                                strtotime($edit_values->aligner->created_at))}} |
                                                                {{date('d M Y',
                                                                strtotime($edit_values->aligner->created_at))}}</small>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endisset


                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Upload Video/GIF Image --}}
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-content collapse show">
                                        <div class="card-body card-dashboard">
                                            <div class="row">
                                                <div class="col-12 mb-1">
                                                    <h3 class="card-title mb-0">Embedded Url</h3>
                                                    <a href="{{ $edit_values->embedded_url }}" target="_blank">{{
                                                        $edit_values->embedded_url }}</a>
                                                </div>
                                                <div class="col-12">
                                                    <h3 class="card-title mb-0">Upload Video/GIF Image</h3>
                                                </div>

                                                <div class="form-group col-12 mt-1">
                                                    <div class="controls">
                                                        <select class="select2 form-control" id="video_type" name="video_type">
                                                             <option value="video_uploaded" 
                                                               @if(!empty($edit_values->
                                                                video_uploaded)) selected @endif >
                                                                Upload Video
                                                             </option>
                                                             <option value="video_embedded" @if(empty($edit_values->
                                                                video_uploaded) && !empty($edit_values->video_embedded))
                                                                selected @endif >Embedded Video
                                                             </option>
                                                        </select>
                                                        @if($errors->has('clinic_id'))
                                                        <div class="help-block text-danger clinic_id-shopwoo-error">
                                                            <ul role="alert">
                                                                <li>{{$errors->first('clinic_id')}}</li>
                                                            </ul>
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>


                                                @if(!empty($edit_values->video_uploaded))
                                                <div class="col-12 videoPlayer video_uploaded">
                                                    @if ($edit_values->video_uploaded_type == 'VIDEO')
                                                    <video id="vid0"
                                                        src="{{storageUrl_h($edit_values->video_uploaded)}}"
                                                        controls="controls" crossorigin="anonymous" class="vid"></video>
                                                    @else
                                                    <img src="{{storageUrl_h($edit_values->video_uploaded)}}"
                                                        class="img-fluid">
                                                    @endif
                                                </div>
                                                <div class="col-12 video_uploaded">
                                                    <button type="button" class="btn btn-block btn-primary"
                                                        id="delete_video"><i class="ft-trash"></i> Remove</button>
                                                </div>

                                                @else
                                                <div class="col-12 p-1 video_uploaded" @if(!empty($edit_values->
                                                    video_embedded)) style="display:none" @endif>
                                                    <form action="{{route('admin.case.upload-video')}}"
                                                        class="dropzone dropzone-area" id="dpz-single-file">
                                                        <input type="hidden" name="case_id"
                                                            value="{{$edit_values->id}}">
                                                        {{@csrf_field()}}
                                                    </form>
                                                </div>
                                                @endif
                                                
                                                <div class="row video_embedded_row"@if(empty($edit_values->video_embedded)) style="display:none" @endif>
                                                
                                                <?php  
                                                $rowCount = 0; 
                                                $videos_embedded = !empty($edit_values->video_embedded) ? json_decode($edit_values->video_embedded) : [];
                                                ?> 
                                               
                                                @forelse($videos_embedded as $key => $video_embedded)
                                              
                                                  <?php  $rowCount++; ?>  
                                                 <div class="input-group col-10 video_embedded video_embedded-col-{{$rowCount}} {{$key > 0 ? 'pt-2' : ''}}">
                                                    <input type="text" class="form-control video_embedded_input"
                                                        placeholder="https://youtu.be/example" name="video_embedded[]"
                                                        value="{{$video_embedded}}">
                                                </div>

                                                <div class="input-group col-2 video_embedded-col-{{$rowCount}} {{$key > 0 ? 'pt-2' : ''}}">
                                                    <div class="input-group-prepend">
                                                     @if($key == 0)
                                                        <button class="btn btn-primary"
                                                                    onclick="add_new_detail_row()" type="button"><i
                                                                        class="ft-plus"></i></button>
                                                     @else
                                                        <button class="btn btn-danger"
                                                        onclick="delete_detail_row('<?php echo 'video_embedded-col-'.$rowCount;  ?>')" type="button"><i
                                                            class="ft-minus"></i></button>
                                                     @endif
                                                    </div>
                                                </div>
                                                @empty
                                                      <div class="input-group col-10 video_embedded">
                                                    <input type="text" class="form-control video_embedded_input"
                                                        placeholder="https://youtu.be/example" name="video_embedded[]">
                                                </div>

                                                <div class="input-group col-2">
                                                    <div class="input-group-prepend">
                                                        <button class="btn btn-primary"
                                                                    onclick="add_new_detail_row()" type="button"><i
                                                                        class="ft-plus"></i></button>
                                                    </div>
                                                </div>      
                                                @endforelse
                                               
                                                </div>
                                                
                                                 <div class="input-group col-12 justify-content-end pt-2">
                                                        <div class="input-group-prepend">
                                                            <button class="btn btn-primary" type="button"
                                                                id="video_embedded_btn">Save Changes</button>
                                                        </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!--Treatment Plan PDF-->
                             <div class="col-12">
                                <div class="card">
                                    <div class="card-content collapse show">
                                        <div class="card-body card-dashboard">
                                            <div class="row">
                                                <div class="col-12">
                                                    <h3 class="card-title mb-0">Add Treatment Plan PDF</h3>
                                                </div>

                                                <div class="col-12 p-1 rounded">
                                                    <div class="row">
                                                        <form id="upload-attachment-form">
                                                        <div class="col-12" id="other-files">
                                                            <div class="form-group">
                                                                <div class="controls">
                                                                     <label class="btn">
                                                                        <input type="file" multiple  name="attachment[]" class="hidden upload-attachment" data-type="TREATMENT-PLAN-PDF" data-sort="1">
                                                                        <img src="{{asset('link/files/app-assets/images/case/upload.png')}}" alt="Image" class="img-thumbnail">
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                         <div class="col-12 m-2">
                                                            <a href="{{url('admin/case/download-attachment/'.$edit_values->id.'?type=TREATMENT-PLAN-PDF')}}" class="btn btn-md btn-success" data-toggle="tooltip" data-original-title="Download Treatment Plan PDF">Download</a>
                                                        </div>
                                                        </form>
                                                    </div>
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
                                                                    <input type="text" name="no_of_trays"
                                                                        id="no_of_trays" class="form-control" required
                                                                        data-validation-required-message="No of trays is required"
                                                                        data-validation-containsnumber-regex="((\d+)?)"
                                                                        data-validation-containsnumber-message="Enter a valid number"
                                                                        value="{{ old('no_of_trays', isset($edit_values) ? $edit_values->no_of_trays : NULL) }}"
                                                                        @if(isset($edit_values->aligner->status) &&
                                                                    strtoupper($edit_values->aligner->status) !=
                                                                    "PENDING") readonly title="Can not update, order has
                                                                    been paid" @endif >
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <button type="button" class="btn btn-primary"
                                                                id="no_of_trays_button"
                                                                @if(isset($edit_values->aligner->status) &&
                                                                strtoupper($edit_values->aligner->status) != "PENDING")
                                                                disabled @endif><i class="ft-save"></i> Submit</button>
                                                        </div>
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
                                                    <h3 class="card-title mb-0">Add Number Of Hours For Wear In (24Hr)
                                                    </h3>
                                                </div>

                                                <div class="col-12 p-1 rounded">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <div class="controls">
                                                                    <input type="text" name="no_of_days" id="no_of_days"
                                                                        class="form-control" required
                                                                        data-validation-required-message="No of hours is required"
                                                                        data-validation-containsnumber-regex="((\d+)?)"
                                                                        data-validation-containsnumber-message="Enter a valid number"
                                                                        value="{{ old('no_of_days', isset($edit_values) ? $edit_values->no_of_days : NULL) }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <button type="button" class="btn btn-primary"
                                                                id="no_of_days_button"><i class="ft-save"></i>
                                                                Submit</button>
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
            </section>

        </div>
    </div>
</div>

@stop

@section('extra-script')

<script>

var count = <?php echo $rowCount; ?>;

function add_new_detail_row() {
    makeid = `video_embedded-col-${Math.floor(Math.random() * 1000) + 1}`;
    $('.video_embedded_row').append(`
            <div class="input-group col-10 video_embedded pt-2 ${makeid}">
                <input type="text" class="form-control video_embedded_input"
                    placeholder="https://youtu.be/example"
                    name="video_embedded[]">
            </div>

            <div class="input-group col-2 video_embedded pt-2 ${makeid}">
                <div class="input-group-prepend">
                    <button class="btn btn-danger"
                        onclick="delete_detail_row('${makeid}')" type="button"><i
                            class="ft-minus"></i></button>
                </div>
            </div>`);
    count += 1;
    return false;
}


function delete_detail_row(id){
    console.log(id);
    $( `.${id}` ).remove();
    return false;
}

    $(document).ready(function () {
            var case_id = '{{isset($edit_values->id) ? $edit_values->id : ""}}';
            $("body").on("change", "#aligner_kit_delivery", function () {

                 if($(this).prop('checked') == true){
                     var data = {
                        _token: '{{csrf_token()}}',
                        case_id: "{{$edit_values->id}}",
                        aligner_kit_delivery: 1
                    }

                    $.ajax({
                        url: '{{route("admin.case.aligner-kit-delivery")}}',
                        type: "POST",
                        dataType: 'json',
                        data: data,
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
                    url: '{{route("admin.case.impression-kit-received")}}',
                    type: "POST",
                    dataType: 'json',
                    data: data,
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
                alert('hello');
                 var inputs = $(".video_embedded_input");
                 var video_embedded = [];
                 for(var i = 0; i < inputs.length; i++){
                    video_embedded.push($(inputs[i]).val());
                 }

                 var data = {
                    _token: '{{csrf_token()}}',
                    case_id: "{{$edit_values->id}}",
                    video_embedded: video_embedded
                 }

                $.ajax({
                    url: '{{route("admin.case.embedded-video")}}',
                    type: "POST",
                    dataType: 'json',
                    data: data,
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
                if(no_of_days == "") {
                    toastr.error(`No of hours is required`, "Error!", {
                            positionClass: "toast-bottom-left",
                            containerId: "toast-bottom-left"
                        });
                }
                else{
                var data = {
                    _token: '{{csrf_token()}}',
                    case_id: "{{$edit_values->id}}",
                    no_of_days: no_of_days
                }

                $.ajax({
                    url: '{{route("admin.case.no-of-days-update")}}',
                    type: "POST",
                    dataType: 'json',
                    data: data,
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
             }
            });

            $("body").on("click", "#no_of_trays_button", function () {

                 var no_of_trays = $("#no_of_trays").val();
                 var data = {
                    _token: '{{csrf_token()}}',
                    case_id: "{{$edit_values->id}}",
                    no_of_trays: no_of_trays
                }

                $.ajax({
                    url: '{{route("admin.case.no-of-trays-update")}}',
                    type: "POST",
                    dataType: 'json',
                    data: data,
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
                    url: '{{route("admin.case.add-advice")}}',
                    type: "POST",
                    dataType: 'json',
                    data: data,
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

            $("body").on("change", "#client_id", function () {

                 var val = $(this).val();

                 var data = {
                    _token: '{{csrf_token()}}',
                    clinic_id: val
                  }

                $.ajax({
                     url: '{{route("admin.get-doctor-by-clinic")}}',
                    //url: '{{url("admin/clinic-doctors")}}/'+val,
                     type: "GET",
                     dataType: 'json',
                     data: data,                   
                    beforeSend: function(){
                     ajaxLoadercount();
                   },
                     success: function (responseCollection) {
                        var doctor_id = $('#doctor_id');
                        doctor_id.empty();
                        $.each(responseCollection['data'], function (i, item) {
                            console.log(item.id,item.doctor.name);
                            doctor_id.append($('<option>', { 
                                value: item.id,
                                text : item.doctor.name 
                            }));
                            //$('#doctor_id').empty().append('<option value="'+item.id+'">'+item.doctor.name+'</option>')
                        });
                        //$("option", "#doctor_id").remove().trigger('change.select2');

                        /*$("#sku_list").append(responseCollection['data']['html']);
                        existingCouponItemIDs.push(val);
                        toastr.success('SKU added successfully', "Success!", {
                            positionClass: "toast-bottom-left",
                            containerId: "toast-bottom-left"
                        });*/

                    }, error: function (e) {
                        var responseCollection = e.responseJSON;
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
                    url: '{{route("admin.case.delete-video")}}',
                    type: "POST",
                    dataType: 'json',
                    data: data,
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
                if(val == 'video_embedded'){
                    $(".video_embedded_row").show();
                    $(".video_uploaded").hide();
                }else{
                    $(".video_embedded_row").hide();
                    $(".video_uploaded").show();
                }

            });
            
            
        $('body').on('change', '.upload-attachment', function(){
            var sort = $(this).data('sort');
            var type = $(this).data('type');
            readURL(this, type, sort);

        });
        
          function readURL(input, type, sort) {

            var file = input.files[0];
            var form = $('#upload-attachment-form');
            formData = new FormData(form[0]);

            formData.append("_token", '{{csrf_token()}}');
            formData.append("case_id", case_id);
            formData.append("sort_order", sort);
            formData.append("attachment_type", type);
            $.ajax({
                 xhr: function() {
                    var xhr = new window.XMLHttpRequest();
            
                    // Upload progress
                    xhr.upload.addEventListener("progress", function(evt){
                        if (evt.lengthComputable) {
                            var percentComplete = evt.loaded / evt.total;
                            //Do something with upload progress
                            console.log(percentComplete);
                            document.querySelector(".progress-bar-ajax").innerHTML  = `${parseInt(percentComplete.toFixed(2) * 100)} %`;
                        }
                   }, false);
                   
                   // Download progress
                   xhr.addEventListener("progress", function(evt){
                       if (evt.lengthComputable) {
                           var percentComplete = evt.loaded / evt.total;
                           // Do something with download progress
                           console.log(percentComplete);
                           document.querySelector(".progress-bar-ajax").innerHTML  = `${parseInt(percentComplete.toFixed(2) * 100)} %`;
                       }
                   }, false);
                   
                   return xhr;
                },
                url: '{{route("admin.case.upload-attachments")}}',
                type:"POST",
                dataType : 'json',
                data: formData,
                processData: false,
                contentType: false,
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

                success:function(responseCollection){
                    toastr.success(responseCollection['message'], "Success!", {positionClass: "toast-bottom-left", containerId: "toast-bottom-left"});
                },error:function(e){
                    var responseCollection = e.responseJSON;
                    toastr.error(responseCollection['message'], "Error!", {positionClass: "toast-bottom-left", containerId: "toast-bottom-left"});
                }
            }); //end of ajax
        }

        });


</script>

@stop