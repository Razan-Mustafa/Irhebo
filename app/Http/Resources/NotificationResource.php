<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'action' => $this->action,
            'action_id' => $this->action_id,
            'icon' => $this->icon,
            'is_general' => $this->is_general,
            'is_read' => optional($this->userNotifications->first())->is_read ?? false,
            'title' => $this->translation?->title,
            'description' => $this->translation?->description,
            'created_at' => Carbon::parse($this->created_at)->diffForHumans(),
        ];
    }
}
