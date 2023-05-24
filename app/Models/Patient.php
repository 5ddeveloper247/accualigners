<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patient extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'clinic_doctor_id',
    ];

    public function clinic_doctor(){
        return $this->belongsTo(ClinicDoctor::class, 'clinic_doctor_id', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

}
