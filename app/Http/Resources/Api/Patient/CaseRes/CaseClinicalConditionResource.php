<?php

namespace App\Http\Resources\Api\Patient\CaseRes;

use Illuminate\Http\Resources\Json\JsonResource;

class CaseClinicalConditionResource extends JsonResource
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
            // 'case_id' => $this->case_id,
            'clinical_condition_id' => $this->clinical_condition_id,
            'name' => $this->clinical_condition->name,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
