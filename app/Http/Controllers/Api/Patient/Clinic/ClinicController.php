<?php

namespace App\Http\Controllers\Api\Patient\Clinic;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Patient\Clinic\AddPatientRequest;
use App\Http\Requests\Api\Patient\Clinic\GetClinicDoctorRequest;
use App\Models\Clinic;
use App\Models\ClinicDoctor;
use App\Models\Patient;
use Illuminate\Http\Request;

class ClinicController extends Controller
{
    public function getClinics(){
        return successJsonResponse_h('', Clinic::all());
    }
    
    public function getClinicDoctors(GetClinicDoctorRequest $request){
        return successJsonResponse_h('', ClinicDoctor::where('clinic_id', $request->clinic_id)->with('doctor')->get());
    }
    
    public function addPatient(AddPatientRequest $request){
        $patient = Patient::where('user_id', $request->user()->id)->first();
        $patient->update([
            'clinic_doctor_id' => $request->clinic_doctor_id
        ]); 
        return successJsonResponse_h('', $patient);

    }


}
