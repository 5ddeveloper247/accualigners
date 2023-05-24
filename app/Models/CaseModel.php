<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;


class CaseModel extends Model
{
    use SoftDeletes;

    protected $table = 'cases';

    protected $fillable = [
        'patient_id',
        'clinic_doctor_id',
        'doctor_id',
        'name',
        'email',
        'phone_no',
        'gender',
        'dob',
        'clinical_comment',
        'arch_to_treat',
        'a_p_relationship',
        'overjet',
        'overbite',
        'midline',
        'prescription_comment',
        'comment',
        'digital_scan_fee',
        'digital_scan_amount',
        'pay_digital_scan',
        'processing_fee_amount',
        'processing_fee_paid',
        'processing_fee_payment_name',
        'processing_fee_payment_responses',
        'processing_fee_payment_at',
        'impression_kit_order_id',
        'aligner_kit_order_id',
        'no_of_trays',
        'no_of_days',
        'no_of_missing_trays',
        'switch_time',
        'treatment_plan',
        'impression_kit_received',
        'video_uploaded',
        'video_embedded',
        'missing_trays_amount',
        'address',  
        'status',
        'payment_status',      
        'created_by',
        'embedded_url'
    ];

    public function patient(){
        return $this->belongsTo(User::class, 'patient_id')->withDefault();
    }

    public function clinical_conditions(){
        return $this->hasMany(CaseClinicalCondition::class, 'case_id', 'id');
    }

    public function attachments(){
        return $this->hasMany(CaseAttachment::class, 'case_id', 'id');
    }

    public function concerns(){
        return $this->hasMany(CaseConcern::class, 'case_id', 'id');
    }
        //getter for last concern
    public function getLastConcernAttribute()
    {
        return CaseConcern::where('case_id',$this->id)->latest()->first();
    }

  

    public function aligner(){
        return $this->belongsTo(Order::class, 'aligner_kit_order_id', 'id');
    }

    public function impression_kit(){
        return $this->belongsTo(Order::class, 'impression_kit_order_id', 'id');
    }

    public function selfies(){
        return $this->hasMany(CaseSelfie::class, 'case_id', 'id');
    }

    public function time_logs(){
        return $this->hasMany(CaseTimeLog::class, 'case_id', 'id');
    }

    public function last_time_log(){
        return $this->belongsTo(CaseTimeLog::class, 'id', 'case_id')->orderBy('id', 'desc');
    }
    public function doctor(){
        return $this->belongsTo(User::class ,'doctor_id' ,'id');
    }
}
