<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\SignupUserRequest;

class SignupController extends Controller
{
    /**
     * ユーザーの新規登録
     */
    public function store(SignupUserRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password'])
        ]);

        return redirect('/')->with('success', '新規登録が完了しました！');
    }
}
