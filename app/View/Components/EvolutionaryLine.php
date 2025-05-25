<?php

namespace App\View\Components;

use App\Models\UserPet;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class EvolutionaryLine extends Component
{
    /**
     * Create a new component instance.
     * @param Collection<int,UserPet> $stages
     */
    public function __construct(public Collection $stages)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.evolutionary-line');
    }
}
