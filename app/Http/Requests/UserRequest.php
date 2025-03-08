<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class UserRequest extends FormRequest
{
    /**
     * 認可処理
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * バリデーションルールを設定
     * @return array
     */
    public function rules(): array
    {
        $rules = [
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:' . User::class],
        ];

        // ユーザー登録時のみパスワードのバリデーションを追加
        if (!($this->isMethod('PUT') || $this->isMethod('PATCH'))) {
            $rules['password'] = ['required', 'confirmed', Rules\Password::defaults(), 'regex:/^(?=.*[a-zA-Z])(?=.*\d).{8,}$/'];
        }

        return $rules;
    }

    /**
     * カスタム属性名を設定
     * @return array
     */
    // public function attributes(): array
    // {
    //     return [

    //     ]
    // }

    /**
     * バリデーションエラーメッセージを設定
     * @return array
     */
    public function messages(): array
    {
        return [
            'password.regex' => 'パスワードは8文字以上の半角英数字で入力してください。',
        ];
    }
}
