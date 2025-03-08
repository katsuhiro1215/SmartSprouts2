<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\NotificationCategoryRequest;
use App\Models\NotificationCategory;
use Inertia\Inertia;

class NotificationCategoryController extends Controller
{
    public function index()
    {
        return Inertia::render('Notification/Category/Index');
    }

    public function create()
    {
        return Inertia::render('Notification/Category/Create');
    }

    public function store(NotificationCategoryRequest $request)
    {
        //
    }

    public function show(NotificationCategory $notificationCategory)
    {
        return Inertia::render('Notification/Category/Show', [
            'notificationCategory' => $notificationCategory,
        ]);
    }

    public function edit(NotificationCategory $notificationCategory)
    {
        return Inertia::render('Notification/Category/Edit', [
            'notificationCategory' => $notificationCategory,
        ]);
    }

    public function update(NotificationCategoryRequest $request, NotificationCategory $notificationCategory)
    {
        //
    }

    public function destroy(NotificationCategory $notificationCategory)
    {
        //
    }
}
