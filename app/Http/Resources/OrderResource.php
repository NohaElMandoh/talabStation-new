<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class OrderResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [

            'order_id' => $this->id,
            'client_name' => $this->client->name,
            'price' => $this->cost,
            'delivery_cost' => $this->delivery_cost,
            'total' => $this->total,
            'address' => $this->address,
            'phone' => $this->phone,
            'lat' => $this->client->lat,
            'lang' => $this->client->lang,
            'photo_url' => $this->client->photo_url,
            'created_at'=>$this->created_at->toDateString().' '.$this->created_at->format('g:i A'),
        ];
    }
}
