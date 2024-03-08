<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ClienteController;
use App\Http\Requests\ClienteRequest; //agrega la ruta del modelo
use App\Models\Cliente; //para hacer algunas redirecciones
use DB; //hace referencia a nuestro request
use Illuminate\Http\Request; // sar la base de datos
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Yajra\DataTables\DataTables;

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
        $image = $request->get('imagen'); 
        $clientes->fotoCliente=$this->Base64toFile($image,1);
        //$clientes->fotoCliente = $imageName;
        //dd($clientes, "VER fotoCliente");
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
    public function Base64toFile($base64,$id)
    {
        $manager = new ImageManager(Driver::class);

        $name = "image-$id-" . uniqid() . time() . ".jpg";
        $path = public_path() . '/imagenes/clientes/' . $name;  
        $image = $manager->read(file_get_contents($base64));
        $image->resize(height: 600);
        $encoded = $image->toJpg();
        $encoded->save($path);
        return $name;

    }

}
