<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Store;

class StoreRequest extends FormRequest
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
            'organization_id' => ['required', 'integer', 'exists:organizations,id'],
            'type' => ['required', 'string', 'max:40'],
            'code' => ['required', 'string', 'max:20'],
            'description' => ['required', 'max:1000'],
            'store_photo_path' => ['nullable', 'image', 'mimes: jpg,jpeg,png', 'max:2048'],
            'store_logo_path' => ['nullable', 'image', 'mimes: jpg,jpeg,png', 'max:2048'],
            'zipcode' => ['required', 'regex:/^[0-9a-zA-Z\-]+$/', 'max:10'],
            'address1' => ['required', 'string', 'max:20'],
            'address2' => ['required', 'string', 'max:30'],
            'address3' => ['required', 'string', 'max:50'],
            'address4' => ['required', 'string', 'max:100'],
            'phone_number' => ['required', 'string', 'max:20'],
            'fax_number' => ['nullable', 'string', 'max:20'],
            'website' => ['nullable', 'url', 'max:255'],
            'facebook' => ['nullable', 'url', 'max:255'],
            'twitter' => ['nullable', 'url', 'max:255'],
            'instagram' => ['nullable', 'url', 'max:255'],
            'youtube' => ['nullable', 'url', 'max:255'],
            'line' => ['nullable', 'url', 'max:255'],
            'established_date' => ['required', 'date'],
            'color_code' => ['required', 'string', 'max:7'],
            'status' => ['required', 'boolean', 'in:0,1'],
        ];
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $rules['name'] = ['required', 'string', 'max:50', Rule::unique(Store::class)->ignore($this->store)];
            $rules['email'] = ['required', 'string', 'email', 'max:255', Rule::unique(Store::class)->ignore($this->store)];
        } else {
            $rules['name'] = ['required', 'string', 'max:50', 'unique:' . Store::class];
            $rules['email'] = ['required', 'string', 'email', 'max:255', 'unique:' . Store::class];
        }

        return $rules;
    }

    /**
     * カスタム属性名を設定
     * @return array
     */
    public function attributes()
    {
        return [
            'name' => '店舗名',
            'type' => '店舗タイプ',
            'code' => '店舗コード',
            'description' => '店舗概要',
        ];
    }

    /**
     * カスタムエラーメッセージを設定
     * @return array
     */
    public function messages()
    {
        return [
            'store_photo_path.mines' => '指定された拡張子（jpg/jpeg/png）ではありません。',
            'store_logo_path.mines' => '指定された拡張子（jpg/jpeg/png）ではありません。',
        ];
    }
}
