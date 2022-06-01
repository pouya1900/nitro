<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
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
            'price'          => intval($this->price) ?? 0,
            'trackingNumber' => $this->tracking_number ?? "",
            'cardNumber'     => $this->card_number ?? "",
            'isSuccess'      => $this->is_success ?? 0,
            'createdAt'      => $this->created_at->format('Y-m-d H:i:s'),
        ];

    }
}
