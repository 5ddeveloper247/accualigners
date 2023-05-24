<?php

namespace App\Http\Resources\Api\Patient\CaseRes;

use Illuminate\Http\Resources\Json\JsonResource;

class CaseDayAndTrayResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        $case = new CaseResource(parent::toArray($request));
        $day = 1;
        $tray_no = 1;
        if(isset($this->last_time_logs->check_in)){

            if(date('m-d-Y', $this->last_time_logs->check_in) == date('m-d-Y', time())){
                $day = $this->last_time_logs->day;
                $tray_no = $this->last_time_logs->tray_no;
            }else{
                $day = $this->no_of_days <= $this->last_time_logs->day ? ($this->no_of_trays <= $this->last_time_logs->tray_no ? $this->no_of_days : 1) : ($this->last_time_logs->day + 1) ;
                $tray_no = $this->no_of_days <= $this->last_time_logs->day ? ($this->no_of_trays <= $this->last_time_logs->tray_no ? $this->no_of_trays : ($this->last_time_logs->tray_no + 1) ) : $this->last_time_logs->tray_no;
            }
            
        }
        return parent::toArray($request);
return ['current_no_of_day' => $day, 'current_tray_no' => $tray_no];
        return array_merge(collect($case)->toArray(), ['current_no_of_day' => $day, 'current_tray_no' => $tray_no]);

    }
}
