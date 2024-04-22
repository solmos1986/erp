<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CuentaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dataTable()
    {
        $cuentas = DB::table('cuenta')
            ->select(
                'cuenta.*',
                DB::raw('"0" as debe'),
                DB::raw('"0" as haber'),
                DB::raw('"0" as saldo')
            )
            ->orderBy('cuenta.codigo_cuenta')
            ->get();
        return Datatables::of($cuentas)
            ->addIndexColumn()
            ->rawColumns([])
            ->make(true);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cuentas = [];
        return view('cuenta.index', compact('cuentas'));
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
