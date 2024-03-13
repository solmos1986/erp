<?php

namespace App\Http\Controllers;

use DataTables;
use DB;
use Illuminate\Http\Request;
use Validator;

class SuperModuloController extends Controller
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
    public function data_table()
    {
        $super_modulos = DB::table('super_modulo')
            ->get();

        return Datatables::of($super_modulos)
            ->addIndexColumn()
            ->rawColumns([])
            ->make(true);
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
            'nombre_super_modulo' => 'required',
        );
        $messages = [
            'url.required' => "Url es requerido",
            'class_icon.required' => "Icon es requerido",
            'nombre_super_modulo.required' => "Nombre es requerido",
        ];
        $error = Validator::make($request->all(), $rules, $messages);
        if ($error->errors()->all()) {
            return response()->json([
                'status' => 0,
                'message' => $error->errors()->all(),
            ]);
        }
        $insert = DB::table('super_modulo')->insertGetId([
            'url' => '#',
            'nombre_super_modulo' => $request->nombre_super_modulo,
            'class_icon' => ' ',
        ]);
        if ($insert) {
            return response()->json([
                "status" => 1,
                "message" => "Registrado correctamente",
                "data" => null,
            ]);
        } else {
            return response()->json([
                "status" => 0,
                "message" => "Ocurrio un error",
                "data" => null,
            ]);
        }
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
        $super_modulo = DB::table('super_modulo')
            ->where('super_modulo.super_modulo_id', $id)
            ->first();
        if ($super_modulo) {
            return response()->json([
                "status" => 1,
                "message" => "Obtener una seccion",
                "data" => [
                    'super_modulo' => $super_modulo,
                ],
            ]);
        } else {
            return response()->json([
                "status" => 0,
                "message" => "No se puede eliminar tiene mas elementos",
                "data" => null
            ]);
        }
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
        $rules = array(
            'nombre_super_modulo' => 'required',
        );
        $messages = [
            'url.required' => "Url es requerido",
            'class_icon.required' => "Icon es requerido",
            'nombre_super_modulo.required' => "Nombre es requerido",
        ];
        $error = Validator::make($request->all(), $rules, $messages);
        if ($error->errors()->all()) {
            return response()->json([
                'status' => 0,
                'message' => $error->errors()->all(),
            ]);
        }
        $update = DB::table('super_modulo')
            ->where('super_modulo.super_modulo_id', $id)
            ->update([
                'url' => '#',
                'nombre_super_modulo' => $request->nombre_super_modulo,
                'class_icon' => ' ',
            ]);
        if ($update) {
            return response()->json([
                "status" => 1,
                "message" => "Modificado correctamente",
                "data" => null,
            ]);
        } else {
            return response()->json([
                "status" => 0,
                "message" => "Ocurrio un error",
                "data" => null,
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $modulos = DB::table('modulo')
            ->where('modulo.super_modulo_id', $id)
            ->get();
        if (count($modulos) > 0) {
            return response()->json([
                "status" => 0,
                "message" => "No se puede eliminar tiene mas elementos",
                "data" => [
                    'modulo' => $modulo,
                ],
            ]);
        } else {
            $super_modulo = DB::table('super_modulo')
                ->where('super_modulo.super_modulo_id', $id)
                ->delete();
            return response()->json([
                "status" => 1,
                "message" => "Eliminado correctamente",
                "data" => null,
            ]);
        }
    }
}
