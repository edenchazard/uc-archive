<?php

namespace Tests\Feature;

use App\Models\Item;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Collection;
use Tests\TestCase;

class ItemControllerTest extends TestCase
{
    public function test_index(): void
    {
        $response = $this
            ->get(route('items.index'))
            ->assertOk()
            ->assertViewIs('pages.items.index')
            ->assertViewHas('items');

        $items = $this->viewDataAs($response, 'items', Collection::class);

        $this->assertEquals(
            expected: Item::query()
                ->orderBy('name')
                ->get(),
            actual: $items
        );

        $this->assertBreadcrumbTrail($response, [
            ['Archive', route('home')],
            ['Items', null],
        ]);
    }

    public function test_show(): void
    {
        $item = Item::query()
            ->orderBy('id')
            ->firstOrFail();

        $expected = Item::query()
            ->with([
                'shopTransactionRequirements.shopTransaction' => fn (BelongsTo $q) => $q
                    ->with('shopCategory')
                    ->orderBy('title'),
                'shopTransactions.shopCategory' => fn (BelongsTo $q) => $q
                    ->orderBy('title'),
            ])
            ->findOrFail($item->getKey());

        $response = $this
            ->get(route('items.show', $item))
            ->assertOk()
            ->assertViewIs('pages.items.show')
            ->assertViewHas('item');

        $viewItem = $this->viewDataAs($response, 'item', Item::class);

        $this->assertEquals(
            expected: $expected,
            actual: $viewItem
        );

        $this->assertBreadcrumbTrail($response, [
            ['Archive', route('home')],
            ['Items', route('items.index')],
            [$item->name, null],
        ]);
    }

    public function test_show_not_found(): void
    {
        $this
            ->get(route('items.show', [
                'item' => 'thisshouldnotexist',
            ]))
            ->assertNotFound();
    }
}
