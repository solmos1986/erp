<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {

    }
    public function obtener_ventas(Request $request) //recibe como parametro un objeto tipo request
    {
        //dd($request, "LLEGUE DASHBOARD");
        $cliente = DB::table('cliente')->where('condicionCliente', '=', '1')->get();
        $tipopago = DB::table('tipopago')->where('condicionTipoPago', '=', '1')->get();
        $tipo_comprobante = DB::table('tipo_comprobante')->where('condicionTipo_Comprobante', '=', '1')->get();
        $usuario = DB::table('usuario')->where('condicionUsuario', '=', '1')->get();
        $query = trim($request->get('searchText'));
        if ($request->ajax()) {
            $data = DB::table('ingresos as i')
                ->select('i.idIngreso', 'i.fechaIngreso', 'c.nomCliente', 'tc.nomTipoComprobante', 'i.impuestoIngreso', 'tp.nomTipoPago', DB::raw('sum(di.cantidadVenta*precioVenta) as total'), 'i.estadoIngreso', 'u.nomUsuario', /* 'sum(total) as totales' */)

                ->join('cliente as c', 'i.idCliente', '=', 'c.idCliente')
                ->join('detalle_ingreso as di', 'i.idIngreso', '=', 'di.idIngreso')
                ->join('tipo_comprobante as tc', 'i.idTipoComprobante', '=', 'tc.idTipoComprobante')
                ->join('tipopago as tp', 'i.idTipoPago', '=', 'tp.idTipoPago')
                ->join('usuario as u', 'i.idUsuario', '=', 'u.idUsuario')
                ->when(($request->get('startDate') != '' && $request->get('endDate') != ''), function ($query) use ($request) {
                    $query->where('i.fechaIngreso', '>=', $request->get('startDate'))
                        ->where('i.fechaIngreso', '<=', $request->get('endDate'));
                })
                ->when(($request->get('idCliente') != ''), function ($query) use ($request) {
                    $query->where('i.idCliente', '=', $request->get('idCliente'));

                })
                ->when(($request->get('idTipoComprobante') != ''), function ($query) use ($request) {
                    $query->where('i.idTipoComprobante', '=', $request->get('idTipoComprobante'));

                })
                ->when(($request->get('idTipoPago') != ''), function ($query) use ($request) {
                    $query->where('i.idTipoPago', '=', $request->get('idTipoPago'));

                })
                ->when(($request->get('idUsuario') != ''), function ($query) use ($request) {
                    $query->where('i.idUsuario', '=', $request->get('idUsuario'));

                })
                ->where('i.fechaIngreso', '>=', $request->get('startDate'))
                ->where('i.fechaIngreso', '<=', $request->get('endDate'))
                ->groupBy('i.idIngreso', 'i.fechaIngreso', 'c.nomCliente', 'tc.nomTipoComprobante', 'i.impuestoIngreso', 'tp.nomTipoPago', 'u.nomUsuario', 'i.estadoIngreso')
                ->get()->toArray();

            $data2 = DB::table('egresos as e')
                ->select('e.idEgreso', 'e.fechaEgreso', 'p.nomProveedor', 'tc.nomTipoComprobante', 'e.numeroComprobante', 'e.impuestoEgreso', 'tp.nomTipoPago', DB::raw('sum(de.cantidadCompra*precioCompraEgreso) as total'), 'u.nomUsuario', 'e.estadoEgreso')
                ->join('proveedor as p', 'e.idProveedor', '=', 'p.idProveedor')
                ->join('detalle_egreso as de', 'e.idEgreso', '=', 'de.idEgreso')
                ->join('tipo_comprobante as tc', 'e.idTipoComprobante', '=', 'tc.idTipoComprobante')
                ->join('tipopago as tp', 'e.idTipoPago', '=', 'tp.idTipoPago')
                ->join('usuario as u', 'e.idUsuario', '=', 'u.idUsuario')
                ->when(($request->get('startDate') != '' && $request->get('endDate') != ''), function ($query) use ($request) {
                    $query->where('e.fechaEgreso', '>=', $request->get('startDate'))
                        ->where('e.fechaEgreso', '<=', $request->get('endDate'));
                })
                ->when(($request->get('idCliente') != ''), function ($query) use ($request) {
                    $query->where('e.idCliente', '=', $request->get('idCliente'));

                })
                ->when(($request->get('idTipoComprobante') != ''), function ($query) use ($request) {
                    $query->where('e.idTipoComprobante', '=', $request->get('idTipoComprobante'));

                })
                ->when(($request->get('idTipoPago') != ''), function ($query) use ($request) {
                    $query->where('e.idTipoPago', '=', $request->get('idTipoPago'));

                })
                ->when(($request->get('idUsuario') != ''), function ($query) use ($request) {
                    $query->where('e.idUsuario', '=', $request->get('idUsuario'));

                })
                ->where('e.fechaEgreso', '>=', $request->get('startDate'))
                ->where('e.fechaEgreso', '<=', $request->get('endDate'))
                ->where('e.numeroComprobante', 'LIKE', '%' . $query . '%')
                ->groupBy('e.idEgreso', 'e.fechaEgreso', 'p.nomProveedor', 'tc.nomTipoComprobante', 'e.numeroComprobante', 'e.impuestoEgreso', 'tp.nomTipoPago', 'u.nomUsuario', 'e.estadoEgreso')
                ->get()->toArray();
            $data3 = DB::table('inscripcion as in')
                ->select('in.idInscripcion', 'in.fechaInscripcion', 'c.nomCliente', 'tc.nomTipoComprobante', 'in.impuestoInscripcion', 'tp.nomTipoPago', 'di.costoPaquete', 'u.nomUsuario', 'in.estadoInscripcion')
                ->join('cliente as c', 'in.idCliente', '=', 'c.idCliente')
                ->join('detalle_inscripcion as di', 'in.idInscripcion', '=', 'di.idInscripcion')
                ->join('tipo_comprobante as tc', 'in.idTipoComprobante', '=', 'tc.idTipoComprobante')
                ->join('tipopago as tp', 'in.idTipoPago', '=', 'tp.idTipoPago')
                ->join('usuario as u', 'in.idUsuario', '=', 'u.idUsuario')
                ->when(($request->get('startDate') != '' && $request->get('endDate') != ''), function ($query) use ($request) {
                    $query->where('in.fechaInscripcion', '>=', $request->get('startDate'))
                        ->where('in.fechaInscripcion', '<=', $request->get('endDate'));
                })
                ->when(($request->get('idCliente') != ''), function ($query) use ($request) {
                    $query->where('in.idCliente', '=', $request->get('idCliente'));

                })
                ->when(($request->get('idTipoComprobante') != ''), function ($query) use ($request) {
                    $query->where('in.idTipoComprobante', '=', $request->get('idTipoComprobante'));

                })
                ->when(($request->get('idTipoPago') != ''), function ($query) use ($request) {
                    $query->where('in.idTipoPago', '=', $request->get('idTipoPago'));

                })
                ->when(($request->get('idUsuario') != ''), function ($query) use ($request) {
                    $query->where('in.idUsuario', '=', $request->get('idUsuario'));

                })
                ->where('in.fechaInscripcion', '>=', $request->get('startDate'))
                ->where('in.fechaInscripcion', '<=', $request->get('endDate'))
                ->where('tc.nomTipoComprobante', 'LIKE', '%' . $query . '%')

                ->groupBy('in.idInscripcion', 'in.fechaInscripcion', 'c.nomCliente', 'tc.nomTipoComprobante', 'in.impuestoInscripcion', 'tp.nomTipoPago', 'di.costoPaquete', 'u.nomUsuario', 'in.estadoInscripcion')
                ->get()->toArray();

            return response()->json([
                "status" => 1,
                "message" => "GuarDado correctamnte",
                "data" => $data,
                "data2" => $data2,
                "data3" => $data3,
                "cliente" => $cliente,
                "tipopago" => $tipopago,
                "tipo_comprobante" => $tipo_comprobante,
                "usuario" => $usuario,
            ]);

        };

        /*  return view('comercial/venta/index', ['cliente' => $cliente, 'tipopago' => $tipopago, 'tipo_comprobante' => $tipo_comprobante, 'usuario' => $usuario]);
     */
    }
}
