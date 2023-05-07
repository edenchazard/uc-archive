<?php
namespace App\Services\Formatting;

abstract class FormattingServiceBase {
    public function __construct(protected string $str, protected array $replacements = []){
        return $this;
    }

    /**
     * Must provide a formatAll function that runs all of the formatting
     * features.
     */
    abstract public function formatAll(): FormattingServiceBase;

    public function get() {
        return $this->str;
    }

    public function applyReplacements(): FormattingServiceBase {
        $this->str = str_ireplace(
            array_map(fn(string $str) => "{{{$str}}}", array_keys($this->replacements)), 
            array_values($this->replacements), 
            $this->str
        );
        return $this;
    }

    /**
     * Unfortunately, when UC was designed, they didn't use proper paragraphs,
     * instead opting for classic br's. We'd ideally like to rewrite them
     * with paragraphs
     * To do this, we'll do a series of string transformations.
     */
    public function fixParagraphs(): FormattingServiceBase {
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
?>