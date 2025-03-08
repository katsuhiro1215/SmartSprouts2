<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
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
    public function rules()
    {
        return [
            'lesson_id' => ['required', 'integer', 'exists:stores,id'],
            'course_category_id' => ['required', 'integer', 'exists:course_categories,id'],
            'name' => ['required', 'string', 'max:50'],
            'description' => ['required', 'max:1000'],
            'course_photo_path' => ['nullable', 'image', 'mimes: jpg,jpeg,png', 'max:2048'],
            'status' => ['required', 'boolean', 'in:0,1'],
            'application_start_date' => ['required', 'date'],
            'application_end_date' => ['required', 'date'],
            'sort_no' => ['required', 'integer'],
        ];
    }

    /**
     * カスタム属性名を設定
     * @return array
     */
    public function attributes()
    {
        return [
            'name' => 'コース名',
            'description' => 'コース概要',
        ];
    }

    /**
     * カスタムメッセージを設定
     * @return array
     */
    public function messages()
    {
        return [
            'course_photo_path.mimes' => '指定された拡張子（jpg/jpeg/png）の画像ファイルを指定してください。',
        ];
    }
}
