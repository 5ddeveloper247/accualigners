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
            'adminPanel.validation',
            'adminPanel.select2',
            'adminPanel.file-input-button',
            'adminPanel.input-mask',
        ];
        $slug = auth()->user()->role->slug;
        $viewRoute = route($slug.'.slider.index');

        $edit_id = false;
        $form_action = route($slug.'.slider.store');

        if(Request()->route('slider')){
            $edit_id = Request()->route('slider');
            $form_action = route($slug.'.slider.update', $edit_id);
        }
    @endphp

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-12 col-12 mb-1">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route($slug.'.dashbord')}}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{$viewRoute}}">Sliders</a></li>
                                <li class="breadcrumb-item active">{{ $edit_id ? 'Edit' : 'Add New' }} Slider</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">

                <section id="column-visibility">
                        <form class="form-horizontal" method="post" action="{{$form_action}}" enctype="multipart/form-data" novalidate>
                            {{csrf_field()}}

                            <div class="row">

                                <div class="col-xl-3 col-md-3 col-sm-12">
                                    <div class="card">
                                        <div class="card-header  bg-hexagons">
                                            <h4 class="card-title">Slider</h4>
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


                                                <div class="row">

                                                    <div class="form-group col-12 <?php if ($errors->has('sort_order')) echo 'error'; ?>">
                                                        <label>Sort Order <span class="required">*</span></label>
                                                        <div class="controls">
                                                            <input type="text" name="sort_order" class="form-control" required
                                                                   data-validation-required-message="Sort order is required"
                                                                   data-validation-containsnumber-regex="((\d+)?)"
                                                                data-validation-containsnumber-message="Enter a valid number"
                                                                   value="{{ old('sort_order', isset($edit_values) ? $edit_values->sort_order : NULL) }}">
                                                            @if($errors->has('sort_order'))
                                                                <div class="help-block text-danger sort_order-shopwoo-error">
                                                                    <ul role="alert">
                                                                        <li>{{$errors->first('sort_order')}}</li>
                                                                    </ul>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>


                                                </div>

                                                <div class="form-actions text-right from-submit-btn">

                                                    @if( $edit_id )
                                                        @method('PUT')
                                                        <button type="submit" class="btn btn-success"><i class="ft-save"></i> Update</button>
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
                                <div class="col-xl-9 col-md-9 col-sm-12">
                                    <div class="card">
                                        <div class="card-header  bg-hexagons">
                                            <h4 class="card-title">Image</h4>
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
                                                <div class="row">
                                                    <img src="{{isset($edit_values) ? $edit_values->slider_image : storageUrl_h(old('slider_image'))}}" data-default="{{isset($edit_values) ? $edit_values->slider_image : storageUrl_h(old('slider_image'))}}" class="height-200 ml-auto mr-auto mt-1 fileInputShow" alt="Card image">
                                                    @if($errors->has('slider_image'))
                                                        <div class="help-block text-danger slider_image-shopwoo-error">
                                                            <ul role="alert">
                                                                <li>{{$errors->first('slider_image')}}</li>
                                                            </ul>
                                                        </div>
                                                    @endif
                                                </div>

                                                <div class="form-actions from-submit-btn text-center pt-1 mt-1 " style="border-top: 1px solid #d1d5ea;">
                                                    <label class="btn btn-primary"> <i class="ft-upload-cloud"></i> Upload
                                                        <input type="file" id="slider_image" name="slider_image" class="fileInput" accept="image/*">
                                                    </label>
                                                    {{--<button type="submit" class="btn btn-success btn-glow"><i class="ft-upload-cloud"></i> Upload</button>--}}

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