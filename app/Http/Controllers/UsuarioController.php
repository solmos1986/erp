<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Usuario; //agrega la ruta del modelo
use Illuminate\Support\Facades\Redirect; //para hacer algunas redirecciones
use App\Http\Requests\UsuarioRequest;
use DB;// sar la base de datos
use Illuminate\Pagination\Paginator;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Input as input;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use App\Http\Controllers\UsuarioController;

class UsuarioController extends Controller
{

    public function index(Request $request) //recibe como parametro un objeto tipo request
    {
        if ($request->ajax()) {
            $data = DB::table('usuario')
            ->where('condicionUsuario','=','1')
            ->get();
            return Datatables::of($data)
            ->addIndexColumn()
            ->rawColumns([])
            ->make(true);
            }
            return view('rrhh/usuario/index');
    }


    public function create()
    {
		return view("rrhh.usuario.create");
    	//return view("rrhh.producto.create"); //abrira un archivo que se creara en esa ruta rrhh/producto/create
    }
    public function store(UsuarioRequest $request){

        $usuarios=new Usuario;
    	$usuarios->nomUsuario=$request->get('nomUsuario');
        $usuarios->telUsuario=$request->get('telUsuario');
        $usuarios->docUsuario=$request->get('docUsuario');
        $usuarios->dirUsuario=$request->get('dirUsuario');
        $usuarios->mailUsuario=$request->get('mailUsuario');
    	$usuarios->condicionUsuario='1';
    	$usuarios->save();
    	return Redirect::to('rrhh/usuario');
    }

    public function show($id){
        $usuarios=Usuario::findOrFail($id);
        return view("rrhh.usuario.show",compact('usuarios'));
    }

    public function edit($id){
        $usuarios=Usuario::findOrFail($id);
        return  response()->json([
    		"data"=> $usuarios
    	]);
    }

    public function update(UsuarioRequest $request,$id){
        $usuarios=Usuario::findOrFail($id);
        $usuarios->nomUsuario=$request->get('nomUsuario');
        $usuarios->telUsuario=$request->get('telUsuario');
        $usuarios->docUsuario=$request->get('docUsuario');
        $usuarios->dirUsuario=$request->get('dirUsuario');
        $usuarios->mailUsuario=$request->get('mailUsuario');
    	$usuarios->CondicionUsuario='1';
        $usuarios->update();
        //return Redirect::to('rrhh/usuario');
        return  response()->json([
    		"data"=> $usuarios
    	]);
    }

    public function destroy($id){
        dd("LLEGO A DESTROY USUARIO");
        $usuarios=Usuario::findOrFail($id);
    	$usuarios->CondicionUsuario='0';
    	$usuarios->update();
    	return  response()->json([
    		"data"=> $usuarios
    	]);
    }
 }




