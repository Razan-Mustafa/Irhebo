<?php

namespace App\Services;

use App\Repositories\Interfaces\FinanceRepositoryInterface;

class FinanceService{

    protected $financeRepository;

    public function __construct(FinanceRepositoryInterface $financeRepository)
    {
        $this->financeRepository = $financeRepository;
    }

    public function getAll(){
        return $this->financeRepository->getAll();
    }
    public function bulkUpdate(array $data): void
{
    $financeIds = $data['finance_ids'];
    $this->financeRepository->markAsPaid($financeIds);
}

}
