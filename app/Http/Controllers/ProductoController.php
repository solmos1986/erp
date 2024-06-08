<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductoFormRequest; //agrega la ruta del modelo
use App\Models\Producto; //para hacer algunas redirecciones
use DB; //hace referencia a nuestro request
use Illuminate\Http\Request; // sar la base de datos
use stdClass;
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
                'pro.*',
                'u.*',
                'cat.nomCategoria',
                DB::raw('(sum(sp.cantidad_compra)-sum(sp.cantidad_venta)) as stock'),
            )
            ->join('categoria as cat', 'cat.idCategoria', '=', 'pro.idCategoria')
            ->join('unidad_medida as u', 'u.idUnidadMedida', '=', 'pro.idUnidadMedida')
            ->join('producto_precio_compra as sp', 'sp.idProducto', '=', 'pro.idProducto')
            ->where('condicionProducto', '=', '1')
            ->groupBy('pro.idProducto')
            ->get();
        return response()->json([
            "data" => $productos,
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
                'u.*',
                'cat.nomCategoria',
                DB::raw('(sum(sp.cantidad_compra)-sum(sp.cantidad_venta)) as stock'),
            )
            ->join('categoria as cat', 'cat.idCategoria', '=', 'pro.idCategoria')
            ->join('unidad_medida as u', 'u.idUnidadMedida', '=', 'pro.idUnidadMedida')
            ->join('producto_precio_compra as sp', 'sp.idProducto', '=', 'pro.idProducto')
            ->where('condicionProducto', '=', '1')
            ->groupBy('pro.idProducto')
            ->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->rawColumns([])
            ->make(true);
    }
    public function create(Request $request)
    {
        $categoria = DB::table('categoria')
            ->where('categoria.condicionCategoria', '=', '1')
            ->orderBy('categoria.idCategoriaPadre', 'ASC')
            ->get();
        $unidad_medida = DB::table('unidad_medida')->get();
        return view('almacen.producto.create', compact('categoria', 'unidad_medida'));
    }
    public function store(Request $request)
    {
        $rules = array(
            'codProducto' => 'required',
            'nomProducto' => 'required',
            'imagenProducto' => 'required',
            'unidadMedida' => 'required',
            'idCategoria' => 'required',
            'stockMinimo' => 'required',
        );
        $messages = [
            'codProducto.required' => "Codigo es requerido",
            'nomProducto.required' => "Nombre es requerido",
            'imagenProducto.required' => "Imagen es requerida",
            'unidadMedida.required' => "Seleccione una unidad de medida",
            'idCategoria.required' => "Seleccione una categoria",
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
                'stockMinimo' => $request->stockMinimo,
                'descripcion' => $request->descripcion,
                'precioVenta' => $request->precioVenta,
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
        return view("almacen.producto.show", compact('producto'));
    }
    public function edit($id)
    {
        $producto = DB::table('producto')
            ->where('producto.idProducto', $id)
            ->first();
        $categoria = DB::table('categoria')
            ->where('categoria.condicionCategoria', '=', '1')
            ->orderBy('categoria.idCategoriaPadre', 'ASC')
            ->get();
        $unidad_medida = DB::table('unidad_medida')->get();
        $promedio = $this->promedio_precio($producto->idProducto);
        //dd($promedio);
        return view('almacen.producto.edit', compact('producto', 'categoria', 'unidad_medida', 'promedio'));
    }
    public function update(Request $request, $id)
    {
        //dd($request->idProducto);
        $rules = array(
            'idProducto' => 'required',
            'codProducto' => 'required',
            'nomProducto' => 'required',
            'imagenProducto' => 'required',
            'unidadMedida' => 'required',
            'idCategoria' => 'required',
            'stockMinimo' => 'required',
        );
        $messages = [
            'codProducto.required' => "Codigo es requerido",
            'nomProducto.required' => "Nombre es requerido",
            'imagenProducto.required' => "Imagen es requerida",
            'unidadMedida.required' => "Seleccione una unidad de medida",
            'idCategoria.required' => "Seleccione una categoria",
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
            ->where('producto.idProducto', $request->idProducto)
            ->update([
                'codProducto' => $request->codProducto,
                'nomProducto' => $request->nomProducto,
                'imagenProducto' => $imagenProducto,
                'unidadMedida' => $request->unidadMedida,
                'idCategoria' => $request->idCategoria,
                'stockMinimo' => $request->stockMinimo,
                'descripcion' => $request->descripcion,
                'precioVenta' => $request->precioVenta,
            ]);

        return response()->json([
            'status' => 1,
            'message' => 'Modificado correctamente',
            'data' => null,
        ]);
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
                'producto.*',
                'categoria.nomCategoria',
                'entrada_producto_almacen.*'
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
                "message" => "Añadido correctamente",
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
    public function promedio_precio($idProducto)
    {
        $compras = DB::table('producto_precio_compra')
            ->where('producto_precio_compra.idProducto', $idProducto)
            ->get();
        $total = 0;
        $totalCompra = 0;
        $totalVenta = 0;
        foreach ($compras as $key => $compra) {
            $totalCompra += $compra->cantidad_compra;
            $totalVenta += $compra->cantidad_venta;
            $total += $compra->promedio;
        }
        try {
            $promedio = round(($total / ($totalCompra - $totalVenta)), 2);
        } catch (\Throwable $th) {
            $promedio = 0;
        }
        
        $resultado = new stdClass;
        $resultado->compras = $compras;
        $resultado->promedio = $promedio;
        return $resultado;
    }
    public function table_compras(Request $request, $id)
    {
        $promedio = $this->promedio_precio($id);
        return response()->json([
            "status" => 1,
            "message" => "mostras lista de compras",
            "data" => $promedio,
        ]);
    }
}
