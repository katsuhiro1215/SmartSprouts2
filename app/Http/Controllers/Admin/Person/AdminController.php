<?php

namespace App\Http\Controllers\Admin\Person;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use App\Models\Admin;
use App\Models\Organization;
use App\Models\Store;
use Carbon\Carbon;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admins');
    }

    // Auth
    public function edit()
    {
        return Inertia::render('Admin/Auth/Edit', [
            'admin' => Auth::user()->id,
        ]);
    }

    public function update(AdminRequest $request, Admin $admin)
    {
        $validatedData = $request->validated();
        $admin->update($validatedData);

        $admin = Auth::user();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return to_route('admin.login')->with([
            'success' => 'メールアドレスが変更されました。再度ログインしてください。',
            'status' => 'success',
        ]);
    }

    // Admin
    public function index()
    {
        $admins = Admin::admins()->get();
        $employees = Admin::employees()->get();
        $others = Admin::others()->get();

        $expiredAdmins = Admin::onlyTrashed()->get();

        return Inertia::render('Admin/Admin/Index', [
            'admins' => $admins,
            'employees' => $employees,
            'others' => $others,
            'expiredAdmins' => $expiredAdmins,
        ]);
    }

    public function show(Admin $admin)
    {
        $adminProfile = $admin->adminProfile;

        $age = date_diff(date_create($adminProfile->birth), date_create('today'))->y;

        $birthDate = Carbon::createFromFormat('Y-m-d', $adminProfile->birth);
        $today = Carbon::now();

        $isBirthday = $birthDate->format('md') === $today->format('md');

        return Inertia::render('Admin/Admin/Show', [
            'admin' => $admin,
            'adminProfile' => $adminProfile,
            'age' => $age,
            'isBirthday' => $isBirthday,
        ]);
    }
}
