<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

//use Validator;

class AuthorizacionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function data_table()
    {
        $usuarios = DB::table('authenticacion')
            ->join('usuario', 'usuario.idUsuario', 'authenticacion.usuario_id')
            ->where('usuario.condicionUsuario', 1)
            ->get();

        return Datatables::of($usuarios)
            ->addIndexColumn()
            ->make(true);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = DB::table('rol')->get();
        $usuarios = DB::table('usuario')->get();
        return view('authorizacion/index', compact('roles', 'usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $usuario = DB::table('authenticacion')
            ->join('usuario', 'usuario.idUsuario', 'authenticacion.usuario_id')
            ->where('usuario.condicionUsuario', 1)
            ->where('authenticacion.authenticacion_id', $id)
            ->first();
        $roles = DB::table('rol_authenticacion')
            ->join('rol', 'rol.rol_id', 'rol_authenticacion.rol_id')
            ->where('rol_authenticacion.authenticacion_id', $id)
            ->get();
        $usuario->roles = $roles;
        return response()->json([
            'status' => 1,
            'message' => 'mostrar un usuario',
            'data' => $usuario,
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
        //
    }
}
