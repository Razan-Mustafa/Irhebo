<?php

namespace App\Repositories\Eloquents;

use App\Models\Language;
use App\Traits\PaginateTrait;
use App\Repositories\Interfaces\LanguageRepositoryInterface;

class LanguageRepository implements LanguageRepositoryInterface
{
    use PaginateTrait;
    protected $model;

    public function __construct(Language $language)
    {
        $this->model = $language;
    }


    public function getAllActive($perPage = null)
    {
        return $this->model->where('is_active', true)->orderBy('title', 'asc')->get();
    }
}
