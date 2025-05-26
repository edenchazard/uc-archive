<?php

namespace App\Enums;

use Str;

enum GenderEnum: int
{
    case Male = 0;
    case Female = 1;
    case Dual = 2;

    public function friendlyName(): string
    {
        return Str::of($this->name)
            ->replace('_', ' ')
            ->title()
            ->toString();
    }

    /**
     * @return array<string,string>
     */
    public function pronounConversions(): array
    {
        return match ($this) {
            self::Male => [
                'he' => 'he',
                'his' => 'his',
                'him' => 'him',
                'himself' => 'himself',
                'hisself' => 'hisself',
            ],
            self::Female => [
                'he' => 'she',
                'his' => 'her',
                'him' => 'her',
                'himself' => 'herself',
                'hisself' => 'herself',
            ],
            self::Dual => [
                'he' => '?',
                'his' => '?',
                'him' => '?',
                'himself' => '?',
                'hisself' => '?',
            ],
        };
    }

    public static function pronouns(): array
    {
        return array_keys(self::Male->pronounConversions());
    }
}
