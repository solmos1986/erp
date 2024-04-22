<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductoFormRequest; //agrega la ruta del modelo
use App\Models\Producto; //para hacer algunas redirecciones
use DB; //hace referencia a nuestro request
use Illuminate\Http\Request; // sar la base de datos
use Validator;
use Yajra\DataTables\DataTables;

class ProductoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function obtener_producto()
    {
        $productos = DB::table('producto as pro')
            ->select(
                'pro.idProducto',
                'pro.codProducto',
                'pro.nomProducto',
                'cat.nomCategoria',
                'pro.imagenProducto',
                'pro.unidadMedida',
                'sp.stock',
                DB::raw('((sp.promedio)+(sp.promedio*(pro.porcentaje_ganancia/100))) as precio_venta'),
            )
            ->join('producto_stock as sp', 'sp.idProducto', '=', 'pro.idProducto')
            ->join('categoria as cat', 'cat.idCategoria', '=', 'pro.idCategoria')
            ->where('condicionProducto', '=', 1)
            ->get();
        $clientes = DB::table('cliente')->where('condicionCliente', '=', 1)->get();
        $usuario = DB::table('usuario')->where('condicionUsuario', '=', 1)->get();
        $tipoPago = DB::table('tipopago')->where('condicionTipoPago', '=', 1)->get();
        $stock = DB::select('SELECT * FROM stock_producto');
        //dd($productos, "productos");
        return response()->json([
            "data" => $productos,
            "stock" => $stock,
            "status" => 1,
            "message" => '',
        ]);
    }
    public function index(Request $request)
    {
        return view('almacen/producto/index');
    }
    public function dataTable(Request $request)
    {
        $data = DB::table('producto as pro')
            ->select(
                'pro.*',
                'cat.nomCategoria',
                'sp.promedio',
                'sp.stock',
                DB::raw('((sp.promedio)+(sp.promedio*(pro.porcentaje_ganancia/100))) as precio_venta'),
            )
            ->join('categoria as cat', 'cat.idCategoria', '=', 'pro.idCategoria')
            ->join('producto_stock as sp', 'sp.idProducto', '=', 'pro.idProducto')
            ->where('condicionProducto', '=', '1')
            ->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->rawColumns([])
            ->make(true);
    }
    public function create(Request $request)
    {
        $categoria = DB::table('categoria')->where('condicionCategoria', '=', '1')->get();
        return view('almacen.producto.create', compact('categoria'));
    }
    public function store(ProductoFormRequest $request)
    {
        $rules = array(
            'codProducto' => 'required',
            'nomProducto' => 'required',
            'imagenProducto' => 'required',
            'unidadMedida' => 'required',
            'idCategoria' => 'required',
            'porcentaje_ganancia' => 'required',
            'stockMinimo' => 'required',
        );
        $messages = [
            'codProducto.required' => "Codigo es requerido",
            'nomProducto.required' => "Nombre es requerido",
            'imagenProducto.required' => "Imagen es requerida",
            'unidadMedida.required' => "Seleccione una unidad de medida",
            'idCategoria.required' => "Seleccione una categoria",
            'porcentaje_ganancia.required' => "Porcentaje gannacia es requerido",
            'stockMinimo.required' => "Stock minimo es requerido",
        ];
        $error = Validator::make($request->all(), $rules, $messages);

        if ($error->errors()->all()) {
            return response()->json([
                'status' => 0,
                'message' => $error->errors()->all(),
            ]);
        }

        if ($request->hasFile('imagenProducto')) {
            $file = $request->file('imagenProducto');
            $file->move(public_path() . '/imagenes/productos/', $file->getClientOriginalName());
            $imagenProducto = $file->getClientOriginalName();
        } else {
            $imagenProducto = '';
        }
        $insert = DB::table('producto')
            ->insertGetId([
                'codProducto' => $request->codProducto,
                'nomProducto' => $request->nomProducto,
                'imagenProducto' => $imagenProducto,
                'unidadMedida' => $request->unidadMedida,
                'idCategoria' => $request->idCategoria,
                'porcentaje_ganancia' => $request->porcentaje_ganancia,
                'stockMinimo' => $request->stockMinimo,
                'descripcion' => $request->descripcion,
            ]);

        return response()->json([
            'status' => 1,
            'message' => 'Registrado correctamente',
            'data' => null,
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
    public function buscarSerie(Request $request)
    {
        $producto = DB::table('entrada_producto_almacen')
            ->select(
                'producto.idProducto',
                'producto.codProducto',
                'producto.nomProducto',
                'categoria.nomCategoria',
                'producto.imagenProducto',
                'producto.unidadMedida',
                'producto_stock.stock',
                DB::raw('((producto_stock.promedio)+(producto_stock.promedio*(producto.porcentaje_ganancia/100))) as precio_venta'),
            )
            ->join('producto', 'producto.idProducto', '=', 'entrada_producto_almacen.idProducto')
            ->join('producto_stock', 'producto_stock.idProducto', '=', 'producto.idProducto')
            ->join('categoria', 'categoria.idCategoria', '=', 'producto.idCategoria')
            ->where('producto.condicionProducto', '=', 1)
            ->where('entrada_producto_almacen.serie', $request->serie)
            ->first();
        if ($producto) {
            return response()->json([
                "status" => 1,
                "message" => "Añadido correctamnte",
                "data" => $producto,
            ]);
        } else {
            return response()->json([
                "status" => 0,
                "message" => "No detectado correctamnte",
                "data" => null,
            ]);
        }

    }
}
