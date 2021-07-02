<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Psy\Util\Json;

class OfferTitleResource extends JsonResource
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

           
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'photo_url' => $this->photo_url,
            'type'=>$this->type->name_en
         
        ];
    }
}
