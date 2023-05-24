@extends('originator.root.index')

@section('title', "Admin Login")

@section('content')

@php
    $requiredSections = [

    ];

    $componentsJsCss = [
        'adminPanel.general',
        'adminPanel.login-register',
        'adminPanel.validation',
        'adminPanel.switchery-checkbox',
    ];

    $emailError = null;
    if ($errors->has('email')) {
        $emailError = $errors->first('email');
    }

    $passwordError = null;
    if ($errors->has('password')) {
        $passwordError = $errors->first('password');
    }

    $bodyClasses = "vertical-layout vertical-menu 1-column menu-expanded blank-page blank-page pace-done";
    $dataCol = '1-column';

@endphp
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
       <div class="col-2 text-center mt-2" style="z-index: 9;">
                <a href="{{ url('admin/login'); }}" class="btn btn-primary btn-sm btn-block" >Admin Login</a>
                <a href="https://www.accualigners.com/" class="btn btn-primary btn-sm btn-block" >Home</a>
            </div>
        </div>
        <div class="content-body">
            <section class="flexbox-container">
                <div class="col-12 d-flex align-items-center justify-content-center">
                    <div class="col-md-3 col-10 p-0">
                        <div class="row">
                            <div class="col-12 text-center mb-2">
                                <div class="p-1 login-logo"><img src="{{storageUrl_h(trans('siteConfig.setting.logoDarkVertical'))}}" alt="IdeaEcom logo"></div>
                                <h1 class="mb-0">Welcome Back</h1>
                                <h6 class="card-subtitle font-medium-1 pt-1 text-light"><span>Please sign in to your account</span></h6>
                            </div>
                            <div class="col-12 p-0" style="margin-bottom: 90px;">
                                <div class="card border-grey border-lighten-3 m-0 p-2">
                                    {{-- @if ($error)
                                        <div class="alert alert-danger alert-dismissible mb-2" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                            <strong>Sorry!</strong> {{$error}}
                                        </div>
                                    @endif --}}

                                    <div class="card-content">
                                        <div class="card-body">
                                            <form class="form-horizontal form-simple" method="post" action="{{ url('doctor/login') }}">

                                                {{csrf_field()}}

                                                <fieldset class="form-group">
                                                    <input type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}" required>
                                                </fieldset>

                                                <fieldset class="form-group">
                                                    <input type="password" class="form-control" name="password" placeholder="Password">
                                                </fieldset>

                                                <fieldset class="form-group">
                                                    <label class="text-light">
                                                        <input type="checkbox" name="remember" id="remember" class="switchery" data-size="sm">
                                                         Remember Me
                                                    </label>
                                                </fieldset>
                                                <button type="submit" class="btn btn-primary btn-lg btn-block">Sign In</button>
                                            </form>
                                            <div class="col-12 text-center">
                                                <a href="{{ url('doctor/password/reset') }}" class="btn btn-link box-shadow-0 px-0 text-white-80">Forgot
                                                    password?</a>
                                            </div>
                                             <div class="col-12 text-center mt-2">
                                                <a href="{{ url('admin/signup'); }}" class="card-link text-light">Become a Member? <span class="text-info"><strong>JOIN NOW</strong></span> </a>
                                            </div>
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
