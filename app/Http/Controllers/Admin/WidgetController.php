<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\WidgetRequest;
use App\Models\Widget;
use Inertia\Inertia;

class WidgetController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admins');
    }

    public function index()
    {
        return Inertia('Admin/Widgets/Index', [
            'widgets' => Widget::select('id', 'name')->get()
        ]);
    }

    public function create()
    {
        return Inertia('Admin/Widgets/Create');
    }

    public function store(WidgetRequest $request)
    {
        //
    }

    public function show(Widget $widget)
    {
        //
    }

    public function edit(Widget $widget)
    {
        //
    }

    public function update(WidgetRequest $request, Widget $widget)
    {
        //
    }

    public function destroy(Widget $widget)
    {
        //
    }
}
