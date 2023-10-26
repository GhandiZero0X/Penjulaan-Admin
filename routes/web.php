<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\DashboardController;
use Illuminate\Routing\Route as RoutingRoute;

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

// Page Auth Routes
Route::get('/login', [LoginController::class, 'index'])->name('login.user');
Route::get('/Register', [RegisterController::class, 'index'])->name('register.user');

// Page Admin Routes
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Page Role Routes
Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
Route::post('/roles', [RoleController::class, 'create'])->name('roles.store');
Route::put('/roles/{idrole}', [RoleController::class, 'update'])->name('roles.update');
Route::put('/roles/{idrole}/softdelete', [RoleController::class, 'softDelete'])->name('roles.softdelete');
Route::get('/soft-deleted-roles', [RoleController::class, 'getSoftDeletedRoles'])->name('roles.getsoftdeleted');
Route::put('/restore-role/{id}', [RoleController::class, 'restoreRole'])->name('role.restore');

// Page Satuan Routes
Route::get('/satuans', [SatuanController::class, 'index'])->name('satuans.index');
Route::post('/satuans', [SatuanController::class, 'create'])->name('satuans.store');
Route::put('/satuans/{idsatuan}', [SatuanController::class, 'update'])->name('satuans.update');
Route::put('/satuans/{idsatuan}/softdelete', [SatuanController::class, 'softDelete'])->name('satuans.softdelete');
Route::get('/soft-deleted-satuans', [SatuanController::class, 'getSoftDeletedSatuans'])->name('satuans.getsoftdeleted');
Route::put('/restore-satuan/{id}', [SatuanController::class, 'restoreSatuan'])->name('satuan.restore');

// Page Vendor Routes
Route::get('/suppliers', [SupplierController::class, 'index'])->name('suppliers.index');
Route::post('/suppliers', [SupplierController::class, 'create'])->name('suppliers.store');
Route::put('/suppliers/{idsupplier}', [SupplierController::class, 'update'])->name('suppliers.update');
Route::put('/suppliers/{idsupplier}/softdelete', [SupplierController::class, 'softDelete'])->name('suppliers.softdelete');
Route::get('/soft-deleted-suppliers', [SupplierController::class, 'getSoftDeletedSuppliers'])->name('suppliers.getsoftdeleted');
Route::put('/restore-supplier/{id}', [SupplierController::class, 'restoreSupplier'])->name('supplier.restore');

// Page User Routes
Route::get('/users', [UserController::class, 'index'])->name('user.index');
Route::post('/users', [UserController::class, 'store'])->name('user.store');
Route::put('/users/{iduser}', [UserController::class, 'update'])->name('user.update');
Route::put('/users/{iduser}/softdelete', [UserController::class, 'softDelete'])->name('user.softdelete');
Route::get('/soft-deleted-users', [UserController::class, 'getSoftDeletedUsers'])->name('user.getsoftdeleted');
Route::put('/restore-users/{id}', [SupplierController::class, 'restoreUser'])->name('user.restore');

// Page Barang Routes
Route::get('/barang', [BarangController::class, 'index'])->name('barang.index');
Route::get('/barang/create', [BarangController::class, 'create'])->name('barang.create');
Route::post('/barang', [BarangController::class, 'store'])->name('barang.store');
Route::get('/barang/{idbarang}/edit', [BarangController::class, 'edit'])->name('barang.edit');
Route::put('/barang/{idbarang}', [BarangController::class, 'update'])->name('barang.update');
Route::put('/barang/{idbarang}/softdelete', [BarangController::class, 'softDelete'])->name('barang.softdelete');

