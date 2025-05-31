<?php

namespace App\Http\Resources;

use App\Models\Quotation_Comments;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use App\Utilities\CurrencyConverter;
use App\Models\Currency;

class QuotationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $disabledComment = Quotation_Comments::where('user_id', Auth::id())
            ->where('quotation_id', $this->id)
            ->exists();


        $currencyCode = $request->header('currency', 'USD');
        $currencyModel = Currency::where('code', strtoupper($currencyCode))->first();
        $symbol = $currencyModel ? $currencyModel->symbol : '$';
        $convertedPrice = $this->price
            ? CurrencyConverter::convert($this->price, 'USD', $currencyCode)
            : null;

        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'price' => $convertedPrice ? number_format($convertedPrice, 2) . $symbol  : null,

            'delivery_day' => $this->delivery_day,
            'revisions' => $this->revisions,
            'source_file' => (bool) $this->source_file,
            'user' => $this->user ? [
                'id' => $this->user->id,
                'username' => $this->user->username,
                'avatar' => $this->user->avatar ? url($this->user->avatar) : null,
                'profession' => optional(optional($this->user->profession)->translation)->title,
            ] : null,
            'created_at' => Carbon::parse($this->created_at)->toDayDateTimeString(),
            'updated_at' => Carbon::parse($this->updated_at)->toDayDateTimeString(),
            'disabled_comment' => $disabledComment,
        ];
    }
}
