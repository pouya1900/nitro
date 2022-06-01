<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'id'          => $this->id,
            'fullName'    => $this->full_name ?? '',
            'phoneNumber' => $this->mobile,
            'profilePic'  => $this->avatar,
            'balance'     => $this->balance,
            'createdAt'   => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
