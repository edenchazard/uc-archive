<?php

namespace App\Services\Formatting;

use App\Services\Formatting\FormattingServiceBase;
use App\Services\Creatures\CreatureGender;

class CreatureFormattingService extends FormattingServiceBase
{
    protected array $pronouns = [];

    /**
     * @param int|null $gender
     * (Optional) Gender to get pronoun conversions from.
     * If unspecified, a random gender will be chosen.
     */
    public function __construct(protected string $str, protected array $replacements = [], $gender = null)
    {
        if ($gender === null)
            $gender = CreatureGender::random();

        $this->pronouns = $gender->pronounConversions();
        parent::__construct($str, $replacements);
        $this->register('formatPronouns');
    }

    /**
     * Searches for pronoun tags (e.g. #he, #herself) in the text and
     * replaces them with our chosen replacements.
     * @return $this
     */
    public function formatPronouns(): CreatureFormattingService
    {
        // build our pronouns to search
        $malePronouns = CreatureGender::get(0)::pronounConversions();
        $femalePronouns = CreatureGender::get(1)::pronounConversions();

        // make matches for each possible pronoun
        $searches = implode('|', [...array_values($malePronouns), ...array_values($femalePronouns)]);

        // note we set this as case-insensitive, we'll determine caps when we
        // actually replace the match later.
        $regexp = "/#([$searches]+)/i";

        $this->str = preg_replace_callback($regexp, function ($match) {
            $matchedPronoun = $match[1];
            // locate our replacement in the appropriate dictionary
            $replacement = $this->pronouns[strtolower($matchedPronoun)];
            // determine casing
            $casing = ctype_upper($matchedPronoun[0]) ? 'strtoupper' : 'strtolower';
            return $casing($replacement[0]) . substr($replacement, 1);
        }, $this->str);

        return $this;
    }
}
