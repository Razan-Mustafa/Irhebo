<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\Admin\LoginRequest;
use App\Http\Controllers\Controller;
use App\Models\General;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        $logo = General::where('key', 'platform_logo')->value('value');


        if (Auth::guard('admin')->check()) {
            return redirect()->route('home.index', compact('logo'));
        }
        return view('pages.auth.login', compact('logo'));
    }
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        $remember = $request->filled('remember');
        if (Auth::guard('admin')->attempt($credentials, $remember)) {
            $request->session()->regenerate();

            return redirect()
                ->intended(route('home.index'))
                ->with('success', __('welcome_back'));
        }

        return back()
            ->withInput($request->only('email', 'remember'))
            ->with('error', __('credentials_not_match'));
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->with('success', __('logout_success'));
    }
}
