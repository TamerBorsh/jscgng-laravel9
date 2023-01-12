<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index()
    {
        if (Auth::guard('web')->check()) {
            return redirect()->route('dashboard.index');
        } else {
            return response()->view('backend.auth.login');
        }
    }

    public function authenticate(LoginRequest $request)
    {
        $credentials = ['email' => $request->input('email'), 'password' => $request->input('password')];

        if (Auth::guard('web')->attempt($credentials)) {
            $request->session()->regenerate();
            return response()->json(['message' => 'تم تسجيل الدخول بنجاح'], Response::HTTP_OK);
        } else {
            return response()->json(['message' => 'البيانات المدخلة غير صحيحة'], Response::HTTP_BAD_REQUEST);
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        return redirect()->route('auth.login');
    }
}
