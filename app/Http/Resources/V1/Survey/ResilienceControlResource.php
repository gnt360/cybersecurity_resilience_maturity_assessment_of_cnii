<?php

namespace App\Http\Resources\V1\Survey;

use Illuminate\Http\Resources\Json\JsonResource;

class ResilienceControlResource extends JsonResource
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
            'name' => $this->name,
            'r_function_category' => $this->resilienceFunctionCategory->name,
            'questions' => ResilienceMeasureResource::collection($this->resilienceMeasures),
        ];
    }
}
