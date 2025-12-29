<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserAuthControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * 正常系：
     * 有効な値によって一般ユーザーの認証処理が成功した場合のテスト
     */
    public function test_user_authenticate_with_valid_input(): void
    {
        # 準備
        $plain_password = 'test_password';
        $user = User::factory()->create([
            'password' => Hash::make($plain_password)
        ]);
        $guard = 'web';

        # HTTPリクエスト
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => $plain_password
        ]);

        # アサーション
        $this->assertAuthenticated($guard);
        $response->assertRedirect('/');
        $response->assertSessionHas('success', 'ログインしました。');
    }

    /**
     * 異常系：
     * 不正な値によって一般ユーザーの認証処理が失敗した場合のテスト
     */
    public function test_user_authenticate_with_invalid_input(): void
    {
        # 準備
        $plain_password = 'test_password';
        $user = User::factory()->create([
            'password' => Hash::make($plain_password)
        ]);
        $invalid_password = 'invalid_password';
        
        # HTTPリクエスト
        $response = $this->post('/login', [
            'email' => $user->email,
            # 不正なパスワードを入力
            'password' => $invalid_password
        ]);

        # アサーション
        $this->assertGuest();
        $response->assertRedirectBack();
        $response->assertSessionHasErrors([
            'login' => 'メールアドレスまたはパスワードが正しくありません。'
        ]);
    }

    /**
     * 一般ユーザーのログアウト処理のテスト
     */
    public function test_user_logout(): void
    {
        # 準備
        $user = User::factory()->create();
        Auth::login($user);

        # HTTPリクエスト
        $response = $this->post('/logout');

        # アサーション
        $this->assertGuest();
        $response->assertRedirect('/');
    }
}
