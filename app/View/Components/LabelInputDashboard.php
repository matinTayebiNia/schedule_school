<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class LabelInputDashboard extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public string $label = "", public string $for = "")
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.label-input-dashboard');
    }
}
