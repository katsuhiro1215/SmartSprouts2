<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\StoreSchedule;

class StoreScheduleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'store_id' => ['required', 'exists:stores,id'],
            'schedules' => ['required', 'array'],
            'schedules.*.date' => ['required', 'date'],
            'schedules.*.dayOfWeek' => ['required', 'string'],
            'schedules.*.openTime' => ['nullable', 'date_format:H:i'],
            'schedules.*.closeTime' => ['nullable', 'date_format:H:i', 'after:schedules.*.openTime'],
        ];
    }
}
