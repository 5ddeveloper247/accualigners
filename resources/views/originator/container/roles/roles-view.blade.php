@extends('originator.root.index')

@section('title', "Roles")


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
                  <li class="breadcrumb-item active">Roles</li>
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
                        
                    </div>
                    <div class="col-12 float-right mb-1">

                        <table class="table table-striped table-bordered responsive ideaecom-datatable-pag ">
                            <thead>
                            <tr class=" text-center">
                                 <th>ID</th>
                                <th>Name</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($roles as $role)
                                <tr data-aeshaz-select-id="{{$role->id}}" class="text-center">
                                    <td class="select-td p-3">{{$role->id}}</td>
                                     <td class="select-td">{{$role->name}}</td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>

                        {{ $roles->appends(Request()->input())->links() }}
                    </div>

                </div>
            </section>

        </div>
    </div>
</div>

@stop
