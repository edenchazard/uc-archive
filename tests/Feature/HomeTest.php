<?php

namespace Tests\Feature;

class HomeTest extends TestCase
{
    public function test_home(): void
    {
        $response = $this
            ->get('/')
            ->assertOk()
            ->assertViewIs('pages.index');

        $this->assertBreadcrumbTrail($response, [
            ['Archive', null],
        ]);
    }
}
