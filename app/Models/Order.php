<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
  use SoftDeletes;

  protected $fillable = [
    'patient_id', 'address_id', 'name', 'email', 'phone_no', 'product', 'unit_amout', 'quantity', 'discount', 'shipping_charges', 'total_amount', 'street1', 'street2', 'country_id', 'state_id', 'city_id', 'shipping_company_charge_id', 'payment_name', 'payment_responses', 'payment_at', 'payment_name', 'status', 'created_by', 'case_id', 'order_url', 'doctor_id', 'doctor_name'
  ];

  public function patient()
  {
    return $this->belongsTo(User::class, 'patient_id');
  }

  public function country()
  {
    return $this->belongsTo(Country::class, 'country_id');
  }

  public function state()
  {
    return $this->belongsTo(State::class, 'state_id');
  }

  public function city()
  {
    return $this->belongsTo(City::class, 'city_id');
  }


  protected function status(): Attribute
  {

    return Attribute::make(
      get: fn ($value) => strtoupper($value)
    );
  }

  protected function product(): Attribute
  {
    return Attribute::make(
      get: fn ($value) => strtoupper($value)
    );
  }

  public function address()
  {
    return $this->belongsTo(Address::class, 'address_id');
  }
}
