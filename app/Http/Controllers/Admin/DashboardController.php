<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Store;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admins');
    }

    public function index()
    {
        $stores = Store::select('id', 'name')->get();

        return Inertia::render('Admin/Index', [
            'stores' => $stores
        ]);
    }
}
