<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShippingCompany extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
    ];

    public function charges(){
        return $this->belongsTo(ShippingCompanyCharge::class, 'shipping_company_id');
    }
}
