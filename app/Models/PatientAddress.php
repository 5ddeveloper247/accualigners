<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PatientAddress extends Model
{

    use SoftDeletes;

    protected $fillable = [
        'patient_id',
        'title',
        'contact_no',
        'country_id',
        'state_id',
        'city_id',
        'address',
        'default',
        'created_by',
    ];

    public function country(){
        return $this->belongsTo('App\Models\Country', 'country_id', 'id');
    }

    public function state(){
        return $this->belongsTo('App\Models\State', 'state_id', 'id');
    }

    public function city(){
        return $this->belongsTo('App\Models\City', 'city_id', 'id');
    }

}
