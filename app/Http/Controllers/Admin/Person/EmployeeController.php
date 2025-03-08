<?php

namespace App\Http\Controllers\Admin\Person;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Admin;
use App\Models\Organization;
use App\Models\Store;
use Inertia\Inertia;
use Inertia\Response;
use Carbon\Carbon;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admins');
    }

    // Employee
    public function index(): Response
    {
        $selectedStoreId = session('selected_store_id', 'default');
        $admin = Auth::user();

        if ($selectedStoreId === 'all') {
            $employees = Admin::employees()->get();
            $expiredEmployees = Admin::employees()->onlyTrashed()->get();

            return Inertia::render('Admin/Employee/Index', [
                'employees' => $employees,
                'expiredEmployees' => $expiredEmployees,
            ]);
        } else {
            if ($selectedStoreId === 'default') {
                $selectedStoreId = $admin->default_store_id;
            }
            $store = Store::findOrFail($selectedStoreId);
            $employees = $store->employees()->get();
            $expiredEmployees = $store->employees()->onlyTrashed()->get();

            return Inertia::render('Admin/Employee/Index', [
                'employees' => $employees,
                'expiredEmployees' => $expiredEmployees,
            ]);
        }
    }

    public function create(): Response
    {
        $selectedStoreId = session('selected_store_id', 'default');

        // Organization id = 2のものを取得
        $organization = Organization::findOrFail(2);

        if ($selectedStoreId === 'all') {
            $stores = Store::findOrFail($selectedStoreId);
        } else {
            if ($selectedStoreId === 'default') {
                // $selectedStoreId = $user->default_store_id;
            }
            $store = Store::findOrfail($selectedStoreId);

            return Inertia::render('Admin/Employee/Create', [
                'store' => $store,
            ]);
        }
    }

    public function store(AdminRequest $request)
    {
        $validatedData = $request->validated();

        $validatedData['password'] = Hash::make($request->password);

        $admin = Admin::create($validatedData);

        $storeId = $request->store_id;

        $admin->stores()->attach($storeId, ['is_default' => true]);

        return to_route('admin.adminProfile.create', ['admin' => $admin->id])->with([
            'message' => '従業員の新規登録に成功しました。プロフィールを登録してください。',
            'status' => 'success',
        ]);
    }

    public function show(Admin $admin)
    {
        $adminProfile = $admin->adminProfile;

        $age = $adminProfile ? date_diff(date_create($adminProfile->birth), date_create('today'))->y : '未登録';

        $birthDate = $adminProfile ? Carbon::createFromFormat('Y-m-d', $adminProfile->birth) : null;
        $today = Carbon::today();

        $isBirthday = $birthDate && $birthDate->format('md') === $today->format('md');
        $schedules = $admin->schedules;

        return Inertia::render('Admin/Employee/Show', [
            'admin' => $admin,
            'adminProfile' => $adminProfile,
            'age' => $age,
            'isBirthday' => $isBirthday,
            'schedules' => $schedules,
        ]);
    }

    public function edit(Admin $admin)
    {
        return Inertia::render('Admin/Employee/Edit', [
            'admin' => $admin,
        ]);
    }

    public function update(AdminRequest $request, Admin $admin)
    {
        $validatedData = $request->validated();

        try {
            DB::transaction(function () use ($admin, $validatedData) {
                $admin->update($validatedData);
            });

            return to_route('admin.admin.index')->with([
                'message' => '従業員の更新に成功しました。',
                'status' => 'success',
            ]);
        } catch (\Throwable $e) {
            Log::error($e);

            return redirect()->back()->with([
                'message' => '従業員の更新に失敗しました。',
                'status' => 'error',
            ]);
        }
    }

    public function destroy(Admin $admin)
    {
        $admin->delete();

        return to_route('admin.admin.index')->with([
            'message' => '従業員の削除に成功しました。',
            'status' => 'success',
        ]);
    }
}
