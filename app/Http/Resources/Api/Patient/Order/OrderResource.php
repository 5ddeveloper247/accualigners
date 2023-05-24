<?php

namespace App\Http\Resources\Api\Patient\Order;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'id' => $this->id,
            'patient_id' => $this->patient_id,
            'name' => $this->name,
            'email' => $this->email,
            'phone_no' => $this->phone_no,
            'product' => $this->product,
            'unit_amout' => $this->unit_amout,
            'quantity' => $this->quantity,
            'discount' => $this->discount,
            'shipping_charges' => $this->shipping_charges,
            'total_amount' => $this->total_amount,
            'street1' => $this->street1,
            'street2' => $this->street2,
            'country_id' => $this->country_id,
            'state_id' => $this->state_id,
            'city_id' => $this->city_id,
            'shipping_company_charge_id' => $this->shipping_company_charge_id,
            'payment_name' => $this->payment_name,
            'status' => empty($this->status) ? 'PENDING' : $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
