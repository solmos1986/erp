<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Validator;

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
            'data' => [
                'rol_id' => 0,
                'nombre_rol' => '',
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
            'nombre_rol' => 'required',
        );
        $messages = [
            'nombre_rol.required' => "Nombre rol es requerido"
        ];
        $error = Validator::make($request->all(), $rules, $messages);
        if ($error->errors()->all()) {
            return response()->json([
                'status' => 0,
                'message' => $error->errors()->all(),
            ]);
        }
        $this->insertMasivo($request);
        return response()->json([
            'status' => 1,
            'message' => 'Registrado correctamente',
            'data' => null,
        ]);
    }
    public function insertMasivo(Request $request)
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
                ->where('rol_super_modulo.super_modulo_id', $super_modulo->super_modulo_id)
                ->where('rol_super_modulo.rol_id', $rol->rol_id)
                ->first();
            //dd($rol_super_modulo);
            $modulos = DB::table('modulo')
                ->where('modulo.super_modulo_id', $super_modulo->super_modulo_id)
                ->get();
            if ($rol_super_modulo) {
                foreach ($modulos as $key => $modulo) {
                    $rol_modulo = DB::table('rol_modulo')
                        ->where('rol_modulo.rol_super_modulo_id', $rol_super_modulo->rol_super_modulo_id)
                        ->where('rol_modulo.modulo_id', $modulo->modulo_id)
                        ->first();
                    $sub_modulos = DB::table('sub_modulo')
                        ->where('sub_modulo.modulo_id', $modulo->modulo_id)
                        ->get();
                    if ($rol_modulo) {
                        foreach ($sub_modulos as $key => $sub_modulo) {
                            $rol_sub_modulo = DB::table('rol_sub_modulo')
                                ->where('rol_sub_modulo.sub_modulo_id', $sub_modulo->sub_modulo_id)
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
        $rules = array(
            'nombre_rol' => 'required',
        );
        $messages = [
            'nombre_rol.required' => "Nombre rol es requerido",
        ];
        $error = Validator::make($request->all(), $rules, $messages);
        if ($error->errors()->all()) {
            return response()->json([
                'status' => 0,
                'message' => $error->errors()->all(),
            ]);
        }
        $this->destroy($id);
        $this->insertMasivo($request);
        return response()->json([
            'status' => 1,
            'message' => 'Modificado correctamente',
            'data' => null,
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
        $sub_modulo_ids = DB::table('rol_authenticacion')
            ->select(
                'rol_sub_modulo.rol_sub_modulo_id'
            )
            ->join('rol_super_modulo', 'rol_super_modulo.rol_id', 'rol_authenticacion.rol_id')
            ->join('super_modulo', 'super_modulo.super_modulo_id', 'rol_super_modulo.super_modulo_id')
            ->join('rol_modulo', 'rol_modulo.rol_super_modulo_id', 'rol_super_modulo.rol_super_modulo_id')
            ->join('modulo', 'modulo.modulo_id', 'rol_modulo.modulo_id')
            ->join('rol_sub_modulo', 'rol_sub_modulo.rol_modulo_id', 'rol_modulo.rol_modulo_id')
            ->join('sub_modulo', 'sub_modulo.sub_modulo_id', 'rol_sub_modulo.sub_modulo_id')
            ->where('rol_authenticacion.rol_id', $id)
            ->groupBy('rol_sub_modulo.rol_sub_modulo_id')
            ->get()
            ->pluck('rol_sub_modulo_id');
        //dump($sub_modulo_ids);
        $sub_modulos = DB::table('rol_sub_modulo')
            ->whereIn('rol_sub_modulo.rol_sub_modulo_id', $sub_modulo_ids)
            ->delete();

        $modulo_ids = DB::table('rol_authenticacion')
            ->select(
                'rol_modulo.rol_modulo_id'
            )
            ->join('rol_super_modulo', 'rol_super_modulo.rol_id', 'rol_authenticacion.rol_id')
            ->join('super_modulo', 'super_modulo.super_modulo_id', 'rol_super_modulo.super_modulo_id')
            ->join('rol_modulo', 'rol_modulo.rol_super_modulo_id', 'rol_super_modulo.rol_super_modulo_id')
            ->join('modulo', 'modulo.modulo_id', 'rol_modulo.modulo_id')
            ->where('rol_authenticacion.rol_id', $id)
            ->groupBy('rol_modulo.rol_modulo_id')
            ->get()
            ->pluck('rol_modulo_id');
        //dump($modulo_ids);
        $modulos = DB::table('rol_modulo')
            ->whereIn('rol_modulo.rol_modulo_id', $modulo_ids)
            ->delete();

        $super_modulo_ids = DB::table('rol_authenticacion')
            ->select(
                'rol_super_modulo.rol_super_modulo_id'
            )
            ->join('rol_super_modulo', 'rol_super_modulo.rol_id', 'rol_authenticacion.rol_id')
            ->join('super_modulo', 'super_modulo.super_modulo_id', 'rol_super_modulo.super_modulo_id')
            ->where('rol_authenticacion.rol_id', $id)
            ->groupBy('rol_super_modulo.rol_super_modulo_id')
            ->get()
            ->pluck('rol_super_modulo_id');
        //dump($super_modulo_ids);
        $super_modulos = DB::table('rol_super_modulo')
            ->whereIn('rol_super_modulo.rol_super_modulo_id', $super_modulo_ids)
            ->delete();

        $rol = DB::table('rol')
            ->where('rol.rol_id', $id)
            ->delete();

        //dd('stop');
        return response()->json([
            'status' => 1,
            'message' => 'Rol eliminado correctamente',
            'data' => null,
        ]);
    }
}
