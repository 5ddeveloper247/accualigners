<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SocialAccount extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'provider_id',
        'provider_name',
        'user_id',
    ];
}
