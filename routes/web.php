<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\VendorController;

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

// Route beranda
// Route::get('/', function () {
//     return view('welcome');
// });

// Page Admin Routes
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Page Role Routes
Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
Route::post('/roles', [RoleController::class, 'create'])->name('roles.store');
Route::put('/roles/{idrole}', [RoleController::class, 'update'])->name('roles.update');
Route::put('/roles/{idrole}/softdelete', [RoleController::class, 'softDelete'])->name('roles.softdelete');
Route::get('/soft-deleted-roles', [RoleController::class, 'getSoftDeletedRoles'])->name('roles.getsoftdeleted');
Route::put('/restore-role/{id}', [RoleController::class, 'restoreRole'])->name('role.restore');


// Page User Routes
Route::get('/users', [UserController::class, 'index'])->name('user.index');
Route::get('/users/create', [UserController::class, 'create'])->name('user.create');
Route::post('/users', [UserController::class, 'store'])->name('user.store');
Route::get('/users/{iduser}/edit', [UserController::class, 'edit'])->name('user.edit');
Route::put('/users/{iduser}', [UserController::class, 'update'])->name('user.update');
Route::put('/users/{iduser}/softdelete', [UserController::class, 'softDelete'])->name('user.softdelete');

// Page Satuan Routes
Route::get('/satuan', [SatuanController::class, 'index'])->name('satuan.index');
Route::get('/satuan/create', [SatuanController::class, 'create'])->name('satuan.create');
Route::post('/satuan', [SatuanController::class, 'store'])->name('satuan.store');
Route::get('/satuan/{idsatuan}/edit', [SatuanController::class, 'edit'])->name('satuan.edit');
Route::put('/satuan/{idsatuan}', [SatuanController::class, 'update'])->name('satuan.update');
Route::put('/satuan/{idsatuan}/softdelete', [SatuanController::class, 'softDelete'])->name('satuan.softdelete');

// Page Barang Routes
Route::get('/barang', [BarangController::class, 'index'])->name('barang.index');
Route::get('/barang/create', [BarangController::class, 'create'])->name('barang.create');
Route::post('/barang', [BarangController::class, 'store'])->name('barang.store');
Route::get('/barang/{idbarang}/edit', [BarangController::class, 'edit'])->name('barang.edit');
Route::put('/barang/{idbarang}', [BarangController::class, 'update'])->name('barang.update');
Route::put('/barang/{idbarang}/softdelete', [BarangController::class, 'softDelete'])->name('barang.softdelete');

// Page Vendor Routes
Route::get('/vendors', [VendorController::class, 'index'])->name('vendor.index');
Route::get('/vendors/create', [VendorController::class, 'create'])->name('vendor.create');
Route::post('/vendors', [VendorController::class, 'store'])->name('vendor.store');
Route::get('/vendors/{idvendor}/edit', [VendorController::class, 'edit'])->name('vendor.edit');
Route::put('/vendors/{idvendor}', [VendorController::class, 'update'])->name('vendor.update');
Route::put('/vendors/{idvendor}/softdelete', [VendorController::class, 'softDelete'])->name('vendor.softdelete');
