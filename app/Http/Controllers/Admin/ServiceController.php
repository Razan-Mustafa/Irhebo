<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ServiceRequest;
use App\Http\Requests\Admin\UpdateServiceRequest;
use App\Models\Currency;
use App\Models\Notification;
use App\Models\Plan;
use App\Models\PlayerId;
use App\Models\Service;
use App\Services\CategoryService;
use App\Services\FreelancerService;
use App\Services\OneSignalService;
use App\Services\PlanService;
use App\Services\ServiceService;
use App\Services\TagService;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    protected $serviceService;
    protected $categoryService;
    protected $freelancerService;
    protected $tagService;
    protected $planService;
    public function __construct(ServiceService $serviceService, CategoryService $categoryService, FreelancerService $freelancerService, TagService $tagService, PlanService $planService)
    {
        $this->serviceService = $serviceService;
        $this->categoryService = $categoryService;
        $this->freelancerService = $freelancerService;
        $this->tagService = $tagService;
        $this->planService = $planService;
    }

    public function index()
    {
        $services = $this->serviceService->index();
        $categories = $this->categoryService->index();
        $freelancers = $this->freelancerService->index([]);
        return view('pages.services.index', compact('services', 'categories', 'freelancers'));
    }
    public function create()
    {
        $categories = $this->categoryService->index();
        $tags = $this->tagService->getAllTags();
        $plans = $this->planService->index();
        $freelancers = $this->freelancerService->index([]);
        $currencies = Currency::all();

        return view('pages.services.create', compact('categories', 'tags', 'plans', 'freelancers', 'currencies'));
    }
    public function store(UpdateServiceRequest $request)
    {
        // dd($request->all());

        $data = $request->validated();
        $currency = Currency::find($data['currency_id']);
        $exchangeRate = $currency->exchange_rate;

        foreach ($data['plans'] as &$plan) {
            foreach ($plan['features'] as &$feature) {
                if ($feature['type'] === 'price') {
                    $feature['value'] = number_format($feature['value'] / $exchangeRate, 2, '.', '');
                }
            }
        }

        $service = $this->serviceService->create($data);
        $service->tags()->sync($data['tags'] ?? []);


        // one signal notification
        // dd($service->user);
        $user = $service->user;
        if ($user) {
            $playerIdRecord = PlayerId::where('user_id', $user->id)
                ->where('is_notifiable', 1)
                ->pluck('player_id')->toArray();


            if ($playerIdRecord) {
                $titles = [
                    'en' => __('new_service_added_title', [], 'en'),
                    'ar' => __('new_service_added_title', [], 'ar'),
                ];

                $messages = [
                    'en' => __('new_service_added_message', [], 'en'),
                    'ar' => __('new_service_added_message', [], 'ar'),
                ];

                $response = app(OneSignalService::class)->sendNotificationToUser(
                    $playerIdRecord, // نرسل player_id من جدول player_ids
                    $titles,
                    $messages
                );

                Notification::create([
                    'user_id'           => $user->id,
                    'title'             => json_encode($titles),
                    'body'              => json_encode($messages),
                    'type'              => 'service',
                    'type_id'           => $service->id,
                    'is_read'           => false,
                    'onesignal_id'      => $response['id'] ?? null,
                    'response_onesignal' => json_encode($response),
                ]);
            }
        }
        // *********************************************//
        return redirect()->route('services.index')->with('success', __('service_created_successfully'));
    }
    public function edit($id)
    {
        $categories = $this->categoryService->index();
        $service = $this->serviceService->getServiceDetails($id);
        $tags = $service->tags()->pluck('tags.id')->toArray();
        $selectedTags = $service->tags()->pluck('tags.id')->toArray();

        $servicePlans = $this->serviceService->getPlansByServiceId($id);
        $plans = $this->planService->index();
        $freelancers = $this->freelancerService->index([]);
        $currencies = Currency::all();

        $plansCount = Plan::count();
        return view('pages.services.edit', compact('selectedTags', 'categories', 'tags', 'plans', 'servicePlans', 'freelancers', 'service', 'plansCount',    'currencies'));
    }
    public function update(UpdateServiceRequest $request, $id)
    {
        $data = $request->validated();
        // dd($data);
        $currency = Currency::find($data['currency_id']);
        $exchangeRate = $currency->exchange_rate;

        foreach ($data['plans'] as &$plan) {
            foreach ($plan['features'] as &$feature) {
                if ($feature['type'] === 'price') {
                    $feature['value'] = number_format($feature['value'] / $exchangeRate, 2, '.', '');
                }
            }
        }
        // احفظ التعديلات
        $service = $this->serviceService->update($data, $id);
        $service = Service::findOrFail($id);
        $service->update([
            'user_id' => $data['user_id'] ?? $service->user_id, // لو موجود
        ]);
        $service->tags()->sync($data['tags'] ?? []);

        return redirect()->route('services.index')->with('success', __('service_updated_successfully'));
    }

    public function destroy($id)
    {
        $this->serviceService->delete($id);
        return redirect()->route('services.index')->with('success', __('service_deleted_successfully'));
    }

    public function toggleRecommended(Request $request)
    {    \Log::info('Request Data:', $request->all());

        $request->validate([
            'id' => 'required|exists:services,id',
        ]);

        $service = Service::findOrFail($request->id);
        $service->is_recommended = !$service->is_recommended;
        $service->save();

        // بدل redirect، نرجع JSON response
        return response()->json([
            'success' => true,
            'message' => __('service_updated_successfully'),
        ]);
    }
}
