<?php

namespace App\View\Components\components;

use Illuminate\View\Component;

class modal extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $size;
    public $id;
    public $nameBtnSave;
    public $nameBtnClose;
    public $idBtnSave;
    public function __construct($size, $id, $nameBtnSave, $nameBtnClose, $idBtnSave)
    {
        $this->size = $size;
        $this->id = $id;
        $this->idBtnSave = $idBtnSave;
        $this->nameBtnSave = $nameBtnSave;
        $this->nameBtnClose = $nameBtnClose;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.components.modal');
    }
}
