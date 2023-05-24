<?php

namespace App\Http\Resources\Api\Patient\Shipping;

use Illuminate\Http\Resources\Json\JsonResource;

class ShippingChargesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => (int) $this->id,
            'shipping_company_id' => (int) $this->shipping_company_id,
            'title' => $this->shipping_company->name,
            'country_id' => (int) $this->country_id,
            'state_id' => (int) $this->state_id,
            'city_id' => (int) $this->city_id,
            'amount' => (double) $this->amount,
            'duration_text' => $this->duration_text,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
