<style>

     body{
        display:none;
     }
     .imgdata img{

    height: 200px;
    background-size: cover;
    width: 280px;
     }
     .bi-pencil-square::before{
        color: #f7faff;
    background: #00205c;
     }
</style>
@php
$title = 'Sliders';
@endphp
@extends('originator.root.dashboard_side_bar',['title' => $title])

@section('title', "Slider")


@section('content')
    @php
        $slug = auth()->user()->role->slug;
        $viewRoute = route($slug.'.slider.index');

        $edit_id = false;
        $form_action = route($slug.'.slider.store');

        if(Request()->route('slider')){
            $edit_id = Request()->route('slider');
            $form_action = route($slug.'.slider.update', $edit_id);
        }
    @endphp

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
                                <input type="text" name="filter" class="form-control" placeholder="Search..." value="{{Request()->has('filter') ? Request()->get('filter') : ''}}">
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
                            <a class="btn bgcolor text-white casebtn addcase float-right" style="margin-left:7%;">New Slider <i class="bi bi-plus-circle"></i></a>
                            <a class="btn btn bg border border-dark  btn-xl color  border-radius-8 bgcolorborder   float-right  delete" style="font-size:22px; float:right">Delete<i class="bi bi-trash3" style=""></i></a>
                            <a class="ete checkboxbandka cursor cleardo float-right d-none" style="font-size:22px;">Clear <i class="bi bi-eraser-fill"></i></a>
                        </div>
                    </div>
                    <div class="row ctr">
                    @php($a = 1)
                    @foreach($sliders as $slider)
                        <div class="col-md-3">
                         <div class="checkboxbandka d-none">
                            <input type="checkbox"  id="a{{$a++}}" value="{{$slider->id}}" style="position: absolute;left: 7%;top: 2%;cursor:pointer;">
                        </div>
                        <div class="imgdata" style="height:250px;">
                          <a  class="btn_edit" onclick="editFunction({{$slider->id}})" style="cursor:pointer;">
                          <i class="bi bi-pencil-square" style="position: absolute;right: 8%;top: 4%;color: #00205c;font-size: 20;"></i>
                          </a>
                         <img src="{{$slider->slider_image}}" class="img-fluid" style="border-radius:10px;">
                         <p class="text-center"> {{$slider->sort_order}}</p>
                        </div>
                        </div>
                @endforeach
                </div>
                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab"></div>
            </div>
        </div>


    </div>
</body>

</html>
<div class="pop1 scrolldo" style="display: none">
<form class="form-horizontal" method="post" id="frmuser" action="" enctype="multipart/form-data" novalidate>
{{csrf_field()}}
    <div class="row m-0">
        <div class="col-md-7">
        </div>
        <div class="col-md-5 bg-white popadd" style="height: 650px;">
            <div class="page6box py-3 p-2">
            </div>
            <div class="row px-4 mb-5 ">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12 bold m-auto">
                            <h5 class="textcolor">Add New Slider</h5>
                            <p class="greytext">Complete the information related to the slider</p>
                            <i class="fa-solid bandeka float-right cursor fa-xmark " onclick="bndka();"></i>
                        </div>

                    </div>
                </div>
                <div class="col-md-12 px-4 brdall py-4">
                    <div class="row  ">
                           <h5 class="textcolor px-2">Slider's Detail</h5>
                    </div>
                    <div class="row m-0  py-4 mt-3" style="border:1px dashed #e3e3e3;border-radius: 8px;">
                        <div class="col-md-3 bold ">

                        <img src="{{asset('vendors/images/gallery.png')}}" id="output" style="width:80px;height: 80px;border-radius:50%;">

                        </div>
                        <div class="col-md-6 bold ">
                                  <h6 class="textcolor pt-3" style="font-size: 14px;">Upload Profile Picture</h6>
                            <span style="font-size: 12px;">The file Dimensions should be height: 380 px width: 980 px</span>

                        </div>
                        <div class="col-md-3 px-4 bold pt-4">
                            <a class="textcolor add_files_btn" style="cursor: pointer;">Browse</a>
                            <input type="file" id="slider_image" name="slider_image" class="fileInput" accept="image/*" value="" hidden required>

                        </div>

                    </div>

                    <div class="row  pt-4">
                               <div class="col-md-12 bold ">
                            <span>Sort Order*</span>
                            <input type="text" name="ElementId" id="ElementId" hidden/>
                            <input type="number" name="sort_order" id="sort_order" class="form-control" placeholder="Enter Here">
                        </div>

                    </div>


                </div>
                    </div>
             <div class="row mt-3 ">

                        <div class="col-md-12 col ">
                            <button type="submit" class="btn bgcolor text-white casebtn float-right ">Submit</button>
                            <a class="btn bg border border-radius-8  btn-xl color  mb-5 bgcolorborder float-right mx-2" style="font-size:22px;" onclick="bndka();">Cancel</a>
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
  <!-- js -->
    <script src="{{asset('vendors/scripts/core.js')}} "></script>
    <script src="{{asset('vendors/scripts/script.min.js')}} "></script>
    <script src="{{asset('vendors/scripts/slider_ajax.js')}} "></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script>
        var img_asset = "{{asset('vendors/images/')}}";
        var base_url = "{{url('admin/')}}";
        var records = "{{$a}}";
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
         $(document).ready(function() {
            $("#example").DataTable();
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
        $('.cleardo').click(function() {
            $('.hitme').addClass('d-none');
            $('.checkboxbandka').addClass('d-none');
            for(i=1;i<records;i++)
				{
					$("#a"+i).prop('checked', false);
				}
        });
    </script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
