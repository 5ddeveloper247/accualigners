
@php
$title = 'Doctors';
@endphp
@extends('originator.root.dashboard_side_bar',['title' => $title])
@section('title', "Doctor")
@php
        $slug = auth()->user()->role->slug;
        $viewRoute = route($slug.'.doctor.index');

        $edit_id = false;
        $form_action = route($slug.'.doctor.store');

        if(Request()->route('doctor')){
            $edit_id = Request()->route('doctor');
            $form_action = route($slug.'.doctor.update', $edit_id);
        }

@endphp
<style> 
body{
    display:none;
}
table th{
    font-size: 14px!important;
}
table td{
    font-size: 14px!important;
}

</style>
    <div class="mobile-menu-overlay"></div>
    <!-- saadullah -->
    <div class="main-container">
        <div class="m-3">
            <div class="row pb-5">
                <div class="col-xl-12 ">
                    <div class="row">

                        <div class="col-xl-5 mb-30">
                        <div class="carx2 input">
                            <form action="{{url(Request()->path())}}" id="filter-form" method="get">
                                <input type="text" name="filter" class="form-control" placeholder="Search...">
                                <div class="searchicons">
                                    <button type="submit" style="background: none;border:none;"><i class="bi bi-search" style="margin-right:12px;"></i></button>|
                                    <a href="{{Request()->has('filter') ? url(Request()->path()) : 'JavaScript:void(0);'}}">
                                        <i class="bi bi-sliders"></i>
                                    </a>
                                </div>
                            
                            </form>
                            </div>
                        </div>
                        <div class="col-xl-2 ">


                        </div>
                        <div class="col-xl-5 mb-30 bgcolorbordertxt">
                            <!-- <a class="btn bgcolor text-white casebtn addcase float-right" style="margin-left:7%;">New Appointment <i class="bi bi-plus-circle"></i></a>

                            <a class="btn bgcolorborder  delete" style="font-size:22px; float:right">Delete<i class="bi bi-trash3" style=""></i></a> -->

 
                            <a class="btn bgcolor float-right m-1 text-white  addcase"  onclick="editFunction()">Add New Doctor<i class="bi bi-plus-circle"></i></a>
                            
                            <a class="btn bgcolorborder  m-1 float-right delete" style="font-size:22px;">Delete<i class="bi bi-trash3"></i></a>
                      
                            <a class="ete checkboxbandka cursor cleardo float-right" style="margin-top:5px;font-size:22px;display: none;">Clear
                            <i class="bi bi-eraser-fill"></i></a>

                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-12">
                            <div class="tabdata">
                                <div class=" table-responsive">
                                    <table class="table tablerow" id="example" style="width:100% !important">
                                        <thead>  
                                            <th  class=" checkboxbandka " style="display: none;">
                                        <input type="checkbox" id="btnCheckAll" ></th>
                                            <th>Doctor ID</th>
                                            <th>Dentist</th>
                                            <th>Email</th>
                                            <th>Number</th>
                                            <th></th>

                                        </thead>
                                        <tbody class="tablerow">                              
                                        @php($a = 1)
                                        @foreach($doctors as $doctor)
                                            <tr>
                                                <td  class=" checkboxbandka" style="display: none;">
                                                <input type="checkbox"  id="a{{$a++}}" value="{{$doctor->id}}"></td>
                                                <td>{{$doctor->id}}</td>
                                                <td>{{ucwords($doctor->name)}}</td>
                                                <td>{{ucfirst($doctor->email)}}</td>
                                                <td>{{($doctor->phone == null)? 'Not available' : $doctor->phone}}</td>
                                                <td><a  class="btn_edit" onclick="editFunction({{$doctor->id}})"><i class="bi bi-pencil-square"></i></a></td>
                                                <!-- <td><img src="{{asset('vendors/images/dots.png')}}"></td> -->
                                            </tr>
                                        @endforeach
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
    <!-- js -->
    <script src="{{asset('vendors/scripts/core.js')}} "></script>
    <script src="{{asset('vendors/scripts/script.min.js')}} "></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script>

         function bndka() {
            // $('.pop1').addClass('d-none');
            $('.pop1').fadeOut('slow');
         }
         $('.addcase').click(function() {
            // $('.pop1').removeClass('d-none');
            $('.pop1').fadeIn('slow');

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
    </script>

</body>

</html>
<div class="pop1  scrolldo" style="display: none">
<form class="form-horizontal" method="post" id="frmuser" action="" enctype="multipart/form-data" novalidate>
      @csrf
                 {{-- {{csrf_field()}} --}}
     <div class="row m-0">
         <div class="col-md-7">
         </div>
        <div class="col-md-5 bg-white popadd  doctor" style="height: 700px;">
            <div class="page6box py-3 p-2">
            </div>
            <div class="row px-4 mb-5 ">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-11 bold m-auto">
                            <h5 class="textcolor">Add New Doctor</h5>
                            <p class="greytext">
                              Complete the information related to the doctor</p>
                            <i class="fa-solid float-right bandeka cursor fa-xmark " onclick="bndka();"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 px-4 brdall py-4">
                    <div class="row">
                           <h5 class="textcolor px-2">Doctor's Detail</h5>
                    </div>
                    <div class="row m-0  py-4 mt-3" style="border:1px dashed #e3e3e3;border-radius: 8px;">
                         <div class="col-md-3 bold ">
                       
                        <img src="{{asset('vendors/images/gallery.png')}}" id="output" style="width:80px;height: 80px;border-radius:50%;">
                          
                         </div>
                        <div class="col-md-6 bold ">
                                  <h6 class="textcolor pt-3" style="font-size: 14px;">Upload Profile Picture</h6>
                            <span style="font-size: 12px;">Select a file to upload</span>
                          
                        </div> 
                        <div class="col-md-3 px-4 bold pt-4">
                            <a class="textcolor add_files_btn" style="cursor: pointer;">Browse</a>
                            <input type="file" id="picture" name="picture" class="fileInput" accept="image/*"  hidden>
                          
                        </div>
            
                    </div>
                             
                    <div class="row  pt-4">
                               <div class="col-md-6 bold ">
                            <span>Full Name*</span>
                            <input type="text" name="ElementId" id="ElementId" hidden/>
                            <input type="text" name="name" id="txtname" class="form-control" placeholder="Enter Here" required>
                        </div>
           
                              <div class="col-md-6 mb-4 bold ">
                            <span>Email*</span>
                            <input type="email" name="email" id="txtemail" class="form-control" placeholder="Enter Here" required>
                        </div>      <div class="col-md-6 bold ">
                            <span>Password*</span>
                            <input type="password" name="password" @if( !$edit_id ) required data-validation-required-message="Password is required" @endif id="txtpass" class="form-control" placeholder="Enter Here">
                        </div>      <div class="col-md-6  bold ">
                            <span>Confirm Password*</span>
                            <input type="password" name="password_confirmation" id="confirm_password" class="form-control" placeholder="Enter Here">
                        </div>
                    </div>
              
                   
                </div>
                    </div>
             <div class="row my-3 ">
                    
                        <div class="col-md-12 col ">
                            <button type="submit" class="btn bgcolor text-white casebtn float-right  mx-2">Submit</button>
                            <a class="btn bgcolorborder float-right mx-3" style="font-size:22px;" onclick="bndka();">Cancel</a>
                           </div>
            </div>
            </div>
        </div>
    </form>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    var img_asset = "{{asset('vendors/images/')}}";
    var base_url = "{{url('admin/')}}";
    var records = "{{$a}}";
$('.hitme').click(function(){
    $('.pop2').removeClass('d-none');
});

$('.delete').click(function() {
    $('.checkboxbandka').removeClass('d-none');
     $(".checkboxbandka").delay(100).fadeIn();
    //code for selectig each checkbox
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

  $('.cleardo').click(function(){
          $('.hitme').addClass('d-none');
             for(i=1;i<records;i++)
				 {
					$("#a"+i).prop('checked', false);
				 }
             $('.checkboxbandka').addClass('d-none');
     });
</script>
<script src="{{asset('vendors/scripts/doctor_ajax.js')}}"></script>