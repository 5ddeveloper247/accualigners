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
        ];

        $ActionButtons = ['Delete','Active','Inactive'];

        $viewRoute = 'user-type';

    @endphp

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-12 col-12 mb-1">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashbord')}}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{url($viewRoute)}}">Users Type</a></li>
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
                                    <h4 class="card-title">User Type</h4>
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
                                                <div class="form-group col-12 <?php if ($errors->has('name')) echo 'error'; ?>">
                                                    <label>Name <span class="required">*</span></label>
                                                    <div class="controls">
                                                        <input type="text" name="name" class="form-control " required
                                                               data-validation-required-message="Name is required"
                                                               value="{{ old('name') }}">
                                                        @if($errors->has('name'))
                                                            <div class="help-block text-danger name-shopwoo-error">
                                                                <ul role="alert">
                                                                    <li>{{$errors->first('name')}}</li>
                                                                </ul>
                                                            </div> @endif
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
