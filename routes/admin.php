<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SystemSettingController;

use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\WidgetController;
use App\Http\Controllers\Admin\ContactController;

require __DIR__ . '/admin_auth.php';

Route::middleware(['auth:admins', 'verified'])->group(function () {
    Route::controller(DashboardController::class)->prefix('dashboard')->group(function () {
        // All
        Route::get('/', 'index')->name('dashboard');
        // Store
        Route::prefix('{store}')->group(function () {
            Route::get('/', 'index')->name('dashboard.store');
        });
    });
    // System Setting (システム設定)
    Route::resource('/systemSetting', SystemSettingController::class)->only('index', 'show', 'edit', 'update');
    // Setting
    Route::controller(SettingsController::class)->prefix('settings')->group(function () {
        Route::get('/', 'index')->name('settings.index');
        Route::get('/support', 'support')->name('setting.support');
        Route::get('/sitemap', 'sitemap')->name('setting.sitemap');
        Route::post('/switch-store', 'switchStore')->name('switch.store');
        Route::post('/switch-theme', 'switchTheme')->name('switch.theme');
    });



    require __DIR__ . '/admin/school.php';

    require __DIR__ . '/admin/admin.php';
    require __DIR__ . '/admin/store.php';

    require __DIR__ . '/admin/user.php';

    require __DIR__ . '/admin/class.php';

    require __DIR__ . '/admin/questionnaire.php';

    Route::resource('event', EventController::class);
    Route::resource('contact', ContactController::class)->only('index', 'show', 'edit');

    Route::resource('widget', WidgetController::class);
});
