<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreScheduleRequest;
use App\Imports\StoreSchedulesImport;
use App\Models\StoreSchedule;
use App\Models\Store;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;

class StoreScheduleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admins');
    }

    /**
     * 店舗スケジュールの一覧を表示します
     */
    public function index()
    {
        return Inertia::render('Admin/StoreSchedules/Index', [
            'storeSchedules' => StoreSchedule::with('store:id,name,theme_color')
            ->select('store_id', 'start_date', 'end_date', 'day_of_week', 'is_open')
            ->get(),
            'stores' => Store::select('id', 'name')->get(),
        ]);
    }

    /**
     * 指定された店舗のスケジュールを表示します
     */
    public function indexStore(Store $store)
    {
        $storeSchedules = StoreSchedule::where('store_id', $store->id)->get();
        return Inertia::render('Admin/Stores/Schedule/Index', [
            'store' => $store,
            'storeSchedules' => $storeSchedules,
        ]);
    }

    /**
     * 店舗スケジュールを作成するためのフォームを表示します
     */
    public function create()
    {
        return Inertia::render('Admin/StoreSchedules/Create', [
            'stores' => Store::select('id', 'name')->get(),
        ]);
    }

    /**
     * 店舗スケジュールを保存します
     */
    public function store(StoreScheduleRequest $request)
    {
        Log::info('Store method called');

        // バリデーション済みのデータを取得
        $validated = $request->validated();

        $skippedSchedules = [];

        try {
            DB::transaction(function () use ($validated, &$skippedSchedules) {
                foreach ($validated['schedules'] as $schedule) {
                    $startDateTime = $schedule['openTime'] ? Carbon::parse($schedule['date'] . ' ' . $schedule['openTime']) : null;
                    $endDateTime = $schedule['closeTime'] ? Carbon::parse($schedule['date'] . ' ' . $schedule['closeTime']) : null;

                    $existingSchedule = StoreSchedule::where('store_id', $validated['store_id'])
                    ->where(function ($query) use ($startDateTime, $endDateTime) {
                        $query->whereBetween('start_date', [$startDateTime, $endDateTime])
                            ->orWhereBetween('end_date', [$startDateTime, $endDateTime])
                            ->orWhere(function ($query) use ($startDateTime, $endDateTime) {
                                $query->where('start_date', '<=', $startDateTime)
                                    ->where('end_date', '>=', $endDateTime);
                            });
                    })
                        ->exists();

                    if ($existingSchedule) {
                        $skippedSchedules[] = $schedule;
                    } else {
                        StoreSchedule::create([
                            'store_id' => $validated['store_id'],
                            'start_date' => $startDateTime,
                            'end_date' => $endDateTime,
                            'day_of_week' => $schedule['dayOfWeek'],
                            'is_open' => $startDateTime && $endDateTime,
                        ]);
                    }
                }
            });

            Log::info('Store schedules saved successfully');

            if (count($skippedSchedules) > 0) {
                return redirect()->route('admin.storeSchedule.index')->with([
                    'status' => 'success',
                    'message' => '店舗スケジュールが保存されました。一部重複しているものがありました。',
                    'skippedSchedules' => $skippedSchedules,
                ]);
            }

            return redirect()->route('admin.storeSchedule.index')->with([
                'status' => 'success',
                'message' => '店舗スケジュールが保存されました。',
            ]);
        } catch (\Exception $e) {
            Log::error('Store schedules failed: ' . $e->getMessage());
            return redirect()->back()->with([
                'status' => 'danger',
                'message' => '店舗スケジュールの保存に失敗しました。',
            ]);
        }
    }

    /**
     * 指定された店舗のスケジュールを表示します
     */
    public function show(StoreSchedule $storeSchedule)
    {
        //
    }

    /**
     * 指定された店舗のスケジュールを編集します
     */
    public function edit(StoreSchedule $storeSchedule)
    {
        //
    }

    /**
     * 指定された店舗のスケジュールを更新します
     */
    public function update(StoreScheduleRequest $request, StoreSchedule $storeSchedule)
    {
        //
    }

    /**
     * 指定された店舗のスケジュールを削除します
     */
    public function destroy(StoreSchedule $storeSchedule)
    {
        //
    }


    /**
     * 指定された店舗の指定された年月のスケジュールを取得します
     */
    public function current(Request $request)
    {
        $store_id = $request->query('store_id');
        $date = $request->query('date', Carbon::now()->format('Y-m'));
        $currentMonth = Carbon::parse($date)->month;
        $currentYear = Carbon::parse($date)->year;

        //currentYear & $currentMonth Log
        Log::info('Current Year: ' . $currentYear);
        Log::info('Current Month: ' . $currentMonth);        

        $schedules = StoreSchedule::where('store_id', $store_id)
            ->whereYear('start_date', $currentYear)
            ->whereMonth('start_date', $currentMonth)
            ->get(['id', 'start_date', 'end_date']);

        $formattedSchedules = $schedules->map(function ($schedule) {
            return [
                'id' => $schedule->id,
                'date' => Carbon::parse($schedule->start_date)->format('Y-m-d'),
                'openTime' => Carbon::parse($schedule->start_date)->format('H:i'),
                'closeTime' => Carbon::parse($schedule->end_date)->format('H:i'),
            ];
        });

        Log::info('Formatted Schedules: ', $formattedSchedules->toArray());

        return response()->json($formattedSchedules);
    }

    /**
     * 指定されたスケジュールとの競合があるかどうかを確認します
     */
    public function checkConflicts(Request $request)
    {
        $store_id = $request->query('store_id');
        $date = $request->query('date');
        $openTime = Carbon::parse($date . ' ' . $request->query('openTime'));
        $closeTime = Carbon::parse($date . ' ' . $request->query('closeTime'));

        $conflict = StoreSchedule::where('store_id', $store_id)
            ->whereDate('start_date', $date)
            ->where(function ($query) use ($openTime, $closeTime) {
                $query->whereBetween('start_date', [$openTime, $closeTime])
                    ->orWhereBetween('end_date', [$openTime, $closeTime])
                    ->orWhere(function ($query) use ($openTime, $closeTime) {
                        $query->where('start_date', '<=', $openTime)
                            ->where('end_date', '>=', $closeTime);
                    });
            })
            ->exists();

        return response()->json(['conflict' => $conflict]);
    }

    public function importExport()
    {
        return Inertia::render('Admin/StoreSchedules/ImportExport');
    }

    public function import(Request $request)
    {
        Log::info('Import method called');

        dd($request);
        // $request->validate([
        //     'file' => 'required|file|mimes:xlsx',
        // ]);

        Log::info('File validation passed');

        try {
            Excel::import(new StoreSchedulesImport, $request->file('file'));
            Log::info('Import successful');
            return to_route('admin.storeSchedule.index')->with('success', '店舗スケジュールのインポートが完了しました。');
        } catch (\Exception $e) {
            Log::error('Import failed: ' . $e->getMessage());
            return redirect()->back()->with('error', '店舗スケジュールのインポートに失敗しました。');
        }
        
        return to_route('admin.storeSchedule.index');
    }
}
