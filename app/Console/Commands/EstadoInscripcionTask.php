<?php

namespace App\Console\Commands;

use App\Http\Controllers\Utils;
use App\SocketCliente\Usuario;
use DB;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Mail;

class EstadoInscripcionTask extends Command
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
        Log::info("EstadoInscripcionTask() ejecucion => " . date('Y-m-d H:i:s'));

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
            ->where('detalle_inscripcion.fechaInicio', '>=', DB::raw("DATE_FORMAT((NOW()), '%Y-%m-%d 00:00:00')"))
            ->where('detalle_inscripcion.fechaInicio', '<=', DB::raw("DATE_FORMAT((NOW()), '%Y-%m-%d 23:59:59')"))
            ->get();

        Log::info("EstadoInscripcionTask() inscripciones inscripcion_eliminar =>" . Utils::jsonLog($inscripcion_eliminar));
        Log::info("EstadoInscripcionTask() inscripciones inscripcion_nueva =>" . Utils::jsonLog($inscripcion_nuevas));

        $ejecutar_actualizacion = DB::select('CALL ACT_ESTADO_INSCRIPCIONES();');
        Log::info('EstadoInscripcionTask() SP ACT_ESTADO_INSCRIPCIONES => ' . $ejecutar_actualizacion[0]->mensaje);

        $socket = new Usuario();
        $socket->eliminacion_programada([
            'eliminar' => $inscripcion_eliminar,
            'anadir' => $inscripcion_nuevas,
        ]);

        $contactos = DB::table('contacto_interno')->select('contacto_interno.email')->pluck('email')->toArray();
        Log::info('EstadoInscripcionTask() email contactos => ' . Utils::jsonLog($contactos));

        try {
            Mail::send([], [], function ($message) use ($inscripcion_eliminar, $inscripcion_nuevas, $contactos) {
                $message->to($contactos);
                $message->cc($contactos);
                $message->subject('Proceso automatico - estados de inscripciones');
                //$message->attachData($pdf->output(), "$goal->subempresa-VisitReport$goal->Codigo.pdf", [
                //    'mime' => 'application/pdf',
                //]);
                //$message->setBody('test');
                $user = '';
                $html = view('mail.notificacion', compact('inscripcion_nuevas', 'inscripcion_eliminar'))->render();
                $message->html($html);
                Log::info('EstadoInscripcionTask() email enviado correctamente');
            });
        } catch (\Throwable $th) {
            Log::critical('EstadoInscripcionTask() ocurrio un error ' . $th->getMessage());
        }
    }
}
