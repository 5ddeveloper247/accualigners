<?php

namespace App\Http\Resources\Api\Patient\CaseRes;

use Illuminate\Http\Resources\Json\JsonResource;

class CaseAttachmentResource extends JsonResource
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
            'attachment_type' => $this->attachment_type,
            'name' => $this->name,
            'path' => $this->path,
            'sort_order' => $this->sort_order,
            'full_path' => storageUrl_h($this->path.$this->name),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
