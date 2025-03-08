<?php

namespace App\Http\Controllers\Admin\Class;

use App\Http\Controllers\Controller;
use App\Http\Requests\LessonRequest;
use App\Models\CourseCategory;
use App\Models\Lesson;
use App\Models\Organization;
use App\Models\Store;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class LessonController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admins');
    }

    public function index()
    {
        $lessonIds = Organization::findOrFail(2)->stores()->pluck('id');
        $allLessonsQuery = Lesson::select('id', 'name')->whereIn('store_id', $lessonIds);
        $allLessons = (clone $allLessonsQuery)->paginate(20);
        $lessons = (clone $allLessonsQuery)->withoutTrashed()->paginate(20);
        $deletedLessons = (clone $allLessonsQuery)->onlyTrashed()->paginate(20);

        return Inertia::render('Admin/Lessons/Index', [
            'allLessons' => $allLessons,
            'lessons' => $lessons,
            'deletedLessons' => $deletedLessons,
        ]);
    }

    public function create()
    {
        $stores = Organization::findOrFail(2)->stores;

        return Inertia::render('Admin/Lessons/Create', [
            'stores' => $stores
        ]);
    }

    public function store(LessonRequest $request)
    {
        $store = Store::findOrFail($request->store_id);
        $existsLesson = $store->lessons()->where('name', $request->name)->exists();
        if ($existsLesson) {
            return back()->with([
                'message' => '同じ名前のレッスンが既に存在します。'
            ]);
        }


        $validatedData = $request->validated();

        try {
            DB::transaction(function () use ($validatedData) {
                Lesson::create($validatedData);
            });

            return to_route('admin.lesson.index')->with([
                'message' => 'レッスンの作成に成功しました。'
            ]);
        } catch (\Throwable $e) {
            Log::error($e->getMessage());

            return to_route('admin.lesson.create')->with([
                'message' => 'レッスンの作成に失敗しました。'
            ]);
        }
    }

    public function show(Lesson $lesson)
    {
        return Inertia::render('Admin/Lessons/Show', [
            'lesson' => $lesson
        ]);
    }

    public function edit(Lesson $lesson)
    {
        return Inertia::render('Admin/Lessons/Edit', [
            'lesson' => $lesson
        ]);
    }

    public function update(LessonRequest $request, Lesson $lesson)
    {
        $validatedData = $request->validated();

        try {
            DB::transaction(function () use ($validatedData, $lesson) {
                $lesson->update($validatedData);
            });

            return to_route('admin.lesson.index')->with([
                'message' => 'レッスンの更新に成功しました。'
            ]);
        } catch (\Throwable $e) {
            Log::error($e->getMessage());

            return to_route('admin.lesson.edit', $lesson)->with([
                'message' => 'レッスンの更新に失敗しました。'
            ]);
        }
    }

    public function destroy(Lesson $lesson)
    {
        try {
            DB::transaction(function () use ($lesson) {
                $lesson->delete();
            });

            return to_route('admin.lesson.index')->with([
                'message' => 'レッスンの削除に成功しました。'
            ]);
        } catch (\Throwable $e) {
            Log::error($e->getMessage());

            return to_route('admin.lesson.index')->with([
                'message' => 'レッスンの削除に失敗しました。'
            ]);
        }
    }

    public function restore(Lesson $lesson)
    {
        try {
            DB::transaction(function () use ($lesson) {
                $lesson->restore();
            });

            return to_route('admin.lesson.index')->with([
                'message' => 'レッスンの復元に成功しました。'
            ]);
        } catch (\Throwable $e) {
            Log::error($e->getMessage());

            return to_route('admin.lesson.index')->with([
                'message' => 'レッスンの復元に失敗しました。'
            ]);
        }
    }

    public function forceDelete(Lesson $lesson)
    {
        try {
            DB::transaction(function () use ($lesson) {
                $lesson->forceDelete();
            });

            return to_route('admin.lesson.index')->with([
                'message' => 'レッスンの完全削除に成功しました。'
            ]);
        } catch (\Throwable $e) {
            Log::error($e->getMessage());

            return to_route('admin.lesson.index')->with([
                'message' => 'レッスンの完全削除に失敗しました。'
            ]);
        }
    }
}
