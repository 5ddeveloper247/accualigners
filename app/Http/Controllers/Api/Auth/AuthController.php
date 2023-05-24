<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Requests\Api\Auth\RegisterRequest;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function register(RegisterRequest $request){
        // dd($request);
        try{
            DB::beginTransaction();
            $user = User::create($request->all());

            $token = $user->createToken(time())->plainTextTokens;
    
            DB::commit();
            return successJsonResponse_h('',['token'=>$token, 'user'=>$user]);

        }catch(Exception $e){
            DB::rollBack();
            return errorJsonResponse_h($e->getMessage());
        }
    }

    public function login(LoginRequest $request){

        try{
            $user = User::where('email', $request->email)->first();

            if($user && Hash::check($request->password, $user->getAuthPassword())){
                $token = $user->createToken(time())->plainTextToken;
                return successJsonResponse_h('', ['token'=>$token, 'user'=>$user]);
            }

            return errorUnauthorizedJsonResponse_h('Email or password does not match');

        }catch(Exception $e){
            return errorJsonResponse_h($e->getMessage());
        }
    }
}
