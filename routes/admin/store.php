<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\StoreController;
use App\Http\Controllers\Admin\StoreScheduleController;

// 店舗
Route::resource('/store', StoreController::class);
Route::controller(StoreController::class)->prefix('store')->group(function () {
  Route::patch('/{store}/restore', 'restore')->name('store.restore');
  Route::delete('/{store}/forceDelete', 'forceDelete')->name('store.forceDelete');
});

// 店舗スケジュール
Route::resource('/storeSchedule', StoreScheduleController::class);
Route::controller(StoreScheduleController::class)->prefix('storeSchedule')->group(function () {
  //現在のスケジュールを取得
  Route::get('/schedule/current', 'current')->name('storeSchedule.current');
  Route::get('/schedule/checkConflicts', 'checkConflicts')->name('storeSchedule.checkConflicts');
  // Import/Export
  Route::get('/importExport', 'importExport')->name('storeSchedule.importExport');
  Route::post('/import', 'import')->name('storeSchedule.import');
  Route::post('/export', 'export')->name('storeSchedule.export');
});