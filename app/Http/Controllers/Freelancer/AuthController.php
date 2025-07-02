<?php

namespace App\Http\Controllers\Freelancer;

use Illuminate\Http\Request;
use App\Http\Requests\Freelancer\LoginRequest;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Country;
use App\Models\FreelancerCateogry;
use App\Models\General;
use App\Models\Language;
use App\Models\Profession;
use App\Models\User;
use App\Models\UserLanguage;
use App\Services\WhatsAppService;
use App\Utilities\FileManager;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        $countries = Country::all();
        $logo = General::where('key', 'platform_logo')->value('value');

        if (Auth::guard('freelancer')->check()) {
            return redirect()->route('freelancer.home.index', compact('logo'));
        }
        return view('pages-freelancer.auth.login', compact('countries', 'logo'));
    }

    public function login(LoginRequest $request)
    {
        $remember = $request->filled('remember');

        // البحث عن freelancer يطابق prefix و phone
        $freelancer = \App\Models\User::where('prefix', $request->prefix)
            ->where('phone', $request->phone)
            ->first();

        if (!$freelancer) {
            return back()->withInput($request->only('prefix', 'phone', 'remember'))
                ->with('error', __('credentials_not_match'));
        }

        // تحقق من كلمة السر يدوياً
        if (!\Hash::check($request->password, $freelancer->password)) {
            return back()->withInput($request->only('prefix', 'phone', 'remember'))
                ->with('error', __('credentials_not_match'));
        }
        if (is_null($freelancer->verified_at)) {



            // $code = GenerateCode::generate();
            $code = '123456';
            $key = 'otp_' . $request->prefix . $request->phone;
            Cache::put($key, $code, now()->addMinutes(5));

            $freelancer->code = $code;
            $freelancer->save();

            $fullPhoneNumber =  $request->prefix . $request->phone;

            $whatsApp = new WhatsAppService();
            $response = $whatsApp->sendTemplateMessage($fullPhoneNumber, $code);
            // ممكن تبعت SMS هنا لو عندك API
            // SmsHelper::send($freelancer->prefix.$freelancer->phone, "Your verification code is $otpCode");


            $prefix = $request->prefix;
            $phone = $request->phone;

            return redirect()->route('freelancer.verify.phone', compact('phone', 'prefix'))->with('info', __('please_verify_phone'));
        }

        // تسجيل الدخول
        Auth::guard('freelancer')->login($freelancer, $remember);

        $request->session()->regenerate();

        return redirect()
            ->intended(route('freelancer.home.index'))
            ->with('success', __('welcome_back'));
    }



    public function logout(Request $request)
    {
        Auth::guard('freelancer')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('freelancer.login')
            ->with('success', __('logout_success'));
    }






    public function showRegisterForm()
    {
        $countries = Country::all();
        $professions = Profession::with('translations')->get();
        $languages = Language::all();
        $categories = Category::all();

        return view('pages-freelancer.auth.register', compact('countries', 'professions', 'languages', 'categories'));
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'avatar' => 'required|image|max:2048',
            'username' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'prefix' => 'required|string|max:10',
            'phone' => [
                'required',
                'string',
                'max:20',
                'regex:/^[0-9]+$/',
                function ($attribute, $value, $fail) use ($request) {
                    $exists = \App\Models\User::where('phone', $value)
                        ->where('prefix', $request->prefix)
                        ->exists();

                    if ($exists) {
                        $fail(__('unique_with_prefix'));
                    }
                }
            ],
            'gender' => 'required|in:male,female',
            'profession_id' => 'required|exists:professions,id',
            'bio' => 'required|string|max:2000',
            'country_id' => 'required|exists:countries,id',
            'google_id' => 'nullable',
            'languages' => 'required|array',
            'languages.*' => 'exists:languages,id',
            'category_ids' => 'required|array',
            'category_ids.*' => 'exists:categories,id',
            'password' => [
                'required',
                'string',
                'confirmed',
                Password::min(8)
                    ->mixedCase()   // 1 uppercase + 1 lowercase
                    ->numbers()     // رقم واحد
                    ->symbols()     // special character
            ],
            'file.*'        => 'nullable|file|max:4096',
            'description.*' => [
                'nullable',
                'string',
                'max:255',
            ]

        ]);

        $user = new User();
        $user->username = $validated['username'];
        $user->email = $validated['email'];
        $user->prefix = $validated['prefix'];
        $user->phone = $validated['phone'];
        $user->gender = $validated['gender'];
        $user->profession_id = $validated['profession_id'];
        $user->country_id = $validated['country_id'];
        $user->google_id = $validated['google_id'] ?? null ;
        $user->password = bcrypt($validated['password']);
        $user->save();

        session()->forget(['google_name', 'google_email', 'google_id']);

        // Avatar
        if ($request->hasFile('avatar')) {
            $avatarPath = FileManager::upload('avatars', $request->file('avatar'));
            $user->avatar = $avatarPath;
            $user->save();
        }

        // Freelancer bio
        $user->freelancer()->create([
            'bio' => $validated['bio'] ?? null,
        ]);

        // Languages
        if (!empty($validated['languages'])) {
            foreach ($validated['languages'] as $langId) {
                UserLanguage::create([
                    'user_id' => $user->id,
                    'language_id' => $langId,
                ]);
            }
        }

        // Categories
        if (!empty($validated['category_ids'])) {
            foreach ($validated['category_ids'] as $catId) {
                FreelancerCateogry::create([
                    'user_id' => $user->id,
                    'category_id' => $catId,
                ]);
            }
        }

        // Certificates
        if ($request->hasFile('file')) {
            foreach ($request->file('file') as $index => $file) {
                $description = $request->description[$index] ?? null;
                $path = FileManager::upload('certificates', $file);
                $fileName = pathinfo(strip_tags($file->getClientOriginalName()), PATHINFO_FILENAME);

                $user->certificates()->create([
                    'file_name' => trim($fileName),
                    'file_path' => $path,
                    'description' => $description,
                ]);
            }
        }


        // $code = GenerateCode::generate();
        $code = '123456';
        $key = 'otp_' . $request->prefix . $request->phone;
        Cache::put($key, $code, now()->addMinutes(5));

        $user->code = $code;
        $user->save();

        $fullPhoneNumber =  $request->prefix . $request->phone;

        $whatsApp = new WhatsAppService();
        $response = $whatsApp->sendTemplateMessage($fullPhoneNumber, $code);

        $prefix = $request->prefix;
        $phone = $request->phone;

        return redirect()->route('freelancer.verify.phone', compact('phone', 'prefix'))->with('info', __('please_verify_phone'));
    }

    public function showVerifyPhoneForm(Request $request)
    {

        $prefix = $request->query('prefix');
        $phone  = $request->query('phone');

        if (!$prefix || !$phone) {
            return redirect()->route('freelancer.login')->with('error', __('invalid_request'));
        }

        return view('pages-freelancer.auth.verify-phone', compact('prefix', 'phone'));
    }

    public function verifyPhone(Request $request)
    {
        $request->validate([
            'code' => 'required|numeric',
        ]);

        $key = 'otp_' . $request->prefix . $request->phone;
        $cachedCode = Cache::get($key);


        if (!$cachedCode) {
            return back()->with('error', __('verification_code_expired'));
        }

        if ($cachedCode != $request->code) {
            return back()->with('error', __('invalid_verification_code'));
        }


        $user = User::where('prefix', $request->prefix)
            ->where('phone', $request->phone)
            ->first();

        if (!$user) {
            return back()->with('error', __('user_not_found'));
        }

        if ($user->code == $request->code) {
            $user->verified_at = Carbon::now();
            $user->code = null;
            $user->save();
            Cache::forget($key);

            Auth::guard('freelancer')->login($user);

            return redirect()->route('freelancer.home.index')
                ->with('success', __('account_verified_successfully'));
        }

        return back()->withErrors(['code' => __('invalid_verification_code')]);
    }


    public function resendPhoneCode(Request $request)
    {
        $request->validate([
            'prefix' => 'required|string',
            'phone'  => 'required|string'
        ]);

        $user = User::where('prefix', $request->prefix)
            ->where('phone', $request->phone)
            ->first();

        // $code = GenerateCode::generate();
        $code = '123455';
        $user->code = $code;
        $user->save();
        $key  = 'otp_' . $request->prefix . $request->phone;

        // خزن الكود الجديد بالكاش
        Cache::put($key, $code, now()->addMinutes(5));


        $fullPhoneNumber = $request->prefix  . $request->phone;
        $whatsApp = new WhatsAppService();
        $response = $whatsApp->sendTemplateMessage($fullPhoneNumber, $code);


        return back()->with('success', __('verification_code_sent_again'));
    }
}
