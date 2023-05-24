<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Doctor;

class Clinic extends Model
{
  use SoftDeletes;

  protected $fillable = [
    'name',
    'created_by',
    'address_id',
  ];

  public function address()
  {
    return $this->belongsTo('App\Models\Address', 'address_id');
  }
 
  public function clinicDoctors(){

    return $this->belongsToMany(User::class, 'clinic_doctors', 'clinic_id', 'doctor_id')->withPivot('id','monday_time','tuesday_time','wednesday_time','thursday_time','friday_time','saturday_time','sunday_time','deleted_at');
  
   }

  protected $hidden = [
    'created_by',
  ];
}
