<?php
namespace App\Services\Api\Auth;

use App\Models\PasswordReset;
use App\Models\User;
use App\Notifications\Auth\ForgotPassword;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PasswordResetServices{

    public static function forgotPassword($request){
        try{

            $user = User::where('email', $request->email)->first();
            
            $token=substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyzABCDEFGHIJKLMNOPQRSTVWXYZ"), 0, 60);
            $otp = rand ( 10000 , 99999 );

            $PasswordReset = new PasswordReset();
            $PasswordReset->email = $request->email;
            $PasswordReset->token = $token;
            $PasswordReset->otp = $otp;
            if($PasswordReset->save()){
                $user->notify(new ForgotPassword($PasswordReset));
                return successArrayResponse_h('We have sent a OPT on your email.',['token'=>$token,'email'=>$request->email]);
            }

            return errorArrayResponse_h('Something went wrong',);

        }catch(Exception $e){
            DB::rollBack();
            return errorArrayResponse_h($e->getMessage());
        }
    }

    public static function verifyResetPassword($request){
        try{
            
            $PasswordReset = PasswordReset::where('email', $request->email)
            ->where('token', $request->token)
            ->where('otp', $request->otp);

            if(isset($PasswordReset->first()->email)){
                $PasswordReset->update(['deleted_at' => now()]);
                return successArrayResponse_h('OTP verified successfully');
            }

            return errorArrayResponse_h('Invalid OTP');

        }catch(Exception $e){
            return errorArrayResponse_h($e->getMessage());
        }
    }

    public static function resetPassword($request){
        try{
            
            $user = User::where('email', $request->email)->first();

            if($user && isset($user->id)){
                $user->password = $request->password;
                $user->save();
                return successArrayResponse_h('Password updated successfully');
            }

            return errorArrayResponse_h('User not found');

        }catch(Exception $e){
            return errorArrayResponse_h($e->getMessage());
        }
    }

}