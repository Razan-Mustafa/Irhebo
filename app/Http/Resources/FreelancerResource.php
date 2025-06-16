<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Enums\FreelancerStatusEnum;
use App\Models\PlayerId;
use Illuminate\Http\Resources\Json\JsonResource;

class FreelancerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $langCode = request()->header('Accept-Language', 'en'); // default 'en'
        $titleField = 'title_' . $langCode;

        $is_notifiable = PlayerId::where('user_id',$this->id)->where('player_id',$request->player_id)->value('is_notifiable');
        // dd($is_notifiable);
        // dd($this->categories->translation);
        return [
            'id' => $this->id,
            'name' => $this->username,
            'email' => $this->email,
            'full_phone' => $this->full_phone,
            'prefix' => $this->prefix,
            'phone' => $this->phone,
            'gender' => $this->gender_label,
            'is_notifiable' => $is_notifiable,
            'profession' => $this->profession->translation->title ?? null,
            'categories' => $this->categories
                ->unique('id')   // عشان يفلتر على حسب الـ id ويشيل التكرار
                ->map(function ($category) {
                    return [
                        'id' => $category->id,
                        'title' => $category->translation?->title
                            ?? $category->translations()->where('language', 'en')->first()?->title
                            ?? 'No title',
                    ];
                }),

            'country' => $this->country->title ?? null,
            'avatar' => $this->avatar ? url($this->avatar) : null,
            'role' => $this->freelancer ? 'freelancer' : 'client',
            'bio' => $this->freelancer->bio,
            'status' => FreelancerStatusEnum::tryFrom($this->freelancer->status)?->label(),
            'languages' => $this->languages->map(fn($lang) => [
                'id' => $lang->language->id,
                'title' => $lang->language->{$titleField} ?? $lang->language->title_en,
                'flag' => $lang->language->flag,
                'level' => $lang->level,
            ]),
            'certificates' => $this->certificates ? $this->certificates->map(function ($certificate) {
                return [
                    'id' => $certificate->id,
                    'file_name' => $certificate->file_name,
                    'file_path' => $certificate->file_path ? url($certificate->file_path) : null,
                    'description' => $certificate->description
                ];
            }) : null
        ];
    }
}
