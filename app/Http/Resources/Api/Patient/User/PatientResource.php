<?php

namespace App\Http\Resources\Api\Patient\User;

use Illuminate\Http\Resources\Json\JsonResource;

class PatientResource extends JsonResource
{

    public function toArray($request){
        return new UserResource($this->user);
    }
}
