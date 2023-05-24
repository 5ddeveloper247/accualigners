<style>
         body{
            display:none;
         }
         .borderdobx{
            width: auto;
            display:inline-block;
         }
         @media(max-width:500px){
          .abtn{
            
    font-size: 12px!important;
    margin: 2rem!important;

          }
         }
</style>

@php
$title = 'Price Settings';
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

    <div class="mobile-menu-overlay"></div>
    <!-- saadullah -->
    <div class="main-container">
        <div class="m-3">
            <div class="row">
                <div class="col-xl-12 ">
                <div class="row">
                        <div class="col-xl-12 mb-30  dollar">
                           <h5>Currency</h5>
                           <!-- <div class="alert alert-danger"></div> -->

                             <div class=" py-4 px-4 mt-3 borderdobx" id="currency_con">  
                                @foreach($currency as $c)
                                <a class="m-1" id="currency_{{ $c->id }}">{{ $c->name }}<i class="bi bi-x-circle m-2" style="cursor:pointer;" onclick="delete2('currency','{{ $c->id }}')"></i></a> 
                                @endforeach
                                <!-- <a class="m-1"> AED <img src="images/crosseka.png" class="mt-1"></a>    -->
                                <!-- <a class="m-1">Dollar<img src="images/crosseka.png" class="m-1"></a>   
                                <a class="m-1"> Pkr<img src="images/crosseka.png" class="m-1"></a> -->
                                <a class="m-1 text-white bgcolor" data-toggle="modal" data-target="#currency_modal" style="cursor:pointer;">Add More</a>
                             </div>
                        </div>     

                        
                        <div class="col-xl-12 mb-30  dollar">
                        <h5>Digital Scan</h5>
                           <div class=" py-4 px-4 mt-3  borderdobx" id="digital_con">
                             @foreach($setting as $s)
                             @if($s->digital_scan !== null && $s->currency != null && $s->currency_id != 'null')
                                <a class="m-1" id="digital_{{ $s->currency_id }}">{{ $s->digital_scan }} {{ $s->currency }}<i class="bi bi-x-circle m-2" onclick="delete2('digital','{{ $s->currency_id }}')" style="cursor:pointer;"></i></a>   
                              @endif
                                @endforeach
                                <!-- <a class="m-1">3000 PKR<img src="images/crosseka.png" class="m-1"></a> -->
                               <a class="m-1 text-white bgcolor" onclick="Add('digital-scan')" data-toggle="modal" data-target="#additional" style="cursor:pointer;">Add More
                               </a>
                            </div>
                        </div>
                        
                        <div class="col-xl-12 mb-30  dollar">
                           <h5>International Courier Charges</h5>
                           <div class=" py-4 px-4 mt-3  borderdobx" id="international_con">
                           @foreach($setting as $s)
                           @if($s->international_courier_charges !== null && $s->currency != null && $s->currency_id != 'null')
                           <a class="m-1" id="international_{{ $s->currency_id }}"> {{$s->international_courier_charges }} {{ $s->currency }} <i class="bi bi-x-circle m-2" style="cursor:pointer;" onclick="delete2('international','{{ $s->currency_id }}')" ></i></a>   
                           @endif
  
                           @endforeach  
                                <!-- <a class="m-1">10000 PKR<img src="images/crosseka.png" class="m-1"></a>    -->
                               <a class="m-1 text-white bgcolor"  onclick="Add('international')" data-toggle="modal" data-target="#additional" style="cursor:pointer;">Add More
                               </a>
                            </div>
                        </div>
                        
                        <div class="col-xl-12 mb-30  dollar">
                           <h5>Clear Aligners Production Charges</h5>
                           <div class=" py-4 px-4 mt-3  borderdobx" id="aligners_con">
                            @foreach($setting as $s)
                            @if($s->aligner_kit_price !== null && $s->currency != null && $s->currency_id != 'null')
                               <a class="m-1" id="aligners_{{ $s->currency_id }}"> {{$s->aligner_kit_price }} {{ $s->currency }} <i class="bi bi-x-circle m-2" style="cursor:pointer;" onclick="delete2('aligners','{{ $s->currency_id }}')"></i></a>   
                               @endif
                               @endforeach
                                <!-- <a class="m-1">10000 PKR<img src="images/crosseka.png" class="m-1"></a>    -->
                            
                               <a class="m-1 text-white bgcolor"  onclick="Add('aligners')" data-toggle="modal" data-target="#additional" style="cursor:pointer;">Add More
                               </a>
                            </div>
                        </div> 
                        
                        <div class="col-xl-12 mb-30  dollar">
                             <h5>Treatment Plan</h5>
                             <div class=" py-4 px-4 mt-3  borderdobx" id="treatment_con">
                             @foreach($setting as $s)
                              @if($s->complete_treatment_plan !== null && $s->currency != null && $s->currency_id != 'null')
                                <a class="m-1 abtn" id="treatment_{{ $s->currency_id }}"> {{$s->complete_treatment_plan }} {{ $s->currency }}<i class="bi bi-x-circle m-2" style="cursor:pointer;" onclick="delete2('treatment','{{ $s->currency_id }}')"></i></a>   
                              @endif     
                           @endforeach

                                <!-- <a class="m-1">120000 PKR<img src="images/crosseka.png" class="m-1"></a>    -->
                            
                               <a class="m-1 text-white bgcolor abtn"  onclick="Add('treatment-plan')" data-toggle="modal" data-target="#additional" style="cursor:pointer;" style="">Add More
                               </a>
                            </div>
                        </div>
                        </div>
          
                                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab"></div>
            </div>
        </div>


    </div>

    <!-- js -->
    <script src="{{asset('vendors/scripts/core.js')}} "></script>
    <script src="{{asset('vendors/scripts/script.min.js')}} "></script>
    <script src="{{asset('vendors/scripts/setting_ajax.js')}} "></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        function bndka() {
            $('.pop1').addClass('d-none');
        }
        $('.addcase').click(function() {
            $('.pop1').removeClass('d-none');
        });

        function bndka1() {
            $('.pop2').addClass('d-none');
        }
        $('.delete').click(function() {

            $('.pop2').removeClass('d-none');
        });

        $(document).ready(function() {
            $("#example").DataTable();
            
        });

        function Add(value) {

            // $('.digital-scan').style({'display':'none'});
            $(".digital-scan").hide();
            // $('.international').style({'display':'none'});
            $(".international").hide();
            // $('.aligners').style({'display':'none'});
            $(".aligners").hide();
            // $('.treatment-plan').style({'display':'none'});
            $(".treatment-plan").hide();
            // $(`.${value}`).style({'display':'block'});
            $(`.${value}`).show();
        }
        function addcurrency(){
            var value=$('#currency_id').val();
            var upper=value.toUpperCase();
            //    alert(value);
            if(value==""){
               $('#empty_currency').show();
            }else{

                $.ajax({
                url: "{{ url('admin/add_currency') }}",
                method: "POST",
                data: {
                  currency: value,
                },
                beforeSend: function(){
                  $('#loader').show();
                },
               success: function(response) {
                  // Handle successful response
                    console.log(response);
                    if(response.message == 'success'){
                         $('#error').hide();
                         $('#success').show();
                         $('#success').text('Currency Added Successfully');
                         $('#currency_id').val(' ');
                        //  alert('')
                         $('#currency_con').prepend(`<a class="m-1" id="currency_${response.id}">${upper}<i class="bi bi-x-circle m-2" style="cursor:pointer;" onclick="delete2('currency','${response.id}')"></i>`);
                    }else if(response.message == 'error'){
                         $('#error').text(' ');
                         $('#error').text('Something Went Wrong');
                    }else if(response.message == 'error2'){
                         $('#error').text(' ');
                         $('#error').text('Something Went Wrong');
                    }
                    $('#loader').fadeOut();
                 },
               error: function(xhr, status, error) {
                  // Handle errors
                  console.log("Error: " + error);
                  $('#loader').fadeOut();

                 }
             });
         }
     }

     $(document).on('mousedown','#currency_select',function(e){
            //    alert('hello');
          $.ajax({
               url: "{{ url('admin/currencies_get') }}",
               method: "GET",
                success: function(response) {
                 
                // Do something with the response data
                $('.option').remove();
                $('#currency_select').append(response);

              },
               error: function(xhr, status, error) {
                // Handle errors
              console.log("Error: " + error);
             }
         });
     });

    function AddAdditional(){

        if($(".digital-scan").css("display") != "none"){
             var  check="digital_scan";
             var value=$('#digital_scan').val();
             var currency_id=$('#currency_select').val();
        }else if( $(".international").css("display") != "none"){
             var  check="international_courier_charges";
             var  value=$('#International').val();
             var currency_id=$('#currency_select').val();
        }else if( $(".aligners").css("display") != "none"){
             var check="aligner_kit_price";
             var value=$('#Aligners').val();
             var currency_id=$('#currency_select').val();

        }else if( $(".treatment-plan").css("display") != "none"){
             var check="complete_treatment_plan";
             var value=$('#Treatment').val();
             var currency_id=$('#currency_select').val();
        }
             var upper=value.toUpperCase();
             var id=currency_id;
            //  alert(currency_id);
            //  alert(value);
        if(currency_id == 'Default select' || value===' '){
                         $('#success_add').hide();
                         $('#error_add').text(' ');
                         $('#error_add').text('Please fill all the fields');
                         $('#error_add').show();
        }else{
        $.ajax({
                url: "{{ url('admin/add_additional') }}",
                method: "POST",
                data: {
                  check: check,
                  value: value,
                  currency_id: currency_id,
                },
                beforeSend: function(){
                  $('#loader').show();
                },
               success: function(response) {
                  // Handle successful response
                    console.log(response);
                    $('#digital_scan').val(' ');
                    $('#International').val(' ');
                    $('#Aligners').val(' ');
                    $('#Treatment').val(' ');
                    if(response.message == 'success'){
                        //hide error if it is shown
                        // alert('hello');
                        $('#error_add').hide();
                        //add text to success div
                        $('#success_add').text(check+' Added Successfully');
                          //show success
                          $('#success_add').show();
                        //empty currency input
                        // $('#currency_id').val(' ');
                        //add currency to container
                        $('.options').remove();
                        // alert('hello');
                        if(check=='digital_scan'){
                            // alert($("#digital_"+id).length);
                            if ($("#digital_"+id).length) {
                                   // ID exists
                                   $("#digital_"+id).text(' ');
                                   $("#digital_"+id).text(`${upper} ${response.name}`);

                                 }else{
                             // ID does not exist
                             $('#digital_con').prepend(`<a class="m-1" id="digital_${id}"> ${upper} ${response.name} <i class="bi bi-x-circle m-2" style="cursor:pointer;" onclick="delete2('digital','${id}')"></i></a>`);
                             }
                        }else if(check=='international_courier_charges'){
                            // alert($("#international_"+id).length);

                            if ($("#international_"+id).length) {
                                   // ID exists
                                   $("#international_"+id).text(' ');
                                   $("#international_"+id).text(`${upper} ${response.name}`);
                                 }else{
                            $('#international_con').prepend(`<a class="m-1" id="international_${id}"> ${upper} ${response.name} <i class="bi bi-x-circle m-2" style="cursor:pointer;" onclick="delete2('international','${id}')"></i></a>`);
                                 }
                        }else if(check=='aligner_kit_price'){
                            // alert($("#aligners_"+id).length);

                            if ($("#aligners_"+id).length) {
                                   // ID exists
                                   $("#aligners_"+id).text(' ');
                                   $("#aligners_"+id).text(`${upper} ${response.name}`);

                                 }else{
                             $('#aligners_con').prepend(`<a class="m-1" id="aligners_${id}"> ${upper} ${response.name} <i class="bi bi-x-circle m-2" style="cursor:pointer;" onclick="delete2('digital','${id}')"></i></a>`);
                                 }
                        }else if(check=='complete_treatment_plan'){
                            // alert($("#treatment_"+id).length);
                            if ($("#treatment_"+id).length) {
                                   // ID exists
                                   $("#treatment_"+id).text(' ');
                                   $("#treatment_"+id).text(`${upper} ${response.name}`);
                                 }else{
                             $('#treatment_con').prepend(`<a class="m-1" id="treatment_${id}"> ${upper} ${response.name} <i class="bi bi-x-circle m-2" style="cursor:pointer;" onclick="delete2('treatment','${id}')"></i></a>`);
                                 }

                        }

                     }else if(response.message == 'error'){
                        $('#success_add').hide();
                         $('#error_add').text(' ');
                         $('#error_add').text('Something Went Wrong please try again');
                         $('#error_add').show();

                     }
                     $('#loader').fadeOut();

                 },
               error: function(xhr, status, error) {
                  // Handle errors
                        $('#success_add').hide();
                        $('#error_add').text(' ');
                        $('#error_add').text('There was issue in the backend,Try Again');
                        $('#error_add').show();
                        $('#loader').fadeOut();

                //   console.log("Error: " + error);
                 }
             });
        }
    }
 

function onClose(){
         $('error_add').hide();
         $('#success_add').hide();
         $('error').hide();
         $('#success').hide();
}
    </script>
    <script>  
           function delete2(check,id){
            // alert(check);
            // alert(id);
            $.ajax({
                    url: "{{ url('admin/delete') }}",
                    method: "POST",
                    data: {
                      check: check,
                      id: id,
                    },
                    beforeSend: function(){
                  $('#loader').show();
                },
                   success: function(response) {
                           // Handle successful response
                          console.log(response);
                        //   alert(id);

                     if(response.message == 'success'){

                             if(check=='currency'){
                                // alert(id);
                                  $('#currency_'+id).remove();
                                  $('#digital_'+id).remove();
                                  $('#international_'+id).remove();
                                  $('#aligners_'+id).remove();
                                  $('#treatment_'+id).remove();
                                  toastr.success('currency Removed Successfully', '', {timeOut: 2000});
                             }else if(check=='digital'){
                                  $('#digital_'+id).remove();
                                  toastr.success('Digital Scan Removed Successfully', '', {timeOut: 2000});
                             }else if(check=='international'){
                                 $('#international_'+id).remove();
                                //  alert('jkk');
                                 toastr.success('International Courier Charges Removed Successfully', '', {timeOut: 2000});
                             }else if(check== 'aligners'){
                                 $('#aligners_'+id).remove();
                                 toastr.success('Aligners Production Charges Removed Successfully', '', {timeOut: 2000});
                             }else if(check == 'treatment'){
                                 $('#treatment_'+id).remove();
                                 toastr.success('Treatment Plan Removed Successfully', '', {timeOut: 2000});
                             }
                         }else if(response.message == 'error'){
                            toastr.error('Please Try again','Error');
                         }
                         $('#loader').fadeOut();
                     },
                   error: function(xhr, status, error) {
                      // Handle errors
                      toastr.error('Something went Wrong with the AJAX Call','Error');
                    //   console.log("Error: " + error);
                    $('#loader').fadeOut();
                     }
                 });
        }
       $('#digital_scan','#International','#Aligners','#Treatment').on('paste', function(event) {
          // Prevent the default paste behavior
          event.preventDefault();
       });
       $('#digital_scan','#International','#Aligners','#Treatment').on('contextmenu', function() {
  // Prevent the default context menu behavior
          return false;
       });
</script>


<div class="modal fade" id="additional" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
     
      <div class="modal-header">
        <h5 class="modal-title" id="title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
    
      <div class="form-group">

      <div class="alert alert-danger" id="error_add" style="display:none;"></div>
     <div class="alert alert-success" id="success_add" style="display:none" ></div>
         <select selected class="form-control" name="currency" id="currency_select">
          <option>Default select</option>
         </select>
    
        </div>

      <div class="form-group digital-scan">
            <label for="exampleInputEmail1 digital-scan">Digital Scan</label>
             <input type="number"  min="0" class="form-control digital-scan" id="digital_scan" aria-describedby="emailHelp" placeholder="Enter Digital_scan amount">
      </div>
     
      <div class="form-group international">
            <label for="exampleInputEmail1  international">International Courier Charges</label>
             <input type="number"  min="0" class="form-control  international" id="International" aria-describedby="emailHelp" placeholder="International Courier Charges">
     </div>
     
     <div class="form-group aligners">
            <label for="exampleInputEmail1  aligners">Clear Aligners Production Charges</label>
             <input type="number"  min="0" class="form-control aligners" id="Aligners" aria-describedby="emailHelp" placeholder="Enter Clear Aligners Production Charges">
     </div>
     
     <div class="form-group treatment-plan">
            <label for="exampleInputEmail1 treatment-plan">Treatment Plan</label>
             <input type="number" min="0" class="form-control treatment-plan" id="Treatment" aria-describedby="emailHelp" placeholder="Enter Treatment Plan">
     </div>
 
</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="onClose()">Close</button>
        <button type="button"  class="btn bgcolor" style="color:white;" onclick="AddAdditional()">Save changes</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="currency_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
     
      <div class="modal-header">
        <h5 class="modal-title" id="title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
    <div class="alert alert-danger" id="error" style="display:none;"></div>
    <div class="alert alert-success" id="success" style="display:none" ></div>

      <div class="form-group digital-scan">
            <label for="exampleInputEmail1 digital-scan">Currency</label>
             <input type="text" class="form-control digital-scan" id="currency_id" name="currency_value"  aria-describedby="emailHelp" placeholder="Enter currency">
      </div>
    
</div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="onClose()">Close</button>
        <button type="button"  class="btn bgcolor" style="color:white;" onclick="addcurrency()">Save changes</button>
      </div>
    </div>
  </div>
</div>

<!-- <div class="modal fade" id="currency" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add currency</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="alert alert-success" style="display:none;" id="currency_added">currency Successfully Added</div>
       <div class="alert alert-danger" style="display:none;" id="empty_currency">Please Enter currency</div>
      <div class="form-group currency">
            <label for="exampleInputEmail1  currency">Currency</label>
             <input type="text" class="form-control  currency" id="currency_id" name="currency" aria-describedby="emailHelp" placeholder="Enter Currency">
     </div>

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="addcurrency()">Save changes</button>
      </div>
    </div>
  </div>
</div> -->

</body>

      

</html>
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
                    <div class="row m-0  py-4 mt-3" style="border:1px dashed #e3e3e3;border-radius: 8px;">
                        <div class="col-md-3 bold ">
                       
                            <img src="images/gallery.png" style="width:80px;height: 80px;">
                          
                        </div>
                        <div class="col-md-6 bold ">
                                  <h6 class="textcolor pt-3" style="font-size: 14px;">Upload Profile Picture</h6>
                            <span style="font-size: 12px;">Select a file or drag and drop here</span>
                          
                        </div> 
                        <div class="col-md-3 px-4 bold pt-4">
                            <a href="" class="textcolor" >Browse</a>
                          
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
                        <!-- <div class="col-md-6 col ">
                                 <a class="btn bgcolor text-white casebtn float-right ">Submit</a>
                            <a class="btn bgcolorborder float-right mx-3" style="font-size:22px;" onclick="bndka();">Cancel</a>
                           </div> -->
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

</div>