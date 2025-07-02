<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Enums\RequestStatusEnum;
use Illuminate\Http\Resources\Json\JsonResource;

class RequestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // dd($request->all());
        $startDate = Carbon::parse($this->start_date);
        $endDate = Carbon::parse($this->end_date);
        $currentDate = Carbon::now();

        $isValidDateRange = $startDate && $endDate && $startDate->lte($endDate);

        $elapsedDays = 0;
        $totalDays = 0;
        $progressPercentage = 0;

        if ($isValidDateRange) {
            $totalDays = abs($endDate->diffInDays($startDate));

            if ($currentDate->gte($startDate)) {
                $elapsedDays = min($totalDays, $startDate->diffInDays($currentDate));
            }

            $progressPercentage = $totalDays > 0 ? min(100, ($elapsedDays / $totalDays) * 100) : 0;
        }

        $isProgressStatus = in_array($this->status, ['confirmed', 'in_progress']);

        return [
            'id' => $this->id,
            'title' => $this->title,
            'image_url' => $this->image ? url($this->image) : null,
            'order_number' => $this->order_number,
            'start_date' => $isProgressStatus ? $startDate->toDateString() : null,
            'end_date' => $isProgressStatus ? $endDate->toDateString() : null,
            'elapsed_days' => $isProgressStatus ? round($elapsedDays) : null,
            'total_days' => $isProgressStatus ? intval($totalDays) : null,
            'progress_percentage' => round($progressPercentage),
            'created_at' => Carbon::parse($this->created_at)->toDayDateTimeString(),
            'created_since' => Carbon::parse($this->created_at)->diffForHumans(),
            'status_label' => RequestStatusEnum::tryFrom($this->status)?->label(),
            'status_key' => $this->status,
            'contract_path' => url($this->contract_path),
            'need_action'=>boolval($this->need_action)
        ];
    }
}
