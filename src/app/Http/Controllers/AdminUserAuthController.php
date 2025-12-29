<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginAuthenticateRequest;
use Illuminate\Support\Facades\Auth;

class AdminUserAuthController extends Controller
{
    public function authenticate(LoginAuthenticateRequest $request)
    {
        $credentials = $request->validated();
        if (Auth::guard('admin')->attempt($credentials))
        {
            $request->session()->regenerate();
            return redirect()->intended('/admin/dashboard')->with('success', '管理者としてログインしました。');
        }

        return back()->withErrors([
            'login' => 'ログインに失敗しました。'
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }
}
