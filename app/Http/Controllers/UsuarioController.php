<?php

namespace App\Http\Controllers;

use App\Http\Controllers\UsuarioController;
use App\Http\Requests\UsuarioRequest; //agrega la ruta del modelo
use App\Models\Usuario; //para hacer algunas redirecciones
use DB;
use Illuminate\Http\Request; // sar la base de datos
use Validator;
use Yajra\DataTables\DataTables;

class UsuarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request) //recibe como parametro un objeto tipo request
    {
        if ($request->ajax()) {
            $data = DB::table('usuario')
                ->where('condicionUsuario', '=', '1')
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
    }

    public function store(UsuarioRequest $request)
    {
        $rules = array(
            'nomUsuario' => 'required',
            'docUsuario' => 'required',
            'telUsuario' => 'required',
            'dirUsuario' => 'required',
            'mailUsuario' => 'required|email',
        );
        $messages = [
            'nomUsuario.required' => "Nombre completo es requerido",
            'docUsuario.required' => "Documento identidad es requerido",
            'telUsuario.required' => "Telefono es requerido",
            'dirUsuario.required' => "Dirrecion es requerido",
            'mailUsuario.required' => "Email es requerido",
        ];
        $error = Validator::make($request->all(), $rules, $messages);

        if ($error->errors()->all()) {
            return response()->json([
                'status' => 0,
                'message' => $error->errors()->all(),
                'data' => [
                    'error' => [],
                ],
            ]);
        }
        $insert_usuario = DB::table('usuario')
            ->insertGetId([
                'fotoUsuario' => '',
                'nomUsuario' => $request->nomUsuario,
                'docUsuario' => $request->docUsuario,
                'telUsuario' => $request->telUsuario,
                'dirUsuario' => $request->dirUsuario,
                'mailUsuario' => $request->mailUsuario,
                'condicionUsuario' => 1,
            ]);

        $insert_autorizacion = DB::table('authenticacion')
            ->insertGetId([
                'usuario' => $request->docUsuario,
                'contraseña' => $request->docUsuario,
                'estado' => 1,
                'usuario_id' => $insert_usuario,
            ]);

        return response()->json([
            'status' => 1,
            'message' => 'Registrado correctamente',
            'data' => null,
        ]);
    }

    public function show($id)
    {
        $usuarios = Usuario::findOrFail($id);
        return view("rrhh.usuario.show", compact('usuarios'));
    }

    public function edit($id)
    {
        $usuario = Usuario::findOrFail($id);
        return response()->json([
            'status' => 1,
            'message' => 'Informacion de usuario',
            'data' => $usuario,
        ]);
    }

    public function update(UsuarioRequest $request, $id)
    {
        $rules = array(
            'nomUsuario' => 'required',
            'docUsuario' => 'required',
            'telUsuario' => 'required',
            'dirUsuario' => 'required',
            'mailUsuario' => 'required|email',
        );
        $messages = [
            'nomUsuario.required' => "Nombre completo es requerido",
            'docUsuario.required' => "Documento identidad es requerido",
            'telUsuario.required' => "Telefono es requerido",
            'dirUsuario.required' => "Dirrecion es requerido",
            'mailUsuario.required' => "Email es requerido",
        ];
        $error = Validator::make($request->all(), $rules, $messages);

        if ($error->errors()->all()) {
            return response()->json([
                'status' => 0,
                'message' => $error->errors()->all(),
                'data' => [
                    'error' => [],
                ],
            ]);
        }
        $update_usuario = DB::table('usuario')
            ->where('usuario.idUsuario', $id)
            ->update([
                'nomUsuario' => $request->nomUsuario,
                'docUsuario' => $request->docUsuario,
                'telUsuario' => $request->telUsuario,
                'dirUsuario' => $request->dirUsuario,
                'mailUsuario' => $request->mailUsuario,
            ]);
        return response()->json([
            'status' => 1,
            'message' => 'Modificado correctamente',
            'data' => null,
        ]);
    }

    public function destroy($id)
    {
        $usuarios = Usuario::findOrFail($id);
        $usuarios->CondicionUsuario = '0';
        $usuarios->update();
        return response()->json([
            'status' => 1,
            'message' => 'Eliminado correctamente',
            'data' => null,
        ]);
    }
}
