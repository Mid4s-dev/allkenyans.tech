<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class Header extends Component
{
    public function render(): View
    {
        return view('components.header');
    }
}
