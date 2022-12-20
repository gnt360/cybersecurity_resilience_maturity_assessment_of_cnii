<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class CniirIndexResource extends JsonResource
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
            'organisation' => $this->organisation->name,
            'quadrant' => $this->quadrant->name,
            'score' => number_format((float)$this->score, 2, '.', ''),
            'pre_event_rtd_score' => number_format((float)$this->pre_event_rtd_score, 2, '.', ''),
            'during_event_rtd_score' => number_format((float)$this->during_event_rtd_score, 2, '.', ''),
            'post_event_rtd_score' => number_format((float)$this->post_event_rtd_score, 2, '.', ''),
            'date_calculated' => $this->created_at
        ];
    }
}
