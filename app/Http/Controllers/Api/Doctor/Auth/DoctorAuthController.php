<?php

namespace App\Http\Controllers\Api\Doctor\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\ForgotPasswordRequest;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Requests\Api\Auth\RegisterRequest;
use App\Http\Requests\Api\Auth\ResetPasswordRequest;
use App\Http\Requests\Api\Auth\VerifyResetPasswordRequest;
use App\Services\Api\Auth\AuthServices;
use App\Services\Api\Auth\PasswordResetServices;

class DoctorAuthController extends Controller
{
    public function register(RegisterRequest $request){

        $AuthServices = AuthServices::register($request, 'doctor');
        if($AuthServices['success']){
            return successJsonResponse_h($AuthServices['message'],$AuthServices['data']);
        }

        return errorJsonResponse_h($AuthServices['message'] ?? 'Something went wrong');
    }

    public function login(LoginRequest $request){

        $AuthServices = AuthServices::login($request, 'doctor');
        if($AuthServices['success']){
            return successJsonResponse_h($AuthServices['message'],$AuthServices['data']);
        }

        return errorJsonResponse_h($AuthServices['message'] ?? 'Something went wrong');
    }

    public function forgotPassword(ForgotPasswordRequest $request){

        $PasswordResetServices = PasswordResetServices::forgotPassword($request);
        if($PasswordResetServices['success']){
            return successJsonResponse_h($PasswordResetServices['message'],$PasswordResetServices['data']);
        }

        return errorJsonResponse_h($PasswordResetServices['message'] ? $PasswordResetServices['message'] : 'Something went wrong');
    }

    public function verifyResetPassword(VerifyResetPasswordRequest $request){
        
        $PasswordResetServices = PasswordResetServices::verifyResetPassword($request);
        if($PasswordResetServices['success']){
            return successJsonResponse_h($PasswordResetServices['message'],$PasswordResetServices['data']);
        }

        return errorJsonResponse_h($PasswordResetServices['message'] ? $PasswordResetServices['message'] : 'Something went wrong');
    }

    public function resetPassword(ResetPasswordRequest $request){
        
        $PasswordResetServices = PasswordResetServices::resetPassword($request);
        if($PasswordResetServices['success']){
            return successJsonResponse_h($PasswordResetServices['message'],$PasswordResetServices['data']);
        }

        return errorJsonResponse_h($PasswordResetServices['message'] ? $PasswordResetServices['message'] : 'Something went wrong');
    }
}
