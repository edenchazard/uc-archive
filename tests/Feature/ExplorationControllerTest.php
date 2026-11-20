<?php

namespace Tests\Feature;

use App\Enums\ConsumableTypeEnum;
use App\Models\ExplorationArea;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Tests\TestCase;

class ExplorationControllerTest extends TestCase
{
    public function test_index_orders_areas_by_name(): void
    {
        $expected = ExplorationArea::query()
            ->orderBy('name')
            ->get();

        $response = $this
            ->get(route('exploration.index'))
            ->assertOk()
            ->assertViewIs('pages.exploration.index')
            ->assertViewHas('explorationAreas');

        $areas = $this->viewDataAs($response, 'explorationAreas', Collection::class);

        $this->assertEquals(
            $expected,
            $areas
        );

        $this->assertBreadcrumbTrail($response, [
            ['Archive', route('home')],
            ['Exploration', null],
        ]);
    }

    public function test_show(): void
    {
        $area = ExplorationArea::query()
            ->orderBy('id')
            ->firstOrFail();

        $expected = ExplorationArea::query()
            ->with([
                'consumables' => fn (BelongsToMany $q) => $q
                    ->orderByRaw("type = '".ConsumableTypeEnum::Tree->value."' DESC")
                    ->orderBy('name'),
                'explorationStories' => fn (HasMany $q) => $q
                    ->with('explorationArea')
                    ->orderBy('title'),
            ])
            ->findOrFail($area->getKey());

        $response = $this
            ->get(route('exploration.area.show', $area))
            ->assertOk()
            ->assertViewIs('pages.exploration.show')
            ->assertViewHas('explorationArea');

        $viewArea = $this->viewDataAs($response, 'explorationArea', ExplorationArea::class);

        $this->assertEquals(
            $expected->toArray(),
            $viewArea->toArray()
        );

        $this->assertBreadcrumbTrail($response, [
            ['Archive', route('home')],
            ['Exploration', route('exploration.index')],
            [$area->name, null],
        ]);
    }

    public function test_show_not_found(): void
    {
        $this
            ->get(route('exploration.area.show', [
                'explorationArea' => 'thisshouldnotexist',
            ]))
            ->assertNotFound();
    }
}
