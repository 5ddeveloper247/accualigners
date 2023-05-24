<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CaseConcern extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'case_id',
        'message_by',
        'message'
    ];
}
