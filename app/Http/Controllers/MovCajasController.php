<?php

namespace App\Http\Controllers;

use App\Models\DetalleIngreso; //agrega la ruta del modelo
use App\Models\Ingreso; //agrega la ruta del modelo
use Barryvdh\DomPDF\Facade\Pdf; //para hacer algunas redirecciones
use DB; //hace referencia a nuestro request
use Illuminate\Http\Request; // sar la base de datos
use Yajra\DataTables\DataTables;

class MovCajasController extends Controller
{
    public function index(Request $request)
    {
        //dd($request, "cajassss");
        $cliente = DB::table('cliente')->where('condicionCliente', '=', '1')->get();
        $tipopago = DB::table('tipopago')->where('condicionTipoPago', '=', '1')->get();
        $tipo_comprobante = DB::table('tipo_comprobante')->where('condicionTipo_Comprobante', '=', '1')->get();
        $usuario = DB::table('usuario')->where('condicionUsuario', '=', '1')->get();
        $query = trim($request->get('searchText'));
        $datote = DB::table('usuario as u')
            ->select('i.idIngreso', 'i.fechaIngreso', 'tc.nomTipoComprobante', 'tp.nomTipoPago', DB::raw('sum(di.cantidadVenta*precioVenta) as totalVentas'), 'u.nomUsuario' /* 'sum(total) as totales' */)

            ->join('ingresos as i', 'i.idUsuario', '=', 'u.idUsuario')
            ->join('detalle_ingreso as di', 'i.idIngreso', '=', 'di.idIngreso')
            ->join('tipo_comprobante as tc', 'i.idTipoComprobante', '=', 'tc.idTipoComprobante')
            ->join('tipopago as tp', 'i.idTipoPago', '=', 'tp.idTipoPago')
            ->union(DB::table('usuario as u')
                    ->select('in.idInscripcion', 'in.fechaInscripcion', 'tc.nomTipoComprobante', 'tp.nomTipoPago', DB::raw('sum(din.costoPaquete) as total'), 'u.nomUsuario')
                    ->join('inscripcion as in', 'in.idUsuario', '=', 'u.idUsuario')
                    ->join('detalle_inscripcion as din', 'in.idInscripcion', '=', 'din.idInscripcion')
                    ->join('tipo_comprobante as tc', 'in.idTipoComprobante', '=', 'tc.idTipoComprobante')
                    ->join('tipopago as tp', 'in.idTipoPago', '=', 'tp.idTipoPago')
                    ->where('in.fechaInscripcion', '>=', '2024-04-01T00:00:00')
                    ->where('in.fechaInscripcion', '<=', '2024-04-19T23:59:59')
                    ->where('u.idUsuario', '=', 1)
                    ->groupBy('tp.nomTipoPago' /* , 'u.nomUsuario' */)
            )

            ->where('i.fechaIngreso', '>=', '2024-04-01T00:00:00')
            ->where('i.fechaIngreso', '<=', '2024-04-19T23:59:59')

            ->where('u.idUsuario', '=', 1)

            ->groupBy('tp.nomTipoPago', 'u.nomUsuario')
            ->get();
        dd($datote, "DATOTEEEE");
        if ($request->ajax()) {
            $data = DB::table('ingresos as i')
                ->select('i.idIngreso', 'i.fechaIngreso', 'c.nomCliente', 'tc.nomTipoComprobante', 'i.impuestoIngreso', 'tp.nomTipoPago', DB::raw('sum(di.cantidadVenta*precioVenta) as totalVentas'), 'i.estadoIngreso', 'u.nomUsuario', /* 'sum(total) as totales' */)

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
                ->where('i.idUsuario', '=', $request->get('idUsuario'))
                ->groupBy( /* 'i.idIngreso', 'i.fechaIngreso', 'c.nomCliente', 'tc.nomTipoComprobante', 'i.impuestoIngreso', */'tp.nomTipoPago', 'u.nomUsuario', 'i.estadoIngreso')
                ->get()->toArray();

            return Datatables::of($data)
                ->addIndexColumn()
                ->rawColumns([])
                ->make(true);
        }
        ;

        return view('contabilidad/cajas/index', ['cliente' => $cliente, 'tipopago' => $tipopago, 'tipo_comprobante' => $tipo_comprobante, 'usuario' => $usuario, 'datote' => $datote]);

    }
}
