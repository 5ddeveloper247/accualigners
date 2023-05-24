@extends('doctor.root.index')

@section('title', "Case")


@section('content')

@php

    $requiredSections = [
        'Header' => 'doctor.components.side-nav',
        'Footer' => 'doctor.components.footer'
    ];

    $componentsJsCss = [
        'adminPanel.general',
        'adminPanel.datatable',
        'adminPanel.sweetalert',
    ];

@endphp

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
          <div class="content-header-left col-md-12 col-12 mb-1">
            <div class="row breadcrumbs-top">
              <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{route('doctor.dashbord')}}">Dashboard</a></li>
                  <li class="breadcrumb-item active">Cases</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <div class="content-body">

            <section id="column-visibility">
                <div class="row">


                    <div class="col-12 col-md-6 float-right mb-1">
                        <div class="aeshaz-filter">
                            <form action="{{url(Request()->path())}}" id="filter-form" method="get">

                                <div class="row mt-2 mt-md-0">
                                    <div class="col-12 col-md-6">
                                        @if(Request()->has('product')) <input type="hidden" name="product" value="{{Request()->product}}" /> @endif
                                        <input type="text" id="filter-field" name="filter" class="form-control form-control-sm" placeholder="Search" aria-controls="DataTables_Table_7" value="{{ Request()->has('filter') ? Request()->filter : ''}}" >
                                    </div>
                                    <div class="col-12 col-md-6 mt-1 mt-md-0">
                                        <button type="submit" class="btn btn-md btn-primary white ml-1"> Search</button>
                                        <a href="{{Request()->has('filter') ? url(Request()->path()) : 'JavaScript:void(0);'}}" class="btn btn-md btn-outline-primary primary ml-1"> Clear</a>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <a href="{{url(Request()->path().'/create')}}" class="btn btn-md btn-primary float-right white"><i class="ft-plus"></i>Add New</a>
                    </div>

                    <div class="col-12 float-right mb-1">

                       {{-- <table class="table table-striped table-bordered responsive ideaecom-datatable-pag "> --}}
                        <table class="table table-bordered border-top text-nowrap responsive" id="modal_dataTabe">
                            <thead>
                            <tr>
                                <!--<th>#</th>-->
                                <th>Case ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Gender</th>
                                <th>Treatment Plan</th>
                                <th>Aligners</th>
                                <th>Status</th>
                                <th class="RolePermissionAction">Action</th>
                            </tr>
                            </thead>
                            <tbody>

                                @foreach($cases as $key => $case)
                                 <tr data-aeshaz-select-id="{{ $case->id}}">
                                        <td class="select-td">{{$case->id}}</td>
                                        
                                        <!--<td><a herf="{{url(Request()->path().'/'.$case->id)}}" title="View Details"><strong>{{$case->id}}</strong></a></td>-->
                                        <td>{{$case->name}}</td>
                                        <td>{{$case->email}}</td>
                                        <td>{{$case->phone_no}}</td>
                                        <td>{{$case->gender}}</td>
                                        <td>
                                            @if ($case->processing_fee_paid)
                                                <div class="badge badge-pill badge-border badge-glow border-success success badge-square">Paid</div>
                                            @else
                                             <div class="badge badge-pill badge-border badge-glow border-danger danger badge-square">Unpaid</div>
                                            @endif
                                        </td>
                                        <td>
                                            @if (isset($case->aligner->payment_name) && !empty($case->aligner->payment_name))
                                                <div class="badge badge-pill badge-border badge-glow border-success success badge-square">Paid</div>
                                            @else
                                                <div class="badge badge-pill badge-border badge-glow border-danger danger badge-square">Unpaid</div>
                                            @endif
                                        </td>  
                                        <td>
                                            @if ($case->status == "CANCELED")
                                                <div class="badge badge-pill badge-border badge-glow border-danger danger badge-square">{{ucfirst(strtolower($case->status))}}</div>
                                            @elseif ($case->status == "PENDING")
                                                <div class="badge badge-pill badge-border badge-glow border-warning warning badge-square">{{ucfirst(strtolower($case->status))}}</div>
                                            @elseif($case->status  == "CLOSED")
                                             <div
                                                class="badge badge-pill badge-border badge-glow border-info info badge-square">
                                                {{ucfirst(strtolower("Complete"))}}</div>
                                            @else
                                                {{-- <div class="badge badge-pill badge-border badge-glow border-success success badge-square">{{ucfirst(strtolower($case->status))}}</div> --}}
                                                 @if ((empty($case->video_uploaded) && empty($edit_values->video_embedded)))
                                                    <div class="badge badge-pill badge-border badge-glow border-info info badge-square">{{ucfirst(strtolower("Acculigners Lab"))}}</div>
                                                 @elseif ((!empty($case->video_uploaded) || !empty($edit_values->video_embedded)) && !$case->has_concern && empty($case->aligner_kit_order_id))
                                                    <div class="badge badge-pill badge-border badge-glow border-warning warning badge-square">{{ucfirst(strtolower("Review to you"))}}</div>
                                                 @elseif ($case->has_concern)
                                                    <div class="badge badge-pill badge-border badge-glow border-info info badge-square">{{ucfirst(strtolower("Review to Acculigners"))}}</div>
                                                 @elseif (!empty($case->aligner_kit_order_id) && isset($case->aligner->status))
                                                    
                                                    @if ($case->aligner->status == "DELIVERED")
                                                        <div class="badge badge-pill badge-border badge-glow border-success success badge-square">{{ucfirst(strtolower($case->aligner->status))}}</div>
                                                    @elseif ($case->aligner->status == "CANCELED")
                                                        <div class="badge badge-pill badge-border badge-glow border-danger danger badge-square">{{ucfirst(strtolower($case->aligner->status))}}</div>
                                                    @else
                                                        <div class="badge badge-pill badge-border badge-glow border-success success badge-square">{{ucfirst(strtolower("Order in production"))}}</div>
                                                    @endif
                                                @endif

                                            @endif
                                        </td>
                                        <td class="align-middle">
                                            <div class="btn-group align-top">
                                                <a href="{{url(Request()->path().'/'.$case->id.'/edit')}}" class="btn btn-sm btn-success RolePermissionUpdate" data-toggle="tooltip" data-original-title="Edit Case">Edit</a>
                                                <a href="{{url(Request()->path().'/'.$case->id)}}" class="btn btn-sm btn-info RolePermissionUpdate" data-toggle="tooltip" data-original-title="View Case">View</a>
                                                <a class="btn btn-sm btn-danger delete-confirm-alert RolePermissionDelete" href="javascript:void(0)" data-id="{{$case->id}}" data-toggle="tooltip" data-original-title="Delete Case">Delete</a>
                                                
                                                @if($case->processing_fee_paid != 1)
                                                <a class="btn btn-sm btn-success RolePermissionUpdate" href="{{route('doctor.case.payment.index', ['case'=>$case->id])}}" data-toggle="tooltip" data-original-title="Pay Processing Fee">Pay Processing Fee</a>
                                                @endif
                                                {{-- @if(!empty($case->no_of_trays) && $case->no_of_trays > 0 && empty($case->aligner_kit_order_id))<a class="dropdown-item RolePermissionUpdate" href="{{route('doctor.case.order-aligner.index', ['case'=>$case->id])}}">Order Clears Aligner</a>@endif --}}
                                                <a  class="btn btn-sm btn-warning RolePermissionUpdate" data-toggle="tooltip" data-original-title="Reports By Trays" href="{{url(Request()->path().'/'.$case->id.'/reports')}}">Reports By Trays</a>
                                                <a class="btn btn-sm btn-primary RolePermissionUpdate" data-toggle="tooltip" data-original-title="Wearing Time Report" href="{{url(Request()->path().'/'.$case->id.'/wearing-time-report')}}">Wearing Time Report</a>
                                                
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>

                        {{ $cases->appends(Request()->input())->links() }}
                    </div>

                </div>
            </section>

        </div>
    </div>
</div>

@stop
