<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class CaseClinicalCondition extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'case_id',
        'clinical_condition_id'
    ];

    public function clinical_condition(){
        return $this->belongsTo(ClinicalCondition::class, 'clinical_condition_id', 'id');
    }
}
