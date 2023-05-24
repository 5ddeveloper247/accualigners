<?php

namespace App\Http\Controllers\Web\Admin\Appointment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Admin\Appointment\AppointmentEditRequest;
use App\Models\Appointment;
use Exception;
use DB;
use App\Models\Clinic;
use App\Models\ClinicDoctor;
use App\Models\User;
use App\Models\Patient;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    
    public function index_old(Request $request)
    {
        try{
            $availability = $request->has('availability') && $request->availability == 'false' ? false : true; 
               $appointments = Appointment::select('appointments.*', 'doctor_user.name AS doctor_name', 'patient_user.name AS patient_name', 'patient_user.phone AS patient_phone', 'patient_user.gender AS patient_gender')
                     ->join('users as doctor_user', 'doctor_user.id', 'appointments.doctor_id')
                            ->join('users as patient_user', 'patient_user.id', 'appointments.patient_id');

            // if($availability){
            //     $appointments = $appointments->whereRaw('(unix_timestamp() < appointments.appointment_time AND appointments.status = 2)');
            // }else{
            //     $appointments = $appointments->whereRaw('(unix_timestamp() > appointments.appointment_time)');
            // }

            // if($request->has('filter') && !empty($request->filter)){
            //     $filter = $request->filter;
            //     $appointments = $appointments->where(function ($query) use($filter){
            //         $query->where('doctor_user.name', 'like', "%".$filter."%")
            //             ->orWhere('doctor_user.phone', 'like', "%".$filter."%")
            //             ->orWhere('doctor_user.email', 'like', "%".$filter."%")
            //             ->orWhere('patient_user.name', 'like', "%".$filter."%")
            //             ->orWhere('patient_user.phone', 'like', "%".$filter."%")
            //             ->orWhere('patient_user.email', 'like', "%".$filter."%");
            //     });
            // }

            $appointments = $appointments->withAvailability()->statusTitleForPatient()->groupBy('appointments.id')->orderBy('appointments.appointment_time', 'desc')
            ->paginate(15);

            return view('originator.container.appointment.appointment-view', compact('appointments'));

        }catch(Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function index(Request $request)
    {    
                 // dd($request->all());
         try{
                 //  $appointments = $appointments->whereRaw('(unix_timestamp() < appointments.appointment_time AND appointments.status = 2)');
                 if($request->has('filter') && !empty($request->filter)){
                     $filter = $request->filter;
                    //  dd('hello');

                     $appointments = Appointment::select('appointments.*', 'doctor_user.name AS doctor_name', 'patient_user.name AS patient_name', 'patient_user.phone AS patient_phone', 'patient_user.gender AS patient_gender')
                        ->join('users as doctor_user', 'doctor_user.id', 'appointments.doctor_id')
                          ->join('users as patient_user', 'patient_user.id', 'appointments.patient_id');
                         $appointments = $appointments->where(function ($query) use($filter){
                           $query->where('doctor_user.name', 'like', "%".$filter."%")
                            ->orWhere('doctor_user.phone', 'like', "%".$filter."%")
                            ->orWhere('doctor_user.email', 'like', "%".$filter."%")
                            ->orWhere('patient_user.name', 'like', "%".$filter."%")
                            ->orWhere('patient_user.phone', 'like', "%".$filter."%")
                            ->orWhere('patient_user.email', 'like', "%".$filter."%");
                    });
             }else{
                //  $appointments = $appointments->whereRaw('(unix_timestamp() > appointments.appointment_time)');
                 $appointments = Appointment::select('appointments.*', 'doctor_user.name AS doctor_name', 'patient_user.name AS patient_name', 'patient_user.phone AS patient_phone', 'patient_user.gender AS patient_gender')
                 ->join('users as doctor_user', 'doctor_user.id', 'appointments.doctor_id')
                 ->join('users as patient_user', 'patient_user.id', 'appointments.patient_id')->orderBy('updated_at','desc');
              
             }
             $clinics = Clinic::all();
             $patient = Patient::with('user')->get();
             $clinic_doctors= ClinicDoctor::all();
             $doctors=User::where('role_id','=',2)->get();

             $appointments = $appointments->withAvailability()->statusTitleForPatient()->groupBy('appointments.id')->orderBy('appointments.appointment_time', 'desc')
             ->paginate(15);

            //  dd($appointments);
             return view('originator.container.appointment.appointment-view-new', compact('appointments','clinics','patient','clinic_doctors','doctors'));
         }catch(Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
      }
  }
    
    public function appointmentStore(Request $request){
        //  dd($request->all());
         try{
            DB::beginTransaction();
            $res = Appointment::create([
                'patient_id'=>$request->patient,
                'clinic_doctor_id'=>$request->clinic, 
                'doctor_id'=>$request->doctor,
                'appointment_time'=>$request->appointmentTime,
                'appointment_date'=>$request->appointmentDate,
                'difficulties'=>$request->difficulties,
                'treatment_plan'=>$request->treatment_plan,
                'status'=>'1'
            ]);
            DB::commit();
            return redirect()->back()->with('message', 'Patient created successfully');
        }catch(Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error', 'Something Went Wrong');
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
     public function appointment_get(Request $request){
        $appointments=Appointment::where('id','=',$request->id)->first();
        $clinic_doctors=ClinicDoctor::where('id','=',$appointments->clinic_doctor_id)->first();
        $clinic_id=$clinic_doctors->clinic_id;
        $doctor_id=$clinic_doctors->doctor_id;
        $doctor=User::where('id','=',$doctor_id)->first();
        return response()->json(['data' => $appointments,'clinic_id' => $clinic_id,'doctor'=>$doctor]);
        // return $appointments;
    }

    public function appointment_add(Request $request){
            
        try{       
            DB::beginTransaction();

             $clinic_doctor=ClinicDoctor::where('clinic_id',$request->clinic_doctor_id)->where('doctor_id',$request->doctor_id)->first();

             Appointment::create(['clinic_doctor_id'=>$clinic_doctor->id, 
                  'patient_id'=>$request->patient,
                  'doctor_id'=>$request->doctor_id,
                  'appointment_time'=>$request->appointment_time,
                  'appointment_date'=>$request->appointment_date,
                  'treatment_plan'=>$request->treatment_plan,
                  'difficulties'=>'Test',
                  'status'=>'1']);
              DB::commit();
              return response()->json(['successMessage' => 'Success']);
            }catch(Exception $e){
            DB::rollBack();
            return response()->json(['successMessage' => $e]);
        }
    }
    public function appointment_update(Request $request, $id){
        //  $appointment=Appointment::where('id',$id)->first();
         $appointment=Appointment::where('id',$id)->first();
         $clinic_doctor=ClinicDoctor::where('clinic_id',$request->clinic_doctor_id)->where('doctor_id',$request->doctor_id)->first();
            

         $appointment->clinic_doctor_id=$clinic_doctor->id;
         $appointment->patient_id=$request->patient;

        $appointment->doctor_id=$request->doctor_id;
        $appointment->appointment_time=$request->appointment_time;
        $appointment->appointment_date=$request->appointment_date;
        $appointment->treatment_plan=$request->treatment_plan;
        $appointment->difficulties='test';
        $appointment->status='1';
        $appointment->save();
        return response()->json(['successMessage' => 'Success']);

                try{       
                DB::beginTransaction();
                // $appointment::update($request->all());
                // $appointment::update(['clinic_doctor_id'=>$request->clinic, 
                // 'patient_id'=>$request->patient,
                // 'doctor_id'=>$request->clinic_doctor_id,
                // 'appointment_time'=>$request->appointmentTime,
                // 'appointment_date'=>$request->appointment_date,
                // 'treatment_plan'=>$request->treatment_plan,
                // 'patient_joined_call'=>'','doctor_joined_call'=>'','status'=>'','created_by'=>'']);
                  DB::commit();
                return response()->json(['successMessage' => 'Success']);
             }catch(Exception $e){
                DB::rollBack();
                return response()->json(['successMessage' => 'error']);
             }
    }
    
    public function store(Request $request)
    {
        // dd($request->all());
        try{       
            DB::beginTransaction();
            Appointment::create(['clinic_doctor_id'=>$request->doctor_id, 
            'patient_id'=>$request->patient,
            'doctor_id'=>$request->clinic_doctor_id,
            'appointment_time'=>$request->appointment_time,
            'difficulties'=>$request->difficulties,
            'treatment_plan'=>$request->treatment_plan,
            'patient_joined_call'=>'',
            'doctor_joined_call'=>'',
            'status'=>'',
            'created_by'=>'']);
              DB::commit();
            return redirect()->back()->with(['successMessage' => 'Patient created successfully']);
         }catch(Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors($e->getMessage());
         }
     }

     public function appointment_delete($id){
        // dd($id);
        $recordIds = explode(",",$id);
        try{
            foreach($recordIds as $id)
            {
        
                    $user = Appointment::find($id);
                    if($user->forceDelete())         
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
    
    public function create()
    {
        try{
            $data['clinics'] = Clinic::all();
            $data['patients'] = Patient::with('user')->get();
            
            // dd($patients);
            // originator/container/appointment/appointment-form-create.blade
            return view('originator.container.appointment.appointment-form-create',$data);
        }catch(Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function edit(AppointmentEditRequest $request, $id)
    {   
        try{
            $appointment = Appointment::find($id);
            $data['edit_values'] = $appointment;
            return view('originator.container.appointment.appointment-form', $data);
        }catch(Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function destroy(AppointmentEditRequest $request,$id)
    {
        try{
            $appointment = Appointment::find($id);
            $appointment->forceDelete();

            return successJsonResponse_h('Appointment deleted successfully');
        }catch(Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
}
