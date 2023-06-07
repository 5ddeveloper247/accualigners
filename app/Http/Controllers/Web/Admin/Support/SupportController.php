<?php

namespace App\Http\Controllers\Web\Admin\Support;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Admin\CaseReq\CaseAddAdviceRequest;
use App\Http\Requests\Web\Admin\CaseReq\CaseAlignerKitDeliveryRequest;
use App\Http\Requests\Web\Admin\CaseReq\CaseDeleteVideoRequest;
use App\Http\Requests\Web\Admin\CaseReq\CaseEditRequest;
use App\Http\Requests\Web\Admin\CaseReq\CaseEmbeddedVideoRequest;
use App\Http\Requests\Web\Admin\CaseReq\CaseImpressionKitReceivedRequest;
use App\Http\Requests\Web\Admin\CaseReq\CaseNoOfDaysUpdateRequest;
use App\Http\Requests\Web\Admin\CaseReq\CaseNoOfTraysUpdateRequest;
use App\Http\Requests\Web\Admin\CaseReq\CaseUploadVideoRequest;
use App\Http\Requests\Web\Admin\CaseReq\CaseStoreRequest;
use App\Http\Requests\Web\Admin\CaseReq\CaseUpdateRequest;
use App\Http\Requests\Web\General\CaseReq\CaseUploadAttachmentRequest;
use App\Http\Resources\Api\Patient\CaseRes\CaseAttachmentResource;
use App\Http\Resources\Api\Patient\Order\OrderResource;
use App\Http\Resources\Api\Patient\User\PatientResource;
use App\Http\Resources\Api\Patient\User\UserResource;
use Illuminate\Support\Facades\Mail;
use App\Models\Appointment;
use App\Models\CaseAttachment;
use App\Models\CaseClinicalCondition;
use App\Models\CaseConcern;
use App\Models\CaseModel;
use App\Models\CaseTimeLog;
use App\Models\ClinicalCondition;
use App\Models\ClinicDoctor;
use App\Models\Order;
use App\Models\PasswordReset;
use App\Models\Patient;
use App\Models\Setting;
use App\Models\User;
use App\Notifications\Auth\NewPatientFromWeb;
use App\Notifications\CaseNotification\VideoUploadedNotification;
use App\Notifications\CaseNotification\TrayModificationNotification;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Traits\EmailTrait;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class SupportController extends Controller
{
    use EmailTrait;

    public function index_new(Request $request)
    {

        try {

            $case = CaseModel::has('doctor')->with(['doctor'=>function($q2){
                $q2->select(['id','name','picture']);
            }])->get();
            return view('originator.container.helpSupport.support', compact('case'));
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function search_result(Request $request)
    {
        try {

            $case = CaseModel::where('id',$request->case_id)->with(['doctor'=>function($q2){
                $q2->select(['id','name','picture']);
            }])->get();
            return view('originator.container.helpSupport.support', compact('case'));
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function specific_case_concerns(Request $request)
    {
        try {
            $concerns = CaseConcern::where('case_id', $request->case_id)->get();
            return response()->json($concerns);
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function add_message(Request $request)
    {
        $newMessage = [
            'case_id' =>  $request->case_id,
            'message' =>  $request->message,
            'message_by' =>  $request->message_by
        ];
    try {
           if(CaseConcern::create($newMessage))
           {
                $data['done'] = true;
                $data['msg'] = 'Message Sent successfully';
            }else{
                $data['done'] = false;
                $data['msg'] = 'Error in sending Message';
            }
            $concerns = CaseConcern::where('case_id', $request->case_id)->get();
            $record = [$concerns,$data];
            return response()->json($record);
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    function sendNotificationMail(Request $request){

        $case = CaseModel::where('id',$request->case_id)->with('doctor')->first();
        $lastMessage = CaseConcern::where('case_id',$request->case_id)->latest()->first();

        /*________send email code________*/
        if(!empty($case->doctor)){

            $username = $case->doctor->name;
            $to = $case->doctor->email;
            $subject = "Admin Responded";
            $data['case_id'] = $case->id;
            $data['doctor_name'] = $username;
            $data['patient_name'] =$case->name;
            $data['response'] =$lastMessage->message;

            $data['subject'] =$subject;
            $data['email'] =$to;
            $this->sendMail($data, 'emails.notificationEmail');

            $data['done'] = true;
            $data['msg'] = 'Email Sent successfully';
            return $data;
            } else{
            $data['done'] = false;
            $data['msg'] = 'Error in sending Email';

            return $data;
        }
    }

}
