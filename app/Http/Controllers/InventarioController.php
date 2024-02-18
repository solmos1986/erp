<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request; //hace referencia a nuestro request
use Yajra\DataTables\DataTables;

class InventarioController extends Controller
{
    public function index(Request $request) //recibe como parametro un objeto tipo request
    {
        //dd($request, "LLEGUE INDEX");

        if ($request->ajax()) {
            $query = trim($request->get('searchText'));
            $data = DB::table('entrada_producto_almacen as ea') /* ->get() */
                ->join('producto as p', 'p.idPr

                oducto', '=', 'ea.idProducto')
                ->select('ea.idProducto', 'p.nomProducto', DB::raw('count(ea.idProducto) as totalEntrada'))
                ->where('ea.idProducto', 'LIKE', '%' . $query . '%')

                ->groupBy('ea.idProducto', 'p.nomProducto')
                ->get();
            /*   dd($data,"HOLAAA"); */
            /* return view('comercial.compra.index',compact('data')); */
            return Datatables::of($data)
                ->addIndexColumn()
                ->rawColumns([])
                ->make(true);

        }

        return view('almacen/inventario/index');

    }
}
