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
         $postRoute = route('admin.appointmentStore');

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
                        <div class="col-xl-12 col-md-8 mx-auto col-sm-12">
                            <div class="card">
                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">
                                       <form method="POST" action="{{$postRoute}}">
                                         {{csrf_field()}}
                                         <h3 class="card-title">Patient</h3>
                                             <select name="patient" class="form-control mb-2">
                                     @if(isset($patients) && !empty($patients) && $patients->count()>0)
                                         @foreach($patients as $index=>$value)
                                               <option value="{{isset($value->user->id) && !empty($value->user->id) ? $value->user->id  : '-'}}">{{isset($value->user->name) && !empty($value->user->name) ? $value->user->name  : '-'}}</option>
                                         @endforeach
                                     @endif
                                            </select>
                                            
                                            <h3 class="card-title">Clinic</h3>
                                            <select name="clinic" id="client_id" class="form-control mb-2">
                                                <option>Select</option>
                                                @foreach($clinics as $clinic)
                                                <option value="{{$clinic->id}}">{{$clinic->name}}</option>
                                                @endforeach
                                            </select>
                                            
                                            <h3 class="card-title">Select Doctor</h3>
                                            <select class="form-control mb-2" id="doctor_id" name="doctor">
                                                <option>Select Doctor</option>
                                            </select>
                                            
                                            <h3 class="card-title">Appointment Date</h3>
                                            <input name="appointmentDate" type="date" class="form-control mb-2">
                                                
                                            <h3 class="card-title">Appointment Time</h3>
                                            <input name="appointmentTime" type="time" class="form-control mb-2">
                                        
                                            <h3 class="card-title">Difficult</h3>
                                            <textarea class="w-100 form-control mb-2" name="difficulties"></textarea>
    
                                            <h3 class="card-title mt-4">Treatment Plan</h3>
                                            <textarea class="w-100 form-control mb-2" name="treatment_plan"></textarea>
                                            
                                            <button type="submit" class="btn btn-primary">ADD APPOINTMENT</button>
                                        </form>
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
                //    alert('hello');
                $.ajax({
                    url: '{{route("admin.get-doctor-by-clinic")}}',
                    //url: '{{url("admin/clinic-doctors")}}/'+val,
                    type: "GET",
                    dataType: 'json',
                    data: data,
                    success: function (responseCollection) {
                        // var client_id=$('#client_id');
                         var doctor_id = $('#doctor_id');
                             doctor_id.empty();
                        $.each(responseCollection['data'], function (i, item) {
                            // console.log(item.id,item.doctor.name);
                            $("#client_id option:selected").attr("value", item.id);
                            doctor_id.append($('<option>', { 
                                value: item.doctor_id,
                                text : item.doctor.name 
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