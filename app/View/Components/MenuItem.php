<?php

namespace App\View\Components;

use Illuminate\View\Component;

class MenuItem extends Component
{
    public $link;
    public $icon;
    public $title;
    public $items;
    public $id;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($icon, $title, $link = null, $items = [], $id = null)
    {
        $this->link = $link;
        $this->icon = $icon;
        $this->title = $title;
        $this->items = $items;
        $this->id = uniqid().rand(1,100);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.menu-item');
    }
}
