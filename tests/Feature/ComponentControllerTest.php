<?php

namespace Tests\Feature;

use App\Enums\ConsumableTypeEnum;
use App\Models\Consumable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Tests\TestCase;

class ComponentControllerTest extends TestCase
{
    public function test_index(): void
    {
        $expected = Consumable::query()
            ->whereNot('type', ConsumableTypeEnum::Other)
            ->orderBy('name')
            ->get()
            ->groupBy('type');

        $response = $this
            ->get(route('components.index'))
            ->assertOk()
            ->assertViewIs('pages.components.index')
            ->assertViewHas('components');

        $components = $this->viewDataAs($response, 'components', Collection::class);

        $this->assertEquals(
            $expected,
            $components
        );

        $this->assertBreadcrumbTrail($response, [
            ['Archive', route('home')],
            ['Components', null],
        ]);
    }

    public function test_show(): void
    {
        $component = Consumable::query()
            ->orderBy('id')
            ->firstOrFail();

        $expected = Consumable::query()
            ->with([
                'creatures' => fn (HasMany $q) => $q
                    ->with('family')
                    ->orderBy('name'),
                'shopTransactionRequirements.shopTransaction' => fn (BelongsTo $q) => $q
                    ->with('shopCategory')
                    ->orderBy('title'),
                'shopTransactions.shopCategory' => fn (BelongsTo $q) => $q
                    ->orderBy('title'),
                'explorationAreas' => fn (BelongsToMany $q) => $q
                    ->orderBy('name'),
            ])
            ->findOrFail($component->getKey());

        $response = $this
            ->get(route('components.show', $component))
            ->assertOk()
            ->assertViewIs('pages.components.show')
            ->assertViewHas('consumable');

        $viewComponent = $this->viewDataAs($response, 'consumable', Consumable::class);

        $this->assertEquals(
            $expected,
            $viewComponent
        );

        $this->assertBreadcrumbTrail($response, [
            ['Archive', route('home')],
            ['Components', route('components.index')],
            [$component->name, null],
        ]);
    }

    public function test_show_returns_not_found_for_an_unknown_component(): void
    {
        $this
            ->get(route('components.show', [
                'consumable' => 'thisshouldnotexist',
            ]))
            ->assertNotFound();
    }
}
