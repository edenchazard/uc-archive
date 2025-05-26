<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Page extends Component
{
    /**
     * Create a new component instance.
     * @param array<string,mixed> $page
     */
    public function __construct(
        public array $page = []
    ) {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.page');
    }
}
