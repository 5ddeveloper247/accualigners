<?php
namespace App\Services\Api\Doctor\Appointment;

use App\Models\Appointment;
use Exception;

class AppointmentServices{

    public static function addTreatmentPlan($request){
        try{

            Appointment::where('id', $request->appointment_id)->update([
                'treatment_plan' => $request->treatment_plan
            ]);
            
            return successArrayResponse_h('Treatment plan added successfully');

        }catch(Exception $e){
            return errorArrayResponse_h($e->getMessage());
        }
    }

    public static function cancelAppointment($request){
        try{

            Appointment::where('id', $request->appointment_id)->update([
                'status' => 0
            ]);
            
            return successArrayResponse_h('Appintment has canceled');

        }catch(Exception $e){
            return errorArrayResponse_h($e->getMessage());
        }
    }

    public static function startAppointment($request){
        try{

            $appointments = Appointment::where('id', $request->appointment_id)->first();

            $updateColumns = [
                'doctor_joined_call' => now()
            ];

            if(!empty($appointments->patient_joined_call)){
                $updateColumns['status'] = 1;
            }
            
            $appointments->update($updateColumns);
            
            return successArrayResponse_h('Appointment has started');

        }catch(Exception $e){
            return errorArrayResponse_h($e->getMessage());
        }
    }

    public static function getAppointment($request){
        try{

            $user_id = $request->user()->id;

            $appointments = collect(Appointment::select('*')->where('doctor_id', $user_id)->withAvailability()->statusTitleForDoctor()->orderBy('created_at', 'desc')->get())->groupBy('appointmant_status');
            
            return successArrayResponse_h('', $appointments);

        }catch(Exception $e){
            return errorArrayResponse_h($e->getMessage());
        }
    }

    public static function getAppointmentDetail($request){
        try{

            $appointments = Appointment::select('*')->where('id', $request->appointment_id)
            ->withAvailability()
            ->statusTitleForPatient()
            ->with('doctor', function($query){
                $query->select('id','name','picture');
            })
            ->first();
            
            return successArrayResponse_h('', $appointments);

        }catch(Exception $e){
            return errorArrayResponse_h($e->getMessage());
        }
    }

}