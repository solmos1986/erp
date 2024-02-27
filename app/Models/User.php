<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $table = 'authenticacion';
    protected $primaryKey = 'authenticacion_id';

    protected $fillable = [
        'usuario',
        'contraseña',
        'estado',
        'usuario_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'contraseña',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function obtener_usuario()
    {
        $usuario = DB::table('usuario')
            ->where('idUsuario', auth()->user()->usuario_id)
            ->first();
        return $usuario;
    }
    public function obtener_roles()
    {
        $roles = DB::table('rol_authenticacion')
            ->select('rol_authenticacion.rol_id')
            ->join('authenticacion', 'authenticacion.authenticacion_id', 'rol_authenticacion.authenticacion_id')
            ->where('authenticacion.usuario_id', auth()->user()->usuario_id)
            ->where('authenticacion.estado', 1)
            ->get()
            ->pluck('rol_id');
        return $roles;
    }
    public function obtener_menu()
    {
        $roles = $this->obtener_roles();
        $super_modulos = DB::table('rol_super_modulo')
            ->join('super_modulo', 'super_modulo.super_modulo_id', 'rol_super_modulo.super_modulo_id')
            ->whereIn('rol_super_modulo.rol_id', $roles)
            ->groupBy('rol_super_modulo.super_modulo_id')
            ->get();
        foreach ($super_modulos as $key => $super_modulo) {
            $modulos = DB::table('rol_modulo')
                ->join('modulo', 'modulo.modulo_id', 'rol_modulo.modulo_id')
                ->where('rol_modulo.rol_super_modulo_id', $super_modulo->rol_super_modulo_id)
                ->groupBy('rol_modulo.modulo_id')
                ->get();
            foreach ($modulos as $key => $modulo) {
                $sub_modulos = DB::table('rol_sub_modulo')
                    ->join('sub_modulo', 'sub_modulo.sub_modulo_id', 'rol_sub_modulo.sub_modulo_id')
                    ->where('rol_sub_modulo.rol_modulo_id', $modulo->rol_modulo_id)
                    ->groupBy('rol_sub_modulo.sub_modulo_id')
                    ->get();
                $modulo->sub_modulos = $sub_modulos;
            }
            $super_modulo->modulos = $modulos;
        }

        return $super_modulos;
    }
}
