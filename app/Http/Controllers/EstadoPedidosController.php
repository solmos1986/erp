<?php

namespace App\Http\Controllers;

use App\Http\Requests\EstadoPedidosRequest; // sar la base de datos
use App\Models\EstadoPedidos;
use DB;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class EstadoPedidosController extends Controller
{
    public function index(Request $request) //recibe como parametro un objeto tipo request
    {

        if ($request->ajax()) {
            $data = DB::table('estadoInOut')
                ->get();
            /* dd($data, "llegue controller"); */

            return Datatables::of($data)
                ->addIndexColumn()
                ->rawColumns([])
                ->make(true);

        }

        return view('almacen/configurar/index');

    }
    public function store(Request $request)
    {
        /* dd($request, "llegue controller"); */

        $estado = new EstadoPedidos;
        $estado->nomEstadoInOut = $request->get('inputNombre');
        $estado->condicionEstadoInOut = '1';
        $estado->save();
        return response()->json([
            "status" => 1,
            "message" => "GuarDado correctamnte",
            "data" => $estado,
        ]);

    }
    public function edit($id)
    {

        $estado = DB::table('estadoInOut')
            ->where('idEstadoInOut', $id)
            ->first();
        //dd($estado, "EDIT PEDIDOS");
        return response()->json([
            "status" => 1,
            "message" => "Editado correctamnte",
            "data" => $estado,
        ]);

    }
    public function update(EstadoPedidosRequest $request)
    {
        //dd("Llegue UPDATE EstadoPedido");

        $id = $request->get('idConfigurar');
        $estado = EstadoPedidos::findOrFail($id);
        $estado->nomEstadoInOut = $request->get('inputNombre');
        /* dd($estado, "llegue controller"); */

        $estado->condicionEstadoInOut = '1';
        $estado->update();
        //dd('PdfController / store()', $categoria);
        return response()->json([
            "status" => 1,
            "message" => "Actualizado correctamnte",
            "data" => $estado,
        ]);

    }
    public function destroy(EstadoPedidosRequest $request, $id)
    {
        $estado = EstadoPedidos::findOrFail($id);
        $estado->condicionEstadoInOut = $request->get('condicionEstadoInOut');
        $estado->update();
        return response()->json([
            "status" => 1,
            "message" => "Eliminado correctamnte",
            "data" => $estado,
        ]);

    }
}
