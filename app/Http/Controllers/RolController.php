<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class RolController extends Controller
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
        $roles = DB::table('rol')->get();

        return view('rol/index', compact('roles'));
    }

    public function data_table()
    {
        $roles = DB::table('rol')
            ->get();
        foreach ($roles as $key => $rol) {
            $super_modulos = DB::table('super_modulo')
                ->join('rol_super_modulo', 'rol_super_modulo.super_modulo_id', 'super_modulo.super_modulo_id')
                ->where('rol_super_modulo.rol_id', $rol->rol_id)
                ->get();
            $rol->super_modulos = $super_modulos;
        }
        return Datatables::of($roles)
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
        foreach ($super_modulos as $key => $super_modulo) {
            $modulos = DB::table('modulo')
                ->where('modulo.super_modulo_id', $super_modulo->super_modulo_id)
                ->get();
            foreach ($modulos as $key => $modulo) {
                $sub_modulos = DB::table('sub_modulo')
                    ->where('sub_modulo.modulo_id', $modulo->modulo_id)
                    ->get();
                foreach ($sub_modulos as $key => $sub_modulo) {
                    $sub_modulo->validate = false;
                }
                $modulo->sub_modulos = $sub_modulos;
                $modulo->validate = false;
            }
            $super_modulo->modulos = $modulos;
            $super_modulo->validate = false;
        }
        return response()->json([
            'status' => 1,
            'message' => 'Todos los modulos',
            'data' => $super_modulos,
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
        $rol_insert = DB::table('rol')
            ->insertGetId([
                'nombre_rol' => $request->nombre_rol,
            ]);
        foreach ($request->super_modulos as $key => $super_modulo) {
            if ($super_modulo['validate'] == 'true') {
                $rol_super_modulo_insert = DB::table('rol_super_modulo')
                    ->insertGetId([
                        'rol_id' => $rol_insert,
                        'super_modulo_id' => $super_modulo['super_modulo_id'],
                    ]);
            }
            foreach ($super_modulo['modulos'] as $key => $modulo) {
                if ($modulo['validate'] == 'true') {
                    $rol_modulo_insert = DB::table('rol_modulo')
                        ->insertGetId([
                            'rol_super_modulo_id' => $rol_super_modulo_insert,
                            'modulo_id' => $modulo['modulo_id'],
                        ]);
                }
                foreach ($modulo['sub_modulos'] as $key => $sub_modulo) {
                    if ($sub_modulo['validate'] == 'true') {
                        $rol_modulo_insert = DB::table('rol_sub_modulo')
                            ->insertGetId([
                                'rol_modulo_id' => $rol_modulo_insert,
                                'sub_modulo_id' => $sub_modulo['sub_modulo_id'],
                            ]);
                    }
                }
            }
        }
        return response()->json([
            'status' => 1,
            'message' => 'Todos los modulos',
            'data' => $request->all(),
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
        $rol = DB::table('rol')
            ->where('rol.rol_id', $id)
            ->first();
        $super_modulos = DB::table('super_modulo')
            ->get();
        foreach ($super_modulos as $key => $super_modulo) {
            $rol_super_modulo = DB::table('rol_super_modulo')
                ->where('rol_super_modulo.rol_id', $id)
                ->first();
            $modulos = DB::table('modulo')
                ->where('modulo.super_modulo_id', $super_modulo->super_modulo_id)
                ->get();
            if ($rol_super_modulo) {
                foreach ($modulos as $key => $modulo) {
                    $rol_modulo = DB::table('rol_modulo')
                        ->where('rol_modulo.rol_super_modulo_id', $rol_super_modulo->rol_super_modulo_id)
                        ->first();
                    $sub_modulos = DB::table('sub_modulo')
                        ->where('sub_modulo.modulo_id', $modulo->modulo_id)
                        ->get();
                    if ($rol_modulo) {
                        foreach ($sub_modulos as $key => $sub_modulo) {
                            $rol_sub_modulo = DB::table('rol_sub_modulo')
                                ->where('rol_sub_modulo.rol_modulo_id', $rol_modulo->rol_modulo_id)
                                ->first();
                            if ($rol_sub_modulo) {
                                $sub_modulo->validate = true;
                            } else {
                                $sub_modulo->validate = false;
                            }
                        }
                        $modulo->sub_modulos = $sub_modulos;
                        $modulo->validate = true;
                    } else {
                        foreach ($sub_modulos as $key => $sub_modulo) {
                            $sub_modulo->validate = false;
                        }
                        $modulo->sub_modulos = $sub_modulos;
                        $modulo->validate = false;
                    }
                }
                $super_modulo->modulos = $modulos;
                $super_modulo->validate = true;
            } else {
                foreach ($modulos as $key => $modulo) {
                    $sub_modulos = DB::table('sub_modulo')
                        ->where('sub_modulo.modulo_id', $modulo->modulo_id)
                        ->get();
                    foreach ($sub_modulos as $key => $sub_modulo) {
                        $sub_modulo->validate = false;
                    }
                    $modulo->sub_modulos = $sub_modulos;
                    $modulo->validate = false;
                }
                $super_modulo->modulos = $modulos;
                $super_modulo->validate = false;
            }
        }
        return response()->json([
            'status' => 1,
            'message' => 'Obtener rol',
            'data' => [
                'rol_id' => $rol->rol_id,
                'nombre_rol' => $rol->nombre_rol,
                'super_modulos' => $super_modulos,
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
        $rol = DB::table('rol')
            ->where('rol.rol_id', $id)
            ->first();
        $super_modulos = DB::table('super_modulo')
            ->join('rol_super_modulo', 'rol_super_modulo.super_modulo_id', 'super_modulo.super_modulo_id')
            ->where('rol_super_modulo.rol_id', $rol->rol_id)
            ->get();

        $super_modulos = DB::table('super_modulo')
            ->join('rol_super_modulo', 'rol_super_modulo.super_modulo_id', 'super_modulo.super_modulo_id')
            ->where('rol_super_modulo.rol_id', $rol->rol_id)
            ->get();
    }
}
