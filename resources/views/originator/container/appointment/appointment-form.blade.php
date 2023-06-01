@extends('originator.root.index')

@section('title', "Appointment")


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

        $viewRoute = route('admin.appointment.index');

    @endphp

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-12 col-12 mb-1">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashbord')}}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{$viewRoute}}">Appointments</a></li>
                                <li class="breadcrumb-item active">Appointment View</li>
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
                                            <h3 class="card-title">Difficult</h3>
                                            <p>{{$edit_values->difficulties}}</p>


                                            <h3 class="card-title mt-4">Treatment Plan</h3>
                                            <p>{{$edit_values->treatment_plan}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-4 col-sm-12">
                            <div class="card">
                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">

                                            <h3 class="card-title">Patient Detail</h3>
                                            
                                            <label>Name</label>
                                            <p>{{$edit_values->patient->name}}</p>
                                            
                                            <label>Email</label>
                                            <p>{{$edit_values->patient->email}}</p>
                                            
                                            <label>Phone</label>
                                            <p>{{$edit_values->patient->phone}}</p>
                                            
                                            <label>Gender</label>
                                            <p>{{$edit_values->patient->gender}}</p>
                                            
                                            <label>Appointment Date</label>
                                            <p>{{date('d-M-Y', $edit_values->appointment_time)}}</p>
                                            
                                            <label>Appointment Time</label>
                                            <p>{{date('h:i:s a', $edit_values->appointment_time)}}</p>
                                            
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

            $("body").on("change", "#client_id", function () {

                var val = $(this).val();

                var data = {
                    _token: '{{csrf_token()}}',
                    clinic_id: val
                }

                $.ajax({
                    url: '{{route("admin.get-doctor-by-clinic")}}',
                    //url: '{{url("admin/clinic-doctors")}}/'+val,
                    type: "GET",
                    dataType: 'json',
                    data: data,                   
                    beforeSend: function(){
                    ajaxLoadercount();
        },
                    success: function (responseCollection) {
                        var doctor_id = $('#doctor_id');
                        doctor_id.empty();
                        $.each(responseCollection['data'], function (i, item) {
                            console.log(item.id,item.doctor.name);
                            doctor_id.append($('<option>', { 
                                value: item.id,
                                text : item.doctor_id 
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