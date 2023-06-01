@extends('originator.root.index')

@section('title', "Order")

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
             $viewRoute = route($slug.'.order.index');
             $setting = setting_h();
             $default_currency = $setting->currency;
         @endphp

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-12 col-12 mb-1">
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route($slug.'.dashbord')}}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{$viewRoute}}">Orders</a></li>
                            <li class="breadcrumb-item active">Order View</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">

            <section id="column-visibility">
                <div class="row">

                    <div class="col-xl-8 col-md-8 col-sm-12">
                        <div class="card">
                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">
                                    <div class="row">
                                        <div class="col-12">

                                            <h3 class="card-title">Case Id : {{ $edit_values->case_id }}</h3>
                                            <h3 class="card-title">Aligner : {{ $edit_values->id }}</h3>
                                             @if(isset($doctor['case']))

                                            <h3 class="card-title">Dentist Name : {{ $doctor->name }}</h3>
                                            <h3 class="card-title">Number Of Trays : {{ $case->no_of_trays }}</h3>
                                            
                                             @endif
                                            <h3 class="card-title">Shipping Charges : 0 AED</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">
                                    <form class="form-horizontal" method="post" action="{{route($slug.'.order.update', $edit_values->id)}}" enctype="multipart/form-data" novalidate>
                                        <div class="row">
                                            <div class="col-12 ml-1">
                                                <h3 class="card-title">Order Status</h3>
                                            </div>
                                            
                                            {{csrf_field()}}
                                            @method('PUT')

                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-12 <?php if ($errors->has('name')) echo 'error'; ?>">
                                                        <div class="controls">
                                                            <select name="status" class="select2 form-control">
                                                                <option value="PENDING" @if($edit_values->status == "PENDING") selected @endif >{{ucfirst(strtolower('PENDING'))}}</option>
                                                                <option value="CONFIRMED" @if($edit_values->status == "CONFIRMED") selected @endif >{{ucfirst(strtolower('CONFIRMED'))}}</option>
                                                                <option value="DISPATCHED" @if($edit_values->status == "DISPATCHED") selected @endif >{{ucfirst(strtolower('DISPATCHED'))}}</option>
                                                                <option value="DELIVERED" @if($edit_values->status == "DELIVERED") selected @endif >{{ucfirst(strtolower('DELIVERED'))}}</option>
                                                                <option value="CANCELED" @if($edit_values->status == "CANCELED") selected @endif >{{ucfirst(strtolower('CANCELED'))}}</option>
                                                            </select>
                                                            <hr>
                                                           <input type="url" class="form-control form-control-md" name="order_url" value="{{$edit_values->order_url}}" placeholder="Enter Order Url">
                                                            
                                                            <button type="submit" class="btn btn-primary mt-2"><i class="ft-save"></i> Update</button>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-6 col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                                        <div class="row">
                                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                                                                <img src=" {{asset("link/files/app-assets/images/aligner.png") }}" class="width-100">
                                                            </div>
                                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                                                                <h4 class="card-title mb-1">{{ ucfirst(strtolower($edit_values->product)) }}</h4>
                                                                <small>Unit price:
                                                                    @if($edit_values->discount > 0)
                                                                    <span style="text-decoration: line-through;">{{ $edit_values->unit_amout . ' '. $default_currency }}</span>
                                                                    @endif
                                                                    <span>{{ $edit_values->unit_amout-($edit_values->discount/$edit_values->quantity) }} {{ $default_currency }}</span>
                                                                </small>
                                                                <br />
                                                                <small>Quantity: {{ $edit_values->quantity }}</small>
                                                                <br />
                                                                <small>Shipping Charges: {{ $edit_values->shipping_charges }} {{ $default_currency }}</small>
                                                            </div>
                                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 text-right mt-2">
                                                                {{ $edit_values->total_amount }} {{ $default_currency }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                            </div>

                                        </div>
                                    </form>

                                    <div class="col-md-12 mt-3">
                                        <h3 class="card-title">ORDER URL</h3>
                                        <a href="{{$edit_values->order_url}}" target="_blank">{{$edit_values->order_url}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-xl-4 col-md-4 col-sm-12">
                        <div class="card">
                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">

                                    <div class="row mb-1">
                                        <div class="col-12 text-center">

                                            <img class="media-object rounded-circle width-100" src="{{ isset($edit_values->patient) ? $edit_values->patient->picture : storageUrl_h('')}}" alt="User image">
                                            <p>{{$edit_values->name}}</p>

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">


                                            <h3 class="card-title">General Information</h3>

                                            <label>Email</label>
                                            <p>{{$edit_values->email}}</p>

                                            <label>Phone</label>
                                            <p>{{$edit_values->phone_no}}</p>

                                            <label>Order Date</label>
                                            <p>{{date('d-M-Y h:i:s a', $edit_values->created_date)}}</p>

                                            <hr class="mt-2 mb-2">

                                            <h3 class="card-title">Delivery Address</h3>

                                            <label>Country</label>
                                            <p>{{isset($edit_values->country->name) ? $edit_values->country->name : ''}}</p>

                                            <label>State</label>
                                            <p>{{isset($edit_values->state->name) ? $edit_values->state->name : ''}}</p>

                                            <label>City</label>
                                            <p>{{isset($edit_values->city->name) ? $edit_values->city->name : ''}}</p>

                                            <label>Address1</label>
                                            <p>{{$edit_values->street1}}</p>

                                            <label>Address2</label>
                                            <p>{{$edit_values->street2}}</p>

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
    $(document).ready(function() {

        $("body").on("change", "#client_id", function() {

            var val = $(this).val();

            var data = {
                _token: '{{csrf_token()}}',
                clinic_id: val
            }

            $.ajax({
                url: '{{route($slug.".get-doctor-by-clinic")}}',
                //url: '{{url("admin/clinic-doctors")}}/'+val,
                type: "GET",
                dataType: 'json',
                data: data,   
                beforeSend: function(){
                ajaxLoadercount();
        },
                success: function(responseCollection) {
                    var doctor_id = $('#doctor_id');
                    doctor_id.empty();
                    $.each(responseCollection['data'], function(i, item) {
                        console.log(item.id, item.doctor.name);
                        doctor_id.append($('<option>', {
                            value: item.id,
                            text: item.doctor.name
                        }));
                        //$('#doctor_id').empty().append('<option value="'+item.id+'">'+item.doctor.name+'</option>')
                    });
                    //$("option", "#doctor_id").remove().trigger('change.select2');

                    /*$("#sku_list").append(responseCollection['data']['html']);
                    existingCouponItemIDs.push(val);
                    toastr.success('SKU added successfully', "Success!", {
                        positionClass: "toast-bottom-left",
                        containerId: "toast-bottom-left"
                    });*/

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

@stop