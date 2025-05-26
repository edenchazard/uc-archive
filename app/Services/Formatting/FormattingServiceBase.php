<?php

namespace App\Services\Formatting;

use Exception;

abstract class FormattingServiceBase
{
    /**
     * an array of class methods or callables to apply.
     *
     * @var array<int,string|callable>
     */
    protected array $transformations = [];

    /**
     * @param string $str The text to format.
     * @param array<string, string> $replacements Optional key and value replacements.
     */
    public function __construct(
        protected string $str,
        protected array $replacements = []
    ) {
        $this->register(['applyReplacements', 'fixParagraphs']);
    }

    /**
     * Register a class method as new transformation.
     * @param string|array<int,string>|callable $transformations A class method name, array of class method names, or a callable.
     * @return $this
     */
    final public function register(string|array|callable $transformations): self
    {
        $transformations = is_array($transformations) ? $transformations : [$transformations];

        foreach ($transformations as $transform) {
            assert(is_string($transform), 'Transformation must be a string or callable.');

            if (! method_exists(static::class, $transform) && ! is_callable($transform)) {
                throw new Exception("Transformation wasn't found on class and isn't a callable.");
            }

            $this->transformations[] = $transform;
        }

        return $this;
    }

    /**
     * Applies all of the transformations in array $transformations order.
     * @return $this
     */
    final public function formatAll(): self
    {
        foreach ($this->transformations as $transform) {
            $this->{$transform}();
        }
        return $this;
    }

    /**
     * Returns the text being formatted.
     * @return string
     */
    final public function get()
    {
        return $this->str;
    }

    /**
     * Applies a case-insensitive search and replace on the text.
     * @return $this
     */
    public function applyReplacements(): self
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
    public function fixParagraphs(): self
    {
        $copy = $this->str;

        // normalise carriage returns and bad newlines (literal \n and \r) with new lines
        $copy = str_replace(['\r', '\n', "\r"], "\n", $copy);
        // strip leading and trailing whitespaces
        $paragraphs = array_map('trim', explode("\n", $copy));
        // remove empty paragraphs
        $paragraphs = array_filter($paragraphs, fn ($p) => $p !== '');
        // surround with p tags
        $paragraphs = array_map(fn ($p) => "<p>{$p}</p>", $paragraphs);

        $this->str = implode($paragraphs);
        return $this;
    }
}
