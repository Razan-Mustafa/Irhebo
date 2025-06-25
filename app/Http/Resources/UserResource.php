<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Enums\FreelancerStatusEnum;
use App\Models\PlayerId;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        $langCode = request()->header('Accept-Language', 'en'); // default 'en'
        $is_notifiable = PlayerId::where('user_id', $this->id)->where('player_id', $request->player_id)->value('is_notifiable');

        $titleField = 'title_' . $langCode;
        $data = [
            'id' => $this->id,
            'name' => $this->username,
            'verified_at' => $this->verified_at,
            'email' => $this->email,
            'full_phone' => $this->full_phone,
            'prefix' => $this->prefix,
            'phone' => $this->phone,
            'gender' => $this->gender_label,
            'is_notifiable' => $is_notifiable,
            'profession' => $this->profession->translation->title ?? null,
            'profession_object' => [
                'id' => $this->profession->id ?? null,
                'title' => $this->profession->translation->title ?? null,
            ],
            'country' => $this->country->title ?? null,
            'country_object' => [
                'id' => $this->country->id ?? null,
                'title' => $this->country->title ?? null,
            ],
            'avatar' => $this->avatar ? url($this->avatar) : null,
            'role' => $this->freelancer ? 'freelancer' : 'client',
            'languages' => $this->languages->map(fn($lang) => [
                'id' => $lang->language->id,
                'title' => $lang->language->{$titleField} ?? $lang->language->title_en,
                'flag' => $lang->language->flag,
                'level' => $lang->level,
            ])
        ];

        return $data;
    }
}
