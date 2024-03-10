<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorizacionController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\EgresoController;
use App\Http\Controllers\EstadoPedidosController;
use App\Http\Controllers\IngresoController;
use App\Http\Controllers\InscripcionController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\LectoresController;
use App\Http\Controllers\MarcasController;
use App\Http\Controllers\ModuloController;
use App\Http\Controllers\PaquetesGymController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\SubModuloController;
use App\Http\Controllers\SuperModuloController;
use App\Http\Controllers\TipoPagoController;
use App\Http\Controllers\Tipo_ComprobanteController;
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

Route::get('almacen/inventario', [InventarioController::class, 'index'])->name('index.inventario');
Route::post('almacen/inventario', [InventarioController::class, 'store']);
Route::put('almacen/inventario/{id}', [InventarioController::class, 'update']);
Route::get('almacen/inventario/{id}', [InventarioController::class, 'edit'])->name('edita.inventario');
Route::delete('almacen/inventario/{id}', [InventarioController::class, 'destroy']);
//
//

Route::get('almacen/categoria', [CategoriaController::class, 'index'])->name('index.categoria');
Route::post('almacen/categoria', [CategoriaController::class, 'store']);
Route::put('almacen/categoria/{id}', [CategoriaController::class, 'update']);
Route::get('almacen/categoria/{id}', [CategoriaController::class, 'edit'])->name('edita.categoria');
Route::delete('almacen/categoria/{id}', [CategoriaController::class, 'destroy']);
//
//
Route::get('almacen/configurar', [TipoPagoController::class, 'index'])->name('index.configurar');
Route::post('almacen/tipopago', [TipoPagoController::class, 'store'])->name('store.tipopago');
Route::get('almacen/tipopago/editar/{id}', [TipoPagoController::class, 'edit'])->name('editar.tipopago');
Route::put('almacen/tipopago/modificar', [TipoPagoController::class, 'update'])->name('modificar.tipopago');
Route::delete('almacen/tipopago/borrar/{id}', [TipoPagoController::class, 'destroy'])->name('borrar.tipopago');

Route::get('almacen/comprobante', [Tipo_ComprobanteController::class, 'index'])->name('index.tipocomprobante');
Route::post('almacen/tipocomprobante', [Tipo_ComprobanteController::class, 'store'])->name('store.tipocomprobante');
Route::get('almacen/tipocomprobante/editar/{id}', [Tipo_ComprobanteController::class, 'edit'])->name('editar.tipocomprobante');
Route::put('almacen/tipocomprobante/modificar', [Tipo_ComprobanteController::class, 'update'])->name('modificar.tipocomprobante');
Route::delete('almacen/tipocomprobante/borrar/{id}', [Tipo_ComprobanteController::class, 'destroy'])->name('borrar.tipocomprobante');

Route::get('almacen/configurar/index', [EstadoPedidosController::class, 'index'])->name('index.estadopedidos');
Route::post('almacen/configurar/store', [EstadoPedidosController::class, 'store'])->name('store.estadopedidos');
Route::get('almacen/configurar/editar/{id}', [EstadoPedidosController::class, 'edit'])->name('editar.estadopedidos');
Route::put('almacen/configurar/modificar', [EstadoPedidosController::class, 'update'])->name('modificar.estadopedidos');
Route::delete('almacen/configurar/borrar/{id}', [EstadoPedidosController::class, 'destroy'])->name('borrar.estadopedidos');

Route::get('almacen/marcas', [MarcasController::class, 'index'])->name('index.marcas');
Route::post('almacen/marcas', [MarcasController::class, 'store'])->name('store.marcas');
Route::get('almacen/marcas/editar/{id}', [MarcasController::class, 'edit'])->name('editar.marcas');
Route::put('almacen/marcas/modificar', [MarcasController::class, 'update'])->name('modificar.marcas');
Route::delete('almacen/marcas/borrar/{id}', [MarcasController::class, 'destroy'])->name('borrar.marcas');

//
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
Route::post('comercial/clienteImagen', [ClienteController::class, 'Base64toFile']);
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
Route::get('comercial/compra/index', [EgresoController::class, 'index']);
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

Route::prefix('authorizacion')->group(function () {
    Route::get('/', [AuthorizacionController::class, 'index'])->name('authorizacion.index');
    Route::get('/data-table', [AuthorizacionController::class, 'data_table'])->name('authorizacion.data_table');
    Route::get('/create', [AuthorizacionController::class, 'create'])->name('authorizacion.create');
    Route::post('/store', [AuthorizacionController::class, 'store'])->name('authorizacion.store');
    Route::get('/{id}', [AuthorizacionController::class, 'edit'])->name('authorizacion.edit');
    Route::put('/{id}', [AuthorizacionController::class, 'update'])->name('authorizacion.update');
    Route::delete('/{id}', [AuthorizacionController::class, 'destroy'])->name('authorizacion.destroy');
});
Route::prefix('modulo')->group(function () {
    Route::get('/', [ModuloController::class, 'index'])->name('modulo.index');
    Route::get('/icons', [ModuloController::class, 'icons'])->name('modulo.icons');
    Route::get('/data-table', [ModuloController::class, 'data_table'])->name('modulo.data_table');
    Route::get('/create', [ModuloController::class, 'create'])->name('modulo.create');
    Route::post('/', [ModuloController::class, 'store'])->name('modulo.store');
    Route::get('/{id}', [ModuloController::class, 'edit'])->name('modulo.edit');
    Route::put('/{id}', [ModuloController::class, 'update'])->name('modulo.update');
    Route::delete('/{id}', [ModuloController::class, 'destroy'])->name('modulo.destroy');
});
Route::prefix('super-modulo')->group(function () {
    Route::get('/', [SuperModuloController::class, 'index'])->name('super-modulo.index');
    Route::get('/data-table', [SuperModuloController::class, 'data_table'])->name('super-modulo.data_table');
    Route::get('/create', [SuperModuloController::class, 'create'])->name('super-modulo.create');
    Route::post('/store', [SuperModuloController::class, 'store'])->name('super-modulo.store');
    Route::get('/{id}', [SuperModuloController::class, 'edit'])->name('super-modulo.edit');
    Route::put('/{id}', [SuperModuloController::class, 'update'])->name('super-modulo.update');
    Route::delete('/{id}', [SuperModuloController::class, 'destroy'])->name('super-modulo.destroy');
});
Route::prefix('sub-modulo')->group(function () {
    Route::get('/', [SubModuloController::class, 'index'])->name('sub-modulo.index');
    Route::get('/data-table', [SubModuloController::class, 'data_table'])->name('sub-modulo.data_table');
    Route::get('/create', [SubModuloController::class, 'create'])->name('sub-modulo.create');
    Route::post('/store', [SubModuloController::class, 'store'])->name('sub-modulo.store');
    Route::get('/{id}', [SubModuloController::class, 'edit'])->name('sub-modulo.edit');
    Route::put('/{id}', [SubModuloController::class, 'update'])->name('sub-modulo.update');
    Route::delete('/{id}', [SubModuloController::class, 'destroy'])->name('sub-modulo.destroy');
});
//
//
Route::get('comercial/venta', [IngresoController::class, 'index'])->name('index.venta');
Route::post('comercial/venta', [IngresoController::class, 'store']);
Route::get('comercial/venta/index', [IngresoController::class, 'index']);
Route::get('comercial/venta/create', [IngresoController::class, 'create'])->name('create.venta');
Route::put('comercial/venta/{id}', [IngresoController::class, 'update']);
Route::get('comercial/venta/{id}', [IngresoController::class, 'edit'])->name('edita.venta');
Route::delete('comercial/venta/{id}', [IngresoController::class, 'destroy']);
//Route::get('comercial/venta/filter', [IngresoController::class, 'filter'])->name('filter.venta');

//
//
Route::get('comercial/inscripcion', [InscripcionController::class, 'index'])->name('index.inscripcion');
Route::post('comercial/inscripcion', [InscripcionController::class, 'store']);
Route::get('comercial/inscripcion/index', [InscripcionController::class, 'index']);
Route::get('comercial/inscripcion/create', [InscripcionController::class, 'create'])->name('create.inscripcion');
Route::put('comercial/inscripcion/{id}', [InscripcionController::class, 'update']);
Route::get('comercial/inscripcion/{id}', [InscripcionController::class, 'edit'])->name('edita.inscripcion');
Route::delete('comercial/inscripcion/{id}', [InscripcionController::class, 'destroy']);
//
//

Route::get('configuracion/lectores', [LectoresController::class, 'index'])->name('index.lector');
Route::post('configuracion/lectores', [LectoresController::class, 'store']);
Route::put('configuracion/lectores/{id}', [LectoresController::class, 'update']);
Route::get('configuracion/lectores/{id}', [LectoresController::class, 'edit'])->name('edita.lector');
Route::delete('configuracion/lectores/{id}', [LectoresController::class, 'destroy']);
//
//
Route::get('almacen/paquetes', [PaquetesGymController::class, 'index'])->name('index.paquete');
Route::post('almacen/paquetes', [PaquetesGymController::class, 'store']);
Route::put('almacen/paquetes/{id}', [PaquetesGymController::class, 'update']);
Route::get('almacen/paquetes/{id}', [PaquetesGymController::class, 'edit'])->name('edita.paquete');
Route::delete('almacen/paquetes/{id}', [PaquetesGymController::class, 'destroy']);

Route::prefix('producto')->group(function () {
    Route::get('/', [ProductoController::class, 'obtener_producto']);
});

Route::prefix('paquetes')->group(function () {
    Route::get('/', [PaquetesGymController::class, 'obtener_paquetes']);
    //Route::get('store', [ProductoController::class, 'obtener_producto']);
});
