<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\AdminUser;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminUserAuthControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * 正常系：
     * 有効な値の入力で管理者として認証に成功する場合
     */
    public function test_admin_user_authenticate_with_valid_input(): void
    {
        # 準備
        $guard = 'admin';
        $plain_password = 'test_password';
        $admin_user = AdminUser::factory()->create([
            'password' => Hash::make($plain_password)
        ]);

        # HTTPリクエスト
        $response = $this->post('/admin/login', [
            'email' => $admin_user->email,
            'password' => $plain_password
        ]);

        # アサーション
        $response->assertRedirect('/admin/dashboard');
        $this->assertAuthenticatedAs($admin_user, $guard);
        $response->assertSessionHas('success', '管理者としてログインしました。');
    }

    /**
     * 異常系：
     * 不正な値の入力で管理者として認証に失敗する場合
     */
    public function test_admin_user_authentication_failed_with_invalid_input(): void
    {
        # 準備
        $guard = 'admin';
        $plain_password = 'test_password';
        $admin_user = AdminUser::factory()->create([
            'password' => Hash::make($plain_password)
        ]);

        # HTTPリクエスト
        $response = $this->post('/admin/login', [
            'email' => $admin_user->email,
            'password' => 'wrong_pass'
        ]);

        # アサーション
        $response->assertRedirectBackWithErrors([
            'login' => 'ログインに失敗しました。'
        ]);
        $this->assertGuest();
    }
}
