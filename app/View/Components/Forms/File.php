<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class File extends Component
{
    public $name,$accept,$required;
    public function __construct($name = 'file',$accept,$required)
    {
        $this->name   = $name;
        $this->accept = $accept;
        $this->required = $required;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.file',array('name'=>$this->name,'accept'=>$this->accept,'required'=>$this->required));
    }
}
