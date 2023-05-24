@extends('originator.root.index')

@section('title', "User")


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

        $viewRoute = route('admin.user.index');

        $edit_id = false;
        $form_action = route('admin.user.store');

        if(Request()->route('user')){
            $edit_id = Request()->route('user');
            $form_action = route('admin.user.update', $edit_id);
        }
    @endphp
    
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-12 col-12 mb-1">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashbord')}}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{$viewRoute}}">Users</a></li>
                                <li class="breadcrumb-item active">{{ $edit_id ? 'Edit' : 'Add New' }} User</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">

                <section id="column-visibility">
                        <form class="form-horizontal" method="post" action="{{$form_action}}" enctype="multipart/form-data" novalidate>

                            <div class="row">

                                <div class="col-xl-9 col-md-9 col-sm-12">
                                    <div class="card">
                                        <div class="card-header  bg-hexagons">
                                            <h4 class="card-title">User</h4>
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

                                                    <div class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-12 <?php if ($errors->has('name')) echo 'error'; ?>">
                                                        <label>Full name <span class="required">*</span></label>
                                                        <div class="controls">
                                                            <input type="text" name="name" class="form-control" required
                                                                   data-validation-required-message="Full name is required"
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
                                                    
                                                    <div class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-12 <?php if ($errors->has('role_id')) echo 'error'; ?>">
                                                        <label>Role <span class="required">*</span></label>
                                                        <div class="controls">
                                                            <select class="select2 form-control" name="role_id" required >
                                                                @foreach ($roles as $role)
                                                                <option value="{{$role->id}}" {{ isset($edit_values) ? (($edit_values->role_id == $role->id) ?  'selected' : '') : ((old('role_id') == $role->id) ? 'selected' : '') }}>{{ $role->name }}</option>  
                                                                @endforeach

                                                            </select>
                                                            @if($errors->has('role_id'))
                                                                <div class="help-block text-danger role_id-shopwoo-error">
                                                                    <ul role="alert">
                                                                        <li>{{$errors->first('role_id')}}</li>
                                                                    </ul>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    {{-- <div class="form-group col-xl-4 col-lg-4 col-md-4 col-sm-12 <?php if ($errors->has('gender')) echo 'error'; ?>">
                                                        <label>Gender <span class="required">*</span></label>
                                                        <div class="controls">
                                                            <select class="form-control" name="gender" >
                                                                <option value="MALE" @if($edit_id) @if(old('gender') == 'MALE') selected @endif @endif>{{ucfirst(strtolower('MALE'))}}</option>
                                                                <option value="FEMALE" @if($edit_id) @if(old('gender') == 'FEMALE') selected @endif @endif>{{ucfirst(strtolower('FEMALE'))}}</option>
                                                                <option value="OTHER" @if($edit_id) @if(old('gender') == 'OTHER') selected @endif @endif>{{ucfirst(strtolower('OTHER'))}}</option>
                                                            </select>
                                                            @if($errors->has('gender'))
                                                                <div class="help-block text-danger gender-shopwoo-error">
                                                                    <ul role="alert">
                                                                        <li>{{$errors->first('gender')}}</li>
                                                                    </ul>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-xl-4 col-lg-4 col-md-4 col-sm-12 <?php if ($errors->has('mobile')) echo 'error'; ?>">
                                                        <label>Mobile No. </label>
                                                        <div class="controls">
                                                            <input type="text" name="mobile" class="form-control international-formatter"
                                                                   value="{{ old('mobile') }}">
                                                            @if($errors->has('mobile'))
                                                                <div class="help-block text-danger mobile-shopwoo-error">
                                                                    <ul role="alert">
                                                                        <li>{{$errors->first('mobile')}}</li>
                                                                    </ul>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-xl-4 col-lg-4 col-md-4 col-sm-12 <?php if ($errors->has('phone')) echo 'error'; ?>">
                                                        <label>Phone No. </label>
                                                        <div class="controls">
                                                            <input type="text" name="phone" class="form-control international-formatter"
                                                                   value="{{ old('phone') }}">
                                                            @if($errors->has('phone'))
                                                                <div class="help-block text-danger phone-shopwoo-error">
                                                                    <ul role="alert">
                                                                        <li>{{$errors->first('phone')}}</li>
                                                                    </ul>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div> --}}

                                                    <div class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-12 <?php if ($errors->has('email')) echo 'error'; ?>">
                                                        <label>Email <span class="required">*</span></label>
                                                        <div class="controls">
                                                            <input type="email" name="email" class="form-control " required
                                                                   data-validation-required-message="Email is required"
                                                                   value="{{ old('email', isset($edit_values) ? $edit_values->email : NULL) }}"  autocomplete="off">
                                                            @if($errors->has('email'))
                                                                <div class="help-block text-danger email-shopwoo-error">
                                                                    <ul role="alert">
                                                                        <li>{{$errors->first('email')}}</li>
                                                                    </ul>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-12 <?php if ($errors->has('password')) echo 'error'; ?>">
                                                        <label>Password @if( !$edit_id ) <span class="required">*</span> @endif </label>
                                                        <div class="controls">
                                                            <input type="password" name="password" class="form-control "
                                                                   @if( !$edit_id ) required data-validation-required-message="Password is required" @endif autocomplete="new-password">
                                                            @if($errors->has('password'))
                                                                <div class="help-block text-danger password-shopwoo-error">
                                                                    <ul role="alert">
                                                                        <li>{{$errors->first('password')}}</li>
                                                                    </ul>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-12 <?php if ($errors->has('password_confirmation')) echo 'error'; ?>">
                                                        <label>Confirm password @if( !$edit_id ) <span class="required">*</span> @endif </label>
                                                        <div class="controls">
                                                            <input type="password" name="password_confirmation" class="form-control "
                                                                   data-validation-match-match="password">
                                                            @if($errors->has('password_confirmation'))
                                                                <div class="help-block text-danger password_confirmation-shopwoo-error">
                                                                    <ul role="alert">
                                                                        <li>{{$errors->first('password_confirmation')}}</li>
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
                                <div class="col-xl-3 col-md-3 col-sm-12">
                                    <div class="card">
                                        <div class="card-header  bg-hexagons">
                                            <h4 class="card-title">Picture</h4>
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
                                                    <img src="{{isset($edit_values) ? $edit_values->picture : storageUrl_h(old('picture'))}}" data-default="{{isset($edit_values) ? $edit_values->picture : storageUrl_h(old('picture'))}}" class="rounded-circle height-150 width-150 ml-auto mr-auto mt-1 fileInputShow" alt="Card image">
                                                    @if($errors->has('picture'))
                                                        <div class="help-block text-danger picture-shopwoo-error">
                                                            <ul role="alert">
                                                                <li>{{$errors->first('picture')}}</li>
                                                            </ul>
                                                        </div>
                                                    @endif
                                                </div>

                                                <div class="form-actions from-submit-btn text-center pt-1 mt-1 " style="border-top: 1px solid #d1d5ea;">
                                                    <label class="btn btn-primary"> <i class="ft-upload-cloud"></i> Upload
                                                        <input type="file" id="picture" name="picture" class="fileInput" accept="image/*">
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
