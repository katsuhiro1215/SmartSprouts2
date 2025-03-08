<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Class\ClassController;
use App\Http\Controllers\Admin\Class\LessonController;
use App\Http\Controllers\Admin\Class\CourseCategoryController;
use App\Http\Controllers\Admin\Class\CourseController;
use App\Http\Controllers\Admin\Class\RoomController;


// Class (Dashboard)
Route::controller(ClassController::class)->prefix('class')->group(function () {
  Route::get('/', 'index')->name('class.index');
});

// Lesson
Route::resource('/lesson', LessonController::class);
Route::controller(LessonController::class)->prefix('lesson')->group(function () {
  Route::get('/{lesson}/restore', 'restore')->name('lesson.restore');
  Route::delete('/{lesson}/forceDelete', 'forceDelete')->name('lesson.forceDelete');
});

// Course Category
Route::resource('/courseCategory', CourseCategoryController::class);
Route::controller(CourseCategoryController::class)->prefix('courseCategory')->group(function () {
  Route::get('/{courseCategory}/restore', 'restore')->name('courseCategory.restore');
  Route::delete('/{courseCategory}/forceDelete', 'forceDelete')->name('courseCategory.forceDelete');
});

// Course
Route::resource('/course', CourseController::class);
Route::controller(CourseController::class)->prefix('course')->group(function () {
  Route::get('/{course}/restore', 'restore')->name('course.restore');
  Route::delete('/{course}/forceDelete', 'forceDelete')->name('course.forceDelete');
  //  以下追加
  Route::get('/{course}/scheduleShow',  'scheduleShow')->name('course.scheduleShow');
  Route::get('/{course}/attendanceShow',  'attendanceShow')->name('course.attendanceShow');
  Route::post('/sortChange', 'sortChange')->name('course.sortChange');
  Route::get('/course/{courseId}/schedules', 'getSchedules')->name('course.schedules');
});

// Room
Route::resource('/room', RoomController::class)->except('index', 'create');
Route::controller(RoomController::class)->prefix('room')->group(function () {
  Route::get('/{course}/index', 'index')->name('room.index');
  Route::get('/{course}/create',  'create')->name('room.create');
  Route::get('/{room}', 'expiredRestore')->name('expiredRoom.restore');
  Route::delete('/{room}', 'expiredDestroy')->name('expiredRoom.destroy');
});
