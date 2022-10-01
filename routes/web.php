<?php

use App\Http\Controllers\AssetController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ConsumableController;
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
        Route::get('/consumables', ConsumableController::class)->name('consumable');
        Route::get('/assets', AssetController::class)->name('asset');
        Route::get('/warehouses', WarehouseController::class)->name('warehouse');
        Route::get('/tags', TagController::class)->name('tag');
        Route::get('/brands', BrandController::class)->name('brand');
        Route::get('/warehouses/{id}/racks', RackController::class)->name('showRacks');
    });
