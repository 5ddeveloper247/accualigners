<?php

namespace App\Http\Resources\Api\Patient\CaseRes;

use Illuminate\Http\Resources\Json\JsonResource;

class CaseConcernResource extends JsonResource
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
            'message_by' => $this->message_by,
            'message' => $this->message,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
