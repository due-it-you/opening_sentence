<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class EnsureUserIsAdmin
{
    /**
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    /**
     * ユーザーが管理者として認証済であることを保証
     */
    public function handle(Request $request, Closure $next): Response
    {
        # 一般ユーザーとして認証済み -> 403エラー
        if (Auth::guard('web')->check())
        {
            abort(403);
        }

        # 管理者としてまだ認証済みではない -> 管理者ログインページへ
        if (!Auth::guard('admin')->check())
        {
            return redirect('/admin/login');
        }

        return $next($request);
    }
}
