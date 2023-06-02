<style>
    body {
        display: none;
    }

    .pwdImg {
        float: right;
        margin-top: -35px;
        margin-right: 10;
        cursor: pointer;
    }

    .pendo {
        cursor: pointer;
    }
</style>
@php
    $title = 'Profile';
    $profileUpdateRoute = url('doctor/profile-update/'.auth()->user()->id);
    $changePasswordRoute = url('doctor/change-password/'.auth()->user()->id);
    $updateClinicsRoute = url('doctor/update-clinics/'.auth()->user()->id);
@endphp

@extends('originator.root.dashboard_side_bar',['title' => $title])
@section('title', "Profile")

<div class="mobile-menu-overlay"></div>
<!-- saadullah -->
<div class="main-container">
    <div class="m-3">
        <div class="row">
            <div class="col-xl-12 ">
                <div class="row">

                    <div class="col-xl-12 mb-30  dollar">
                        <h5>Personal Information</h5>
                        <p style="color:#4B5563;">General Profile allow you to change your profile picture and adjust
                            your account and password information.</p>
                        <form enctype="multipart/form-data" id="frmuser" method="post"
                              action="{{ url('doctor/profile-update')}}">
                            <div class="row">
                                <div class="col-xl-2 mb-30 johndo">
                                    <img src="{{$doctor->picture}}" onclick="choose_image()" style="cursor:pointer;"
                                         id="profile_picture">
                                    <input type="file" name="picture" id="picture" accept="image/*"
                                           class="d-none text-white" placeholder="Change Picture">
                                    <span>
                                        <img src="{{ asset('vendors/images/camera.png') }}" onclick="choose_image()"
                                             style="cursor:pointer;" class=""><br>
                                    </span>
                                    <!-- <p class="text-white">Change Picture
                                    </p> -->
                                </div>
                                <div class="col-xl-4 mb-30 pt-4 lineheight">

                                    <p class="tee mt-4" style="font-weight: bold;">{{ $doctor->name }}
                                    </p>
                                    <p class="tee">{{ $doctor->email }}
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6 col">
                                    <p class="tee mt-4" style="font-weight: bold;">Profile Name
                                    </p>
                                    <input type="text" name="name" class="form-control" value="{{ $doctor->name }}"
                                           placeholder="Enter Name" readonly>
                                </div>
                                <div class="col-xl-2 col mb-30 pendo pendo_new">
                                    <img src="{{ asset('vendors/images/pen.png') }}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xl-6 col ">
                                    <p class="tee mt-4" style="font-weight: bold;">Email
                                    </p>
                                    <input type="email" name="email" class="form-control" value="{{ $doctor->email }}"
                                           placeholder="Enter Email" readonly>
                                </div>
                                <div class="col-xl-2  col mb-30 pendo pendo_new">
                                    <img src="{{ asset('vendors/images/pen.png') }}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xl-6 col ">
                                    <p class="tee mt-4" style="font-weight: bold;">Phone Number</p>
                                    <input type="text" name="phone" value="{{ $doctor->phone }}" class="form-control"
                                           placeholder="Enter Phone Number" readonly>
                                </div>
                                <div class="col-xl-2  col mb-30 pendo pendo_new">
                                    <img src="{{ asset('vendors/images/pen.png') }}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xl-6 col ">
                                    <p class="tee mt-4" style="font-weight: bold;">Gender
                                    </p>
                                    <select class="form-control" name="gender" id="gender" disabled>
                                        <option value="MALE" {{ $doctor->gender === "MALE" ? 'selected' : ''
                                                    }}>Male
                                        </option>
                                        <option value="FEMALE" {{ $doctor->gender === "FEMALE" ? 'selected' : ''
                                                    }}>Female
                                        </option>
                                        <option value="OTHER" {{ $doctor->gender === "OTHER" ? 'selected' : ''
                                                    }}>Other
                                        </option>
                                    </select>
                                </div>
                                <div class="col-xl-2 col mb-30 pendo pendo_new1">
                                    <img src="{{ asset('vendors/images/pen.png') }}">
                                </div>
                            </div>
                            <div class="col-md-6 ">
                            </div>
                            <!-- <div class="row">
                              <div class="col-xl-12 mb-30  dollar pb-5 mt-3">
                                  <button type="submit" class="btn bgcolor text-white casebtn float-right ">Submit</button> -->
                            <!-- <a class="btn bgcolorborder float-right mx-3" style="font-size:22px;" onclick="bndka();">Cancel</a> -->
                            <!-- </div>
                        </div> -->
                            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab"></div>
                            <!-- </form> -->

                        <!-- <form method="POST" action="{{ $updateClinicsRoute }}"> -->
                            {{csrf_field()}}
                            <div class="row">
                                <div class="col-xl-6 col ">
                                    <p class="tee mt-4" style="font-weight: bold;">My Clinic
                                    </p>
                                    <select class="form-control" name="clinics_ids[]" disabled>
                                        @foreach($ClinicDoctors as $ClinicDoctor)
                                            @isset($ClinicDoctor->clinic)
                                                <option
                                                    {{$ClinicDoctor->status == 1 ? 'selected': ''}} value="{{$ClinicDoctor->clinic_id}}">{{$ClinicDoctor->clinic->name}}</option>
                                            @endisset
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-xl-2 col mb-30 pendo ">
                                <!-- <img src="{{ asset('vendors/images/pen.png') }}"> -->

                                </div>
                            </div>
                            <div class="col-md-6 ">
                            </div>
                            <!-- <div class="row">
                                <div class="col-xl-12 mb-30  dollar pb-5 mt-3">
                                    <button class="btn bgcolor text-white casebtn float-right ">Submit</button> -->
                            <!-- <a class="btn bgcolorborder float-right mx-3" style="font-size:22px;" onclick="bndka();">Cancel</a> -->
                            <!-- </div>
                        </div> -->
                            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab"></div>
                            <!-- </form> -->


                            <div class="row">
                                <div class="col-md-6 ">

                                    <div class="row">
                                        <div class="col-xl-12 col  ">
                                        <!-- <form method="POST" action="{{ $changePasswordRoute }}"> -->

                                            <div class="password mt-4 eyescontrol border p-3"
                                                 style="border-radius: 8px;">
                                                <p class="tee mt-4" style="font-weight: bold;">Current Password
                                                </p>
                                                <input type="password" id="current_password" name="current_password"
                                                       class="form-control changePassowrd eyescontrolinput"
                                                       placeholder="Current password">
                                                <img class="iconImage" id="current_icon_show"
                                                     src="{{ asset('vendors/images/EyesHide.png') }}">
                                                <img class="iconImageShow d-none" id="current_icon"
                                                     src="{{ asset('vendors/images/EyesShow.png') }}">

                                                <p class="tee mt-4" style="font-weight: bold;">New Password</p>
                                                <input type="password" id="pass" name="password"
                                                       class="form-control  newpassword" placeholder="Enter password">
                                                <img class="iconImage pwdImg" id="pass_icon_show"
                                                     src="{{ asset('vendors/images/EyesHide.png') }}">
                                                <img class="iconImageShow d-none pwdImg" id="pass_icon"
                                                     src="{{ asset('vendors/images/EyesShow.png') }}">
                                                <p class="tee mt-4" style="font-weight: bold;">Confirm Password
                                                </p>
                                                <input type="password" id="confirm" name="password_confirmation"
                                                       class="form-control changePassowrd"
                                                       placeholder="Confirm Password">
                                                <img class="iconImage pwdImg" id="confirm_icon_show"
                                                     src="{{ asset('vendors/images/EyesHide.png') }}">
                                                <img class="iconImageShow d-none pwdImg" id="confirm_icon"
                                                     src="{{ asset('vendors/images/EyesShow.png') }}">
                                            </div>
                                        </div>

                                        <div class="col-xl-6col mb-30 pendo ">
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <div class="col-md-6 ">
                            </div>
                            <div class="row">
                                <div class="col-xl-12 mb-30  dollar pb-1 mt-3">
                                    <button type="submit" class="btn bgcolor text-white casebtn float-right btn_update"
                                            style="margin-top: 20px;margin-right:20px;border-radius:20px;width:100px;text-align:center;">
                                        Submit</a>
                                        <!-- <a class="btn bgcolorborder float-right mx-3" style="font-size:22px;" onclick="bndka();">Cancel</a> -->
                                </div>
                            </div>
                            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab"></div>
                        </form>
                    </div>
                </div>


            </div>


            <!-- js -->
            <script src="{{ asset('vendors/scripts/core.js') }}"></script>
            <script src="{{ asset('vendors/scripts/script.min.js') }}"></script>
            <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
            <script>
                $('#pass_icon').click(function () {
                    $('#pass_icon_show').removeClass('d-none');
                    $('#pass_icon').addClass('d-none');
                    $('#pass').attr('type', 'password');
                });
                $('#confirm_icon').click(function () {
                    $('#confirm_icon_show').removeClass('d-none');
                    $('#confirm_icon').addClass('d-none');
                    $('#confirm').attr('type', 'password');
                });
                $('#current_icon').click(function () {
                    $('#current_icon_show').removeClass('d-none');
                    $('#current_icon').addClass('d-none');
                    $('#current_password').attr('type', 'password');
                });

                $('#pass_icon_show').click(function () {
                    $('#pass_icon').removeClass('d-none');
                    $('#pass_icon_show').addClass('d-none');
                    $('#pass').attr('type', 'text');
                });
                $('#confirm_icon_show').click(function () {
                    $('#confirm_icon').removeClass('d-none');
                    $('#confirm_icon_show').addClass('d-none');
                    $('#confirm').attr('type', 'text');
                });
                $('#current_icon_show').click(function () {
                    $('#current_icon').removeClass('d-none');
                    $('#current_icon_show').addClass('d-none');
                    $('#current_password').attr('type', 'text');
                });

                // $(".iconImage").click(function(){

                //     $('.iconImage').addClass('d-none');

                //     $('.iconImageShow').removeClass('d-none');

                //    $(this).attr('type', 'password');
                //    $(".changePassowrd").attr("placeholder", "12345678").placeholder();

                // })

                // $(".iconImageShow").click(function(){
                //     $('.iconImage').removeClass('d-none');
                //     $('.iconImageShow').addClass('d-none');
                //   $(".changePassowrd").attr("placeholder", "********").placeholder();

                // })
                function bndka() {
                    $('.pop1').addClass('d-none');
                }

                $('.addcase').click(function () {
                    $('.pop1').removeClass('d-none');
                });

                function bndka1() {
                    $('.pop2').addClass('d-none');
                }

                $('.delete').click(function () {

                    $('.pop2').removeClass('d-none');
                });

                $(document).ready(function () {
                    $("#example").DataTable();
                });

                function choose_image() {
                    $('#picture').click();
                }

                $('#picture').change(function () {
                    if (this.files && this.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function (e) {
                            var imgSrc = e.target.result;
                            $('#profile_picture').attr('src', e.target.result);
                        }
                        reader.readAsDataURL(this.files[0]);
                    }
                });

                $('.pendo_new').on('click', function (e) {
                    e.preventDefault();
                    var input = $(this).prev('div').find('>:eq(1)');

                    if (input.prop('readonly')) {
                        input.prop('readonly', false)
                    } else {
                        input.prop('readonly', true);
                    }

                });
                $('.pendo_new1').on('click', function (e) {
                    e.preventDefault();
                    var input = $(this).prev('div').find('>:eq(1)');

                    if (input.prop('disabled')) {
                        input.prop('disabled', false)
                    } else {
                        input.prop('disabled', true);
                    }

                });

            </script>
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <script>
                        toastr.error('{{$error}}', 'Error', {timeOut: 5000});
                    </script>
                @endforeach
            @endif

            <div class="pop1 d-none scrolldo">
                <div class="row m-0">
                    <div class="col-md-7">
                    </div>
                    <div class="col-md-5 bg-white popadd" style="height: 650px;">
                        <div class="page6box py-3 p-2">
                        </div>
                        <div class="row px-4 mb-5 ">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-11 bold m-auto">
                                        <h5 class="textcolor">Add New Slider</h5>
                                        <p class="greytext">Complete the information related to the slider</p>
                                    </div>
                                    <div class="col-md-1">
                                        <i class="fa-solid bandeka cursor fa-xmark " onclick="bndka();"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 px-4 brdall py-4">
                                <div class="row  ">
                                    <h5 class="textcolor px-2">Slider's Detail</h5>
                                </div>
                                <div class="row m-0  py-4 mt-3"
                                     style="border:1px dashed #e3e3e3;border-radius: 8px;">
                                    <div class="col-md-3 bold ">

                                        <img src="images/gallery.png" style="width:80px;height: 80px;">

                                    </div>
                                    <div class="col-md-6 bold ">
                                        <h6 class="textcolor pt-3" style="font-size: 14px;">Upload Profile
                                            Picture</h6>
                                        <span style="font-size: 12px;">Select a file or drag and drop here</span>

                                    </div>
                                    <div class="col-md-3 px-4 bold pt-4">
                                        <a href="" class="textcolor">Browse</a>

                                    </div>

                                </div>

                                <div class="row  pt-4">
                                    <div class="col-md-12 bold ">
                                        <span>Sort order*</span>
                                        <input type="" name="" class="form-control" placeholder="Enter Here">
                                    </div>

                                </div>


                            </div>
                        </div>
                        <div class="row mt-3 ">
                            <div class="col-md-6 col">
                            </div>
                            <div class="col-md-6 col ">
                                <a class="btn bgcolor text-white casebtn float-right ">Submit</a>
                                <a class="btn bgcolorborder float-right mx-3" style="font-size:22px;"
                                   onclick="bndka();">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pop2 d-none">
                <div class="row ">
                    <div class="col-md-4">
                    </div>
                    <div class="col-md-4 bg-white popadd deleteform">
                        <div class="page6box py-3 ">
                        </div>
                        <div class="row px-4 mb-5 ">
                            <div class="col-md-12">
                                <div class="row borderbottom">
                                    <div class="col-md-11 p-0 aresure  bold m-auto">
                                        <h5 class="t text-dark ">
                                            Are you sure you wanted to delete the case!
                                        </h5>
                                        <p class="mt-3">Once you delete this the data will be permanently
                                            removed</p>
                                    </div>
                                    <div class="col-md-1">
                                        <!--                            <i class="fa-solid bandeka cursor fa-xmark " onclick="bndka1();"></i>-->
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 delebtn">
                                <a class="btn  text-white casebtn float-right deletebtn">Delete</a>
                                <a class="btn cancelbtn  text-white  float-right" onclick="bndka1();">Cancel</a>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
            @if(session('success'))
                <script>
                    toastr.success('{{ session('success')}}', 'Success', {timeOut: 5000});
                </script>
            @endif
            @if(session()->has('error'))

                <script>

                    toastr.error('{{session('error')}}', 'Error', {timeOut: 5000});
                </script>

@endif
{{-- <script>
    var base_url="{{ url('doctor') }}";
$("#frmuser").submit(function (event) {
    event.preventDefault();
    var data = new FormData(frmuser);
    if($("#pass").val() != $("#confirm").val()){
        toastr.error('Password Does not matches', 'Error', {timeOut: 2000});
        return;
    }
        /*_________________________Update ajax_________________________*/
            $.ajax({
            type: "POST",
            url: "{{ url('doctor/profile-update')}}",
            data: data,
            processData: false,
            contentType: false,
            beforeSend: function(){
                ajaxLoader();

            },
             xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = evt.loaded / evt.total;
                        percentComplete = parseInt(percentComplete * 100);
                        ajaxLoaderprograss(percentComplete);
                    }
                }, false);
                return xhr;
            },
            success: function (data) {
                $('#loader').fadeOut();
                //    return;
                if(data.done == true)
                    {
                        toastr.success(data.msg, 'Success', {timeOut: 2000});
                    }else{
                        toastr.error(data.msg, 'Error', {timeOut: 2000});
                    }
                    setTimeout(function(){
                    location.reload();
                    }, 1000);
            },
            error: function(message, error)
            {
                $('#loader').fadeOut();
                // console.log(message);
                   return;
                $.each( message['responseJSON'].errors, function( key, value ) {
                        toastr.error(value, {timeOut: 3000});
                    });
            }
            });
});
</script> --}}
