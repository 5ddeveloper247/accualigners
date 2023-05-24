<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CaseSelfie extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'case_id',
        'tray_no',
        'day',
        'name',
        'path',
        'created_by'
    ];
}
