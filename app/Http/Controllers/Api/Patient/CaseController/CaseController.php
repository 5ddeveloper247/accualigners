<?php

namespace App\Http\Controllers\Api\Patient\CaseController;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Patient\CaseRequest\CaseAddConcernRequest;
use App\Http\Requests\Api\Patient\CaseRequest\CaseDestroyRequest;
use App\Http\Requests\Api\Patient\CaseRequest\CaseProcessingFeePaidRequest;
use App\Http\Requests\Api\Patient\CaseRequest\CaseStoreRequest;
use App\Http\Requests\Api\Patient\CaseRequest\CaseUpdateNoOfDaysRequest;
use App\Http\Requests\Api\Patient\CaseRequest\CaseUpdateNoOfTraysRequest;
use App\Http\Requests\Api\Patient\CaseRequest\CaseUpdateRequest;
use App\Http\Requests\Api\Patient\CaseRequest\CaseUpdateSwitchTimeRequest;
use App\Http\Resources\Api\Patient\CaseRes\CaseResource;
use App\Models\CaseAttachment;
use App\Models\CaseClinicalCondition;
use App\Models\CaseConcern;
use App\Models\CaseModel;
use App\Models\Patient;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CaseController extends Controller
{
    
    public function index(Request $request)
    {
        try{
            return successJsonResponse_h('', CaseResource::collection(CaseModel::where('patient_id', $request->user()->id)->get()));

        }catch(Exception $e){
            errorJsonResponse_h($e->getMessage());
        }
    }

    public function store(CaseStoreRequest $request)
    {
        try{

            DB::beginTransaction();
            $user_id = $request->user()->id;
            $Patient = Patient::where('user_id', $user_id)->first();
            
            $request->request->add(['patient_id' => $user_id]);
            $request->request->add(['clinic_doctor_id' => $Patient->clinic_doctor_id]);
            $request->request->add(['doctor_id' => $Patient->clinic_doctor->doctor_id]);
            
            $Case = CaseModel::create($request->only('patient_id', 'clinic_doctor_id', 'doctor_id', 'name', 'email', 'phone_no', 'gender', 'dob', 'clinical_comment', 'arch_to_treat', 'a_p_relationship', 'overjet', 'overbite', 'midline', 'prescription_comment', 'comment', 'processing_fee_amount', 'impression_kit_order_id', 'created_by'));
            
            if($Case){

                $case_id = $Case->id;

                if(!empty($request->clinical_conditions)){
                    $CaseClinicalCondition = [];
                    foreach($request->clinical_conditions as $clinical_condition){
                        $CaseClinicalCondition[] = [
                            'case_id' => $case_id,
                            'clinical_condition_id' => $clinical_condition,
                            'created_by' => $user_id

                        ];
                    }
                        
                    CaseClinicalCondition::insert($CaseClinicalCondition);
                }

                if(!empty($request->attachments)){
                    CaseAttachment::whereIn('id', $request->attachments)->update([
                        'case_id' => $case_id
                    ]);    
                }
                

                DB::commit();
                return successJsonResponse_h('Created successfully');
            }

            DB::rollBack();
            return errorJsonResponse_h('Something went wrong');
            
        }catch(Exception $e){
            DB::rollBack();
            return errorJsonResponse_h($e->getMessage());
        }
    }

    public function show(CaseDestroyRequest $request, $id)
    {
        try{
            $case = CaseModel::find($id);
            // dd($case->last_time_logs);
            return successJsonResponse_h('', new CaseResource($case));

        }catch(Exception $e){
            errorJsonResponse_h($e->getMessage());
        }
    }

    public function update(Request $request, $case_id)
    {
        try{

            DB::beginTransaction();
            $user_id = $request->user()->id;
            $Case = CaseModel::find($case_id);
            $Case->update($request->only('name', 'email', 'phone_no', 'gender', 'dob', 'clinical_comment', 'arch_to_treat', 'a_p_relationship', 'overjet', 'overbite', 'midline', 'prescription_comment', 'comment', 'processing_fee_amount', 'impression_kit_order_id'));
            
            $CaseClinicalConditionModal = CaseClinicalCondition::where('case_id', $case_id);

            if(!empty($request->clinical_conditions)){
                $CaseClinicalCondition = [];
                foreach($request->clinical_conditions as $clinical_condition){

                    if(collect($Case->clinical_conditions)->firstWhere('clinical_condition_id', $clinical_condition)->count() < 1){
                        $CaseClinicalCondition[] = [
                            'case_id' => $case_id,
                            'clinical_condition_id' => $clinical_condition,
                            'created_by' => $user_id
                        ];
                    }  
                }
                    
                CaseClinicalCondition::insert($CaseClinicalCondition);
                $CaseClinicalConditionModal = $CaseClinicalConditionModal->whereNotIn('clinical_condition_id', $request->clinical_conditions);
            }
            $CaseClinicalConditionModal->delete();

            $CaseAttachment = CaseAttachment::where('case_id', $case_id);
            if(!empty($request->attachments)){
                CaseAttachment::whereIn('id', $request->attachments)->update(['case_id' => $case_id]);
                
                $CaseAttachment = $CaseAttachment->whereNotIn('id', $request->attachments);
            }
            $CaseAttachment->delete();

            DB::commit();
            return successJsonResponse_h('Updated successfully');
                        
        }catch(Exception $e){
            DB::rollBack();
            return errorJsonResponse_h($e->getMessage());
        }
    }

    public function destroy(CaseDestroyRequest $request, $id)
    {
        try{

            CaseModel::where('id', $id)->delete();
            return successJsonResponse_h('Deleted successfully');

        }catch(Exception $e){
            return errorJsonResponse_h($e->getMessage());
        }
    }

    public function processingFeePaid(CaseProcessingFeePaidRequest $request, $id){
        try{

            $CaseModel = CaseModel::find($id);
            $CaseModel->processing_fee_payment_name = $request->payment_name;
            $CaseModel->processing_fee_paid = 1;
            // $CaseModel->status = 'CONFIRMED';
            $CaseModel->save();

            return successJsonResponse_h('Case has been confirmed', new CaseResource($CaseModel));

        }catch(Exception $e){
            return errorJsonResponse_h($e->getMessage());
        }
    }

    public function addConcern(CaseAddConcernRequest $request, $id){
        try{

            CaseConcern::create(['case_id' => $id, 'message_by' => 'PATIENT', 'message' => $request->message]);
            
            $CaseModel = CaseModel::find($id);
            $CaseModel->has_concern = 1;
            $CaseModel->save();

            return successJsonResponse_h('Concern has been created', new CaseResource($CaseModel));

        }catch(Exception $e){
            return errorJsonResponse_h($e->getMessage());
        }
    }

    public function updateNoOfTrays(CaseUpdateNoOfTraysRequest $request, $id){
        try{

            $CaseModel = CaseModel::find($id);
            $CaseModel->no_of_trays = $request->no_of_trays;
            $CaseModel->save();

            return successJsonResponse_h('Updated successfully');

        }catch(Exception $e){
            return errorJsonResponse_h($e->getMessage());
        }
    }

    public function updateNoOfDays(CaseUpdateNoOfDaysRequest $request, $id){
        try{

            $CaseModel = CaseModel::find($id);
            $CaseModel->no_of_days = $request->no_of_days;
            $CaseModel->save();

            return successJsonResponse_h('Updated successfully');

        }catch(Exception $e){
            return errorJsonResponse_h($e->getMessage());
        }
    }

    public function updateSwitchTime(CaseUpdateSwitchTimeRequest $request, $id){
        try{

            $CaseModel = CaseModel::find($id);
            $CaseModel->switch_time = $request->switch_time;
            $CaseModel->save();

            return successJsonResponse_h('Updated successfully');

        }catch(Exception $e){
            return errorJsonResponse_h($e->getMessage());
        }
    }
}
