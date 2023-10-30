<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InputTextDashboard extends Component
{
    /**
     * Create a new component instance.
     * @param string $name
     * @param string $class
     * @param string $placeholder
     * @param string $livewireModel
     */
    public function __construct(public string $name, public string $class = "",
                                public string $placeholder = "", public string $livewireModel = "")
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input-dashboard');
    }
}
