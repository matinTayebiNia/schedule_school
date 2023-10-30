<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ButtonPrimaryDashboard extends Component
{
    public string $targetLoading = "";
    public string $textButton;
    public string $icon = "";

    /**
     * Create a new component instance.
     */
    public function __construct(string $textButton = "", string $targetLoading = "", string $icon = "")
    {
        $this->icon = $icon;
        $this->textButton = $textButton;
        $this->targetLoading = $targetLoading;
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.button-primary-dashboard');
    }
}
