<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ContentSection extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $title,
        public string|null $anchor = null,
        public bool $hideAnchor = false,
        public int $level = 2
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.content-section');
    }
}
