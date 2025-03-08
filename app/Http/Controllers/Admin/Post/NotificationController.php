<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\NotificationRequest;
use App\Models\Notification;
use Inertia\Inertia;

class NotificationController extends Controller
{
    public function index()
    {
        return Inertia::render('Notification/Index', [
            'notifications' => Notification::all(),
        ]);
    }

    public function create()
    {
        return Inertia::render('Notification/Create');
    }

    public function store(NotificationRequest $request)
    {
        //
    }

    public function show(Notification $Notification)
    {
        //
    }

    public function edit(Notification $notification)
    {
        //
    }

    public function update(NotificationRequest $request, Notification $notification)
    {
        //
    }

    public function destroy(Notification $notification)
    {
        //
    }
}
