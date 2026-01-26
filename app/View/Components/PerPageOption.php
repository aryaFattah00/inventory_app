<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PerPageOption extends Component
{
    public $perPageOptions;

    public function __construct()
    {
        $this->perPageOptions =[10, 25, 50, 100];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.per-page-option');
    }
}
