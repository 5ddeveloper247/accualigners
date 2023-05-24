<?php

namespace App\Http\Resources\Api\Patient\User;

use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if($this->resource == null)
            return [];
            
        return [
            'id' => (int) $this->id,
            'title' => $this->title,
            'contact_no' => $this->contact_no,
            'country_id' => (int) $this->country_id,
            'country_name' => $this->country->name,
            'state_id' => (int) $this->state_id,
            'state_name' => $this->state->name,
            'city_id' => (int) $this->city_id,
            'city_name' => $this->city->name,
            'address' => $this->address,
            'default' => (boolean) $this->default,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
