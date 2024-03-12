<?php

namespace App\Http\Controllers;
use DataTables;
use Illuminate\Http\Request;
use DB;
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
            'nombre_super_modulo' => 'required'
        );
        $messages = [
            'url.required' => "Url es requerido",
            'class_icon.required' => "Icon es requerido",
            'nombre_super_modulo.required' => "Nombre es requerido"
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
            'class_icon' => ' '
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
