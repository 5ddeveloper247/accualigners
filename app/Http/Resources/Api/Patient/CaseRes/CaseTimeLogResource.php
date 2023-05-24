<?php

namespace App\Http\Resources\Api\Patient\CaseRes;

use Illuminate\Http\Resources\Json\JsonResource;

class CaseTimeLogResource extends JsonResource
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
            'case_id' => $this->case_id,
            'tray_no' => $this->tray_no,
            'day' => $this->day,
            'check_in' => date('m-d-Y h:i:sa', $this->check_in),
            'check_out' => !empty($this->check_out) ? date('m-d-Y h:i:sa', $this->check_out) : '',
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
