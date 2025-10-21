<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'products' => $this->getOrderItems($this->items),
            'order_date' => $this->webPresent()->orderDate,
            'status' => $this->status,
            'delivery_status' => $this->delivery_status,
            'factor_data' => [
                'order_amount' => $this->order_amount + $this->discount_amount,
                'delivery_amount' => $this->delivery_amount,
                'discount_amount' => $this->discount_amount,
                'total_amount' => $this->total_amount,
                'tax_amount' => $this->total_amount * 0.1,
                'order_date' => $this->updated_at
            ],
            'receiver_data' => !is_null($this->receiver) ? $this->getReceiverData($this->receiver) : null
        ];
    }

    private function getOrderItems($items)
    {
        $products = [];
        foreach ($items as $item){
            $products[] = [
              'id' => $item->product->id,
              'title' => $item->product->title,
              'image' => $item->product->webPresent()->image,
              'quantity' => $item->quantity
            ];
        }

        return $products;
    }

    private function getReceiverData($receiver)
    {
        return [
            'first_name' => $receiver->first_name,
            'last_name' => $receiver->last_name,
            'national_code' => $receiver->national_code,
            'mobile' => $receiver->mobile,
            'email' => $receiver->email,
            'address' => $receiver->address,
            'zip_code' => $receiver->zip_code
        ];
    }
}
