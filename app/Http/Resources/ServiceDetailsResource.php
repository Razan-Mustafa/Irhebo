<?php

namespace App\Http\Resources;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use App\Utilities\CurrencyConverter;
use App\Models\Currency;

class ServiceDetailsResource extends JsonResource
{
    protected $avgUserRate;

    /**
     * Constructor to pass additional data.
     */
    public function __construct($resource, $avgUserRate = null)
    {
        parent::__construct($resource);
        $this->avgUserRate = $avgUserRate;
    }

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $userId = Auth::guard('api')->id();
        $coverMedia = $this->media->where('is_cover', true)->first();
        $isWishlist = $userId
            ? Wishlist::where('user_id', $userId)->where('service_id', $this->id)->exists()
            : false;

        $minPrice = 100;
        $currencyCode = $request->header('currency', 'USD');
        $currencyModel = Currency::where('code', strtoupper($currencyCode))->first();
        $symbol = $currencyModel ? $currencyModel->symbol : '$';
        $convertedPrice = $minPrice
            ? CurrencyConverter::convert($minPrice, 'USD', $currencyCode)
            : null;

        return [
            'id' => $this->id,
            'sub_category_id' => $this->sub_category_id,
            'title' => $this->translation?->title,
            'description' => $this->translation?->description,
            'cover' => $coverMedia ? url($coverMedia->media_path) : null,
            'is_recommended' => boolval($this->is_recommended),
            'is_wishlist' => boolval($isWishlist),
            'rating' => $this->rating,
            'start_service_from' => $convertedPrice
                ? number_format((float)$convertedPrice, 2) . $symbol
                : null,
            'user' => $this->user ? [
                'id' => $this->user->id,
                'username' => $this->user->username,
                'avatar' => $this->user->avatar ? url($this->user->avatar) : null,
                'profession' => $this->user->profession
                    ? $this->user->profession->translation->title
                    : null,
                'avg_rate' =>(int) round($this->avgUserRate),
            ] : null,
            'media' => ServiceMediaResource::collection($this->media),
        ];
    }
}
