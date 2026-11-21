<?php

namespace Tests\Unit\Services\Formatting;

use App\Services\Formatting\FormattingService;

class MarkerFormattingService extends FormattingService
{
    /**
     * @param  array<string,string>  $replacements
     */
    public function __construct(string $str, array $replacements = [])
    {
        parent::__construct($str, $replacements);

        $this->register('appendMarker');
    }

    public function appendMarker(): self
    {
        $this->str .= '!';

        return $this;
    }
}
