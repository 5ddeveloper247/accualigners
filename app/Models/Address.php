<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    
    protected $fillable = [
    'value',
    'zip',
    'country_id', 'state_id', 'city_id',
    'contact_person_name',
    'contact_person_email',
    'contact_person_number',
    'created_by'
  ];
}
