<?php

namespace App\Http\Controllers;

use App\Http\Controllers\EgresoController;
use App\Models\DetalleEgreso; //agrega la ruta del modelo
use App\Models\Egreso; //agrega la ruta del modelo
use App\Models\entrada_producto_almacen; //para hacer algunas redirecciones
use App\Models\Proveedor; //hace referencia a nuestro request
use Barryvdh\DomPDF\Facade\Pdf; // sar la base de datos
use DB;
use Illuminate\Http\Request;
use Luecano\NumeroALetras\NumeroALetras;
use Validator;
use Yajra\DataTables\DataTables;

class EgresoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $proveedores = DB::table('proveedor')->where('condicionProveedor', '=', '1')->get();
        $tipopago = DB::table('tipopago')->where('condicionTipoPago', '=', '1')->get();
        $tipo_comprobante = DB::table('tipo_comprobante')->where('condicionTipo_Comprobante', '=', '1')->get();
        $usuario = DB::table('usuario')->where('condicionUsuario', '=', '1')->get();
        return view('comercial/compra/index', compact('proveedores', 'tipopago', 'tipo_comprobante', 'usuario'));
    }

    public function dataTable(Request $request)
    {
        //dd(date('Y-m-d', strtotime($request->get('startDate'))));
        $data = DB::table('egresos as e')
            ->select(
                'e.idEgreso',
                DB::raw('DATE_FORMAT(e.fechaEgreso, "%d-%m-%Y") as fechaEgreso'),
                'p.nomProveedor',
                'tc.nomTipoComprobante',
                'e.numeroComprobante',
                'e.impuestoEgreso',
                'tp.nomTipoPago',
                DB::raw('sum(de.cantidadCompra*precioCompraEgreso) as total'),
                'u.nomUsuario',
                'e.estadoEgreso',
                'estado_egreso.nomEstado')
            ->join('proveedor as p', 'e.idProveedor', '=', 'p.idProveedor')
            ->join('detalle_egreso as de', 'e.idEgreso', '=', 'de.idEgreso')
            ->join('tipo_comprobante as tc', 'e.idTipoComprobante', '=', 'tc.idTipoComprobante')
            ->join('tipopago as tp', 'e.idTipoPago', '=', 'tp.idTipoPago')
            ->join('usuario as u', 'e.idUsuario', '=', 'u.idUsuario')
            ->join('estado_egreso', 'estado_egreso.id_estado_egreso', 'e.estadoEgreso')
            ->when((date('Y-m-d', strtotime($request->get('startDate'))) != '' && date('Y-m-d', strtotime($request->get('endDate'))) != ''), function ($query) use ($request) {
                $query->where('e.fechaEgreso', '>=', date('Y-m-d', strtotime($request->get('startDate'))))
                    ->where('e.fechaEgreso', '<=', date('Y-m-d', strtotime($request->get('endDate'))));
            })
            ->when(($request->get('idProveedor') != ''), function ($query) use ($request) {
                $query->where('e.idProveedor', '=', $request->get('idProveedor'));
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
            ->groupBy('e.idEgreso', 'e.fechaEgreso', 'p.nomProveedor', 'tc.nomTipoComprobante', 'e.numeroComprobante', 'e.impuestoEgreso', 'tp.nomTipoPago', 'u.nomUsuario', 'e.estadoEgreso')
            ->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->rawColumns([])
            ->make(true);
    }
    public function pdf(Request $request, $id)
    {
        $egreso = DB::table('egresos as e')
            ->select('e.idEgreso', 'e.fechaEgreso', 'e.idProveedor', 'p.nomProveedor', 'tc.nomTipoComprobante', 'e.numeroComprobante', 'e.impuestoEgreso', 'tp.nomTipoPago', DB::raw('sum(de.cantidadCompra*precioCompraEgreso) as total'), 'u.nomUsuario', 'e.estadoEgreso')
            ->join('proveedor as p', 'e.idProveedor', '=', 'p.idProveedor')
            ->join('detalle_egreso as de', 'e.idEgreso', '=', 'de.idEgreso')
            ->join('tipo_comprobante as tc', 'e.idTipoComprobante', '=', 'tc.idTipoComprobante')
            ->join('tipopago as tp', 'e.idTipoPago', '=', 'tp.idTipoPago')
            ->join('usuario as u', 'e.idUsuario', '=', 'u.idUsuario')
            ->where('e.idEgreso', '=', $id)
            ->first();
        $detalle = DB::table('detalle_egreso as de')
            ->select('de.idProducto', 'pro.nomProducto', 'de.cantidadCompra', 'de.precioCompraEgreso', DB::raw('de.cantidadCompra*precioCompraEgreso as subtotal'))
            ->join('producto as pro', 'de.idProducto', '=', 'pro.idProducto')
            ->join('egresos as e', 'e.idEgreso', '=', 'de.idEgreso')
            ->where('de.idEgreso', '=', $id)
            ->groupBy('de.idProducto')
            ->get();
        $infoNego = DB::table('info_negocio')->first();
        $formatter = new NumeroALetras();
        $literal = $formatter->toInvoice($egreso->total, 2, 'BOLIVIANOS');
        //dd($literal);

        $pdf = Pdf::setPaper([0, 0, 226.77, 2267.72])->loadView('comercial.compra.compra-pdf', ['egreso' => $egreso, 'detalle' => $detalle, 'infoNego' => $infoNego, 'literal' => $literal]);

        return response()->json([
            'data' => base64_encode($pdf->output()),
        ]);

    }
    public function create(Request $request)
    {
        $proveedor = DB::table('proveedor')->where('condicionProveedor', '=', '1')->get();
        $tipopago = DB::table('tipopago')->get();
        $tipo_comprobante = DB::table('tipo_comprobante')->get();
        $usuario = DB::table('usuario')->where('condicionUsuario', '=', '1')->get();
        $categoria = DB::table('categoria')->where('condicionCategoria', '=', '1')->get();

        return view('comercial/compra/create', compact('proveedor', 'tipopago', 'tipo_comprobante', 'usuario', 'categoria'));
    }

    public function edit($id)
    {
        return view('comercial/compra/create');
    }
    public function store(Request $request)
    {
        $rules = array(
            'idProveedor' => 'required',
            'idTipoPago' => 'required',
            'idTipoComprobante' => 'required',
            'numeroComprobante' => 'required',
        );
        $messages = [
            'idProveedor.required' => "Seleccione proveedor",
            'idTipoPago.required' => "Seleccione metodo de pago",
            'idTipoComprobante.required' => "Seleccione Tipo comprobante",
            'numeroComprobante' => 'numero comprobante requerido',
        ];
        $error = Validator::make($request->all(), $rules, $messages);

        if ($error->errors()->all()) {
            return response()->json([
                'status' => 0,
                'message' => $error->errors()->all(),
            ]);
        }
        $insertCompra = DB::table('egresos')
            ->insertGetId([
                'idProveedor' => $request->idProveedor,
                'idTipoPago' => $request->idTipoPago,
                'idTipoComprobante' => $request->idTipoComprobante,
                'numeroComprobante' => $request->numeroComprobante,
                'impuestoEgreso' => $request->impuestoEgreso,
                'idUsuario' => auth()->user()->obtener_usuario()->idUsuario,
            ]);
        $datos = [];
        foreach ($request->detallecompra as $key => $value) {
            $insertDetalleCompra = DB::table('detalle_egreso')
                ->insertGetId([
                    'idEgreso' => $insertCompra,
                    'idProducto' => $value['idProducto'],
                    'cantidadCompra' => $value['cantidad'],
                    //'precioVentaEgreso' => 1,
                    'precioCompraEgreso' => $value['precio'],
                ]);
            /* for ($i = 1; $i <= $value['cantidad']; $i++) {
        array_push($datos, array(
        'serie' => 'C-' . $insertCompra . 'DC-' . $insertDetalleCompra . 'F-' . strtotime(date('Y-m-d H:i:s')),
        'idProducto' => $value['idProducto'],
        'idDetalleEgreso' => $insertDetalleCompra,
        ));
        } */
        }
        //entrada_producto_almacen::insert($datos);
        return response()->json([
            "status" => 1,
            "message" => "Registrado correctamnte",
            "data" => $insertCompra,
        ]);
    }
}
