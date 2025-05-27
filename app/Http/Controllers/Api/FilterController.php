<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\FilterService;
use App\Http\Controllers\Controller;
use App\Http\Resources\FilterResource;
use App\Services\ServiceService;

class FilterController extends Controller
{
    protected $filterService;
    protected $serviceService;

    public function __construct(FilterService $filterService,ServiceService $serviceService)
    {
        $this->filterService = $filterService;
        $this->serviceService = $serviceService;
    }
    public function getFiltersByCategoryId(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
        ]);
        $filters = $this->filterService->getFiltersByCategoryId($request->category_id);
        return $this->successResponse(__('success'), FilterResource::collection($filters));
    }
    public function applyFilters(Request $request){

        $filters = $request->input('filters');
        // return $this->serviceService->getResultFilter($filters);
        return $this->successResponse(__('success',[]));
    }

}
