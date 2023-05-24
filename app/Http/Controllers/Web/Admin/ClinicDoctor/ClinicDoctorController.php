<?php

namespace App\Http\Controllers\Web\Admin\ClinicDoctor;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\Admin\Clinic\ClinicController;
use App\Http\Requests\Web\Admin\ClinicDoctor\ClinicDoctorEditRequest;
use App\Http\Requests\Web\Admin\ClinicDoctor\ClinicDoctorStoreRequest;
use App\Http\Requests\Web\Admin\ClinicDoctor\ClinicDoctorUpdateRequest;
use App\Models\ClinicDoctor;
use App\Models\Doctor;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClinicDoctorController extends Controller
{
    public function index(Request $request)
    {
        try{

            $clinic_doctors = ClinicDoctor::select('clinic_doctors.*', 'users.name')
            ->join('users', 'users.id', 'clinic_doctors.doctor_id')
            ->where('clinic_doctors.clinic_id', $request->route('clinic'));

            if($request->has('filter') && !empty($request->filter)){
                $filter = $request->filter;
                $clinic_doctors = $clinic_doctors->where(function ($query) use($filter){
                    $query->where('users.name', 'like', "%".$filter."%")
                        ->orWhere('users.email', 'like', "%".$filter."%");
                });
            }

            $clinic_doctors = $clinic_doctors->groupBy('clinic_doctors.id')->paginate(15);

            return view('originator.container.clinic.doctor.clinic-doctor-view', compact('clinic_doctors'));

        }catch(Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function create()
    {
        try{
            $doctors = User::where('user_type', 'doctor')->get();
            return view('originator.container.clinic.doctor.clinic-doctor-form', compact('doctors'));
        }catch(Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function store(ClinicDoctorStoreRequest $request)
    {
        try{
            $inputs = $request->only(['doctor_id', 'appointment_duration']);
            $inputs['monday_time'] = (empty($request->monday_time_from) && empty($request->monday_time_to)) ? null : ($request->monday_time_from . ' - ' . $request->monday_time_to);
            $inputs['tuesday_time'] = (empty($request->tuesday_time_from) && empty($request->tuesday_time_to)) ? null : ($request->tuesday_time_from . ' - ' . $request->tuesday_time_to);
            $inputs['wednesday_time'] = (empty($request->wednesday_time_from) && empty($request->wednesday_time_to)) ? null : ($request->wednesday_time_from . ' - ' . $request->wednesday_time_to);
            $inputs['thursday_time'] = (empty($request->thursday_time_from) && empty($request->thursday_time_to)) ? null : ($request->thursday_time_from . ' - ' . $request->thursday_time_to);
            $inputs['friday_time'] = (empty($request->friday_time_from) && empty($request->friday_time_to)) ? null : ($request->friday_time_from . ' - ' . $request->friday_time_to);
            $inputs['saturday_time'] = (empty($request->_saturday_timefrom) && empty($request->saturday_time_to)) ? null : ($request->saturday_time_from . ' - ' . $request->saturday_time_to);
            $inputs['sunday_time'] = (empty($request->sunday_time_from) && empty($request->sunday_time_to)) ? null : ($request->sunday_time_from . ' - ' . $request->sunday_time_to);
            $inputs['clinic_id'] = $request->route('clinic');

            ClinicDoctor::create($inputs);
            return redirect()->back()->with(['successMessage' => 'Created successfully']);

        }catch(Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    //new_store
    public function new_store(ClinicDoctorStoreRequest $request , $id)
    {
        try{
            $inputs = $request->only(['doctor_id']);
            $inputs['monday_time'] = (empty($request->monday_time_from) && empty($request->monday_time_to)) ? null : ($request->monday_time_from . ' - ' . $request->monday_time_to);
            $inputs['tuesday_time'] = (empty($request->tuesday_time_from) && empty($request->tuesday_time_to)) ? null : ($request->tuesday_time_from . ' - ' . $request->tuesday_time_to);
            $inputs['wednesday_time'] = (empty($request->wednesday_time_from) && empty($request->wednesday_time_to)) ? null : ($request->wednesday_time_from . ' - ' . $request->wednesday_time_to);
            $inputs['thursday_time'] = (empty($request->thursday_time_from) && empty($request->thursday_time_to)) ? null : ($request->thursday_time_from . ' - ' . $request->thursday_time_to);
            $inputs['friday_time'] = (empty($request->friday_time_from) && empty($request->friday_time_to)) ? null : ($request->friday_time_from . ' - ' . $request->friday_time_to);
            $inputs['saturday_time'] = (empty($request->_saturday_timefrom) && empty($request->saturday_time_to)) ? null : ($request->saturday_time_from . ' - ' . $request->saturday_time_to);
            $inputs['sunday_time'] = (empty($request->sunday_time_from) && empty($request->sunday_time_to)) ? null : ($request->sunday_time_from . ' - ' . $request->sunday_time_to);
            $inputs['clinic_id'] = $id;
            
            if(ClinicDoctor::create($inputs))         
            {
                $arrRes['msg']  = "Doctor added to clinic saved successfully";
                $arrRes['done'] = true;
            }else{
                $arrRes['done'] = false;
                $arrRes['msg'] = 'Error in adding doctor Data';
            }
            return response()->json($arrRes);

        }catch(Exception $e){
            $arrRes['done'] = false;
            $arrRes['msg'] = 'SomeThing went wrong'.$e;
            return response()->json($arrRes);
        }
    }

    public function show($id)
    {
        
    }

    public function edit(ClinicDoctorEditRequest $request)
    {
        try{
            $edit_values = ClinicDoctor::where('id', $request->route('doctor'))->first();
            $doctors = User::where('user_type', 'doctor')->get();
            return view('originator.container.clinic.doctor.clinic-doctor-form', compact('edit_values', 'doctors'));
        }catch(Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

        public function showClinicDoctors(Request $request)
    {
        try{
            $clinicDoctor = ClinicDoctor::where('id', $request->ClinicDocid)->first();
            $clinicDoctor['clinic'] = ClinicController::new_edit($request->Clinicid);  
            return response()->json($clinicDoctor);
        }catch(Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }


    public function update(ClinicDoctorUpdateRequest $request, $id)
    {
        try{
            $inputs = $request->only(['doctor_id', 'appointment_duration']);
            $inputs['monday_time'] = (empty($request->monday_time_from) && empty($request->monday_time_to)) ? null : ($request->monday_time_from . ' - ' . $request->monday_time_to);
            $inputs['tuesday_time'] = (empty($request->tuesday_time_from) && empty($request->tuesday_time_to)) ? null : ($request->tuesday_time_from . ' - ' . $request->tuesday_time_to);
            $inputs['wednesday_time'] = (empty($request->wednesday_time_from) && empty($request->wednesday_time_to)) ? null : ($request->wednesday_time_from . ' - ' . $request->wednesday_time_to);
            $inputs['thursday_time'] = (empty($request->thursday_time_from) && empty($request->thursday_time_to)) ? null : ($request->thursday_time_from . ' - ' . $request->thursday_time_to);
            $inputs['friday_time'] = (empty($request->friday_time_from) && empty($request->friday_time_to)) ? null : ($request->friday_time_from . ' - ' . $request->friday_time_to);
            $inputs['saturday_time'] = (empty($request->_saturday_timefrom) && empty($request->saturday_time_to)) ? null : ($request->saturday_time_from . ' - ' . $request->saturday_time_to);
            $inputs['sunday_time'] = (empty($request->sunday_time_from) && empty($request->sunday_time_to)) ? null : ($request->sunday_time_from . ' - ' . $request->sunday_time_to);

            $user = ClinicDoctor::find($request->route('doctor'));
            $user->update($inputs);

            return redirect()->back()->with(['successMessage' => 'Updated successfully']);

        }catch(Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

        //new update
        public function update_new(Request $request)
    {
        
        try{
            $inputs = $request->only(['doctor_id']);
            $inputs['monday_time'] = (empty($request->monday_time_from) && empty($request->monday_time_to)) ? null : ($request->monday_time_from . ' - ' . $request->monday_time_to);
            $inputs['tuesday_time'] = (empty($request->tuesday_time_from) && empty($request->tuesday_time_to)) ? null : ($request->tuesday_time_from . ' - ' . $request->tuesday_time_to);
            $inputs['wednesday_time'] = (empty($request->wednesday_time_from) && empty($request->wednesday_time_to)) ? null : ($request->wednesday_time_from . ' - ' . $request->wednesday_time_to);
            $inputs['thursday_time'] = (empty($request->thursday_time_from) && empty($request->thursday_time_to)) ? null : ($request->thursday_time_from . ' - ' . $request->thursday_time_to);
            $inputs['friday_time'] = (empty($request->friday_time_from) && empty($request->friday_time_to)) ? null : ($request->friday_time_from . ' - ' . $request->friday_time_to);
            $inputs['saturday_time'] = (empty($request->_saturday_timefrom) && empty($request->saturday_time_to)) ? null : ($request->saturday_time_from . ' - ' . $request->saturday_time_to);
            $inputs['sunday_time'] = (empty($request->sunday_time_from) && empty($request->sunday_time_to)) ? null : ($request->sunday_time_from . ' - ' . $request->sunday_time_to);

            $user = ClinicDoctor::find($request->doctorId);

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
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function destroy(ClinicDoctorEditRequest $request,$id)
    {
        try{
            $clinic_doctor = ClinicDoctor::find($request->route('doctor'));
            $clinic_doctor->forceDelete();

            return successJsonResponse_h('Deleted successfully');
        }catch(Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
    //new destroy
    public function new_destroy(Request $request,$id)
    {
        try{
            $clinic_doctor = ClinicDoctor::find($id);
            if($clinic_doctor->forceDelete())         
            {
                $arrRes['msg']  = "Data Deleted successfully";
                $arrRes['done'] = true;
            }else{
                $arrRes['done'] = false;
                $arrRes['msg'] = 'Error in Deleting Data';
            }

            return response()->json($arrRes);
        }catch(Exception $e){
            $arrRes['done'] = false;
            $arrRes['msg'] = 'some error';
            return response()->json($arrRes);
        }
    }
}
