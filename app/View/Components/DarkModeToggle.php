<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class DarkModeToggle extends Component
{
    public function render(): View
    {
        return view('components.dark-mode-toggle');
    }
}
