<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ClienteController;
use App\Http\Requests\ClienteRequest; //agrega la ruta del modelo
use App\Models\Cliente; //para hacer algunas redirecciones
use DataTables; //hace referencia a nuestro request
use DB;
use Illuminate\Http\Request;

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
        //dd($request, "LLEGUE CONTROL BASE64 STORE");
        $clientes = new Cliente;
        $clientes->nomCliente = $request->get('nomCliente');
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
        \File::put(public_path() . '/imagenes/clientes/' . $imageName, base64_decode($image));
        //dd($clientes, "VER fotoCliente");
        $clientes->save();

        return response()->json([
            "data" => $clientes,
            "img" => $imageName,
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

}
