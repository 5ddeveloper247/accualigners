@extends('originator.root.index')

@section('title', "User Profile")


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
            'adminPanel.file-input-button',
            'adminPanel.tab',
            'adminPanel.switchery-checkbox',
            'adminPanel.input-mask',
        ];

        $ActionButtons = ['Delete','Active','Inactive'];

    @endphp

    <div class="app-content content">
        <div class="content-wrapper">

            <div class="content-body">

                <section id="column-visibility">


                    <div class="row">
                        <div class="col-xl-12 col-lg-12">
                            <div class="card">
                                <div class="card-header  bg-hexagons">
                                    <h4 class="card-title">User Profile</h4>
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
                                    <div class="card-body card-dashboard">

                                        <div class="card-content">
                                            <div class="card-body">

                                                <form class="form-horizontal" method="post" action="{{url(Request()->path())}}" enctype="multipart/form-data" novalidate>

                                                    {{csrf_field()}}
                                                    <div class="row">

                                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">

                                                            <h4 class="form-section">Shop Basic Info</h4>

                                                            <div class="form-group form-group-style col-12  <?php if ($errors->has('first_name')) echo 'error'; ?>">
                                                                <label>First Name</label>
                                                                <div class="controls">
                                                                    <input type="text" id="first_name" name="first_name" class="form-control " required
                                                                           data-validation-required-message="First name is required"
                                                                           maxlength="50"
                                                                           data-validation-maxlength-message="Max 50 characters allowed"
                                                                           value="{{ old('first_name') }}">
                                                                    @if($errors->has('first_name'))
                                                                        <div class="help-block text-danger first_name-shopwoo-error">
                                                                            <ul role="alert">
                                                                                <li>{{$errors->first('first_name')}}</li>
                                                                            </ul>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <div class="form-group form-group-style col-12  <?php if ($errors->has('last_name')) echo 'error'; ?>">
                                                                <label>Last Name</label>
                                                                <div class="controls">
                                                                    <input type="text" id="last_name" name="last_name" class="form-control " required
                                                                           data-validation-required-message="Last name is required"
                                                                           maxlength="100"
                                                                           data-validation-maxlength-message="Max 100 characters allowed"
                                                                           value="{{ old('last_name') }}">
                                                                    @if($errors->has('last_name'))
                                                                        <div class="help-block text-danger last_name-shopwoo-error">
                                                                            <ul role="alert">
                                                                                <li>{{$errors->first('last_name')}}</li>
                                                                            </ul>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <div class="form-group form-group-style col-12  <?php if ($errors->has('email')) echo 'error'; ?>">
                                                                <label>Email</label>
                                                                <div class="controls">
                                                                    <input type="text" id="email" name="email" class="form-control "
                                                                           value="{{ old('email') }}" readonly>
                                                                    @if($errors->has('email'))
                                                                        <div class="help-block text-danger email-shopwoo-error">
                                                                            <ul role="alert">
                                                                                <li>{{$errors->first('email')}}</li>
                                                                            </ul>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <div class="form-group form-group-style col-12  <?php if ($errors->has('gender')) echo 'error'; ?>">
                                                                <label>Gender</label>
                                                                <div class="controls">
                                                                    <select class="form-control" name="gender" >
                                                                        <option value="MALE" @if(old('gender') == 'MALE') selected @endif>{{ucfirst(strtolower('MALE'))}}</option>
                                                                        <option value="FEMALE" @if(old('gender') == 'FEMALE') selected @endif>{{ucfirst(strtolower('FEMALE'))}}</option>
                                                                        <option value="OTHER" @if(old('gender') == 'OTHER') selected @endif>{{ucfirst(strtolower('OTHER'))}}</option>
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

                                                            <div class="form-group form-group-style col-12  <?php if ($errors->has('mobile')) echo 'error'; ?>">
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

                                                            <div class="form-group form-group-style col-12  <?php if ($errors->has('phone')) echo 'error'; ?>">
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
                                                            </div>

                                                            <div class="form-group form-group-style col-12 <?php if ($errors->has('password')) echo 'error'; ?>">
                                                                <label>Password </label>
                                                                <div class="controls">
                                                                    <input type="password" name="password" class="form-control " autocomplete="new-password">
                                                                    @if($errors->has('password'))
                                                                        <div class="help-block text-danger password-shopwoo-error">
                                                                            <ul role="alert">
                                                                                <li>{{$errors->first('password')}}</li>
                                                                            </ul>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <div class="form-group form-group-style col-12 <?php if ($errors->has('password_confirmation')) echo 'error'; ?>">
                                                                <label>Confirm password</label>
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
                                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 ">

                                                            <h4 class="form-section">Picture</h4>

                                                            <div class="row">
                                                                <label class="ml-auto mr-auto p-1 img-lable">
                                                                    <img src="{{storageUrl_h(old('picture'))}}" data-default="{{storageUrl_h(old('picture'))}}" class="rounded-circle height-150 width-150 ml-auto mr-auto mt-1 fileInputShow" alt="Card image">
                                                                    @if($errors->has('picture'))
                                                                        <div class="help-block text-danger picture-shopwoo-error">
                                                                            <ul role="alert">
                                                                                <li>{{$errors->first('picture')}}</li>
                                                                            </ul>
                                                                        </div>
                                                                    @endif
                                                                    <input type="file" id="picture" name="picture" class="fileInput" required accept="image/*">
                                                                </label>

                                                            </div>

                                                        </div>


                                                    </div>

                                                    <div class="form-actions text-right from-submit-btn">

                                                        <button type="submit" class="btn btn-danger btn-glow"> <i class="ft-save"></i> Save</button>

                                                    </div>


                                                </form>

                                            </div>
                                        </div>

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


