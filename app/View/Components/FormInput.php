<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FormInput extends Component
{
    public $name;
    public $label;
    public $type;
    public $value;
    public $required;
    public $disabled;
    public $readonly;
    public $autocomplete;

    public function __construct($name, $label, $type = 'text', $value = '', $required = false, $disabled = false,$readonly=false,$autocomplete=false)
    {
        $this->name = $name;
        $this->label = $label;
        $this->type = $type;
        $this->value = $value;
        $this->required = $required;
        $this->disabled = $disabled;
        $this->readonly = $readonly;
        $this->autocomplete = $autocomplete;
    }

    public function render()
    {
        return view('components.form-input');
    }
}
