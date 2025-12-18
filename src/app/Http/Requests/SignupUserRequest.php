<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignupUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:10',
            'email' => 'required',
            'password' => 'required'
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'ユーザーネーム',
            'email' => 'メールアドレス',
            'password' => 'パスワード'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => ':attributeの入力は必須です。',
            'email.required' => ':attributeの入力は必須です。',
            'password.required' => ':attributeの入力は必須です。'
        ];
    }
}
