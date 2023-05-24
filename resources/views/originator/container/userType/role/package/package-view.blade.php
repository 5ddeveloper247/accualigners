@extends('originator.root.index')

@section('title', "Package")


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

@endphp

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
          <div class="content-header-left col-md-12 col-12 mb-1">
            <div class="row breadcrumbs-top">
              <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{route('admin.dashbord')}}">Dashboard</a></li>
                  <li class="breadcrumb-item"><a href="{{url('user-type')}}">User Type</a></li>
                  <li class="breadcrumb-item"><a href="{{url('user-type/'.(isset($getUserTypeData['id']) ? $getUserTypeData['id'] : 0).'/role')}}">{{isset($getUserTypeData['name']) ? ucwords(strtolower($getUserTypeData['name']."'s")) : ''}} Role</a></li>
                  <li class="breadcrumb-item active">{{isset($getRoleData['name']) ? ucwords(strtolower($getRoleData['name']."'s")) : ''}} Package</li>
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
                                <h4 class="card-title">{{isset($getRoleData['name']) ? $getRoleData['name']."'s" : ''}} Package</h4>
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

                                    <table class="table table-striped table-bordered responsive ideaecom-datatable ">
                                        <thead>
                                            <tr>
                                                <th>Price</th>
                                                <th>Period</th>
                                                <th>Status</th>
                                                <th class="RolePermissionAction">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach($getTableData as $getTableRow)
                                                <tr data-aeshaz-select-id="{{$getTableRow['id']}}">
                                                    <td class="select-td">{{$getTableRow['price']}}</td>
                                                    <td>
                                                        {{$getTableRow['period'] . ' months'}}
                                                    </td>
                                                    <td>
                                                        <center> {!! $getTableRow['status'] == 1 ? '<span class="badge badge badge-success mr-2">Active</span>' : '<span class="badge badge badge-danger mr-2">Inactive</span>' !!} </center>
                                                    </td>
                                                    <td>
                                                        <center>
                                                            <div class="btn-group">
                                                                <button type="button" class="btn btn-sm round btn-danger btn-glow dropdown-toggle action-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="ft-settings"></i> Action</button>
                                                                <div class="dropdown-menu">
                                                                    <a class="dropdown-item RolePermissionUpdate" href="{{url(Request()->path().'/update/'.$getTableRow['id'])}}">Edit</a>
                                                                    <a class="dropdown-item aeshaz-confirm-alert RolePermissionDelete" href="javascript:void(0)" data-aeshaz-type="Delete" data-aeshaz-url="{{url(Request()->path().'/action')}}" data-aeshaz-id="{{$getTableRow['id']}}">Delete</a>

                                                                    @if($getTableRow['status'] == 1)
                                                                        <a class="dropdown-item aeshaz-confirm-alert RolePermissionUpdate" href="javascript:void(0)" data-aeshaz-type="Inactive" data-aeshaz-url="{{url(Request()->path().'/action')}}" data-aeshaz-id="{{$getTableRow['id']}}">Inactive</a>
                                                                    @else
                                                                        <a class="dropdown-item aeshaz-confirm-alert RolePermissionUpdate" href="javascript:void(0)" data-aeshaz-type="Active" data-aeshaz-url="{{url(Request()->path().'/action')}}" data-aeshaz-id="{{$getTableRow['id']}}">Active</a>
                                                                    @endif

                                                                </div>
                                                            </div>
                                                        </center>

                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>

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
