<?php
namespace App\Services\Api\Auth;

use App\Models\Patient;
use App\Models\SocialAccount;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthServices{

    public static function register($request, $user_type){
        try{
            DB::beginTransaction();
            $user_type = strtolower($user_type);
            $request->request->add(['user_type'=> $user_type]);
            $user = User::create($request->all());

            $token = $user->createToken(time())->plainTextToken;

            if($user_type == 'patient'){
                Patient::create(['user_id' => $user->id]);
            }
    
            DB::commit();
            return successArrayResponse_h('',['token'=>$token, 'user'=>$user]);

        }catch(Exception $e){
            DB::rollBack();
            return errorArrayResponse_h($e->getMessage());
        }
    }

    public static function login($request, $user_type){
        try{
            $user = User::where('email', $request->email)->where('user_type', $user_type)->first();

            if($user && Hash::check($request->password, $user->getAuthPassword())){
                $token = $user->createToken(time())->plainTextToken;
                return successArrayResponse_h('', ['token'=>$token, 'user'=>$user]);
            }

            return errorArrayResponse_h('Email or password does not match');

        }catch(Exception $e){
            return errorArrayResponse_h($e->getMessage());
        }
    }

    public static function socialLogin($request, $user_type){
        try{

            $user = User::where('email', $request->email)->first();

            if($user && isset($user->id) ){
                if(strtolower($user_type) != strtolower($user->user_type))
                    return errorArrayResponse_h('This user already registered as ' . $user->user_type . '. Please try with another email account.');
                
                $token = $user->createToken(time())->plainTextToken;
            }else{
                
                $request->request->add(['password'=> '!!!Social123!!!']);
                $register = self::register($request, $user_type);
                
                if(!$register['success'])
                    return errorArrayResponse_h($register['message'],$register['data']);
                
                $token = $register['data']['token'];
                $user = $register['data']['user'];
            }

            SocialAccount::updateOrCreate([
                'provider_id' => $request->provider_id,
                'provider_name' => $request->provider_name,
                'user_id' => $user->id,
            ]);
            
            return successArrayResponse_h('', ['token'=>$token, 'user'=>$user]);

        }catch(Exception $e){
            return errorArrayResponse_h($e->getMessage());
        }
    }

}