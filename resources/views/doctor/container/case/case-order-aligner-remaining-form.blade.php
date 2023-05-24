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
            'adminPanel.input-mask'
        ];
        
        $viewRoute = route('doctor.case.index');
        $form_action = route('doctor.case.order-aligner.storeSecondInstallment', ['case'=>$case->id]);
        
        $form_action2 = route('doctor.case.order-aligner.storeInvoiceSecondInstallment', ['case'=>$case->id]);



        $currency = $settings->currency;
        $aligner_kit_price = $settings->aligner_kit_price;
         $no_of_trays = $case->no_of_trays;
        // $total_amount = $aligner_kit_price * $no_of_trays;
        $case_fee = $settings->case_fee;
        $complete_treatment_plan = $settings->complete_treatment_plan;
        $total_amount = ((int) $complete_treatment_plan - (int) $case_fee) / 2;
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
                                <li class="breadcrumb-item"><a href="{{route('doctor.case.show', ['case'=>$case->id])}}">Cases View</a></li>
                                <li class="breadcrumb-item active">Order Clears Aligner</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                
                <div class="row">
                    <div class="col-lg-12 pt-3 d-block w-100 pb-5">
                        <label>PAY VIA</label>
                        <select class="form-control form-control-lg paymentSelect">
                            <option value="stripe" selected>STRIPE</option>
                            <option value="invoice">INVOICE</option>
                        </select>
                    </div>
                    <div class="invoiceDiv col-md-12" style="display:none;">
                        <div class="row">
                            
                            <div class="col-md-12">
                                <form action="{{ $form_action2 }}" method="post">
                                    @csrf
                                    <input type="hidden" name="aligner_kit_price" id="aligner_kit_price" value="{{$aligner_kit_price}}">
                                    <input type="hidden" name="no_of_trays" id="no_of_trays" value="{{$no_of_trays}}">
                                    <input type="hidden" name="shipping_charges" id="shipping_charges" value="0">
                                    <input type="hidden" name="total_amount" id="total_amount" value="{{$total_amount}}">

                   
                    <section id="column-visibility">
                        <div class="row">

                            <div class="col-12 float-right mb-1">

                                <table class="table table-striped table-bCaseed responsive ideaecom-datatable-pag ">
                                    <thead>
                                    <tr>
                                        <th>Case ID</th>
                                        <th>Item</th>
                                        <!--<th>Price</th>-->
                                        <th>Quantity</th>
                                        <th>Shipping Fee</th>
                                        <th>Total Amount</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                        <tr data-aeshaz-select-id="{{$case->id}}">
                                            <td class="select-td">{{$case->id}}</td>
                                            <td>Clears Aligner</td>
                                            {{--<td>{{$aligner_kit_price}} {{$currency}}</td>--}}
                                            <td>{{$no_of_trays}}</td>
                                            <td><span id="shipping_charges_show">0</span> {{$currency}}</td>
                                            <td><span id="total_amount_show">{{$total_amount}}</span> {{$currency}}</td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </section>
                                    
                                    <!--<label>Invoice ID</label>-->
                                    <input type="hidden" class="form-control form-control-md" value="{{rand(9,99999999999999)}}" name="invoiceId" placeholder="Enter Invoice Id">
                                    <button type="submit" class="btn btn-primary btn-lg mt-2">SUBMIT</button>
                                </form>
                            </div>
                            
                            
                        </div>
                    </div>
                </div>
                <div class="stripeDiv col-md-12">
                    <form role="form" action="{{ $form_action }}" method="post" class="stripe-payment card-form" data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="stripe-payment">

                    @csrf

                    <input type="hidden" name="aligner_kit_price" id="aligner_kit_price" value="{{$aligner_kit_price}}">
                    <input type="hidden" name="no_of_trays" id="no_of_trays" value="{{$no_of_trays}}">
                    <input type="hidden" name="shipping_charges" id="shipping_charges" value="0">
                    <input type="hidden" name="total_amount" id="total_amount" value="{{$total_amount}}">

                   

                    <section id="column-visibility">
                        <div class="row">

                            <div class="col-12 float-right mb-1">

                                <table class="table table-striped table-bCaseed responsive ideaecom-datatable-pag ">
                                    <thead>
                                    <tr>
                                        <th>Case ID</th>
                                        <th>Item</th>
                                        <!--<th>Price</th>-->
                                        <th>Quantity</th>
                                        <th>Shipping Fee</th>
                                        <th>Total Amount</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                        <tr data-aeshaz-select-id="{{$case->id}}">
                                            <td class="select-td">{{$case->id}}</td>
                                            <td>Clears Aligner</td>
                                            {{--<td>{{$aligner_kit_price}} {{$currency}}</td>--}}
                                            <td>{{$no_of_trays}}</td>
                                            <td><span id="shipping_charges_show">0</span> {{$currency}}</td>
                                            <td><span id="total_amount_show">{{$total_amount}}</span> {{$currency}}</td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </section>

                    @include('doctor.container.payment.stripe.card-form')
                </form>    
                    
                </div>

                
            </div>
        </div>
    </div>

@stop

@section('extra-script')

    @include('component.CustomJS.payment.stripe.stripe-card-payment-js')

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
                
                var shipping_company_charge_id = $('#shipping_company_charge_id');
                shipping_company_charge_id.empty();

                var state_id = $('#state_id');
                state_id.empty();

                var country_id = $(this).val();
                data = {
                    country_id: country_id
                };

                $.ajax({
                    url: '{{route("doctor.get-state-by-country")}}',
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

                var shipping_company_charge_id = $('#shipping_company_charge_id');
                shipping_company_charge_id.empty();

                var city_id = $('#city_id');
                city_id.empty();

                var state_id = $(this).val();
                data = {
                    state_id: state_id
                };

                $.ajax({
                    url: '{{route("doctor.get-city-by-state")}}',
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

            $("body").on("change", "#city_id", function () {

                var shipping_company_charge_id = $('#shipping_company_charge_id');
                shipping_company_charge_id.empty();

                var city_id = $(this).val();
                data = {
                    country_id: $('#country_id').val(),
                    state_id: $('#state_id').val(),
                    city_id: city_id,
                };

                $.ajax({
                    url: '{{route("doctor.get-shipping-by-city")}}',
                    type: "GET",
                    data: data,
                    dataType: 'json',
                    success: function (responseCollection) {
                        
                        shipping_company_charge_id.append($('<option>', { 
                                value: '',
                                text : 'Select Shipping Company' 
                            }));
                        $.each(responseCollection['data'], function (i, item) {
                            console.log(item.id,item.name);
                            shipping_company_charge_id.append($('<option>', { 
                                value: item.id,
                                text : item.title + ' (' + item.amount + ' ' + "{{$currency}}" + ')' 
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

            $("body").on("change", "#shipping_company_charge_id", function () {

                var shipping_company_charge_id = $(this).val();
                console.log(shipping_company_charge_id);
                data = {
                    shipping_company_charge_id: shipping_company_charge_id,
                };

                $.ajax({
                    url: '{{route("doctor.get-shipping-detail")}}',
                    type: "GET",
                    data: data,
                    dataType: 'json',
                    success: function (responseCollection) {
                        var data = responseCollection['data'];
                        console.log(data);
                        var shipping_charges = parseFloat(data.amount);

                        
                        var aligner_kit_price = parseFloat($("#aligner_kit_price").val());
                        var no_of_trays = parseFloat($("#no_of_trays").val());

                        var total_amount = (aligner_kit_price * no_of_trays) + shipping_charges;
                        
                        $("#shipping_charges").val(shipping_charges);
                        $("#total_amount").val(total_amount);

                        $("#shipping_charges_show").html(shipping_charges);
                        $("#total_amount_show").html(total_amount);

                    }, error: function (e) {
                        var responseCollection = e.responseJSON;
                        toastr.error(responseCollection['message'], "Error!", {
                            positionClass: "toast-bottom-left",
                            containerId: "toast-bottom-left"
                        });
                    }
                }); //end of ajax
            });
            
            // 2
            
            $("body").on("change", "#country_id2", function () {

                var city_id2 = $('#city_id2');
                city_id2.empty();
                
                var shipping_company_charge_id2 = $('#shipping_company_charge_id2');
                shipping_company_charge_id2.empty();

                var state_id2 = $('#state_id2');
                state_id2.empty();

                var country_id2 = $(this).val();
                data = {
                    country_id: country_id2
                };

                $.ajax({
                    url: '{{route("doctor.get-state-by-country")}}',
                    type: "GET",
                    data: data,
                    dataType: 'json',
                    success: function (responseCollection) {
                        
                        state_id2.append($('<option>', { 
                                value: '',
                                text : 'Select State' 
                            }));
                        $.each(responseCollection['data'], function (i, item) {
                            console.log(item.id,item.name);
                            state_id2.append($('<option>', { 
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

            $("body").on("change", "#state_id2", function () {

                var shipping_company_charge_id2 = $('#shipping_company_charge_id2');
                shipping_company_charge_id2.empty();

                var city_id2 = $('#city_id2');
                city_id2.empty();

                var state_id2 = $(this).val();
                data = {
                    state_id: state_id2
                };

                $.ajax({
                    url: '{{route("doctor.get-city-by-state")}}',
                    type: "GET",
                    data: data,
                    dataType: 'json',
                    success: function (responseCollection) {

                        city_id2.append($('<option>', { 
                                value: '',
                                text : 'Select City' 
                            }));
                        $.each(responseCollection['data'], function (i, item) {
                            console.log(item.id,item.name);
                            city_id2.append($('<option>', { 
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

            $("body").on("change", "#city_id2", function () {

                var shipping_company_charge_id2 = $('#shipping_company_charge_id2');
                shipping_company_charge_id2.empty();

                var city_id2 = $(this).val();
                data = {
                    country_id: $('#country_id2').val(),
                    state_id: $('#state_id2').val(),
                    city_id: city_id2,
                };

                $.ajax({
                    url: '{{route("doctor.get-shipping-by-city")}}',
                    type: "GET",
                    data: data,
                    dataType: 'json',
                    success: function (responseCollection) {
                        
                        shipping_company_charge_id2.append($('<option>', { 
                                value: '',
                                text : 'Select Shipping Company' 
                            }));
                        $.each(responseCollection['data'], function (i, item) {
                            console.log(item.id,item.name);
                            shipping_company_charge_id2.append($('<option>', { 
                                value: item.id,
                                text : item.title + ' (' + item.amount + ' ' + "{{$currency}}" + ')' 
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

            $("body").on("change", "#shipping_company_charge_id2", function () {

                var shipping_company_charge_id2 = $(this).val();
                console.log(shipping_company_charge_id2);
                data = {
                    shipping_company_charge_id: shipping_company_charge_id2,
                };

                $.ajax({
                    url: '{{route("doctor.get-shipping-detail")}}',
                    type: "GET",
                    data: data,
                    dataType: 'json',
                    success: function (responseCollection) {
                        var data = responseCollection['data'];
                        console.log(data);
                        var shipping_charges = parseFloat(data.amount);

                        
                        var aligner_kit_price = parseFloat($("#aligner_kit_price").val());
                        var no_of_trays = parseFloat($("#no_of_trays").val());

                        var total_amount = (aligner_kit_price * no_of_trays) + shipping_charges;
                        
                        $("#shipping_charges").val(shipping_charges);
                        $("#total_amount").val(total_amount);

                        $("#shipping_charges_show").html(shipping_charges);
                        $("#total_amount_show").html(total_amount);

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
<input type="hidden" name="aligner_kit_price" id="aligner_kit_price" value="{{$aligner_kit_price}}">
                    <input type="hidden" name="no_of_trays" id="no_of_trays" value="{{$no_of_trays}}">
                    <input type="hidden" name="shipping_charges" id="shipping_charges" value="0">
                    <input type="hidden" name="total_amount" id="total_amount" value="{{$total_amount}}">
@stop