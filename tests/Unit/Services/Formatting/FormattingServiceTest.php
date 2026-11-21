<?php

namespace Tests\Unit\Services\Formatting;

use App\Services\Formatting\FormattingService;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\Unit\TestCase;

class FormattingServiceTest extends TestCase
{
    public function test_get_returns_the_unformatted_string(): void
    {
        $formatter = app(FormattingService::class, ['str' => 'Hello, world!']);

        $this->assertSame('Hello, world!', $formatter->get());
    }

    /**
     * @param  array<string,string>  $replacements
     */
    #[DataProvider('replacementCases')]
    public function test_apply_replacements(string $input, array $replacements, string $expected): void
    {
        $this->assertSame(
            $expected,
            app(FormattingService::class, [
                'str' => $input,
                'replacements' => $replacements,
            ])->applyReplacements()->get()
        );
    }

    /**
     * @return iterable<string, array{string, array<string,string>, string}>
     */
    public static function replacementCases(): iterable
    {
        yield 'case-insensitive keys' => [
            'Hello NAME, name!',
            ['name' => 'Ada'],
            'Hello Ada, Ada!',
        ];

        yield 'placeholder keys' => [
            '{{c:nickname}} loves {{c:name}}',
            ['{{c:nickname}}' => 'Pip', '{{c:name}}' => 'Egg'],
            'Pip loves Egg',
        ];

        yield 'asterisk wildcard' => [
            'Feed * to *',
            ['*' => 'Pip'],
            'Feed Pip to Pip',
        ];

        yield 'replacements are applied in order' => [
            'a b',
            ['a' => 'b', 'b' => 'c'],
            'c c',
        ];

        yield 'no replacements' => [
            'untouched',
            [],
            'untouched',
        ];
    }

    #[DataProvider('paragraphCases')]
    public function test_fix_paragraphs(string $input, string $expected): void
    {
        $this->assertSame(
            $expected,
            app(FormattingService::class, ['str' => $input])->fixParagraphs()->get()
        );
    }

    /**
     * @return iterable<string, array{string, string}>
     */
    public static function paragraphCases(): iterable
    {
        yield 'unix newlines' => ["one\ntwo", '<p>one</p><p>two</p>'];

        yield 'crlf, carriage returns and literal escapes' => [
            "  first  \r\n\r\n second\\n\\n third \r ",
            '<p>first</p><p>second</p><p>third</p>',
        ];

        yield 'blank and whitespace-only lines are removed' => ["\n  \n\n", ''];

        yield 'empty string' => ['', ''];

        yield 'leading and trailing whitespace is trimmed' => ['   hello   ', '<p>hello</p>'];

        yield 'internal whitespace is preserved' => ["a  b\n c\td ", "<p>a  b</p><p>c\td</p>"];
    }

    public function test_format_all_applies_replacements_before_paragraphs(): void
    {
        $formatter = app(FormattingService::class, [
            'str' => 'Hi {{name}}',
            'replacements' => ['{{name}}' => "Ada\nBob"],
        ]);

        $this->assertSame('<p>Hi Ada</p><p>Bob</p>', $formatter->formatAll()->get());
    }
}
