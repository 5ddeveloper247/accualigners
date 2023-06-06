<style>
    body {
        display: none;
    }

    table th {
        white-space: nowrap !important;
    }

    table.dataTable tbody td {

        white-space: nowrap !important;
    }
</style>
@php
    $title = 'Orders';
@endphp
@extends('originator.root.dashboard_side_bar',['title' => $title])
@section('title', "Doctor")
@php

    $requiredSections = [
    'Header' => 'originator.components.side-nav',
    'Footer' => 'originator.components.footer'
    ];

    $componentsJsCss = [
    'adminPanel.general',
    'adminPanel.datatable',
    'adminPanel.sweetalert',
    ];
    $setting = setting_h();

    $default_currency = $setting->currency;
    $slug = auth()->user()->role->slug;

@endphp

<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }

    gtag('js', new Date());

    gtag('config', 'UA-119386393-1');

</script>

</head>
<style>
    .tablerow tr td a {
        font-size: 11px;
    }

    .tabledozama th {
        font-size: 11px;
        line-height: 24px;


    }

    .tabledozama tr td {
        font-size: 11px;
        /* line-height: 18px; */

    }
</style>


<div class="mobile-menu-overlay"></div>
<!-- saadullah -->
<div class="main-container">

    <div class="m-3">
        <div class="row">
            <div class="col-xl-12 ">
                <div class="row">

                    <div class="col-xl-5 mb-30">
                        <div class="carx2 input">
                            <form action="{{url(Request()->path())}}" id="filter-form" method="get">
                                <input type="text" name="filter" class="form-control" placeholder="Search..."
                                       value="{{Request()->has('filter') ? Request()->get('filter') : ''}}">
                                <div class="searchicons">
                                    <button type="submit" style="background: none;border:none;"><i class="bi bi-search"
                                                                                                   style="margin-right:12px;"></i>
                                    </button>
                                    |
                                    <a href="{{Request()->has('filter') ? url(Request()->path()) : 'JavaScript:void(0);'}}">
                                        <i class="bi bi-sliders"></i>
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="col-xl-3 ">

                    </div>

                    <div class="col-xl-4 mb-30 bgcolorbordertxt">
                        <!--
                          <a class="btn bgcolorborder  delete" style="font-size:22px;width: 93px;">Delete<i class="bi bi-trash3" style=""></i></a>
                         <a class="btn flaot-right bgcolor text-white casebtn addcase">New Appointment <i class="bi bi-plus-circle"></i></a>-->
                    </div>
                </div>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="row">
                            <div class="col-md-12 pb-5">
                                <div class="tabdata">
                                    <div class=" table-responsive">
                                        <table class="table tablerow" id="example">

                                            <thead>
                                            <th>Order ID</th>
                                            <th>Case ID</th>
                                            <th>Client Name</th>
                                            <th>Dentist</th>
                                            <th>Order Date</th>
                                            <th>Payment Type</th>
                                            <th>Shipping Free</th>
                                            <th>Total</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                            </thead>

                                            <tbody class="tablerow">
                                            @foreach($orders as $order)

                                                <tr>
                                                    <td>#{{$order->id.' '.ucfirst(strtolower($order->product)) }}</td>
                                                    <td>{{$order->case_id}}</td>
                                                    <td>{{ ucwords($order->name) }}</td>
                                                    <td>{{ucwords($order->doctor_name)}}</td>
                                                    <td>{{date('M d,Y', $order->created_date)}}</td>
                                                    <td>{{ucfirst($order->payment_name)}}</td>
                                                    <td>{{$order->shipping_charges}} {{strtoupper($default_currency)}}</td>
                                                    <td>{{$order->total_amount . ' '. strtoupper($default_currency)}}</td>
                                                    <td class="maindo"><a
                                                            class="inprogressbtn">{{ucfirst($order->status)}}</a></td>
                                                    <td class="align-middle">
                                                        <div class="btn-group align-top">
                                                            <i class="bi bi-three-dots-vertical dropdown-toggle"
                                                               type="button" id="dropdownMenuButton"
                                                               data-toggle="dropdown" aria-haspopup="true"
                                                               aria-expanded="false" style="cursor:pointer"></i>
                                                            <div class="dropdown-menu"
                                                                 aria-labelledby="dropdownMenuButton">
                                                                <a class="dropdown-item"
                                                                   style="text-align: center;padding: 0;text-decoration: none;"
                                                                   href=" {{ !empty($order->order_url) ? $order->order_url : 'javascript:void(0)' }}">Courier Link</a>
                                                                <a class="dropdown-item"
                                                                   style="text-align: center;padding: 0;text-decoration: none;"
                                                                   onclick="view('{{ $order->id }}')">View Details</a>
                                                                <a class="dropdown-item"
                                                                   style="text-align: center;padding: 0;text-decoration: none;"
                                                                   onclick="delete_order('{{ $order->id }}')">Delete</a>

                                                            </div>
                                                        <!-- <a href="{{ $order->order_url }}"   target="_blank" class="inprogressbtn" data-toggle="tooltip" data-original-title="Courier Link" >Courier Link</a>
                                                    <a href="" class="inprogressbtn" onclick="view()" >View Details</a>
                                                    <a class="inprogressbtn delete-confirm-alert RolePermissionDelete" href="javascript:void(0)" data-id="{{$order->id}}"  data-toggle="tooltip" data-original-title="Delete Item" >Delete</a> -->
                                                        </div>
                                                    </td>
                                                </tr>

                                            @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="tabdata">
                                    <div class=" table-responsive">
                                        <table class="table tablerow" id="example">
                                            <thead>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th>Gender</th>
                                            <th>Action</th>
                                            <th></th>

                                            </thead>
                                            <tbody class="tablerow">

                                            <tr>
                                                <td>123245556</td>
                                                <td>DR.Hamza</td>
                                                <td>Phone</td>
                                                <td>Male</td>
                                                <td class="maindo bgcolorbordertxt ">
                                                    <a class="radius textcolor bgcolorborder  ">Complete Form</a>
                                                </td>
                                                <td><img src="images/dots.png"></td>
                                            </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- js -->
    <script src="{{asset('vendors/scripts/core.js')}} "></script>
    <script src="{{asset('vendors/scripts/script.min.js')}} "></script>
    <script src="{{asset('vendors/scripts/order_ajax.js')}} "></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
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

    </script>
    <script>
        var base_url = "{{url('admin/')}}";

        function delete_order(id) {

            $('#order_id').val(' ');
            //  alert(id);
            var id = $('#order_id').val(id);
            $("#prompt").removeClass("d-none");
        }

        function view(id) {
            $('#order_id').val(' ');
            $('#order_id').val(id);
            var id_int = (parseInt(id));
            //   alert(id_int);
            $('#order_details').removeClass('d-none');
            $.ajax({
                url: base_url + '/order_edit/' + id_int,
                method: "GET",
                beforeSend: function(){
                ajaxLoadercount();
                        },
                // data: json,
                success: function (response) {
                    // Handle successful response
                    console.log(response.data.edit_values.id);
                    console.log(response.data.edit_values.created_at)


                    $('.case_empty').text(' ');

                    $('#case_id').text(response.data.edit_values.case_id);
                    $('#order_id').text(response.data.edit_values.id);
                    if (response.data.hasOwnProperty("doctor")) {
                        $('#dentist_name').text(response.data.doctor.name);
                    }
                    if (response.data.hasOwnProperty("case")) {
                        $('#no_of_tray').text(response.data.case.no_of_trays);
                    }
                    $('#shipping_charges').text(response.data.edit_values.shipping_charges + '{{ strtoupper($default_currency) }}');
                    //  console.log(response.data.edit_values.discount);
                    //  if(response.data.edit_values.discount > 0){
                    //      var unit_amount=response.data.edit_values.unit_amout;
                    //      var string_unit=unit_amount.toString();
                    //      var full= string_unit+'<?php echo($default_currency);  ?>';
                    //      $('#unit_price').text(full);
                    //  }else{
                    //      var unit_amount=response.data.edit_values.unit_amout - (response.data.edit_values.discount/response.data.edit_values.quantity);
                    //      $('#unit_price').text(unit_amount+'<?php echo($default_currency); ?>');
                    //  }
                    $('#quantity').text(response.data.edit_values.quantity);
                    $('#shipping2').text(response.data.edit_values.shipping_charges + '<?php echo($default_currency);  ?>');
                    $('#total_price').text(response.data.edit_values.total_amount + '<?php echo($default_currency);   ?>');
                    $('#name').text(response.data.edit_values.name);
                    $('#name_id').text('ID:' + response.data.edit_values.doctor_id);
                    $('#email').text(response.data.edit_values.email);
                    $('#phone').text(response.data.edit_values.phone_no);

                    //  var formattedDate = $.datepicker.formatDate('d-m-y', date);
                    //  var formattedTime = $.datepicker.formatTime('hh:mm:ss', {hour: date.getHours(), minute: date.getMinutes(), second: date.getSeconds()});
                    //  var formattedDateTime = formattedDate + ' ' + formattedTime;
                    //  console.log(formattedDateTime);

                    var date = new Date(response.data.edit_values.created_at);
                    var day = date.getDate();
                    var month = date.getMonth() + 1;
                    var year = date.getFullYear();
                    var hours = date.getHours();
                    var minutes = date.getMinutes();
                    var seconds = date.getSeconds();

                    var fulldate = day + '-' + month + '-' + year;
                    var fullhour = '  ' + hours + ':' + minutes + ':' + seconds;
                    console.log(response.data.edit_values.order_url);
                    $('#date').text(fulldate + fullhour);
                    $('#country').text(response.data.country);
                    $('#state').text(response.data.state);
                    $('#city').text(response.data.city);
                    $('#address').text(response.data.edit_values.street1);
                    $('#url').val(response.data.edit_values.order_url);
                    //  $('#name_id').text(response.data.edit_values.email);
                    //  $('#name_id').text(response.data.edit_values.email);
                    if (response.data.edit_values.hasOwnProperty("patient")) {
                        $('#img').attr('src', ' ');
                        $('#img').attr('src', response.data.edit_values.patient.picture);
                    }
                    if (response.data.edit_values.status == 'PENDING') {
                        $('#select_box').val('PENDING');
                    } else if (response.data.edit_values.status == 'CONFIRMED') {
                        $('#select_box').val('CONFIRMED');
                    } else if (response.data.edit_values.status == 'DISPATCHED') {
                        $('#select_box').val('DISPATCHED');
                    } else if (response.data.edit_values.status == 'DELIVERED') {
                        $('#select_box').val('DELIVERED');
                    } else if (response.data.edit_values.status == 'CANCELED') {
                        $('#select_box').val('CANCELED');
                    }
                    //  $('shipping_charges').val('response.data.edit_values.case_id');
                },
                error: function (xhr, status, error) {
                    // Handle errors

                }
            });
        }

        $(document).on('click', '#update', function (e) {
            id = $('#order_id').val();
            status = $('#select_box').val();
            url = $('#url').val();
            $.ajax({
                url: base_url + '/order_update',
                type: 'POST',
                data: {
                    status: status,
                    order_url: url,
                    id: id,
                },
                beforeSend: function () {
                    $('#loader').show();
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
                success: function (response) {
                    if (response.successMessage == 'success') {
                        toastr.success('Order Updated Successfully', '', {timeOut: 2000});
                        setTimeout(function () {
                            location.reload(true)
                        }, 1000);
                        //  window.location.reload();
                    } else {
                        toastr.error('Something went wrong please try again', '', {timeOut: 2000});
                        setTimeout(function () {
                            location.reload(true)
                        }, 1000);
                        console.log('error');
                    }
                    $('#loader').fadeOut();
                },
                error: function (xhr, status, error) {
                    toastr.error('Something went wrong please try again', '', {timeOut: 2000});
                    setTimeout(function () {
                        location.reload(true)
                    }, 1000);
                    console.log('Request failed');
                    $('#loader').fadeOut();

                }
            });

        });

        function Delete_actual() {

            id = $('#order_id').val();
            //   alert(id);
            $.ajax({
                url: base_url + '/order_delete',
                method: "POST",
                data: {
                    id: id,
                },
                beforeSend: function () {
                    $('#loader').show();
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
                    if (data.message == 'success') {
                        toastr.success('Deleted Successfully', '', {timeOut: 2000});
                        setTimeout(function () {
                            location.reload(true)
                        }, 1000);
                        $("#prompt").addClass("d-none");
                    } else {
                        toastr.error('Something went wrong please try again', '', {timeOut: 2000});
                        $("#prompt").addClass("d-none");
                    }
                    $('#loader').fadeOut();
                },
                error: function (data) {
                    toastr.error('Something Went Wrong', 'Error');
                    $("#prompt").addClass("d-none");
                    $('#loader').fadeOut();
                }
            });
        }
    </script>

    </body>

    </html>
    <!-- <div class="pop1 d-none scrolldo">
        <div class="row m-0">
            <div class="col-md-7">
            </div>

             <div class="col-md-5 bg-white popadd">
                <div class="page6box py-3 p-2">
             </div>

                <div class="row px-4 mb-5 ">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-11 bold m-auto">
                                <h5 class="textcolor">Add New Appointment</h5>
                                <p class="greytext">Complete the information related to Appointment</p>
                            </div>
                            <div class="col-md-1">
                                <i class="fa-solid bandeka cursor fa-xmark " onclick="bndka();"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 px-4 brdall py-4">
                        <div class="row  ">
                            <h5 class="textcolor px-2">Appointment's Detail</h5>
                        </div>

                        <div class="row  pt-4">
                            <div class="col-md-6 bold ">
                                <span>Case Id*</span>
                                <input type="" name="" class="form-control" placeholder="Enter Here">
                            </div>
                            <div class="col-md-6 mb-4 bold ">
                                <span>Clinic</span>
                                <select class="form-select form-control">
                                    <option selected>Select </option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-4 bold ">
                                <span>Select Doctor</span>
                                <select class="form-select form-control">
                                    <option selected>Select </option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-4 bold ">
                                Appointment Date
                                <input type="date" name="" class="form-control" placeholder="Enter Here">
                            </div>
                            <div class="col-md-12 mb-4 bold ">
                                Appointment Time
                                <input type="date" name="" class="form-control" placeholder="Enter Here">
                            </div>
                            <div class="col-md-12 b-4 bold ">
                                Treatment plan*
                                <textarea class="form-control" height="200">
                                </textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3 ">
                    <div class="col-md-6 col">
                    </div>
                    <div class="col-md-6 col ">
                        <a class="btn bgcolor text-white casebtn float-right ">Submit</a>
                        <a class="btn bgcolorborder float-right mx-3" style="font-size:22px;" onclick="bndka();">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
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
                                <p class="mt-3">Once you delete this the data will be permanently removed</p>
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

    <!-- modal  -->
    <div class="pop1 d-none sldo" id="order_details">
        <div class="row m-0">
            <div class="col-md-4">
            </div>
            <div class="col-md-8 bg-white popadd fixheight" style="height:100vh;">
                <div class="page6box py-3 p-2">
                </div>
                <div class="row px-4 mb-5 ">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12 bold m-auto">
                                <h4 class="textcolor">Order Detials</h4>
                                <p class="greytext " style="font-size:12px;">Here is the order details</p>
                                <i class="fa-solid bandeka float-right cursor fa-xmark " onclick="bndka();"></i>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-12 bold m-auto">
                                <div class="table-responsive">
                                    <table class="table tabledozama">
                                        <thead style="background-color: #f4f5f8;">
                                        <td>Case ID:</td>
                                        <th class="case_empty" id="case_id">2</th>
                                        <td>Order ID:</td>
                                        <th class="case_empty" id="order_id">1</th>
                                        <td>Dentist’s Name:</td>
                                        <th class="case_empty" id="dentist_name">Mujtaba Fatih</th>
                                        <td>Number Of Trays:</td>
                                        <th class="case_empty" id="no_of_tray">10</th>
                                        {{-- <td >Shipping Charges:</td>
                                        <th   class="case_empty" id="shipping_charges">0 AED</th> --}}
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row m-0">
                            <div class="col-md-8 p-0 ">
                                <div class="row m-1 m-0 brdall py-4 p-3" style="padding-bottom: 4rem!important;">
                                    <div class="col-md-12 p-0">
                                        <form method="post" enctype="multipart/form-data" novalidate>
                                            {{csrf_field()}}
                                            @method('PUT')
                                            <h5 class="textcolor px-2">Order Status</h5>
                                    </div>
                                    <div class="col-md-12  mt-3 p-0 ">
                                        <div class="maindo table-responsive">
                                            <table class="table">
                                                <thead class="bxtekdo brdall" style="background-color: #f4f5f8;">
                                                <td>
                                                    <img src="{{ asset('vendors/images/aligner.png')}}" width="50"
                                                         height="20">
                                                </td>

                                                <!-- <th >
                                                    Aligner
                                                    <br> <span style="font-size:8px;font-weight: 300;" id="unit_price">Unit Price:</span><span class="case_empty" id="unit_price"> 99 AED </span>
                                                </th> -->
                                                <th style="font-size: 14px!important;">

                                           <span style="font-size:14px!important;font-weight: 300;
                                           line-height: 54px;"> Quantity:</span><span class="case_empty" id="quantity"
                                                                                      style="font-size:14px!important;">1</span>
                                                </th>
                                                <!-- <th >
                                                    <br> <span style="font-size:8px;font-weight: 300;">Shipping:</span><span class="case_empty" id="shipping2">10 AED<span>

                                                </th>     -->
                                                <th style="font-size: 14px!important;">
                                                    <span style="font-size:14px!important;font-weight: 300;"> </span>


                                                </th>
                                                <th style="font-size: 14px!important;">

                                                    <span
                                                        style="font-size:14px!important;font-weight: 300;line-height:54px;"> Total Price:</span><span
                                                        class="case_empty" id="total_price"
                                                        style="font-size:14px!important;"> 99 AED </span>

                                                </th>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="col-md-12  mt-3 p-0 ">
                                        <div class="row">
                                            <div class="col-md-6 mb-4 bold ">
                                                <span>Status</span>
                                                <select name="status" class="form-select form-control" id="select_box">
                                                    <option value="PENDING"
                                                            id="pending">{{ucfirst(strtolower('PENDING'))}} </option>
                                                    <option value="CONFIRMED"
                                                            id="confirmed">{{ucfirst(strtolower('CONFIRMED'))}}</option>
                                                    <option value="DISPATCHED"
                                                            id="dispatch">{{ucfirst(strtolower('DISPATCHED'))}}</option>
                                                    <option value="DELIVERED"
                                                            id="delivred">{{ucfirst(strtolower('DELIVERED'))}}</option>
                                                    <option value="CANCELED"
                                                            id="canceled">{{ucfirst(strtolower('CANCELED'))}}</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 bold enterurl">
                                                <span>Enter URL</span>
                                                <input type="" name="order_url" class="form-control" placeholder="Link"
                                                       id="url">
                                                <img src="{{ asset('vendors/images/link.png') }}"
                                                     style="background-color:white;">
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-12 p-0">
                                        <a class="bgcolor float-right updateimg text-white py-2 px-3" id="update"
                                           style="cursor:pointer">Update <img
                                                src="{{ asset('vendors/images/update.png')}}" class="mt-1"></a>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-4  ">
                                <div class="row  brdall pt-3 m-1">
                                    <div class="col-md-12 ">
                                        <div class="cont pb-2 borderbottom">
                                            <div class="row   ">
                                                <div class="col-md-4 p-0 p-2 Changing">
                                                    <img src="{{ storageUrl_h('') }}" id="img" style="height:65px;">
                                                </div>

                                                <div class="col-md-6 pt-4 Changing">
                                                    <p id="name" class="case_empty"> Changing Gibson
                                                    </p> <span class="case_empty" id="name_id"> ID:123664652
                                                </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-2">
                                    <span style="color:black;font-weight: bold;">General Info
                                    </span>
                                    </div>
                                    <div class="col-md-12 mt-1 addressdo">
                                        <p style="display: inline;font-size: 12px; display: inline;color: #8c8d8d;">
                                            Email:

                                        </p>
                                        <span id="email" class="case_empty">
                                        Test@gmail.com
                                    </span>

                                    </div>
                                    <div class="col-md-12 mt-1 addressdo ">
                                        <p style="display: inline;font-size: 12px;     display: inline;color: #8c8d8d;">
                                            Phone:
                                        </p>
                                        <span id="phone" class="case_empty">
                                        +9236562356
                                    </span>

                                    </div>
                                    <div class="col-md-12 mt-1 addressdo  my-2">

                                        <div class="">
                                            <p style="display: inline;font-size: 12px;     display: inline;color: #8c8d8d;">
                                                Order Date/Time:
                                            </p>
                                            <span id="date" class="case_empty">
                                            2/3/23 9:Am
                                        </span>

                                        </div>

                                        <div class="col borderbottom my-3">
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 ">
                                            <span style="color:black;font-weight: bold;font-size: 15px;">
                                                Deliver Address
                                            </span>

                                            </div>
                                            <div class="col-md-12 mt-1 addressdo">
                                                <p style="display: inline;font-size: 12px;     display: inline;color: #8c8d8d;">
                                                    Country:</p>
                                                <span id="country" class="case_empty">
                                                UAE
                                            </span>

                                            </div>
                                            <div class="col-md-12 mt-1 addressdo">
                                                <p style="display: inline;font-size: 12px;     display: inline;color: #8c8d8d;">
                                                    State:
                                                </p>
                                                <span id="state" class="case_empty">Fujairah
                                            </span>

                                            </div>
                                            <div class="col-md-12 mt-1 addressdo ">
                                                <p style="display: inline;font-size: 12px;     display: inline;color: #8c8d8d;">
                                                    City:
                                                </p>
                                                <span style="color:black;" id="city" class="case_empty">
                                                Dibba Al-Fujairah
                                            </span>

                                            </div>
                                            <div class="col-md-12 mt-1 addressdo ">
                                                <p style="display: inline;font-size: 12px;     display: inline;color: #8c8d8d;">
                                                    Address:
                                                </p>
                                                <span style="color:black;" id="address" class="case_empty">
                                                Itaque est amet sit deserunt repudiandae velit in consectetur minus qui
                                            </span>

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
    <div class="pop2 d-none" id="prompt">
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
                                <input type="hidden" id="order_id"/>
                                <h5 class="t text-dark ">

                                    Are you sure you wanted to delete the case!
                                </h5>
                                <p class="mt-3">Once you delete this the data will be permanently removed</p>
                            </div>
                            <div class="col-md-1">
                                <!--                            <i class="fa-solid bandeka cursor fa-xmark " onclick="bndka1();"></i>-->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 delebtn">
                        <a class="btn  text-white casebtn float-right deletebtn" onclick="Delete_actual()">Delete</a>
                        <a class="btn cancelbtn  text-white  float-right" onclick="bndka1();">Cancel</a>

                    </div>
                </div>
            </div>
        </div>

    </div>
