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
            'adminPanel.validation',
            'adminPanel.switch-checkbox',
            'adminPanel.select2',
        ];

        $ActionButtons = ['Delete','Active','Inactive'];

        $viewRoute = 'user-type/'.Request()->route('user_type_id').'/role';

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
                                <li class="breadcrumb-item"><a href="{{url('user-type/'.(isset($getUserTypeData['id']) ? $getUserTypeData['id'] : 0).'/role/'.$getRoleData['id'].'/package')}}">{{isset($getRoleData['name']) ? ucwords(strtolower($getRoleData['name']."'s")) : ''}} Package</a></li>
                                <li class="breadcrumb-item active">{{ Request()->update_id ? 'Update' : 'Add New' }}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">

                <section id="column-visibility">
                    <div class="row">
                        <div class="col-6 ml-auto mr-auto">
                            <div class="card">
                                <div class="card-header  bg-hexagons">
                                    <h4 class="card-title">{{isset($getUserTypeData['name']) ? $getUserTypeData['name']."'s" : ''}} Role</h4>
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a class="btn btn-sm btn-outline-danger danger" data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a class="btn btn-sm btn-outline-danger danger" data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a class="btn btn-sm btn-outline-danger danger" data-action="expand"><i class="ft-maximize"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body">

                                        <form class="form-horizontal" method="post" action="{{url(Request()->path())}}"
                                              enctype="multipart/form-data" novalidate>
                                            {{csrf_field()}}

                                            <div class="form-body">

                                                <div class="form-group col-12 <?php if ($errors->has('price')) echo 'error'; ?>">
                                                    <label>Price<span class="required">*</span></label>
                                                    <div class="controls">
                                                        <input type="text" name="price" class="form-control " required
                                                               data-validation-required-message="Package price is required"
                                                               data-validation-containsnumber-regex="(\d+)((\.\d{1,2})?)"
                                                               data-validation-containsnumber-message="No Characters Allowed, Only 2 decimal Numeric"
                                                               value="{{ old('price') }}">
                                                        @if($errors->has('price'))
                                                            <div class="help-block text-danger price-shopwoo-error">
                                                                <ul role="alert">
                                                                    <li>{{$errors->first('price')}}</li>
                                                                </ul>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-group col-12 <?php if ($errors->has('period')) echo 'error'; ?>">
                                                    <label>Package Expiry Period (Months) <span class="required">*</span></label>
                                                    <div class="controls">
                                                        <input type="text" name="period" class="form-control " required
                                                               data-validation-required-message="Period is required"
                                                               min="1"
                                                               data-validation-containsnumber-regex="(\d)+" data-validation-containsnumber-message="No Characters Allowed, Only Numbers"
                                                               value="{{ isset($totalDivisions) ? $totalDivisions+1 : old('period') }}">
                                                        @if($errors->has('period'))
                                                            <div class="help-block text-danger period-shopwoo-error">
                                                                <ul role="alert">
                                                                    <li>{{$errors->first('period')}}</li>
                                                                </ul>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="form-actions text-right from-submit-btn">

                                                @if( Request()->update_id )

                                                    <button type="submit" class="btn btn-success btn-glow"><i class="fa-save"></i> Update</button>
                                                    <a href="{{url($viewRoute)}}" class="btn btn-danger btn-glow"><i class="ft-x"></i> Cancel</a>

                                                @else

                                                    <button type="submit" class="btn btn-success btn-glow"><i class="ft-save"></i> Save</button>
                                                    <button type="reset" class="btn btn-warning btn-glow"><i class="ft-refresh-cw"></i> Reset</button>

                                                @endif

                                            </div>
                                        </form>

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
