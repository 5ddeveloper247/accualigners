<?php

namespace App\Http\Controllers\Api\Patient\Appointment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Patient\Appointment\AddAppointmentRequest;
use App\Http\Requests\Api\Patient\Appointment\GetAppointmentDetailRequest;
use App\Http\Requests\Api\Patient\Appointment\StartAppointmentRequest;
use App\Services\Api\Patient\Appointment\AppointmentServices;
use Illuminate\Http\Request;

class PatientAppointmentController extends Controller
{
    
    public function addAppointment(AddAppointmentRequest $request){
        
        $addAppointment = AppointmentServices::addAppointment($request);
        if($addAppointment['success']){
            return successJsonResponse_h($addAppointment['message'],$addAppointment['data']);
        }
        
        return errorJsonResponse_h($addAppointment['message'] ? $addAppointment['message'] : 'Something went wrong');
    }

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

    public function getAppointmentBookedDate(Request $request){

        $getAppointmentBookedDate = AppointmentServices::getAppointmentBookedDate($request);
        if($getAppointmentBookedDate['success']){
            return successJsonResponse_h($getAppointmentBookedDate['message'],$getAppointmentBookedDate['data']);
        }
        
        return errorJsonResponse_h($getAppointmentBookedDate['message'] ? $getAppointmentBookedDate['message'] : 'Something went wrong');

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
}
