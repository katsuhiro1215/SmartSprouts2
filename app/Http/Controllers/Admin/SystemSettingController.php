<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SystemSettingRequest;
use App\Models\SystemSetting;
use Inertia\Inertia;

class SystemSettingController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Settings/SystemSettings/Show', [
            'systemSetting' => SystemSetting::select('id', 'name', 'description', 'version', 'frontend', 'backend', 'system_photo_path', 'system_logo_path', 'website', 'facebook', 'twitter', 'instagram', 'youtube', 'line', 'opening_date')->first(),
        ]);
    }

    public function edit(SystemSetting $systemSetting)
    {
        return Inertia::render('Admin/Settings/SystemSettings/Edit', [
            'systemSetting' => $systemSetting,
        ]);
    }

    public function update(SystemSettingRequest $request, SystemSetting $systemSetting)
    {
        //
    }
}
