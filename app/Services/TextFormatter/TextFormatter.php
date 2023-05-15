<?php

namespace App\Services\TextFormatter;

use NumberFormatter;

class TextFormatter
{
    /**
     * Suffixes the number with an ordinal.
     * @param int $value
     * @return string|false
     */
    public static function ordinal(int $value)
    {
        $formatter = new NumberFormatter('en', NumberFormatter::ORDINAL);
        return $formatter->format($value);
    }
}
