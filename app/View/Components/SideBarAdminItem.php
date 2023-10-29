<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SideBarAdminItem extends Component
{

    public string $route = "";
    public string $icon = "";
    public string $itemName = "";
    public string|null $isActive = null;

    /**
     * Create a new component instance.
     * @param string $icon
     * @param string $route
     * @param string $itemName
     * @param string|null $isActive
     */
    public function __construct(string $icon, string $route, string $itemName,string|null$isActive)
    {
        $this->isActive = $isActive;
        $this->icon = $icon;
        $this->route = $route;
        $this->itemName = $itemName;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('admin.layouts.side-bar-admin-item');
    }
}
