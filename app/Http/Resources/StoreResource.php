<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StoreResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'type' => $this->type,
            'full_address' => "{$this->address1} {$this->address2} {$this->address3} {$this->address4}",
            'phone_number' => $this->phone_number,
            'email' => $this->email,
            'status' => $this->status,
        ];
    }
}
