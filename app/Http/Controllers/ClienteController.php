<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Cliente; //agrega la ruta del modelo
use Illuminate\Support\Facades\Redirect; //para hacer algunas redirecciones
use App\Http\Requests\ClienteRequest; //hace referencia a nuestro request
use DB;// sar la base de datos
use Illuminate\Pagination\Paginator;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Input as input;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use App\Http\Controllers\ClienteController;

class ClienteController extends Controller
{
    public function __construct()
    {

    }
    public function index(Request $request) //recibe como parametro un objeto tipo request
    {


        if ($request->ajax()) {
            $data = DB::table('cliente')
            ->where('CondicionCliente','=','1')
            ->get();
            return Datatables::of($data)
            ->addIndexColumn()
            ->rawColumns([])
            ->make(true);
            }
            return view('comercial/cliente/index');

    }
    public function  dataTable(){
    }
    public function create()
    {
		return view("comercial.cliente.create");
    	//return view("almacen.producto.create"); //abrira un archivo que se creara en esa ruta almacen/producto/create
    }
    public function store(ClienteRequest $request){
        $clientes=new Cliente;
    	$clientes->nomCliente=$request->get('nomCliente');
        $clientes->docCliente=$request->get('docCliente');
        $clientes->tel1Cliente=$request->get('tel1Cliente');
        $clientes->tel2Cliente=$request->get('tel2Cliente');
        $clientes->dirCliente=$request->get('dirCliente');
        $clientes->mailCliente=$request->get('mailCliente');
    	$clientes->CondicionCliente='1';
    	$clientes->save();
    	return Redirect::to('comercial/cliente');
    }
    public function show($id){
        $clientes=Cliente::findOrFail($id);
        return view("comercial.cliente.show",compact('clientes'));
       // return view("almacen.categoria.show",["categoria"=>Categoria::findOrFail($id)]);
    }
    public function edit($id){
        $clientes=Cliente::findOrFail($id);
        //return view("almacen.categoria.edit",["categoria"=>Categoria::findOrFail($id)]);
        return  response()->json([
    		"data"=> $clientes
    	]);
    }
    public function update(ClienteRequest $request,$id){
        $clientes=Cliente::findOrFail($id);
        $clientes->nomCliente=$request->get('nomCliente');
        $clientes->docCliente=$request->get('docCliente');
        $clientes->tel1Cliente=$request->get('tel1Cliente');
        $clientes->tel2Cliente=$request->get('tel2Cliente');
        $clientes->dirCliente=$request->get('dirCliente');
        $clientes->mailCliente=$request->get('mailCliente');
    	$clientes->CondicionCliente='1';
        $clientes->update();
        return  response()->json([
    		"data"=> $clientes
    	]);
    }
    public function destroy($id){
        $clientes=Cliente::findOrFail($id);
    	$clientes->CondicionCliente='0';
    	$clientes->update();
    	return  response()->json([
    		"data"=> $clientes
    	]);
    }


}
