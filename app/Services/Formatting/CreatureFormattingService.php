<?php

namespace App\Services\Formatting;

use App\Enums\GenderEnum;

class CreatureFormattingService extends FormattingServiceBase
{
    public function __construct(
        protected string $str,
        protected GenderEnum $gender,
        protected array $replacements = [],
    ) {
        parent::__construct($str, $replacements);
        $this->register('formatPronouns');
    }

    /**
     * Searches for pronoun tags (e.g. #he, #herself) in the text and
     * replaces them with our chosen replacements.
     */
    public function formatPronouns(): self
    {
        // build our pronouns to search
        $malePronouns = GenderEnum::Male->pronounConversions();
        $femalePronouns = GenderEnum::Female->pronounConversions();

        // make matches for each possible pronoun
        $searches = implode('|', [...array_values($malePronouns), ...array_values($femalePronouns)]);

        // note we set this as case-insensitive, we'll determine caps when we
        // actually replace the match later.
        $regexp = "/#([{$searches}]+)/i";

        $this->str = (string) preg_replace_callback($regexp, function ($match) {
            $matchedPronoun = $match[1];
            // locate our replacement in the appropriate dictionary
            $replacement = $this->gender->pronounConversions()[strtolower($matchedPronoun)];
            // determine casing
            $casing = ctype_upper($matchedPronoun[0]) ? 'strtoupper' : 'strtolower';
            return $casing($replacement[0]) . substr($replacement, 1);
        }, $this->str);

        return $this;
    }
}
