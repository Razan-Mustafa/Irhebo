<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{
    AuthController,
    HomeController,
    UserController,
    FilterController,
    NotificationController,
    SharedController,
    ServiceController,
    WishlistController,
    ReviewController,
    CategoryController,
    ChatController,
    CheckoutController,
    CurrencyController,
    FaqController,
    PortfolioController,
    QuotationController,
    SubCategoryController,
    RequestController,
    SocialAuthController,
    TagController,
    TicketController,
};
use App\Http\Middleware\CurrencyMiddleware;

// Auth Routes
Route::controller(AuthController::class)->group(function ($route) {
    $route->post('login', 'login');
    $route->post('send-notification/{userId}', 'SendNotification');
    $route->post('register', 'register');
    $route->post('generate-code', 'generateCode');
    $route->post('verify-code', 'verifyCode');
    $route->post('reset-password', 'resetPassword');
});
Route::controller(SocialAuthController::class)->prefix('auth')->group(function($route){
   $route->get('{provider}', [SocialAuthController::class, 'redirectToProvider']);
   $route->get('{provider}/callback', [SocialAuthController::class, 'handleProviderCallback']);
});


// Public Routes
Route::controller(HomeController::class)->group(function ($route) {
    $route->get('sliders', 'sliders');
    $route->get('home', 'homeMobile');
    $route->get('home-page', 'homePage');
});
Route::controller(SubCategoryController::class)->group(function ($route) {
    $route->get('sub-categories', 'getByCategoryId');
});
Route::controller(TagController::class)->prefix('tags')->group(function($route){
    $route->get('','getAllTags');
    $route->get('by_sub_category/{id}','getTagBySubCategory');
});
Route::prefix('filters')->controller(FilterController::class)->group(function ($route) {
    $route->get('', 'getFiltersByCategoryId');
    $route->post('apply','applyFilters');
});
Route::prefix('portfolio')->controller(PortfolioController::class)->group(function ($route) {
    $route->get('', 'getPortfolioByUserId');
    $route->get('featured', 'getFeaturedPortfolios');
    $route->get('details/{id}', 'portfolioDetails');
});
Route::prefix('shared')->controller(SharedController::class)->group(function ($route) {
    $route->get('countries', 'getCountries');
    $route->get('languages', 'getLanguages');
    $route->get('general-data', 'generalData');
    $route->get('register-data', 'getRegisterData');
    $route->get('plans', 'getPlans');
});
Route::prefix('categories')->controller(CategoryController::class)->group(function ($route) {
    $route->get('', 'index');
    $route->get('details/{id}','details');
});
Route::prefix('services')->controller(ServiceController::class)->group(function ($route) {
    $route->get('', 'getBySubCategory');
    $route->get('recommended', 'getRecommendedServices');
    $route->get('get-by-user', 'getServicesByUserId');
    $route->get('featured', 'getFeaturedServices');
    $route->get('details/{service_id}', 'serviceDetails');
    $route->get('search/{query?}', 'search');
    $route->get('{slug}', 'getServicesByTag');
});

Route::prefix('notifications')->controller(NotificationController::class)->group(function ($route) {
    $route->get('', 'getNotifications');
    $route->put('mark-as-read/{id}', 'markAsReadByNotification');
    $route->post('change-notifiable', 'changeNotifiable');
});
Route::prefix('currencies')->controller(CurrencyController::class)->group(function ($route) {
    $route->get('', 'index');
});
Route::prefix('faqs')->controller(FaqController::class)->group(function($route){
    $route->get('','index');
});
Route::prefix('users')->controller(UserController::class)->group(function ($route) {
    $route->get('freelancer-profile/{userId}', 'getFreelancerProfileByUserId');
    $route->get('freelancer-categories', 'getFreelancerCategoriesByUserId');
});
// Protected Routes (Require Authentication)
Route::middleware('auth:api')->group(function () {

    Route::prefix('auth')->controller(AuthController::class)->group(function ($route) {
        $route->post('logout', 'logout');
    });
    Route::controller(HomeController::class)->group(function ($route) {
        $route->get('home-freelancer', 'homeFreelancer');
    });
    Route::prefix('users')->controller(UserController::class)->group(function ($route) {
        $route->post('complete-profile', 'completeProfile');
        $route->post('verify', 'uploadFileVerification');
        $route->get('client-profile', 'getClientProfile');
        $route->get('freelancer-profile', 'getFreelancerProfile');
        $route->post('update-profile', 'updateProfile');
        $route->post('change-password', 'changePassword');
    });

    Route::prefix('wishlist')->controller(WishlistController::class)->group(function ($route) {
        $route->post('toggle', 'toggle');
        $route->get('', 'getWishlistByUserId');
    });

    Route::prefix('notifications')->controller(NotificationController::class)->group(function ($route) {
        $route->post('read', 'markAsRead');
    });

    Route::controller(ReviewController::class)->group(function ($route) {
        $route->post('submit-review', 'submitReview');
        $route->get('reviews-by-user/{id}', 'getReviewsByUser');
    });
    Route::prefix('requests')->controller(RequestController::class)->group(function ($route) {
        $route->get('', 'getByUser');
        $route->post('create', 'createRequest');
        $route->get('details/{id}', 'requestDetails');
        $route->post('add-comment', 'addComment');
        $route->get('by-freelancer', 'getByFreelancer');
        $route->post('confirm-request/{id}', 'confirmRequest');
    });
    Route::prefix('tickets')->controller(TicketController::class)->group(function($route){
        $route->get('', 'userTickets');
        $route->post('submit-ticket','store');
        $route->post('add-response','addMessage');
        $route->get('{id}','show');
        $route->post('close-ticket/{id}', 'closeTicket');
    });
    Route::prefix('quotations')->controller(QuotationController::class)->group(function ($route) {
        $route->get('', 'getAll');
        $route->get('get-by-user-id', 'getByUserId');
        $route->get('get-by-freelancer-id', 'getByFreelancerId');
        $route->post('create', 'createQuotation');
        $route->post('approve-quotation/{id}', 'approveQuotation');
        $route->get('/details/{id}', 'findById');
        $route->post('create-comment', 'createComment');
        $route->get('/comment-list/{quotationId}', 'getCommentsByQuotationId');
    });
    Route::prefix('services')->controller(ServiceController::class)->group(function ($route) {
        $route->post('create', 'create');
        $route->post('update/{id}', 'update');
        $route->delete('delete/{id}', 'delete');
        $route->delete('delete-media/{id}', 'deleteMedia');
    });
    Route::prefix('portfolio')->controller(PortfolioController::class)->group(function ($route) {
        $route->post('create', 'create');
        $route->post('update/{id}', 'update');
        $route->delete('delete/{id}', 'delete');
        $route->delete('delete-media/{id}', 'deleteMedia');
    });
    Route::prefix('checkout')->controller(CheckoutController::class)->group(function($route){
        $route->post('proceed','proceedCheckout');
    });
    Route::prefix('chat')->controller(ChatController::class)->group(function($route){
        $route->post('start-conversation', 'startConversation');
        $route->post('send-message', 'sendMessage');
        $route->get('messages/{id}', 'getMessages');
        $route->get('get-conversations', 'getConversations');
        $route->post('update-status/{id}', 'updateStatus');
        $route->post('get-voice-call-token', 'getVoiceCallToken');
    });
});
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/chat/get-or-create', [ChatController::class, 'getOrCreateChat']);
    Route::post('/chat/send-message', [ChatController::class, 'sendMessage']);
    Route::get('/chat/{chatId}/messages', [ChatController::class, 'getMessages']);
    Route::post('/chat/{chatId}/read', [ChatController::class, 'markAsRead']);
});
