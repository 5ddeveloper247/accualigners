<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShippingCompanyCharge extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'shipping_company_id',
        'country_id',
        'state_id',
        'city_id',
        'amount',
        'duration_text'
    ];

    public function shipping_company(){
        return $this->belongsTo(ShippingCompany::class);
    }

    public function country(){
        return $this->belongsTo(Country::class);
    }

    public function state(){
        return $this->belongsTo(State::class);
    }

    public function city(){
        return $this->belongsTo(City::class);
    }
}
