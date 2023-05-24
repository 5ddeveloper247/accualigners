<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'name',
        'created_by',
    ];

    public function state(){
        return $this->belongsTo('App\Models\State', 'state_id', 'id');
    }
}
