<?php

namespace App\Http\Resources\Api\Patient\CaseRes;

use Illuminate\Http\Resources\Json\JsonResource;

class CaseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $day = 1;
        $tray_no = 1;
        if(isset($this->last_time_log->check_in)){

            if(date('m-d-Y', $this->last_time_log->check_in) == date('m-d-Y', time())){
                $day = $this->last_time_log->day;
                $tray_no = $this->last_time_log->tray_no;
            }else{
                $day = $this->no_of_days <= $this->last_time_log->day ? ($this->no_of_trays <= $this->last_time_log->tray_no ? $this->no_of_days : 1) : ($this->last_time_log->day + 1) ;
                $tray_no = $this->no_of_days <= $this->last_time_log->day ? ($this->no_of_trays <= $this->last_time_log->tray_no ? $this->no_of_trays : ($this->last_time_log->tray_no + 1) ) : $this->last_time_log->tray_no;
            }
            
        }

        return [
            'id' => $this->id,
            'patient_id' => $this->patient_id,
            'name' => $this->name,
            'email' => $this->email,
            'phone_no' => $this->phone_no,
            'gender' => $this->gender,
            'dob' => $this->dob,
            'clinical_comment' => $this->clinical_comment,
            'arch_to_treat' => $this->arch_to_treat,
            'a_p_relationship' => $this->a_p_relationship,
            'overjet' => $this->overjet,
            'overbite' => $this->overbite,
            'midline' => $this->midline,
            'prescription_comment' => $this->prescription_comment,
            'comment' => $this->comment,
            'processing_fee_amount' => $this->processing_fee_amount,
            'processing_fee_paid' => $this->processing_fee_paid,
            'processing_fee_payment_name' => $this->processing_fee_payment_name,
            'impression_kit_order_id' => $this->impression_kit_order_id,
            'aligner_kit_order_id' => $this->aligner_kit_order_id,
            'no_of_trays' => $this->no_of_trays,
            'no_of_days' => $this->no_of_days,
            'switch_time' => $this->switch_time,
            'treatment_plan' => $this->treatment_plan,
            'impression_kit_received' => $this->impression_kit_received,
            'status' => $this->status,
            'clinical_conditions' => CaseClinicalConditionResource::collection($this->clinical_conditions),
            'attachments' => CaseAttachmentResource::collection($this->attachments),
            'concerns' => CaseConcernResource::collection($this->concerns),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'current_no_of_day' => $day, 
            'current_no_of_tray' => $tray_no,
            'last_time_log'=> isset($this->last_time_log->id) ? (new CaseTimeLogResource($this->last_time_log)) : []
        ];
    }
}
