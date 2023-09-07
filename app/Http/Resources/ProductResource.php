<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\SelectedOptionResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name'=>$this->name,
            'image'=>'/storage/'.$this->image,
            'user name'=>$this->user?->name,
            'selected options'=> SelectedOptionResource::collection($this->whenLoaded('selectedOption'))
        ];
    }
}
