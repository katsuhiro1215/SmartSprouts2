<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
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
        return [
            'lastname' => ['required', 'string', 'max:40'],
            'firstname' => ['required', 'string', 'max:40'],
            'lastname_kana' => ['required', 'string', 'regex:/^[ァ-ヶー]+$/u', 'max:50'],
            'firstname_kana' => ['required', 'string', 'regex:/^[ァ-ヶー]+$/u', 'max:50'],
            'student_photo_path' => ['nullable', 'image', 'mimes: jpg,jpeg,png', 'max:2048'],
            'birth' => ['required', 'date', 'after:2000-01-01', 'before:today'],
            'gender' => ['required', 'string', 'max:10'],
            'blood' => ['nullable', 'string', 'max:10'],
            'mobile_number' => ['required', 'regex:/^[0-9a-zA-Z\-]+$/', 'max:20'],
            'mobile_number_relationship' => ['required', 'string', 'max:20'],
            'personal_history' => ['nullable', 'string', 'max:1000'],
            'membership_status' => ['required', 'string', 'max:50'],
            'is_temporary' => ['required', 'boolean'],
            'serial_no' => ['nullable', 'string', 'max:50'],
            'permission_photo' => ['required', 'boolean'],
            'permission_dm' => ['required', 'boolean'],
            'remarks' => ['nullable', 'string', 'max:1000'],
        ];
    }

    /**
     * カスタムエラーメッセージを設定
     * @return array
     */
    public function messages(): array
    {
        return [
            'student_photo_path.mines' => '指定された拡張子（jpg/jpeg/png）ではありません。',
        ];
    }
}
