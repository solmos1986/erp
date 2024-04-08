<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ProveedorController;
use App\Http\Requests\ProveedorRequest; //agrega la ruta del modelo
use App\Models\Proveedor; //para hacer algunas redirecciones
use DB;
use Illuminate\Http\Request; // sar la base de datos
use Yajra\DataTables\DataTables;

class ProveedorController extends Controller
{
    public function __construct()
    {

    }
    public function index(Request $request) //recibe como parametro un objeto tipo request
    {
        if ($request->ajax()) {
            $data = DB::table('proveedor')
                ->where('condicionProveedor', '=', '1')
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->rawColumns([])
                ->make(true);
        }
        return view('almacen/proveedor/index');

    }
    public function create()
    {
        return view("almacen.proveedor.create");
        //return view("almacen.producto.create"); //abrira un archivo que se creara en esa ruta almacen/producto/create
    }
    public function store(Request $request)
    {
        //dd($request, "LLEGUE STORE");
        $proveedores = new Proveedor;
        $proveedores->nomProveedor = $request->get('nomProveedor');
        $proveedores->tel1Proveedor = $request->get('tel1Proveedor');
        $proveedores->tel2Proveedor = $request->get('tel2Proveedor');
        $proveedores->dirProveedor = $request->get('dirProveedor');
        $proveedores->mailProveedor = $request->get('mailProveedor');
        $proveedores->condicionProveedor = '1';
        $proveedores->save();
        //$proveedor = DB::table('proveedor')->where('condicionProveedor', '=', '1')->get();

        return response()->json([
            "data" => $proveedores,
        ]);

        // return Redirect::to('almacen/proveedor');
    }
    public function show($id)
    {
        $proveedores = Proveedor::findOrFail($id);
        return view("almacen.proveedor.show", compact('proveedores'));
        // return view("almacen.categoria.show",["categoria"=>Categoria::findOrFail($id)]);
    }
    public function edit($id)
    {
        $proveedores = Proveedor::findOrFail($id);
        //return view("almacen.categoria.edit",["categoria"=>Categoria::findOrFail($id)]);
        return response()->json([
            "data" => $proveedores,
        ]);
    }
    public function update(ProveedorRequest $request, $id)
    {
        //dd("ESTOY AQUI");
        $proveedores = Proveedor::findOrFail($id);
        $proveedores->nomProveedor = $request->get('nomProveedor');
        $proveedores->tel1Proveedor = $request->get('tel1Proveedor');
        $proveedores->tel2Proveedor = $request->get('tel2Proveedor');
        $proveedores->dirProveedor = $request->get('dirProveedor');
        $proveedores->mailProveedor = $request->get('mailProveedor');
        $proveedores->condicionProveedor = '1';
        $proveedores->update();
        return response()->json([
            "data" => $proveedores,
        ]);

    }
    public function destroy($id)
    {
        $proveedores = Proveedor::findOrFail($id);
        $proveedores->condicionProveedor = '0';
        $proveedores->update();
        return response()->json([
            "data" => $proveedores,
        ]);
    }

}
