<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClinicDoctor extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'clinic_id',
        'doctor_id',
        'appointment_duration',
        'monday_time',
        'tuesday_time',
        'wednesday_time',
        'thursday_time',
        'friday_time',
        'saturday_time',
        'sunday_time',
        'created_by',
    ];

    protected $hidden = [
        'created_by',
    ];

    public function doctor(){
        return $this->belongsTo(User::class, 'doctor_id','id');
    }

    public function clinic(){
        return $this->belongsTo(Clinic::class, 'clinic_id', 'id');
    }
}
