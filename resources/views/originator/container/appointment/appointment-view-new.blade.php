<style>
body{
    display:none;
}
</style>
@php
        $title = 'Appointments';
     @endphp
        @extends('originator.root.dashboard_side_bar',['title' => $title])
        @section('title', "Doctor")
     <!-- @php

        $slug = auth()->user()->role->slug;
        $viewRoute = route($slug.'.doctor.index');

        $edit_id = false;
        $form_action = route($slug.'.doctor.store');

         if(Request()->route('doctor')){
            $edit_id = Request()->route('doctor');
            $form_action = route($slug.'.doctor.update', $edit_id);
         }
     @endphp -->
     <!-- <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-119386393-1');
     </script> -->
     @php
     $postRoute = route('admin.appointmentStore');
     @endphp
     <style>
.relativedo{
    position: relative;
}
.absolut{
    position: absolute;
    right: 2px;
}
table th{
    white-space:nowrap!important;
}
</style>


<div class="mobile-menu-overlay"></div>
    <!-- saadullah -->
    <div class="main-container">
        <div class="m-3">
            <div class="row">
                <div class="col-xl-12 ">
                    <div class="row">

                        <div class="col-xl-5 onedo mb-30">
                            <div class="carx2 input">
                            <form action="{{url(Request()->path())}}" id="filter-form" method="get">
                                <input type="text"  name="filter" class="form-control" placeholder="Search...">
                                <div class="searchicons">
                                <button type="submit" style="background: none;border:none;"><i class="bi bi-search" style="margin-right:12px;"></i></button>|
                                    <a href="{{Request()->has('filter') ? url(Request()->path()) : 'JavaScript:void(0);'}}">
                                        <i class="bi bi-sliders"></i>
                                    </a>
                                </div>
                                   </form>
                            </div>
                        </div>
                        <div class="col-xl-3 threedo ">

                        </div>
                        <div class="col-xl-4  fourdo mb-30 bgcolorbordertxt">
                                <a class="btn float-right mx-2 bgcolor text-white casebtn addcase">New Appointment <i class="bi bi-plus-circle"></i></a>
                              <a class="btn btn bg border border-dark  btn-xl color  border-radius-8 bgcolorborder   float-right  delete" style="font-size:22px;width: 93px;">Delete<i class="bi bi-trash3" style=""></i>
                              <a class="ete checkboxbandka cursor cleardo float-right" style="font-size:22px;display: none;">Clear<i class="bi bi-eraser-fill"></i></a>
                            </a>
                        </div>
                    </div>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="tabdata">
                                        <div class=" table-responsive">
                                            <table class="table tablerow" id="example" style="width:100% !important;">
                                                <thead>
                                                <th  class=" checkboxbandka " style="display: none;">
                                                <input type="checkbox" id="btnCheckAll" ></th>
                                                    <th>#</th>
                                                    <th>Patient Name</th>
                                                    <th>Difficulties</th>
                                                    <th>Time</th>
                                                    <th>Appointment Date</th>
                                                    <th>Associated doctor</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </thead>
                                                <tbody class="tablerow">
                                                    <?php $i=1;  ?>
                                                    @php($a = 1)
                                                @foreach($appointments as $appointment)

                                                    <tr data-aeshaz-select-id="{{$appointment->id}}">
                                                    <td  class=" checkboxbandka" style="display: none;">
                                                <input type="checkbox" id="a{{$a++}}" value="{{$appointment->id}}"></td>
                                                        <td>{{ $i++ }}</td>
                                                        <td>{{ucwords($appointment->patient_name)}}</td>
                                                        <td>{{ucfirst($appointment->difficulties)}}</td>
                                                        <td>{{$appointment->appointment_time}}:00

                                                        </td>
                                                        <td>{{$appointment->appointment_date}}</td>
                                                        <!-- <td>{{$appointment->status_title}}</td> -->
                                                        <td>{{ucwords($appointment->doctor_name)}}</td>
                                                        <td class="maindo"><a class="inprogressbtn">{{ucfirst($appointment->status_title)}}</a></td>
                                                        <td><a  class="btn_edit" onclick="edit('{{ $appointment->id }}')"><i class="bi bi-pencil-square"></i></a></td>
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
                                                    <th>#</th>
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
        <script src="{{ asset('vendors/scripts/core.js') }} "></script>
        <script src="{{ asset('vendors/scripts/script.min.js') }}"></script>
        <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <script>
                var base_url = "{{url('admin/')}}";
              function bndka() {
                // $('.pop1').addClass('d-none');
                $('.pop1').fadeOut('slow');

             }
             $('.addcase').click(function() {
                $('#create').removeClass('d-none');
                $('.pop1').fadeIn('slow');

                // $('#frmuser').reset();
                $('#patient').val('select');
                $('#client_id').val('select');
                $('#doctor_id').empty('');
                $('#date_appointment').val(' ');
                $('#time_appointment').val(' ');
                $('#treatment_plan').val('');

            });

         function bndka1() {
                $('.pop2').addClass('d-none');
            }
            // $('.delete').click(function() {

            //     $('.pop2').removeClass('d-none');
            // });

         $(document).ready(function() {
                $("#example").DataTable();
            });
            var records = "{{$a}}";
    $('.delete').click(function() {
        // $('.checkboxbandka').removeClass('d-none');
        // $(".checkboxbandka").show(2500);
        $(".checkboxbandka").delay(200).fadeIn();
        // $(".checkboxbandka").delay(2500).removeClass('d-none');
        $('.checkboxbandka').removeClass('d-none');
        // $('.delete').addClass('d-none');
        // $('.addkado').removeClass('d-none');
        $('.threedo').removeClass('col-xl-3');
        $('.threedo').addClass('col-xl-2');
        $('.fourdo').removeClass('col-xl-4');
        $('.fourdo').addClass('col-xl-5');
        $('.onedo').removeClass('col-xl-5');
        $('.onedo').addClass('col-xl-5');
        var recordId = [];
        var a = 0;
            for(i=1;i<records;i++)
            {
                if($("#a"+i).is(':checked')==true)
                {
                recordId[a] = $("#a"+i).val();
                a++;
                }
            }
        if(recordId.length != 0)
        {
         $(".pop2").removeClass("d-none");
        }
    });

    /*_________________________check All boxes_________________________*/

      var chkboxes = 0;
		  $("#btnCheckAll").click(function () {
			if(chkboxes == 0)
			{
				for(i=1;i<records;i++)
				{
					$("#a"+i).prop('checked', true);
				}
				chkboxes = 1;
			}else{
				for(i=1;i<records;i++)
				{
					$("#a"+i).prop('checked', false);
				}
				chkboxes = 0;
			}

		});

        $('.cleardo').click(function() {
        $('.checkboxbandka').addClass('d-none');
        for(i=1;i<records;i++)
				{
					$("#a"+i).prop('checked', false);
				}
                $('#btnCheckAll').prop('checked',false);
        $('.').removeClass('col-xl-4');
        $('.tthreedohreedo').addClass('col-xl-3');
        $('.fourdo').removeClass('col-xl-3');
        $('.fourdo').addClass('col-xl-4');
        $('.onedo').removeClass('col-xl-4');
        $('.onedo').addClass('col-xl-5');

    });

/*_________________________Edit show ajax________________________*/
function edit(value) {
      $('#create').removeClass('d-none');
      $('#ElementId').val(value);
      $.ajax({
        type: 'POST',
        url: base_url+"/appointment_get",
        data: {
            _token: '{{csrf_token()}}',
          id: value
          },
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
          success: function (response) {
             
     if(response){
             $("#patient").val(response.data.patient_id);
             $("#client_id").val(response.clinic_id);
             var doctor_id = $('#doctor_id').empty();
             // $("#doctor_id").val();
             doctor_id.append($('<option>', {
                        value: response.doctor.id,
                        text : response.doctor.name
                    }));
             // $('#doctor_id').prepend
             $("#date_appointment").val(response.data.appointment_date);
             if(response.data.appointment_time < 10){
                $("#time_appointment").val('0'+response.data.appointment_time+':00');
             }else{
             $("#time_appointment").val(response.data.appointment_time+':00');
             }
             $("#treatment_plan").val(response.data.treatment_plan);

             // $('.pop1').removeClass('d-none');
    }else{
        toastr.error('some error','Error');
    }
},
error: function (data) {
    $('#loader').fadeOut();
    toastr.error('Something Went Wrong', 'Error');
}
});
}

    $("body").on('change','#client_id',function () {
        // alert('hello');
        var val = $(this).val();
        var data = {
            _token: '{{csrf_token()}}',
            clinic_id: val
        }
        // alert(val);
        //    alert('hello');
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
                // var client_id=$('#client_id');
                 $('#loader').fadeOut();
                 var doctor_id = $('#doctor_id');
                     doctor_id.empty();
                $.each(responseCollection['data'], function (i, item) {
                    // console.log(item.id,item.doctor.name);
                    // $("#client_id option:selected").attr("value", item.id);
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
                toastr.error(responseCollection['message'],'Error');

                // toastr.error(responseCollection['message'], "Error!", {
                //     positionClass: "toast-bottom-left",
                //     containerId: "toast-bottom-left"
                // });
                $('#loader').fadeOut();
            }
        }); //end of ajax
    });

</script>

</body>

</html>
<form method="POST"  id="frmuser">
<div class="pop1 scrolldo" id="create" style="display: none">
    <div class="row m-0">
             <div class="col-md-7">
             </div>
        <div class="col-md-5 bg-white pb-5 popadd">
             <div class="page6box py-3 p-2">
             </div>
            <div class="row px-4 mb-5 ">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12 relativedo">
                            <h5 class="textcolor">Add New Appointment</h5>
                            <p class="greytext">Complete the information related to Appointment</p>
                            <i class="fa-solid absolut  cursor fa-xmark " onclick="bndka();" style="
                            margin-top: -64px;"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 px-4 brdall py-4">
                    <div class="row  ">
                           <h5 class="textcolor px-2">Appointment's Detail</h5>
                    </div>

                    <div class="row  pt-4">
                               <div class="col-md-6  ">
                              <span>Patient Name</span>
                            <select class="form-select form-control" name="patient" id="patient" selected required>
                            <option value="select">Select</option>
                            @if(isset($patient) && !empty($patient) && $patient->count()>0)
                                             @foreach($patient as $index=>$value)
                                            <option name="patient" value="{{ isset($value->user->id) && !empty($value->user->id) ? $value->user->id  : '-'}}">{{isset($value->user->name) && !empty($value->user->name) ? $value->user->name  : '-'}}</option>
                                                  @endforeach
                                               @endif
                            </select>
                        </div>
                        <div class="col-md-6 mb-4  ">
                            <span>Clinic</span>
                                <select class="form-select form-control" name="clinic_doctor_id" id="client_id" selected required>
                                       <option value="select">Select Clinic</option>
                                 @if(isset($clinics) && !empty($clinics) && $clinics->count()>0)
                                       @foreach($clinics as $clinic)
                                        <option name="clinic"  value="{{$clinic->id}}">{{$clinic->name}}</option>
                                         @endforeach
                                    @endif
                            </select>
                        </div>
                        <div class="col-md-6 mb-4  ">
                            <span>Select Doctor</span>
                             <select id="doctor_id" name="doctor_id"class="form-select form-control" selected required>
                                       <option value="select">Select Doctor</option>
                            </select>
                        </div>
                         <div class="col-md-6 mb-4  ">
                            Appointment Date
                           <input type="date" name="appointment_date" value="" class="form-control" id="date_appointment" placeholder="Enter Here" required>
                         </div>

                         <div class="col-md-12 mb-4  ">
                            Appointment Time
                           <input type="time" name="appointment_time" class="form-control" value="" id="time_appointment" placeholder="Enter Here" required>
                         </div>

                         <div class="col-md-12 b-4  ">
                            Treatment plan*
                           <textarea name="treatment_plan" id="treatment_plan" class="form-control" id="treatment_plan" height="200" required>
                            </textarea>
                         </div>
                    </div>
                </div>
                <input type="hidden" id="ElementId"/>
                    </div>
             <div class="row mt-3 ">
                           <div class="col-md-12 col ">
                                 <button  class="btn bgcolor text-white casebtn float-right mx-2">Submit</button>
                                 <a class="btn bg border border-radius-8 btn btn-xl color mb-5  bgcolorborder float-right mx-2" style="font-size:22px;" onclick="bndka();">Cancel</a>
                           </div>
                    </div>
                 </div>
             </div>
        </div>
    </form>

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
                    <a class="btn  text-white casebtn float-right deletebtn" id="delete_ajax">Delete</a>
                    <a class="btn cancelbtn  text-white  float-right" onclick="bndka1();">Cancel</a>

                </div>
            </div>
        </div>
    </div>
</div>
<script>
/*_________________________Update and save ajax_________________________*/
$("#frmuser").submit(function (event) {

         event.preventDefault();

         if( $('#patient').val() === '' || $('#patient').val() == 'select'){
            toastr.error('Patient is required', 'error', {timeOut: 2000});
            return;
         }
         if($('#client_id').val() === '' ||  $('#client_id').val() == 'select'){
            toastr.error('Client is required', 'error', {timeOut: 2000});
            return;
         }
         if($('#doctor_id').val() === '' || $('#doctor_id').val() === 'select'){
            toastr.error('Doctor is required', 'error', {timeOut: 2000});
            return;
         }
         if($('#date_appointment').val() === ''){
            toastr.error('Date is required', 'error', {timeOut: 2000});
            return;
         }
         if($('#time_appointment').val() === ''){
            toastr.error('Time is required', 'error', {timeOut: 2000});
            return;
         }
         if($('#treatment_plan').val() === ''){
            toastr.error('Treatment Plan is required', 'error', {timeOut: 2000});
            return;
         }


     var data = new FormData(frmuser);
     var id = $("#ElementId").val();
/*_________________________Update ajax_________________________*/
    if(id != ''){

     $.ajax({
     type: "POST",
     url: base_url+"/appointment_update/"+id,
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
       
        if(data.successMessage == 'Success')
            {
                $("#ElementId").val(' ');
                toastr.success('Data Updated Successfully', '', {timeOut: 2000});
                // $('.pop1').addClass('d-none');
                $('.pop1').fadeOut('slow');

                setTimeout(function () {location.reload(true)}, 1000);
            }else{
                toastr.error('something Went Wrong PLease Try Again', '', {timeOut: 2000});
            }
     },
     error: function(message, error)
     {
        $('#loader').fadeOut();
        toastr.error('Something Went Wrong, Try Again', '', {timeOut: 2000});

        // $.each(mess, function( key, value ) {
        //         toastr.error(value, {timeOut: 3000});
        //     });
         }
     });
    }else{

/*_________________________Save ajax_________________________*/
    $.ajax({
        type: "POST",
        url: base_url+"/appointment_add",
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
           
            if(data.successMessage == 'Success')
            {
                toastr.success('Data Created Successfully', '', {timeOut: 2000});
                // $('.pop1').addClass('d-none');
                $('.pop1').fadeOut('slow');

                setTimeout(function () {location.reload(true)}, 1000);
            }else{
                toastr.error('Something Went Wrong, Try Again', '', {timeOut: 2000});
            }
         },
         error: function(message, error)
         {
            $('#loader').fadeOut();
            toastr.error('Something Went Wrong, Try Again', '', {timeOut: 2000});

            // $.each('Something Went Wrong, Try Again', function( key, value ) {
            //     toastr.error(value, {timeOut: 3000});
            // });
         }
    });
    }
});

 /*_________________________Delete data ajax_________________________*/
 $(".deletebtn").click(function (event) {
			event.preventDefault();

            var recordId = [];
            var a = 0;
                for(i=1;i<records;i++)
                {
                    if($("#a"+i).is(':checked')==true)
                    {
                    recordId[a] = $("#a"+i).val();
                    a++;
                    }
                }

            if(recordId.length != 0)
            {
				$.ajax({
				type: 'DELETE',
				url: base_url+"/appointment_delete/"+recordId,
				data: {
				},                         
                beforeSend: function(){
                ajaxLoadercount();
        },
				success: function (data) {
                    $('#loader').fadeOut();
					if(data){
							if(data.done == true)
							{
								$(".pop2").addClass("d-none");
								toastr.success(data.msg, '', {timeOut: 2000});
								setTimeout(function () {location.reload(true)}, 1000);
							}else{
								toastr.error(data.msg, '', {timeOut: 2000});
							}
				     	}else{
						toastr.error('some error','Error');
					 }
				},
				error: function (data) {
				    	toastr.error('Something Went Wrong', 'Error');
                        $('#loader').fadeOut();

			     	}
				});
        }
		});


</script>
