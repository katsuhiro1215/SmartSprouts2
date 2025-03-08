<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminAttendanceRequest;
use App\Models\AdminAttendance;
use Inertia\Inertia;

class AdminAttendanceController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Attendance/Index', [
            'attendance' => AdminAttendance::with('admin')->latest()->get(),
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Attendance/Create');
    }

    public function store(AdminAttendanceRequest $request)
    {
        //
    }

    public function show(AdminAttendance $adminAttendance)
    {
        //
    }

    public function edit(AdminAttendance $adminAttendance)
    {
        //
    }

    public function update(AdminAttendanceRequest $request, AdminAttendance $adminAttendance)
    {
        //
    }

    public function destroy(AdminAttendance $adminAttendance)
    {
        //
    }
}
