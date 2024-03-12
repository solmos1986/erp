<?php

namespace App\Http\Controllers;

use DataTables;
use DB;
use Illuminate\Http\Request;
use Validator;

class SubModuloController extends Controller
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
        $sub_modulos = DB::table('sub_modulo')
            ->select(
                'sub_modulo.*',
                'modulo.nombre_modulo'
            )
            ->join('modulo', 'modulo.modulo_id', 'sub_modulo.modulo_id')
            ->get();

        return Datatables::of($sub_modulos)
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
        $modulos = DB::table('modulo')
            ->get();
        return response()->json([
            "status" => 1,
            "message" => "Mostrado sub modulo",
            "data" => [
                'modulos' => $modulos,
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
            'nombre_sub_modulo' => 'required',
            'modulo_id' => 'required',
        );
        $messages = [
            'url.required' => "Url es requerido",
            'nombre_modulo.required' => "Nombre es requerido",
            'modulo_id.required' => "Selecione un modulo",
        ];
        $error = Validator::make($request->all(), $rules, $messages);
        if ($error->errors()->all()) {
            return response()->json([
                'status' => 0,
                'message' => $error->errors()->all(),
            ]);
        }
        $insert = DB::table('sub_modulo')->insertGetId([
            'url' => $request->url,
            'nombre_sub_modulo' => $request->nombre_sub_modulo,
            'class_icon' => ' ',
            'modulo_id' => $request->modulo_id,
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
