<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Categoria; //agrega la ruta del modelo
use Illuminate\Support\Facades\Redirect; //para hacer algunas redirecciones
use App\Http\Requests\CategoriaRequest; //hace referencia a nuestro request
use DB;// sar la base de datos
use Illuminate\Pagination\Paginator;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Input as input;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use App\Http\Controllers\CategoriaController;

class CategoriaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request){  //recibe un objeto llamado Request y le asigna a la variable $request
       if ($request->ajax()) {
            $data = DB::table('categoria')
            ->where('condicionCategoria','=','1')
            ->get();
            return Datatables::of($data)
            ->addIndexColumn()
            ->rawColumns([])
            ->make(true);
            }
            return view('almacen/categoria/index');
    }

    public function create(){
        return view("almacen.categoria.create");
    }
    public function store(CategoriaRequest $request){
        // dd('PdfController / store()', $request->all());
        $categoria=new Categoria;
    	$categoria->nomCategoria=$request->get('nomCategoria');
    	$categoria->condicionCategoria='1';
    	$categoria->save();
    	return Redirect::to('almacen/categoria');
    }
    public function show($id){
        $categoria=Categoria::findOrFail($id);
        return view("almacen.categoria.show",compact('categoria'));
       // return view("almacen.categoria.show",["categoria"=>Categoria::findOrFail($id)]);
    }
    public function edit($id){
        //dd('PdfController / store()', $request->all());
        $categoria=Categoria::findOrFail($id);
        //return view("almacen.categoria.edit",["categoria"=>Categoria::findOrFail($id)]);
        return  response()->json([
    		"data"=> $categoria
    	]);
        return  response()->json([
    		"data"=> $categoria
    	]);
    }
    public function update(CategoriaRequest $request,$id){
        $categoria=Categoria::findOrFail($id);
        $categoria->nomCategoria=$request->get('nomCategoria');
        $categoria->condicionCategoria='1';
        $categoria->update();
        //dd('PdfController / store()', $categoria);
        return  response()->json([
    		"data"=> $categoria
    	]);
    }
    public function destroy($id){
        $categoria=Categoria::findOrFail($id);
    	$categoria->condicionCategoria='0';
    	$categoria->update();
    	return  response()->json([
    		"data"=> $categoria
    	]);
    }
}
