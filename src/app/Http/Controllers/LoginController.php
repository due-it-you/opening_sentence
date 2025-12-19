<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginAuthenticateRequest;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function authenticate(LoginAuthenticateRequest $request)
    {
        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {
            # セッション固定攻撃を防ぐためのセッションの再生成
            $request->session()->regenerate();

            return redirect()->intended('top');
        }

        return back()->withErrors([
            'login' => 'メールアドレスまたはパスワードが正しくありません。'
        ]);
    }
}
