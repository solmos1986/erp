<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaquetesGymRequest;
use App\Models\PaquetesGym;
use DB; //para hacer algunas redirecciones
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\DataTables;

class PaquetesGymController extends Controller
{
    public function index(Request $request) //recibe como parametro un objeto tipo request
    {
        // dump($request, "request paquetes");
        if ($request->ajax()) {
            $data = DB::table('paquetesgym')
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->rawColumns([])
                ->make(true);
        }
        return view('almacen/paquetes/index');

    }
    public function obtener_paquetes($id)
    {
        $paquetes = PaquetesGym::findOrFail($id);
//return view("almacen.categoria.edit",["categoria"=>Categoria::findOrFail($id)]);
        return response()->json([
            "data" => $paquetes,
        ]);

    }
    public function store(PaquetesGymRequest $request)
    {

        $paquetes = new PaquetesGym;
        $paquetes->nomPaquete = $request->get('nomPaquete');
        $paquetes->duracionPaquete = $request->get('duracionPaquete');
        $paquetes->costoPaquete = $request->get('costoPaquete');
        $paquetes->condicionPaquete = '1';
        $paquetes->save();
        return Redirect::to('almacen/paquetes');
    }
    public function edit($id)
    {
        $paquetes = PaquetesGym::findOrFail($id);
        //return view("almacen.categoria.edit",["categoria"=>Categoria::findOrFail($id)]);
        return response()->json([
            "data" => $paquetes,
        ]);
    }
    public function update(PaquetesGymRequest $request, $id)
    {
        //dd("ESTOY AQUI");
        $paquetes = PaquetesGym::findOrFail($id);
        $paquetes->nomPaquete = $request->get('nomPaquete');
        $paquetes->duracionPaquete = $request->get('duracionPaquete');
        $paquetes->costoPaquete = $request->get('costoPaquete');
        $paquetes->condicionPaquete = '1';
        $paquetes->update();
        return response()->json([
            "data" => $paquetes,
        ]);

    }
    public function destroy(PaquetesGymRequest $request, $id)
    {
        $paquetes = PaquetesGym::findOrFail($id);
        $paquetes->condicionPaquete = $request->get('condicionPaquete');
        $paquetes->update();
        return response()->json([
            "status" => 1,
            "message" => "Eliminado correctamnte",
            "data" => $paquetes,
        ]);

    }
}
