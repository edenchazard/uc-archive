<?php

namespace App\Services\Formatting;

use Exception;

abstract class FormattingServiceBase
{
    /** @var $transformations
     * an array of class methods or callables to apply. */
    protected array $transformations = [];

    /**
     * @param string $str The text to format.
     * @param array<string, string> $replacements Optional key and value replacements.
     */
    public function __construct(protected string $str, protected array $replacements = [])
    {
        $this->register(['applyReplacements', 'fixParagraphs']);
    }

    /**
     * Register a class method as new transformation.
     * @param string|string[]|callable $transformation
     * @return $this
     */
    public final function register(string|array|callable $transformations)
    {
        $transformations = is_array($transformations) ? $transformations : [$transformations];

        foreach ($transformations as $transform) {
            if (!method_exists(static::class, $transform) && !is_callable($transform))
                throw new Exception("Transformation wasn't found on class and isn't a callable.");

            $this->transformations[] = $transform;
        }

        return $this;
    }

    /**
     * Applies all of the transformations in array $transformations order.
     * @return $this
     */
    public final function formatAll(): FormattingServiceBase
    {
        foreach ($this->transformations as $transform) $this->$transform();
        return $this;
    }

    /**
     * Returns the text being formatted.
     * @return string
     */
    public final function get()
    {
        return $this->str;
    }

    /**
     * Applies a case-insensitive search and replace on the text.
     * @return $this
     */
    public function applyReplacements(): FormattingServiceBase
    {
        $this->str = str_ireplace(
            array_keys($this->replacements),
            array_values($this->replacements),
            $this->str
        );
        return $this;
    }

    /**
     * Converts new lines to <p> tags.
     * Unfortunately, when UC was designed, they didn't use proper paragraphs,
     * instead opting for classic newlines with nl2br applied.
     * We'd ideally like to rewrite them with paragraphs.
     * @return $this
     */
    public function fixParagraphs(): FormattingServiceBase
    {
        $copy = trim($this->str);

        // replace consecutive markers
        $copy = str_replace('\r', '\n', $copy);
        $copy = str_replace(str_repeat('\n', 2), '</p><p>', $copy);
        // remove empty p tags
        $copy = str_replace('<p></p>', '', '<p>' . $copy . '</p>');

        $this->str = $copy;
        return $this;
    }
}
