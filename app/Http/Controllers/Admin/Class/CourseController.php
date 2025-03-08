<?php

namespace App\Http\Controllers\Admin\Class;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourseRequest;
use Illuminate\Http\Request;
use App\Models\Announcement;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\Lesson;
use App\Models\Organization;
use App\Models\Store;
use Inertia\Inertia;
use Inertia\Response;

class CourseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admins');
    }

    public function index(Request $request): Response
    {
        $perPage = $request->input('per_page', 20); // デフォルトは20件
        // Store IDsの取得
        $storeIds = Store::where('organization_id', 2)->pluck('id');

        $courses = Course::with('lesson', 'courseCategory')
            ->orderBy('sort_no', 'asc')
            ->paginate($perPage);

        // 一般教室
        $generalCourses = CourseCategory::with(['courses' => function ($query) {
            $query->orderBy('sort_no', 'asc');
        }])
        ->whereIn('store_id', $storeIds)
        ->where('name', 'like', '%一般教室%')
            ->paginate($perPage);

        // 短期教室
        $shortCourses = CourseCategory::with(['courses' => function ($query) {
            $query->orderBy('sort_no', 'asc');
        }])
        ->whereIn('store_id', $storeIds)
        ->where('name', 'like', '%短期教室%')
            ->paginate($perPage);

        // 体験教室
        $trailCourses = CourseCategory::with(['courses' => function ($query) {
            $query->orderBy('sort_no', 'asc');
        }])
        ->whereIn('store_id', $storeIds)
        ->where('name', 'like', '%体験教室%')
            ->paginate($perPage);

        // 削除されたコース
        $deletedCourses = Course::onlyTrashed()
            ->select('id', 'lesson_id', 'course_category_id', 'name')
            ->paginate($perPage);

        return Inertia::render('Admin/Courses/Index', [
            'courses' => $courses,
            'generalCourses' => $generalCourses,
            'shortCourses' => $shortCourses,
            'trailCourses' => $trailCourses,
            'deletedCourses' => $deletedCourses
        ]);
    }


    public function create(): Response
    {
        $organization = Organization::findOrFail(2);

        $stores = Store::with('lessons', 'courseCategories')->where('organization_id', $organization->id)->get();
        $storeIds = $stores->pluck('id')->toArray();

        $announcements = Announcement::whereIn('store_id', $storeIds)->get();

        return Inertia::render('Admin/Courses/Create', [
            'stores' => $stores,
            'announcements' => $announcements
        ]);
    }

    public function store(CourseRequest $request) {}

    public function show(Course $course)
    {
        //
    }

    public function edit(Course $course)
    {
        //
    }

    public function update(CourseRequest $request, Course $course)
    {
        //
    }

    public function destroy(Course $course)
    {
        //
    }
}
