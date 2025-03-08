<?php

namespace App\Http\Controllers\Admin\School;

use App\Http\Controllers\Controller;
use App\Http\Requests\SchoolRequest;
use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class SchoolController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admins');
    }

    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 20); // デフォルトは20件
        // 全学校一覧、削除済み学校一覧を取得
        $allSchools = School::searchSchools($request->search)->select('id', 'type', 'name', 'zipcode', 'address1', 'address2', 'address3', 'address4', 'phone_number')->paginate($perPage);
        $schools = School::withoutTrashed()->select('id', 'type', 'name', 'zipcode', 'address1', 'address2', 'address3', 'address4', 'phone_number')->paginate($perPage);
        $deletedSchools = School::onlyTrashed()->select('id', 'type', 'name', 'zipcode', 'address1', 'address2', 'address3', 'address4', 'phone_number')->paginate($perPage);

        // 保育園一覧、幼稚園一覧、小学校一覧、中学校一覧、高校一覧、大学一覧、その他一覧をそれぞれ取得
        $nurserySchools = School::where('type', '保育園')->whereNull('deleted_at')->select('id', 'type', 'name', 'zipcode', 'address1', 'address2', 'address3', 'address4', 'phone_number')->paginate($perPage);
        $kindergartens = School::where('type', '幼稚園')->whereNull('deleted_at')->select('id', 'type', 'name', 'zipcode', 'address1', 'address2', 'address3', 'address4', 'phone_number')->paginate($perPage);
        $elementarySchools = School::where('type', '小学校')->whereNull('deleted_at')->select('id', 'type', 'name', 'zipcode', 'address1', 'address2', 'address3', 'address4', 'phone_number')->paginate($perPage);
        $juniorHighSchools = School::where('type', '中学校')->whereNull('deleted_at')->select('id', 'type', 'name', 'zipcode', 'address1', 'address2', 'address3', 'address4', 'phone_number')->paginate($perPage);
        $highSchools = School::where('type', '高校')->whereNull('deleted_at')->select('id', 'type', 'name', 'zipcode', 'address1', 'address2', 'address3', 'address4', 'phone_number')->paginate($perPage);
        $universities = School::where('type', '大学')->whereNull('deleted_at')->select('id', 'type', 'name', 'zipcode', 'address1', 'address2', 'address3', 'address4', 'phone_number')->paginate($perPage);
        $others = School::where('type', 'その他')->whereNull('deleted_at')->select('id', 'type', 'name', 'zipcode', 'address1', 'address2', 'address3', 'address4', 'phone_number')->paginate($perPage);


        return Inertia::render('Admin/Schools/Index', [
            'allSchools' => $allSchools,
            'schools' => $schools,
            'deletedSchools' => $deletedSchools,
            'nurserySchools' => $nurserySchools,
            'kindergartens' => $kindergartens,
            'elementarySchools' => $elementarySchools,
            'juniorHighSchools' => $juniorHighSchools,
            'highSchools' => $highSchools,
            'universities' => $universities,
            'others' => $others,
        ]);
    }

    public function store(SchoolRequest $request)
    {

        $existingSchool = School::where('name', $request->name)->first();

        if ($existingSchool) {
            return redirect()->back()->with([
                'message' => '学校名が既に存在しています',
                'status' => 'danger',
            ]);
        }
        
        $validatedData = $request->validated();
        try {
            DB::transaction(function () use ($validatedData) {
                School::create($validatedData);
            });

            return to_route('admin.school.index')->with([
                'message' => '学校の登録に成功しました',
                'status' => 'success',
            ]);
        } catch (\Throwable $e) {
            Log::error($e->getMessage());

            return redirect()->back()->with([
                'message' => '学校の登録に失敗しました',
                'status' => 'danger',
            ]);
        }
    }

    public function show(School $school)
    {
        return Inertia::render('Admin/Schools/Show', [
            'school' => $school,
        ]);
    }

    public function update(SchoolRequest $request, School $school)
    {
        $validatedData = $request->validated();

        try {
            DB::transaction(function () use ($validatedData, $school) {
                $school->update($validatedData);
            });

            return to_route('admin.school.index')->with([
                'message' => '学校の更新に成功しました',
                'status' => 'success',
            ]);
        } catch (\Throwable $e) {
            Log::error($e->getMessage());

            return redirect()->back()->with([
                'message' => '学校の更新に失敗しました',
                'status' => 'danger',
            ]);
        }
    }

    public function destroy(School $school)
    {
        try {
            $school->delete();

            return to_route('admin.school.index')->with([
                'message' => '学校を削除しました',
                'status' => 'success',
            ]);
        } catch (\Throwable $e) {
            Log::error($e->getMessage());

            return redirect()->back()->with([
                'message' => '学校の削除に失敗しました',
                'status' => 'danger',
            ]);
        }
    }

    public function restore($id)
    {
        try {
            School::withTrashed()->findOrFail($id)->restore();

            return to_route('admin.school.index')->with([
                'message' => '学校の復元に成功しました',
                'status' => 'success',
            ]);
        } catch (\Throwable $e) {
            Log::error($e->getMessage());

            return redirect()->back()->with([
                'message' => '学校の復元に失敗しました',
                'status' => 'danger',
            ]);
        }
    }

    public function forceDelete($id)
    {
        try {
            School::onlyTrashed()->findOrFail($id)->forceDelete();

            return to_route('admin.school.index')->with([
                'message' => '学校の完全削除に成功しました',
                'status' => 'success',
            ]);
        } catch (\Throwable $e) {
            Log::error($e->getMessage());

            return redirect()->back()->with([
                'message' => '学校の完全削除に失敗しました',
                'status' => 'danger',
            ]);
        }
    }
}
