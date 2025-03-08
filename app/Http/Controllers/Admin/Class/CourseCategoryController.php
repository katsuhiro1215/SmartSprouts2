<?php

namespace App\Http\Controllers\Admin\Class;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourseCategoryRequest;
use App\Models\CourseCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class CourseCategoryController extends Controller
{
    public function index()
    {
        $allCourseCategories = CourseCategory::select('id', 'name')->paginate(20);
        $courseCategories = CourseCategory::withoutTrashed()->select('id', 'name')->paginate(20);
        $deletedCourseCategories = CourseCategory::onlyTrashed()->select('id', 'name')->paginate(20);

        return Inertia::render('Admin/CourseCategory/Index', [
            'allCourseCategories' => $allCourseCategories,
            'courseCategories' => $courseCategories,
            'deletedCourseCategories' => $deletedCourseCategories
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/CourseCategory/Create');
    }

    public function store(CourseCategoryRequest $request)
    {
        $validatedData = $request->validated();

        try {
            DB::transaction(function () use ($validatedData) {
                CourseCategory::create($validatedData);
            });

            return to_route('admin.course-category.index')->with([
                'message' => 'コースカテゴリーの作成に成功しました。'
            ]);
        } catch (\Throwable $e) {
            Log::error($e->getMessage());

            return to_route('admin.course-category.create')->with([
                'message' => 'コースカテゴリーの作成に失敗しました。'
            ]);
        }
    }

    public function show(CourseCategory $courseCategory)
    {
        return Inertia::render('Admin/CourseCategory/Show', [
            'courseCategory' => $courseCategory
        ]);
    }

    public function edit(CourseCategory $courseCategory)
    {
        return Inertia::render('Admin/CourseCategory/Edit', [
            'courseCategory' => $courseCategory
        ]);
    }

    public function update(CourseCategoryRequest $request, CourseCategory $courseCategory)
    {
        $validatedData = $request->validated();

        try {
            DB::transaction(function () use ($validatedData, $courseCategory) {
                $courseCategory->update($validatedData);
            });

            return to_route('admin.course-category.index')->with([
                'message' => 'コースカテゴリーの更新に成功しました。'
            ]);
        } catch (\Throwable $e) {
            Log::error($e->getMessage());

            return to_route('admin.course-category.edit', $courseCategory)->with([
                'message' => 'コースカテゴリーの更新に失敗しました。'
            ]);
        }
    }

    public function destroy(CourseCategory $courseCategory)
    {
        try {
            DB::transaction(function () use ($courseCategory) {
                $courseCategory->delete();
            });

            return to_route('admin.course-category.index')->with([
                'message' => 'コースカテゴリーの削除に成功しました。'
            ]);
        } catch (\Throwable $e) {
            Log::error($e->getMessage());

            return to_route('admin.course-category.index')->with([
                'message' => 'コースカテゴリーの削除に失敗しました。'
            ]);
        }
    }

    public function restore(CourseCategory $courseCategory)
    {
        try {
            DB::transaction(function () use ($courseCategory) {
                $courseCategory->restore();
            });

            return to_route('admin.course-category.index')->with([
                'message' => 'コースカテゴリーの復元に成功しました。'
            ]);
        } catch (\Throwable $e) {
            Log::error($e->getMessage());

            return to_route('admin.course-category.index')->with([
                'message' => 'コースカテゴリーの復元に失敗しました。'
            ]);
        }
    }

    public function forceDelete(CourseCategory $courseCategory)
    {
        try {
            DB::transaction(function () use ($courseCategory) {
                $courseCategory->forceDelete();
            });

            return to_route('admin.course-category.index')->with([
                'message' => 'コースカテゴリーの完全削除に成功しました。'
            ]);
        } catch (\Throwable $e) {
            Log::error($e->getMessage());

            return to_route('admin.course-category.index')->with([
                'message' => 'コースカテゴリーの完全削除に失敗しました。'
            ]);
        }
    }
}
