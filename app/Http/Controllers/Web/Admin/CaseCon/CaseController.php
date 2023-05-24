<?php

namespace App\Http\Controllers\Web\Admin\CaseCon;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use DateTimeZone;
use App\Http\Requests\Web\Admin\CaseReq\CaseAddAdviceRequest;
use App\Http\Requests\Web\Admin\CaseReq\CaseAlignerKitDeliveryRequest;
use App\Http\Requests\Web\Admin\CaseReq\CaseDeleteVideoRequest;
use App\Http\Requests\Web\Admin\CaseReq\CaseEditRequest;
use App\Http\Requests\Web\Admin\CaseReq\CaseEmbeddedVideoRequest;
use App\Http\Requests\Web\Admin\CaseReq\CaseImpressionKitReceivedRequest;
use App\Http\Requests\Web\Admin\CaseReq\CaseNoOfDaysUpdateRequest;
use App\Http\Requests\Web\Admin\CaseReq\CaseNoOfTraysUpdateRequest;
use App\Http\Requests\Web\Admin\CaseReq\CaseStoreRequest;
use App\Http\Requests\Web\Admin\CaseReq\CaseUpdateRequest;
use App\Http\Requests\Web\Admin\CaseReq\CaseUploadVideoRequest;
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
use App\Models\ClinicalCondition;
use App\Models\ClinicDoctor;
use App\Models\Order;
use App\Models\PasswordReset;
use App\Models\Patient;
use App\Models\Setting;
use App\Models\User;
use App\Notifications\Auth\NewPatientFromWeb;
use App\Notifications\CaseNotification\VideoUploadedNotification;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Traits\EmailTrait;
use File;
use ZipArchive;
use Carbon\Carbon;

class CaseController extends Controller
{
    use EmailTrait;

    protected $path;
    protected $attachment_path;
    public function __construct()
    {
        $this->path = config('custom.attachment_path.case_video');
        $this->attachment_path = config('custom.attachment_path.case');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_new(Request $request)
    {  
        try {
             $cases = CaseModel::select('*')->orderBy('updated_at', 'desc');
         if ($request->has('filter') && !empty($request->filter)) {
             $filter = $request->filter;
                $cases = $cases->where(function ($query) use ($filter) {
                   $query->where('id', $filter)
                        ->orWhere('name', 'like', "%" . $filter . "%")
                        ->orWhere('phone_no', 'like', "%" . $filter)
                        ->orWhere('gender', $filter)
                        ->orWhere('email', 'like', "%" . $filter . "%");
                });
             }
             $cases = $cases->orderBy('id', 'desc')->paginate(15);
             return view('originator.container.case.case-view', compact('cases'));
         } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
         }
     }
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
     {   
        
         
        try {
            $doctors = ClinicDoctor::has('doctor')->with('doctor')->get();
            $cases = CaseModel::select('*')->orderBy('updated_at', 'desc');
            $ClinicalConditions = ClinicalCondition::all();
            $ClinicDoctors = ClinicDoctor::all();
            if ($request->has('filter') && !empty($request->filter)) {
                $filter = $request->filter;
                $cases = $cases->where(function ($query) use ($filter) {
                    $query->where('id', $filter)
                        ->orWhere('name', 'like', "%" . $filter . "%")
                        ->orWhere('phone_no', 'like', "%" . $filter)
                        ->orWhere('gender', $filter)
                        ->orWhere('email', 'like', "%" . $filter . "%");
                });
            }
            $cases = $cases->orderBy('id', 'desc')->get();
            return view('originator.container.case.case-view-new', compact('cases','ClinicalConditions', 'ClinicDoctors' , 'doctors'));

        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            $ClinicalConditions = ClinicalCondition::all();
            $ClinicDoctors = ClinicDoctor::all();
            return view('originator.container.case.case-form', compact('ClinicalConditions', 'ClinicDoctors'));
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(CaseStoreRequest $request)
    {
            
        try {

             DB::beginTransaction();
             $user_id = $request->user()->id;
             $doctor_id = auth()->user()->id;
             $password = Str::random(6);
            $request->request->add(['created_by' => $user_id]);
            $request->request->add(['password' => $password]);

            $user = User::where('email', $request->email)->first();
            $patientData = [
                'name' =>  $request->name,
                'phone' =>  $request->phone_no,
                'gender' =>  $request->gender,
                'dob' =>  $request->dob,
            ];
            if (!empty($user) && isset($user->id)) {
                User::where('id', $user->id)->update($patientData);
            } else {
                if($request->email){
                     
                     $patientData['email'] = $request->email;
                     $user = User::create($patientData);    
                     $token = substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyzABCDEFGHIJKLMNOPQRSTVWXYZ"), 0, 60);
                     $otp = rand(10000, 99999);
    
                     $PasswordReset = new PasswordReset();
                     $PasswordReset->email = $request->email;
                     $PasswordReset->token = $token;
                     $PasswordReset->otp = $otp;
                    if ($PasswordReset->save()) {
                        // $user->notify(new NewPatientFromWeb($PasswordReset));
                    } 
                      $data_patient_insert= [    'user_id' => $user->id, 
                                 'doctor_id' => $doctor_id
                                ];
                     $request->request->add(['patient_id' => $user->id]);
                     Patient::firstOrCreate(
                     ['user_id' => $user->id, 'doctor_id' => $doctor_id],
                     [    'user_id' => $user->id, 'doctor_id' => $doctor_id]
                     );
              }
            }
            
            $Setting = Setting::first();
            $request->request->add(['doctor_id' => $doctor_id]);
            $request->request->add(['arch_to_treat' => $request->has('arch_to_treat') ? 'UPPER' : 'LOWER']);
            $request->request->add(['a_p_relationship' => $request->has('a_p_relationship') ? 'MAINTAIN' : 'IMPROVE']);
            $request->request->add(['overjet' => $request->has('overjet') ? 'MAINTAIN' : 'IMPROVE']);
            $request->request->add(['overbite' => $request->has('overbite') ? 'MAINTAIN' : 'IMPROVE']);
            $request->request->add(['midline' => $request->has('midline') ? 'MAINTAIN' : 'IMPROVE']);

            $request->request->add(['processing_fee_amount' => $Setting->case_fee]);
            $request->request->add(['dob' => date("Y-m-d", strtotime($request->dob))]);
            $arrRes['msg']  = "Data saved successfully";
            $arrRes['done'] = true;
            $Case = CaseModel::create($request->only('patient_id', 'doctor_id', 'name', 'email', 'phone_no', 'gender', 'dob', 'clinical_comment', 'arch_to_treat', 'a_p_relationship', 'overjet', 'overbite', 'midline', 'prescription_comment', 'comment', 'processing_fee_amount','address','impression_kit_order_id', 'created_by', 'embedded_url'));
            
            if ($Case) {
                 $user = User::find($doctor_id);
                 $case_id = $Case->id;
                 $username = $request->name;


                 $to = "info@accualigners.com";
                $subject = "New Case (ID: ". $case_id .") Received";
                $data['case_id'] = $case_id;
                $data['doctor_name'] = auth()->user()->name;
                $data['patient_name'] = $username;
                $html = view('emails.caseRegistered', $data)->render();
                $check = $this->sendMailViaPostMark($html, $to, $subject);

                if (!empty($request->impression_kit_order_id))
                    Order::where('id', $request->impression_kit_order_id)->update(['used_in_case' => 1]);

                if (!empty($request->clinical_conditions)) {
                    $CaseClinicalCondition = [];
                    foreach ($request->clinical_conditions as $clinical_condition) {
                        $CaseClinicalCondition[] = [
                            'case_id' => $case_id,
                            'clinical_condition_id' => $clinical_condition,
                            'created_by' => $user_id

                        ];
                    }

                    CaseClinicalCondition::insert($CaseClinicalCondition);
                }
                $attachments = explode(',', $request->attachment_ids);
                if (!empty($attachments)) {
                    CaseAttachment::whereIn('id', $attachments)->update([
                        'case_id' => $case_id
                    ]);
                }
               
                  //Image attachment update
                  if (!empty($request->image_attachment_ids)) 
                  {
                      foreach ($request->image_attachment_ids as $id) {
                      if($id != 0){
                                  CaseAttachment::where('id', $id)->update(['case_id' => $case_id]);
                                  
                                  }
                              }
                  }


                DB::commit();
               
                   
                   return response()->json($arrRes);

               
                //  return redirect(route('doctor.case.payment.index', ['case' => $case_id]))->with(['successMessage' => 'Created successfully']);
            }
            DB::rollBack();
            $arrRes['done'] = false;
            $arrRes['msg'] = 'Error in saving Data';
            $arrRes['case'] = '';
            return response()->json($arrRes);
            // return redirect()->back()->withErrors('Something went wrong');
        } catch (Exception $e) {
            DB::rollBack();
            $arrRes['done'] = false;
            $arrRes['msg'] = 'Error in saving Data';
            $arrRes['case'] = '';
            return response()->json($arrRes);
            //  return redirect()->back()->withErrors($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function case_view($id, Request $request)
    {
        try {
            $case = CaseModel::find($id);
            $data['edit_values'] = $case;
            $ip = $request->ip(); // Get user's IP address from request object
            
            // Call the ipgeolocation API to get user's timezone based on their IP address
            $api_key = "4eb0722e7f464951aef4c772283952fb"; // replace with your actual API key
            $api_url = "https://api.ipgeolocation.io/timezone?apiKey={$api_key}&ip={$ip}";
            $api_response = json_decode(file_get_contents($api_url), true);
            $user_timezone = new DateTimeZone($api_response['timezone']);
            
            $data['user_timezone'] = $user_timezone->getName(); // Set user's timezone
            $data['appointments'] = Appointment::where('patient_id', $case->patient_id)->orderBy('id', 'desc')->limit(3)->get();
            // dd($data['appointments']->toArray());
            return view('originator.container.case.case-view-form', $data);
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
    

    // public function show($id){
    //     try {
    //         $case = CaseModel::find($id);
    //         $data['edit_values'] = $case;
            
    //         if (!empty(Auth::user()->timezone)) {
    //             $user_timezone = new DateTimeZone(Auth::user()->timezone);
    //         } else {
    //             $user_timezone = new DateTimeZone('UTC');
    //         }
    //         $user = Auth::user(); // use Auth::user() to get the currently authenticated user
    //         $data['user_timezone'] = $user->timezone; // assuming you have a "timezone" field in your users table

    //         $order= Order::where('case_id','=',$id)->first();
    //         $data['order']=$order;

    //         $data['appointments'] = Appointment::where('patient_id', $case->patient_id)->orderBy('id', 'desc')->limit(3)->get();
            
    //         return view('originator.container.case.case-form-new', $data);
    //      } catch (Exception $e) {
    //         return redirect()->back()->withErrors($e->getMessage());
    //      }
    // }
    public function show($id, Request $request){
        try {
            $case = CaseModel::find($id);
            $data['edit_values'] = $case;
            
            $ip = $request->ip(); // Get user's IP address from request object
            
            // Call the ipgeolocation API to get user's timezone based on their IP address
            $api_key = "4eb0722e7f464951aef4c772283952fb"; // replace with your actual API key
            $api_url = "https://api.ipgeolocation.io/timezone?apiKey={$api_key}&ip={$ip}";
            $api_response = json_decode(file_get_contents($api_url), true);
            $user_timezone = new DateTimeZone($api_response['timezone']);
            
            $data['user_timezone'] = $user_timezone->getName(); // Set user's timezone
        
            $order= Order::where('case_id','=',$id)->first();
            $data['order']=$order;
        
            $data['appointments'] = Appointment::where('patient_id', $case->patient_id)->orderBy('id', 'desc')->limit(3)->get();
            
            return view('originator.container.case.case-form-new', $data);
         } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
         }
    }
    
    public function edit(CaseEditRequest $request, $id)
    {    
        
        try {
            $edit_values = CaseModel::where('id', $id)->first();

            $ClinicalConditions = ClinicalCondition::all();
            $caseClinicalConditions = CaseClinicalCondition::where('case_id', $id)->pluck('clinical_condition_id');
            $ClinicDoctors = ClinicDoctor::all();

            $Patients = Patient::where('clinic_doctor_id', $edit_values->clinic_doctor_id)->get();
            $impression_kit_orders = Order::where('patient_id', $edit_values->patient_id)->where(function ($q) use ($edit_values) {
                $q->where('used_in_case', '!=', 1)->orWhere('id', $edit_values->impression_kit_order_id);
            })->where('product', 'IMPRESSION KIT')->get();
            $attachments = collect(CaseAttachmentResource::collection($edit_values->attachments->sortBy('sort_order')))->toArray();
            $attachments = collect($attachments)->groupBy('attachment_type')->toArray();
            $data['edit_values'] = $edit_values;
            $data['ClinicalConditions'] = $ClinicalConditions;
            $data['caseClinicalConditions'] = $caseClinicalConditions;
            $data['ClinicDoctors'] = $ClinicDoctors;
            $data['Patients'] = $Patients;
            $data['impression_kit_orders'] = $impression_kit_orders;
            $data['attachments'] = $attachments;
            return response()->json($data);
            // dd($attachments);
            // return view('originator.container.case.case-form', compact('edit_values', 'ClinicalConditions', 'ClinicDoctors', 'Patients', 'impression_kit_orders', 'attachments','caseClinicalConditions'));
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CaseUpdateRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $Case = CaseModel::findOrFail($id);
            $doctor_id = $Case->doctor_id;
            $password = Str::random(6);
            $request->request->add(['created_by' => $doctor_id]);
            $request->request->add(['password' => $password]);

            $user = User::where('email', $request->email)->first();
             $patientData = [
                'name' =>  $request->name,
                'phone' =>  $request->phone_no,
                'gender' =>  $request->gender,
                'dob' =>  $request->dob,
             ];

             if (!empty($user) && isset($user->id)) {
                User::where('id', $user->id)->update($patientData);
             } else {
                if($request->email){
                    $patientData['email'] = $request->email;
                    $user = User::create($patientData);    
                    $token = substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyzABCDEFGHIJKLMNOPQRSTVWXYZ"), 0, 60);
                    $otp = rand(10000, 99999);
    
                    $PasswordReset = new PasswordReset();
                    $PasswordReset->email = $request->email;
                    $PasswordReset->token = $token;
                    $PasswordReset->otp = $otp;
                    if ($PasswordReset->save()) {
                        // $user->notify(new NewPatientFromWeb($PasswordReset));
                    }
                    
                    $request->request->add(['patient_id' => $user->id]);
                    Patient::updateOrCreate(['user_id' => $user->id, 'user_id' => $user->id], ['clinic_doctor_id' => $request->doctor_id, 'doctor_id' => $request->doctor_id, 'user_id' => $user->id]);

              }
            }


            $request->request->add(['doctor_id' => $Case->doctor_id]);
            $request->request->add(['clinic_doctor_id' => $Case->doctor_id]);

            $Setting = Setting::first();


            $request->request->add(['arch_to_treat' => $request->has('arch_to_treat') ? 'UPPER' : 'LOWER']);
            $request->request->add(['a_p_relationship' => $request->has('a_p_relationship') ? 'MAINTAIN' : 'IMPROVE']);
            $request->request->add(['overjet' => $request->has('overjet') ? 'MAINTAIN' : 'IMPROVE']);
            $request->request->add(['overbite' => $request->has('overbite') ? 'MAINTAIN' : 'IMPROVE']);
            $request->request->add(['midline' => $request->has('midline') ? 'MAINTAIN' : 'IMPROVE']);
            $request->request->add(['dob' => date("Y-m-d", strtotime($request->dob))]);
            $request->request->add(['processing_fee_amount' => $Setting->case_fee]);

            $Case->update($request->only('patient_id', 'clinic_doctor_id', 'doctor_id', 'name', 'email', 'phone_no', 'gender', 'dob', 'clinical_comment', 'arch_to_treat', 'a_p_relationship', 'overjet', 'overbite', 'midline', 'prescription_comment', 'comment', 'processing_fee_amount', 'impression_kit_order_id', 'created_by'));

            if ($Case) {

                $case_id = $id;

                if (!empty($request->impression_kit_order_id))
                    Order::where('id', $request->impression_kit_order_id)->update(['used_in_case' => 1]);

                if (!empty($request->clinical_conditions)) {
                    foreach ($request->clinical_conditions as $clinical_condition) {
                        CaseClinicalCondition::updateOrCreate(
                            ['case_id' => $case_id, 'clinical_condition_id' => $clinical_condition],
                            ['created_by' => $doctor_id]
                        );
                    }
                }
                CaseClinicalCondition::where('case_id', $case_id)->whereNotIn('clinical_condition_id', $request->clinical_conditions)->forceDelete();

                $attachments = explode(',', $request->attachment_ids);
                if (!empty($attachments)) {
                    CaseAttachment::whereIn('id', $attachments)->update([
                        'case_id' => $case_id
                    ]);
                }

                  //Image attachment update
                  if (!empty($request->image_attachment_ids)) 
                  {
                      foreach ($request->image_attachment_ids as $id) {
                      if($id != 0){
                                  CaseAttachment::where('id', $id)->update(['case_id' => $case_id]);
                                  
                                  }
                              }
                  }

                DB::commit();
                return redirect('admin/case')->with(['successMessage' => 'Updated successfully']);
            }

            DB::rollBack();
            return redirect()->back()->withErrors('Something went wrong');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function update_new(Request $request)
    {
        $id = $request['ElementId'];
        try {
            DB::beginTransaction();
            $Case = CaseModel::findOrFail($id);
            $doctor_id = $Case->doctor_id;
            $password = Str::random(6);
            $request->request->add(['created_by' => $doctor_id]);
            $request->request->add(['password' => $password]);

            $user = User::where('email', $request->email)->first();
             $patientData = [
                'name' =>  $request->name,
                'phone' =>  $request->phone_no,
                'gender' =>  $request->gender,
                'dob' =>  $request->dob,
             ];

             if (!empty($user) && isset($user->id)) {
                User::where('id', $user->id)->update($patientData);
             } else {
                if($request->email){
                    $patientData['email'] = $request->email;
                    $user = User::create($patientData);    
                    $token = substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyzABCDEFGHIJKLMNOPQRSTVWXYZ"), 0, 60);
                    $otp = rand(10000, 99999);
    
                    $PasswordReset = new PasswordReset();
                    $PasswordReset->email = $request->email;
                    $PasswordReset->token = $token;
                    $PasswordReset->otp = $otp;
                    if ($PasswordReset->save()) {
                        // $user->notify(new NewPatientFromWeb($PasswordReset));
                    }
                    
                    $request->request->add(['patient_id' => $user->id]);
                    Patient::updateOrCreate(['user_id' => $user->id, 'user_id' => $user->id], ['clinic_doctor_id' => $request->doctor_id, 'doctor_id' => $request->doctor_id, 'user_id' => $user->id]);
              }
            }


            $request->request->add(['doctor_id' => $Case->doctor_id]);
            $request->request->add(['clinic_doctor_id' => $Case->doctor_id]);

            $Setting = Setting::first();


            $request->request->add(['arch_to_treat' => $request->has('arch_to_treat') ? 'UPPER' : 'LOWER']);
            $request->request->add(['a_p_relationship' => $request->has('a_p_relationship') ? 'MAINTAIN' : 'IMPROVE']);
            $request->request->add(['overjet' => $request->has('overjet') ? 'MAINTAIN' : 'IMPROVE']);
            $request->request->add(['overbite' => $request->has('overbite') ? 'MAINTAIN' : 'IMPROVE']);
            $request->request->add(['midline' => $request->has('midline') ? 'MAINTAIN' : 'IMPROVE']);
            $request->request->add(['dob' => date("Y-m-d", strtotime($request->dob))]);

            $request->request->add(['processing_fee_amount' => $Setting->case_fee]);
            $Case->update($request->only('patient_id', 'clinic_doctor_id', 'doctor_id', 'name', 'email', 'phone_no', 'gender', 'dob', 'clinical_comment', 'arch_to_treat', 'a_p_relationship', 'overjet', 'overbite', 'midline', 'prescription_comment', 'comment', 'processing_fee_amount','address', 'impression_kit_order_id', 'created_by'));

            if ($Case) {

                $case_id = $id;

                if (!empty($request->impression_kit_order_id))
                    Order::where('id', $request->impression_kit_order_id)->update(['used_in_case' => 1]);

                if (!empty($request->clinical_conditions)) {
                    foreach ($request->clinical_conditions as $clinical_condition) {
                        CaseClinicalCondition::updateOrCreate(
                            ['case_id' => $case_id, 'clinical_condition_id' => $clinical_condition],
                            ['created_by' => $doctor_id]
                        );
                    }
                }
                CaseClinicalCondition::where('case_id', $case_id)->whereNotIn('clinical_condition_id', $request->clinical_conditions)->forceDelete();

                $attachments = explode(',', $request->attachment_ids);
                if (!empty($attachments)) {
                    CaseAttachment::whereIn('id', $attachments)->update([
                        'case_id' => $case_id
                    ]);
                }

                  //Image attachment update
                  if (!empty($request->image_attachment_ids)) 
                  {
                      foreach ($request->image_attachment_ids as $id) {
                      if($id != 0){
                                  CaseAttachment::where('id', $id)->update(['case_id' => $case_id]);
                                  
                                  }
                              }
                  }

                DB::commit();
                $arrRes['done'] = true;
                $arrRes['msg'] = 'Data updated successfully';
                return response()->json($arrRes);
                // return redirect('admin/case')->with(['successMessage' => 'Updated successfully']);
            }

            DB::rollBack();
            // return redirect()->back()->withErrors('Something went wrong');
            
            $arrRes['done'] = false;
            $arrRes['msg'] = 'Error in updating';
            return response()->json($arrRes);
        } catch (Exception $e) {
            DB::rollBack();
            $arrRes['done'] = false;
            $arrRes['msg'] = 'Error in updating';
            return response()->json($arrRes);
            // return redirect()->back()->withErrors($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $recordIds = explode(",",$id);
        try{
            foreach($recordIds as $id)
            {
        
                 $case = CaseModel::find($id);
                if($case->forceDelete())         
                {
                    $arrRes['msg']  = "Data deleted successfully";
                    $arrRes['done'] = true;
                }else{
                    $arrRes['done'] = false;
                    $arrRes['msg'] = 'Error in deleting Data';
                }
            }
            return response()->json($arrRes);
            }
            
        catch (Exception $e) {
            $arrRes['done'] = false;
            $arrRes['msg'] = 'Error in deleting Data';
            return response()->json($arrRes);
            //return errorJsonResponse_h($e->getMessage());
        }
    }

        
    public function impressionKitReceived(CaseImpressionKitReceivedRequest $request)
    {
        try {
            $case = CaseModel::find($request->case_id);
            $case->update(['impression_kit_received' => $request->impression_kit_received]);

            return successJsonResponse_h('Updated successfully');
        } catch (Exception $e) {
            return errorJsonResponse_h($e->getMessage());
        }
    }

    public function alignerKitDelivery(CaseAlignerKitDeliveryRequest $request)
    {
        try {
            $case = CaseModel::find($request->case_id);
            $order = Order::findOrFail($case->aligner_kit_order_id);
            if ($order) {
                if (strtoupper($order->status) != "PENDING") {
                    $order->update(['status' => 'DELIVERED']);
                    return successJsonResponse_h('Updated successfully');
                }
                return errorJsonResponse_h('Clears Aligner order is not paid');
            }
            return errorJsonResponse_h('Clears Aligner order not found');
        } catch (Exception $e) {
            return errorJsonResponse_h($e->getMessage());
        }
    }

    public function noOfTraysUpdate(CaseNoOfTraysUpdateRequest $request)
    {
        try {
            $case = CaseModel::find($request->case_id);

            if (!empty($case->aligner_kit_order_id)) {
                $order = Order::findOrFail($case->aligner_kit_order_id);
                if ($order && strtoupper($order->status) != "PENDING") {
                    return errorJsonResponse_h('Can not update, order has been paid');
                }
            }

            $case->update(['no_of_trays' => $request->no_of_trays]);

            return successJsonResponse_h('Updated successfully');
        } catch (Exception $e) {
            return errorJsonResponse_h($e->getMessage());
        }
    }

    public function noOfDaysUpdate(CaseNoOfDaysUpdateRequest $request)
    {     
        try {
             // dd($request->all());
             $CaseModel = CaseModel::find($request->case_id);
             // if (!empty($case->aligner_kit_order_id)) {
             //     $order = Order::findOrFail($case->aligner_kit_order_id);
             //     if ($order && strtoupper($order->status) != "PENDING") {
             //         return errorJsonResponse_h('Can not update, order has been paid');
             //     }
             // }
              $CaseModel->update(['no_of_days' => $request->no_of_days, 'no_of_trays' => $request->no_of_trays]);

              $CaseModel = CaseModel::with('doctor')->find($request->case_id);
                     
                     // patient
                    //  dd($CaseModel);
             $username = $CaseModel->doctor->name;
             $to = $CaseModel->email;
             $subject = "Treatment Plan Upload Notification";

             $data['case_id'] = $CaseModel->id;
             //  $data['doctor_name'] = $username;
             $data['patient_name'] = $CaseModel->name;
             $html = view('emails.videoUploadNotification', $data)->render();
             $check = $this->sendMailViaPostMark($html, $to, $subject);
           
           
         if(!empty($CaseModel->doctor)){
             $to = $CaseModel->doctor->email;
             $subject = "Treatment Plan Upload Notification";
             $data['case_id'] = $CaseModel->id;
             $data['doctor_name'] = $username;
             $data['patient_name'] = $CaseModel->name;
             $html = view('emails.videoUploadNotification', $data)->render();
             $check = $this->sendMailViaPostMark($html, $to, $subject);
            }
             //Admin
             $to = "info@accualigners.com";
             $html = view('emails.videoUploadNotificationAdmin', $data)->render();
             $check = $this->sendMailViaPostMark($html, $to, $subject);
           


             return successJsonResponse_h('Updated successfully');
        } catch (Exception $e) {
             return errorJsonResponse_h($e->getMessage());
        }
    }

    public function addAdvice(CaseAddAdviceRequest $request)
    {
        try {
          
            $concern = CaseConcern::create(['case_id' => $request->case_id, 'message_by' => 'ADVISER', 'message' => $request->message]);

            $CaseModel = CaseModel::find($request->case_id);
            $CaseModel->has_concern = 0;
            $CaseModel->save();

            $html = view('originator.container.case.components.case-concern', ['concern' => $concern])->render();


            return successJsonResponse_h('Added advice', ['html' => $html,'concern' => $concern]);
        } catch (Exception $e) {
            return errorJsonResponse_h($e->getMessage());
        }
    }

    public function uploadVideo(CaseUploadVideoRequest $request)
    {

        try {
            $CaseModel = CaseModel::with('doctor')->find($request->case_id);

            $user_id = $CaseModel->patient_id;

            $file = $request->file('file');
            $name = 'case-video-' . $user_id . '-' . time() . '.' . $file->extension();
            Storage::disk(env('FILE_SYSTEM'))->putFileAs($this->path, $file, $name);

            $video = $this->path . $name;

            $CaseModel->video_uploaded = $video;
            $CaseModel->video_uploaded_type = ($file->extension() == 'mp4' ? 'VIDEO' : 'IMAGE');
            $CaseModel->video_embedded = null;
            $CaseModel->save();


            /// Patient 
            // $username = $CaseModel->name;
            // $to = $CaseModel->email;
            // $subject = "Treatment Plan Upload Notification";

            // $data['case_id'] = $CaseModel->id;
            // $data['doctor_name'] = $username;
            // $html = view('emails.videoUploadNotification', $data)->render();
            // $check = $this->sendMailViaPostMark($html, $to, $subject);
            
            // Doctor
            if(!empty($CaseModel->doctor)){
                
            // $username = $CaseModel->doctor->name;
            // $to = $CaseModel->doctor->email;
            // $subject = "Treatment Plan Upload Notification";
            // $data['case_id'] = $CaseModel->id;
            // $data['doctor_name'] = $username;
            // $data['patient_name'] =$CaseModel->name;

            // $html = view('emails.videoUploadNotification', $data)->render();
            // $check = $this->sendMailViaPostMark($html, $to, $subject);

            //Admin
            // $to = "info@accualigners.com";
            // $html = view('emails.videoUploadNotificationAdmin', $data)->render();
            // $check = $this->sendMailViaPostMark($html, $to, $subject);
            }
            
            return successJsonResponse_h('Video has been uploaded', ['video' => $video]);
        } catch (Exception $e) {
            return errorJsonResponse_h($e->getMessage());
        }
    }

    public function deleteVideo(CaseDeleteVideoRequest $request)
    {

        try {
            $CaseModel = CaseModel::find($request->case_id);
            Storage::disk(env('FILE_SYSTEM'))->forceDelete($CaseModel->video_uploaded);

            $CaseModel->video_uploaded = null;
            $CaseModel->video_uploaded_type = null;
            $CaseModel->video_embedded = null;
            $CaseModel->save();

            return successJsonResponse_h();
        } catch (Exception $e) {
            return errorJsonResponse_h($e->getMessage());
        }
    }

    public function embeddedVideo(CaseEmbeddedVideoRequest $request)
    {
        try {
            $CaseModel = CaseModel::with('doctor')->find($request->case_id);

            $CaseModel->video_uploaded = null;
            $CaseModel->video_uploaded_type = null;
            $CaseModel->video_embedded =  json_encode($request->video_embedded);
            $CaseModel->save();

            // patient
            // $username = $CaseModel->name;
            // $to = $CaseModel->email;
            // $subject = "Treatment Plan Upload Notification";

            // $data['case_id'] = $CaseModel->id;
            // $data['doctor_name'] = $username;
            // $html = view('emails.videoUploadNotification', $data)->render();
            // $check = $this->sendMailViaPostMark($html, $to, $subject);
            
            // Doctor
            if(!empty($CaseModel->doctor)){
                
            $username = $CaseModel->doctor->name;


               // patient
            // $username = $CaseModel->name;
            // $to = $CaseModel->email;
            // $subject = "Treatment Plan Upload Notification";

            // $data['case_id'] = $CaseModel->id;
            // $data['doctor_name'] = $username;
            // $html = view('emails.videoUploadNotification', $data)->render();
            // $check = $this->sendMailViaPostMark($html, $to, $subject);
           
            // $to = $CaseModel->doctor->email;
            // $subject = "Treatment Plan Upload Notification";
            // $data['case_id'] = $CaseModel->id;
            // $data['doctor_name'] = $username;
            // $data['patient_name'] = $CaseModel->name;
            // $html = view('emails.videoUploadNotification', $data)->render();
            // $check = $this->sendMailViaPostMark($html, $to, $subject);

             //Admin
            //  $to = "info@accualigners.com";
 
            //  $html = view('emails.videoUploadNotificationAdmin', $data)->render();
            //  $check = $this->sendMailViaPostMark($html, $to, $subject);
            }
            return response()->json(['message' => 'success']);
        } catch (Exception $e) {
            return errorJsonResponse_h($e->getMessage());
        }
    }

    public function uploadAttachment2(Request $request)
    {  
        
        try {
            $user_id = $request->user()->id;
            $sort_order = $request->sort_order;
            $attachment_type = $request->attachment_type;
            $sort_order=1;


            foreach($request->file('attachment') as $file){
            // $file = $request->file('attachment');
            $mimeType = $file->getClientMimeType();

            // $name = 'case-' . $user_id . '-' . time() . '.' . $file->getClientOriginalExtension();
            $name = 'case-' . $user_id . '-' . time() . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
            Storage::disk(env('FILE_SYSTEM'))->putFileAs($this->attachment_path, $file, $name);

            if ($attachment_type != "OTHER" && $request->has('case_id') && !empty($request->case_id)) {
                $CaseAttachment = CaseAttachment::updateOrCreate(
                     [
                        'case_id' => $request->case_id,
                        'sort_order' => $sort_order,
                        'attachment_type' => $attachment_type
                     ],
                     [
                        'name' => $name,
                        'path' => $this->attachment_path,
                        'created_by' => $user_id
                     ]
                );
            } else {
                $CaseAttachment = CaseAttachment::create([
                    'case_id' => isset($request->case_id) && !empty($request->case_id) ? $request->case_id : null,
                    'sort_order' => $sort_order,
                    'attachment_type' => $attachment_type,
                    'name' => $name,
                    'path' => $this->attachment_path,
                    'created_by' => $user_id
                ]);
            }
            
            $CaseAttachment = new CaseAttachmentResource($CaseAttachment);
            if ($mimeType == 'application/octet-stream') {
                $CaseAttachment->name = 'stl.jpg';
            } elseif ($mimeType == 'application/pdf') {
                $CaseAttachment->name = 'pdf.jpg';
            }
            $sort_order++;
            $attachmentCollection[] = $CaseAttachment;
        }
            return successJsonResponse_h('Uploaded successfully',$attachmentCollection);
        } catch (Exception $e) {
            return errorJsonResponse_h($e->getMessage());
        }
    }

    public function uploadAttachment(Request $request)
    {  
        try {
            $user_id = $request->user()->id;
            $sort_order = $request->sort_order;
            $attachment_type = $request->attachment_type;

            $file = $request->file('attachment');
            $mimeType = $file->getClientMimeType();

            $name = 'case-' . $user_id . '-' . time() . '.' . $file->getClientOriginalExtension();
            Storage::disk(env('FILE_SYSTEM'))->putFileAs($this->attachment_path, $file, $name);

            if($request->has('image_id')){
                if(CaseAttachment::where('id', $request->image_id)->update(['name' => $name,
                'path' => $this->attachment_path,
                'created_by' => $user_id])){
                    return successJsonResponse_h('Image Updated Successfully');
                }else{
                    return successJsonResponse_h('Error while updating');
                }
                
             }
            else if ($attachment_type != "OTHER" && $request->has('case_id') && !empty($request->case_id)) {
                $CaseAttachment = CaseAttachment::updateOrCreate(
                    [
                        'case_id' => $request->case_id,
                        'sort_order' => $sort_order,
                        'attachment_type' => $attachment_type
                    ],
                    [
                        'name' => $name,
                        'path' => $this->attachment_path,
                        'created_by' => $user_id
                    ]
                );
            } else {

                $CaseAttachment = CaseAttachment::create([
                    'case_id' => isset($request->case_id) && !empty($request->case_id) ? $request->case_id : null,
                    'sort_order' => $sort_order,
                    'attachment_type' => $attachment_type,
                    'name' => $name,
                    'path' => $this->attachment_path,
                    'created_by' => $user_id
                ]);
            }
            
            $CaseAttachment = new CaseAttachmentResource($CaseAttachment);
            if ($mimeType == 'application/octet-stream') {
                $CaseAttachment->name = 'stl.jpg';
            } elseif ($mimeType == 'application/pdf') {
                $CaseAttachment->name = 'pdf.jpg';
            }
            return successJsonResponse_h('Uploaded successfully',$CaseAttachment);
        } catch (Exception $e) {
            return errorJsonResponse_h($e->getMessage());
        }
    }
    
     public function uploadAttachments(Request $request)
    {
        
          $validated = $request->validate([
                'case_id' => 'sometimes|nullable|exists:cases,id',
                'attachment_type' => 'required|in:IMAGE,X_RAY,UPPER_JAW,LOWER_JAW,OTHER,TREATMENT-PLAN-PDF',
                'attachment.*' => 'required|mimetypes:image/*,application/pdf,application/msword,application/octet-stream,application/sla,application/vnd.ms-pki.stl,model/stl',
                'sort_order' => 'required|numeric'
            ]);
        try {
            $user_id = $request->user()->id;
            $attachment_type = $request->attachment_type;
            $files = $request->file('attachment');
            foreach ($files as $key => $file) {
                $sort_order = $key + 1;
                $name = 'case-' . $user_id . '-' . time() . '.' . $file->getClientOriginalExtension();
                Storage::disk(env('FILE_SYSTEM'))->putFileAs($this->attachment_path, $file, $name);
                 $CaseAttachment = CaseAttachment::updateOrCreate(
                    [
                        
                        'case_id' => $request->case_id,
                        'sort_order' => $sort_order,
                        'attachment_type' => $attachment_type
                    ],
                    [
                        'name' => $name,
                        'path' => $this->attachment_path,
                        'created_by' => $user_id
                    ]
                );
            }  
            return successJsonResponse_h('Uploaded successfully', new CaseAttachmentResource($CaseAttachment));
        } catch (Exception $e) {
            return errorJsonResponse_h($e->getMessage());
        }
    }
   
    
    public function downloadAttachment(Request $request, $case_id)
      {
        try {
        $zip = new ZipArchive;
        $fileName = 'zip/documents-'.rand(9,999).$case_id.'.zip';
        if($request->has('type')){
             $attachments = CaseAttachment::where('case_id',$case_id)->where('attachment_type', $request->type)->get();
        }
        else{
             $attachments = CaseAttachment::where('case_id',$case_id)->get();
        }
        if(count($attachments) == 0){
            return redirect()->back()->withErrors('No Data found');
        }
        
        if ($zip->open(public_path($fileName), ZipArchive::CREATE) === TRUE)
        {
            foreach ($attachments as $key => $value) {
                $Filevalue = 'storage/'.$value->path.$value->name;
                $relativeNameInZipFile = basename($Filevalue);
                $zip->addFile($Filevalue, $relativeNameInZipFile);
            }
            $zip->close();
        }
        return response()->download(public_path($fileName));
        } catch (Exception $e) {
            return errorJsonResponse_h($e->getMessage());
        }
    }

    public function destroyAttachment(Request $request)
    {
        try {
            $CaseAttachment = CaseAttachment::find($request->id);
            if ($CaseAttachment && isset($CaseAttachment->path)) {

                $image = $CaseAttachment->path . $CaseAttachment->name;

                if ($CaseAttachment->forceDelete()) {
                    Storage::disk(env('FILE_SYSTEM'))->forceDelete($image);
                    return successJsonResponse_h('Deleted successfully');
                }
                return errorJsonResponse_h('Something went wrong');
            }
            return errorJsonResponse_h('Attachment not found');
        } catch (Exception $e) {
            return errorJsonResponse_h($e->getMessage());
        }
    }

    public function getClinicPatients(Request $request)
    {

        try {
            $Patients = Patient::where('clinic_doctor_id', $request->clinic_doctor_id)->get();

            return successJsonResponse_h('', PatientResource::collection($Patients));
        } catch (Exception $e) {
            return errorJsonResponse_h($e->getMessage());
        }
    }

    public function getPatientDetail(Request $request)
    {

        try {
            $Patient = User::find($request->patient_id);
            $impression_kit_orders = Order::where('patient_id', $request->patient_id)->where('used_in_case', '!=', 1)->where('product', 'IMPRESSION KIT')->get();

            return successJsonResponse_h('', ['patient' => new UserResource($Patient), 'impression_kit_orders' => OrderResource::collection($impression_kit_orders)]);
        } catch (Exception $e) {
            return errorJsonResponse_h($e->getMessage());
        }
    }
    /*____________status change manually_____________*/
    public function change_status(Request $request){
        $case = CaseModel::find($request->id);
        if($request->check=='paid'){
        $case->update([
            'processing_fee_paid' => 1, 
            'processing_fee_payment_name' => 'Invoice', 
            'processing_fee_payment_responses' => "Payment Processed",
            'processing_fee_payment_at' => Carbon::now(),
            'payment_status' => 'treatment-plan'
         ]);

         if($case){
            return response()->json(['msg' => 'success1']);
         }else{
            return response()->json(['msg'=>'fail']);
         }
     }else{
        $case->update([
            'processing_fee_paid' => 0, 
            'processing_fee_payment_name' => null, 
            'processing_fee_payment_responses' => null,
            'processing_fee_payment_at' => null,
            'payment_status' => 'pending'
         ]);
         
         if($case){
            return response()->json(['msg' => 'success2']);
         }else{
            return response()->json(['msg'=>'fail']);
         }
     }
 }
     //updating tray status
    public function missing_trays(Request $request)
    {  
        // dd($request->all());
        try {
            $addTrays = [
                'no_of_missing_trays' =>  $request->missing_trays,
            ];
            if(CaseModel::where('id', $request->case_id)->update($addTrays))
            {
                $data['done'] = true;
                $data['message'] = 'Missing trays updated';
            }else{
                $data['done'] = false;
                $data['message'] = 'Error in Missing trays updated';
            }
            return response()->json($data);
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function deleteAttachment(Request $request)
    {
        $CaseAttachment=CaseAttachment::find($request->id);
        if($CaseAttachment->forceDelete())
        {
            $data['done'] = true;
            $data['message'] = 'Image deleted successfully';
        }else{
            $data['done'] = false;
            $data['message'] = 'Error in Deleting Image';
        }
        return response()->json($data);
    }

    /*__________connect_case__________*/
    public function connectCase(Request $request)
    {
       
        $doctorId = [
            'doctor_id' =>  $request->doctor_id,
            'clinic_doctor_id' =>  $request->doctor_id,
        ];
        if(CaseModel::where('id', $request->id)->update($doctorId))
        {
            $data['done'] = true;
            $data['message'] = 'success';
        }else{
            $data['done'] = false;
            $data['message'] = 'error';
        }
        return response()->json($data);
    }
    /*_______________notify_about_digital_scan____________*/
    public function notify_about_digital_scan(Request $request)
    {
       
        $doctorId = [
            'doctor_id' =>  $request->doctor_id,
            'clinic_doctor_id' =>  $request->doctor_id,
        ];
        if(CaseModel::where('id', $request->id)->update(['pay_digital_scan' => '1']))
        {
            $data['done'] = true;
            $data['message'] = 'success';
        }else{
            $data['done'] = false;
            $data['message'] = 'error';
        }
        return response()->json($data);
    }

    public function getallAdvicesAdmin(Request $request){

        $concern = CaseConcern::where('case_id' ,'=', $request->case_id)->orderBy('id','desc')->get();
         
        if($concern->count() > 0){
           return response()->json(['done' => true , 'concern' => $concern]);

        }else{
           return response()->json(['done' => false]);
        }

     }
}

?>