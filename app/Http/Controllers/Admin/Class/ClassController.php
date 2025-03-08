<?php

namespace App\Http\Controllers\Admin\Class;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ClassController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Classes/Index', [
            'lessons' => Lesson::select('id', 'name')->get()
        ]);
    }
}
