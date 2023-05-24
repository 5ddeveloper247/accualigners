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
            'adminPanel.switch-checkbox',
            'adminPanel.input-mask',
            'adminPanel.datetime-picker',
            'adminPanel.file-input-button',
        ];
        
        $edit_id = false;
        $viewRoute = route('doctor.case.index');
        $form_action = route('doctor.case.store');

        if(Request()->route('case')){
            $edit_id = Request()->route('case');
            $form_action = route('doctor.case.update', $edit_id);
        }
    @endphp

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-12 mb-1">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('doctor.dashbord')}}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{$viewRoute}}">Cases</a></li>
                                <li class="breadcrumb-item active">Case</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">

                <section id="column-visibility">
                        <form class="form-horizontal" method="post" action="{{$form_action}}" enctype="multipart/form-data" novalidate>

                            <div class="row">

                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header  bg-hexagons">
                                            <h4 class="card-title">Case</h4>
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

                                                    

                                                    {{--<div class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-12 <?php if ($errors->has('patient_id')) echo 'error'; ?>">
                                                        <label>Patient</label>
                                                        <div class="controls">
                                                            <select class="select2 form-control" id="patient_id" name="patient_id">
                                                                @isset($Patients)
                                                                    @foreach($Patients as $Patient)
                                                                        <option value="{{$Patient->user_id}}" 
                                                                        @if(isset($edit_values) && $edit_values->patient_id == $Patient->user_id) selected @endif >
                                                                        {{$Patient->user->name}}</option>
                                                                    @endforeach    
                                                                @endisset
                                                            </select>
                                                            @if($errors->has('patient_id'))
                                                                <div class="help-block text-danger patient_id-shopwoo-error">
                                                                    <ul role="alert">
                                                                        <li>{{$errors->first('patient_id')}}</li>
                                                                    </ul>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-12 <?php if ($errors->has('clinic_doctor_id')) echo 'error'; ?>">
                                                        <label>Clinic</label>
                                                        <div class="controls">
                                                            <select class="select2 form-control" id="clinic_doctor_id" name="clinic_doctor_id">
                                                                <option>Select Clinic</option>
                                                                @foreach($ClinicDoctors as $ClinicDoctor)
                                                                    @isset($ClinicDoctor->clinic->name)
                                                                        <option value="{{$ClinicDoctor->id}}" 
                                                                            @if(isset($edit_values) && $edit_values->clinic_doctor_id == $ClinicDoctor->id) selected @endif >
                                                                            {{$ClinicDoctor->clinic->name}}
                                                                        </option>
                                                                    @endisset
                                                                @endforeach
                                                            </select>
                                                            @if($errors->has('clinic_doctor_id'))
                                                                <div class="help-block text-danger clinic_doctor_id-shopwoo-error">
                                                                    <ul role="alert">
                                                                        <li>{{$errors->first('clinic_doctor_id')}}</li>
                                                                    </ul>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>  --}}

                                                    

                                                </div>

                                                <div class="row">

                                                    <div class="form-group col-xl-4 col-lg-4 col-md-4 col-sm-12 <?php if ($errors->has('name')) echo 'error'; ?>">
                                                        <label>Patient's Name <span class="required">*</span></label>
                                                        <div class="controls">
                                                            <input type="text" name="name" id="name" class="form-control" required
                                                                   data-validation-required-message="Name is required"
                                                                   value="{{ old('name', (isset($edit_values->name) ? $edit_values->name : '')) }}">
                                                            @if($errors->has('name'))
                                                                <div class="help-block text-danger name-shopwoo-error">
                                                                    <ul role="alert">
                                                                        <li>{{$errors->first('name')}}</li>
                                                                    </ul>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-xl-4 col-lg-4 col-md-4 col-sm-12 <?php if ($errors->has('email')) echo 'error'; ?>">
                                                        <label>Patient's Email</label>
                                                        <div class="controls">
                                                            <input type="email" name="email" id="email" class="form-control"
                                                                   value="{{ old('email', (isset($edit_values->email) ? $edit_values->email : '')) }}">
                                                            @if($errors->has('email'))
                                                                <div class="help-block text-danger email-shopwoo-error">
                                                                    <ul role="alert">
                                                                        <li>{{$errors->first('email')}}</li>
                                                                    </ul>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-xl-4 col-lg-4 col-md-4 col-sm-12 <?php if ($errors->has('phone_no')) echo 'error'; ?>">
                                                        <label>Patient's Phone No</label>
                                                        <div class="controls">
                                                            <input type="text" name="phone_no" id="phone_no" class="form-control"
                                                                   value="{{ old('phone_no', (isset($edit_values->phone_no) ? $edit_values->phone_no : '')) }}">
                                                            @if($errors->has('phone_no'))
                                                                <div class="help-block text-danger phone_no-shopwoo-error">
                                                                    <ul role="alert">
                                                                        <li>{{$errors->first('phone_no')}}</li>
                                                                    </ul>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-xl-4 col-lg-4 col-md-4 col-sm-12 <?php if ($errors->has('gender')) echo 'error'; ?>">
                                                        <label>Patient's Gender </label>
                                                        <div class="controls">
                                                            
                                                            <select name="gender" id="gender" class="select2 form-control">
                                                                <option value="">Select Gender</option>
                                                                <option value="MALE" @if(isset($edit_values) && $edit_values->gender == "MALE") selected @endif >Male</option>
                                                                <option value="FEMALE" @if(isset($edit_values) && $edit_values->gender == "FEMALE") selected @endif >Female</option>
                                                                <option value="OTHER" @if(isset($edit_values) && $edit_values->gender == "OTHER") selected @endif >Other</option>
                                                            </select>
                                                            @if($errors->has('gender'))
                                                                <div class="help-block text-danger gender-shopwoo-error">
                                                                    <ul role="alert">
                                                                        <li>{{$errors->first('gender')}}</li>
                                                                    </ul>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-xl-4 col-lg-4 col-md-4 col-sm-12 <?php if ($errors->has('dob')) echo 'error'; ?>">
                                                        <label>Patient's DOB</label>
                                                        <div class="controls">
                                                            <input type="text" name="dob" id="dob" class="form-control date-picker" required
                                                                   data-validation-required-message="Date of birth is required"
                                                                   value="{{ old('dob', (isset($edit_values->dob) ? date('m-d-Y', strtotime($edit_values->dob)) : '')) }}">
                                                            @if($errors->has('dob'))
                                                                <div class="help-block text-danger dob-shopwoo-error">
                                                                    <ul role="alert">
                                                                        <li>{{$errors->first('dob')}}</li>
                                                                    </ul>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="row">

                                                    <div class="form-group col-xl-2 col-lg-2 col-md-2 col-sm-12 <?php if ($errors->has('arch_to_treat')) echo 'error'; ?> ">
                                                        <label>Arch to treat <span class="required">*</span></label>
                                                        <div class="controls">
                                                            <input type="checkbox" class="form-control switchBootstrap" name="arch_to_treat" data-on-color="success" data-on-text="Upper" data-off-color="info" data-off-text="Lower" data-label-text="" data-indeterminate="false" 
                                                            @if(old('arch_to_treat', (isset($edit_values->arch_to_treat) && $edit_values->arch_to_treat == "LOWER" ? false : true))) checked @endif/>
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-xl-2 col-lg-2 col-md-2 col-sm-12 <?php if ($errors->has('a_p_relationship')) echo 'error'; ?> ">
                                                        <label>A-P Relationship <span class="required">*</span></label>
                                                        <div class="controls">
                                                            <input type="checkbox" class="form-control switchBootstrap" name="a_p_relationship" data-on-color="success" data-on-text="Maintain" data-off-color="warning" data-off-text="Improve" data-label-text="" data-indeterminate="false" 
                                                            @if(old('a_p_relationship', (isset($edit_values->a_p_relationship) && $edit_values->a_p_relationship == "IMPROVE" ? false : true))) checked @endif/>
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-xl-2 col-lg-2 col-md-2 col-sm-12 <?php if ($errors->has('overjet')) echo 'error'; ?> ">
                                                        <label>Overjet <span class="required">*</span></label>
                                                        <div class="controls">
                                                            <input type="checkbox" class="form-control switchBootstrap" name="overjet" data-on-color="success" data-on-text="Maintain" data-off-color="warning" data-off-text="Improve" data-label-text="" data-indeterminate="false" 
                                                            @if(old('overjet', (isset($edit_values->overjet) && $edit_values->overjet == "IMPROVE" ? false : true))) checked @endif/>
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-xl-2 col-lg-2 col-md-2 col-sm-12 <?php if ($errors->has('overbite')) echo 'error'; ?> ">
                                                        <label>Overbite <span class="required">*</span></label>
                                                        <div class="controls">
                                                            <input type="checkbox" class="form-control switchBootstrap" name="overbite" data-on-color="success" data-on-text="Maintain" data-off-color="warning" data-off-text="Improve" data-label-text="" data-indeterminate="false" 
                                                            @if(old('overbite', (isset($edit_values->overbite) && $edit_values->overbite == "IMPROVE" ? false : true))) checked @endif/>
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-xl-2 col-lg-2 col-md-2 col-sm-12 <?php if ($errors->has('midline')) echo 'error'; ?> ">
                                                        <label>Midline <span class="required">*</span></label>
                                                        <div class="controls">
                                                            <input type="checkbox" class="form-control switchBootstrap" name="midline" data-on-color="success" data-on-text="Maintain" data-off-color="warning" data-off-text="Improve" data-label-text="" data-indeterminate="false" 
                                                            @if(old('midline', (isset($edit_values->midline) && $edit_values->midline == "IMPROVE" ? false : true))) checked @endif/>
                                                        </div>
                                                    </div>

                                                </div>
                                                
                                               {{-- <div class="row">
                                                    <div class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-12 <?php if ($errors->has('impression_kit_order_id')) echo 'error'; ?>">
                                                        <label>Impression Kit (Order ID)</label>
                                                        <div class="controls">
                                                            <select class="select2 form-control" id="impression_kit_order_id" name="impression_kit_order_id">
                                                                @isset($impression_kit_orders)
                                                                    @foreach($impression_kit_orders as $impression_kit_order)
                                                                        <option value="{{$impression_kit_order->id}}" 
                                                                        @if(isset($edit_values) && $edit_values->impression_kit_order_id == $impression_kit_order->id) selected @endif >
                                                                        {{$impression_kit_order->id}}</option>
                                                                    @endforeach    
                                                                @endisset
                                                            </select>
                                                            @if($errors->has('impression_kit_order_id'))
                                                                <div class="help-block text-danger impression_kit_order_id-shopwoo-error">
                                                                    <ul role="alert">
                                                                        <li>{{$errors->first('impression_kit_order_id')}}</li>
                                                                    </ul>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>--}}
                                                <div class="row">

                                                    <div class="form-group col-xl-4 col-lg-4 col-md-4 col-sm-12 <?php if ($errors->has('clinical_comment')) echo 'error'; ?>">
                                                        <label>Clinical Comment <span class="required">*</span></label>
                                                        <div class="controls">
                                                            <textarea type="text" name="clinical_comment" class="form-control" required
                                                                   data-validation-required-message="Clinical Comment is required">{{old('clinical_comment', (isset($edit_values->clinical_comment) ? $edit_values->clinical_comment : ''))}}</textarea>
                                                            @if($errors->has('clinical_comment'))
                                                                <div class="help-block text-danger clinical_comment-shopwoo-error">
                                                                    <ul role="alert">
                                                                        <li>{{$errors->first('clinical_comment')}}</li>
                                                                    </ul>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-xl-4 col-lg-4 col-md-4 col-sm-12 <?php if ($errors->has('prescription_comment')) echo 'error'; ?>">
                                                        <label>Prescription Comment <span class="required">*</span></label>
                                                        <div class="controls">
                                                            <textarea type="text" name="prescription_comment" class="form-control" required
                                                                   data-validation-required-message="Prescription Comment is required">{{old('prescription_comment', (isset($edit_values->prescription_comment) ? $edit_values->prescription_comment : ''))}}</textarea>
                                                            @if($errors->has('prescription_comment'))
                                                                <div class="help-block text-danger prescription_comment-shopwoo-error">
                                                                    <ul role="alert">
                                                                        <li>{{$errors->first('prescription_comment')}}</li>
                                                                    </ul>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-xl-4 col-lg-4 col-md-4 col-sm-12 <?php if ($errors->has('comment')) echo 'error'; ?>">
                                                        <label>Comment <span class="required">*</span></label>
                                                        <div class="controls">
                                                            <textarea type="text" name="comment" class="form-control" required
                                                                   data-validation-required-message="Comment is required">{{old('comment', (isset($edit_values->comment) ? $edit_values->comment : ''))}}</textarea>
                                                            @if($errors->has('comment'))
                                                                <div class="help-block text-danger comment-shopwoo-error">
                                                                    <ul role="alert">
                                                                        <li>{{$errors->first('comment')}}</li>
                                                                    </ul>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="row">

                                                    <div class="form-group col-12">
                                                        <h4>Clinical Conditions <span class="required">*</span></h4>
                                                        <div class="controls">
                                                            @php($old_clinical_conditions = isset($edit_values->clinical_conditions) && !empty($edit_values->clinical_conditions) ? $edit_values->clinical_conditions->pluck('clinical_condition_id')->toArray() : [])
                                                            @foreach ($ClinicalConditions as $ClinicalCondition)
                                                                <label class="col-2">
                                                                    <input type="checkbox" class="" name="clinical_conditions[]" value="{{$ClinicalCondition->id}}"
                                                                    @if( !empty($old_clinical_conditions) && in_array($ClinicalCondition->id, $old_clinical_conditions) ) checked @endif/>
                                                                    {{$ClinicalCondition->name}}
                                                                </label>
                                                            @endforeach
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="row">

                                                    <div class="form-group col-12 <?php if ($errors->has('comment')) echo 'error'; ?>">
                                                        <h4>Image Attachments <span class="required">*</span></h4>
                                                        @for ($i=1;$i<=9;$i++)
                                                            
                                                            @php($img_col = isset($attachments['IMAGE']) ? collect($attachments['IMAGE'])->firstWhere('sort_order', $i) : null)
                                                            @php($media = !empty($img_col) ? $img_col['full_path']  : asset('link/files/app-assets/images/case/images/Base'.$i.'.png'))

                                                            <label class="btn">
                                                                <input type="file" class="hidden upload-attachment" data-type="IMAGE" data-sort="{{$i}}">
                                                                <img src="{{$media}}" id="{{'IMAGE_'.$i}}" alt="Image" class="img-thumbnail">
                                                            </label>    
                                                        @endfor
                                                        
                                                    </div>

                                                    <div class="form-group col-12 <?php if ($errors->has('comment')) echo 'error'; ?>">
                                                        <h4>X-Ray Attachment <span class="required">*</span></h4>
                                                        
                                                        @for ($i=1;$i<=2;$i++)
                                                            
                                                            @php($img_col = isset($attachments['X_RAY']) ? collect($attachments['X_RAY'])->firstWhere('sort_order', $i) : null)
                                                            @php($media = !empty($img_col) ? $img_col['full_path']  : asset('link/files/app-assets/images/case/upload.png'))

                                                            <label class="btn">
                                                                <input type="file" class="hidden upload-attachment" data-type="X_RAY" data-sort="{{$i}}">
                                                                <img src="{{$media}}" id="{{'X_RAY_'.$i}}" alt="Image" class="img-thumbnail">
                                                            </label>    
                                                        @endfor
                                                        

                                                    </div>

                                                    <div class="form-group col-12 <?php if ($errors->has('comment')) echo 'error'; ?>">
                                                        <h4>Jaw scan (Upper & Lower) <span class="required">*</span></h4>
                                                        
                                                        @for ($i=1;$i<=2;$i++)
                                                            @php($jaw_type = $i == 1 ? 'UPPER_JAW' : 'LOWER_JAW')
                                                            
                                                            @php($img_col = isset($attachments[$jaw_type]) ? collect($attachments[$jaw_type])->firstWhere('sort_order', $i) : null)
                                                            @php($media = !empty($img_col) ? $img_col['full_path']  : asset('link/files/app-assets/images/case/jaw/Base'.$i.'.png'))
                                                            
                                                            <label class="btn">
                                                                <input type="file" class="hidden upload-attachment" data-type="{{$jaw_type}}" data-sort="{{$i}}">
                                                                <img src="{{$media}}" id="{{$jaw_type.'_'.$i}}" alt="Image" class="img-thumbnail">
                                                            </label>    
                                                        @endfor
                                                        

                                                    </div>
                                                    <div class="form-group col-12">
                                                        <h4>Embedded URL <span class="required">*</span></h4>
                                                        <input type="url" class="form-control" placeholder="Embedded URL" name="embedded_url">
                                                        

                                                    </div>

                                                    <div class="form-group col-lg-2 col-md-2 col-sm-4 col-12 <?php if ($errors->has('comment')) echo 'error'; ?>" id="other-files">
                                                        <h4>Other Files <span class="required">*</span></h4>
                                                        
                                                        <label class="btn">
                                                            <input type="file" class="hidden upload-attachment" data-type="OTHER" data-sort="1">
                                                            <img src="{{asset('link/files/app-assets/images/case/upload.png')}}" alt="Image" class="img-thumbnail">
                                                        </label>
                                                        {{-- @php($media = isset($attachments['OTHER'][$i-1]) && !empty($attachments['OTHER'][$i-1]) ? $attachments['OTHER'][$i-1]['full_path']  : asset('link/files/app-assets/images/case/upload.png')) --}}

                                                        @if (isset($attachments['OTHER']) && !empty($attachments['OTHER']))
                                                            @foreach ($attachments['OTHER'] as $attachment_other)
                                                                <div class="btn" id="destroy_attachment_{{$attachment_other['id']}}">
                                                                    <a href="{{$attachment_other['full_path']}}" target="_blank">
                                                                        <img src="{{asset("link/files/app-assets/images/file.png")}}" alt="Image" class="img-thumbnail">
                                                                    </a>
                                                                    <br/> <button type="button" class="btn btn-sm btn-block btn-danger destroy_attachment" data-id="{{$attachment_other['id']}}">Delete <i class="ft-trash"></i></button>
                                                                </div>
                                                            @endforeach
                                                        @endif
                                                        

                                                    </div>
                                                    
                                                    <div class="form-group col-lg-3 col-md-3 col-sm-4 col-12 <?php if ($errors->has('comment')) echo 'error'; ?>" id="other-files">
                                                        <h4>Patient Consent Form <span class="required">*</span></h4>
                                                        
                                                        <label class="btn">
                                                            <input type="file" class="hidden upload-attachment" data-type="OTHER" data-sort="1">
                                                            <img src="{{asset('link/files/app-assets/images/case/upload.png')}}" alt="Image" class="img-thumbnail">
                                                        </label>

                                                    </div>

                                                </div>

                                                <input type="hidden" name="attachment_ids" id="attachment_ids"
                                                    value="{{ old('attachment_ids') }}">

                                                <div class="form-actions text-right from-submit-btn">

                                                    @if( $edit_id )
                                                        @method('PUT')
                                                        <button type="submit" class="btn btn-success"><i class="fa-save"></i> Update</button>
                                                        <a href="{{url($viewRoute)}}" class="btn btn-outline-primary primary"><i class="ft-x"></i> Cancel</a>

                                                    @else

                                                        <button type="submit" class="btn btn-primary "><i class="ft-save"></i>Submit</button>
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

@section('extra-script')


<script>

    $(document).ready(function(){

        var case_id = '{{isset($edit_values->id) ? $edit_values->id : ""}}';

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

        function readURL(input, type, sort) {

            var file = input.files[0];
            formData= new FormData();

            formData.append("_token", '{{csrf_token()}}');
            formData.append("case_id", case_id);
            formData.append("attachment", file);
            formData.append("sort_order", sort);
            formData.append("attachment_type", type);

            //$('#'+type+'_'+sort).prop('src', e.target.result);
            console.log(type);
            
            
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
                url: '{{route("doctor.case.upload-attachment")}}',
                type:"POST",
                dataType : 'json',
                data: formData,
                processData: false,
                contentType: false,
                success:function(responseCollection){

                    var full_path = responseCollection['data']['full_path'];
                    var id = responseCollection['data']['id'];

                    if(type == "OTHER"){
                        $file = '<div class="btn" id="destroy_attachment_'+id+'"><a href="'+full_path+'" target="_blank">'
                                +'    <img src="'+full_path+'" alt="Image" class="img-thumbnail"></a>'
                                +'    <br/> <button type="button" class="btn btn-sm btn-block btn-danger destroy_attachment" data-id="'+id+'">Delete <i class="ft-trash"></i></button>'
                                +'</div>';
                        console.log($file);
                        $('#other-files').append($file);
                    }else{
                        $('#'+type+'_'+sort).prop('src', full_path);
                    }

                    var attachment_ids_field = $('#attachment_ids');
                    var attachment_ids = attachment_ids_field.val();
                    attachment_ids_field.val((attachment_ids != "" ? attachment_ids+','+id : id));

                    toastr.success(responseCollection['message'], "Success!", {positionClass: "toast-bottom-left", containerId: "toast-bottom-left"});
                },error:function(e){
                    var responseCollection = e.responseJSON;
                    toastr.error(responseCollection['message'], "Error!", {positionClass: "toast-bottom-left", containerId: "toast-bottom-left"});
                }
            }); //end of ajax
        }

        $('body').on('click', '.destroy_attachment', function(){
            var id = $(this).data('id');

            var data = {
                _token: '{{csrf_token()}}',
                id: id
            };

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
                url:'{{route("doctor.case.destroy-attachment")}}',
                type: "POST",
                dataType: 'json',
                data:data,
                success:function(responseCollection){
                    $("#destroy_attachment_"+id).remove();
                    toastr.success(responseCollection['message'], "Success!", {positionClass: "toast-bottom-left", containerId: "toast-bottom-left"});
                },
                error:function (e) {
                    var responseCollection = e.responseJSON;
                    if(responseCollection['error']){
                        toastr.error(responseCollection['message'],"Error!",{positionClass:"toast-bottom-left",containerId:"toast-bottom-left"});
                    }
                }
            });
        });

        $('body').on('change', '#clinic_doctor_id', function(){
            var clinic_doctor_id = $(this).val();

            var data = {
                _token: '{{csrf_token()}}',
                clinic_doctor_id: clinic_doctor_id
            };

            var PatientSelect = $('#patient_id');
            if(PatientSelect.prop) {
                var options = PatientSelect.prop('options');
            }
            else {
                var options = PatientSelect.attr('options');
            }
            $('option', PatientSelect).remove();
            PatientSelect.append('<option value="">New Patient</option>');

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
                url:'{{route("doctor.case.get-clinic-patients")}}',
                type: "POST",
                dataType: 'json',
                data:data,
                success:function(responseCollection){
                    if(responseCollection['data'].length > 0){
                        $.each(responseCollection['data'], function (key, value) {
                            options[options.length] = new Option(value['name'], value['id']);
                        });
                    }
                },
                error:function (e) {
                    var responseCollection = e.responseJSON;
                    if(responseCollection['error']){
                        toastr.error(responseCollection['message'],"Error!",{positionClass:"toast-bottom-left",containerId:"toast-bottom-left"});
                    }
                }
            });

        });

        $('body').on('change', '#patient_id', function(){
            var patient_id = $(this).val();

            var data = {
                _token: '{{csrf_token()}}',
                patient_id: patient_id
            };

            var impression_kit_order_id = $('#impression_kit_order_id');
            if(impression_kit_order_id.prop) {
                var options = impression_kit_order_id.prop('options');
            }
            else {
                var options = impression_kit_order_id.attr('options');
            }
            $('option', impression_kit_order_id).remove();
            impression_kit_order_id.append('<option>Select Order</option>');

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
                url:'{{route("doctor.case.get-patient-detail")}}',
                type: "POST",
                dataType: 'json',
                data:data,
                success:function(responseCollection){
                    var data = responseCollection['data'];
                    console.log(data);
                    $('#name').val(data['patient']['name']);
                    $('#email').val(data['patient']['email']);
                    $('#phone').val(data['patient']['phone']);
                    //$('#gender').val(data['patient']['gender']);
                    $('#dob').val(data['patient']['dob']);
                    if(data['impression_kit_orders'].length > 0){
                        $.each(data['impression_kit_orders'], function (key, value) {
                            options[options.length] = new Option(value['id'], value['id']);
                        });
                    }
                },
                error:function (e) {
                    var responseCollection = e.responseJSON;
                    if(responseCollection['error']){
                        toastr.error(responseCollection['message'],"Error!",{positionClass:"toast-bottom-left",containerId:"toast-bottom-left"});
                    }
                }
            });

        });

    });

</script>

@stop