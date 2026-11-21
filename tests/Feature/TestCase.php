<?php

namespace Tests\Feature;

use DOMDocument;
use DOMElement;
use DOMXPath;
use Illuminate\Foundation\Testing\Attributes\Seed;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Testing\TestResponse;
use RuntimeException;
use Symfony\Component\HttpFoundation\Response;
use Tests\Concerns\Traits\CreatesApplication;

#[Seed]
abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use RefreshDatabase;

    /**
     * Fetch a view binding with a statically known type.
     *
     * @template T of object
     *
     * @param  TestResponse<Response>  $response
     * @param  class-string<T>  $type
     * @return T
     */
    protected function viewDataAs(TestResponse $response, string $key, string $type): mixed
    {
        $value = $response->viewData($key);
        $this->assertInstanceOf($type, $value);

        return $value;
    }

    /**
     * Assert the rendered breadcrumb trail, in order.
     *
     * Each expected item is a [title, url] pair; the final (active) crumb has
     * no link and is therefore expected with a null url.
     *
     * @param  TestResponse<Response>  $response
     * @param  array<int,array{0:string,1:string|null}>  $expected
     */
    protected function assertBreadcrumbTrail(TestResponse $response, array $expected): void
    {
        $content = $response->getContent();

        if (! is_string($content)) {
            throw new RuntimeException('Unable to read the response content.');
        }

        $document = new DOMDocument;
        $previous = libxml_use_internal_errors(true);
        $document->loadHTML($content);
        libxml_clear_errors();
        libxml_use_internal_errors($previous);

        $xpath = new DOMXPath($document);
        $nodes = $xpath->query("//nav[@aria-label='breadcrumb']//li[contains(concat(' ', normalize-space(@class), ' '), ' breadcrumb-item ')]");

        if ($nodes === false) {
            throw new RuntimeException('Unable to parse the breadcrumb markup.');
        }

        $this->assertSame(count($expected), $nodes->length, 'Unexpected number of breadcrumbs.');

        $actual = [];

        foreach ($nodes as $node) {
            if (! $node instanceof DOMElement) {
                continue;
            }

            $links = $xpath->query('./a', $node);
            $link = $links === false ? null : $links->item(0);

            $actual[] = [
                trim($node->textContent),
                $link instanceof DOMElement ? $link->getAttribute('href') : null,
            ];
        }

        $this->assertSame($expected, $actual);
    }
}
