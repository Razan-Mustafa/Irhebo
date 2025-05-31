<?php

namespace App\Services;

use App\Http\Resources\FaqResource;
use App\Http\Resources\SliderResource;
use App\Http\Resources\ServiceResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\PortfolioResource;
use App\Http\Resources\QuotationResource;
use App\Http\Resources\RequestResource;
use Illuminate\Support\Facades\Auth;

class HomeService
{
    public function __construct(
        private readonly ServiceService $serviceService,
        private readonly SliderService $sliderService,
        private readonly CategoryService $categoryService,
        private readonly NotificationService $notificationService,
        private readonly PortfolioService $portfolioService,
        private readonly FaqService $faqService,
        private readonly QuotationService $quotationService,
        private readonly RequestService $requestService
    ) {}

    public function getSliders($platform)
    {
        return $this->sliderService->getAllByPlatform($platform);
    }

    public function getHomeMobileData()
    {
        return [
            'categories' => CategoryResource::collection($this->categoryService->getAllActive($isPopular = 1)),
            'recommended_services' => ServiceResource::collection($this->serviceService->getRecommendedServices($perPage = 10)['data']),
            'featured_portfolios' => [
                'data' => PortfolioResource::collection($this->portfolioService->getFeaturedPortfolios($perPage = 10)['data']),
                'meta' => $this->portfolioService->getFeaturedPortfolios(10)['meta']
            ],
        ];
    }

    public function getHomePageData()
    {
        return [
            'sliders' => SliderResource::collection($this->getSliders('web')),
            'categories' => CategoryResource::collection($this->categoryService->getAllActive($isPopular = 0)),
            'recommended_services' => ServiceResource::collection($this->serviceService->getRecommendedServices(10)['data']),
            'featured_portfolios' => [
                'data' => PortfolioResource::collection($this->portfolioService->getFeaturedPortfolios(10)['data']),
                'meta' => $this->portfolioService->getFeaturedPortfolios(10)['meta']
            ],
            'faqs' => FaqResource::collection($this->faqService->index()),
        ];
    }
    public function getHomeFreelancerData(){
        $userId = Auth::id();
        return [
            'requests' => RequestResource::collection($this->requestService->getByFreelancer()['data']),
            'services'=> ServiceResource::collection($this->serviceService->getServicesByUserId($userId,$perPage = 3)['data']),
            'portfolios'=>PortfolioResource::collection($this->portfolioService->getPortfolioByUserId($userId,$perPage = 3)['data']),
            'quotations' => QuotationResource::collection($this->quotationService->getAllQuotations($perPage = 10)['data'])

        ];
    }

    public function getUnreadNotifications()
    {
        return $this->notificationService->getUnreadNotifications();
    }

    public function getUnreadMessages()
    {
        return 2;
    }
}
