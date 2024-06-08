<?php

namespace App\View\Components\components;

use Illuminate\View\Component;

class migaPan extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $rutas;
    public $rutaActual;
    public function __construct($rutas, $rutaActual)
    {
        $this->rutas = $rutas;
        $this->rutaActual = $rutaActual;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.components.miga-pan');
    }
}
