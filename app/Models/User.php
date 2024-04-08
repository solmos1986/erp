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
            ->join('authenticacion', 'authenticacion.usuario_id', 'usuario.idUsuario')
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
        $menus = DB::table('authenticacion')
            ->select(
                'rol_super_modulo.rol_id',
                'super_modulo.super_modulo_id',
                'super_modulo.nombre_super_modulo',
                'modulo.modulo_id',
                'modulo.nombre_modulo',
                'modulo.class_icon',
                'modulo.url',
                'sub_modulo.sub_modulo_id',
                'sub_modulo.nombre_sub_modulo',
                'sub_modulo.url'
            )
            ->join('rol_authenticacion', 'rol_authenticacion.authenticacion_id', 'authenticacion.authenticacion_id')
            ->join('rol_super_modulo', 'rol_super_modulo.rol_id', 'rol_authenticacion.rol_id')
            ->join('super_modulo', 'super_modulo.super_modulo_id', 'rol_super_modulo.super_modulo_id')
            ->join('rol_modulo', 'rol_modulo.rol_super_modulo_id', 'rol_super_modulo.rol_super_modulo_id')
            ->join('modulo', 'modulo.modulo_id', 'rol_modulo.modulo_id')
            ->join('rol_sub_modulo', 'rol_sub_modulo.rol_modulo_id', 'rol_modulo.rol_modulo_id')
            ->join('sub_modulo', 'sub_modulo.sub_modulo_id', 'rol_sub_modulo.sub_modulo_id')
            ->where('authenticacion.authenticacion_id', auth()->user()->authenticacion_id)
            ->groupBy('sub_modulo.sub_modulo_id')
            ->get();
        //estructurar agrupacion manual

        $super_modulos = [];
        $agrupar_super_modulos = [];
        foreach ($menus as $k => &$menu) {
            $agrupar_super_modulos[$menu->super_modulo_id][$k] = $menu;
        }

        foreach ($agrupar_super_modulos as $key => $agrupar_super_modulo) {
            foreach ($agrupar_super_modulo as $key => $val) {
                $super_modulos[] = $val;
                break;
            }
        }

        $modulos = [];
        $agrupar_modulos = [];
        foreach ($menus as $k => &$menu) {
            $agrupar_modulos[$menu->modulo_id][$k] = $menu;
        }

        foreach ($agrupar_modulos as $key => $agrupar_modulo) {
            foreach ($agrupar_modulo as $key => $val) {
                $modulos[] = $val;
                break;
            }
        }

        foreach ($super_modulos as $key => $super_modulo) {
            foreach ($modulos as $key => $modulo) {
                if ($super_modulo->super_modulo_id == $modulo->super_modulo_id) {
                    $super_modulo->modulos[] = $modulo;
                }
            }
        }

        foreach ($super_modulos as $key => $super_modulo) {
            foreach ($super_modulo->modulos as $key => $modulo) {
                foreach ($menus as $key => $menu) {
                    if ($modulo->modulo_id == $menu->modulo_id) {
                        $modulo->sub_modulos[] = $menu;
                    }
                }
            }
        }
        //dd($super_modulos);
        return $super_modulos;
    }
}
