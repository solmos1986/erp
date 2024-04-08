<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ClienteController;
use App\Http\Requests\ClienteRequest; //agrega la ruta del modelo
use App\Models\Cliente; //para hacer algunas redirecciones
use DataTables; //hace referencia a nuestro request
use DB;
use File;
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

    public function index(Request $request)
    {
        return view('comercial/cliente/index');
    }
    public function dataTable()
    {
        $data = DB::table('cliente')
            ->where('CondicionCliente', '=', '1')
            ->orderBy('cliente.idCliente', 'DESC')
            ->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->rawColumns([])
            ->make(true);
    }
    public function create()
    {
        return view("comercial.cliente.create");
        //return view("almacen.producto.create"); //abrira un archivo que se creara en esa ruta almacen/producto/create
    }
    public function store(ClienteRequest $request)
    {
        $rules = array(
            'nomCliente' => 'required',
            'docCliente' => 'required',
            'image' => 'required',
        );
        $messages = [
            'nomCliente.required' => "Nombre y Apellido son requeridos",
            'docCliente.required' => "Numero documento",
            'image.required' => "Foto es requerida",
        ];
        $error = Validator::make($request->all(), $rules, $messages);

        if ($error->errors()->all()) {
            return response()->json([
                'status' => 0,
                'message' => $error->errors()->all(),
            ]);
        }
        //validar primero el numero de carnet
        if ($this->validarCarnet($request->docCliente)) {
            return response()->json([
                'status' => 0,
                'message' => ['Numero de carnet ya fue registrado'],
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
        $image = $request->get('image'); // your base64 encoded
        $imageName = "image" . uniqid() . time() . ".jpg";
        File::put(public_path() . '/imagenes/clientes/' . $imageName, file_get_contents($image));
        $clientes->fotoCliente = $imageName;
        $clientes->save();
        return response()->json([
            "status" => 1,
            "message" => "Registrado correctamente",
            "data" => [
                "data" => $clientes,
                "img" => $clientes->fotoCliente,
            ],
        ]);
    }
    public function validarCarnet($docCliente)
    {
        $validarDocumento = DB::table('cliente')
            ->where('docCliente', $docCliente)
            ->where('CondicionCliente', '=', '1')
            ->get();
        if (count($validarDocumento) > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function validarCarnetUpdate($docCliente, $idCliente)
    {
        $validarDocumento = DB::table('cliente')
            ->where('docCliente', $docCliente)
            ->where('CondicionCliente', '=', '1')
            ->whereNotIn('idCliente', [$idCliente])
            ->get();
        if (count($validarDocumento) > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function show($id)
    {
        $clientes = Cliente::findOrFail($id);
        return view("comercial.cliente.show", compact('clientes'));
    }
    public function edit($id)
    {
        $cliente = Cliente::findOrFail($id);
        $base64 = $this->FileToBase64($cliente->fotoCliente);

        $cliente->fotoCliente = $base64;
        return response()->json([
            "status" => 1,
            "message" => "Mostrar cliente",
            "data" => $cliente,
        ]);
    }
    public function update(ClienteRequest $request, $id)
    {
        $rules = array(
            'nomCliente' => 'required',
            'docCliente' => 'required',
            'image' => 'required',
        );
        $messages = [
            'nomCliente.required' => "Nombre y Apellido son requeridos",
            'docCliente.required' => "Numero documento",
            'image.required' => "Foto es requerida",
        ];
        $error = Validator::make($request->all(), $rules, $messages);

        if ($error->errors()->all()) {
            return response()->json([
                'status' => 0,
                'message' => $error->errors()->all(),
            ]);
        }
        //validar primero el numero de carnet
        if ($this->validarCarnetUpdate($request->docCliente, $request->idCliente)) {
            return response()->json([
                'status' => 0,
                'message' => ['Numero de carnet ya fue registrado'],
            ]);
        }

        $image = $request->image; // your base64 encoded
        $imageName = "image" . uniqid() . time() . ".jpg";
        //delete
        //File::delete($filename);
        File::put(public_path() . '/imagenes/clientes/' . $imageName, file_get_contents($image));

        $update = DB::table('cliente')
            ->where('idCliente', $request->idCliente)
            ->update([
                'nomCliente' => $request->nomCliente,
                'docCliente' => $request->docCliente,
                'tel1Cliente' => $request->tel1Cliente,
                'tel2Cliente' => $request->tel2Cliente,
                'dirCliente' => $request->dirCliente,
                'mailCliente' => $request->mailCliente,
                'fotoCliente' => $imageName,
            ]);

        return response()->json([
            "status" => 1,
            "message" => "Modificado correctamente",
            "data" => [
            ],
        ]);
    }
    public function destroy($id)
    {
        $clientes = Cliente::findOrFail($id);
        $clientes->CondicionCliente = '0';
        $clientes->update();
        return response()->json([
            "status" => 1,
            "message" => "Eliminado correctamente",
            "data" => [
            ],
        ]);
    }

    public function FileToBase64($nameFile)
    {
        try {
            $path = public_path() . '/imagenes/clientes/' . $nameFile . '';
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
        if (empty($request->searchTerm)) {
            return response()->json([]);
        }
        $clientes = Cliente::where('nomCliente', 'LIKE', '%' . $request->searchTerm . '%')->get();
        $resultados = [];
        foreach ($clientes as $cliente) {
            $resultados[] = [
                'text' => $cliente->nomCliente,
                'id' => $cliente->idCliente,
                'docCliente' => $cliente->docCliente,
            ];
        }
        return response()->json($resultados);
    }
    public function obtener_documento(Request $request)
    {
        if (empty($request->searchTerm)) {
            return response()->json([]);
        }
        $clientes = Cliente::where('docCliente', 'LIKE', '%' . $request->searchTerm . '%')->get();
        $resultados = [];
        foreach ($clientes as $cliente) {
            $resultados[] = [
                'text' => $cliente->docCliente,
                'id' => $cliente->idCliente,
                'nomCliente' => $cliente->nomCliente,
            ];
        }
        return response()->json($resultados);
    }

}
