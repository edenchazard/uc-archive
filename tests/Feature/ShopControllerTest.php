<?php

namespace Tests\Feature;

use App\Models\Creature;
use App\Models\ShopCategory;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Collection;
use Tests\TestCase;

class ShopControllerTest extends TestCase
{
    public function test_index(): void
    {
        $response = $this
            ->get(route('shop.index'))
            ->assertOk()
            ->assertViewIs('pages.shop.index')
            ->assertViewHas('categories');

        $categories = $this->viewDataAs($response, 'categories', Collection::class);

        $this->assertEquals(
            ShopCategory::query()
                ->get(),
            $categories
        );

        $this->assertBreadcrumbTrail($response, [
            ['Archive', route('home')],
            ['Shop', null],
        ]);
    }

    public function test_show(): void
    {
        $category = ShopCategory::query()
            ->orderBy('id')
            ->firstOrFail();

        $expected = ShopCategory::query()
            ->with([
                'transactions.rewardable' => fn (MorphTo $morphTo) => $morphTo
                    ->morphWith([
                        Creature::class => ['family'],
                    ]),
                'transactions.requirements.requireable' => fn (MorphTo $q) => $q
                    ->orderBy('type')
                    ->orderBy('name'),
            ])
            ->findOrFail($category->getKey());

        $response = $this
            ->get(route('shop.category.show', $category))
            ->assertOk()
            ->assertViewIs('pages.shop.categories.show')
            ->assertViewHas('shopCategory');

        $viewCategory = $this->viewDataAs($response, 'shopCategory', ShopCategory::class);

        $this->assertEquals(
            $expected,
            $viewCategory
        );

        $this->assertBreadcrumbTrail($response, [
            ['Archive', route('home')],
            ['Shop', route('shop.index')],
            [$category->title, null],
        ]);
    }

    public function test_show_not_found(): void
    {
        $this
            ->get(route('shop.category.show', [
                'shopCategory' => 'thisshouldnotexist',
            ]))
            ->assertNotFound();
    }
}
