<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginAuthenticateRequest;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class AuthSessionController extends Controller
{
    public function authenticate(LoginAuthenticateRequest $request)
    {
        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {
            # セッション固定攻撃を防ぐためのセッションの再生成
            $request->session()->regenerate();

            return redirect()->intended('/')->with('success', 'ログインしました。');
        }

        return back()->withErrors([
            'login' => 'メールアドレスまたはパスワードが正しくありません。'
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        # ユーザーのセッションの無効化(セキュリティ面)
        $request->session()->invalidate();

        # CSRFトークンの再生成(セキュリティ面)
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
