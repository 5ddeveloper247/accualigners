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
                                <li class="breadcrumb-item"><a href="{{url('user-type/'.(isset($getUserTypeData['id']) ? $getUserTypeData['id'] : 0).'/role/'.$getRoleData['id'].'/permission')}}">{{isset($getRoleData['name']) ? ucwords(strtolower($getRoleData['name']."'s")) : ''}} Permission</a></li>
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

                                                @if( !Request()->has('update_id')  && $getUserTypeData['id'] == trans('siteConfig.user-type.brand'))
                                                    <div class="form-group col-6">
                                                        <label>Add In Existing User </label>
                                                        <div class="controls">
                                                            <input type="checkbox" class="form-control switchBootstrap" name="addInExisting" data-on-color="success" data-on-text="Yes <i class='la la-check-circle'></i>" data-off-color="warning" data-off-text="No <i class='la la-times-circle'></i>" data-label-text="" data-indeterminate="false"/>
                                                        </div>
                                                    </div>
                                                @endif

                                                @if($getUserTypeData['is_package'])

                                                    <div class="form-group col-12 <?php if ($errors->has('limit')) echo 'error'; ?>">
                                                        <label>User Limits </label>
                                                        <div class="controls">
                                                            <input type="text" name="limit" class="form-control " placeholder="Empty will be consider as unlimited"
                                                                   data-validation-containsnumber-regex="(\d)+" data-validation-containsnumber-message="No Characters Allowed, Only Numbers"
                                                                   value="{{ old('limit') }}">
                                                            @if($errors->has('limit'))
                                                                <div class="help-block text-danger limit-shopwoo-error">
                                                                    <ul role="alert">
                                                                        <li>{{$errors->first('limit')}}</li>
                                                                    </ul>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>


                                                    <div class="form-group col-12 <?php if ($errors->has('limit_type')) echo 'error'; ?>">
                                                        <label>Limit Type <span class="required">*</span></label>
                                                        <div class="controls">
                                                            <select class="form-control " name="limit_type" required data-validation-required-message="Please select any one" >

                                                                <option value="{{strtoupper('EXTENDABLE')}}" @if(isset(Request()->update_id)) @if((!empty(old('limit_type')) ? strtoupper(old('limit_type')) : old('limit_type')) == strtoupper('EXTENDABLE')) selected @endif @endif>EXTENDABLE</option>
                                                                <option value="{{strtoupper('FIXED')}}" @if(isset(Request()->update_id)) @if((!empty(old('limit_type')) ? strtoupper(old('limit_type')) : old('limit_type')) == strtoupper('FIXED')) selected @endif @endif>FIXED</option>

                                                            </select>
                                                            @if($errors->has('limit_type'))
                                                                <div class="help-block text-danger limit_type-shopwoo-error">
                                                                    <ul role="alert">
                                                                        <li>{{$errors->first('limit_type')}}</li>
                                                                    </ul>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>

                                                @endif


                                                <div class="form-group col-12 <?php if ($errors->has('form_id')) echo 'error'; ?>">
                                                    <label>Forms <span class="required">*</span></label>
                                                    <div class="controls">
                                                        {{--<input type="text" name="name" class="form-control " required
                                                               data-validation-required-message="name is required"
                                                               value="{{ Request()->name }}">--}}

                                                        <select class="select2 form-control " name="form_id[]" multiple="multiple" required data-validation-required-message="Please select any one" @if(isset(Request()->update_id)) disabled @endif >
                                                            @foreach($getForms as $getForm)
                                                                <option value="{{$getForm['id']}}" @if(isset(Request()->update_id)) @if(old('form_id') == $getForm['id']) selected @endif @endif>{{$getForm['name']}}</option>
                                                            @endforeach
                                                        </select>

                                                        @if($errors->has('form_id'))
                                                            <div class="help-block text-danger form_id-shopwoo-error">
                                                                <ul role="alert">
                                                                    <li>{{$errors->first('form_id')}}</li>
                                                                </ul>
                                                            </div> @endif
                                                    </div>

                                                </div>


                                                <div class="form-group col-6">
                                                    <div class="controls">
                                                    <input type="checkbox" class="form-control switchBootstrap" name="insert" data-on-color="success" data-on-text="Allow <i class='la la-check-circle'></i>" data-off-color="warning" data-off-text="Ban <i class='la la-times-circle'></i>" data-label-text="Insert" data-indeterminate="false" @if(isset(Request()->update_id)) @if(old('insert') == 1) checked @endif @endif/>
                                                    </div>
                                                </div>

                                                <div class="form-group col-6">
                                                    <div class="controls">
                                                    <input type="checkbox" class="form-control switchBootstrap" name="update" data-on-color="success" data-on-text="Allow <i class='la la-check-circle'></i>" data-off-color="warning" data-off-text="Ban <i class='la la-times-circle'></i>" data-label-text="Update" data-indeterminate="false" @if(isset(Request()->update_id)) @if(old('update') == 1) checked @endif @endif/>
                                                    </div>
                                                </div>

                                                <div class="form-group col-6">
                                                    <div class="controls">
                                                    <input type="checkbox" class="form-control switchBootstrap" name="delete" data-on-color="success" data-on-text="Allow <i class='la la-check-circle'></i>" data-off-color="warning" data-off-text="Ban <i class='la la-times-circle'></i>" data-label-text="Delete" data-indeterminate="false" @if(isset(Request()->update_id)) @if(old('delete') == 1) checked @endif @endif/>
                                                    </div>
                                                </div>

                                                <div class="form-group col-6">
                                                    <div class="controls">
                                                    <input type="checkbox" class="form-control switchBootstrap" name="view" data-on-color="success" data-on-text="Allow <i class='la la-check-circle'></i>" data-off-color="warning" data-off-text="Ban <i class='la la-times-circle'></i>" data-label-text="View" data-indeterminate="false" @if(isset(Request()->update_id)) @if(old('view') == 1) checked @endif @endif/>
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
