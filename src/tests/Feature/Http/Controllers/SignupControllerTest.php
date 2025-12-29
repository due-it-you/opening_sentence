<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SignupControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * 一般ユーザーとして新規登録が完了した場合のテスト
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
        $response->assertRedirect('/');
        $this->assertDatabaseHas('users', $valid_signup_input_hash);
    }
}
