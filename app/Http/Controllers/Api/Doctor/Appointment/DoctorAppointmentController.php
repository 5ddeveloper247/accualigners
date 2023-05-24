<?php

namespace App\Http\Controllers\Api\Doctor\Appointment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Doctor\Appointment\AddTreatmentPlanRequest;
use App\Http\Requests\Api\Doctor\Appointment\GetAppointmentDetailRequest;
use App\Http\Requests\Api\Doctor\Appointment\StartAppointmentRequest;
use App\Services\Api\Doctor\Appointment\AppointmentServices;
use Illuminate\Http\Request;

class DoctorAppointmentController extends Controller
{

    public function getAppointments(Request $request){

        $getAppointment = AppointmentServices::getAppointment($request);
        if($getAppointment['success']){
            return successJsonResponse_h($getAppointment['message'],$getAppointment['data']);
        }
        
        return errorJsonResponse_h($getAppointment['message'] ? $getAppointment['message'] : 'Something went wrong');

    }

    public function getAppointmentDetail(GetAppointmentDetailRequest $request){

        $getAppointmentDetail = AppointmentServices::getAppointmentDetail($request);
        if($getAppointmentDetail['success']){
            return successJsonResponse_h($getAppointmentDetail['message'],$getAppointmentDetail['data']);
        }
        
        return errorJsonResponse_h($getAppointmentDetail['message'] ? $getAppointmentDetail['message'] : 'Something went wrong');

    }
    public function cancelAppointment(StartAppointmentRequest $request){
        
        $cancelAppointment = AppointmentServices::cancelAppointment($request);
        if($cancelAppointment['success']){
            return successJsonResponse_h($cancelAppointment['message'],$cancelAppointment['data']);
        }
        
        return errorJsonResponse_h($cancelAppointment['message'] ? $cancelAppointment['message'] : 'Something went wrong');
    }
    
    public function startAppointment(StartAppointmentRequest $request){
        
        $startAppointment = AppointmentServices::startAppointment($request);
        if($startAppointment['success']){
            return successJsonResponse_h($startAppointment['message'],$startAppointment['data']);
        }
        
        return errorJsonResponse_h($startAppointment['message'] ? $startAppointment['message'] : 'Something went wrong');
    }
    
    public function addTreatmentPlan(AddTreatmentPlanRequest $request){
        $addTreatmentPlan = AppointmentServices::addTreatmentPlan($request);
        if($addTreatmentPlan['success']){
            return successJsonResponse_h($addTreatmentPlan['message'],$addTreatmentPlan['data']);
        }
        
        return errorJsonResponse_h($addTreatmentPlan['message'] ? $addTreatmentPlan['message'] : 'Something went wrong');
    }
}
