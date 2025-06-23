<?php

namespace App\Http\Resources;

use App\Models\Wishlist;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use App\Utilities\CurrencyConverter;
use App\Models\Currency;
use App\Models\PlanFeature;

class ServiceResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $userId = Auth::guard('api')->id();
        $coverMedia = $this->media->where('is_cover', true)->first();
        $isWishlist = $userId ? Wishlist::where('user_id', $userId)->where('service_id', $this->id)->exists() : false;
        $minPrice = PlanFeature::where('service_id', $this->id)
            ->where('type', 'price')
            ->min('value');
        $currencyCode = $request->header('currency', 'USD');
        $currencyModel = Currency::where('code', strtoupper($currencyCode))->first();
        $symbol = $currencyModel ? $currencyModel->symbol : '$';
        $convertedPrice = $minPrice ? CurrencyConverter::convert($minPrice, 'USD', $currencyCode) : null;
        return [
            'id' => $this->id,
            'sub_category_id' => $this->sub_category_id,
            'title' => $this->translation?->title,
            'description' => $this->translation?->description,
            'cover' => $coverMedia ? url($coverMedia->media_path) : null,
            'is_recommended' => boolval($this->is_recommended),
            'is_wishlist' => boolval($isWishlist),
            'rating' => $this->rating,
            'start_service_from' => $convertedPrice ? number_format((float)$convertedPrice, 2) . $symbol: null,
            'user' => $this->user ? [
                'id' => $this->user->id,
                'username' => $this->user->username,
                'profession' => $this->user->profession->translation->title,
                'avatar' => $this->user->avatar ? url($this->user->avatar) : null,
            ] : null,
        ];
    }
}
