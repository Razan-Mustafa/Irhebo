<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\FilterController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\TicketController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\GeneralController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CurrencyController;
use App\Http\Controllers\Admin\FeatureController;
use App\Http\Controllers\Admin\FinanceController;
use App\Http\Controllers\Admin\PortfolioController;
use App\Http\Controllers\Admin\FreelancerController;
use App\Http\Controllers\Admin\ProfessionController;
use App\Http\Controllers\Admin\QuotationController;
use App\Http\Controllers\Admin\RequestController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Models\Currency;

Route::get('language/{locale}', [HomeController::class, 'changeLocale'])
    ->name('locale.change')
    ->whereIn('locale', config('app.supported_locales', ['en', 'ar']));
// Guest Routes
Route::middleware('guest:admin')->group(function ($route) {
    $route->get('', [AuthController::class, 'showLoginForm'])->name('login');
    $route->post('login', [AuthController::class, 'login'])->name('login.submit');
});
// Protected Routes
Route::middleware(['auth:admin', 'admin'])->group(function ($route) {
    $route->post('logout', [AuthController::class, 'logout'])->name('logout');
    $route->get('home', [HomeController::class, 'index'])->name('home.index');
    $route->controller(HomeController::class)->name('home.')->group(function ($route) {
        $route->get('home', 'index')->name('index');
    });
    $route->controller(AdminController::class)->name('admins.')->prefix('admins')->group(function ($route) {
        $route->get('', 'index')->name('index');
        $route->get('create', 'create')->name('create');
        $route->post('store', 'store')->name('store');
        $route->get('edit/{id}', 'edit')->name('edit');
        $route->put('update/{id}', 'update')->name('update');
        $route->delete('destroy/{id}', 'destroy')->name('destroy');
        $route->post('update-activation', 'updateActivation')->name('updateActivation');
    });
    $route->controller(RoleController::class)->name('roles.')->prefix('roles')->group(function ($route) {
        $route->get('', 'index')->name('index');
        $route->get('create', 'create')->name('create');
        $route->post('store', 'store')->name('store');
        $route->get('edit/{id}', 'edit')->name('edit');
        $route->put('update/{id}', 'update')->name('update');
        $route->delete('destroy/{id}', 'destroy')->name('destroy');
    });
    $route->controller(ClientController::class)->name('clients.')->prefix('clients')->group(function ($route) {
        $route->get('', 'index')->name('index');
        $route->get('create', 'create')->name('create');
        $route->post('store', 'store')->name('store');
        $route->post('update-activation', 'updateActivation')->name('updateActivation');
        $route->delete('destroy/{id}', 'destroy')->name('destroy');
        $route->post('update-activation', 'updateActivation')->name('updateActivation');
        $route->get('show/{id}', 'show')->name('show');
        $route->get('archived', 'archived')->name('archived');
        $route->post('/{id}/restore', 'restore')->name('restore');
    });
    $route->controller(FreelancerController::class)->name('freelancers.')->prefix('freelancers')->group(function ($route) {
        $route->get('', 'index')->name('index');
        $route->get('create', 'create')->name('create');
        $route->post('store', 'store')->name('store');
        $route->post('update-activation', 'updateActivation')->name('updateActivation');
        $route->get('show/{id}', 'show')->name('show');
        $route->delete('destroy/{id}', 'destroy')->name('destroy');
        $route->post('update-activation', 'updateActivation')->name('updateActivation');
        $route->post('update-verification', 'updateVerification')->name('updateVerification');
        $route->get('archived', 'archived')->name('archived');
        $route->post('/{id}/restore', 'restore')->name('restore');
    });
    $route->controller(ProfessionController::class)->name('professions.')->prefix('professions')->group(function ($route) {
        $route->get('', 'index')->name('index');
        $route->get('create', 'create')->name('create');
        $route->post('store', 'store')->name('store');
        $route->get('edit/{id}', 'edit')->name('edit');
        $route->put('update/{id}', 'update')->name('update');
        $route->delete('destroy/{id}', 'destroy')->name('destroy');
        $route->post('update-activation', 'updateActivation')->name('updateActivation');
    });
    $route->controller(CountryController::class)->name('countries.')->prefix('countries')->group(function ($route) {
        $route->get('', 'index')->name('index');
        $route->get('create', 'create')->name('create');
        $route->post('store', 'store')->name('store');
        $route->get('edit/{id}', 'edit')->name('edit');
        $route->put('update/{id}', 'update')->name('update');
        $route->delete('destroy/{id}', 'destroy')->name('destroy');
        $route->post('update-activation', 'updateActivation')->name('updateActivation');
    });
    $route->controller(SliderController::class)->name('sliders.')->prefix('sliders')->group(function ($route) {
        // Web sliders
        $route->get('web-sliders', 'webSliders')->name('webSliders');
        $route->get('create-web-sliders', 'createWebSliders')->name('createWebSliders');
        $route->post('store-web-slider', 'storeWebSlider')->name('storeWebSlider');
        $route->get('edit-web-sliders/{id}', 'editWebSliders')->name('editWebSliders');
        $route->put('update-web-slider/{id}', 'updateWebSlider')->name('updateWebSlider');

        // Mobile sliders
        $route->get('mobile-sliders', 'mobileSliders')->name('mobileSliders');
        $route->get('create-mobile-sliders', 'createMobileSliders')->name('createMobileSliders');
        $route->post('store-mobile-slider', 'storeMobileSlider')->name('storeMobileSlider');
        $route->get('edit-mobile-sliders/{id}', 'editMobileSliders')->name('editMobileSliders');
        $route->put('update-mobile-slider/{id}', 'updateMobileSlider')->name('updateMobileSlider');

        // Common routes
        $route->get('show/{id}', 'show')->name('show');
        $route->delete('destroy/{id}', 'destroy')->name('destroy');
        $route->post('update-activation', 'updateActivation')->name('updateActivation');
    });
    $route->controller(CategoryController::class)->name('categories.')->prefix('categories')->group(function ($route) {
        $route->get('', 'index')->name('index');
        $route->get('create', 'create')->name('create');
        $route->post('store', 'store')->name('store');
        $route->get('edit/{id}', 'edit')->name('edit');
        $route->put('update/{id}', 'update')->name('update');
        $route->get('show/{id}', 'show')->name('show');
        $route->delete('destroy/{id}', 'destroy')->name('destroy');
        $route->post('update-activation', 'updateActivation')->name('updateActivation');
        $route->post('update-popular-status', 'updatePopularStatus')->name('updatePopularStatus');
    });
    $route->controller(SubCategoryController::class)->name('subCategories.')->prefix('sub-categories')->group(function ($route) {
        $route->get('', 'index')->name('index');
        $route->get('sub-categories-by-category-ids', 'subCategoriesByCategoryIds');
        $route->get('create', 'create')->name('create');
        $route->post('store', 'store')->name('store');
        $route->get('edit/{id}', 'edit')->name('edit');
        $route->put('update/{id}', 'update')->name('update');
        $route->delete('destroy/{id}', 'destroy')->name('destroy');
        $route->post('update-activation', 'updateActivation')->name('updateActivation');
    });
    $route->controller(TagController::class)->name('tags.')->prefix('tags')->group(function ($route) {
        $route->get('', 'index')->name('index');
        $route->get('create', 'create')->name('create');
        $route->post('store', 'store')->name('store');
        $route->get('edit/{id}', 'edit')->name('edit');
        $route->put('update/{id}', 'update')->name('update');
        $route->delete('destroy/{id}', 'destroy')->name('destroy');
    });
    $route->controller(ServiceController::class)->name('services.')->prefix('services')->group(function ($route) {
        $route->get('', 'index')->name('index');
        $route->get('create', 'create')->name('create');
        $route->post('store', 'store')->name('store');
        $route->get('edit/{id}', 'edit')->name('edit');
        $route->put('update/{id}', 'update')->name('update');
        $route->delete('destroy/{id}', 'destroy')->name('destroy');
    });
    $route->controller(PortfolioController::class)->name('portfolios.')->prefix('portfolios')->group(function ($route) {
        $route->get('', 'index')->name('index');
        $route->get('create', 'create')->name('create');
        $route->post('store', 'store')->name('store');
        $route->get('edit/{id}', 'edit')->name('edit');
        $route->put('update/{id}', 'update')->name('update');
        $route->get('show/{id}', 'show')->name('show');
        $route->delete('destroy/{id}', 'destroy')->name('destroy');
    });
    $route->controller(RequestController::class)->name('requests.')->prefix('requests')->group(function ($route) {
        $route->get('', 'index')->name('index');
        $route->get('create', 'create')->name('create');
        $route->post('store', 'store')->name('store');
        $route->get('edit/{id}', 'edit')->name('edit');
        $route->put('update/{id}', 'update')->name('update');
        $route->get('show/{id}', 'show')->name('show');
        $route->delete('destroy/{id}', 'destroy')->name('destroy');
    });
    $route->controller(QuotationController::class)->name('quotations.')->prefix('quotations')->group(function ($route) {
        $route->get('', 'index')->name('index');
        $route->get('create', 'create')->name('create');
        $route->post('store', 'store')->name('store');
        $route->get('edit/{id}', 'edit')->name('edit');
        $route->put('update/{id}', 'update')->name('update');
        $route->get('show/{id}', 'show')->name('show');
        $route->delete('destroy/{id}', 'destroy')->name('destroy');
    });
    $route->controller(FinanceController::class)->name('finances.')->prefix('finances')->group(function ($route) {
        $route->get('', 'index')->name('index');
        $route->post('bulk-update', 'bulkUpdate')->name('bulkUpdate');
    });
    $route->controller(ReviewController::class)->name('reviews.')->prefix('reviews')->group(function ($route) {
        $route->get('', 'index')->name('index');
        $route->get('create', 'create')->name('create');
        $route->post('store', 'store')->name('store');
        $route->get('edit/{id}', 'edit')->name('edit');
        $route->put('update/{id}', 'update')->name('update');
        $route->delete('destroy/{id}', 'destroy')->name('destroy');
    });
    $route->controller(TicketController::class)->name('tickets.')->prefix('tickets')->group(function ($route) {
        $route->get('', 'index')->name('index');
        $route->get('show/{id}', 'show')->name('show');
        $route->post('reply/{id}', 'reply')->name('reply');
    });
    $route->controller(FilterController::class)->name('filters.')->prefix('filters')->group(function ($route) {
        $route->get('', 'index')->name('index');
        $route->get('create', 'create')->name('create');
        $route->post('store', 'store')->name('store');
        $route->get('edit/{id}', 'edit')->name('edit');
        $route->put('update/{id}', 'update')->name('update');
        $route->delete('destroy/{id}', 'destroy')->name('destroy');
    });
    $route->controller(PlanController::class)->name('plans.')->prefix('plans')->group(function ($route) {
        $route->get('', 'index')->name('index');
        $route->get('create', 'create')->name('create');
        $route->post('store', 'store')->name('store');
        $route->get('edit/{id}', 'edit')->name('edit');
        $route->put('update/{id}', 'update')->name('update');
        $route->delete('destroy/{id}', 'destroy')->name('destroy');
        $route->get('features/{id}', 'getFeaturesByPlan')->name('features');
    });
    $route->controller(FeatureController::class)->name('features.')->prefix('features')->group(function ($route) {
        $route->get('', 'index')->name('index');
        $route->get('create', 'create')->name('create');
        $route->post('store', 'store')->name('store');
        $route->get('edit/{id}', 'edit')->name('edit');
        $route->put('update/{id}', 'update')->name('update');
        $route->delete('destroy/{id}', 'destroy')->name('destroy');
        $route->get('features/{id}', 'getFeaturesByPlan')->name('features');
    });
    $route->controller(FaqController::class)->name('faqs.')->prefix('faqs')->group(function ($route) {
        $route->get('', 'index')->name('index');
        $route->get('create', 'create')->name('create');
        $route->post('store', 'store')->name('store');
        $route->get('edit/{id}', 'edit')->name('edit');
        $route->put('update/{id}', 'update')->name('update');
        $route->get('show/{id}', 'show')->name('show');
        $route->delete('destroy/{id}', 'destroy')->name('destroy');
        $route->post('update-activation', 'updateActivation')->name('updateActivation');
    });
    $route->controller(GeneralController::class)->name('general.')->prefix('general')->group(function ($route) {
        $route->get('', 'generalInfo')->name('generalInfo');
        $route->put('update-general-info', 'updateGeneralInfo')->name('updateGeneralInfo');
        $route->get('privacy-policy', 'privacyPolicy')->name('privacyPolicy');
        $route->put('update-privacy-policy', 'updatePrivacyPolicy')->name('updatePrivacyPolicy');
        $route->get('terms', 'terms')->name('terms');
        $route->put('update-terms', 'updateTerms')->name('updateTerms');
    });

    Route::resource('currencies', CurrencyController::class);
    Route::post('categories/update-popular-status', [CategoryController::class, 'updatePopularStatus'])->name('categories.updatePopularStatus');
});
