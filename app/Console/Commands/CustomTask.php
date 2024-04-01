<?php

namespace App\Console\Commands;

use DB;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Mail;

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
        Log::info("job recorido actualizado");

        $ejecutar_actualizacion = DB::select('CALL ACT_ESTADO_INSCRIPCIONES();');
        Log::info($ejecutar_actualizacion[0]->mensaje);

        Mail::send([], [], function ($message) {
            $message->to('stivenlovera@gmail.com');

            $message->cc('stivenlovera@gmail.com');
            $message->subject('prueba');
            /* $message->attachData($pdf->output(), "$goal->subempresa-VisitReport$goal->Codigo.pdf", [
            'mime' => 'application/pdf',
            ]); */
            //$message->setBody('test');
            $message->html('<h5> test</h5>');
        });
        //dd($ejecutar_actualizacion);
        if ($ejecutar_actualizacion) {
            Log::info("se actualizo las inscripciones correctamente ");
        } else {
            Log::info("ocurrio un error ");
        }
        //return Command::SUCCESS;
    }
}
