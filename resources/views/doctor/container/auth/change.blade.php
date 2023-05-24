@extends('originator.root.index')

@section('title', "Password Reset")

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
        </div>
        <div class="content-body">
            <section class="flexbox-container">
                <div class="col-12 d-flex align-items-center justify-content-center">
                    <div class="col-md-3 col-10 p-0">
                        <div class="row">
                            <div class="col-12 text-center mb-2">
                                <div class="p-1 login-logo"><img
                                        src="{{storageUrl_h(trans('siteConfig.setting.logoDarkVertical'))}}"
                                        alt="IdeaEcom logo"></div>
                                <h1 class="mb-0">Welcome Back</h1>
                                <h6 class="card-subtitle font-medium-1 pt-1 text-light"><span>Change your account
                                        password</span></h6>
                            </div>
                            <div class="col-12 p-0">
                                <div class="card border-grey border-lighten-3 m-0 p-2">
                                    <div class="card-content">
                                        <div class="card-body">
                                            <form class="form-horizontal form-simple" method="POST"
                                                action="{{ url('doctor/change/password') }}">
                                                {{csrf_field()}}
                                                <fieldset class="form-group">
                                                    <input type="email" class="form-control" name="email"
                                                        placeholder="Email" value="{{ old('email') }}" required>
                                                </fieldset>

                                                <fieldset class="form-group">
                                                    <input type="number" class="form-control" name="otp"
                                                        placeholder="Otp" value="{{ old('otp') }}" required>
                                                </fieldset>

                                                <fieldset class="form-group">
                                                    <input name="password" type="password" class="form-control"
                                                        placeholder="Password" required>
                                                </fieldset>

                                                <fieldset class="form-group">
                                                    <input name="password_confirmation" type="password"
                                                        class="form-control" placeholder="Confirm Password" required>
                                                </fieldset>

                                                <button type="submit"
                                                    class="btn btn-primary btn-lg btn-block">Send</button>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-12 text-center mt-2">
                                <a href="{{ url('admin/signup'); }}" class="card-link text-light">Become a Member? <span
                                        class="text-info"><strong>JOIN NOW</strong></span> </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>
</div>

@stop