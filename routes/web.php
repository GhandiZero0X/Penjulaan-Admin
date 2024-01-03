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
use App\Http\Controllers\HomeKasirController;
use App\Http\Controllers\PenerimaanController;
use App\Http\Controllers\PengadaanController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\ReturController;
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
// Route::group(['middleware' => 'user'], function () {
//     //
// });

// Page Auth Routes Login
Route::get('/login', [LoginController::class, 'index'])->name('login.user');
Route::post('/Login/submit', [LoginController::class, 'submitLogin'])->name('loginSubmit.user');

// Page Auth Routes Register
Route::get('/Register', [RegisterController::class, 'index'])->name('register.user');
Route::post('/Register/submit',[RegisterController::class, 'submitRegis'])->name('registerSubmit.user');

// Page Dashboard Admin Routes
Route::get('/Dashboard-admin', [DashboardController::class, 'index'])->name('dashboard');

// Page Home Kasir Route
Route::get('/Home-kasir', [HomeKasirController::class, 'index'])->name('home.Kasir');
Route::post('/Home-kasir/caribarang', [HomeKasirController::class, 'cariBarang'])->name('home.kasirCari');

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
Route::post('/users', [UserController::class, 'create'])->name('user.create');
Route::put('/users/{iduser}', [UserController::class, 'update'])->name('user.update');
Route::put('/users/{iduser}/softdelete', [UserController::class, 'softDelete'])->name('user.softdelete');
Route::get('/soft-deleted-users', [UserController::class, 'getSoftDeletedUsers'])->name('user.getsoftdeleted');
Route::put('/restore-users/{id}', [UserController::class, 'restoreUser'])->name('user.restore');

// Page Barang Routes
Route::get('/barang', [BarangController::class, 'index'])->name('barang.index');
Route::post('/barang', [BarangController::class, 'create'])->name('barang.create');
Route::put('/barang/{idbarang}', [BarangController::class, 'update'])->name('barang.update');
Route::put('/barang/{idbarang}/softdelete', [BarangController::class, 'softDelete'])->name('barang.softdelete');
Route::get('/soft-deleted-barang', [BarangController::class, 'getSoftDeletedBarang'])->name('barang.getsoftdeleted');
Route::put('/restore-barang/{id}', [BarangController::class, 'restoreBarang'])->name('barang.restore');

// Page Pengadaan Routes
Route::get('/pengadaan', [PengadaanController::class, 'index'])->name('pengadaan.index');
Route::get('/pengadaan/{idpengadaan}/detail', [PengadaanController::class, 'indexDetail'])->name('pengadaan.detail');
Route::post('/pengadaan', [PengadaanController::class, 'store'])->name('pengadaan.create');
Route::post('/pengadaan/detail/create', [PengadaanController::class, 'storeDetail'])->name('pengadaan.detail.create');
Route::put('/pengadaan/{$idpengadaan}/softdelete', [PengadaanController::class, 'softDelete'])->name('pengadaan.softdelete');
Route::get('/pengadaan/deleted', [PengadaanController::class, 'getDeletedPengadaan'])->name('pengadaan.getsoftdeleted');
Route::put('/restore-pengadaan/{id}', [PengadaanController::class, 'restorePengadaan'])->name('Pengadaan.restore');

// Page Penerimaan Routes
Route::get('/penerimaan', [PenerimaanController::class, 'index'])->name('penerimaan.index');

// Page Retur Routes
Route::get('/retur', [ReturController::class, 'index'])->name('retur.index');

// Page Penjualan Routes
Route::get('/penjualan', [PenjualanController::class, 'index'])->name('penjualan.index');
