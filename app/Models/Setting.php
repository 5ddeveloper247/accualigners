<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    public $timestamps = false;
    
    protected $fillable = [
        // 'impression_kit_price',
        'currency',
        'currency_id',
        'digital_scan',
        'international_courier_charges',
        'aligner_kit_price',
        'complete_treatment_plan',
        // 'case_fee',
        // 'home_impression_kit_enabled',
        // 'home_appointment_enabled',
        // 'home_i_am_candiate_enabled'
    ];
}
