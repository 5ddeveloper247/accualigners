<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Slider extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'slider_image',
        'sort_order',
        'created_by',
    ];

    protected function sliderImage(): Attribute {
        
        return Attribute::make(
            get: fn ($value) => storageUrl_h($value),
        );
    }
}
