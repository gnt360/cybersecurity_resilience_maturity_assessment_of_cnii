<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class ResilienceMeasureResponseResource extends JsonResource
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
            'user' => $this->user->full_name,
            'organisation' => $this->user->organisation->name,
            'r_measure' => $this->resilienceMeasure->name,
            'r_measure_scale' => $this->resilienceMeasureScale->name,
            'r_measure_scale_weight' => $this->resilienceMeasureScale->weight
        ];
    }
}
