<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Form extends Component
{

    public $method;
    public $action;
    public $post;
    /**
     * Create a new component instance.
     */
    public function __construct($method, $action, $post = null)
    {
        $this->method = $method;
        $this->action = $action;
        $this->post = $post;
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form');
    }
}
