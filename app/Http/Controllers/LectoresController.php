<?php

namespace App\Http\Controllers;

use App\Http\Requests\LectoresRequest; // sar la base de datos.
use App\Models\Lectores;
use DB;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class LectoresController extends Controller
{
    public function index(Request $request) //recibe como parametro un objeto tipo request
    {

        if ($request->ajax()) {
            $data = DB::table('lectores')
                ->where('condicionLector', '=', '1')
                ->get();
            /* dd($data, "llegue controller"); */

            return Datatables::of($data)
                ->addIndexColumn()
                ->rawColumns([])
                ->make(true);

        }

        return view('configuracion/lectores/index');

    }
    public function store(Request $request)
    {
        // dd($request, "llegue controller LECTOREs");

        $lector = new Lectores;
        $lector->nomLector = $request->get('nomLector');
        $lector->ipLector = $request->get('ipLector');
        $lector->portLector = $request->get('portLector');
        $lector->userLector = $request->get('userLector');
        $lector->passLector = $request->get('passLector');
        $lector->condicionLector = '1';
        $lector->save();
        return response()->json([
            "status" => 1,
            "message" => "Guardado correctamnte",
            "data" => $lector,
        ]);

    }
    public function edit($id)
    {
        //dd($id, "llegue edit");

        $lector = DB::table('lectores')
            ->where('idLector', $id)
            ->first();

        return response()->json([
            "status" => 1,
            "message" => "Editado correctamnte",
            "data" => $lector,
        ]);

    }
    public function update(LectoresRequest $request)
    {
        //dd("Llegue UPDATE Lector");

        $id = $request->get('idLector');
        $lector = Lectores::findOrFail($id);
        $lector->nomlector = $request->get('nomLector');
        $lector->ipLector = $request->get('ipLector');
        $lector->portLector = $request->get('portLector');
        $lector->userLector = $request->get('userLector');
        $lector->passLector = $request->get('passLector');
        $lector->condicionLector = '1';
        $lector->update();
        //dd('PdfController / store()', $categoria);
        return response()->json([
            "status" => 1,
            "message" => "Actualizado correctamnte",
            "data" => $lector,
        ]);
    }
    public function destroy(LectoresRequest $request, $id)
    {
        // dd($request, "LLEGUE STATUS METHOD");
        $lector = Lectores::findOrFail($id);
        $lector->condicionLector = $request->get('condicionLector');
        $lector->update();
        return response()->json([
            "status" => 1,
            "message" => "Eliminado correctamnte",
            "data" => $lector,
        ]);

    }
}
