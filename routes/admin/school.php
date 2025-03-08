<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\School\SchoolController;

// School
Route::resource('/school', SchoolController::class)->except('create', 'edit');
Route::controller(SchoolController::class)->prefix('school')->group(function () {
  Route::put('/{id}/restore', 'restore')->name('school.restore');
  Route::delete('/{id}/forceDelete', 'forceDelete')->name('school.forceDelete');
});
