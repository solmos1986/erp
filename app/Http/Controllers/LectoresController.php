<?php

namespace App\Http\Controllers;

use App\Http\Requests\LectoresRequest;
use App\Models\Lectores;
use DB; // sar la base de datos.
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Validator;
use Yajra\DataTables\DataTables;

class LectoresController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = DB::table('lectores')
                ->where('condicionLector', '=', '1')
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->rawColumns([])
                ->make(true);

        }

        return view('configuracion/lectores/index');

    }
    public function store(Request $request)
    {
        Log::info("LectoresController/store " . Utils::jsonLog($request->all()));
        $rules = array(
            'nomLector' => 'required',
            'ipLector' => 'required',
            'userLector' => 'required',
            'passLector' => 'required',
        );
        $messages = [
            'nomLector.required' => "Nombre es requerido",
            'ipLector.required' => "Ip es requerido",
            'userLector.required' => "Usuario es requerido",
            'passLector.required' => "Contraseña es requerido",
        ];
        $error = Validator::make($request->all(), $rules, $messages);
        if ($error->errors()->all()) {
            return response()->json([
                'status' => 0,
                'message' => $error->errors()->all(),
            ]);
        }
        $lector = DB::table('lectores')->insertGetId([
            "nomLector" => $request->get('nomLector'),
            "ipLector" => $request->get('ipLector'),
            "userLector" => $request->get('userLector'),
            "passLector" => $request->get('passLector'),
        ]);
        return response()->json([
            "status" => 1,
            "message" => "Guardado correctamnte",
            "data" => $lector,
        ]);

    }
    public function edit(Request $request, $id)
    {
        Log::info("LectoresController/edit " . Utils::jsonLog($request->all()));
        $lector = DB::table('lectores')
            ->where('idLector', $id)
            ->first();

        return response()->json([
            "status" => 1,
            "message" => "Editado correctamnte",
            "data" => $lector,
        ]);

    }
    public function update(Request $request, $id)
    {
        Log::info("LectoresController/update " . Utils::jsonLog($request->all()));
        $rules = array(
            'nomLector' => 'required',
            'ipLector' => 'required',
            'userLector' => 'required',
            'passLector' => 'required',
        );
        $messages = [
            'nomLector.required' => "Nombre es requerido",
            'ipLector.required' => "Ip es requerido",
            'userLector.required' => "Usuario es requerido",
            'passLector.required' => "Contraseña es requerido",
        ];
        $error = Validator::make($request->all(), $rules, $messages);
        if ($error->errors()->all()) {
            return response()->json([
                'status' => 0,
                'message' => $error->errors()->all(),
            ]);
        }
        $lector = DB::table('lectores')
            ->where('lectores.idLector', $id)
            ->update([
                "nomLector" => $request->get('nomLector'),
                "ipLector" => $request->get('ipLector'),
                "userLector" => $request->get('userLector'),
                "passLector" => $request->get('passLector'),
            ]);
        return response()->json([
            "status" => 1,
            "message" => "Modificado correctamnte",
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
