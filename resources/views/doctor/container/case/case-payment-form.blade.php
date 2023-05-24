
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
            'adminPanel.input-mask'
         ];
        
         $viewRoute = route('doctor.case.index');
         $form_action = route('doctor.case.payment.store', ['case'=>$case->id]);
         $form_action2 = route('doctor.case.payment.storeInvoice', ['case'=>$case->id]);

    @endphp
    <script> alert('hello'); </script>

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-12 mb-1">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('doctor.dashbord')}}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{$viewRoute}}">Cases</a></li>
                                <li class="breadcrumb-item active">Treatment Plan Payment</li>
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
                            <option value="invoice">INVOICE / CASH</option>
                        </select>
                    </div>
                    <div class="invoiceDiv col-md-12" style="display:none;">
                        <div class="row">
                            <div class="col-12 float-right mb-1">

                                <table class="table table-striped table-bCaseed responsive ideaecom-datatable-pag ">
                                    <thead>
                                    <tr>
                                         <th>Case ID</th>
                                         <th>Item</th>
                                         <th>Total Amount</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr data-aeshaz-select-id="{{$case->id}}">
                                            <td class="select-td">{{$case->id}}</td>
                                            <td>Digital Model Charges / Treatment Plan</td>
                                            <td>{{$case->processing_fee_amount}} {{$settings->currency}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-12">
                                <form action="{{ $form_action2 }}" method="post">
                                    @csrf
                                    <!--<label>Invoice ID</label>-->
                                    <input type="hidden" class="form-control form-control-md" value="{{rand(9,99999999999999)}}" name="invoiceId" placeholder="Enter Invoice Id">
                                    <button type="submit" class="btn btn-primary btn-lg mt-2">SUBMIT</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="stripeDiv col-md-12">
                        <form role="form" action="{{ $form_action }}" method="post" class="stripe-payment card-form"
                                                data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
                                                        id="stripe-payment">
                                                        @csrf
                            
                            <section id="column-visibility">
                                <div class="row">
                                    <div class="col-12 float-right mb-1">
                                        <table class="table table-striped table-bCaseed responsive ideaecom-datatable-pag ">
                                            <thead>
                                            <tr>
                                                <th>Case ID</th>
                                                <th>Item</th>
                                                <th>Total Amount</th>
                                            </tr>
                                            </thead>
                                            <tbody>
        
                                                <tr data-aeshaz-select-id="{{$case->id}}">
                                                    <td class="select-td">{{$case->id}}</td>
                                                    <td>Digital Model Charges / Treatment Plan</td>
                                                    <td>{{$case->processing_fee_amount}} {{$settings->currency}}</td>
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
    </div>

@stop

@section('extra-script')

@include('component.CustomJS.payment.stripe.stripe-card-payment-js')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
// <script>
// Swal.fire({
//   title: 'Do You want to pay?',
//   text: "Your treatment plan will be processed faster if you pay now!",
//   icon: 'info',
//   showCancelButton: true,
//   confirmButtonColor: '#3085d6',
//   cancelButtonColor: '#d33',
//   confirmButtonText: 'Yes!',
//   cancelButtonText: 'Pay later'
// }).then((result) => {
//   if (!result.isConfirmed) {
//     window.location.href = "{{url('doctor/case')}}";
//   }
// })
// </script>
@stop