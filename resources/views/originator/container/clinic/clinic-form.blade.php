@extends('originator.root.index')

@section('title', "Client")


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
$slug = auth()->user()->role->slug;
$viewRoute = route($slug.'.clinic.index');

$edit_id = false;
$form_action = route($slug.'.clinic.store');

if(Request()->route('clinic')){
$edit_id = Request()->route('clinic');
$form_action = route($slug.'.clinic.update', $edit_id);
}
@endphp

<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-xl-6 col-md-6 col-sm-12 ml-auto mr-auto mb-1">
        <div class="row breadcrumbs-top">
          <div class="breadcrumb-wrapper col-12">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route($slug.'.dashbord')}}">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="{{$viewRoute}}">Clinics</a></li>
              <li class="breadcrumb-item active">{{ $edit_id ? 'Edit' : 'Add New' }} Clinics</li>
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
                  <h4 class="card-title">Clinic</h4>
                  <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                  <div class="heading-elements">
                    <ul class="list-inline mb-0">
                      <li><a class="btn btn-sm btn-outline-primary primary" data-action="collapse"><i
                            class="ft-minus"></i></a></li>
                      <li><a class="btn btn-sm btn-outline-primary primary" data-action="reload"><i
                            class="ft-rotate-cw"></i></a></li>
                      <li><a class="btn btn-sm btn-outline-primary primary" data-action="expand"><i
                            class="ft-maximize"></i></a></li>
                    </ul>
                  </div>
                </div>
                <div class="card-content collapse show">
                  <div class="card-body card-dashboard">

                    {{csrf_field()}}

                    <div class="row">

                      <div class="form-group col-12 <?php if ($errors->has('name')) echo 'error'; ?>">
                        <label>Name <span class="required">*</span></label>
                        <div class="controls">
                          <input type="text" name="name" class="form-control" required
                            data-validation-required-message="Name is required" maxlength="255"
                            data-validation-maxlength-message="Max 255 characters allowed"
                            value="{{ old('name', isset($edit_values) ? $edit_values->name : NULL) }}">
                          @if($errors->has('name'))
                          <div class="help-block text-danger name-shopwoo-error">
                            <ul role="alert">
                              <li>{{$errors->first('name')}}</li>
                            </ul>
                          </div>
                          @endif
                        </div>
                      </div>


                        <div class="form-group col-12 <?php if ($errors->has('country_id')) echo 'error'; ?>">
                                <label>Country <span class="required">*</span></label>
                                <div class="controls">
                                    <select class="select2 form-control" id="country_id" name="country_id" required >
                                        <option value="">Select Country</option>
                                        @foreach($countries as $country)
                                            <option {{ isset($edit_values) ? (isset($edit_values->address) ?  ($edit_values->address->country_id == $country->id ? 'selected' : '') : ''  ) : ''  }}  value="{{$country->id}}">{{$country->name}}</option>
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

                            <div class="form-group col-12 <?php if ($errors->has('state_id')) echo 'error'; ?>">
                                <label>State <span class="required">*</span></label>
                                <div class="controls">
                                    <select class="select2 form-control" id="state_id" name="state_id" required >
                                    
                                    @foreach($states as $state)
                                            <option {{ isset($edit_values) ? (isset($edit_values->address) ?  ($edit_values->address->state_id == $state->id ? 'selected' : '') : ''  ) : ''  }}  value="{{$state->id}}">{{$state->name}}</option>
                                    @endforeach
                                    
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

                            <div class="form-group col-12 <?php if ($errors->has('city_id')) echo 'error'; ?>">
                                <label>City <span class="required">*</span></label>
                                <div class="controls">
                                    <select class="select2 form-control" id="city_id" name="city_id" required >
                                    @foreach($cities as $city)
                                        <option {{ isset($edit_values) ? (isset($edit_values->address) ?  ($edit_values->address->city_id == $city->id ? 'selected' : '') : ''  ) : ''  }}  value="{{$city->id}}">{{$city->name}}</option>
                                    @endforeach
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

                      <div class="form-group col-12 <?php if ($errors->has('address')) echo 'error'; ?>">
                        <label>Address <span class="required">*</span></label>
                        <div class="controls">
                          <input type="text" name="address" class="form-control" required
                            data-validation-required-message="Address is required" maxlength="255"
                            data-validation-maxlength-message="Max 255 characters allowed"
                            value="{{ old('address', isset($edit_values) ? (isset($edit_values->address) ? $edit_values->address->value : '') : NULL) }}">
                          @if($errors->has('name'))
                          <div class="help-block text-danger name-shopwoo-error">
                            <ul role="alert">
                              <li>{{$errors->first('address')}}</li>
                            </ul>
                          </div>
                          @endif
                        </div>
                      </div>


                      <div class="form-group col-12 <?php if ($errors->has('contact_person_name')) echo 'error'; ?>">
                        <label>Contact Person Name <span class="required">*</span></label>
                        <div class="controls">
                          <input type="text" name="contact_person_name" class="form-control" required
                            data-validation-required-message="Contact Person Name is required" maxlength="255"
                            data-validation-maxlength-message="Max 255 characters allowed"
                            value="{{ old('contact_person_name', isset($edit_values) ? (isset($edit_values->address) ? $edit_values->address->contact_person_name : '') : NULL) }}">
                          @if($errors->has('name'))
                          <div class="help-block text-danger name-shopwoo-error">
                            <ul role="alert">
                              <li>{{$errors->first('contact_person_name')}}</li>
                            </ul>
                          </div>
                          @endif
                        </div>
                      </div>

                      <div class="form-group col-12 <?php if ($errors->has('contact_person_email')) echo 'error'; ?>">
                        <label>Contact Person Email <span class="required">*</span></label>
                        <div class="controls">
                          <input type="email" name="contact_person_email" class="form-control" required
                            data-validation-required-message="Contact Person Email is required" maxlength="255"
                            data-validation-maxlength-message="Max 255 characters allowed"
                            value="{{ old('contact_person_email', isset($edit_values) ? (isset($edit_values->address) ? $edit_values->address->contact_person_email : '') : NULL) }}">
                          @if($errors->has('name'))
                          <div class="help-block text-danger name-shopwoo-error">
                            <ul role="alert">
                              <li>{{$errors->first('contact_person_email')}}</li>
                            </ul>
                          </div>
                          @endif
                        </div>
                      </div>

                      <div class="form-group col-12 <?php if ($errors->has('contact_person_number')) echo 'error'; ?>">
                        <label>Contact Person Number <span class="required">*</span></label>
                        <div class="controls">
                          <input type="tel" name="contact_person_number" class="form-control" required
                            data-validation-required-message="Contact Person Number is required" maxlength="255"
                            data-validation-maxlength-message="Max 255 characters allowed"
                            value="{{ old('contact_person_number', isset($edit_values) ?(isset($edit_values->address) ? $edit_values->address->contact_person_number : '') : NULL) }}">
                          @if($errors->has('name'))
                          <div class="help-block text-danger name-shopwoo-error">
                            <ul role="alert">
                              <li>{{$errors->first('contact_person_number')}}</li>
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
                      <a href="{{url($viewRoute)}}" class="btn btn-outline-primary primary"><i class="ft-x"></i>
                        Cancel</a>

                      @else

                      <button type="submit" class="btn btn-primary "><i class="ft-save"></i> Save</button>
                      <button type="reset" class="btn btn-outline-primary primary"><i class="ft-refresh-cw"></i>
                        Reset</button>

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

                var city_id = $('#city_id');
                city_id.empty();
                var state_id = $('#state_id');
                state_id.empty();

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

                var city_id = $('#city_id');
                city_id.empty();

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