<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class StudentLayout extends Component
{

    public function render(): View
    {
        return view('student.layouts.student-layout');
    }
}
