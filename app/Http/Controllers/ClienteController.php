<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ClienteController;
use App\Http\Requests\ClienteRequest; //agrega la ruta del modelo
use App\Models\Cliente; //para hacer algunas redirecciones
use DataTables; //hace referencia a nuestro request
use DB;
use Illuminate\Http\Request;
use Validator;

// sar la base de datos
/* use Intervention\Image\Facades\Image; */
/* use Intervention\Image\Laravel\Facades\Image; */

class ClienteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request) //recibe como parametro un objeto tipo request

    {

        if ($request->ajax()) {
            $data = DB::table('cliente')
                ->where('CondicionCliente', '=', '1')
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->rawColumns([])
                ->make(true);
        }
        return view('comercial/cliente/index');

    }
    public function dataTable()
    {
    }
    public function create()
    {
        return view("comercial.cliente.create");
        //return view("almacen.producto.create"); //abrira un archivo que se creara en esa ruta almacen/producto/create
    }
    public function store(ClienteRequest $request)
    {
        //dd($request, "LLEGUE CLieNTE STORE");
        $rules = array(
            'nomCliente' => 'required',
            'docCliente' => 'required',
            'tel1Cliente' => 'required',
            'dirCliente' => 'required',
        );
        $messages = [
            'nomCliente.required' => "Url es requerido",
            'docCliente.required' => "Icon es requerido",
            'tel1Cliente.required' => "Nombre es requerido",
        ];
        $error = Validator::make($request->all(), $rules, $messages);
        if ($error->errors()->all()) {
            return response()->json([
                'status' => 0,
                'message' => $error->errors()->all(),
            ]);
        }

        $clientes = new Cliente;
        $clientes->nomCliente = $request->get('nomCliente');
        //dd($clientes, "nombbeee");
        $clientes->docCliente = $request->get('docCliente');
        $clientes->tel1Cliente = $request->get('tel1Cliente');
        $clientes->tel2Cliente = $request->get('tel2Cliente');
        $clientes->dirCliente = $request->get('dirCliente');
        $clientes->mailCliente = $request->get('mailCliente');
        $clientes->CondicionCliente = '1';
        $docCli = $request->get('docCliente');
        $image = $request->get('imagen'); // your base64 encoded
        $image = str_replace('data:image/jpeg;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $imageName = "image" . uniqid() . time() . ".jpg";
        $IMAGENES = base64_decode($image);
        //dd("COMO ESL LA IMAGEN .JPG", $IMAGENES);
        \File::put(public_path() . '/imagenes/clientes/' . $imageName, base64_decode($image));
        //dd($clientes, "VER fotoCliente");
        $clientes->fotoCliente = $imageName;
        $clientes->save();

        return response()->json([
            "data" => $clientes,
            "img" => $clientes->fotoCliente,
        ]);

    }
    public function show($id)
    {
        $clientes = Cliente::findOrFail($id);
        return view("comercial.cliente.show", compact('clientes'));
        // return view("almacen.categoria.show",["categoria"=>Categoria::findOrFail($id)]);
    }
    public function edit($id)
    {
        $clientes = Cliente::findOrFail($id);
        //return view("almacen.categoria.edit",["categoria"=>Categoria::findOrFail($id)]);
        return response()->json([
            "data" => $clientes,
        ]);
    }
    public function update(ClienteRequest $request, $id)
    {
        $clientes = Cliente::findOrFail($id);
        $clientes->nomCliente = $request->get('nomCliente');
        $clientes->docCliente = $request->get('docCliente');
        $clientes->tel1Cliente = $request->get('tel1Cliente');
        $clientes->tel2Cliente = $request->get('tel2Cliente');
        $clientes->dirCliente = $request->get('dirCliente');
        $clientes->mailCliente = $request->get('mailCliente');
        $clientes->CondicionCliente = '1';
        $clientes->update();
        return response()->json([
            "data" => $clientes,

        ]);
    }
    public function destroy($id)
    {
        $clientes = Cliente::findOrFail($id);
        $clientes->CondicionCliente = '0';
        $clientes->update();
        return response()->json([
            "data" => $clientes,
        ]);
    }

    public function FileToBase64($nameFile)
    {
        try {
            $path = public_path() . '/assets/cuestionario/' . $nameFile . '';
            $extencion = pathinfo($path, PATHINFO_EXTENSION);
            $image = base64_encode(file_get_contents($path));
            return "data:image/$extencion;base64, $image";
        } catch (\Throwable $th) {
            return "";
        }
    }
    public function Base64toFile(Request $request)
    {

        $image = $request->get('imagen'); // your base64 encoded
        //dd($image, "IMAGENNN");
        $image = str_replace('data:image/jpeg;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $imageName = "image" . uniqid() . time() . ".jpg";
        \File::put(public_path() . '/imagenes/clientes/' . $imageName, base64_decode($image));
        return response()->json([
            "data" => $imageName,
        ]);

    }
    public function obtener_clientes(Request $request)
    {
        // dd($request->query('query'));
        $term = trim($request->query('query'));

        if (empty($term)) {
            return \Response::json([]);
        }

        $clientes = Cliente::where('nomCliente', 'LIKE', '%' . $term . '%')->limit(5)->get();

        $resultados = [];

        foreach ($clientes as $cliente) {
            $resultados[] = ['value' => $cliente->nomCliente, 'data' => $cliente->idCliente, 'docCliente' => $cliente->docCliente];
        }

        return \Response::json([
            'query' => $term,
            'suggestions' => $resultados,
        ]);
    }
    public function obtener_documento(Request $request)
    {
        // dd($request->query('query'));
        $term = trim($request->query('query'));

        if (empty($term)) {
            return \Response::json([]);
        }

        $clientes = Cliente::where('docCliente', 'LIKE', '%' . $term . '%')->limit(5)->get();

        $resultados = [];

        foreach ($clientes as $cliente) {
            $resultados[] = ['value' => $cliente->nomCliente, 'data' => $cliente->idCliente, 'docCliente' => $cliente->docCliente];
        }

        return \Response::json([
            'query' => $term,
            'suggestions' => $resultados,
        ]);
    }

}
