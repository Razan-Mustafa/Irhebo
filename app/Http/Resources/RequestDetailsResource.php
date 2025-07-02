<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Enums\RequestStatusEnum;
use App\Models\Service;
use Illuminate\Http\Resources\Json\JsonResource;

class RequestDetailsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        $service = Service::with('user.languages.language')->find($this->service->id);
        $freelancer = $service->user;
        // dd($freelancer);

        return [
            'id' => $this->id,
            'title' => $this->title,
            'created_at' => Carbon::parse($this->created_at)->toDayDateTimeString(),
            'created_since' => Carbon::parse($this->created_at)->diffForHumans(),
            'status_key' => $this->status,
            'contract_path' => url($this->contract_path),
            'status_label' => RequestStatusEnum::tryFrom($this->status)?->label(),
            'is_reviewed' => $this->service->reviews()->where('user_id', $this->user_id)->exists(),
            'user' => new UserResource($this->user),
            'client' => new UserResource($this->user),
            'freelancer' => new UserResource($freelancer),
            'service' => new ServiceResource($this->service),
            'plan' => new PlanResource($this->plan),
            'logs' => RequestLogResource::collection($this->logs),
        ];
    }
}
