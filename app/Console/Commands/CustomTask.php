<?php

namespace App\Console\Commands;

use App\Http\Controllers\Utils;
use App\SocketCliente\Usuario;
use DB;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CustomTask extends Command
{
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hour:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */

    public function handle()
    {
        $this->info('Custom task executed successfully!');
        Log::info("job recorido actualizado => " . date('Y-m-d H:i:s'));
        $inscripcion_eliminar = DB::table('detalle_inscripcion')
            ->join('cliente', 'cliente.idCliente', 'detalle_inscripcion.idCliente')
            ->join('inscripcion', 'inscripcion.idInscripcion', 'detalle_inscripcion.idInscripcion')
            ->where('inscripcion.estado', 'vig')
            ->where('detalle_inscripcion.fechaFin', '>=', DB::raw("DATE_FORMAT((NOW() - INTERVAL 1 DAY), '%Y-%m-%d 00:00:00')"))
            ->where('detalle_inscripcion.fechaFin', '<=', DB::raw("DATE_FORMAT((NOW() - INTERVAL 1 DAY), '%Y-%m-%d 23:59:59')"))
            ->get();

        $inscripcion_nuevas = DB::table('detalle_inscripcion')
            ->where('inscripcion.estado', 'ant')
            ->join('cliente', 'cliente.idCliente', 'detalle_inscripcion.idCliente')
            ->join('inscripcion', 'inscripcion.idInscripcion', 'detalle_inscripcion.idInscripcion')
            ->where('detalle_inscripcion.fechaFin', '>=', DB::raw("DATE_FORMAT((NOW()), '%Y-%m-%d 00:00:00')"))
            ->where('detalle_inscripcion.fechaFin', '<=', DB::raw("DATE_FORMAT((NOW()), '%Y-%m-%d 23:59:59')"))
            ->get();

        Log::info("inscripciones inscripcion_eliminar =>" . Utils::jsonLog($inscripcion_eliminar));
        Log::info("inscripciones inscripcion_nueva =>" . Utils::jsonLog($inscripcion_nuevas));

        $ejecutar_actualizacion = DB::select('CALL ACT_ESTADO_INSCRIPCIONES();');
        Log::info('sp ACT_ESTADO_INSCRIPCIONES=>' . $ejecutar_actualizacion[0]->mensaje);

        $socket = new Usuario();
        $socket->eliminacion_programada([
            'eliminar' => $inscripcion_eliminar,
            'anadir' => $inscripcion_nuevas,
        ]);

        //return Command::SUCCESS;

    }
}
