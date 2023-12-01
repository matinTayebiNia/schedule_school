<?php

namespace App\Livewire\Admin\Manger;

use App\Models\Manger;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\View\View;
use Livewire\Component;

class EditManger extends Component
{
    /**
     * @throws AuthorizationException
     */
    public function mount()
    {
        $this->authorize('edit-manger');
    }

    public function render(): View
    {
        $title = "ویرایش مدیر";
        return view('admin.manger.edit', compact("title"))
            ->layout("admin.layouts.admin-layout");
    }

    /**
     * @throws AuthorizationException
     */
    public function update(Manger $manger)
    {
        $this->authorize('edit-manger');



    }
}
