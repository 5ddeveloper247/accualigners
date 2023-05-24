<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Appointment extends Model
{
    use SoftDeletes;
    protected $table = 'appointments';
    protected $fillable = [
        'clinic_doctor_id',
        'patient_id',
        'doctor_id',
        'appointment_time',
        'appointment_date',
        'difficulties',
        'treatment_plan',
        'patient_joined_call',
        'doctor_joined_call',
        'status',
        'created_by',
    ];

    protected $hidden = [
        'created_by',
    ];

    protected $appends = [
        'appointment_datetime',
    ];

    public function doctor(){
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public function patient(){
        return $this->belongsTo(User::class, 'patient_id');
    }

    public function getAppointmentDatetimeAttribute()
    {
        return Carbon::createFromTimestamp($this->appointment_time)->toDateTimeString();
    }

    public function scopeWithAvailability($query){
        $query->addSelect(DB::raw('(CASE WHEN unix_timestamp() < `appointment_time` AND `status` = 2 THEN "upcoming_appointmant" ELSE "previous_appointmant" END) AS appointmant_status'));
    }

    public function scopeStatusTitleForPatient($query){
        $query->addSelect(DB::raw('(CASE WHEN `status`=0 THEN "Canceled by you" WHEN `status`=1 THEN "Completed" WHEN `status`=2 AND unix_timestamp() > `appointment_time` THEN "Incomplete" WHEN `status`=2 THEN "Pending" WHEN `status`=3 THEN "Canceled by doctor" ELSE "upcoming_appointmant" END) AS status_title'));
    }

    public function scopeStatusTitleForDoctor($query){
        $query->addSelect(DB::raw('(CASE WHEN `status`=0 THEN "Canceled by patient" WHEN `status`=1 THEN "Completed" WHEN `status`=2 AND unix_timestamp() > `appointment_time` THEN "Incomplete" WHEN `status`=2 THEN "Pending" WHEN `status`=3 THEN "Canceled by you" ELSE "upcoming_appointmant" END) AS status_title'));
    }

    public function scopeStatusTitleForAdmin($query){
        $query->addSelect(DB::raw('(CASE WHEN `status`=0 THEN "Canceled by patient" WHEN `status`=1 THEN "Completed" WHEN `status`=2 AND unix_timestamp() > `appointment_time` THEN "Incomplete" WHEN `status`=2 THEN "Pending" WHEN `status`=3 THEN "Canceled by doctor" ELSE "upcoming_appointmant" END) AS status_title'));
    }
}
