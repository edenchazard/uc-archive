<?php

namespace App\View\Components;

use App\Models\UserPet;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Services\Formatting\CreatureFormattingService;


class CreatureFormattedBlock extends Component
{
    public string $text = '';

    /**
     * Create a new component instance.
     */
    public function __construct(string $text, UserPet $pet, array $additional = [])
    {
        $replacements = [
            '{{c:nickname}}' => $pet->nickname,
            '{{c:name}}' => $pet->name,
            '{{c:family}}' => $pet->creature->family->name,
            ...$additional
        ];

        $this->text = (new CreatureFormattingService(
            $text,
            $replacements,
            // If the creature has a set gender, use that. Otherwise, if
            // not male or female, let's have a bit of fun and randomise the gender.
            $pet->gender
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
