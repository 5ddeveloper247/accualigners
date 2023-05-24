<?php

namespace App\Http\Controllers\Web\Doctor\Profile;

use App\Http\Controllers\Controller;
use App\Models\CaseModel;
use App\Models\Order;
use App\Models\Doctor;
use App\Models\User;
use App\Models\ClinicDoctor;
use App\Models\Clinic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Hash;

class ProfileController extends Controller
{
    public function index_new(Request $request)
    {
         $doctor = User::find($request->id);
         $ClinicDoctors =  ClinicDoctor::where(['doctor_id'=> auth()->user()->id])->get();
         // $clinics = Clinic::get();
         // foreach($clinics as $clinic){
         //   $ClinicDoctor =  ClinicDoctor::where(['doctor_id'=> auth()->user()->id, 'clinic_id' => $clinic->id ])->first();
         //   if(!empty($ClinicDoctor)){
         //       $clinic->relationHas = true;
         //   }
         //   else{
         //     $clinic->relationHas = false;
         //   }
         // }
         return view('doctor.container.userProfile.user-profile', compact('doctor', 'ClinicDoctors'));
    }

    public function index(Request $request)
    {
         $doctor = User::find($request->id);
         $ClinicDoctors =  ClinicDoctor::where(['doctor_id'=> auth()->user()->id])->get();
         // $clinics = Clinic::get();
         // foreach($clinics as $clinic){
         //   $ClinicDoctor =  ClinicDoctor::where(['doctor_id'=> auth()->user()->id, 'clinic_id' => $clinic->id ])->first();
         //   if(!empty($ClinicDoctor)){
         //       $clinic->relationHas = true;
         //   }
         //   else{
         //     $clinic->relationHas = false;
         //   }
         // }
         return view('doctor.container.userProfile.user-profile-new', compact('doctor', 'ClinicDoctors'));
    }

    public function downloads(Request $request)
    {
        return view('doctor.container.downloads.download');
    }

    public function agreement(Request $request)
    {
        return view('doctor.container.agreements.agreement');
    }

    static function update_clinic($clinics_ids){
        
      ClinicDoctor::where(['doctor_id'=> auth()->user()->id])->whereIn('clinic_id',$clinics_ids)->update(['status'=> 1]);
      ClinicDoctor::where(['doctor_id'=> auth()->user()->id])->whereNotIn('clinic_id',$clinics_ids)->update(['status'=> 0]);
    }

    public function updateProfile(Request $request)
     {
                 // dd($request->all());
                 //  ini_set('display_errors', 'On');
                 //  error_reporting(E_ALL);
                  try {
                  DB::beginTransaction();
                 // return Auth()
                 $user_id = auth()->user()->id;
                 $data = $request->except('_token','password_confirmation');
        
             if ($request->hasFile('picture')) {
                         $media = $request->file('picture');
                         $ImageName = 'User-' . Carbon::now()->timestamp . '.' . $media->extension();
                         Storage::disk(env('FILE_SYSTEM'))->putFileAs('users', $media, $ImageName);
                     if (!is_null($request->password) && $request->filled('password')) {
                             //  dd($ImageName);
                            //  if(isset($request->clinics_ids)){
                            //     $this->update_clinic($request->clinics_ids);
                            //  }
                             $data['password'] = Hash::make($request->password);
                             $data = $request->except('password_confirmation','_token','password');
                             
                     }else{
                            //  if(isset($request->clinics_ids)){
                            //     $this->update_clinic($request->clinics_ids);
                            //  }
                             $data = $request->except('password','password_confirmation','_token');
                             $data['picture'] = 'users/'.$ImageName;
                     }
             }else{
                if (!is_null($request->password) && $request->filled('password')) {
                     $data['password'] = Hash::make($request->password);
                    //  if(isset($request->clinics_ids)){
                    //     $this->update_clinic($request->clinics_ids);
                    //  }
                }else{
                     //  if(isset($request->clinics_ids)){
                     //     $this->update_clinic($request->clinics_ids);
                     //  }     
                     $data = $request->except('_token','password_confirmation','password','picture');  
                 }
             }

         
            
             if(User::where('id', $user_id)->update($data)) {
                $data['done'] = true;
                $data['msg'] = 'Profile updated successfully';
             } else {
                $data['done'] = false;
                $data['msg'] = 'Error updating profile';
             }
        
             DB::commit();
             return redirect()->back()->with('success','Profile updated successfully');
             return response()->json($data);
        } catch (\Throwable $e) {
             DB::rollback();
            //  return redirect()->back()->with('error',$e->getMessage());
             return response()->json(['error' => $e->getMessage()], 500);
        }
        
     }

    public function chnagePassword(Request $request)
    {
         $this->validate($request, [
            'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:6'
         ]);
         try {
             DB::beginTransaction();
             $user_id = auth()->user()->id;
             $data = $request->all();
             $user = User::where('id', $user_id)->update(['password' => Hash::make($request->password) ]);
             DB::commit();
             return redirect(url('doctor/account-details/' . $user_id))->with(['successMessage' => 'Profile update successfully']);
        } catch (\Throwable $e) {
             DB::rollback();
             return redirect()->back()->withErrors($e->getMessage());
        }
    }
    
    public function updateClinics(Request $request){
        $this->validate($request, [
            'clinics_ids.*' => 'exists:clinics,id',
        ]);
        
        try {
            DB::beginTransaction();
              $clinics_ids = $request->clinics_ids;
              $user_id = auth()->user()->id;
              
              
            ClinicDoctor::where(['doctor_id'=> auth()->user()->id])->whereIn('clinic_id',$clinics_ids)->update(['status'=> 1]);
            ClinicDoctor::where(['doctor_id'=> auth()->user()->id])->whereNotIn('clinic_id',$clinics_ids)->update(['status'=> 0]);
           
             // foreach($clinics_ids as $key => $clinic_id){
             //     ClinicDoctor::firstOrCreate(
             //       ['doctor_id' => $user_id,'clinic_id' => $clinic_id],
             //       ['doctor_id' => $user_id,'clinic_id' => $clinic_id]
             //     );    
             // }
        
            DB::commit();
            return redirect(url('doctor/account-details/' . $user_id))->with(['successMessage' => 'Clinic has been added successfully']);
        } catch (\Throwable $e) {
            DB::rollback();
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
}
