<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Enums\FreelancerStatusEnum;
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
        return [
             'id' => $this->id,
            'name' => $this->username,
            'email' => $this->email,
            'full_phone' => $this->full_phone,
            'prefix' => $this->prefix,
            'phone' => $this->phone,
            'gender' => $this->gender_label,
            'profession' => $this->profession->title ?? null,
            'country' => $this->country->title ?? null,
            'avatar' => $this->avatar ? url($this->avatar) : null,
            'role' => $this->freelancer ? 'freelancer' : 'client',
            'bio' => $this->freelancer->bio,
            'status' => FreelancerStatusEnum::tryFrom($this->freelancer->status)?->label(),
            'languages' => $this->languages->map(fn($lang) => [
                'id' => $lang->language->id,
                'title' => $lang->language->title,
                'flag' => $lang->language->flag,
                'level' => $lang->level,
            ]),
            'certificates'=>$this->certificates ? $this->certificates->map(function($certificate){
                return [
                    'id'=> $certificate->id,
                    'file_name'=>$certificate->file_name,
                    'file_path'=> $certificate->file_path ? url($certificate->file_path) : null,
                    'description'=>$certificate->description
                ]; 
            }) : null
        ];
    }
}

