<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\FilterService;
use App\Http\Controllers\Controller;
use App\Http\Resources\FilterResource;
use App\Http\Resources\ServiceDetailsResource;
use App\Http\Resources\ServiceResource;
use App\Models\PlanFeature;
use App\Models\Service;
use App\Services\ServiceService;
use Illuminate\Support\Facades\DB;
use App\Utilities\CurrencyConverter;
use App\Models\Currency;

class FilterController extends Controller
{
    protected $filterService;
    protected $serviceService;

    public function __construct(FilterService $filterService, ServiceService $serviceService)
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
    // public function applyFilters(Request $request)
    // {

    //     $filters = $request->input('filters');
    //     return $this->serviceService->getResultFilter($filters);
    //     return $this->successResponse(__('success', []));
    // }
    // public function applyFilters(Request $request)
    // {
    //     $filters = $request->input('filters', []);

    //     $serviceIds = null;

    //     foreach ($filters as $filter) {
    //         $query = PlanFeature::query();

    //         if (isset($filter['filter_type'])) {
    //             $type = $filter['filter_type'];
    //             $min = $filter['min'] ?? 0;
    //             $max = $filter['max'] ?? 999999;

    //             $query->where('type', $type)
    //                 ->whereBetween(DB::raw('CAST(value AS DECIMAL(10,2))'), [$min, $max]);
    //         }

    //         if (isset($filter['source_files']) && $filter['source_files'] === true) {
    //             $query->where('type', 'source_files')
    //                 ->where('value', 1);
    //         }

    //         $ids = $query->pluck('service_id')->unique();

    //         if (is_null($serviceIds)) {
    //             $serviceIds = $ids;
    //         } else {
    //             $serviceIds = $serviceIds->intersect($ids);
    //         }
    //     }

    //     if (empty($filters)) {
    //         $services = Service::with(['media', 'user.profession.translation'])->get();
    //     } elseif ($serviceIds && $serviceIds->isNotEmpty()) {
    //         $services = Service::with(['media', 'user.profession.translation'])
    //             ->whereIn('id', $serviceIds)
    //             ->get();
    //     } else {
    //         $services = collect();
    //     }

    //     return $this->successResponse(__('success'), ServiceResource::collection($services));
    // }


    public function applyFilters(Request $request)
    {
        $filters = $request->input('filters', []);

        // Get currency from header
        $currencyCode = $request->currency;
        $currencyModel = Currency::where('code', strtoupper($currencyCode))->first();
        $fromCurrency = $currencyModel ? $currencyModel->code : 'USD';

        $serviceIds = null;

        foreach ($filters as $filter) {
            $query = PlanFeature::query();

            if (isset($filter['filter_type'])) {
                $type = $filter['filter_type'];
                $min = $filter['min'] ?? 0;
                $max = $filter['max'] ?? 999999;

                if ($type === 'price') {
                    $convertedMin = CurrencyConverter::convert($min, $fromCurrency, 'USD');
                    $convertedMax = CurrencyConverter::convert($max, $fromCurrency, 'USD');
                } else {
                    $convertedMin = $min;
                    $convertedMax = $max;
                }

                $query->where('type', $type)
                    ->whereBetween(DB::raw('CAST(value AS DECIMAL(10,2))'), [$convertedMin, $convertedMax]);
            }

            if (isset($filter['source_files']) && $filter['source_files'] === true) {
                $query->where('type', 'source_files')
                    ->where('value', 1);
            }

            $ids = $query->pluck('service_id')->unique();

            if (is_null($serviceIds)) {
                $serviceIds = $ids;
            } else {
                $serviceIds = $serviceIds->intersect($ids);
            }
        }

        // Search keyword from request
        $search = $request->input('search');

        // Base query for services
        $servicesQuery = Service::with(['media', 'user.profession.translation']);

        if ($serviceIds && $serviceIds->isNotEmpty()) {
            $servicesQuery->whereIn('id', $serviceIds);
        } elseif (!empty($filters)) {
            // If filters exist but no matching services, return empty
            $services = collect();
            return $this->successResponse(__('success'), ServiceResource::collection($services));
        }

        // Apply search if exists
        if ($search) {
            $servicesQuery->whereHas('translation', function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            });
        }
        $services = $servicesQuery->get();

        return $this->successResponse(__('success'), ServiceResource::collection($services));
    }
}
