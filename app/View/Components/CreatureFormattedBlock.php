<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Services\Formatting\CreatureFormattingService;
use App\Services\Creatures\CreatureUtils;


class CreatureFormattedBlock extends Component
{
    public string $text = '';

    /**
     * Create a new component instance.
     */
    public function __construct(string $text, $creature, array $additional = [])
    {
        $replacements = [
            '{{c:nickname}}' => $creature->name,
            '{{c:name}}' => $creature->name,
            '{{c:family}}' => $creature->family->name,
            ...$additional
        ];

        $this->text = (new CreatureFormattingService(
            $text,
            $replacements,
            // If the creature has a set gender, use that. Otherwise, if
            // not male or female, let's have a bit of fun and randomise the gender.
            $creature->gender
        ))->formatAll()->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {

        return view('components.creature-formatted-block');
    }
}
