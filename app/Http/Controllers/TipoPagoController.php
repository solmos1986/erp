<?php

namespace App\Http\Controllers;

use App\Http\Requests\TipoPagoRequest; // sar la base de datos.
use App\Models\TipoPago;
use DB;
use Illuminate\Http\Request; // sar la base de datos
use Yajra\DataTables\DataTables;

class TipoPagoController extends Controller
{
    public function index(Request $request) //recibe como parametro un objeto tipo request
    {

        if ($request->ajax()) {
            $data = DB::table('tipopago')
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
        //dd($request, "llegue controller TP");

        $pago = new TipoPago;
        $pago->nomTipoPago = $request->get('inputNombre');
        $pago->condicionTipoPago = '1';
        $pago->save();
        return response()->json([
            "status" => 1,
            "message" => "Guardado correctamnte",
            "data" => $pago,
        ]);

    }
    public function edit($id)
    {
        //dd($id, "llegue edit");

        $pago = DB::table('tipopago')
            ->where('idTipoPago', $id)
            ->first();

        return response()->json([
            "status" => 1,
            "message" => "Editado correctamnte",
            "data" => $pago,
        ]);

    }
    public function update(TipoPagoRequest $request)
    {
        //dd("Llegue UPDATE TipoPago");

        $id = $request->get('idConfigurar');
        $pago = TipoPago::findOrFail($id);
        $pago->nomTipoPago = $request->get('inputNombre');
        //dd($pago, "llegue controller");

        $pago->condicionTipoPago = '1';
        $pago->update();
        //dd('PdfController / store()', $categoria);
        return response()->json([
            "status" => 1,
            "message" => "Actualizado correctamnte",
            "data" => $pago,
        ]);

    }
    public function destroy(TipoPagoRequest $request, $id)
    {
        // dd($request, "LLEGUE STATUS METHOD");
        $pago = TipoPago::findOrFail($id);
        $pago->condicionTipoPago = $request->get('condicionTipoPago');
        $pago->update();
        return response()->json([
            "status" => 1,
            "message" => "Eliminado correctamnte",
            "data" => $pago,
        ]);

    }
}
