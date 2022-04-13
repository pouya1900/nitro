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
            'id'         => $this->id,
            'price'      => intval($this->price) ?? 0,
            'transId'    => $this->trans_id ?? "",
            'orderId'    => $this->order_id ?? null,
            'cardNumber' => $this->card_number ?? "",
            'isSuccess'  => $this->is_success ?? 0,
        ];

    }
}
