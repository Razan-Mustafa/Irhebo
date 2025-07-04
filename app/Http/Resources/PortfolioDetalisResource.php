<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PortfolioDetalisResource extends JsonResource
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
            'user_id'=>$this->user_id,
            'title' => $this->title,
            'description' => $this->description,
            'media' => PortfolioMediaResource::collection($this->media),
            'service' => ServiceResource::collection($this->services),
        ];
    }
}
