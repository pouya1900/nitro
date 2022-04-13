<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use function Couchbase\defaultDecoder;
use function Symfony\Component\Translation\t;

class OrderResource extends JsonResource
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
            'id'             => $this->id,
            'link'           => $this->link,
            'title'          => $this->product->name,
            'description'    => $this->product->description ?? '',
            'categoryType'   => $this->product->category_type,
            'categoryTitle'  => $this->product->category->title,
            'price'          => $this->price,
            'count'          => $this->count,
            'status'         => $this->status ?? 0,
            'payed'          => $this->payed ?? 0,
            'trackingNumber' => $this->tracking_number,
            'createdAt'      => $this->created_at->format('Y-m-d H:i:s'),
        ];

    }
}
