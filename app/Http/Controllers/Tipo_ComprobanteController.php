<?php

namespace App\Http\Controllers;

use App\Http\Requests\tipo_comprobanteRequest; // sar la base de datos.
use App\Models\tipo_comprobante;
use DB;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class Tipo_ComprobanteController extends Controller
{
    public function index(Request $request) //recibe como parametro un objeto tipo request
    {

        if ($request->ajax()) {
            $data = DB::table('tipo_comprobante')
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
        // dd($request, "llegue controller TC");

        $comprobante = new tipo_comprobante;
        $comprobante->nomTipoComprobante = $request->get('inputNombre');
        $comprobante->condicionTipo_Comprobante = '1';
        $comprobante->save();
        return response()->json([
            "status" => 1,
            "message" => "Guardado correctamnte",
            "data" => $comprobante,
        ]);

    }
    public function edit($id)
    {
        //dd($id, "llegue edit");

        $comprobante = DB::table('tipo_comprobante')
            ->where('idTipoComprobante', $id)
            ->first();

        return response()->json([
            "status" => 1,
            "message" => "Editado correctamnte",
            "data" => $comprobante,
        ]);

    }
    public function update(tipo_comprobanteRequest $request)
    {
        //dd("Llegue UPDATE TipoPago");

        $id = $request->get('idConfigurar');
        $comprobante = tipo_comprobante::findOrFail($id);
        $comprobante->nomTipoComprobante = $request->get('inputNombre');
        //dd($pago, "llegue controller");

        $comprobante->condicionTipo_Comprobante = '1';
        $comprobante->update();
        //dd('PdfController / store()', $categoria);
        return response()->json([
            "status" => 1,
            "message" => "Actualizado correctamnte",
            "data" => $comprobante,
        ]);

    }
    public function destroy(tipo_comprobanteRequest $request, $id)
    {
        //dd($request, "SWITCH TC");
        $comprobante = tipo_comprobante::findOrFail($id);
        $comprobante->condicionTipo_Comprobante = $request->get('condicionTipo_Comprobante');
        $comprobante->update();
        return response()->json([
            "status" => 1,
            "message" => "Eliminado correctamnte",
            "data" => $comprobante,
        ]);

    }

}
