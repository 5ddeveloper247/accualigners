@extends('doctor.root.index')

@section('title', 'Case')


@section('content')
    @php
        
        $requiredSections = [
            'Header' => 'doctor.components.side-nav',
            'Footer' => 'doctor.components.footer',
        ];
        
        $componentsJsCss = ['adminPanel.general', 'adminPanel.validation', 'adminPanel.select2', 'adminPanel.input-mask'];
        
        $viewRoute = route('doctor.case.index');
        $form_action = route('doctor.case.order-missing-tray.storeStripe', ['case' => $case->id]);
        
        $form_action2 = route('doctor.case.order-missing-tray.storeInvoice', ['case' => $case->id]);
        
        $currency = $settings->currency;
        $aligner_kit_price = $settings->aligner_kit_price;
        $no_of_trays = $case->no_of_trays;
        // $total_amount = $aligner_kit_price * $no_of_trays;
        $case_fee = $settings->case_fee;
        $complete_treatment_plan = $settings->complete_treatment_plan;
        $total_amount = ((int) $complete_treatment_plan - (int) $case_fee) / 2;
        
    @endphp
    
    <style>
        /* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}
    </style>

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-12 mb-1">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('doctor.dashbord') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ $viewRoute }}">Cases</a></li>
                                <li class="breadcrumb-item"><a
                                        href="{{ route('doctor.case.show', ['case' => $case->id]) }}">Cases View</a></li>
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
                                    <input type="hidden" name="aligner_kit_price" id="aligner_kit_price"
                                        value="{{ $aligner_kit_price }}">
                                    <input type="hidden" name="no_of_trays" class="no_of_trays" value="{{ 1 }}">
                                    <input type="hidden" name="shipping_charges" id="shipping_charges" value="0">
                                    <input type="hidden" name="total_amount" class="total_amount" value="{{ $aligner_kit_price }}">

                                    <section id="column-visibility">

                                        <div class="row">

                                            <div class="col-xl-12 col-md-12 col-sm-12">
                                                <div class="card">
                                                    <div class="card-header  bg-hexagons">
                                                        <h4 class="card-title">Order Detail</h4>
                                                        <a class="heading-elements-toggle"><i
                                                                class="la la-ellipsis-v font-medium-3"></i></a>
                                                        <div class="heading-elements">
                                                            <ul class="list-inline mb-0">
                                                                <li><a class="btn btn-sm btn-outline-primary primary"
                                                                        data-action="collapse"><i class="ft-minus"></i></a>
                                                                </li>
                                                                <li><a class="btn btn-sm btn-outline-primary primary"
                                                                        data-action="reload"><i
                                                                            class="ft-rotate-cw"></i></a></li>
                                                                <li><a class="btn btn-sm btn-outline-primary primary"
                                                                        data-action="expand"><i class="ft-maximize"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="card-content collapse show">
                                                        <div class="card-body card-dashboard">

                                                            <div class="row">

                                                                <div
                                                                    class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-12 <?php if ($errors->has('order_type')) {
                                                                        echo 'error';
                                                                    } ?>">
                                                                    <label>Order Type<span class="required">*</span></label>
                                                                    <div class="controls">
                                                                        <select class="select2 form-control order_type"
                                                                            name="order_type" required>
                                                                            <option value="missing-tray">Missing Tray
                                                                            </option>
                                                                            <option value="additional-tray">Additional Tray
                                                                            </option>
                                                                        </select>
                                                                        @if ($errors->has('order_type'))
                                                                            <div
                                                                                class="help-block text-danger order_type-shopwoo-error">
                                                                                <ul role="alert">
                                                                                    <li>{{ $errors->first('order_type') }}
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>


                                                                <div
                                                                    class="form-group col-xl-3 col-lg-3 col-md-3 col-sm-6 <?php if ($errors->has('tray_number')) {
                                                                        echo 'error';
                                                                    } ?> tray_number_row">
                                                                    <label>Tray Number<span
                                                                            class="required">*</span></label>
                                                                    <div class="controls">
                                                                        <input type="number" name="tray_number" min="1" value="1"
                                                                            class="form-control tray_number">
                                                                        @if ($errors->has('tray_number'))
                                                                            <div
                                                                                class="help-block text-danger tray_number-shopwoo-error">
                                                                                <ul role="alert">
                                                                                    <li>{{ $errors->first('tray_number') }}
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>

                                                                <div
                                                                    class="form-group col-xl-3 col-lg-3 col-md-3 col-sm-6 <?php if ($errors->has('tray_quantity')) {
                                                                        echo 'error';
                                                                    } ?> tray_quantity_row">
                                                                    <label>Number of Tray<span
                                                                            class="required">*</span></label>
                                                                    <div class="controls">
                                                                        <input type="number" name="tray_quantity"
                                                                            class="form-control tray_quantity"
                                                                            value="1" min="1">
                                                                        @if ($errors->has('tray_quantity'))
                                                                            <div
                                                                                class="help-block text-danger tray_quantity-shopwoo-error">
                                                                                <ul role="alert">
                                                                                    <li>{{ $errors->first('tray_quantity') }}
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>

                                                                {{-- <div
                                                                class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-12 <?php if ($errors->has('street1')) {
                                                                    echo 'error';
                                                                } ?>">
                                                                <label>Address <span class="required">*</span></label>
                                                                <div class="controls">
                                                                    <input type="text" name="street1"
                                                                        class="form-control" required
                                                                        data-validation-required-message="Address is required"
                                                                        value="{{ old('street1', isset($edit_values) ? $edit_values->street1 : NULL) }}">
                                                                    @if ($errors->has('street1'))
                                                                    <div
                                                                        class="help-block text-danger street1-shopwoo-error">
                                                                        <ul role="alert">
                                                                            <li>{{$errors->first('street1')}}</li>
                                                                        </ul>
                                                                    </div>
                                                                    @endif
                                                                </div>
                                                            </div> --}}


                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </section>

                                    <section id="column-visibility">
                                        <div class="row">

                                            <div class="col-12 float-right mb-1">

                                                <table
                                                    class="table table-striped table-bCaseed responsive ideaecom-datatable-pag ">
                                                    <thead>
                                                        <tr>
                                                            <th>Case ID</th>
                                                            <th>Item</th>
                                                            <th>Quantity</th>
                                                            <th>Price Per Quantity</th>
                                                            <th>Shipping Fee</th>
                                                            <th>Total Amount</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        <tr data-aeshaz-select-id="{{ $case->id }}">
                                                            <td class="select-td">{{ $case->id }}</td>
                                                            <td>Clears Aligner</td>
                                                            <td class="qty">1</td>
                                                            <td>{{$aligner_kit_price}}</td>
                                                            <td><span id="shipping_charges_show">0</span>
                                                                {{ $currency }}</td>
                                                            <td><span class="total_amount_show" id="total_amount_show">{{$aligner_kit_price}}</span>
                                                                {{ $currency }}</td>
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
                    <form role="form" action="{{ $form_action }}" method="post" class="stripe-payment card-form"
                        data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
                        id="stripe-payment">

                        @csrf

                        <input type="hidden" name="aligner_kit_price" id="aligner_kit_price"
                            value="{{ $aligner_kit_price }}">
                        <input type="hidden" name="no_of_trays" class="no_of_trays" value="{{ 1 }}">
                                    <input type="hidden" name="shipping_charges" id="shipping_charges" value="0">
                                    <input type="hidden" name="total_amount" class="total_amount" value="{{ $aligner_kit_price }}">

                        <section id="column-visibility">

                            <div class="row">

                                <div class="col-xl-12 col-md-12 col-sm-12">
                                    <div class="card">
                                        <div class="card-header  bg-hexagons">
                                            <h4 class="card-title">Order Detail</h4>
                                            <a class="heading-elements-toggle"><i
                                                    class="la la-ellipsis-v font-medium-3"></i></a>
                                            <div class="heading-elements">
                                                <ul class="list-inline mb-0">
                                                    <li><a class="btn btn-sm btn-outline-primary primary"
                                                            data-action="collapse"><i class="ft-minus"></i></a></li>
                                                    <li><a class="btn btn-sm btn-outline-primary primary"
                                                            data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                                    <li><a class="btn btn-sm btn-outline-primary primary"
                                                            data-action="expand"><i class="ft-maximize"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="card-content collapse show">
                                            <div class="card-body card-dashboard">

                                                <div class="row">


                                                    <div
                                                        class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-12 <?php if ($errors->has('order_type')) {
                                                            echo 'error';
                                                        } ?>">
                                                        <label>Order Type<span class="required">*</span></label>
                                                        <div class="controls">
                                                            <select class="select2 form-control order_type"
                                                                name="order_type" required>
                                                                <option value="missing-tray">Missing Tray</option>
                                                                <option value="additional-tray">Additional Tray</option>
                                                            </select>
                                                            @if ($errors->has('order_type'))
                                                                <div
                                                                    class="help-block text-danger order_type-shopwoo-error">
                                                                    <ul role="alert">
                                                                        <li>{{ $errors->first('order_type') }}</li>
                                                                    </ul>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>


                                                    <div
                                                        class="form-group col-xl-3 col-lg-3 col-md-3 col-sm-6 <?php if ($errors->has('tray_number')) {
                                                            echo 'error';
                                                        } ?> tray_number_row">
                                                        <label>Tray Number<span class="required">*</span></label>
                                                        <div class="controls">
                                                            <input type="number" name="tray_number" min="1"value="1"
                                                                class="form-control tray_number">
                                                            @if ($errors->has('tray_number'))
                                                                <div
                                                                    class="help-block text-danger tray_number-shopwoo-error">
                                                                    <ul role="alert">
                                                                        <li>{{ $errors->first('tray_number') }}
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div
                                                        class="form-group col-xl-3 col-lg-3 col-md-3 col-sm-6 <?php if ($errors->has('tray_quantity')) {
                                                            echo 'error';
                                                        } ?> tray_quantity_row">
                                                        <label>Number of Tray<span class="required">*</span></label>
                                                        <div class="controls">
                                                            <input type="number" name="tray_quantity" min="1"
                                                                class="form-control tray_quantity" value="1">
                                                            @if ($errors->has('tray_quantity'))
                                                                <div
                                                                    class="help-block text-danger tray_quantity-shopwoo-error">
                                                                    <ul role="alert">
                                                                        <li>{{ $errors->first('tray_quantity') }}
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    {{-- <div
                                                    class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-12 <?php if ($errors->has('street1')) {
                                                        echo 'error';
                                                    } ?>">
                                                    <label>Address <span class="required">*</span></label>
                                                    <div class="controls">
                                                        <input type="text" name="street1" class="form-control" disabled
                                                            data-validation-required-message="Address is required"
                                                            value="{{ old('street1', isset($edit_values) ? $edit_values->street1 : NULL) }}">
                                                        @if ($errors->has('street1'))
                                                        <div class="help-block text-danger street1-shopwoo-error">
                                                            <ul role="alert">
                                                                <li>{{$errors->first('street1')}}</li>
                                                            </ul>
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div> --}}


                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </section>

                        <section id="column-visibility">
                            <div class="row">

                                <div class="col-12 float-right mb-1">

                                    <table class="table table-striped table-bCaseed responsive ideaecom-datatable-pag ">
                                        <thead>
                                            <tr>
                                                <th>Case ID</th>
                                                <th>Item</th>
                                                <th>Quantity</th>
                                                <th>Price Per Quantity</th>
                                                <th>Shipping Fee</th>
                                                <th>Total Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <tr data-aeshaz-select-id="{{ $case->id }}">
                                                <td class="select-td">{{ $case->id }}</td>
                                                <td>Clears Aligner</td>
                                                <td class="qty">1</td>
                                                <td>{{$aligner_kit_price}}</td>
                                                <td><span id="shipping_charges_show">0</span> {{ $currency }}</td>
                                                <td><span class="total_amount_show" id="total_amount_show">{{ $aligner_kit_price }}</span>
                                                    {{ $currency }}</td>
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
        $(document).ready(function() {
            var aligner_kit_price = "{{$aligner_kit_price}}"
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });


            $("body").on("change", "#shipping_company_charge_id", function() {

                var shipping_company_charge_id = $(this).val();
                console.log(shipping_company_charge_id);
                data = {
                    shipping_company_charge_id: shipping_company_charge_id,
                };

                $.ajax({
                    url: '{{ route('doctor.get-shipping-detail') }}',
                    type: "GET",
                    data: data,
                    dataType: 'json',
                    success: function(responseCollection) {
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


            $("body").on("change", "#shipping_company_charge_id2", function() {

                var shipping_company_charge_id2 = $(this).val();
                console.log(shipping_company_charge_id2);
                data = {
                    shipping_company_charge_id: shipping_company_charge_id2,
                };

                $.ajax({
                    url: '{{ route('doctor.get-shipping-detail') }}',
                    type: "GET",
                    data: data,
                    dataType: 'json',
                    success: function(responseCollection) {
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

            $(".tray_quantity_row").css("display", "none");
            $('.order_type').on('change', function() {
                refreshInput()
                if (this.value == "missing-tray") {
                    $(".tray_quantity_row").css("display", "none");
                    $(".tray_number_row").css("display", "block");
                } else {
                    $(".tray_number_row").css("display", "none");
                    $(".tray_quantity_row").css("display", "block");
                }

            });
            
            $('.tray_quantity').keyup(function () { 
                var qty = $(this).val();
                $('.qty').html('');
                $('.qty').html(qty);
                $('.total_amount_show').html('');
                $('.total_amount_show').html(qty * aligner_kit_price);
                $('.total_amount').val(qty * aligner_kit_price)
                $('.no_of_trays').val(qty)
            });
            
            function refreshInput(){
                $('.total_amount_show').html('');
                $('.total_amount_show').html(aligner_kit_price);

                $('.qty').html('');
                $('.qty').html(1);
                
                $('.total_amount').val(aligner_kit_price)
                $('.no_of_trays').val(1)
                
            }
            
            


        });
    </script>
@stop
