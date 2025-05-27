<?php

namespace App\Http\Resources;

use App\Models\Currency;
use Illuminate\Http\Request;
use App\Utilities\CurrencyConverter;
use Illuminate\Http\Resources\Json\JsonResource;

class PlanResource extends JsonResource
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
            'title' => $this->translation->title,
            'features' => $this->features->map(function ($feature) {
                return [
                    'id' => $feature->id,
                    'title' => $feature->translation->title,
                    'value' => $feature->value,
                ];
            }),
        ];
    }
}
