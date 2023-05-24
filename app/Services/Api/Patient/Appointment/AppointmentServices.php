<?php
namespace App\Services\Api\Patient\Appointment;

use App\Models\Appointment;
use Exception;

class AppointmentServices{

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
                'patient_joined_call' => now()
            ];

            if(!empty($appointments->doctor_joined_call)){
                $updateColumns['status'] = 1;
            }
            
            $appointments->update($updateColumns);
            
            return successArrayResponse_h('Appointment has started');

        }catch(Exception $e){
            return errorArrayResponse_h($e->getMessage());
        }
    }

    public static function addAppointment($request){
        try{

            $patient = $request->user()->load('patient.clinic_doctor')->patient;

            $appointment = Appointment::create([
                'clinic_doctor_id' => $patient->clinic_doctor_id,
                'patient_id' => $patient->user_id,
                'doctor_id' => $patient->clinic_doctor->doctor_id,
                'appointment_time' => strtotime($request->appointment_date . ' ' . $request->appointment_time),
                'difficulties' => $request->appointment_difficulty,
                'created_by' => $patient->user_id,
            ]);
            
            return successArrayResponse_h('Appointment created successfully');

        }catch(Exception $e){
            return errorArrayResponse_h($e->getMessage());
        }
    }

    public static function getAppointment($request){
        try{

            $user_id = $request->user()->id;

            $appointments = collect(Appointment::select('*')->where('patient_id', $user_id)->with('doctor')->withAvailability()->statusTitleForPatient()->orderBy('created_at', 'desc')->get())->groupBy('appointmant_status');
            
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

    public static function getAppointmentBookedDate($request){
        try{

            $patient = $request->user()->load('patient.clinic_doctor')->patient;

            $appointments = collect(Appointment::where('doctor_id', $patient->clinic_doctor->doctor_id)->whereRaw('`appointment_time` > unix_timestamp()')->orderBy('appointment_time', 'asc')->get())->pluck('appointment_datetime')->toArray();
            
            return successArrayResponse_h('', ['appointments' => $appointments]);

        }catch(Exception $e){
            return errorArrayResponse_h($e->getMessage());
        }
    }

}