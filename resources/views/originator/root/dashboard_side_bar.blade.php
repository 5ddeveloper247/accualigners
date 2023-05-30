@php
    $caseConcer = caseConcers_h(Auth()->user()->id);
    $latest_case = latest_caseConcers_h();

@endphp
    <!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8">
    <title>AccuAligners </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
          rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/styles/core.css') }}">
    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/styles/icon-font.min.css') }}">
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> --}}
    <link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet"/>
    <link href="{{ asset('vendors/css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
          integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.8/jquery.inputmask.min.js"
            integrity="sha512-efAcjYoYT0sXxQRtxGY37CKYmqsFVOIwMApaEbrxJr4RwqVVGw8o+Lfh/+59TU07+suZn1BWq4fDl5fdgyCNkw=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $('#month_year').on('keyup', function () {
            $(this).inputmask('99/99')
        });
    </script>
    <script>
        const input = document.querySelectorAll(".number_val");
        const inputField = input[0];
        let inputCount = 0;

        //Update input
        const updateInputConfig = (element, disabledStatus) => {
            // console.log(element)
            element.disabled = disabledStatus;
            if (!disabledStatus) {
                element.focus();
            } else {
                element.blur();
            }
        };

        input.forEach((element) => {
            element.addEventListener("keyup", (e) => {
                e.target.value = e.target.value.replace(/[^0-9]/g, "");
                let { value } = e.target;
                console.log(e.target)
                if (value.length == 1) {
                    updateInputConfig(input[inputCount], true);
                    if (inputCount <= input.length && e.key != "Backspace") {
                        if (inputCount < input.length) {
                            updateInputConfig(input[inputCount+1], false);
                        }
                    }
                    inputCount += 1;
                }else if (value.length > 1) {
                    input[inputCount].value = value.split("")[0];
                }

            });
        });

        window.addEventListener("keyup", (e) => {
            if (inputCount <= input.length && inputCount >= 0) {
                if (e.key == "Backspace") {
                    updateInputConfig(input[inputCount-1], false);
                    input[inputCount-1].value = "";
                    inputCount -= 1;
                }
                console.log(inputCount)
            }
        });


        const startInput = () => {
            inputCount = 0;
            input.forEach((element) => {
                element.value = "";
            });
            updateInputConfig(inputField, false);
        };

        window.onload = startInput();

    </script>
    <script>
        document.onreadystatechange = function (e) {
            if (document.readyState === 'complete') {
                // alert('hello');
                $('#loader').fadeOut(3000);
                $('body').show();

                $('.toggle-on,.toggle-off').css('padding-right', '0');

                $('#arch_to_treat').siblings().find('.toggle-on').text('Upper ->');
                $('#arch_to_treat').siblings().find('.toggle-off').text('<- Lower');


                $('#a_p_relationship').siblings().find('.toggle-on').text('Maintain ->');
                $('#a_p_relationship').siblings().find('.toggle-off').text('<- Improve');


                $('#midline').siblings().find('.toggle-on').text('Maintain ->');
                $('#midline').siblings().find('.toggle-off').text('<- Improve');


                $('#overjet').siblings().find('.toggle-on').text('Maintain ->');
                $('#overjet').siblings().find('.toggle-off').text('<- Improve');


                $('#overbite').siblings().find('.toggle-on').text('Maintain ->');
                $('#overbite').siblings().find('.toggle-off').text('<- Improve');


                $('#midline').siblings().find('.toggle-on').text('Maintain ->');
                $('#midline').siblings().find('.toggle-off').text('<- Improve');
            }
        };
        window.addEventListener("load", function () {
            const preloader = document.querySelector(".preloader");
            const preloaderBar = document.querySelector("#loader");
            const preloaderPercent = document.querySelector(".preloader-percent");
            let percent = 0;
            let interval = setInterval(function () {
                percent++;
                preloaderBar.style.width = "100%";
                preloaderPercent.innerHTML = percent + "%";
                if (percent >= 100) {
                    clearInterval(interval);
                    preloader.style.display = "none";
                }
            }, 12);
        });

        //on ajax request
        function ajaxLoader() {
            const preloader = document.querySelector(".preloader");
            const preloaderBar = document.querySelector("#loader");
            const preloaderPercent = document.querySelector(".preloader-percent");
            $('#loader').show();
            $(".preloader-percent").css("top", "50%");
            $('.preloader').show();
            $('.preloader-percent').show();
            let percent = 0;
            let interval = setInterval(function () {
                percent++;
                preloaderBar.style.width = "100%";
                preloaderPercent.innerHTML = percent + "%";
                if (percent >= 100) {
                    clearInterval(interval);
                    preloader.style.display = "none";
                }
            }, 130);
        }
    </script>
    <style>
        body {
            background: white !important;
        }

        #loader {
            width: 100%;
            height: 2000px;
            position: fixed;
            background-image: url(/vendors/images/loader1.gif);
            background-size: 100px;
            background-color: white;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: center;
            top: 0;
            left: 0;
            z-index: 11111111;
        }

        .preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 9999;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .preloader-percent {
            position: absolute;
            top: 51.3%;
            left: 50.2%;
            transform: translate(-50%, -50%);
            font-size: 15px;
            font-weight: bold;
            color: #001864;
        }
    </style>

</head>

<div id="loader">
    <div class="preloader">
        <div class="preloader-percent">0%</div>
    </div>
</div>

<body>
<div class="header borderbottom">
    <div class="header-left">
        <div class="menu-icon dw dw-menu"></div>

        <div class="header-search mx-3">
            <form>
                <div class="form-group goodmorning mb-0 blue">
                    @if ($title == 'Dashboard')
                        <script>
                            function getUserTimezone() {
                                const timezone = Intl.DateTimeFormat().resolvedOptions().timeZone;
                                return timezone;
                            }

                            const userTimezone = getUserTimezone();
                            const now = new Date();
                            const options = {
                                timeZone: userTimezone
                            };
                            const currentTime = now.toLocaleTimeString('en-US', options);
                        </script>
                        <p class="m-0" id="message_header"></p>
                        <h5>Welcome Back , {{ ucwords(Auth()->user()->name) }}</h5>
                        <script>
                            if (currentTime < 12) {
                                var myParagraph = document.querySelector('#message_header');
                                myParagraph.textContent = 'Good morning!';

                            } else if (currentTime < 18) {
                                var myParagraph = document.querySelector('#message_header');
                                myParagraph.textContent = 'Good afternoon!';
                            } else {
                                var myParagraph = document.querySelector('#message_header');
                                myParagraph.textContent = 'Good evening!';
                            }
                        </script>
                    @elseif($title == 'Case Details')
                        <?php
                        $currentUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                        $path = parse_url($currentUrl, PHP_URL_PATH);
                        $prefix = trim(dirname($path), '/');
                        $prefix == 'doctor/case_detail' ? ($prefix = 'doctor/case') : $prefix;
                        ?>
                        <p class="m-0"></p>
                        <a href="{{ url($prefix) }}">
                            <h5 style="font-size: 16px;"><img src="{{ asset('vendors/images/leftArrow.png') }}"
                                                              width="15" class="mt-1 mx-2"> Cases Details <span
                                    style="font-size: 13px;color:grey;">Id:{{ $edit_values->id }}</span>
                            </h5>
                        </a>

                        <a href="{{ url($prefix) }}"
                           style="margin-left: 2.2rem;margin-right:.5rem;display: inline;font-size: 13px;text-decoration:none;">Case<img
                                src="{{ asset('vendors/images/rightarro1.png') }}" width="5" class="mt-1 mx-1"
                                style="padding-top: 1px!important;">
                        </a>
                        <p style="display: inline;font-size: 13px;">Details<img
                                src="{{ asset('vendors/images/rightarro1.png') }}" width="5" class="mt-1 mx-1"
                                style="padding-top: 2px!important;">
                        </p>
                    @else
                        <p class="m-0" id="message_header"></p>
                        <h5>{{ $title }}</h5>
                    @endif
                </div>
            </form>
        </div>
    </div>
    <div class="header-right">
        @if (Auth()->user()->id == '57' && isset($latest_case->message_by))
            @if ($latest_case->message_by == 'PATIENT')
                <a href="/admin/case/{{ $latest_case->case_id }}" style="display: contents;"
                   title="New Message on Case No:{{ $latest_case->case_id }}"><span
                        class="redcontroller"></span></a>
            @endif
        @elseif(Auth()->user()->id != '57' && isset($caseConcer->message_by))
            @if ($caseConcer->message_by == 'ADVISER')
                <a href="/doctor/case_detail/{{ $caseConcer->case_id }}" style="display: contents;"
                   title="New Message on Case No:{{ $caseConcer->case_id }}"><span
                        class="redcontroller"></span></a>
            @endif
        @endif
        <img src="{{ asset('vendors/images/ring.png') }}"
             style="width:22px;height:25px; margin-right:12px !important;margin-top: 18px  !important;"><span
            style="margin-top:17px !important;">|</span>

        <div>
            <img
                src="{{ Auth()->user()->picture == null ? asset('vendors/images/roundimg.png') : Auth()->user()->picture }}"
                style="width:45px;height:45px;margin-left:12px  !important; margin-right:12px  !important;margin-top: 8px  !important;border-radius:50%;">

        </div>
        <div class="user-notification">


            <div style="cursor:pointer;">

                <i class="bi bi-caret-down dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false"></i>

                <div class="dropdown-menu dropdown-menu-right ">
                    <div class="notification-list1 ">
                        <ul>
                            @if (Auth()->user()->role_id == 1)
                                <li>
                                    <h6>{{ ucwords(Auth()->user()->name) }}</h6>
                                </li>
                            @else
                                <li>
                                    <a href="{{ url('doctor/account-details/'.Auth()->user()->id) }}">
                                        <i class="bi bi-person"></i> Profile
                                    </a>
                                </li>
                            @endif

                            <hr>
                            <li>
                                <a href="{{ url('logout') }}">
                                    <i class="bi bi-box-arrow-left"></i> Logout
                                </a>
                            </li>
                        {{-- <li>
                            <a href="{{ url('logout') }}">
                                <img src="{{Auth()->user()->picture}}" alt="">

                                <p>Logout1</p>
                            </a>
                        </li> --}}
                        <!-- <li>
                                    <a href="#">
                                        <img src="{{ asset('vendors/images/photo1.jpg') }}" alt="">
                                        <h3>Lea R. Frith</h3>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="{{ asset('vendors/images/photo2.jpg') }}" alt="">
                                        <h3>Erik L. Richards</h3>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="{{ asset('vendors/images/photo3.jpg') }}" alt="">
                                        <h3>John Doe</h3>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="{{ asset('vendors/images/photo4.jpg') }}" alt="">
                                        <h3>Renee I. Hansen</h3>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="{{ asset('vendors/images/img.jpg') }}" alt="">
                                        <h3>Vicki M. Coleman</h3>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>
                                    </a>
                                </li> -->
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="dashboard-setting user-notification">
        </div>
    </div>
</div>

<div class="left-side-bar borderright">

    <div class="brand-log zamalogoda floatright ">
        <div class="logodata p-4">
            <img src="{{ asset('vendors/images/logo.png') }}">
            <a href="index.html">
                <h5 class="  txtcolor">AccuAligners</h5>
            </a>
            <p class="txtcolor ">Clear <span style="font-weight: bold;">Solutions</span></p>
            <div class="close-sidebar" data-toggle="left-sidebar-close">
                <i class="ion-close-round"></i>
            </div>
        </div>
    </div>
    <div class="menu-block customscroll dicons">
        <div class="sidebar-menu iconsdazama">
            <ul id="accordion-menu">
                @if (auth()->user()->role->slug == 'doctor')
                    <li class="dropdown  {{ $title == 'Dashboard' ? 'activeka' : '' }} ">
                        <a href="{{ url('doctor/') }}" class="dropdown-toggle">
                            <!--<span class="micon dw dw-house-1"></span>-->
                            <img src="{{ asset('vendors/icon/ic1.png') }}" width="30">
                            <span class="mtext">Dashboard</span>
                        </a>
                    </li>
                    <li class="dropdown  {{ $title == 'Cases' ? 'activeka' : '' }}">
                        <a href="{{ url('doctor/case') }}" class="dropdown-toggle">
                            <img src="{{ asset('vendors/icon/ic2.png') }}" width="30">
                            <!--<span class="micon dw dw-calendar1"></span>-->

                            <span class="mtext">Cases</span>
                        </a>
                    </li>
                    <?php $user_id = Auth()->user()->id; ?>
                    <li class="dropdown {{ $title == 'Profile' ? 'activeka' : '' }}">
                        <a href="{{ url('doctor/account-details/' . $user_id) }}" class="dropdown-toggle">
                            <img src="{{ asset('vendors/icon/ic3.png') }}" width="30">
                            <!--<span class="micon dw dw-group"></span>-->
                            <span class="mtext">Profile</span>
                        </a>
                    </li>
                    <li class="dropdown {{ $title == 'Agreement' ? 'activeka' : '' }}">
                        <a href="{{ url('doctor/agreement') }}/{{ Auth()->User()->id }}"
                           class="dropdown-toggle">
                            <img src="{{ asset('vendors/icon/ic3.png') }}" width="30">
                            <!--<span class="micon dw dw-group"></span>-->
                            <span class="mtext">Accualingers Agreement</span>
                        </a>
                    </li>
                @else
                    <li class="dropdown ">
                        <a href="{{ route('admin.dashbord') }}" class="dropdown-toggle">
                            <!--<span class="micon dw dw-house-1"></span>-->
                            <img src="{{ asset('vendors/icon/ic1.png') }}" width="30">
                            <span class="mtext">Dashboard</span>
                        </a>
                    </li>

                    <li class="dropdown ">
                        <a href="{{ url('admin/case') }}" class="dropdown-toggle">
                            <img src="{{ asset('vendors/icon/ic2.png') }}" width="30">
                            <!--<span class="micon dw dw-calendar1"></span>-->

                            <span class="mtext">Cases</span>
                        </a>
                    </li>
                    <li class="dropdown {{ $title == 'Users' ? 'activeka' : '' }}">
                        <a href="{{ url('admin/user') }}" class="dropdown-toggle">
                            <img src="{{ asset('vendors/icon/ic3.png') }}" width="30">
                            <!--<span class="micon dw dw-group"></span>-->
                            <span class="mtext">Users</span>
                        </a>
                    </li>
                    <li class="dropdown {{ $title == 'Appointments' ? 'activeka' : '' }}">
                        <a href="{{ url('admin/appointment') }}" class="dropdown-toggle">
                            <!--<span class="micon dw dw-file-135"></span>-->
                            <img src="{{ asset('vendors/icon/ic4.png') }}" width="30">
                            <span class="mtext">Appointments</span>
                        </a>

                    </li>
                    <li class="dropdown {{ $title == 'Orders' ? 'activeka' : '' }}">
                        <a href="{{ url('admin/order') }}" class="dropdown-toggle">
                            <!--<i class="micon dw dw-chat3"></i>-->
                            <img src="{{ asset('vendors/icon/ic5.png') }}" width="30">
                            <span class="mtext">Orders</span>
                        </a>

                    </li>
                    <li class=" {{ $title == 'Clinics' ? 'activeka' : '' }}">
                        <a href="{{ url('admin/clinic') }}" class="dropdown-toggle no-arrow">
                            <!--                            <span class="micon dw dw-settings2"></span>-->
                            <img src="{{ asset('vendors/icon/ic6.png') }}" width="30">
                            <span class="mtext">Clinics</span>
                        </a>
                    </li>
                    <li class="{{ $title == 'Doctors' ? 'activeka' : '' }}">
                        <a href="{{ url('admin/doctor') }}" class="dropdown-toggle no-arrow">
                            <!--                            <span class="micon dw dw-settings2"></span>-->
                            <img src="{{ asset('vendors/icon/ic7.png') }}" width="30">
                            <span class="mtext">Doctors</span>
                        </a>
                    </li>
                    <li class="{{ $title == 'Sliders' ? 'activeka' : '' }}">
                        <a href="{{ url('admin/slider') }}" class="dropdown-toggle no-arrow">
                            <!--                            <span class="micon dw dw-settings2"></span>-->
                            <img src="{{ asset('vendors/icon/ic8.png') }}" width="30">
                            <span class="mtext">Sliders</span>
                        </a>
                    </li>
                    <li class="{{ $title == 'Price Settings' ? 'activeka' : '' }}">
                        <a href="{{ url('admin/setting') }}" class="dropdown-toggle no-arrow">
                            <!--                            <span class="micon dw dw-settings2"></span>-->
                            <img src="{{ asset('vendors/icon/ic9.png') }}" width="30">
                            <span class="mtext">Price Settings</span>
                        </a>
                    </li>
                    <li class="{{ $title == 'Support' ? 'activeka' : '' }}">
                        <a href="{{ url('admin/support') }}" class="dropdown-toggle no-arrow">
                            <!--                            <span class="micon dw dw-settings2"></span>-->
                            <img src="{{ asset('vendors/icon/ic10.png') }}" width="30">
                            <span class="mtext">Help/Support</span>
                        </a>
                    </li>
                @endif
                <li class="{{ $title == 'Logout' ? 'activeka' : '' }}">
                    <a href="{{ url('logout') }}" class="dropdown-toggle no-arrow">
                        <!--                            <span class="micon dw dw-settings2"></span>-->
                        <img src="{{ asset('vendors/icon/ic10.png') }}" width="30">
                        <span class="mtext">Logout</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
<script>
    function reset(id) {
        $('#' + id).reset();
    }
</script>
