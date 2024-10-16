<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SubmitButton extends Component
{
    public $buttonText;
    public $buttonId;

    /**
     * Create a new component instance.
     */
    public function __construct($buttonText = 'Submit', $buttonId )
    {
        $this->buttonText = $buttonText;
        $this->buttonId = $buttonId ?? 'submit-button';
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.submit-button');
    }
}
