<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SignupControllerTest extends TestCase
{
    # テストケースごとに全てのテーブルを初期状態に戻す
    use RefreshDatabase;
    /**
     * 正常系：
     * 有効な値で新規登録処理を行った場合のテスト
     */
    /** @test */
    public function signupWithValidInput(): void
    {
        $valid_signup_input_hash = [
            'name' => 'テスト',
            'email' => 'test@example.com',
        ];

        $response = $this->post('/signup', [
            'name' => 'テスト',
            'email' => 'test@example.com',
            'password' => 'test_password'
        ]);

        $response->assertValid(['name', 'email', 'password']);
        $this->assertAuthenticated();
        $response->assertRedirect('/');
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('users', $valid_signup_input_hash);
        $this->assertDatabaseCount('users', 1);
    }

    /**
     * 異常系：
     * 不正な値で新規登録処理を行った場合のテスト
     */
    /** @test */
    public function trySignupWithInvalidInput(): void
    {
        $invalid_user_signup_input = [
            'name' => '',
            'email' => '',
            'password' => ''
        ];

        $response = $this->post('/signup', $invalid_user_signup_input);

        $response->assertInvalid(['name', 'email', 'password']);
        $this->assertGuest();
        $response->assertSessionHasErrors(['name', 'email', 'password']);
        $response->assertRedirectBack();
        $this->assertDatabaseCount('users', 0);
    }
}
