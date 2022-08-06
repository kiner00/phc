<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Dashboard\Dashboard;
use App\Http\Livewire\User\User;
use App\Http\Livewire\Manufacturer\Manufacturer;
use App\Http\Livewire\Manufacturer\ManufacturerAccount;
use App\Http\Livewire\Product\ProductCategory;
use App\Http\Livewire\Product\Product;
use App\Http\Livewire\PurchaseOrder\PurchaseOrder;
use App\Http\Livewire\PurchaseOrder\PurchaseOrderPayment;
use App\Http\Livewire\Logistic\Logistic;
use App\Http\Livewire\Logistic\ManualStock;
use App\Http\Livewire\Order\Order;
use App\Http\Livewire\Order\Platform;
use App\Http\Livewire\Employee;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', Dashboard::class)->middleware(['auth']);
Route::get('/dashboard', Dashboard::class)->middleware(['auth']);

Route::get('/users', User::class)->middleware(['auth']);
// Route::get('/employee', Employee::class)->middleware(['auth']);

Route::get('/manufacturers', Manufacturer::class)->middleware(['auth']);
Route::get('/manufacturer-accounts', ManufacturerAccount::class)->middleware(['auth']);

Route::get('/products', Product::class)->middleware(['auth']);
Route::get('/product-category', ProductCategory::class)->middleware(['auth']);

Route::get('/purchase-orders', PurchaseOrder::class)->middleware(['auth']);
Route::get('/purchase-order/payments', PurchaseOrderPayment::class)->middleware(['auth']);

Route::get('/logistics', Logistic::class)->middleware(['auth']);
Route::get('/logistic/manual-stocks', ManualStock::class)->middleware(['auth']);

Route::get('/orders', Order::class)->middleware(['auth']);
Route::get('/platforms', Platform::class)->middleware(['auth']);

require __DIR__.'/auth.php';

