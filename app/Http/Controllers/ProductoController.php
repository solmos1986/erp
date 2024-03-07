<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductoFormRequest; //agrega la ruta del modelo
use App\Models\Producto; //para hacer algunas redirecciones
use DB; //hace referencia a nuestro request
use Illuminate\Http\Request; // sar la base de datos
use Yajra\DataTables\DataTables;

class ProductoController extends Controller
{
    public function __construct()
    {

    }
    public function obtener_producto()
    {
        $productos = DB::table('producto')->where('condicionProducto', '=', 1)->get();
        $clientes = DB::table('cliente')->where('condicionCliente', '=', 1)->get();
        $usuario = DB::table('usuario')->where('condicionUsuario', '=', 1)->get();
        $tipoPago = DB::table('tipopago')->where('condicionTipoPago', '=', 1)->get();
        $stock = DB::select('CALL stock ()');

        return response()->json([
            "data" => $productos,
            "stock" => $stock,
            "status" => 1,
            "message" => '',
        ]);

    }
    public function index(Request $request) //recibe como parametro un objeto tipo request
    {
        if ($request->ajax()) {
            $data = DB::table('producto')
                ->where('condicionProducto', '=', '1')
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->rawColumns([])
                ->make(true);
        }
        return view('almacen/producto/index');

    }
    public function create(Request $request)
    {
        $categoria = DB::table('categoria')->where('condicionCategoria', '=', '1')->get();

        //dd($categorias);
        return view('almacen.producto.create', compact('categoria'));

    }
    public function store(ProductoFormRequest $request) // hace una validacion con el archivo ProductoFormRequest
    {
        //dd($request, "llegue controler");
        $categoria = DB::table('categoria')->where('condicionCategoria', '=', '1')->get();
        $producto = new Producto;
        $producto->codProducto = $request->get('codProducto');
        $producto->nomProducto = $request->get('nomProducto');
        $producto->stockMinimo = $request->get('stockMinimo');
        $producto->unidadMedida = $request->get('unidadMedida');
        $producto->idCategoria = $request->get('idCategoria');
        $producto->precioVentaProducto = $request->get('precioVentaProducto');
        $producto->condicionProducto = '1';
        dd($producto);

        if ($request->hasFile('imagenProducto')) {

            //dd($producto);// con producto me sigue dando nulo no funciona $file
            $file = $request->file('imagenProducto');
            //dd($file); //aqui da nulo con $producto pero con $file ya da orignal name
            $file->move(public_path() . '/imagenes/productos/', $file->getClientOriginalName());
            //dd($producto); //da nulo
            //dd($file);
            $producto->imagenProducto = $file->getClientOriginalName();
        } else {
            $producto->imagenProducto = '';
        }
        $producto->save();

        return response()->json([
            "data" => $producto,
            "cate" => $categoria,
        ]);
    }
    public function show($id)
    {
        $producto = Producto::findOrFail($id);
        //dd($productos);
        return view("almacen.producto.show", compact('producto'));
    }
    public function edit($id)
    {
        //dd('aki estamos',$id);

        $producto = Producto::findOrFail($id);
        $categoria = DB::table('categoria')->where('condicionCategoria', '=', '1')->get();
        //dd($producto);
        return view('almacen.producto.update', compact('producto', 'categoria'));

        /* return  response()->json([
    "data"=> $producto,
    "cate"=>$categoria
    ]); */
    }
    public function update(ProductoFormRequest $request)
    {
        //dd($request, "llegue controler");

        $id = $request->get('idProducto');

        $producto = Producto::findOrFail($id);
        $producto->codProducto = $request->get('codProducto');
        $producto->nomProducto = $request->get('nomProducto');
        $producto->stockMinimo = $request->get('stockMinimo');
        $producto->unidadMedida = $request->get('unidadMedida');
        $producto->idCategoria = $request->get('idCategoria');
        $producto->precioVentaProducto = $request->get('precioVentaProducto');
        //$producto->CondicionProducto='1';
        //$producto->ImagenProducto=$request->get('ImagenProductoEdit');
        //dd($producto);
        if ($request->hasFile('imagenProducto')) {
            $file = $request->file('imagenProducto');
            //dd($file);
            $file->move(public_path() . '/imagenes/productos/', $file->getClientOriginalName());
            $producto->imagenProducto = $file->getClientOriginalName();
            $producto->update();

            /* return Redirect::to('almacen/producto'); */
            return response()->json([
                "data" => $producto,
            ]);
        } else {

            $producto->update();
            /*  return Redirect::to('almacen/producto'); */
            return response()->json([
                "data" => $producto,
            ]);
        }

    }
    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->condicionProducto = '0';
        $producto->update();
        return response()->json([
            "data" => $producto,

        ]);
    }
}
