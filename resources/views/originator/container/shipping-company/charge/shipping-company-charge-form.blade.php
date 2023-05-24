@extends('originator.root.index')

@section('title', "Charges | Shipping")


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
            'adminPanel.file-input-button',
            'adminPanel.input-mask',
        ];

        $shipping_id = Request()->route('shipping');

        $viewRoute = route('admin.shipping.charge.index', $shipping_id);

        $edit_id = false;
        $form_action = route('admin.shipping.charge.store',$shipping_id);

        if(Request()->route('charge')){
            $edit_id = Request()->route('charge');
            $form_action = route('admin.shipping.charge.update', ['shipping' =>$shipping_id, 'charge' =>$edit_id]);
        }
        
    @endphp

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-12 col-12 mb-1">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashbord')}}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{route('admin.shipping.index')}}">Shipping Companies</a></li>
                                <li class="breadcrumb-item"><a href="{{$viewRoute}}">Shipping Charges</a></li>
                                <li class="breadcrumb-item active">{{ $edit_id ? 'Edit' : 'Add New' }} Shipping Charges</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">

                <section id="column-visibility">
                        <form class="form-horizontal" method="post" action="{{$form_action}}" enctype="multipart/form-data" novalidate>

                            <div class="row">

                                <div class="col-xl-12 col-md-12 col-sm-12">
                                    <div class="card">
                                        <div class="card-header  bg-hexagons">
                                            <h4 class="card-title">Shipping Charges</h4>
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

                                                    <div class="form-group col-xl-4 col-lg-4 col-md-4 col-sm-12 <?php if ($errors->has('country_id')) echo 'error'; ?>">
                                                        <label>Country <span class="required">*</span></label>
                                                        <div class="controls">
                                                            <select class="select2 form-control" id="country_id" name="country_id" required >
                                                                <option value="">Select Country</option>
                                                                @foreach($countries as $country)
                                                                    <option value="{{$country->id}}" 
                                                                    @if(isset($edit_values) && old('country_id', $edit_values->country_id) == $country->id) selected @endif >
                                                                    {{$country->name}}</option>
                                                                @endforeach
                                                            </select>
                                                            @if($errors->has('country_id'))
                                                                <div class="help-block text-danger country_id-shopwoo-error">
                                                                    <ul role="alert">
                                                                        <li>{{$errors->first('country_id')}}</li>
                                                                    </ul>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-xl-4 col-lg-4 col-md-4 col-sm-12 <?php if ($errors->has('state_id')) echo 'error'; ?>">
                                                        <label>State</label>
                                                        <div class="controls">
                                                            <select class="select2 form-control" id="state_id" name="state_id" >
                                                                @isset($states)
                                                                    <option value="">Select State</option>
                                                                    @foreach($states as $state)
                                                                        <option value="{{$state->id}}" 
                                                                        @if(isset($edit_values) && $edit_values->state_id == $state->id) selected @endif >
                                                                        {{$state->name}}</option>
                                                                    @endforeach
                                                                @endisset
                                                            </select>
                                                            @if($errors->has('state_id'))
                                                                <div class="help-block text-danger state_id-shopwoo-error">
                                                                    <ul role="alert">
                                                                        <li>{{$errors->first('state_id')}}</li>
                                                                    </ul>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div> 

                                                    <div class="form-group col-xl-4 col-lg-4 col-md-4 col-sm-12 <?php if ($errors->has('city_id')) echo 'error'; ?>">
                                                        <label>City</label>
                                                        <div class="controls">
                                                            <select class="select2 form-control" id="city_id" name="city_id" >
                                                                @isset($citys)
                                                                    <option value="">Select City</option>
                                                                    @foreach($cities as $city)
                                                                        <option value="{{$city->id}}" 
                                                                        @if(isset($edit_values) && $edit_values->city_id == $city->id) selected @endif >
                                                                        {{$city->name}}</option>
                                                                    @endforeach
                                                                @endisset
                                                            </select>
                                                            @if($errors->has('city_id'))
                                                                <div class="help-block text-danger city_id-shopwoo-error">
                                                                    <ul role="alert">
                                                                        <li>{{$errors->first('city_id')}}</li>
                                                                    </ul>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div> 

                                                    <div class="form-group col-xl-4 col-lg-4 col-md-4 col-sm-12 <?php if ($errors->has('amount')) echo 'error'; ?>">
                                                        <label>Amount <span class="required">*</span></label>
                                                        <div class="controls">
                                                            <input type="text" name="amount" class="form-control" required
                                                                data-validation-required-message="Amount is required"
                                                                data-validation-containsnumber-regex="(\d+)((\.\d{1,2})?)"
                                                                data-validation-containsnumber-message="No Characters Allowed, Only 2 decimal Numbers"
                                                                value="{{ old('amount', isset($edit_values) ? $edit_values->amount : NULL) }}">
                                                            @if($errors->has('amount'))
                                                                <div class="help-block text-danger amount-shopwoo-error">
                                                                    <ul role="alert">
                                                                        <li>{{$errors->first('amount')}}</li>
                                                                    </ul>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-xl-8 col-lg-8 col-md-8 col-sm-12 <?php if ($errors->has('duration_text')) echo 'error'; ?>">
                                                        <label>Delivery Duration Text <span class="required">*</span></label>
                                                        <div class="controls">
                                                            <input type="text" name="duration_text" class="form-control" required
                                                                data-validation-required-message="Delivery Duration Text is required"
                                                                value="{{ old('duration_text', isset($edit_values) ? $edit_values->duration_text : NULL) }}">
                                                            @if($errors->has('duration_text'))
                                                                <div class="help-block text-danger duration_text-shopwoo-error">
                                                                    <ul role="alert">
                                                                        <li>{{$errors->first('duration_text')}}</li>
                                                                    </ul>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="form-actions text-right from-submit-btn">

                                                    @if( $edit_id )
                                                        @method('PUT')
                                                        <button type="submit" class="btn btn-success"><i class="fa-save"></i> Update</button>
                                                        <a href="{{url($viewRoute)}}" class="btn btn-outline-primary primary"><i class="ft-x"></i> Cancel</a>

                                                    @else

                                                        <button type="submit" class="btn btn-primary "><i class="ft-save"></i> Save</button>
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

        $(document).ready(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                }
            });

            $("body").on("change", "#country_id", function () {

                var country_id = $(this).val();
                data = {
                    country_id: country_id
                };

                $.ajax({
                    url: '{{route("admin.get-state-by-country")}}',
                    type: "GET",
                    data: data,
                    dataType: 'json',
                    success: function (responseCollection) {
                        var state_id = $('#state_id');
                        state_id.empty();
                        state_id.append($('<option>', { 
                                value: '',
                                text : 'Select State' 
                            }));
                        $.each(responseCollection['data'], function (i, item) {
                            console.log(item.id,item.name);
                            state_id.append($('<option>', { 
                                value: item.id,
                                text : item.name 
                            }));
                        });

                    }, error: function (e) {
                        var responseCollection = e.responseJSON;
                        toastr.error(responseCollection['message'], "Error!", {
                            positionClass: "toast-bottom-left",
                            containerId: "toast-bottom-left"
                        });
                    }
                }); //end of ajax
            });

            $("body").on("change", "#state_id", function () {

                var state_id = $(this).val();
                data = {
                    state_id: state_id
                };

                $.ajax({
                    url: '{{route("admin.get-city-by-state")}}',
                    type: "GET",
                    data: data,
                    dataType: 'json',
                    success: function (responseCollection) {
                        var city_id = $('#city_id');
                        city_id.empty();
                        city_id.append($('<option>', { 
                                value: '',
                                text : 'Select City' 
                            }));
                        $.each(responseCollection['data'], function (i, item) {
                            console.log(item.id,item.name);
                            city_id.append($('<option>', { 
                                value: item.id,
                                text : item.name 
                            }));
                        });

                    }, error: function (e) {
                        var responseCollection = e.responseJSON;
                        toastr.error(responseCollection['message'], "Error!", {
                            positionClass: "toast-bottom-left",
                            containerId: "toast-bottom-left"
                        });
                    }
                }); //end of ajax
            });

        });


    </script>
    
@stop