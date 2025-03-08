<?php

namespace App\Imports;

use App\Models\StoreSchedule;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;

class StoreSchedulesImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if (empty($row["店舗ID"])) {
            return null;
        }

        $validator = Validator::make($row, [
            '店舗ID' => 'required|integer',
            '営業日' => 'required|date',
            '曜日' => 'required|string',
            '開店時間' => 'nullable|date_format:H:i',
            '閉店時間' => 'nullable|date_format:H:i',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $storeId = $row["店舗ID"];
        $openDate = $row["営業日"];
        $dayOfWeek = $row["曜日"];
        $openTime = $row["開店時間"];
        $closeTime = $row["閉店時間"];

        $startDateTime = $openTime ? Carbon::parse($openDate . ' ' . $openTime) : null;
        $endDateTime = $closeTime ? Carbon::parse($openDate . ' ' . $closeTime) : null;

        Log::info('Importing store schedule', [
            'store_id' => $storeId,
            'start_date' => $startDateTime,
            'end_date' => $endDateTime,
            'day_of_week' => $dayOfWeek,
            'is_open' => $openTime && $closeTime,
        ]);

        return new StoreSchedule([
            'store_id' => $storeId,
            'start_date' => $startDateTime,
            'end_date' => $endDateTime,
            'day_of_week' => $dayOfWeek,
            'is_open' => $openTime && $closeTime,
        ]);
    }
}
