<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SignupControllerTest extends TestCase
{
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

        $response->assertValid();
        $this->assertAuthenticated();
        $response->assertRedirect('/');
        $this->assertDatabaseHas('users', $valid_signup_input_hash);
    }

    /**
     * 異常系：
     * 不正な値で新規登録処理を行った場合のテスト
     */
    /** @test */
    public function trySignupWithInvalidInput(): void
    {
        $response = $this->post('/signup', [
            'name' => '',
            'email' => '',
            'password' => ''
        ]);

        $response->assertInvalid();
        $this->assertGuest();
        $response->assertSessionHasErrors(['name', 'email', 'password']);
        $response->assertRedirectBack();
    }
}
