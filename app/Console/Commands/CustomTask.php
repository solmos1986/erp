<?php

namespace App\Console\Commands;

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
        Log::info("job recorido actualizado");
        $insert = DB::table('usuario')->insert([
            'fotoUsuario' => 'auto',
            'nomUsuario' => 'auto',
            'docUsuario' => 'auto',
            'telUsuario' => '0',
            'dirUsuario' => 'auto',
            'mailUsuario' => 'auto',
            'condicionUsuario' => '0',
        ]);
        $ejecutar_actualizacion = DB::select('call ACT_ESTADO_INSCRIPCIONES');
        if ($ejecutar_actualizacion) {
            Log::info("se actualizo las inscripciones correctamente");
        } else {
            Log::info("ocurrio un error ");
        }
        //return Command::SUCCESS;
    }
}
