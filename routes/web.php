<?php

use App\Http\Controllers\CheckoutController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\QrController;
use App\Http\Controllers\SaleController;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
// Product views
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/add', [ProductController::class, 'create'])->name('products.add');
Route::get('/products/restock', [ProductController::class, 'showAddStock'])->name('products.showaddstock');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

Route::put('/products/restock', [ProductController::class, 'addStock'])->name('products.addstock');
Route::post('/products', [ProductController::class, 'store']);
Route::post('/products/fetch', [ProductController::class, 'fetch'])->name('products.fetch');
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.delete');
Route::put('/products/{id}', [ProductController::class, 'restock'])->name('products.restock');

// Checkout views
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkouts.index');
Route::get('/checkout/{id}', [CheckoutController::class, 'show'])->name('checkouts.show');

Route::delete('/checkout', [CheckoutController::class, 'reset'])->name('checkouts.reset');
Route::delete('/checkout/{id}', [CheckoutController::class, 'destroy'])->name('checkouts.destroy');
Route::post('/checkout/add', [CheckoutController::class, 'ajaxCheckout']);
Route::post('/checkout', [CheckoutController::class, 'store']);

//Sales
Route::get('/sales', [SaleController::class, 'index'])->name('sales.index');
Route::get('/sales/{id}', [SaleController::class, 'show'])->name('sales.show');


Route::post('/sale', [SaleController::class, 'getChange'])->name('sale.change');
Route::post('/sale/done', [SaleController::class, 'store'])->name('sale.store');
//QRCODE
Route::get('/image/qrcode/{text}', [QrController::class, 'makeQrCode'])->name('qrcode');




require __DIR__ . '/auth.php';
