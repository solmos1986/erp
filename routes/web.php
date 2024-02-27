<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\EgresoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;
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

// crea todas las rutas posibles que tendrá nuestro sistema

Route::get('almacen/categoria', [CategoriaController::class, 'index'])->name('index.categoria');
Route::post('almacen/categoria', [CategoriaController::class, 'store']);
Route::put('almacen/categoria/{id}', [CategoriaController::class, 'update']);
Route::get('almacen/categoria/{id}', [CategoriaController::class, 'edit'])->name('edita.categoria');
Route::delete('almacen/categoria/{id}', [CategoriaController::class, 'destroy']);
//
Route::get('almacen/producto', [ProductoController::class, 'index'])->name('index.producto');
Route::get('almacen/producto/index', [ProductoController::class, 'index']);
Route::post('almacen/producto', [ProductoController::class, 'store']);
Route::get('almacen/producto/create', [ProductoController::class, 'create'])->name('create.producto');
Route::post('almacen/producto/update', [ProductoController::class, 'update'])->name('update.producto');
Route::get('almacen/producto/{id}', [ProductoController::class, 'edit'])->name('edita.producto');
Route::delete('almacen/producto/{id}', [ProductoController::class, 'destroy']);
//
Route::get('comercial/cliente', [ClienteController::class, 'index'])->name('index.cliente');
Route::post('comercial/cliente', [ClienteController::class, 'store']);
Route::put('comercial/cliente/{id}', [ClienteController::class, 'update']);
Route::get('comercial/cliente/{id}', [ClienteController::class, 'edit'])->name('edita.cliente');
Route::delete('comercial/cliente/{id}', [ClienteController::class, 'destroy']);
//dd("route ok");
//
Route::get('almacen/proveedor', [ProveedorController::class, 'index'])->name('index.proveedor');
Route::post('almacen/proveedor', [ProveedorController::class, 'store']);
Route::put('almacen/proveedor/{id}', [ProveedorController::class, 'update']);
Route::get('almacen/proveedor/{id}', [ProveedorController::class, 'edit'])->name('edita.proveedor');
Route::delete('almacen/proveedor/{id}', [ProveedorController::class, 'destroy']);

//
Route::get('rrhh/usuario', [UsuarioController::class, 'index'])->name('index.usuario');
Route::post('rrhh/usuario', [UsuarioController::class, 'store']);
Route::put('rrhh/usuario/{id}', [UsuarioController::class, 'update']);
Route::get('rrhh/usuario/{id}', [UsuarioController::class, 'edit'])->name('edita.usuario');
Route::delete('rrhh/usuario/{id}', [UsuarioController::class, 'destroy']);
//
//
Route::get('comercial/compra', [EgresoController::class, 'index'])->name('index.compra');
Route::post('comercial/compra', [EgresoController::class, 'store']);
Route::get('comercial/compra/create', [EgresoController::class, 'create'])->name('create.compra');
Route::put('comercial/compra/{id}', [EgresoController::class, 'update']);
Route::get('comercial/compra/{id}', [EgresoController::class, 'edit'])->name('edita.compra');
Route::delete('comercial/compra/{id}', [EgresoController::class, 'destroy']);

Route::prefix('auth')->group(function () {
    Route::get('login', [AuthController::class, 'index'])->name('auth.login');
    Route::post('login', [AuthController::class, 'verificar'])->name('auth.validate');
    Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');
    //Route::delete('login', [EgresoController::class, 'destroy']);
});

Route::get('/', function () {
    return redirect()->route('index.compra');
});

Route::prefix('roles')->group(function () {
    Route::get('/', [RolController::class, 'index'])->name('rol.index');
    Route::get('/data-table', [RolController::class, 'data_table'])->name('rol.data_table');
    Route::get('/create', [RolController::class, 'create'])->name('rol.create');
    Route::post('/store', [RolController::class, 'store'])->name('rol.store');
    Route::get('/{id}', [RolController::class, 'edit'])->name('rol.edit');
    Route::put('/{id}', [RolController::class, 'update'])->name('rol.update');
    Route::delete('/{id}', [RolController::class, 'destroy'])->name('rol.destroy');
});
