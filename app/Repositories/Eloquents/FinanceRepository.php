<?php

namespace App\Repositories\Eloquents;

use App\Enums\PaymentStatusEnum;
use App\Models\Finance;

use App\Repositories\Interfaces\FinanceRepositoryInterface;

class FinanceRepository implements FinanceRepositoryInterface
{
    protected $model;
    public function __construct(Finance $model)
    {
        $this->model = $model;
    }
    public function getAll()
    {
        return $this->model->with('request.user', 'request.service.user')->orderBy('id', 'DESC')->get();
    }
    public function getForFreelancer()
    {
        $userId = auth()->id();

        return $this->model
            ->whereHas('request.service', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->with(['request.user', 'request.service.user'])  // note: 'services' plural
            ->orderBy('id', 'DESC')
            ->get();
    }

    public function markAsPaid(array $ids)
    {
        return $this->model->whereIn('id', $ids)->update([
            'payment_status' => PaymentStatusEnum::PAID,
            'paid_at' => now()->toDateTimeString()
        ]);
    }
}
