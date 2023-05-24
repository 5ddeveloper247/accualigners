<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'name',
        'email',
        'phone',
        'website',
        'zip',
        'contact_person_name',
        'contact_person_email',
        'vat',
        'password',
        'user_type',
        'role_id',
        'picture',
        'agreement_status',
        'timezone',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($value)
    {
        if (!empty($value))
            $this->attributes['password'] = Hash::make($value);
    }


    public function setPicture($file)
    {
        // if (!empty($file)) {

        // $fileName = 'User-' . Carbon::now()->timestamp . '.' . $file->getClientOriginalExtension();
        // $path = $file->storeAs('users', $fileName, env('FILE_SYSTEM'));
        // $this->attributes['picture'] = 'users/'.$fileName;
        // }
        // if (!empty($value)) {

        //     $ImageName = 'User-' . Carbon::now()->timestamp . '.' . $value->extension();
        //     Storage::Disk(env('FILE_SYSTEM'))->putFileAs('users', $value, $ImageName);

        //     $this->attributes['picture'] = 'users/'.$ImageName;

        // }

    }

    protected function picture(): Attribute
    {
    return Attribute::make(
            get: fn ($value) => storageUrl_h($value),
        );
    }

    public function patient()
    {
        return $this->belongsTo('App\Models\Patient', 'id', 'user_id');
    }
    public function doctor()
    {
        return $this->belongsTo('App\Models\Doctor', 'id', 'user_id');
    }

    public function role(){
        return $this->belongsTo('App\Models\Role', 'role_id');
    }
    public function concerns(){
        // return $this->belongsToMany(CaseConcern::class, 'cases', 'doctor_id', 'id');
        return $this->hasManyThrough(
            CaseConcern::class,
            CaseModel::class,
            'doctor_id', // Foreign key on the environments table...
            'case_id', // Foreign key on the deployments table...
            'id', // Local key on the projects table...
            'id' // Local key on the environments table...
        );
    }
}
