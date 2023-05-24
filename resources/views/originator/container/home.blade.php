@extends('originator.root.index')

@section('title', "Dashboard")

@section('content')

@php

    $requiredSections = [
        //'Header' => 'originator.components.header',
        //'Nav' => 'originator.components.nav',
        'Header' => 'originator.components.side-nav',
        'Footer' => 'originator.components.footer'
    ];

    $componentsJsCss = [
        'adminPanel.general',
        'adminPanel.chats',
        'adminPanel.dashboard-sales',
    ];

    $settings = setting_h();
$role = auth()->user()->role;
$slug = $role->slug;
@endphp

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-12 col-12 mb-1">
                <h2><i class="la la-angle-left font-medium-5"></i> Dashbord</h2>
            </div>
        </div>
        <div class="content-body">

            @if(Request()->user()->role->slug == "admin")

                <div class="row">
                    <div class="col-12 col-md-12">
                        <div class="card">
                            <div class="card-header">
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body pt-0">
                                    <div class="row">
                                        <div class="col-md col-12 border-right-blue-grey border-right-lighten-5 text-center">
                                            <i class="la la-user-plus info font-large-1"></i>
                                            <h4 class="font-large-1 text-bold-400">{{$total_patients}}</h4>
                                            <p class="text-light mb-0">Total Patients</p>
                                        </div>
                                        <div class="col-md col-12 text-center">
                                            <i class="la la-medkit info font-large-1"></i>
                                            <h4 class="font-large-1 text-bold-400">{{$pending_treatment_plans}}</h4>
                                            <p class="text-light lighten-2 mb-0">Pending Treatment Plans</p>
                                        </div>
                                        <div class="col-md col-12 border-right-blue-grey border-right-lighten-5 text-center">
                                            <i class="la la-bar-chart info font-large-1"></i>
                                            <h4 class="font-large-1 text-bold-400">{{$approved_treatment_plans}}</h4>
                                            <p class="text-light lighten-2 mb-0">Approved Treatment Plans</p>
                                        </div>
                                        <div class="col-md col-12 text-center">
                                            <i class="la la-bar-chart info font-large-1"></i>
                                            <h4 class="font-large-1 text-bold-400">{{$aligners_production}}</h4>
                                            <p class="text-light lighten-2 mb-0">Aligners Production</p>
                                        </div>
                                        <div class="col-md col-12 border-right-blue-grey border-right-lighten-5 text-center">
                                            <i class="la la-bar-chart info font-large-1"></i>
                                            <h4 class="font-large-1 text-bold-400">{{$ready_for_dispatch}}</h4>
                                            <p class="text-light lighten-2 mb-0">Ready For Dispatch</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">

                    <div id="recent-sales" class="col-12 col-md-12">
                        <div class="card">
                            <div class="card-header d-none">
                                <h4 class="card-title">Cases Process</h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a class="card-link text-light pull-right" href="{{route('admin.case.index')}}">View all</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content mt-1">
                                <div class="table-responsive">
                                    <table id="recent-orders" class="table table-hover table-xl mb-0">
                                        <thead>
                                        <tr>
                                            <th>Case ID</th>
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th>Gender</th>
                                            <th>Treatment Plan</th>
                                            <th>Aligners Payment</th>
                                            <th>Order Status</th>
                                            <!--<th class="RolePermissionAction">Action</th>-->
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($active_cases as $active_case)
                                                <tr data-aeshaz-select-id="{{$active_case->id}}">
                                                <td class="select-td">{{$active_case->id}}</td>
                                                <td>{{$active_case->name}}</td>
                                                <td>{{$active_case->phone_no}}</td>
                                                <td>{{$active_case->gender}}</td>
                                                <td>
                                                    {{--@if ($active_case->processing_fee_paid)
                                                        <div class="badge badge-pill badge-border badge-glow border-success success badge-square">Paid</div>
                                                    @else
                                                        <div class="badge badge-pill badge-border badge-glow border-danger danger badge-square">Unpaid</div>
                                                    @endif--}}
                                                    <a href="{{route($slug.'.case.show', $active_case->id)}}" class="btn btn-md btn-round btn-primary"><i class="ft-eye"></i></a>
                                                </td>
                                                <td>
                                                    @if (isset($active_case->aligner->payment_name) && !empty($active_case->aligner->payment_name))
                                                        <div class="badge badge-pill badge-border badge-glow border-success success badge-square">Paid</div>
                                                    @else
                                                        <div class="badge badge-pill badge-border badge-glow border-danger danger badge-square">Unpaid</div>
                                                    @endif
                                                </td>
                                                <td>
                                                    <!--@if ($active_case->status == "CANCELED")-->
                                                    <!--    <div class="badge badge-pill badge-border badge-glow border-danger danger badge-square">{{ucfirst(strtolower($active_case->status))}}</div>-->
                                                    <!--@elseif ($active_case->status == "PENDING")-->
                                                    <!--    <div class="badge badge-pill badge-border badge-glow border-warning warning badge-square">{{ucfirst(strtolower($active_case->status))}}</div>-->
                                                    <!--@else-->
                                                    <!--    {{-- <div class="badge badge-pill badge-border badge-glow border-success success badge-square">{{ucfirst(strtolower($active_case->status))}}</div> --}}-->
                                                    <!--    @if ((empty($active_case->video_uploaded) && empty($edit_values->video_embedded)))-->
                                                    <!--        <div class="badge badge-pill badge-border badge-glow border-info info badge-square">{{ucfirst(strtolower("Acculigners Lab"))}}</div>-->
                                                    <!--    @elseif ((!empty($active_case->video_uploaded) || !empty($edit_values->video_embedded)) && !$active_case->has_concern && empty($active_case->aligner_kit_order_id))-->
                                                    <!--        <div class="badge badge-pill badge-border badge-glow border-warning warning badge-square">{{ucfirst(strtolower("Review to dentist"))}}</div>-->
                                                    <!--    @elseif ($active_case->has_concern)-->
                                                    <!--        <div class="badge badge-pill badge-border badge-glow border-info info badge-square">{{ucfirst(strtolower("Review to you"))}}</div>-->
                                                    <!--    @elseif (!empty($active_case->aligner_kit_order_id) && isset($active_case->aligner->status))-->
                                                    <!--        @if ($active_case->aligner->status == "DELIVERED")-->
                                                    <!--            <div class="badge badge-pill badge-border badge-glow border-success success badge-square">{{ucfirst(strtolower($active_case->aligner->status))}}</div>-->
                                                    <!--        @elseif ($active_case->aligner->status == "CANCELED")-->
                                                    <!--            <div class="badge badge-pill badge-border badge-glow border-danger danger badge-square">{{ucfirst(strtolower($active_case->aligner->status))}}</div>-->
                                                    <!--        @else-->
                                                    <!--            <div class="badge badge-pill badge-border badge-glow border-success success badge-square">{{ucfirst(strtolower("Order in production"))}}</div>-->
                                                    <!--        @endif-->
                                                    <!--    @endif-->
                                                    <!--@endif-->
                                                    @if(isset($active_case->aligner))
                                                     <a href="{{route($slug.'.order.edit', $active_case->aligner->id)}}" class="btn btn-md btn-round btn-primary">View</a>
                                                    @else
                                                    <div class="badge badge-pill badge-border badge-glow border-success success badge-square">{{ucfirst(strtolower("Order in production"))}}</div>
                                                    @endif
                                                </td>
                                                {{--<td>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-sm round btn-primary btn-glow dropdown-toggle action-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="ft-settings"></i> Action</button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item RolePermissionUpdate" href="{{url(Request()->path().'/'.$active_case->id.'/edit')}}">Edit</a>
                                                            <a class="dropdown-item RolePermissionUpdate" href="{{url(Request()->path().'/'.$active_case->id)}}">View</a>
                                                            <a class="dropdown-item delete-confirm-alert RolePermissionDelete" href="javascript:void(0)" data-id="{{$active_case->id}}">Delete</a>
                                                        </div>
                                                    </div>
                                                </td>--}}
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 d-none">
                        <div class="card">

                            <div class="card-header">
                                <h4 class="card-title">Active Slider</h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a class="card-link text-light pull-right" href="{{route('admin.slider.index')}}">View all</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                                        <ol class="carousel-indicators">
                                            @foreach ($sliders as $idx=>$slider)
                                                <li data-target="#carousel-example-generic" data-slide-to="{{$idx}}" class="@if($idx==0) active @endif"></li>
                                            @endforeach
                                            {{-- <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
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
                    </div>

                </div>

            @elseif($role->slug === 'lab-technician')

            <div class="row">
                    <div class="col-12 col-md-12">
                        <div class="card">
                            <div class="card-header">
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body pt-0">
                                    <div class="row">
                                        <div class="col-md col-12 border-right-blue-grey border-right-lighten-5 text-center">
                                            <i class="la la-user-plus info font-large-1"></i>
                                            <h4 class="font-large-1 text-bold-400">{{$total_patients}}</h4>
                                            <p class="text-light mb-0">Total Patients</p>
                                        </div>
                                        <div class="col-md col-12 text-center">
                                            <i class="la la-medkit info font-large-1"></i>
                                            <h4 class="font-large-1 text-bold-400">{{$pending_treatment_plans}}</h4>
                                            <p class="text-light lighten-2 mb-0">Pending Treatment Plans</p>
                                        </div>
                                        <div class="col-md col-12 border-right-blue-grey border-right-lighten-5 text-center">
                                            <i class="la la-bar-chart info font-large-1"></i>
                                            <h4 class="font-large-1 text-bold-400">{{$approved_treatment_plans}}</h4>
                                            <p class="text-light lighten-2 mb-0">Approved Treatment Plans</p>
                                        </div>
                                        <div class="col-md col-12 text-center">
                                            <i class="la la-bar-chart info font-large-1"></i>
                                            <h4 class="font-large-1 text-bold-400">{{$aligners_production}}</h4>
                                            <p class="text-light lighten-2 mb-0">Aligners Production</p>
                                        </div>
                                        <div class="col-md col-12 border-right-blue-grey border-right-lighten-5 text-center">
                                            <i class="la la-bar-chart info font-large-1"></i>
                                            <h4 class="font-large-1 text-bold-400">{{$ready_for_dispatch}}</h4>
                                            <p class="text-light lighten-2 mb-0">Ready For Dispatch</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
              <div class="row">
                    <div class="col-12 col-md-12">
                        <div class="card">
                            <div class="card-header">
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body pt-0">
                                    <div class="row">
                                        <div class="col-md col-12 border-right-blue-grey border-right-lighten-5 text-center">
                                            <i class="la la-user-plus info font-large-1"></i>
                                            <h4 class="font-large-1 text-bold-400">{{$total_patients}}</h4>
                                            <p class="text-light mb-0">Total Patients</p>
                                        </div>
                                        <div class="col-md col-12 text-center">
                                            <i class="la la-medkit info font-large-1"></i>
                                            <h4 class="font-large-1 text-bold-400">{{$pending_treatment_plans}}</h4>
                                            <p class="text-light lighten-2 mb-0">Pending Treatment Plans</p>
                                        </div>
                                        <div class="col-md col-12 border-right-blue-grey border-right-lighten-5 text-center">
                                            <i class="la la-bar-chart info font-large-1"></i>
                                            <h4 class="font-large-1 text-bold-400">{{$approved_treatment_plans}}</h4>
                                            <p class="text-light lighten-2 mb-0">Approved Treatment Plans</p>
                                        </div>
                                        <div class="col-md col-12 text-center">
                                            <i class="la la-bar-chart info font-large-1"></i>
                                            <h4 class="font-large-1 text-bold-400">{{$aligners_production}}</h4>
                                            <p class="text-light lighten-2 mb-0">Aligners Production</p>
                                        </div>
                                        <div class="col-md col-12 border-right-blue-grey border-right-lighten-5 text-center">
                                            <i class="la la-bar-chart info font-large-1"></i>
                                            <h4 class="font-large-1 text-bold-400">{{$ready_for_dispatch}}</h4>
                                            <p class="text-light lighten-2 mb-0">Ready For Dispatch</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">

                    <div id="recent-sales" class="col-12 col-md-12">
                        <div class="card">
                            <div class="card-header d-none">
                                <h4 class="card-title">Cases Process</h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a class="card-link text-light pull-right" href="{{route('admin.case.index')}}">View all</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content mt-1">
                                <div class="table-responsive">
                                    <table id="recent-orders" class="table table-hover table-xl mb-0">
                                        <thead>
                                        <tr>
                                            <th>Case ID</th>
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th>Gender</th>
                                            <th>Treatment Plan</th>
                                            <th>Aligners</th>
                                            <th>Status</th>
                                            <!--<th class="RolePermissionAction">Action</th>-->
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($active_cases as $active_case)
                                                <tr data-aeshaz-select-id="{{$active_case->id}}">
                                                <td class="select-td">{{$active_case->id}}</td>
                                                <td>{{$active_case->name}}</td>
                                                <td>{{$active_case->phone_no}}</td>
                                                <td>{{$active_case->gender}}</td>
                                                <td>
                                                    @if ($active_case->processing_fee_paid)
                                                        <div class="badge badge-pill badge-border badge-glow border-success success badge-square">Paid</div>
                                                    @else
                                                        <div class="badge badge-pill badge-border badge-glow border-danger danger badge-square">Unpaid</div>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if (isset($active_case->aligner->payment_name) && !empty($active_case->aligner->payment_name))
                                                        <div class="badge badge-pill badge-border badge-glow border-success success badge-square">Paid</div>
                                                    @else
                                                        <div class="badge badge-pill badge-border badge-glow border-danger danger badge-square">Unpaid</div>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($active_case->status == "CANCELED")
                                                        <div class="badge badge-pill badge-border badge-glow border-danger danger badge-square">{{ucfirst(strtolower($active_case->status))}}</div>
                                                    @elseif ($active_case->status == "PENDING")
                                                        <div class="badge badge-pill badge-border badge-glow border-warning warning badge-square">{{ucfirst(strtolower($active_case->status))}}</div>
                                                    @else
                                                        {{-- <div class="badge badge-pill badge-border badge-glow border-success success badge-square">{{ucfirst(strtolower($active_case->status))}}</div> --}}
                                                        @if ((empty($active_case->video_uploaded) && empty($edit_values->video_embedded)))
                                                            <div class="badge badge-pill badge-border badge-glow border-info info badge-square">{{ucfirst(strtolower("Acculigners Lab"))}}</div>
                                                        @elseif ((!empty($active_case->video_uploaded) || !empty($edit_values->video_embedded)) && !$active_case->has_concern && empty($active_case->aligner_kit_order_id))
                                                            <div class="badge badge-pill badge-border badge-glow border-warning warning badge-square">{{ucfirst(strtolower("Review to dentist"))}}</div>
                                                        @elseif ($active_case->has_concern)
                                                            <div class="badge badge-pill badge-border badge-glow border-info info badge-square">{{ucfirst(strtolower("Review to you"))}}</div>
                                                        @elseif (!empty($active_case->aligner_kit_order_id) && isset($active_case->aligner->status))
                                                            @if ($active_case->aligner->status == "DELIVERED")
                                                                <div class="badge badge-pill badge-border badge-glow border-success success badge-square">{{ucfirst(strtolower($active_case->aligner->status))}}</div>
                                                            @elseif ($active_case->aligner->status == "CANCELED")
                                                                <div class="badge badge-pill badge-border badge-glow border-danger danger badge-square">{{ucfirst(strtolower($active_case->aligner->status))}}</div>
                                                            @else
                                                                <div class="badge badge-pill badge-border badge-glow border-success success badge-square">{{ucfirst(strtolower("Order in production"))}}</div>
                                                            @endif
                                                        @endif
                                                    @endif
                                                </td>
                                                {{--<td>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-sm round btn-primary btn-glow dropdown-toggle action-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="ft-settings"></i> Action</button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item RolePermissionUpdate" href="{{url(Request()->path().'/'.$active_case->id.'/edit')}}">Edit</a>
                                                            <a class="dropdown-item RolePermissionUpdate" href="{{url(Request()->path().'/'.$active_case->id)}}">View</a>
                                                            <a class="dropdown-item delete-confirm-alert RolePermissionDelete" href="javascript:void(0)" data-id="{{$active_case->id}}">Delete</a>
                                                        </div>
                                                    </div>
                                                </td>--}}
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 d-none">
                        <div class="card">

                            <div class="card-header">
                                <h4 class="card-title">Active Slider</h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a class="card-link text-light pull-right" href="{{route('admin.slider.index')}}">View all</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                                        <ol class="carousel-indicators">
                                            @foreach ($sliders as $idx=>$slider)
                                                <li data-target="#carousel-example-generic" data-slide-to="{{$idx}}" class="@if($idx==0) active @endif"></li>
                                            @endforeach
                                            {{-- <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
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
                    </div>

                </div>

            @endif

        </div>
    </div>
</div>

@stop
