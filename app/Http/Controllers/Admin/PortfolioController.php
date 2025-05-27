<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PortfolioRequest;
use App\Http\Requests\Admin\UpdatePortfolioRequest;
use App\Services\FreelancerService;
use App\Services\PortfolioService;
use App\Services\ServiceService;
use Exception;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    protected $portfolioService;
    protected $serviceService;
    protected $freelancerService;

    public function __construct(PortfolioService $portfolioService, ServiceService $serviceService, FreelancerService $freelancerService)
    {
        $this->portfolioService = $portfolioService;
        $this->serviceService = $serviceService;
        $this->freelancerService = $freelancerService;
    }
    public function index()
    {
        $portfolios = $this->portfolioService->index();
        return view('pages.portfolios.index', compact('portfolios'));
    }
    public function create()
    {
        $freelancers = $this->freelancerService->index([]);
        return view('pages.portfolios.create', compact('freelancers'));
    }
    public function store(PortfolioRequest $request)
    {
        try {
            $this->portfolioService->create($request->validated());
            return redirect()->route('portfolios.index')
                ->with('success', __('portfolio_created_successfully'));
        } catch (Exception $e) {
            return redirect()->back()
                ->with('error', $e->getMessage())
                ->withInput();
        }
    }
    public function edit($id)
    {
        $portfolio = $this->portfolioService->getPortfolioDetails($id);
        $freelancers = $this->freelancerService->index([]);
        return view('pages.portfolios.edit', compact('portfolio', 'freelancers'));
    }
    public function update(UpdatePortfolioRequest $request, $id)
    {
        try {
            $this->portfolioService->update($request->validated(), $id);
            return redirect()->route('portfolios.index')
                ->with('success', __('portfolio_updated_successfully'));
        } catch (Exception $e) {
            return redirect()->back()
                ->with('error', $e->getMessage())
                ->withInput();
        }
    }
    public function show($id)
    {
        $portfolio = $this->portfolioService->getPortfolioDetails($id);
        return view('pages.portfolios.show', compact('portfolio'));
    }
    public function destroy($id)
    {
        $this->portfolioService->delete($id);
        return redirect()->route('portfolios.index')
            ->with('success', __('portfolio_deleted_successfully'));
    }
}
