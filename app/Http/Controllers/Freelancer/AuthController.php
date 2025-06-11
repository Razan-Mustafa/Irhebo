<?php

namespace App\Http\Controllers\Freelancer;

use Illuminate\Http\Request;
use App\Http\Requests\Freelancer\LoginRequest;
use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        $countries = Country::all();

        if (Auth::guard('freelancer')->check()) {
            return redirect()->route('freelancer.home.index');
        }
        return view('pages-freelancer.auth.login', compact('countries'));
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
}
