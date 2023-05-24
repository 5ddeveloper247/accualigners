<style>
    body{
        display: none;
    }
    .carousel-item img{
        width:100%;
    }
</style>
@php
$title = 'Dashboard';
@endphp
          @extends('originator.root.dashboard_side_bar',['title' => $title])
     @section('title', "Dashboard")

<link rel="stylesheet" href="{{asset('vendors/css/case-style.css')}}"/>
<style>
    .tablerow tr th{
        white-space:nowrap!important;
    font-size: 13px!important;
        font-weight:bold;
    }
    .tablerow tr td{
        white-space:nowrap!important;
        font-size:14px;
    }
    .fun1{
        width:33.33%!important;
    }
    @media(max-width:500px){
        .fun1 {
        width: 100%!important;
    }
    }
    </style>
<div class="mobile-menu-overlay"></div>
<!-- saadullah -->

    </div>
    
<div class="main-container">
    <div class="m-3">
        <div class="row">
            <div class="col-md-12 p-0 p-2 mb-4">
            <div class="card">

<div class="card-content">
    <div class="card-body">
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                @foreach ($sliders as $idx=>$slider)    
                    <li data-target="#carousel-example-generic" data-slide-to="{{$idx}}" class="@if($idx==0) active @endif"></li>
                @endforeach
                {{--<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                <li data-target="#carousel-example-generic" data-slide-to="2"></li> --}}
            </ol>
            <div class="carousel-inner" role="listbox">
                @foreach ($sliders as $idx=>$slider)    
                    <div class="carousel-item @if($idx==0) active @endif">
                        <img src="{{$slider->slider_image}}" alt="First slide">
                    </div>
                @endforeach

                {{-- <div class="carousel-item">
                    <img src="{{trans('siteConfig.path.adminPanel')}}/app-assets/images/carousel/03.jpg" alt="Second slide">
                </div>
                <div class="carousel-item">
                    <img src="{{trans('siteConfig.path.adminPanel')}}/app-assets/images/carousel/01.jpg" alt="Third slide">
                </div> --}}
            </div>
            <a class="carousel-control-prev" href="#carousel-example-generic" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carousel-example-generic" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</div>
</div>
           <!-- <div class="mainbanner">
                        <img src="{{ asset('vendors/images/bannermain.png') }}">
           </div> -->
            </div>
            </div>
          
        <div class="row">

            <div class="fun1">
                <div class="bg-suess cardcolor1 borderradius m-2 p-3">
                    <div class="row py-2">
                        <div class="col-md-2 col">
                            <div class="iconsdoonu ">
                                <img src="{{ asset('vendors/images/1fi.png') }}">
                            </div>
                        </div>
                        <div class="col-md-2 p-0 col">
                            <div class="iconsdoo ">
                                <h4>{{$total_patients}}</h4>
                            </div>
                        </div>
                        <div class="col-md-1 col">
                            <div class="iconsdoo ">
                            </div>
                        </div>
                        <div class="col-md-6 p-0 col d-flex gap-2 align-items-center justify-content-end">
                            <h6 class="m-0" style="color:green;font-size:10px;">2.5%</h6>
                            <div class="iconsd zamado rightarrow">

                                <span style="color:green;font-size:10px;">
                                </span>
                                <i class="bi bi-arrow-up-right"></i>
                            </div>
                        </div>
                        <div class="col-md-12 pt-2 col">
                            <div class="iconsdoo zamado rightarrow">
                                <span style="
font-weight: bold;
font-size: 10px">Total Patients</span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="fun1">
                <div class="bg-suess cardcolor2 borderradius m-2 p-3">
                    <div class="row py-2">
                        <div class="col-md-2  col">
                            <div class="iconsdoonu ">
                                <img src="{{ asset('vendors/images/2fi.png') }}">
                     
                            </div>
                        </div>
                        <div class="col-md-2 p-0 col">
                            <div class="iconsdoo ">
                                <h4>{{$processing_fee_paid}}</h4>
                            </div>
                        </div>
                        <div class="col-md-1 col">
                            <div class="iconsdoo ">
                            </div>
                        </div>
                        <div class="col-md-6 p-0 col d-flex gap-2 align-items-center justify-content-end">
                            <h6 class="m-0" style="color:green;font-size:10px;">2.5%</h6>
                            <div class="iconsd zamado rightarrow">

                                <span style="color:green;font-size:10px;">
                                </span>
                                <i class="bi bi-arrow-up-right"></i>
                            </div>
                        </div>
                        <div class="col-md-12 pt-2 col">
                            <div class="iconsdoo zamado rightarrow">
                                <span style="font-weight: bold;font-size: 10px">Active Cases</span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="fun1">
                <div class="bg-succe cardcolor5 borderradius  m-2 p-3">
                    <div class="row py-2">
                        <div class="col-md-2 col">
                            <div class="iconsdoo ">
                                <img src="{{ asset('vendors/images/3fi.png') }}">
                            </div>
                        </div>
                        <div class="col-md-2 p-0 col">
                            <div class="iconsdoo ">
                                <h4>{{$total_active_cases}}</h4>
                            </div>
                        </div>
                        <div class="col-md-1 col">
                            <div class="iconsdoo ">
                            </div>
                        </div>
                        <div class="col-md-6 p-0 col d-flex gap-2 align-items-center justify-content-end">
                            <h6 class="m-0" style="color:green;font-size:10px;">2.5%</h6>
                            <div class="iconsd zamado rightarrow">

                                <span style="color:green;font-size:10px;">
                                </span>
                                <i class="bi bi-arrow-up-right"></i>
                            </div>
                        </div>
                        <div class="col-md-12 pt-2 col">
                            <div class="iconsdoo zamado rightarrow">
                                <span style="font-weight: bold;font-size: 10px">Approved Treatment Plans</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row m-0 bordertop mt-4 ">

</div>
<div class="main-container1 pb-5">
    <div class="">
        <p>
        <div class="row">
            <div class="col-xl-12 ">
                <div class="row">
                     <div class="col-xl-6 " style="margin-left:3%;">
                        <div class="">

                            <div class="widget-data">
                                <h4>Cases</h4>
                            </div>
                        </div>

                     </div>
                     
                     <div class="col-xl-4 mb-30">
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

                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="tabdata">
                            <div class=" table-responsive">
                                <table class="table tablerow" id="example" style="padding:0% 3% 3% 3%;">
                                    <thead>
                                        <th>ID</th>
                                        <th>Patients</th>
                                        <th>Case Id</th>
                                        <th>Date</th>
                                        <th>Payment Status</th>
                                        <th>Action</th>
                                    </thead>
                                    <?php  $i=1;  ?>
                                    <tbody class="tablerow">
                                        @foreach ($active_cases as $active_case)

                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td> {{ucwords($active_case->name)}}</td>
                                            <td>{{ $active_case->id }} </td>
                                            <td>{{date('d-M-Y', $active_case->created_date)}}</td>
                                            <td><a class="@if ($active_case->processing_fee_paid) painbtn  @else inprogressbtn   @endif">
                                                @if ($active_case->processing_fee_paid)
                                                Paid
                                            @else
                                                UnPaid
                                            @endif    
                                            </a></td>
                                            <td><a href="{{ url('doctor/case_detail/'.$active_case->id) }}">View Details</a></td>
                                        </tr>
                                       @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

          
        </div>
         <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
         <!-- js -->
         <script src="{{ asset('vendors/scripts/core.js') }}"></script>
         <script src="{{ asset('vendors/scripts/script.min.js') }}"></script>
         <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
         <script>
            $(document).ready(function() {
                $("#example").DataTable();
            });

         </script>
</body>

</html>