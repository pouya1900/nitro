<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use function Couchbase\defaultDecoder;
use function Symfony\Component\Translation\t;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'title'         => $this->name,
            'description'   => $this->description ?? '',
            'categoryType'  => $this->category_type,
            'categoryTitle' => $this->category ? $this->category->title : null,
            'ratePerToman'  => $this->rate,
            'min'           => $this->min,
            'max'           => $this->max,
            'createdAt'     => $this->created_at->format('Y-m-d H:i:s'),
        ];

    }
}
