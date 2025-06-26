<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PortfolioRequest;
use App\Http\Requests\Admin\UpdatePortfolioRequest;
use App\Models\Notification;
use App\Models\PlayerId;
use App\Services\FreelancerService;
use App\Services\OneSignalService;
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
            $portfolio = $this->portfolioService->create($request->validated());


            // one signal notification
            // dd($portfolio->user);
            $user = $portfolio->user;
            if ($user) {
                $playerIdRecord = PlayerId::where('user_id', $user->id)
                    ->where('is_notifiable', 1)
                    ->pluck('player_id')->toArray();


                if ($playerIdRecord) {
                    $titles = [
                        'en' => __('new_portfolio_entry_title', [], 'en'),
                        'ar' => __('new_portfolio_entry_title', [], 'ar'),
                    ];

                    $messages = [
                        'en' => __('new_portfolio_entry_message', [], 'en'),
                        'ar' => __('new_portfolio_entry_message', [], 'ar'),
                    ];

                    $response = app(OneSignalService::class)->sendNotificationToUser(
                        $playerIdRecord, // نرسل player_id من جدول player_ids
                        $titles,
                        $messages,
                        'portfolio',
                        $portfolio->id
                    );

                    Notification::create([
                        'user_id'           => $user->id,
                        'title'             => json_encode($titles),
                        'body'              => json_encode($messages),
                        'type'              => 'portfolio',
                        'type_id'           => $portfolio->id,
                        'is_read'           => false,
                        'onesignal_id'      => $response['id'] ?? null,
                        'response_onesignal' => json_encode($response),
                    ]);
                }
            }
            // *********************************************//
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
