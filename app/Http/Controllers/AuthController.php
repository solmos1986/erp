<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest', ['only' => 'index']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("auth.login");
    }
    public function verificar(Request $request)
    {
        $usuario = DB::table('authenticacion')
            ->where('usuario', $request->usuario)
            ->where('contraseña', $request->password)
            ->where('estado', 1)
            ->first();
        if ($usuario) {
            if (Auth::loginUsingId($usuario->usuario_id)) {
                // Authentication passed...
                return redirect(route('dashboard'));
            } else {
                return redirect(route('dashboard'));
            }
        } else {
            return redirect(route('auth.login'))->with('flash', 'This data is incorrect');
        }
    }

    public function logout()
    {
        if (Auth::check()) {
            Auth::logout();
            request()->session()->flush();
            request()->session()->invalidate();
        }
        return redirect(route('auth.login'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
