<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
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
            'transaction_number' => $this->transaction_number,
            'date_received' => $this->date_received,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'supplier_id' => $this->supplier_id,
            'supplier' => $this->supplier,
            'created_at' => $this->created_at,
            'description' => $this->description,
            'updated_at' => $this->updated_at,
        ];
    }
}
