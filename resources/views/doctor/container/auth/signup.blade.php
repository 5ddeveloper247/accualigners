@extends('originator.root.index')

@section('title', "Doctor Signup")

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
    
    $postRoute = route('admin.signUpPost');

@endphp
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <section class="flexbox-container">
                <div class="col-12 d-flex align-items-center justify-content-center">
                    <div class="col-md-3 col-10 p-0">
                        <div class="row">
                            <div class="col-12 text-center mb-2">
                                <div class="p-1 login-logo"><img src="{{storageUrl_h(trans('siteConfig.setting.logoDarkVertical'))}}" alt="IdeaEcom logo"></div>
                                <h1 class="mb-0">Sign Up</h1>
                                <h6 class="card-subtitle font-medium-1 pt-1 text-light"><span>Please fill all the details</span></h6>
                            </div>
                            <div class="col-12 p-0">
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
                                            <form class="form-horizontal form-simple" method="post" action="{{$postRoute}}">

                                                {{csrf_field()}}

                                                <fieldset class="form-group">
                                                    <input type="text" class="form-control" name="fullname" placeholder="Full Name" value="" required>
                                                </fieldset>
                                                <fieldset class="form-group">
                                                    <input type="email" class="form-control" name="email" placeholder="Email" value="" required>
                                                </fieldset>

                                                <fieldset class="form-group">
                                                    <input type="password" class="form-control" name="password" placeholder="Password">
                                                </fieldset>
                                                
                                                <fieldset class="form-group">
                                                    <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password">
                                                </fieldset>

                                                <button type="submit" class="btn btn-primary btn-lg btn-block">Sign Up</button>
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
