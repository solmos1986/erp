<?php

namespace App\Http\Controllers;

use DataTables;
use DB;
use Illuminate\Http\Request;
use Validator;

class ModuloController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("modulo.index");
    }
    public function icons()
    {
        return view("modulo.icons");
    }

    public function data_table()
    {
        $modulos = DB::table('modulo')
            ->select(
                'modulo.*',
                'super_modulo.nombre_super_modulo'
            )
            ->join('super_modulo', 'super_modulo.super_modulo_id', 'modulo.super_modulo_id')
            ->get();

        return Datatables::of($modulos)
            ->addIndexColumn()
            ->rawColumns([])
            ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $super_modulos = DB::table('super_modulo')
            ->get();
        return response()->json([
            "status" => 1,
            "message" => "Mostrado modulo",
            "data" => [
                'super_modulos' => $super_modulos,
            ],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'url' => 'required',
            'class_icon' => 'required',
            'nombre_modulo' => 'required',
            'super_modulo_id' => 'required',
        );
        $messages = [
            'url.required' => "Url es requerido",
            'class_icon.required' => "Icon es requerido",
            'nombre_modulo.required' => "Nombre es requerido",
            'super_modulo_id.required' => "Selecione una seccion",
        ];
        $error = Validator::make($request->all(), $rules, $messages);
        if ($error->errors()->all()) {
            return response()->json([
                'status' => 0,
                'message' => $error->errors()->all(),
            ]);
        }
        $insert = DB::table('modulo')->insertGetId([
            'url' => $request->url,
            'nombre_modulo' => $request->nombre_modulo,
            'class_icon' => $request->class_icon,
            'super_modulo_id' => $request->super_modulo_id,
        ]);
        return response()->json([
            "status" => 1,
            "message" => "Registrado correctamente",
            "data" => null,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $super_modulos = DB::table('super_modulo')
            ->get();
        $modulo = DB::table('modulo')
            ->where('modulo.id', $id)
            ->first();
        return response()->json([
            "status" => 1,
            "message" => "Mostrado modulo",
            "data" => [
                'super_modulos' => $super_modulos,
                'modulo' => $modulo,
            ],
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $modulo = DB::table('modulo')
            ->where('modulo.id', $id)
            ->update([
                'url' => '',
                'nombre_modulo' => '',
                'class_icon' => '',
                'super_modulo_id' => '',
            ]);
        return response()->json([
            "status" => 1,
            "message" => "Mostrado modulo",
            "data" => [
                'modulo' => $modulo,
            ],
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $modulo = DB::table('sub_modulo')
            ->where('sub_modulo.modulo_id', $id)
            ->get();
        if (count($modulo) > 0) {
            return response()->json([
                "status" => 0,
                "message" => "No se puede eliminar tiene mas elementos",
                "data" => [
                    'modulo' => $modulo,
                ],
            ]);
        } else {
            $sub_modulo = DB::table('sub_modulo')
                ->where('sub_modulo.sub_modulo_id', $id)
                ->delete();
            return response()->json([
                "status" => 1,
                "message" => "Eliminado correctamente",
                "data" => null,
            ]);
        }

    }
}
