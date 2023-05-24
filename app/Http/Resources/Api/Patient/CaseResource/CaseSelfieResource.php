<?php

namespace App\Http\Resources\Api\Patient\CaseResource;

use Illuminate\Http\Resources\Json\JsonResource;

class CaseSelfieResource extends JsonResource
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
            'name' => $this->name,
            'path' => $this->path,
            'image' => storageUrl_h($this->path.$this->name),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
