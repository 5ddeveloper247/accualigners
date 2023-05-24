<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    public $timestamps = false;
    protected $table='currencies';
    protected $fillable = [
        // 'impression_kit_price',
        'name',
        // 'case_fee',
        // 'home_impression_kit_enabled',
        // 'home_appointment_enabled',
        // 'home_i_am_candiate_enabled'
    ];
}
