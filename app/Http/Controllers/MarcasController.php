<?php

namespace App\Http\Controllers;

use App\Http\Requests\MarcasRequest; // sar la base de datos.
use App\Models\Marcas;
use DB;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class MarcasController extends Controller
{
    public function index(Request $request) //recibe como parametro un objeto tipo request
    {

        if ($request->ajax()) {
            $data = DB::table('marcas')
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

        $marca = new Marcas;
        $marca->nomMarcas = $request->get('inputNombre');
        $marca->condicionMarcas = '1';
        $marca->save();
        return response()->json([
            "status" => 1,
            "message" => "Guardado correctamnte",
            "data" => $marca,
        ]);

    }
    public function edit($id)
    {
        //dd($id, "llegue edit");

        $marca = DB::table('marcas')
            ->where('idMarcas', $id)
            ->first();

        return response()->json([
            "status" => 1,
            "message" => "Editado correctamnte",
            "data" => $marca,
        ]);

    }
    public function update(MarcasRequest $request)
    {
        //dd("Llegue UPDATE TipoPago");

        $id = $request->get('idConfigurar');
        $marca = Marcas::findOrFail($id);
        $marca->nomMarcas = $request->get('inputNombre');
        //dd($pago, "llegue controller");

        $marca->condicionMarcas = '1';
        $marca->update();
        //dd('PdfController / store()', $categoria);
        return response()->json([
            "status" => 1,
            "message" => "Actualizado correctamnte",
            "data" => $marca,
        ]);

    }
    public function destroy(MarcasRequest $request, $id)
    {
        $marca = Marcas::findOrFail($id);
        $marca->condicionMarcas = $request->get('condicionMarcas');
        $marca->update();
        return response()->json([
            "status" => 1,
            "message" => "Eliminado correctamnte",
            "data" => $marca,
        ]);

    }

}
