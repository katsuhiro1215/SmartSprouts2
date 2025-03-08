<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Person\UserController;
use App\Http\Controllers\Admin\Person\StudentController;
use App\Http\Controllers\Admin\Person\GuardianController;
use App\Http\Controllers\Admin\Person\StudentEnrollmentController;
use App\Http\Controllers\Admin\Person\UserAddressController;
use App\Http\Controllers\GuardianUserController;
use App\Http\Controllers\StudentUserController;

// User
Route::resource('/user', UserController::class);
Route::controller(UserController::class)->prefix('user')->group(function () {
  Route::put('/{id}/restore', 'restore')->name('user.restore');
  Route::delete('/{id}/forceDelete', 'forceDelete')->name('user.forceDelete');
  Route::get('bulkCreate', 'bulkCreate')->name('user.bulkCreate');
  Route::get('/user/import', 'userImport')->name('user.import');
  Route::post('/user/import', 'userImportPost')->name('user.import.post');
  Route::get('/user/export', 'userExport')->name('user.export');
  // API
  Route::get('/email/checkEmail', 'checkEmail')->name('user.checkEmail');
});
// User Address
Route::resource('/{user}/userAddress', UserAddressController::class)->except('show');

// Student
Route::resource('/student', StudentController::class)->except('create');
Route::controller(StudentController::class)->prefix('student')->group(function () {
  Route::get('/student/list', 'list')->name('student.list');
  // User - Studentが多対多の関係で登録される場合
  Route::get('/{user}/create', 'create')->name('student.create');
  // Studentが単独(仮登録)で登録される場合
  Route::get('/temp_create', 'temp_create')->name('student.temp_create');
  Route::get('/{user}/add', 'add')->name('student.add');
  Route::post('/addStore', 'addStore')->name('student.addStore');
  Route::put('/{student}/updateStatus', 'updateStatus')->name('student.updateStatus');
  Route::get('/{student}/siblingAdd', 'siblingAdd')->name('student.siblingAdd');
  Route::post('/siblingStore', 'siblingStore')->name('student.siblingStore');
  Route::get('/{id}/qrcode', 'generateQRCode')->name('student.generateQRCode');
  Route::get('/{student}/card', 'card')->name('student.card');
  Route::post('/updateGrade', 'updateGrade')->name('student.updateGrade');
  Route::get('/student/export', 'studentExport')->name('student.export');
});
Route::controller(StudentController::class)->group(function () {
  Route::get('/',  'expiredIndex')->name('expiredStudent.index');
  Route::get('/{student}', 'expiredRestore')->name('expiredStudent.restore');
  Route::delete('/{student}', 'expiredDestroy')->name('expiredStudent.destroy');
});

// Guardian
Route::resource('/guardian', GuardianController::class)->except('create');
Route::controller(GuardianController::class)->prefix('guardian')->group(function () {
  Route::get('/{user}/create', 'create')->name('guardian.create');
  Route::get('/{user}/add', 'add')->name('guardian.add');
  Route::post('/addStore', 'addStore')->name('guardian.addStore');
});
Route::controller(GuardianController::class)->prefix('expiredGuardian')->group(function () {
  Route::get('/',  'expiredIndex')->name('expiredGuardian.index');
  Route::get('/{guardian}', 'expiredRestore')->name('expiredGuardian.restore');
  Route::delete('/{guardian}', 'expiredDestroy')->name('expiredGuardian.destroy');
});

// Relation
// Route::controller(StudentUserController::class)->prefix('studentUser')->group(function () {
//   Route::get('/{student}/create', 'create')->name('relation.create');
//   Route::post('/store', 'store')->name('relation.store');
//   Route::get('/{student}/edit', 'edit')->name('relation.edit');
//   Route::put('/{student}', 'update')->name('relation.update');
//   Route::delete('/{student}', 'destroy')->name('relation.destroy');
// });

// Route::controller(GuardianUserController::class)->prefix('guardianUser')->group(function () {
//   Route::get('/{guardian}/create', 'create')->name('relation.create');
//   Route::post('/store', 'store')->name('relation.store');
//   Route::get('/{guardian}/edit', 'edit')->name('relation.edit');
//   Route::put('/{guardian}', 'update')->name('relation.update');
//   Route::delete('/{guardian}', 'destroy')->name('relation.destroy');
// });
