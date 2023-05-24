<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Requests\Api\Auth\SignUpRequest;
use App\Services\Web\Admin\Auth\AuthServices;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Patient;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Hash;
use App\Models\Clinic;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Address;
use App\Traits\EmailTrait;

class AuthController extends Controller
{
    use EmailTrait;
    
    public function loginView(){
        return view('originator.container.auth.login');
    }
    public function loginViewnew(){
        return view('originator.container.auth.loginnew');
    }
    
    public function resetPasswordView(){
        return view('originator.container.auth.reset');
    }
    
     public function changePasswordView(){
        return view('originator.container.auth.change');
    }
    
    public function login(LoginRequest $request)
    {

        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

         $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials,$request->get('remember'))) {
            if(auth()->user()->role->slug === 'admin'){
                 return redirect('admin')->withSuccess('You have Successfully loggedin');
            }
            else if(auth()->user()->role->slug === 'lab-technician'){
                  return redirect('lab-technician')->withSuccess('You have Successfully loggedin');
            }
            else if(auth()->user()->role->slug === 'receptionist'){
                 return redirect('receptionist')->withSuccess('You have Successfully loggedin');
            }
            else{
                 return redirect('doctor')->withSuccess('You have Successfully loggedin');
            }
        }
        return redirect()->back()->withErrors(['message' => 'Invalid Credentials'])->withInput($request->only('email', 'remember'));
        // return redirect()->back()->withError('Invalid Credentials')->withInput($request->only('email', 'remember'));
    }

    public function patientSignup(Request $request)
    {


        $likeToImprove = $request->likeToImprove;
        $activeToothDecay = $request->activeToothDecay;
        $describesYourSmile = $request->describesYourSmile;
        $patientsBirthdate = $request->patientsBirthdate;
        $email = $request->email;
        $phone = $request->phone;
        $lastName = $request->lastName;
        $firstName = $request->firstName;
        $yourQuestion = $request->yourQuestion;
        $dataUsageAgreement = $request->dataUsageAgreement;



        if (User::where('email', '=', $email)->count() > 0) {
            return response()->json(["success" => true, "message" => "Email already exists."], 200);
        } else {
            try {
                $inputs = $request->only(['name', 'email', 'password']);
                DB::beginTransaction();
                $user = User::create($inputs);
                Patient::create(['user_id' => $user->id]);
                DB::commit();
                return response()->json(["success" => true, "message" => "Candidate registeration successful."], 200);
            } catch (Exception $e) {
                DB::rollBack();
                return response()->json(["success" => true, "message" => "Candidate registeration unsuccessful.."], 200);
            }
        }
    }

    public function signUpPost(SignUpRequest $request)
    {
        try {
            DB::beginTransaction();
            $inputs = $request->except('_method', '_token');
            $username = $request->firstname.' '.$request->lastname;
            $inputs['role_id'] = 2;
            $inputs['user_type'] = 'doctor';
            $inputs['name'] = $username;
            $user =  User::create($inputs);
    
         
            $credentials = $request->only('email', 'password');
            if (Auth::attempt($credentials)) {
             $inputs['created_by'] = auth()->user()->id;
             $address = Address::firstOrCreate(
                ['value' => $inputs['address'], 'country_id' => $inputs['country_id'], 'state_id' => $inputs['state_id'],'city_id' => $inputs['city_id']],
                $inputs
            );
            $data = [
              'name' => $inputs['clinic_name'] ,  'address_id' => $address->id, 'created_by' => $user->id
            ];
            $clinic = Clinic::firstOrCreate(
                ['name' => $inputs['clinic_name'] ,  'address_id' => $address->id],
                $data
            );
            /// Doctor
            $to = $request->email;
            $subject = "Welcome To Accualigners";
            $data['username'] = $username;
            $html = view('emails.welcomeDoctor',$data)->render();
            $check = $this->sendMailViaPostMark($html, $to, $subject);
            
             /// Admin
            $to = "info@accualigners.com";
            $subject = "New Doctor Registered";
            $data['username'] = $username;
            $data['address'] = $address;
            $data['clinic'] = $clinic;
            $data['doctor'] = $user;
            $html = view('emails.welcomeDoctorAdmin',$data)->render();
            $check = $this->sendMailViaPostMark($html, $to, $subject);
           
            DB::commit();    
            if(auth()->user()->role->slug === 'admin'){
                 return redirect('admin')->withSuccess('You have Successfully loggedin');
            }
            else if(auth()->user()->role->slug === 'lab-technician'){
                  return redirect('lab-technician')->withSuccess('You have Successfully loggedin');
            }
            else if(auth()->user()->role->slug === 'receptionist'){
                 return redirect('receptionist')->withSuccess('You have Successfully loggedin');
            }
            else{
                 return redirect('doctor')->withSuccess('You have Successfully loggedin');
            }
            
        }
            
           
            return redirect('/login')->with(['successMessage' => 'Successfully signed up!']);
        } catch (Exception $e) {
             DB::rollback();
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function distroy()
    {
        auth()->logout();
        return redirect(route('login'));
    }

    public function resetPassword(Request $request)
    {
        try {
            DB::beginTransaction();
            $otp = random_int(100000, 999999);

            $user = User::where(['email' => $request->email])->first();
            if (empty($user)) {
                return redirect()->back()->withInput($request->input())->withErrors('Email not found');
            }
            $user->otp = $otp;
            $user->save();
            
            $subject = "Reset Your Password";
            $data['name'] = $request->name;
            $data['otp'] = $otp;
            $to = $user->email;
            $html = view('emails.reset-password',$data)->render();
            $this->sendMailViaPostMark($html, $to, $subject);
            DB::commit();
            return redirect('change/password')->with(['successMessage' => 'Otp has been sent on your email']);
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->withErrors($th->getMessage());
        }
    }

    public function changePassword(Request $request)
    {
        $this->validate($request, [
            'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:6'
        ]);
        try {
            DB::beginTransaction();
            $user = User::where(['email' => $request->email])->first();
            if (empty($user)) {
                return redirect()->back()->withInput($request->input())->withErrors('Email not found');
            }
            if ($user->otp != $request->otp) {
                return redirect()->back()->withInput($request->input())->withErrors('Invalid otp');
            }
            $user = User::where('email', $request->email)->update(['otp' => null, 'password' => Hash::make($request->password)]);
            DB::commit();
            return redirect('login')->with(['successMessage' => 'Password has been updated successfully']);
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->withErrors($th->getMessage());
        }
    }
}
