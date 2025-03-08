<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SettingsController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Settings/Index');
    }
    
    public function support()
    {
        return Inertia::render('Admin/Settings/Support');
    }

    public function sitemap()
    {
        return Inertia::render('Admin/Settings/Sitemap');
    }

    public function switchTheme(Request $request)
    {
        $request->validate(['theme' => 'required|in:light,dark']);

        session(['theme' => $request->theme]);

        return redirect()->back()->with([
            'message' => 'テーマの変更に成功しました。',
            'alert-type' => 'success'
        ]);
    }

    public function help()
    {
        return Inertia::render('Admin/Settings/Help');
    }
}
