<?php

namespace App\Http\Controllers\Web\Admin\Patient;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Admin\Patient\PatientEditRequest;
use App\Http\Requests\Web\Admin\Patient\PatientStoreRequest;
use App\Http\Requests\Web\Admin\Patient\PatientUpdateRequest;
use App\Models\Clinic;
use App\Models\ClinicDoctor;
use App\Models\Patient;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PatientController extends Controller
{
    public function index(Request $request)
    {
        try{

            $patients = User::where('user_type', 'patient');
            if($request->has('filter') && !empty($request->filter)){
                $filter = $request->filter;
                $patients = $patients->where(function ($query) use($filter){
                    $query->where('name', 'like', "%".$filter."%")
                        ->orWhere('id', $filter)
                        ->orWhere('email','like','%'.$filter.'%');
                });
            }

            $patients = $patients->paginate(15);

            return view('originator.container.patient.patient-view', compact('patients'));

        }catch(Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function create()
    {
        try{
            $clinics = Clinic::all();
            return view('originator.container.patient.patient-form', compact('clinics'));
        }catch(Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function store(PatientStoreRequest $request)
    {
        try{
            $inputs = $request->only(['name', 'email', 'password']);
            if ($request->hasFile('picture')) {
                $media = $request->file('picture');
                $ImageName = 'User-' . Carbon::now()->timestamp . '.' . $media->extension();
                Storage::Disk(env('FILE_SYSTEM'))->putFileAs('users', $media, $ImageName);
                $inputs['picture'] = 'users/'.$ImageName;
            }

            DB::beginTransaction();
            $user = User::create($inputs);
            Patient::create(['user_id'=>$user->id, 'clinic_doctor_id'=>$request->clinic_doctor_id]);
            DB::commit();
            return redirect()->back()->with(['successMessage' => 'Patient created successfully']);

        }catch(Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function show($id)
    {
        
    }

    public function edit(PatientEditRequest $request, $id)
    {
        try{
            $edit_values = User::find($id);
            $patient = Patient::where('user_id',$id)->first();
            $clinics = Clinic::all();
            $clinic_doctors = ClinicDoctor::where('clinic_id', $patient->clinic_doctor->clinic_id)->with('doctor')->get();
            // dd($clinic_doctors->toArray());
            return view('originator.container.patient.patient-form', compact('edit_values', 'patient', 'clinics', 'clinic_doctors'));
        }catch(Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function update(PatientUpdateRequest $request, $id)
    {
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
            $user->update($inputs);
            Patient::where('user_id',$id)->update(['clinic_doctor_id'=>$request->clinic_doctor_id]);

            return redirect()->back()->with(['successMessage' => 'Patient updated successfully']);

        }catch(Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
    
    public function destroy(PatientEditRequest $request,$id)
    {
        try{
            $patient = User::find($id);
            $patient->forceDelete();

            return successJsonResponse_h('Patient deleted successfully');
        }catch(Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function clinicDoctors(Request $request){
        try{
            // return successJsonResponse_h('', ClinicDoctor::where('clinic_id', $request->clinic_id)->with('doctor')->get());
            
    return successJsonResponse_h('', ClinicDoctor::where('clinic_id', $request->clinic_id)->with(['doctor' => function ($query) {$query->withTrashed();}])->get());
            
        }catch(Exception $e){
            return errorJsonResponse_h($e->getMessage());
        }
    }
}
