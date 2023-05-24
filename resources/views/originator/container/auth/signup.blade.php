<style>
    body {
        display: none;
    }
</style>
@extends('originator.root.index2')


@php
    $requiredSections = [];
    
    $componentsJsCss = ['adminPanel.general', 'adminPanel.login-register', 'adminPanel.validation', 'adminPanel.switchery-checkbox'];
    
    $emailError = null;
    if ($errors->has('email')) {
        $emailError = $errors->first('email');
    }
    
    $passwordError = null;
    if ($errors->has('password')) {
        $passwordError = $errors->first('password');
    }
    
    $bodyClasses = 'vertical-layout vertical-menu 1-column menu-expanded blank-page blank-page pace-done';
    $dataCol = '1-column';
    $countries = App\Models\Country::orderBy('name')->get();
    $postRoute = route('signUpPost');
    
@endphp

<div class="mainbackground">
    <!-- <div class="alert alert-danger alert-dismissible mb-2" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <strong>Sorry!</strong>
                                    </div> -->
    <div class="row m-0">
        <div class="col-md-7">
        </div>

        <!----Previous form----->
        <div class="col-md-4 mt-5 pt-3 " id="prev">

            <div class=" control mt-">
                <form class="form-horizontal form-simple" method="post" action="{{ $postRoute }}">

                    {{ csrf_field() }}
                    <div class="row maincard py-4 ">
                        <div class="col-md-2">

                        </div>
                        <div class="col-md-10 paragra">
                            <img src="{{ asset('/vendors/images/loginlogo.png') }}" width="40">
                            <span style="font-size: 30px;">
                                AccuAligners
                            </span>
                            <p>Clear <span style="font-weight: bold;">Solutions!</span></p>
                        </div>
                        <div class="col-md-12 text-center welcome1">
                            <h4 class="mt-4">Create New Account</h4>
                            <p>Please Enter your Sign-up Details</p>
                            <m style="cursor: pointer"></m>
                            <a style="position: relative;top: 7px;">User info<span
                                    class="m-2">__________________</span>
                                <img src="{{ asset('/vendors/images/Check.png') }}" width="18"
                                    class=" m-1">Billing Info</a>
                        </div>
                        <div class="row m-3">
                            @if ($errors->any())
                                <div class="col-md-12 hide_error" style="text-align:center;">
                                    @foreach ($errors->all() as $error)
                                        <div class="alert alert-danger hide_error">{{ $error }}</div>
                                    @endforeach
                                </div>
                            @endif
                            <div class="col-md-12 hide_msg" style="display:none;">
                                <div class="alert alert-danger hide_msg" id="msg" style="text-align: center;">
                                    hello</div>
                            </div>
                            <div class="col-md-12 registerborder pb-3">
                                <div class="row">
                                    <div class="col-md-12 mt-4">
                                        <h6>User Info

                                            <span style="font-size: 13px;margin-left: 15%;color: red;"
                                                id="msg1"></span>
                                        </h6>
                                    </div>
                                </div>
                                <div class="row  mt-3">
                                    <div class="col-md-6">
                                        <div class="inputdokanaza ">
                                            <label>Title*</label>
                                            <input type="text" name="title" id="title" class="form-control"
                                                placeholder="Enter here">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="inputdokanaza ">
                                            <label>First Name* </label>

                                            <input type="text" name="firstname" id="firstname" class="form-control"
                                                placeholder="Enter here">

                                        </div>
                                    </div>
                                </div>
                                <div class="row  mt-1 ">
                                    <div class="col-md-6">
                                        <div class="inputdokanaza ">
                                            <label>Last Name* </label>
                                            <input type="text" name="lastname" id="lastname" class="form-control"
                                                placeholder="Enter here">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="inputdokanaza">
                                            <label>Email* </label>
                                            <input type="email" name="email" id="email" class="form-control"
                                                placeholder="Enter here">

                                        </div>
                                    </div>
                                </div>
                                <div class="row  mt-1 ">
                                    <div class="col-md-6">
                                        <div class="inputdokanaza ">
                                            <label>Country* </label>
                                            <!-- <input type="" name=" " class="form-control" placeholder="Enter here"> -->
                                            <select class="select2 form-control" id="country_id" name="country_id"
                                                style="font-size: 12px;color: #858181;" required>
                                                <option value="">Select Country</option>
                                                @foreach ($countries as $country)
                                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="inputdokanaza ">
                                            <label>Phone Number* </label>
                                            <input type="number" name="phone" id="phone" class="form-control"
                                                placeholder="Enter here">

                                        </div>
                                    </div>
                                </div>
                                <div class="row  pb-4 mt-1 ">
                                    <div class="col-md-12">
                                        <div class="inputdokanaza ">
                                            <label>Website </label>
                                            <input type="text" name="website" id="website_name"
                                                class="form-control" placeholder="Enter here">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-11 pt-3 m-auto textlogin">
                                    <a class="bgcolor d-block text-white text-center py-2" id="nextBtn"
                                        style="cursor:pointer;font-size: 18px;font-weight:300;"> Next </a>
                                </div>
                                <div class="col-md-11 pt-3 m-auto text-center">
                                    <a class="" style="font-size: 14px;font-weight:300;">Already have an <span
                                            style="font-weight: bold;font-size:14px;color: #6a6a6a;">Account?</span>
                                    </a>
                                    <a href="{{ route('login') }}" class="  px-2"
                                        style="text-decoration: underline; font-size: 14px;font-weight:bold;color:#00205C;cursor:pointer;">
                                        Login</a>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        <!----Next form------->
        <div class="col-md-4 mt-5 pt-3 d-none" id="next">
            <div class=" control mt-">
                <div class="row maincard py-4 ">
                    <div class="col-md-2">
                    </div>
                    <div class="col-md-10 paragra">
                        <img src="{{ asset('/vendors/images/loginlogo.png') }}" width="40">
                        <span style="font-size: 30px;">
                            AccuAligners
                        </span>
                        <p>Clear <span style="font-weight: bold;">Solutions!</span></p>
                    </div>
                    <div class="col-md-12 text-center welcome1">
                        <h4 class="mt-4">Create New Account</h4>
                        <p>Please Enter your Sign-up Details</p>
                        <img src="{{ asset('/vendors/images/tick.PNG') }}" width="20"
                            style="position: relative;top: 10px;cursor:pointer;" id="user_info" />
                        <a style="position: relative;top: 7px;">User info<span
                                class="m-2">__________________</span>
                        </a>
                        <m style="position: relative;top: 4px;"></m>
                        <b style="position: relative;top: 7px;font-size:13px;">Billing Info</b>
                    </div>
                    <div class="row m-3 py-4 ">
                        <div class="col-md-12 registerborder">
                            <div class="row">
                                <div class="col-md-12 mt-4">
                                    <h6>Billing Info
                                        <span style="font-size: 13px;margin-left: 15%;color: red;"
                                            id="msg2"></span>
                                    </h6>
                                </div>
                            </div>
                            <div class="row  mt-3">
                                <div class="col-md-6">
                                    <div class="inputdokanaza ">
                                        <label>Clinic Name*</label>
                                        <input type="text" name="clinic_name" class="form-control"
                                            placeholder="Enter here" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="inputdokanaza ">
                                        <label>Street* </label>

                                        <input type="text" class="form-control" placeholder="Enter here"
                                            name="address" class="form-control" required
                                            data-validation-required-message="Address is required" maxlength="255"
                                            data-validation-maxlength-message="Max 255 characters allowed"
                                            value="{{ old('address') }}">

                                    </div>
                                </div>
                            </div>
                            <div class="row  mt-1 ">
                                <div class="col-md-6">
                                    <div class="inputdokanaza ">
                                        <label>State* </label>
                                        <!-- <input type="" name="state_id" class="form-control" placeholder="Enter here"> -->
                                        <select class="select2 form-control" id="state_id" name="state_id" required
                                            style="font-size: 12px;color: grey;">
                                            <option>Select State</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="inputdokanaza ">
                                        <label>City* </label>
                                        <!-- <input type="" name="" class="form-control" placeholder="Enter here"> -->
                                        <select class="select2 form-control" id="city_id" name="city_id" required
                                            style="font-size: 12px;color: grey;">
                                            <option>Select City</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row  mt-1 ">
                                <div class="col-md-6">
                                    <div class="inputdokanaza ">
                                        <label>Zip* </label>
                                        <input type="text" name="zip" class="form-control"
                                            placeholder="Enter here" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="inputdokanaza ">
                                        <label>Contact Person* </label>
                                        <input type="text" name="contact_person_name" class="form-control"
                                            placeholder="Enter here">

                                    </div>
                                </div>
                            </div>
                            <div class="row   mt-1 ">
                                <div class="col-md-6">
                                    <div class="inputdokanaza ">
                                        <label>Contact Person Email* </label>
                                        <input type="email" name="contact_person_email" class="form-control"
                                            placeholder="Enter here" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="inputdokanaza ">
                                        <label>VAT number* </label>
                                        <input type="text" name="vat" class="form-control"
                                            placeholder="Enter here" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row  pb-4 mt-1 ">
                                <div class="col-md-6">
                                    <div class="inputdokanaza ">
                                        <label>Password* </label>
                                        <input type="password" name="password" id="pass" class="form-control"
                                            placeholder="Enter here" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="inputdokanaza ">
                                        <label>Confirm Password* </label>
                                        <input type="password" name="confirm_password" id="confirm_pass"
                                            class="form-control" placeholder="Enter here" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-11 pt-3 m-auto textlogin">
                            <button type="submit" id="btncreate" class="bgcolor d-block text-white text-center py-2"
                                style="font-size: 18px;font-weight:300;width: 100%;">Create</button>
                            </form>
                        </div>
                        <div class="col-md-11 pt-3 m-auto text-center">
                            <a class="  " style="font-size: 14px;font-weight:300;">Already have an <span
                                    style="font-weight: bold;font-size:14px;color: #6a6a6a;">Account?</span> </a>
                            <a href="{{ route('login') }}" class="  px-2"
                                style="text-decoration: underline; font-size: 14px;font-weight:bold;color:#00205C;cursor:pointer;">
                                Login</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


</body>

</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="{{ asset('/vendors/scripts/script.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    toastr.error('Test Toaster', '', {
        timeOut: 2000
    });
</script>
<script>
    //ajax code
    $(document).ready(function() {

        $('body').css('display', 'block');

        setTimeout(function() {
            $('.hide_error').fadeOut();
        }, 5000);
        // document.body.style.display = 'block';

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });

        $("body").on("change", "#country_id", function() {

            var city_id = $('#city_id');
            city_id.empty();
            var state_id = $('#state_id');
            state_id.empty();

            var country_id = $(this).val();
            data = {
                country_id: country_id
            };

            $.ajax({
                url: '{{ route('get-state-by-country') }}',
                type: "GET",
                data: data,
                dataType: 'json',
                success: function(responseCollection) {
                    state_id.append($('<option>', {
                        value: '',
                        text: 'Select State'
                    }));
                    $.each(responseCollection['data'], function(i, item) {
                        console.log(item.id, item.name);
                        state_id.append($('<option>', {
                            value: item.id,
                            text: item.name
                        }));
                    });

                },
                error: function(e) {
                    var responseCollection = e.responseJSON;
                    toastr.error(responseCollection['message'], "Error!", {
                        positionClass: "toast-bottom-left",
                        containerId: "toast-bottom-left"
                    });
                }
            }); //end of ajax
        });

        $("body").on("change", "#state_id", function() {

            var city_id = $('#city_id');
            city_id.empty();

            var state_id = $(this).val();
            data = {
                state_id: state_id
            };

            $.ajax({
                url: '{{ route('get-city-by-state') }}',
                type: "GET",
                data: data,
                dataType: 'json',
                success: function(responseCollection) {
                    city_id.append($('<option>', {
                        value: '',
                        text: 'Select City'
                    }));
                    $.each(responseCollection['data'], function(i, item) {
                        console.log(item.id, item.name);
                        city_id.append($('<option>', {
                            value: item.id,
                            text: item.name
                        }));
                    });

                },
                error: function(e) {
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
