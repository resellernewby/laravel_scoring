<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\ConsumableController;
use App\Http\Controllers\DamagedAssetController;
use App\Http\Controllers\FundsSourceController;
use App\Http\Controllers\NonConsumableController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\RackController;
use App\Http\Controllers\SettingContoller;
use App\Http\Controllers\SuplierController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\WarehouseController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth', 'role:admin'])
    ->group(function () {
        Route::get('/consumables', [ConsumableController::class, 'index'])->name('consumable.index');
        Route::get('/consumables/check-in', [ConsumableController::class, 'checkin'])->name('consumable.checkin');
        Route::get('/consumables/{asset}', [ConsumableController::class, 'show'])->name('consumable.show');
        Route::get('/consumables/{asset}/edit', [ConsumableController::class, 'edit'])->name('consumable.edit');
        Route::get('/non-consumables', [NonConsumableController::class, 'index'])->name('non-consumable.index');
        Route::get('/non-consumables/check-in', [NonConsumableController::class, 'checkin'])->name('non-consumable.checkin');
        Route::get('/non-consumables/{asset}', [NonConsumableController::class, 'show'])->name('non-consumable.show');
        Route::get('/non-consumables/{asset}/edit', [NonConsumableController::class, 'edit'])->name('non-consumable.edit');
        Route::get('/damaged-assets', [DamagedAssetController::class, 'index'])->name('damaged-asset.index');
        Route::get('/histories', HistoryController::class)->name('history');
        Route::get('/tags', TagController::class)->name('tag');
        Route::get('/locations', LocationController::class)->name('location');
        Route::get('/brands', BrandController::class)->name('brand');
        Route::get('/supliers', SuplierController::class)->name('suplier');
        Route::get('/funds-sources', FundsSourceController::class)->name('funds-source');
        Route::get('/warehouses', WarehouseController::class)->name('warehouse');
        Route::get('/warehouses/{id}/racks', RackController::class)->name('showRacks');
        Route::get('/settings', [SettingContoller::class, 'index'])->name('setting.index');
        Route::get('/settings/notification', [SettingContoller::class, 'notification'])->name('setting.notification');
        Route::get('/settings/item-condition', [SettingContoller::class, 'condition'])->name('setting.item-condition');
        Route::get('/settings/item-status', [SettingContoller::class, 'status'])->name('setting.item-status');
        Route::get('/settings/damaged-item', [SettingContoller::class, 'damaged'])->name('setting.damaged-item');
    });
