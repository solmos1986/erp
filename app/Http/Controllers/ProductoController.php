<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Producto; //agrega la ruta del modelo
use Illuminate\Support\Facades\Redirect; //para hacer algunas redirecciones
use App\Http\Requests\ProductoFormRequest; //hace referencia a nuestro request
use DB;// sar la base de datos
use Illuminate\Pagination\Paginator;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Input as input;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
class ProductoController extends Controller

{
    public function __construct()
    {

    }
    public function index(Request $request) //recibe como parametro un objeto tipo request
    {
    	 if ($request->ajax()) {
            $data = DB::table('producto')
            ->where('condicionProducto','=','1')
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
        $categoria=DB::table('categoria')->where('condicionCategoria','=','1')->get();

      //dd($categoriasa);
        return view('almacen.producto.create',compact('categoria'));

    }
    public function store(ProductoFormRequest $request)// hace una validacion con el archivo ProductoFormRequest
    {
       // dd($request, "llegue controler");
		$categoria=DB::table('categoria')->where('condicionCategoria','=','1')->get();

    	$producto=new Producto;
			//dd($producto);
    	$producto->codProducto=$request->get('codProducto');
    	$producto->nomProducto=$request->get('nomProducto');
    	$producto->stockMinimo=$request->get('stockMinimo');
    	$producto->unidadMedida=$request->get('unidadMedida');
    	$producto->idCategoria=$request->get('idCategoria');

		$producto->imagenProducto=$request->get('imagenProducto');
		($request->hasFile('imagenProducto'));
		$producto->condicionProducto='1';
		if($request->hasFile('imagenProducto')){

			//dd($producto);// con producto me sigue dando nulo no funciona $file
			$file=$request->file('imagenProducto');
			//dd($file); //aqui da nulo con $producto pero con $file ya da orignal name
			$file->move(public_path().'/imagenes/productos/',$file->getClientOriginalName());
			//dd($producto); //da nulo
			//dd($file);
			$producto->imagenProducto=$file->getClientOriginalName();
		}

    	$producto->save();
        return  response()->json([
    		"data"=> $producto,
			"cate"=>$categoria
    	]);
        //return view('almacen.producto.index',compact('categoria'));
    	//return Redirect::to('almacen/producto');

     // ese objeto producto hace referencia al MODELO PRODUCTO
    }
    public function show($id)
    {
    	$producto=Producto::findOrFail($id);
    	//dd($productos);
    	return view("almacen.producto.show",compact('producto'));
    }
    public function edit($id)
    {
    	//dd('aki estamos',$id);

    	$producto=Producto::findOrFail($id);
		$categoria=DB::table('categoria')->where('condicionCategoria','=','1')->get();
        //dd($producto);
        return view('almacen.producto.update',compact('producto','categoria'));

    	/* return  response()->json([
    		"data"=> $producto,
			"cate"=>$categoria
    	]); */
 	}
    public function update(ProductoFormRequest $request)
    {

   			$id=$request->get('idProducto');

    		$producto=Producto::findOrFail($id);
	    	$producto->codProducto=$request->get('codProducto');
    		$producto->nomProducto=$request->get('nomProducto');
    		$producto->stockMinimo=$request->get('stockMinimo');
    		$producto->unidadMedida=$request->get('unidadMedida');
    		$producto->idCategoria=$request->get('idCategoria');
			//$producto->CondicionProducto='1';
			//$producto->ImagenProducto=$request->get('ImagenProductoEdit');
			//dd($producto);
			if($request->hasFile('imagenProducto')){
			$file=$request->file('imagenProducto');
			//dd($file);
			$file->move(public_path().'/imagenes/productos/',$file->getClientOriginalName());
			$producto->imagenProducto=$file->getClientOriginalName();
			$producto->update();

            /* return Redirect::to('almacen/producto'); */
				return  response()->json([
    		"data"=> $producto,
    	]);
			}
			else{

				$producto->update();
               /*  return Redirect::to('almacen/producto'); */
				return  response()->json([
    		"data"=> $producto,
    	]);
			}

    }
    public function destroy($id)
    {
    	$producto=Producto::findOrFail($id);
    	$producto->condicionProducto='0';
    	$producto->update();
    	return  response()->json([
    		"data"=> $producto,

    	]);
    }
}
