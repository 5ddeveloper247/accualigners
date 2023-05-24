@extends('originator.root.index')

@section('title', "Slider")


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
    $slug = auth()->user()->role->slug;

@endphp

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
          <div class="content-header-left col-md-12 col-12 mb-1">
            <div class="row breadcrumbs-top">
              <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{route($slug.'.dashbord')}}">Dashboard</a></li>
                  <li class="breadcrumb-item active">Sliders</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <div class="content-body">

            <section id="column-visibility">
                <div class="row">


                    <div class="col-6 float-right mb-1">
                        
                    </div>
                    <div class="col-6 mt-1 mt-md-0">
                        <a href="{{url(Request()->path().'/create')}}" class="btn btn-md btn-primary float-right white"><i class="ft-plus"></i>Add New</a>
                    </div>
                    <div class="col-12 float-right mb-1">

                        <table class="table table-striped table-bordered responsive ideaecom-datatable-pag ">
                            <thead>
                            <tr class=" text-center">
                                <th>Sort Order</th>
                                <th>Image</th>
                                <th class="RolePermissionAction text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($sliders as $slider)
                                <tr data-aeshaz-select-id="{{$slider->id}}" class="text-center">
                                    <td class="select-td p-3">{{$slider->sort_order}}</td>
                                    <td class=""><img src="{{$slider->slider_image}}" class="height-100 mx-auto border-primary" alt="Slider"></td>
                                    <td class="p-3">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm round btn-primary btn-glow dropdown-toggle action-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="ft-settings"></i> Action</button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item RolePermissionUpdate" href="{{url(Request()->path().'/'.$slider->id.'/edit')}}">Edit</a>
                                                <a class="dropdown-item delete-confirm-alert RolePermissionDelete" href="javascript:void(0)" data-id="{{$slider->id}}">Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>

                        {{ $sliders->appends(Request()->input())->links() }}
                    </div>

                </div>
            </section>

        </div>
    </div>
</div>

@stop
