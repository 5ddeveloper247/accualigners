<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CaseTimeLog extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'case_id',
        'tray_no',
        'day',
        'check_in',
        'check_out',
        'created_by'
    ];
}
