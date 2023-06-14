<?php

use App\Http\Controllers\{
    ProdukController,
};
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('/produk/data', [ProdukController::class, 'data'])->name('produk.data');
Route::resource('/produk', ProdukController::class);
Route::get('/import-data', [ProdukController::class, 'import']);