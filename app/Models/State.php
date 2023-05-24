<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class State extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'country_id',
        'name',
        'created_by',
    ];

    public function city(){
        return $this->belongsTo('App\Models\City', 'city_id', 'id');
    }
}
