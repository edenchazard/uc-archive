<?php
namespace App\Services\Formatting;
use App\Services\Formatting\FormattingServiceBase;
use App\Services\Creatures\CreatureGender;

class CreatureFormattingService extends FormattingServiceBase {
    protected array $pronouns = [];

    public function __construct(protected string $str, protected array $replacements = [], int $gender = 0){
        $this->pronouns = CreatureGender::get($gender)::pronounConversions();
        parent::__construct($str, $replacements);
    }

    public function formatPronouns(): CreatureFormattingService {
        $pronouns = CreatureGender::pronouns();

        // generate a similar array but with the first letter caps'd to catch those!
        $replacements = array_merge($pronouns, array_map('ucfirst', $pronouns));
    
        // everything we want to replace is prefixed with a #, so we add that in.
        $searches = array_map(fn(string $str) => "#{$str}", $replacements);

        $this->str = str_replace($searches, $replacements, $this->str);
        return $this;
    }

    public function formatAll(): CreatureFormattingService {
        $transformations = ['applyReplacements', 'formatPronouns', 'fixParagraphs'];
    
        foreach($transformations as $transform){
            $this->$transform();
        }

        return $this;
    }

    public function formatImageLink(){}
}
?>