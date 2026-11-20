<?php

namespace Tests\Feature;

use App\Enums\SpecialtyEnum;
use App\Models\Creature;
use App\Models\Family;
use App\Models\UserPet;
use Illuminate\Support\Collection;
use Tests\TestCase;

class FamilyControllerTest extends TestCase
{
    public function test_index(): void
    {
        $expectedGroups = Creature::query()
            ->with('family')
            ->orderBy('stage')
            ->get()
            ->map(fn (Creature $creature) => UserPet::factory()
                ->mockCreature($creature)
                ->make())
            ->groupBy('creature.family.name')
            ->map(fn (Collection $creatures) => [
                'family' => $creatures->first()?->creature->family,
                'stages' => $creatures,
            ])
            ->sortBy('family.name')
            ->groupBy(fn (array $family) => $family['family']?->name[0] ?? '');

        $response = $this
            ->get(route('creatures.index'))
            ->assertOk()
            ->assertViewIs('pages.creatures.index')
            ->assertViewHas('groups');

        $groups = $this->viewDataAs($response, 'groups', Collection::class);

        $this->assertEquals(
            $expectedGroups,
            $groups
        );

        $this->assertBreadcrumbTrail($response, [
            ['Archive', route('home')],
            ['All families', null],
        ]);
    }

    public function test_show(): void
    {
        $family = Family::query()
            ->where('deny_exalt', false)
            ->whereHas('stages')
            ->orderBy('name')
            ->firstOrFail();

        $expectedFamily = Family::query()
            ->with('stages')
            ->findOrFail($family->getKey());

        $this->assertInstanceOf(Family::class, $expectedFamily);

        $expectedStages = $expectedFamily
            ->stages
            ->map(fn (Creature $stage) => UserPet::factory()
                ->mockCreature($stage)
                ->make());

        $expectedAlts = collect([SpecialtyEnum::Noble, SpecialtyEnum::Exalted])
            ->map(fn (SpecialtyEnum $specialty) => $expectedFamily
                ->stages
                ->map(fn (Creature $stage) => UserPet::factory()
                    ->mockCreature($stage)
                    ->make([
                        'specialty' => $specialty,
                    ])));

        $response = $this
            ->get(route('creatures.family.show', $family))
            ->assertOk()
            ->assertViewIs('pages.creatures.family.show')
            ->assertViewHas('family')
            ->assertViewHas('stages')
            ->assertViewHas('alts');

        $viewFamily = $this->viewDataAs($response, 'family', Family::class);
        $stages = $this->viewDataAs($response, 'stages', Collection::class);
        $alts = $this->viewDataAs($response, 'alts', Collection::class);

        $this->assertEquals($expectedFamily->toArray(), $viewFamily->toArray());
        $this->assertEquals($expectedStages->toArray(), $stages->toArray());
        $this->assertEquals($expectedAlts->toArray(), $alts->toArray());

        $this->assertBreadcrumbTrail($response, [
            ['Archive', route('home')],
            ['All families', route('creatures.index')],
            [$family->name, null],
        ]);
    }

    public function test_show_does_not_build_exalt_variations_when_the_family_denies_them(): void
    {
        $family = Family::query()
            ->where('deny_exalt', true)
            ->whereHas('stages')
            ->orderBy('name')
            ->firstOrFail();

        $expectedFamily = Family::query()
            ->with('stages')
            ->findOrFail($family->getKey());

        $this->assertInstanceOf(Family::class, $expectedFamily);

        $expectedStages = $expectedFamily
            ->stages
            ->map(fn (Creature $stage) => UserPet::factory()
                ->mockCreature($stage)
                ->make());

        $response = $this
            ->get(route('creatures.family.show', $family))
            ->assertOk()
            ->assertViewIs('pages.creatures.family.show')
            ->assertViewHas('family')
            ->assertViewHas('stages')
            ->assertViewHas('alts');

        $viewFamily = $this->viewDataAs($response, 'family', Family::class);
        $stages = $this->viewDataAs($response, 'stages', Collection::class);
        $alts = $this->viewDataAs($response, 'alts', Collection::class);

        $this->assertEquals($expectedFamily->toArray(), $viewFamily->toArray());
        $this->assertEquals($expectedStages->toArray(), $stages->toArray());
        $this->assertEquals(collect(), $alts);

        $this->assertBreadcrumbTrail($response, [
            ['Archive', route('home')],
            ['All families', route('creatures.index')],
            [$family->name, null],
        ]);
    }

    public function test_show_redirects_missing_to_search(): void
    {
        $this
            ->get(route('creatures.family.show', [
                'family' => 'thisshouldnotexist'
            ]))
            ->assertRedirect(route('creatures.search', [
                'query' => 'thisshouldnotexist'
            ]));

        $this
            ->followingRedirects()
            ->get(route('creatures.family.show', [
                'family' => 'thisshouldnotexist'
            ]))
            ->assertNotFound()
            ->assertSeeText('no creature results were found.');
    }

    public function test_search_without_a_query_not_found(): void
    {
        $response = $this
            ->get(route('creatures.search'))
            ->assertNotFound()
            ->assertViewIs('pages.creatures.search')
            ->assertViewHas('query', null)
            ->assertViewHas('results');

        $results = $this->viewDataAs($response, 'results', Collection::class);
        $this->assertEquals(collect(), $results);

        $this->assertBreadcrumbTrail($response, [
            ['Archive', route('home')],
            ['All families', route('creatures.index')],
            ['Search', null],
        ]);
    }

    public function test_search_redirects_directly_when_exactly_one_creature_matches(): void
    {
        $name = Creature::query()
            ->select('name')
            ->groupBy('name')
            ->havingRaw('COUNT(*) = 1')
            ->orderBy('name')
            ->pluck('name')
            ->first(fn (mixed $name) => is_string($name) && preg_match('/^[A-Za-z]+$/', $name) === 1);

        $this->assertNotNull($name);

        $creature = Creature::query()
            ->where('name', $name)
            ->with('family')
            ->first();

        $this->assertNotNull($creature);

        $this
            ->get(route('creatures.search', [
                'query' => $name
            ]))
            ->assertRedirect(route('creatures.family.creature.show', [
                $creature->family,
                $creature,
            ]));
    }

    public function test_search_returns_the_results_view_data_for_multiple_matches(): void
    {
        $name = Creature::query()
            ->select('name')
            ->groupBy('name')
            ->havingRaw('COUNT(*) > 1')
            ->orderBy('name')
            ->pluck('name')
            ->first(fn (mixed $name) => is_string($name) && preg_match('/^[A-Za-z]+$/', $name) === 1);

        $this->assertNotNull($name);

        $expectedResults = Creature::query()
            ->where('name', $name)
            ->with('family')
            ->withAggregate('family AS family_name', 'name')
            ->orderBy('family_name')
            ->get()
            ->map(fn (Creature $creature) => UserPet::factory()
                ->mockCreature($creature)
                ->make());

        $response = $this
            ->get(route('creatures.search', [
                'query' => $name
            ]))
            ->assertNotFound()
            ->assertViewIs('pages.creatures.search')
            ->assertViewHas('query', $name)
            ->assertViewHas('results');

        $results = $this->viewDataAs($response, 'results', Collection::class);
        $this->assertEquals($expectedResults, $results);

        $this->assertBreadcrumbTrail($response, [
            ['Archive', route('home')],
            ['All families', route('creatures.index')],
            ['Search', null],
        ]);
    }

    public function test_search_rejects_query_that_is_not_alphabetic(): void
    {
        $this
            ->get(route('creatures.search', [
                'query' => 'Fawn123'
            ]))
            ->assertRedirect()
            ->assertSessionHasErrors('query');
    }
}
