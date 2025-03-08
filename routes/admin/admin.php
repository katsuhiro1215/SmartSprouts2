<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\Person\AdminController;
use App\Http\Controllers\Admin\Person\EmployeeController;
use App\Http\Controllers\Admin\Person\AdminProfileController;
use App\Http\Controllers\Admin\Person\AdminEnrollmentController;

// 自身のアカウント管理
Route::prefix('account')->name('account.')->controller(AdminController::class)->group(function () {
  Route::get('/edit', 'edit')->name('edit');
  Route::patch('/', 'update')->name('update');
});

// 管理者管理
Route::prefix('admin')->name('admin.')->controller(AdminController::class)->group(function () {
  Route::get('index', 'index')->name('index');
  Route::get('{admin}/show', 'show')->name('show');
});

// 従業員管理
Route::prefix('employee')->name('employee.')->controller(EmployeeController::class)->group(function () {
  /* ----- 全体 ----- */
  Route::get('index', 'index')->name('index');
  Route::get('create', 'create')->name('create');
  Route::post('/', 'employeeStore')->name('store');
  Route::get('{employee}/show', 'show')->name('show');
  Route::get('{employee}/edit', 'edit')->name('edit');
  Route::patch('{employee}', 'update')->name('update');
  Route::delete('{employee}', 'destroy')->name('destroy');
  // 復活 / 完全削除
  Route::get('{employee}/restore', 'restore')->name('restore');
  Route::get('{employee}/forceDelete', 'forceDelete')->name('forceDelete');
  // Excel
  Route::get('import', 'import')->name('import');
  Route::get('export', 'export')->name('export');
  // QRコード / カード
  Route::get('{employee}/qrcode', 'generateQRCode')->name('generateQRCode');
  Route::get('{employee}/card', 'card')->name('card');

  // 店舗別
  Route::prefix('{store}')->name('store.')->group(function () {
    Route::get('index', 'employeeIndex')->name('index');
    Route::get('create', 'employeeCreate')->name('create');
    Route::post('/', 'employeeStore')->name('store');
    Route::get('{employee}/show', 'employeeShow')->name('show');
    Route::get('{employee}/edit', 'employeeEdit')->name('edit');
    Route::patch('{employee}', 'employeeUpdate')->name('update');
    Route::delete('{employee}', 'employeeDestroy')->name('destroy');
    Route::get('{employee}/restore', 'employeeRestore')->name('restore');
    Route::get('{employee}/forceDelete', 'employeeForceDelete')->name('forceDelete');
    Route::get('import', 'adminImport')->name('import');
    Route::get('export', 'adminExport')->name('export');
    Route::get('{employee}/qrcode', 'generateQRCode')->name('generateQRCode');
    Route::get('{employee}/card', 'card')->name('card');
  });
});

// その他管理
Route::prefix('other')->name('other.')->controller(AdminController::class)->group(function () {
  /* ----- 全体 ----- */
  Route::get('index', 'otherIndex')->name('index');
  Route::get('create', 'otherCreate')->name('create');
  Route::post('/', 'otherStore')->name('store');
  Route::get('{other}/show', 'otherShow')->name('show');
  Route::get('{other}/edit', 'otherEdit')->name('edit');
  Route::patch('{other}', 'otherUpdate')->name('update');
  Route::delete('{other}', 'otherDestroy')->name('destroy');
  // 復活 / 完全削除
  Route::get('{other}/restore', 'otherRestore')->name('restore');
  Route::get('{other}/forceDelete', 'otherForceDelete')->name('forceDelete');
  // Excel
  Route::get('import', 'adminImport')->name('import');
  Route::get('export', 'adminExport')->name('export');
  // QRコード / カード
  Route::get('{other}/qrcode', 'generateQRCode')->name('generateQRCode');
  Route::get('{other}/card', 'card')->name('card');

  // 店舗別
  Route::prefix('{store}')->name('store.')->group(function () {
    Route::get('index', 'otherIndex')->name('index');
    Route::get('create', 'otherCreate')->name('create');
    Route::post('/', 'otherStore')->name('store');
    Route::get('{other}/show', 'otherShow')->name('show');
    Route::get('{other}/edit', 'otherEdit')->name('edit');
    Route::patch('{other}', 'otherUpdate')->name('update');
    Route::delete('{other}', 'otherDestroy')->name('destroy');
    Route::get('{other}/restore', 'otherRestore')->name('restore');
    Route::get('{other}/forceDelete', 'otherForceDelete')->name('forceDelete');
    Route::get('import', 'adminImport')->name('import');
    Route::get('export', 'adminExport')->name('export');
    Route::get('{other}/qrcode', 'generateQRCode')->name('generateQRCode');
    Route::get('{other}/card', 'card')->name('card');
  });
});


// Auth Profile
Route::controller(AdminProfileController::class)->prefix('profile')->group(function () {
  Route::get('/show', 'show')->name('profile.show');
  Route::get('/edit', 'edit')->name('profile.edit');
  Route::patch('/', 'update')->name('profile.update');
});

// Admin Profile
Route::controller(AdminProfileController::class)->prefix('adminProfile')->group(function () {
  // All
  Route::get('/{admin}/create', 'adminProfileCreate')->name('adminProfile.create');
  Route::post('/', 'adminProfileStore')->name('adminProfile.store');
  Route::get('/{admin}/{adminProfile}/edit', 'adminProfileEdit')->name('adminProfile.edit');
  Route::put('/{adminProfile}', 'adminProfileUpdate')->name('adminProfile.update');
  // 店舗別
  Route::prefix('{store}')->group(function () {
    Route::get('/{admin}/create', 'adminProfileCreate')->name('adminProfile.store.create');
    Route::post('/', 'adminProfileStore')->name('adminProfile.store.store');
    Route::get('/{admin}/{adminProfile}/edit', 'adminProfileEdit')->name('adminProfile.store.edit');
    Route::put('/{adminProfile}', 'adminProfileUpdate')->name('adminProfile.store.update');
  });
});

// Admin Enrollment
Route::controller(AdminEnrollmentController::class)->prefix('adminEnrollment')->group(function () {
  // All
  Route::get('/{admin}/create', 'create')->name('adminEnrollment.create');
  Route::post('/', 'store')->name('adminEnrollment.store');
  Route::get('/{admin}/{adminEnrollment}/editApplication', 'editApplication')->name('adminEnrollment.editApplication');
  Route::put('/{adminEnrollment}/updateApplication', 'updateApplication')->name('adminEnrollment.updateApplication');
  Route::get('/{admin}/{adminEnrollment}/suspendEnrollment', 'suspendEnrollment')->name('adminEnrollment.suspendEnrollment');
  Route::put('/{adminEnrollment}/suspendUpdate', 'suspend')->name('adminEnrollment.suspend');
  Route::get('/{admin}/{adminEnrollment}/withdrawEnrollment', 'withdrawEnrollment')->name('adminEnrollment.withdrawEnrollment');
  Route::get('/{adminEnrollment}', 'restoreFromSuspension')->name('adminEnrollment.restoreFromSuspension');
  // 店舗別
  Route::prefix('{store}')->group(function () {
    Route::get('/{admin}/create', 'create')->name('adminEnrollment.store.create');
    Route::post('/', 'store')->name('adminEnrollment.store.store');
    Route::get('/{admin}/{adminEnrollment}/editApplication', 'editApplication')->name('adminEnrollment.store.editApplication');
    Route::put('/{adminEnrollment}/updateApplication', 'updateApplication')->name('adminEnrollment.store.updateApplication');
    Route::get('/{admin}/{adminEnrollment}/suspendEnrollment', 'suspendEnrollment')->name('adminEnrollment.store.suspendEnrollment');
    Route::put('/{adminEnrollment}/suspendUpdate', 'suspend')->name('adminEnrollment.store.suspend');
    Route::get('/{admin}/{adminEnrollment}/withdrawEnrollment', 'withdrawEnrollment')->name('adminEnrollment.store.withdrawEnrollment');
    Route::get('/{adminEnrollment}', 'restoreFromSuspension')->name('adminEnrollment.store.restoreFromSuspension');
  });
});
