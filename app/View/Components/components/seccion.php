<?php

namespace App\View\Components\components;

use Illuminate\View\Component;

class seccion extends Component
{
    public $nameSeccion;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($nameSeccion)
    {
        $this->nameSeccion = $nameSeccion;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.components.seccion');
    }
}
