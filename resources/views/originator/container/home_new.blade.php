<style>
    body {
        display: none;
    }

    .tablerow tr th {
        white-space: nowrap !important;
        font-size: 13px !important;
        font-weight: bold;
        border: 0px;
    }

    .tablerow tr td {
        white-space: nowrap !important;
        font-size: 14px;
    }

    @media(max-width:1300px) {
        .main-container1 {
            padding: 20px 20px 0 20px !important;
            padding-left: 20px !important;
        }

    }

    /* .bordertop::before {
  content: '';
  position: absolute;
  bottom: 0;
  left: 10%;
  width: 80%;
  height: 2px;
  background-color: #000;
} */
</style>
@php
    $title = 'Dashboard';
@endphp
@extends('originator.root.dashboard_side_bar', ['title' => $title])
@section('title', 'Dashboard')


@php
    
    $settings = setting_h();
    $role = auth()->user()->role;
    $slug = $role->slug;
    
@endphp

<div class="mobile-menu-overlay"></div>
<!-- saadullah -->
<div class="main-container">
    <div class="m-3">
        <div class="row">

            <div class="fun1">
                <div class="bg-suess cardcolor1 borderradius m-2 p-3">
                    <div class="row py-2">
                        <div class="col-md-3 col">
                            <div class="iconsdoo ">
                                <i class="bi bi-people-fill"></i>
                            </div>
                        </div>
                        <div class="col-md-3 col">
                            <div class="iconsdoo ">
                                <h4>{{ $total_patients }}</h4>
                            </div>
                        </div>
                        <div class="col-md-1 col">
                            <div class="iconsdoo ">
                            </div>
                        </div>
                        <div class="col-md-4 p-0 col d-flex gap-2 align-items-center">
                            <h6 class="m-0" style="color:green;font-size:10px;">2.5%</h6>
                            <div class="iconsd zamado rightarrow">

                                <span style="color:green;font-size:10px;">
                                </span>
                                <i class="bi bi-arrow-up-right"></i>
                            </div>
                        </div>
                        <div class="col-md-12 pt-2 col">
                            <div class="iconsdoo zamado rightarrow">
                                <span style="font-weight: bold;font-size: 10px">Total Patients</span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="fun1">
                <div class="bg-suess cardcolor2 borderradius m-2 p-3">
                    <div class="row py-2">
                        <div class="col-md-3 col">
                            <div class="iconsdoo ">
                                <i class="bi bi-people-fill"></i>
                            </div>
                        </div>
                        <div class="col-md-3 col">
                            <div class="iconsdoo ">
                                <h4>{{ $pending_treatment_plans }}</h4>
                            </div>
                        </div>
                        <div class="col-md-1 col">
                            <div class="iconsdoo ">
                            </div>
                        </div>
                        <div class="col-md-4 p-0 col d-flex gap-2 align-items-center">
                            <h6 class="m-0" style="color:green;font-size:10px;">2.5%</h6>
                            <div class="iconsd zamado rightarrow">

                                <span style="color:green;font-size:10px;">
                                </span>
                                <i class="bi bi-arrow-up-right"></i>
                            </div>
                        </div>
                        <div class="col-md-12 pt-2 col">
                            <div class="iconsdoo zamado rightarrow">
                                <span style="font-weight: bold;font-size: 10px">Pending Treatment Plans</span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="fun1">
                <div class="bg-suess cardcolor3 borderradius m-2 p-3">
                    <div class="row py-2">
                        <div class="col-md-3 col">
                            <div class="iconsdoo ">
                                <i class="bi bi-people-fill"></i>
                            </div>
                        </div>
                        <div class="col-md-3 col">
                            <div class="iconsdoo ">
                                <h4>{{ $approved_treatment_plans }}</h4>
                            </div>
                        </div>
                        <div class="col-md-1 col">
                            <div class="iconsdoo ">
                            </div>
                        </div>
                        <div class="col-md-4 p-0 col d-flex gap-2 align-items-center">
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
    font-size: 10px">Approved Treatment
                                    Plans</span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="fun1">
                <div class="bg-succs cardcolor4 borderradius m-2 p-3">
                    <div class="row py-2">
                        <div class="col-md-3 col">
                            <div class="iconsdoo ">
                                <i class="bi bi-people-fill"></i>
                            </div>
                        </div>
                        <div class="col-md-3 col">
                            <div class="iconsdoo ">
                                <h4>{{ $aligners_production }}</h4>
                            </div>
                        </div>
                        <div class="col-md-1 col">
                            <div class="iconsdoo ">
                            </div>
                        </div>
                        <div class="col-md-4 p-0 col d-flex gap-2 align-items-center">
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
    font-size: 10px">Aligners Production</span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="fun1">
                <div class="bg-succe cardcolor5 borderradius  m-2 p-3">
                    <div class="row py-2">
                        <div class="col-md-3 col">
                            <div class="iconsdoo ">
                                <i class="bi bi-people-fill"></i>
                            </div>
                        </div>
                        <div class="col-md-3 col">
                            <div class="iconsdoo ">
                                <h4>{{ $ready_for_dispatch }}</h4>
                            </div>
                        </div>
                        <div class="col-md-1 col">
                            <div class="iconsdoo ">
                            </div>
                        </div>
                        <div class="col-md-4 p-0 col d-flex gap-2 align-items-center">
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
    font-size: 10px">Ready For Dispatch</span>
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
<div class="main-container1 mr-4 ml-4 pt-0 mb-4 ">
    {{-- <div class=""> --}}
        {{-- <p> --}}
        <div class="row">
            <div class="col-xl-9 ">
                <div class="row">
                    <div class="col-xl-6 ">
                        <div class="mt-4">

                            <div class="widget-data">
                                <h4>Cases</h4>
                            </div>
                        </div>

                    </div>
                    <div class="col-xl-6 mb-30">
                        <div class="carx2 input mt-4">
                            <form action="{{ url(Request()->path()) }}" id="filter-form" method="get">
                                <input type="text" name="filter" class="form-control" placeholder="Search...">
                                <div class="searchicons">
                                    <button type="submit" style="background: none;border:none;"><i
                                            class="bi bi-search" style="margin-right:12px;"></i></button>|
                                    <a
                                        href="{{ Request()->has('filter') ? url(Request()->path()) : 'JavaScript:void(0);' }}">
                                        <i class="bi bi-sliders"></i>
                                    </a>
                                </div>

                        </div>
                    </div>


                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="tabdata" style="margin-bottom:3rem;">
                            <div class=" table-responsive">
                                <table class="table tablerow" id="example">
                                    <thead>
                                        <th>Case ID</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Treatment</th>
                                        <th>Aligners Payment</th>
                                        <th>Order Status</th>
                                    </thead>
                                    <tbody class="tablerow">
                                        @foreach ($active_cases as $active_case)
                                            <tr>
                                                <td class="select-td">{{ $active_case->id }}</td>
                                                <td>{{ ucwords($active_case->name) }}</td>
                                                <td>{{ $active_case->phone_no }}</td>
                                                <td><a class="painbtn">Paid</a></td>
                                                @if (isset($active_case->aligner->payment_name) && !empty($active_case->aligner->payment_name))
                                                    <td><a class="painbtn">Paid</a></td>
                                                @else
                                                    <td><a class="inprogressbtn">UnPaid</a></td>
                                                @endif
                                                @if (isset($active_case->aligner))
                                                    <td class="maindo"><a class="painbtn">Paid</a></td>
                                                @else
                                                    <td class="maindo"><a class="inprogressbtn">UnPaid</a></td>
                                                @endif
                                            </tr>
                                            <!-- <tr>
                                                <td>123245556</td>
                                                <td>DR.Hamza</td>
                                                <td>Phone</td>
                                                <td>Male</td>
                                                <td><a class="painbtn">Paid</a></td>
                                                <td><a class="painbtn">Paid</a></td>
                                                <td><a class="inprogressbtn">Inprogress</a></td>
                                             </tr>                                 -->
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 mb-30 bg- borderleft">
                <div class="row ">
                    <div class="col-md-12 borderbottom ">
                        <div class="row">
                            <div class="col-xl-10 col">
                                <div class="logo mobileka mt-4">
                                    <h5 class="">Order Completed</h5>
                                    <p class="">Last Week</p>
                                </div>
                            </div>
                            <!-- <div class="col-xl-2 col mobilenoneka">
                                    <img src="{{ asset('vendors/images/dots.png') }}">
                                </div> -->
                        </div>
                        <div class="row   m-1 bgcolor mb-4">
                            <div class="col-xl-7  p-3 col">
                                <div class="orderdoo py-2  ">
                                    <h5 class="text-white">{{ $delivered_orders }}</h5>
                                    <p class="text-white">Order Delivered</p>
                                </div>
                            </div>
                            <div class="col-xl-2   col">
                                <div class="dataimg mt-3 p-3">
                                    <span class="text-white">{{ $percentage }}%</span>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-xl-12 col ">
                                <div class="logo ">
                                    <h5 class="">New Doctors</h5>
                                </div>
                            </div>
                        </div>
                        @foreach ($doctors as $d)
                            <div class="row mt-2">
                                <div class="col-md-12 px-3 ">
                                    <div class="row borderfull">
                                        <div class="col-xl-3 col">
                                            <div class="logoimg " style="width:30px;height:30px;">
                                                <img src="{{ asset('vendors/images/roundimg.png') }}">
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col  p-0">
                                            <div class="parado ">
                                                <h5 class="">{{ ucwords($d->name) }}</h5>
                                                <p>ID: {{ $d->id }}</p>

                                            </div>
                                        </div>
                                        <div class="col-xl-5 col ">
                                            <div class="activebar ">
                                                <i class="fa-solid fa-circle"></i>
                                                <span class="">Active</span>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <!-- <div class="row mt-2">
                                <div class="col-md-12 px-3 ">
                                    <div class="row borderfull">
                                        <div class="col-xl-3 col">
                                            <div class="logoimgfalse ">
                                                <img src="{{ asset('vendors/images/roundimg.png') }}">
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col  p-0">
                                            <div class="parado ">
                                                <h5 class="">Murdock</h5>
                                                <p>ID:23245453</p>

                                            </div>
                                        </div>
                                        <div class="col-xl-5 col ">
                                            <div class="activebarfalse ">
                                                <i class="fa-solid fa-circle"></i>
                                                <span class="">Active</span>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-12 px-3 ">
                                    <div class="row borderfull">
                                        <div class="col-xl-3 col">
                                            <div class="logoimgfalse ">
                                                <img src="{{ asset('vendors/images/roundimg.png') }}">
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col  p-0">
                                            <div class="parado ">
                                                <h5 class="">Murdock</h5>
                                                <p>ID:23245453</p>

                                            </div>
                                        </div>
                                        <div class="col-xl-5 col ">
                                            <div class="activebarfalse ">
                                                <i class="fa-solid fa-circle"></i>
                                                <span class="">Active</span>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-12 px-3 ">
                                    <div class="row borderfull">
                                        <div class="col-xl-3 col">
                                            <div class="logoimgfalse ">
                                                <img src="{{ asset('vendors/images/roundimg.png') }}">
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col  p-0">
                                            <div class="parado ">
                                                <h5 class="">Murdock</h5>
                                                <p>ID:23245453</p>

                                            </div>
                                        </div>
                                        <div class="col-xl-5 col ">
                                            <div class="activebarfalse ">
                                                <i class="fa-solid fa-circle"></i>
                                                <span class="">Active</span>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-12 px-3 ">
                                    <div class="row borderfull">
                                        <div class="col-xl-3 col">
                                            <div class="logoimgfalse ">
                                                <img src="{{ asset('vendors/images/roundimg.png') }}">
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col  p-0">
                                            <div class="parado ">
                                                <h5 class="">Murdock</h5>
                                                <p>ID:23245453</p>

                                            </div>
                                        </div>
                                        <div class="col-xl-5 col ">
                                            <div class="activebarfalse ">
                                                <i class="fa-solid fa-circle"></i>
                                                <span class="">Active</span>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-12 px-3 ">
                                    <div class="row borderfull">
                                        <div class="col-xl-3 col">
                                            <div class="logoimgfalse ">
                                                <img src="{{ asset('vendors/images/roundimg.png') }}">
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col  p-0">
                                            <div class="parado ">
                                                <h5 class="">Murdock</h5>
                                                <p>ID:23245453</p>

                                            </div>
                                        </div>
                                        <div class="col-xl-5 col ">
                                            <div class="activebarfalse ">
                                                <i class="fa-solid fa-circle"></i>
                                                <span class="">Active</span>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                        <div class="row my-3">
                            <div class="col-md-12 px-3 ">
                                <div class="row ">
                                    <div class="col-xl-7 col">
                                        <div class="logoimgfalse ">
                                        </div>
                                    </div>
                                    <div class="col-xl-5 col ">
                                        <div class=" fontcontrodo">
                                            <a href="{{ url('admin/doctor') }}" class="textcolor ">View All </a>
                                            <img src="{{ asset('vendors/images/rightarrow.png') }}" class="mt-2">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

        </div>

        <!-- js -->
        <script src="{{ asset('vendors/scripts/core.js') }} "></script>
        <script src="{{ asset('vendors/scripts/script.min.js') }} "></script>
        <script src="{{ asset('vendors/scripts/dashboard_ajax.js') }} "></script>
        <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
        <script>
            $(document).ready(function() {
                $("#example").DataTable();
            });
        </script>

        </body>

        </html>
