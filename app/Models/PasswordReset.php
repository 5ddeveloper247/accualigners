<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    use SoftDeletes;
    public $timestamps = false;

    protected $fillable = [
        'token',
        'email',
        'otp',
        'created_at',
        'deleted_at',
    ];

}
