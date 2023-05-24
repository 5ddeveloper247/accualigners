<?php

namespace App\Http\Controllers\Web\Admin\Doctor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Admin\Doctor\DoctorEditRequest;
use App\Http\Requests\Web\Admin\Doctor\DoctorStoreRequest;
use App\Http\Requests\Web\Admin\Doctor\DoctorUpdateRequest;
use App\Notifications\CaseNotification\NewDoctorNotification;
use Illuminate\Support\Facades\Mail;
use App\Models\Doctor;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Traits\EmailTrait;

class DoctorController extends Controller
{
    use EmailTrait;
    
    //new index
    public function index(Request $request)
    {
        try{

            $doctors = User::where('user_type', 'doctor');
            if($request->has('filter') && !empty($request->filter)){
                $filter = $request->filter;
                $doctors = $doctors->where(function ($query) use($filter){
                    $query->where('name', 'like', "%".$filter."%")
                        ->orWhere('id', $filter)
                        ->orWhere('email','like','%'.$filter.'%');
                });
            }

            $doctors = $doctors->paginate(15);

            return view('originator.container.doctor.doctor-view-new', compact('doctors'));

        }catch(Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
    
    // public function prev_index(Request $request)
    // {
    //     try{

    //         $doctors = User::where('user_type', 'doctor');
    //         if($request->has('filter') && !empty($request->filter)){
    //             $filter = $request->filter;
    //             $doctors = $doctors->where(function ($query) use($filter){
    //                 $query->where('name', 'like', "%".$filter."%")
    //                     ->orWhere('id', $filter)
    //                     ->orWhere('email','like','%'.$filter.'%');
    //             });
    //         }

    //         $doctors = $doctors->paginate(15);

    //         return view('originator.container.doctor.doctor-view', compact('doctors'));

    //     }catch(Exception $e){
    //         return redirect()->back()->withErrors($e->getMessage());
    //     }
    // }

    public function create()
    {
        try{
            return view('originator.container.doctor.doctor-form');
        }catch(Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    //new store
    public function store(DoctorStoreRequest $request)
    {        
        try {
            DB::beginTransaction();
        
             $inputs = $request->only(['name', 'email', 'password']);
             if ($request->hasFile('picture')) {
                 $media = $request->file('picture');
                 $ImageName = 'User-' . Carbon::now()->timestamp . '.' . $media->extension();
                 Storage::Disk(env('FILE_SYSTEM'))->putFileAs('users', $media, $ImageName);
                 $inputs['picture'] = 'users/'.$ImageName;
             }
            //  else{
            //     $inputs=
            //  }
             $inputs['user_type'] = 'doctor';
             $inputs['role_id'] = 2;
             // exit;

              $user= DB::table('users')->insert($inputs);
              //  $user=User::create($inputs);
            //  dd($user);

             if($user)         
                {   
                    DB::commit();
                    $to = $request->email;
                    $subject = "Welcome To Accualigners";
                    $data['username'] = $request->name;
                    $html = view('emails.welcomeDoctor',$data)->render();
                    $check = $this->sendMailViaPostMark($html, $to, $subject);
                   
                    //Admin
                    $to = "info@accualigners.com";
                    $subject = "New Doctor Created";
                    $data['username'] = $request->name;
                    $html = view('emails.newDoctorAdmin',$data)->render();
                    $check = $this->sendMailViaPostMark($html, $to, $subject);

                     $arrRes['msg']  = "Data saved successfully";
                     $arrRes['done'] = true;
                }else{
                     $arrRes['done'] = false;
                     $arrRes['msg'] = 'Error in saving Data';
                }
             return response()->json($arrRes);
                   // }catch(Exception $e){
             $arrRes['done'] = false;
             $arrRes['msg'] = 'SomeThing went wrong';
             return response()->json($arrRes);

            } catch (\Throwable $e) {
                DB::rollback();
               //  return redirect()->back()->with('error',$e->getMessage());
                return response()->json(['error' => $e->getMessage()], 500);
           }
         // }
     }

     // public function store(DoctorStoreRequest $request)
     // {
     //     try{
     //         $inputs = $request->only(['name', 'email', 'password']);
     //         if ($request->hasFile('picture')) {
     //             $media = $request->file('picture');
     //             $ImageName = 'User-' . Carbon::now()->timestamp . '.' . $media->extension();
     //             Storage::Disk(env('FILE_SYSTEM'))->putFileAs('users', $media, $ImageName);
     //             $inputs['picture'] = 'users/'.$ImageName;
     //         }
     //         $inputs['user_type'] = 'doctor';
     //         $inputs['role_id'] = 2;
            
     //         $to = $request->email;
     //         $subject = "Welcome To Accualigners";
     //         $data['username'] = $request->name;
     //         $html = view('emails.welcomeDoctor',$data)->render();
    //         $check = $this->sendMailViaPostMark($html, $to, $subject);
    //         // print_r($request);
    //         // exit;
    //         User::create($inputs);
    //         return redirect()->back()->with(['successMessage' => 'doctor created successfully']);

    //     }catch(Exception $e){
    //         return redirect()->back()->withErrors($e->getMessage());
    //     }
    // }

    public function show($id)
    {
        
    }

    //new edit
    public function edit(DoctorEditRequest $request, $id)
    {
        try{
            $edit_values = User::find($id);
            $data['edit_values'] = $edit_values;
            return response()->json($data);
        }catch(Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
    
    // public function prev_edit(DoctorEditRequest $request, $id)
    // {
    //     try{
    //         $edit_values = User::find($id);
    //         return view('originator.container.doctor.doctor-form', compact('edit_values'));
    //     }catch(Exception $e){
    //         return redirect()->back()->withErrors($e->getMessage());
    //     }
    // }
    
    //new update
    public function update_new(Request $request)
    {
        $id = $request['ElementId'];
        try{
            $inputs = $request->only(['name', 'email', 'password']);
            if ($request->hasFile('picture')) {
                $media = $request->file('picture');
                $ImageName = 'User-' . Carbon::now()->timestamp . '.' . $media->extension();
                Storage::Disk(env('FILE_SYSTEM'))->putFileAs('users', $media, $ImageName);
                $inputs['picture'] = 'users/'.$ImageName;
            }

                if(empty($inputs['password']))
                    unset($inputs['password']);

                $user = User::find($id);
                if($user->update($inputs))         
                {
                    $arrRes['msg']  = "Data updated successfully";
                    $arrRes['done'] = true;
                }else{
                    $arrRes['done'] = false;
                    $arrRes['msg'] = 'Error in updating Data';
                }
            return response()->json($arrRes);

        }catch(Exception $e){
            $arrRes['error'] = 'something wrong';
            return response()->json($arrRes);
        }
    }

    // public function update(DoctorUpdateRequest $request, $id)
    // {
    //     try{
    //         $inputs = $request->only(['name', 'email', 'password']);
    //         if ($request->hasFile('picture')) {
    //             $media = $request->file('picture');
    //             $ImageName = 'User-' . Carbon::now()->timestamp . '.' . $media->extension();
    //             Storage::Disk(env('FILE_SYSTEM'))->putFileAs('users', $media, $ImageName);
    //             $inputs['picture'] = 'users/'.$ImageName;
    //         }

    //         if(empty($inputs['password']))
    //             unset($inputs['password']);

    //         $user = User::find($id);
    //         $user->update($inputs);

    //         return redirect()->back()->with(['successMessage' => 'Doctor updated successfully']);

    //     }catch(Exception $e){
    //         return redirect()->back()->withErrors($e->getMessage());
    //     }
    // }


    //new destroy
    public function destroy(DoctorEditRequest $request,$id)
    {
        $recordIds = explode(",",$id);
        try{
            foreach($recordIds as $id)
            {
                $doctor = User::find($id);
                if($doctor->forceDelete())         
                {
                    $arrRes['msg']  = "Data Deleted successfully";
                    $arrRes['done'] = true;
                }else{
                        $arrRes['done'] = false;
                        $arrRes['msg'] = 'Error in Deleting Data';
                }
            }
            return response()->json($arrRes);
        }catch(Exception $e){
            $arrRes['done'] = false;
            $arrRes['msg'] = 'some error';
            return response()->json($arrRes);
        }
    }
    // public function prev_destroy(DoctorEditRequest $request,$id)
    // {
    //     try{
    //         $doctor = User::find($id);
    //         $doctor->forceDelete();

    //         return successJsonResponse_h('Doctor deleted successfully');
    //     }catch(Exception $e){
    //         return redirect()->back()->withErrors($e->getMessage());
    //     }
    // }
}
