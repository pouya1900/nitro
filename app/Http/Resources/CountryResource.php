<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CountryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title ?? '',
            'enTitle' => $this->en_title ?? '',
//            'isoCode' => $this->iso_code ?? '',
            'isoCode3' => $this->iso_code3 ?? '',
            'flagLink' => $this->country->flagLink,
            'phoneCode' => $this->phone_code ?? null,
            'cities' => CityResource::collection($this->cities) ?? []
        ];
    }
}
