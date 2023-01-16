<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class IdentityResource extends JsonResource
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
            'sector' => $this->sector,
            'organisation' => $this->organisation,
            'code' => strtoupper($this->code),
            'assets' => number_format((float)$this->assets, 2, '.', ''),
            'governance' => number_format((float)$this->governance, 2, '.', ''),
            'risk_management' => number_format((float)$this->risk_management, 2, '.', ''),
            'business_environment' => number_format((float)$this->business_environment, 2, '.', ''),
            'risk_management_strategy' => number_format((float)$this->risk_management_strategy, 2, '.', ''),
        ];
    }
}
