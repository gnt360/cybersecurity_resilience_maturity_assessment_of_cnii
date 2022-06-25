<?php

namespace App\Http\Resources\V1\Survey;

use Illuminate\Http\Resources\Json\JsonResource;

class ResilienceFunctionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return [
        //     'id' => $this->id,
        //     'name' => $this->name,
        //     'r_temporal_dimension' => $this->resilienceTemporalDimension->name
        // ];

        return [
            'id' => $this->id,
            'name' => $this->name,
            'r_temporal_dimension' => $this->resilienceTemporalDimension->name,
            'r_category' =>  ResilienceFunctionCategoryResource::collection($this->resilienceFunctionCategorys),
        ];
    }
}
