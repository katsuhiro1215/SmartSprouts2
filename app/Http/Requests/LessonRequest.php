<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LessonRequest extends FormRequest
{
    /**
     * 認可処理
     * @return bool
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * バリデーションルールを設定
     * @return array
     */
    public function rules(): array
    {
        return [
            'store_id' => ['required', 'integer', 'exists:stores,id'],
            'name' => ['required', 'string', 'max:50'],
            'description' => ['required', 'max:1000'],
            'lesson_photo_path' => ['nullable', 'image', 'mimes: jpg,jpeg,png', 'max:2048'],
            'status' => ['required', 'boolean', 'in:0,1'],
        ];
    }

    /**
     * カスタム属性名を設定
     * @return array
     */
    public function attributes(): array
    {
        return [
            'name' => 'レッスン名',
            'description' => 'レッスン概要',
        ];
    }

    /**
     * カスタム属性名を設定
     * @return array
     */
    public function messages(): array
    {
        return [
            'lesson_photo_path.mimes' => 'jpg, jpeg, png形式の画像ファイルを選択してください。',
        ];
    }
}
