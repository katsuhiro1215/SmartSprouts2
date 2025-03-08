<?php

namespace App\Exports;

use App\Models\StoreSchedule;
use Maatwebsite\Excel\Concerns\FromCollection;

class StoreScheduleExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return StoreSchedule::all();
    }
}
