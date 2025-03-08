<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SchoolStudentRequest;
use App\Models\School;
use App\Models\SchoolStudent;
use App\Models\Student;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class SchoolStudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admins');
    }

    public function create()
    {
        $students = Student::select('id', 'lastname', 'firstname')->get();

        $schools = School::select('id', 'type', 'name')->get();

        return Inertia::render('Admin/SchoolStudents/Create', [
            'students' => $students,
            'schools' => $schools,
        ]);
    }

    public function store(SchoolStudentRequest $request)
    {
        //
    }

    public function edit(SchoolStudent $schoolStudent)
    {
        //
    }

    public function update(SchoolStudentRequest $request, SchoolStudent $schoolStudent)
    {
        //
    }

    public function destroy(SchoolStudent $schoolStudent)
    {
        try {
            $schoolStudent->delete();

            return back()->with('success', '削除しました');
        } catch (\Throwable $e) {
            Log::error($e->getMessage());
            return back()->with('error', '削除に失敗しました');
        }
    }
}
