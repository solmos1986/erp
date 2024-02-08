<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Usuario; //agrega la ruta del modelo
use Illuminate\Support\Facades\Redirect; //para hacer algunas redirecciones
use App\Http\Requests\UsuarioRequest;
use DB;// sar la base de datos
use Illuminate\Pagination\Paginator;

use Illuminate\Support\Facades\Input as input;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use App\Http\Controllers\DataTableUserController;
use DataTables;

class DataTableUserController extends Controller
{

    public function index(Request $request) //recibe como parametro un objeto tipo request
    {
        //dd($request,"dataaa");

            $data=DB::table('usuario')
            ->get();
            /*  dd($data, "dataaa"); */
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('accion', function($row){

                            $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';

                            return $btn;
                    })
                    ->rawColumns(['accion'])
                    ->make(true);


        return view ("usuario");
    }



}
