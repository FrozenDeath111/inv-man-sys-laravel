<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\InvuserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductStoreController;
use App\Http\Controllers\ProductWarehouseController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\WarehouseStaffController;
use App\Http\Middleware\EnsureAdmin;
use App\Http\Middleware\EnsureManager;
use App\Http\Middleware\EnsureStaff;
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

//General Routing
Route::get('/', [GeneralController::class,'index']);
Route::get('/login', [GeneralController::class,'login']);
Route::get('/logout', [GeneralController::class,'logout']);
Route::get('/dashboard', [GeneralController::class,'dashboard']);
Route::get('/show-product/{id}', [ProductController::class,'show_one'])->middleware(EnsureAdmin::class);
Route::post('/authenticate', [GeneralController::class,'authenticate']);

//Admin Routing
Route::get('/admin/dashboard', [AdminController::class,'index'])->middleware(EnsureAdmin::class);

//Admin User Handle
Route::get('/admin/user-form', [InvuserController::class,'index'])->middleware(EnsureAdmin::class);
Route::post('/admin/register', [InvuserController::class,'store'])->middleware(EnsureAdmin::class);
Route::get('/admin/show-user', [InvuserController::class,'show'])->middleware(EnsureAdmin::class);

//Admin Product Handle
Route::get('/admin/product-form', [ProductController::class,'index'])->middleware(EnsureAdmin::class);
Route::post('/admin/create-product', [ProductController::class,'store'])->middleware(EnsureAdmin::class);
Route::post('/admin/add-stock', [ProductController::class,'add_stock'])->middleware(EnsureAdmin::class);
Route::get('/admin/show-products', [ProductController::class,'show'])->middleware(EnsureAdmin::class);

//Admin Request Handle
Route::get('/admin/show-requests',[ProductController::class,'show_requests'])->middleware(EnsureAdmin::class);
Route::post('/accept-request',[ProductController::class,'accept_request'])->middleware(EnsureAdmin::class);
Route::get('/reject-request/{history_id}',[ProductController::class,'reject_request'])->middleware(EnsureAdmin::class);

//Warehouse Staff Routing
Route::get('/warehouse-staff/dashboard', [WarehouseStaffController::class,'index'])->middleware(EnsureStaff::class);
Route::get('/warehouse-staff/show-pending', [WarehouseStaffController::class,'show_pending'])->middleware(EnsureStaff::class);
Route::get('/warehouse-staff/recieve-product/{history_id}', [ProductWarehouseController::class,'accept_product'])->middleware(EnsureStaff::class);
Route::get('/warehouse-staff/ship-product/{history_id}', [ProductWarehouseController::class,'ship_product'])->middleware(EnsureStaff::class);

//Store Manager Routing
Route::get('/store/dashboard', [StoreController::class,'index'])->middleware(EnsureManager::class);
Route::get('/store/show-products', [ProductStoreController::class,'show_products'])->middleware(EnsureManager::class);
Route::get('/store/to-add-products', [ProductStoreController::class,'to_add_products'])->middleware(EnsureManager::class);
Route::get('/add-product/{product_id}/{store_id}', [ProductStoreController::class,'add_product'])->middleware(EnsureManager::class);
Route::post('/request-stock', [ProductStoreController::class,'request_stock'])->middleware(EnsureManager::class);
Route::post('/sale-stock', [ProductStoreController::class,'sale_stock'])->middleware(EnsureManager::class);

