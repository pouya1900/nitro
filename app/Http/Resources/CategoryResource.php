<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'        => $this->id,
            'title'     => $this->title,
            'colorCode' => $this->color_code ?? '',
            'icon'      => $this->getIconImageAttribute(),
            'createdAt' => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
