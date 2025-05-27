<?php

namespace App\Repositories\Interfaces;

interface FinanceRepositoryInterface
{
    public function getAll();
    public function markAsPaid(array $data);




}
