<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CaseAttachment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'case_id',
        'attachment_type',
        'name',
        'path',
        'sort_order'
    ];
}
