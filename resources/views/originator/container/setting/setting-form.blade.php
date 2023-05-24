@extends('originator.root.index')

@section('title', "Setting")


@section('content')
    @php

        $requiredSections = [
            'Header' => 'originator.components.side-nav',
            'Footer' => 'originator.components.footer'
        ];

        $componentsJsCss = [
            'adminPanel.general',
            'adminPanel.validation',
            'adminPanel.switch-checkbox',
            'adminPanel.input-mask',
        ];
        $slug = auth()->user()->role->slug;
        $viewRoute = route($slug.'.setting.index');
        $form_action = route($slug.'.setting.store');

    @endphp

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-xl-6 col-md-6 col-sm-12 ml-auto mr-auto mb-1">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route($slug.'.dashbord')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Setting</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">

                <section id="column-visibility">
                        <form class="form-horizontal" method="post" action="{{$form_action}}" enctype="multipart/form-data" novalidate>

                            <div class="row">

                                <div class="col-xl-6 col-md-6 col-sm-12 ml-auto mr-auto">
                                    <div class="card">
                                        <div class="card-header  bg-hexagons">
                                            <h4 class="card-title">Setting</h4>
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

                                                    <div class="form-group col-12 <?php if ($errors->has('currency')) echo 'error'; ?>">
                                                        <label>Currency <span class="required">*</span></label>
                                                        <div class="controls">
                                                            <input type="text" name="currency" class="form-control" required
                                                                   data-validation-required-message="Currency is required"
                                                                   maxlength="10"
                                                                   data-validation-maxlength-message="Max 10 characters allowed"
                                                                   value="{{ old('currency', $edit_values->currency) }}">
                                                            @if($errors->has('currency'))
                                                                <div class="help-block text-danger currency-shopwoo-error">
                                                                    <ul role="alert">
                                                                        <li>{{$errors->first('currency')}}</li>
                                                                    </ul>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-12 <?php if ($errors->has('impression_kit_price')) echo 'error'; ?>">
                                                        <label>Impression Kit Price <span class="required">*</span></label>
                                                        <div class="controls">
                                                            <input type="text" name="impression_kit_price" class="form-control" required
                                                                   data-validation-required-message="Impression Kit Price is required"
                                                                    data-validation-containsnumber-regex="(\d+)((\.\d{1,2})?)"
                                                                    data-validation-containsnumber-message="No Characters Allowed, Only 2 decimal Numbers"
                                                                   value="{{ old('impression_kit_price', $edit_values->impression_kit_price) }}">
                                                            @if($errors->has('impression_kit_price'))
                                                                <div class="help-block text-danger impression_kit_price-shopwoo-error">
                                                                    <ul role="alert">
                                                                        <li>{{$errors->first('impression_kit_price')}}</li>
                                                                    </ul>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-12 <?php if ($errors->has('aligner_kit_price')) echo 'error'; ?>">
                                                        <label>Clears Aligner Price <span class="required">*</span></label>
                                                        <div class="controls">
                                                            <input type="text" name="aligner_kit_price" class="form-control" required
                                                                   data-validation-required-message="Clears Aligner Price is required"
                                                                    data-validation-containsnumber-regex="(\d+)((\.\d{1,2})?)"
                                                                    data-validation-containsnumber-message="No Characters Allowed, Only 2 decimal Numbers"
                                                                   value="{{ old('aligner_kit_price', $edit_values->aligner_kit_price) }}">
                                                            @if($errors->has('aligner_kit_price'))
                                                                <div class="help-block text-danger aligner_kit_price-shopwoo-error">
                                                                    <ul role="alert">
                                                                        <li>{{$errors->first('aligner_kit_price')}}</li>
                                                                    </ul>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>


                                                   <div class="form-group col-12 <?php if ($errors->has('complete_treatment_plan')) echo 'error'; ?>">
                                                        <label>Complete Plan<span class="required">*</span></label>
                                                        <div class="controls">
                                                            <input type="text" name="complete_treatment_plan" class="form-control" required
                                                                   data-validation-required-message="Case fee is required"
                                                                    data-validation-containsnumber-regex="(\d+)((\.\d{1,2})?)"
                                                                    data-validation-containsnumber-message="No Characters Allowed, Only 2 decimal Numbers"
                                                                   value="{{ old('complete_treatment_plan', $edit_values->complete_treatment_plan) }}">
                                                            @if($errors->has('complete_treatment_plan'))
                                                                <div class="help-block text-danger complete_treatment_plan-shopwoo-error">
                                                                    <ul role="alert">
                                                                        <li>{{$errors->first('complete_treatment_plan')}}</li>
                                                                    </ul>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>




                                                    <div class="form-group col-12 <?php if ($errors->has('case_fee')) echo 'error'; ?>">
                                                        <label>Treatment Plan<span class="required">*</span></label>
                                                        <div class="controls">
                                                            <input type="text" name="case_fee" class="form-control" required
                                                                   data-validation-required-message="Case fee is required"
                                                                    data-validation-containsnumber-regex="(\d+)((\.\d{1,2})?)"
                                                                    data-validation-containsnumber-message="No Characters Allowed, Only 2 decimal Numbers"
                                                                   value="{{ old('case_fee', $edit_values->case_fee) }}">
                                                            @if($errors->has('case_fee'))
                                                                <div class="help-block text-danger case_fee-shopwoo-error">
                                                                    <ul role="alert">
                                                                        <li>{{$errors->first('case_fee')}}</li>
                                                                    </ul>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-12 mx-auto">
                                                        <label>Home Impression Kit <span class="required">*</span></label>
                                                        <div class="controls">
                                                            <input type="checkbox" class="form-control switchBootstrap" name="home_impression_kit_enabled" data-on-color="success" data-on-text="Enabled <i class='la la-check-circle'></i>" data-off-color="warning" data-off-text="Disabled <i class='la la-times-circle'></i>" data-label-text="" data-indeterminate="false" 
                                                            @if(old('home_impression_kit_enabled', $edit_values->home_impression_kit_enabled)) checked @endif/>
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-12 mx-auto">
                                                        <label>Home Appointment <span class="required">*</span></label>
                                                        <div class="controls">
                                                            <input type="checkbox" class="form-control switchBootstrap" name="home_appointment_enabled" data-on-color="success" data-on-text="Enabled <i class='la la-check-circle'></i>" data-off-color="warning" data-off-text="Disabled <i class='la la-times-circle'></i>" data-label-text="" data-indeterminate="false" 
                                                            @if(old('home_appointment_enabled', $edit_values->home_appointment_enabled)) checked @endif/>
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-12 mx-auto">
                                                        <label>Home I Am Candiate <span class="required">*</span></label>
                                                        <div class="controls">
                                                            <input type="checkbox" class="form-control switchBootstrap" name="home_i_am_candiate_enabled" data-on-color="success" data-on-text="Enabled <i class='la la-check-circle'></i>" data-off-color="warning" data-off-text="Disabled <i class='la la-times-circle'></i>" data-label-text="" data-indeterminate="false" 
                                                            @if(old('home_i_am_candiate_enabled', $edit_values->home_i_am_candiate_enabled)) checked @endif/>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="form-actions text-right from-submit-btn">

                                                    <button type="submit" class="btn btn-success"><i class="fa-save"></i> Update</button>

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
