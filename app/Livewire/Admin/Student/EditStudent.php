<?php

namespace App\Livewire\Admin\Student;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class EditStudent extends Component
{
    public function render(): View
    {
        $title = "ویرایش دانش آموز";
        return view('admin.student.edit', compact('title'))
            ->layout("admin.layouts.admin-layout");
    }
}
