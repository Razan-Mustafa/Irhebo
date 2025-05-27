<?php

namespace App\Http\Controllers\Api;

use App\Models\General;
use Illuminate\Http\Request;
use App\Enums\LanguageLevelEnum;
use App\Services\CountryService;
use App\Services\LanguageService;
use App\Services\ProfessionService;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use App\Http\Resources\CountryResource;
use App\Http\Resources\LanguageResource;
use App\Http\Resources\PlanResource;
use App\Http\Resources\ProfessionResource;
use App\Services\NotificationService;
use App\Services\PlanService;

class SharedController extends Controller
{
   protected $countryService;
   protected $languageService;
   protected $professionService;
   protected $notificationService;
   protected $planService;
   public function __construct(CountryService $countryService, LanguageService $languageService, ProfessionService $professionService, NotificationService $notificationService,PlanService $planService)
   {
      $this->countryService = $countryService;
      $this->languageService = $languageService;
      $this->professionService = $professionService;
      $this->notificationService = $notificationService;
      $this->planService = $planService;
   }
   public function getCountries()
   {
      $perPage = request('per_page', null);
      $search = request('search', null);

      $countries = $this->countryService->getAllActive($perPage, $search);

      return $this->successResponse(__('countries_retrieved'), [
         'countries' => CountryResource::collection($countries['data']),
         'meta' => $countries['meta'],
      ]);
   }

   public function getLanguages()
   {
      $perPage = request('per_page', null);
      $languages = $this->languageService->getAllActive($perPage);
      return $this->successResponse(__('languages_retrieved'), [
         'languages' => LanguageResource::collection($languages['data']),
         'levels' => collect(LanguageLevelEnum::cases())->map(fn($level) => [
            'key' => $level->value,
            'value' => $level->label(),
         ])->values(),
         'meta' => $languages['meta'],
      ]);
   }
   public function getRegisterData()
   {
      $countries = $this->countryService->getAllActive();
      $languages = $this->languageService->getAllActive();
      $professions = $this->professionService->getAllActive();
      return $this->successResponse(__('general_data_retrieved'), [
         'professions' => ProfessionResource::collection($professions),
         'countries' => CountryResource::collection($countries),
         'languages' => [
            'data' => LanguageResource::collection($languages),
            'levels' => collect(LanguageLevelEnum::cases())->map(fn($level) => [
               'key' => $level->value,
               'value' => $level->label(),
            ])->values(),
           
         ],
      ]);
   }
   public function generalData(Request $request)
   {
      $locale = $request->header('Accept-Language', App::getLocale());
      $settings = General::all()->mapWithKeys(function ($setting) use ($locale) {
         $key = $setting->key;
         if (preg_match('/_(en|ar)$/', $key, $matches)) {
            $baseKey = str_replace($matches[0], '', $key);
            if ($matches[1] === $locale) {
               return [$baseKey => $setting->value];
            }
         } else {
            return [$key => $setting->value];
         }
         return [];
      });
      $settings['unread_notifications'] = $this->notificationService->getUnreadNotifications();
      $settings['unread_messages'] = 2;
      return $this->successResponse(__('general_data_retrieved'), $settings);
   }
   public function getPlans(){
      $plans = $this->planService->index();
      return $this->successResponse('success',PlanResource::collection($plans));
   }
}
