@extends('originator.root.index')

@section('title', "Shipping Company")


@section('content')

@php

    $requiredSections = [
        'Header' => 'originator.components.side-nav',
        'Footer' => 'originator.components.footer'
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
                  <li class="breadcrumb-item"><a href="{{route('admin.dashbord')}}">Dashboard</a></li>
                  <li class="breadcrumb-item active">Shipping Company</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <div class="content-body">

            <section id="column-visibility">
                <div class="row">


                    <div class="col-6 float-right mb-1">
                        <div class="aeshaz-filter">
                            <form action="{{url(Request()->path())}}" id="filter-form" method="get">

                                <div class="row">
                                    <div class="col-6">
                                        <input type="text" id="filter-field" name="filter" class="form-control form-control-sm" placeholder="Search" aria-controls="DataTables_Table_7" value="{{ Request()->has('filter') ? Request()->filter : ''}}" >
                                    </div>
                                    <div class="col-6">
                                        <button type="submit" class="btn btn-md btn-primary white ml-1"> Search</button>
                                        <a href="{{Request()->has('filter') ? url(Request()->path()) : 'JavaScript:void(0);'}}" class="btn btn-md btn-outline-primary primary ml-1"> Clear</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-6">
                        <a href="{{url(Request()->path().'/create')}}" class="btn btn-md btn-primary float-right white"><i class="ft-plus"></i>Add New</a>
                    </div>
                    <div class="col-12 float-right mb-1">

                        <table class="table table-striped table-bordered responsive ideaecom-datatable-pag ">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th class="RolePermissionAction text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($shipping_companies as $shipping_company)
                                <tr data-aeshaz-select-id="{{$shipping_company->id}}">
                                    <td class="select-td">{{$shipping_company->name}}</td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm round btn-primary btn-glow dropdown-toggle action-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="ft-settings"></i> Action</button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item RolePermissionUpdate" href="{{url(Request()->path().'/'.$shipping_company->id.'/charge')}}">Shipping Charges List</a>
                                                <a class="dropdown-item RolePermissionUpdate" href="{{url(Request()->path().'/'.$shipping_company->id.'/edit')}}">Edit</a>
                                                <a class="dropdown-item delete-confirm-alert RolePermissionDelete" href="javascript:void(0)" data-id="{{$shipping_company->id}}">Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>

                        {{ $shipping_companies->appends(Request()->input())->links() }}
                    </div>

                </div>
            </section>

        </div>
    </div>
</div>

@stop
