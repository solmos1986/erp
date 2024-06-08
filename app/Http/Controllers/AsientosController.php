<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class AsientosController extends Controller
{
    public function index(Request $request)
    {
        $cliente = DB::table('cliente')->where('condicionCliente', '=', '1')->get();
        $tipopago = DB::table('metodo_pago')->where('condicionTipoPago', '=', '1')->get();
        $tipo_comprobante = DB::table('tipo_comprobante')->where('condicionTipo_Comprobante', '=', '1')->get();
        $usuario = DB::table('usuario')->where('condicionUsuario', '=', '1')->get();

        /* return view('contabilidad/ingresos/index', ['cliente' => $cliente, 'tipopago' => $tipopago, 'tipo_comprobante' => $tipo_comprobante, 'usuario' => $usuario]); */
        return redirect('contabilidad/ingresos/3');

    }
}
