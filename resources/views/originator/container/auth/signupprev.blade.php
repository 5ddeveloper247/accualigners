@extends('originator.root.index2')

@section('title', "Doctor Signup")

@section('content')

@php
$requiredSections = [

];

$componentsJsCss = [
'adminPanel.general',
'adminPanel.login-register',
'adminPanel.validation',
'adminPanel.switchery-checkbox',
];

$emailError = null;
if ($errors->has('email')) {
$emailError = $errors->first('email');
}

$passwordError = null;
if ($errors->has('password')) {
$passwordError = $errors->first('password');
}

$bodyClasses = "vertical-layout vertical-menu 1-column menu-expanded blank-page blank-page pace-done";
$dataCol = '1-column';
$countries = App\Models\Country::orderBy('name')->get();
$postRoute = route('signUpPost');

@endphp
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <section class="flexbox">
                <div class="col-12 d-flex align-items-center justify-content-center">
                    <div class="col-md-3 col-10 p-0">
                        <div class="row">
                            <div class="col-12 text-center mb-2">
                                <div class="p-1 login-logo"><img
                                        src="{{storageUrl_h(trans('siteConfig.setting.logoDarkVertical'))}}"
                                        alt="IdeaEcom logo"></div>
                                <h1 class="mb-0">Sign Up</h1>
                                <h6 class="card-subtitle font-medium-1 pt-1 text-light"><span>Please fill all the
                                        details</span></h6>
                            </div>
                            <div class="col-12 p-0">
                                <div class="card border-grey border-lighten-3 m-0 p-2">
                                    {{-- @if ($error)
                                    <div class="alert alert-danger alert-dismissible mb-2" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <strong>Sorry!</strong> {{$error}}
                                    </div>
                                    @endif --}}

                                    <div class="card-content">
                                        <div class="card-body">
                                            <form class="form-horizontal form-simple" method="post"
                                                action="{{$postRoute}}">

                                                {{csrf_field()}}

                                                <fieldset class="form-group">
                                                    <input type="text" class="form-control" name="name"
                                                        placeholder="Full Name" value="" required>
                                                </fieldset>
                                                <fieldset class="form-group">
                                                    <input type="email" class="form-control" name="email"
                                                        placeholder="Email" value="" required>
                                                </fieldset>

                                                <fieldset class="form-group">
                                                    <input type="password" class="form-control" name="password"
                                                        placeholder="Password">
                                                </fieldset>

                                                <fieldset class="form-group">
                                                    <input type="password" class="form-control" name="confirm_password"
                                                        placeholder="Confirm Password">
                                                </fieldset>


                                                <fieldset class="form-group">
                                                    <input type="text" class="form-control" name="clinic_name"
                                                        placeholder="Clinic Name" value="" required>
                                                </fieldset>

                                                <fieldset class="form-group">
                                                    <select class="select2 form-control" id="country_id"
                                                        name="country_id" required>
                                                        <option value="">Select Country (Clinic)</option>
                                                        @foreach($countries as $country)
                                                        <option value="{{$country->id}}">{{$country->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </fieldset>
                                                <fieldset class="form-group">
                                                    <select class="select2 form-control" id="state_id" name="state_id"
                                                        required>
                                                        <option>Select State</option>
                                                    </select>
                                                </fieldset>


                                                <fieldset class="form-group">
                                                    <select class="select2 form-control" id="city_id" name="city_id"
                                                        required>
                                                        <option>Select State</option>
                                                    </select>
                                                </fieldset>
                                                
                                              <fieldset class="form-group">
                                                 <input type="text" name="address" class="form-control" required
                            data-validation-required-message="Address is required" maxlength="255"
                            data-validation-maxlength-message="Max 255 characters allowed"
                            value="{{ old('address') }}">
                             </fieldset>





                                                <button type="submit" class="btn btn-primary btn-lg btn-block">Sign
                                                    Up</button>
                                            </form>
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
                    url: '{{route("get-state-by-country")}}',
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
                    url: '{{route("get-city-by-state")}}',
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