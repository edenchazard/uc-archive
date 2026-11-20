<?php

namespace Tests\Feature;

use App\Models\ExplorationArea;
use App\Models\ExplorationStory;
use App\Models\UserPet;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Tests\TestCase;

class ExplorationStoryControllerTest extends TestCase
{
    public function test_show(): void
    {
        $story = ExplorationStory::query()
            ->with('explorationArea')
            ->orderBy('id')
            ->firstOrFail();

        $area = $story->explorationArea;

        $this->assertInstanceOf(ExplorationArea::class, $area);

        $expectedStory = ExplorationStory::query()
            ->with([
                'storyOptions' => fn (HasMany $q) => $q
                    ->with('creature.family')
                    ->orderBy('order'),
            ])
            ->findOrFail($story->getKey());

        $this->assertInstanceOf(ExplorationStory::class, $expectedStory);

        $expectedCreatures = $expectedStory->storyOptions
            ->map(fn ($storyOption) => UserPet::factory()
                ->mockCreature($storyOption->creature)
                ->make());

        $response = $this
            ->get(route('exploration.area.story.show', [$area, $story]))
            ->assertOk()
            ->assertViewIs('pages.exploration.stories.show')
            ->assertViewHas('explorationStory')
            ->assertViewHas('creatures');

        $viewStory = $this->viewDataAs($response, 'explorationStory', ExplorationStory::class);
        $creatures = $this->viewDataAs($response, 'creatures', Collection::class);

        $this->assertEquals($expectedStory->toArray(), $viewStory->toArray());
        $this->assertEquals(
            $expectedCreatures->toArray(),
            $creatures->toArray()
        );

        $this->assertBreadcrumbTrail($response, [
            ['Archive', route('home')],
            ['Exploration', route('exploration.index')],
            [$area->name, route('exploration.area.show', $area)],
            [$story->title, null],
        ]);
    }

    public function test_show_not_found(): void
    {
        $area = ExplorationArea::query()
            ->orderBy('id')
            ->first();

        $this->assertNotNull($area);

        $this
            ->get(route('exploration.area.story.show', [
                'explorationArea' => $area,
                'explorationStory' => 'thisshouldnotexist',
            ]))
            ->assertNotFound();
    }
}
