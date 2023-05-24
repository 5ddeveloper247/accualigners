@extends('originator.root.index')

@section('title', "User Type")


@section('content')

@php

    $requiredSections = [
        'Header' => 'originator.components.header',
        'Nav' => 'originator.components.nav',
        'Footer' => 'originator.components.footer'
    ];

    $componentsJsCss = [
        'adminPanel.general',
        'adminPanel.datatable',
        'adminPanel.sweetalert',
    ];

    $ActionButtons = ['Delete','Active','Inactive'];

    $getQueryString = Request()->getQueryString();

    $filterUrlVariable = '';
    if(isset(Request()->filter)){
        $filterUrlVariable =  '&filter='.Request()->filter;
    }

@endphp

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
          <div class="content-header-left col-md-12 col-12 mb-1">
            <div class="row breadcrumbs-top">
              <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{url('/')}}">Dashboard</a>
                  </li>
                  <li class="breadcrumb-item active">Users Type
                  </li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <div class="content-body">

            <section id="column-visibility">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header  bg-hexagons">
                                <h4 class="card-title">User Type</h4>
                                <a class="heading-elements-toggle"><i
                                        class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a href="{{url(Request()->path().'/add-new')}}" class="btn btn-sm btn-danger  white"><i class="ft-plus"></i>Add New</a></li>
                                        <li><a class="btn btn-sm btn-outline-danger danger" data-action="collapse"><i class="ft-minus"></i></a></li>
                                        <li><a class="btn btn-sm btn-outline-danger danger" data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                        <li><a class="btn btn-sm btn-outline-danger danger" data-action="expand"><i class="ft-maximize"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">

                                    <div class="col-sm-12 col-md-6 float-right mb-1">
                                        <div class="aeshaz-filter">
                                            <form action="{{url(Request()->path())}}" id="filter-form" method="get">
                                                <a href="{{Request()->has('filter') ? url(Request()->path()) : 'JavaScript:void(0);'}}" class="btn btn-sm btn-outline-danger danger float-right ml-1"> Clear</a>
                                                <button type="submit" class="btn btn-sm btn-danger white float-right ml-1"> Search</button>
                                                <input type="text" id="filter-field" name="filter" class="form-control form-control-sm col-md-3" placeholder="Search" aria-controls="DataTables_Table_7" value="{{ Request()->has('filter') ? Request()->filter : ''}}">
                                            </form>
                                        </div>
                                    </div>

                                    <table class="table table-striped table-bordered responsive ideaecom-datatable-pag ">
                                        <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Status</th>
                                            <th class="RolePermissionAction">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach(collect($getTableData->items())->toArray() as $getTableRow)
                                            <tr data-aeshaz-select-id="{{$getTableRow['UserTypeID']}}">
                                                <td class="select-td">{{$getTableRow['Name']}}</td>
                                                <td>
                                                    <center> {!! $getTableRow['Status'] == 1 ? '<span class="badge badge badge-success mr-2">Active</span>' : '<span class="badge badge badge-danger mr-2">Inactive</span>' !!} </center>
                                                </td>
                                                <td>
                                                    <center>
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-sm round btn-danger btn-glow dropdown-toggle action-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="ft-settings"></i> Action</button>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item RolePermissionUpdate" href="{{url(Request()->path().'/update/'.$getTableRow['UserTypeID'])}}">Edit</a>
                                                                <a class="dropdown-item aeshaz-confirm-alert RolePermissionDelete" href="javascript:void(0)" data-aeshaz-type="Delete" data-aeshaz-url="{{url(Request()->path().'/action')}}" data-aeshaz-id="{{$getTableRow['UserTypeID']}}">Delete</a>

                                                                @if($getTableRow['Status'] == 1)
                                                                    <a class="dropdown-item aeshaz-confirm-alert RolePermissionUpdate" href="javascript:void(0)" data-aeshaz-type="Inactive" data-aeshaz-url="{{url(Request()->path().'/action')}}" data-aeshaz-id="{{$getTableRow['UserTypeID']}}">Inactive</a>
                                                                @else
                                                                    <a class="dropdown-item aeshaz-confirm-alert RolePermissionUpdate" href="javascript:void(0)" data-aeshaz-type="Active" data-aeshaz-url="{{url(Request()->path().'/action')}}" data-aeshaz-id="{{$getTableRow['UserTypeID']}}">Active</a>
                                                                @endif

                                                            </div>
                                                        </div>
                                                    </center>

                                                </td>
                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>

                                    {{ $getTableData->appends(Request()->input())->links() }}

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>
</div>


{{--<div class="buy-now"><a href="{{url(Request()->path().'/add-new')}}" class="btn bg-gradient-directional-danger white btn-danger btn-glow btn-md RolePermissionInsert"><i class="ft-plus"></i> Add New</a></div>--}}
@stop
