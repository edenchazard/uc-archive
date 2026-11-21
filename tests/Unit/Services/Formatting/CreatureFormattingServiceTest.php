<?php

namespace Tests\Unit\Services\Formatting;

use App\Enums\GenderEnum;
use App\Services\Formatting\CreatureFormattingService;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\Unit\UnitTestCase;

class CreatureFormattingServiceTest extends UnitTestCase
{
    #[DataProvider('pronounCases')]
    public function test_format_pronouns(GenderEnum $gender, string $input, string $expected): void
    {
        $this->assertSame(
            $expected,
            app(CreatureFormattingService::class, [
                'str' => $input,
                'gender' => $gender,
            ])->formatPronouns()->get()
        );
    }

    /**
     * @return iterable<string, array{GenderEnum, string, string}>
     */
    public static function pronounCases(): iterable
    {
        yield 'male keeps the source pronouns' => [
            GenderEnum::Male,
            '#he #his #him #himself #hisself',
            'he his him himself hisself',
        ];

        yield 'female converts all pronoun tags' => [
            GenderEnum::Female,
            '#he #his #him #himself #hisself',
            'she her her herself herself',
        ];

        yield 'dual uses the unknown placeholder' => [
            GenderEnum::Dual,
            '#he #his #him #himself #hisself',
            '? ? ? ? ?',
        ];

        yield 'tags are matched case-insensitively and keep first-letter casing' => [
            GenderEnum::Female,
            '#HE #His #hisself',
            'She Her herself',
        ];

        yield 'uppercase tags with male gender' => [
            GenderEnum::Male,
            '#HE #HiMsElF',
            'He Himself',
        ];

        yield 'tags inside a sentence' => [
            GenderEnum::Female,
            '#He said #his dog chased #himself.',
            'She said her dog chased herself.',
        ];

        yield 'adjacent tags' => [
            GenderEnum::Female,
            '#he#his',
            'sheher',
        ];

        yield 'non-pronoun hashes are left alone' => [
            GenderEnum::Female,
            'C# and #tags and #123',
            'C# and #tags and #123',
        ];

        yield 'text without tags' => [
            GenderEnum::Female,
            'Nothing to change.',
            'Nothing to change.',
        ];
    }

    public function test_format_all_applies_replacements_paragraphs_then_pronouns(): void
    {
        $formatter = app(CreatureFormattingService::class, [
            'str' => '{{c:name}} said #he would come\n#His #hisself too',
            'gender' => GenderEnum::Female,
            'replacements' => ['{{c:name}}' => 'Pip'],
        ]);

        $this->assertSame(
            '<p>Pip said she would come</p><p>Her herself too</p>',
            $formatter->formatAll()->get()
        );
    }

    public function test_pronoun_tags_added_by_replacements_are_formatted(): void
    {
        $formatter = app(CreatureFormattingService::class, [
            'str' => '{{c:nickname}} arrived',
            'gender' => GenderEnum::Female,
            'replacements' => ['{{c:nickname}}' => '#He'],
        ]);

        $this->assertSame('<p>She arrived</p>', $formatter->formatAll()->get());
    }

    public function test_newlines_in_replacement_values_are_turned_into_paragraphs(): void
    {
        $formatter = app(CreatureFormattingService::class, [
            'str' => '{{story}}',
            'gender' => GenderEnum::Male,
            'replacements' => ['{{story}}' => "#he\n#him"],
        ]);

        $this->assertSame('<p>he</p><p>him</p>', $formatter->formatAll()->get());
    }
}
