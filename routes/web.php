<?php

use App\Http\Controllers\AssetController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ConsumableController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\RackController;
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
        Route::get('/asset/images/{asset}', [AssetController::class, 'images'])->name('asset.images');
        Route::get('/assets', [AssetController::class, 'index'])->name('asset');
        Route::get('/histories', HistoryController::class)->name('history');
        Route::get('/warehouses', WarehouseController::class)->name('warehouse');
        Route::get('/tags', TagController::class)->name('tag');
        Route::get('/brands', BrandController::class)->name('brand');
        Route::get('/warehouses/{id}/racks', RackController::class)->name('showRacks');
    });
