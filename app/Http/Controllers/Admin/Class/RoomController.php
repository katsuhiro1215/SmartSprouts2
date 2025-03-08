<?php

namespace App\Http\Controllers\Admin\Class;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoomRequest;
use App\Models\Room;
use Inertia\Inertia;

class RoomController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Room/Index', [
            'rooms' => Room::select('id', 'name')->get(),
        ]);
    }

    public function create()
    {
        //
    }

    public function store(RoomRequest $request)
    {
        //
    }

    public function show(Room $room)
    {
        //
    }

    public function edit(Room $room)
    {
        //
    }

    public function update(RoomRequest $request, Room $room)
    {
        //
    }

    public function destroy(Room $room)
    {
        //
    }
}
