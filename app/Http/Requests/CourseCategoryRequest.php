<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseCategoryRequest extends FormRequest
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
            'lesson_id' => ['required', 'integer', 'exists:lessons,id'],
            'type' => ['required', 'enum:course_category_types'],
            'name' => ['required', 'string', 'max:50'],
            'description' => ['required', 'max:1000'],
            'course_category_photo_path' => ['nullable', 'image', 'mimes: jpg,jpeg,png', 'max:2048'],
            'status' => ['required', 'boolean', 'in:0,1'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date'],
        ];
    }

    /**
     * カスタム属性名を設定
     * @return array
     */
    public function attributes(): array
    {
        return [
            'name' => 'コースカテゴリー名',
            'description' => 'コースカテゴリー概要',
        ];
    }

    /**
     * カスタムメッセージを設定
     * @return array
     */
    public function messages(): array
    {
        return [
            'type.required' => 'コースカテゴリータイプが選択されていません。コースカテゴリータイプを選択してください。',
            'type.enum' => '指定されたコースカテゴリータイプを選択してください。',
            'course_category_photo_path.mimes' => '指定された拡張子（jpg/jpeg/png）の画像ファイルを指定してください。',
        ];
    }
}
