<?php
namespace App\Services\Web\Doctor\Auth;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthServices{


    public static function login($request, $user_type){
        try{
            if(Auth::guard('doctor')->attempt(['email'=>$request->email, 'password'=>$request->password, 'user_type' => $user_type], $request->get('remember'))){
                return successArrayResponse_h();
            }

            return errorArrayResponse_h('Email or password is wrong.');

        }catch(Exception $e){
            return errorArrayResponse_h($e->getMessage());
        }
    }

}