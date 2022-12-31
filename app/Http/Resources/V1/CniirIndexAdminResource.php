<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class CniirIndexAdminResource extends JsonResource
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
            'sector' => $this->organisation->sector->name,
            'organisation' => $this->organisation->name,
            'code' => strtoupper($this->organisation->code),
            'quadrant' => $this->quadrant->name,
            'cniir_score' => number_format((float)$this->score, 2, '.', ''),
            'pre_event_rtd_score' => number_format((float)$this->pre_event_rtd_score, 2, '.', ''),
            'during_event_rtd_score' => number_format((float)$this->during_event_rtd_score, 2, '.', ''),
            'post_event_rtd_score' => number_format((float)$this->post_event_rtd_score, 2, '.', ''),
            'identify' => number_format((float)$this->identify, 2, '.', ''),
            'protect' => number_format((float)$this->protect, 2, '.', ''),
            'detect' => number_format((float)$this->detect, 2, '.', ''),
            'respond' => number_format((float)$this->respond, 2, '.', ''),
            'recover' => number_format((float)$this->recover, 2, '.', ''),
            'date_calculated' => $this->created_at
        ];
    }
}
