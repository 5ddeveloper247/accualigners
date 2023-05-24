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
            'adminPanel.validation',
            'adminPanel.select2',
            'adminPanel.file-input-button',
            'adminPanel.input-mask',
        ];

        $viewRoute = route('admin.shipping.index');

        $edit_id = false;
        $form_action = route('admin.shipping.store');

        if(Request()->route('shipping')){
            $edit_id = Request()->route('shipping');
            $form_action = route('admin.shipping.update', $edit_id);
        }
    @endphp

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-xl-6 col-md-6 col-sm-12 ml-auto mr-auto mb-1">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashbord')}}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{$viewRoute}}">Shipping Companies</a></li>
                                <li class="breadcrumb-item active">{{ $edit_id ? 'Edit' : 'Add New' }} Shipping Company</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">

                <section id="column-visibility">
                        <form class="form-horizontal" method="post" action="{{$form_action}}" enctype="multipart/form-data" novalidate>

                            <div class="row">

                                <div class="col-xl-6 col-md-6 col-sm-12 ml-auto mr-auto">
                                    <div class="card">
                                        <div class="card-header  bg-hexagons">
                                            <h4 class="card-title">Shipping Company</h4>
                                            <a class="heading-elements-toggle"><i
                                                    class="la la-ellipsis-v font-medium-3"></i></a>
                                            <div class="heading-elements">
                                                <ul class="list-inline mb-0">
                                                    <li><a class="btn btn-sm btn-outline-primary primary" data-action="collapse"><i class="ft-minus"></i></a></li>
                                                    <li><a class="btn btn-sm btn-outline-primary primary" data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                                    <li><a class="btn btn-sm btn-outline-primary primary" data-action="expand"><i class="ft-maximize"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="card-content collapse show">
                                            <div class="card-body card-dashboard">

                                                {{csrf_field()}}

                                                <div class="row">

                                                    <div class="form-group col-12 <?php if ($errors->has('name')) echo 'error'; ?>">
                                                        <label>Name <span class="required">*</span></label>
                                                        <div class="controls">
                                                            <input type="text" name="name" class="form-control" required
                                                                   data-validation-required-message="Name is required"
                                                                   maxlength="255"
                                                                   data-validation-maxlength-message="Max 255 characters allowed"
                                                                   value="{{ old('name', isset($edit_values) ? $edit_values->name : NULL) }}">
                                                            @if($errors->has('name'))
                                                                <div class="help-block text-danger name-shopwoo-error">
                                                                    <ul role="alert">
                                                                        <li>{{$errors->first('name')}}</li>
                                                                    </ul>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="form-actions text-right from-submit-btn">

                                                    @if( $edit_id )
                                                        @method('PUT')
                                                        <button type="submit" class="btn btn-success"><i class="fa-save"></i> Update</button>
                                                        <a href="{{url($viewRoute)}}" class="btn btn-outline-primary primary"><i class="ft-x"></i> Cancel</a>

                                                    @else

                                                        <button type="submit" class="btn btn-primary "><i class="ft-save"></i> Save</button>
                                                        <button type="reset" class="btn btn-outline-primary primary"><i class="ft-refresh-cw"></i> Reset</button>

                                                    @endif

                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </form>
                </section>

            </div>
        </div>
    </div>

@stop
