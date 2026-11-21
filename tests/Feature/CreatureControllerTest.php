<?php

namespace Tests\Feature;

use App\Enums\RarityCategoryEnum;
use App\Enums\SpecialtyEnum;
use App\Models\Creature;
use App\Models\Family;
use App\Models\UserPet;
use Illuminate\Support\Collection;
use Illuminate\Testing\TestResponse;
use PHPUnit\Framework\Attributes\DataProvider;
use Symfony\Component\HttpFoundation\Response;

class CreatureControllerTest extends TestCase
{
    /**
     * @param  list<array{id: int|null, name: string|null}>  $expectedNeighbors
     * @param  list<string>  $expectedAltKeys
     * @param  list<SpecialtyEnum>  $expectedSpecialties
     * @param array{
     *     artist: string|null,
     *     stageOrdinal: string,
     *     creatureOrdinal: string,
     *     family: string,
     *     element: string,
     *     rarity: string,
     *     uniqueRating: string|null,
     *     release: string,
     *     consumable: string,
     *     requiredClicks: int
     * }  $expectedDisplay
     */
    #[DataProvider('creatureShowCases')]
    public function test_show(
        int $creatureId,
        string $expectedCreatureName,
        RarityCategoryEnum $expectedRarity,
        array $expectedNeighbors,
        array $expectedAltKeys,
        array $expectedSpecialties,
        array $expectedDisplay,
    ): void {
        $viewData = $this->assertCreatureShowPage($creatureId, $expectedNeighbors);

        $this->assertSame(
            $expectedCreatureName,
            $viewData['pet']->creature->name
        );
        $this->assertSame($expectedRarity, $viewData['family']->rarity);
        $this->assertSame($expectedAltKeys, $viewData['alts']->keys()->all());
        $this->assertSame(
            $expectedSpecialties,
            $viewData['alts']->pluck('specialty')->all()
        );
        $this->assertSame(
            array_fill(0, count($expectedAltKeys), $expectedCreatureName),
            $viewData['alts']->pluck('creature.name')->all()
        );

        $response = $viewData['response'];
        $requiredClicks = $expectedDisplay['requiredClicks'];
        $artist = $expectedDisplay['artist'] === null
            ? 'by an unknown artist'
            : "by {$expectedDisplay['artist']}";
        $finalEvolution = $requiredClicks === 0 ? ' and final' : '';

        $consumable = $viewData['pet']->creature->consumable;
        $directLink = $consumable?->getAttribute('direct_link');
        $imageLink = $consumable?->getAttribute('image_link');

        $this->assertIsString($directLink);
        $this->assertIsString($imageLink);

        $response
            ->assertSeeText("{$expectedCreatureName} was drawn {$artist} and is the {$expectedDisplay['stageOrdinal']}{$finalEvolution} evolution of the {$expectedDisplay['family']} family, and {$expectedDisplay['creatureOrdinal']} creature overall.")
            ->assertSeeText("Being a member of the {$expectedDisplay['family']} family, its elemental type is {$expectedDisplay['element']} with a rarity rating of {$expectedDisplay['rarity']}".
                ($expectedDisplay['uniqueRating'] === null ? '' : " ({$expectedDisplay['uniqueRating']})").
                '.')
            ->assertSeeText($expectedDisplay['release'])
            ->assertSeeText("Interacting with {$expectedCreatureName} while exploring would earn you the {$expectedDisplay['consumable']} component.")
            ->assertSee('href="'.$directLink.'"', false)
            ->assertSee('src="'.$imageLink.'"', false)
            ->assertSee('alt="'.$expectedDisplay['consumable'].'"', false)
            ->when(
                value: $requiredClicks > 0,
                callback: fn ($response) => $response->assertSeeText("It requires {$requiredClicks} clicks to evolve."),
                default: fn ($response) => $response->assertDontSeeText('It requires')
            );
    }

    /**
     * @return iterable<string, array{
     *     int,
     *     string,
     *     RarityCategoryEnum,
     *     list<array{id: int|null, name: string|null}>,
     *     list<string>,
     *     list<SpecialtyEnum>,
     *     array{
     *         artist: string|null,
     *         stageOrdinal: string,
     *         creatureOrdinal: string,
     *         family: string,
     *         element: string,
     *         rarity: string,
     *         uniqueRating: string|null,
     *         release: string,
     *         consumable: string,
     *         requiredClicks: int
     *     }
     * }>
     */
    public static function creatureShowCases(): iterable
    {
        yield 'noble and exalted variants' => [
            533,
            'Adamant',
            RarityCategoryEnum::Scarce,
            [
                ['id' => 532, 'name' => 'David'],
                ['id' => 534, 'name' => 'Egg'],
            ],
            ['noble', 'exalted'],
            [SpecialtyEnum::Noble, SpecialtyEnum::Exalted],
            [
                'artist' => 'Unda',
                'stageOrdinal' => '4th',
                'creatureOrdinal' => '533rd',
                'family' => 'Adamant',
                'element' => 'Earth',
                'rarity' => 'Scarce',
                'uniqueRating' => null,
                'release' => 'It was released on 26th July 2011.',
                'consumable' => 'Riverstone',
                'requiredClicks' => 0,
            ],
        ];

        yield 'exotic rarity' => [
            213,
            'Alban',
            RarityCategoryEnum::Exotic,
            [
                ['id' => 212, 'name' => 'Dion'],
                ['id' => 214, 'name' => 'Egg'],
            ],
            [],
            [],
            [
                'artist' => 'Kira',
                'stageOrdinal' => '4th',
                'creatureOrdinal' => '213th',
                'family' => 'Alban',
                'element' => 'Air',
                'rarity' => 'Exotic',
                'uniqueRating' => 'Exotic',
                'release' => 'It was released on 30th September 2009.',
                'consumable' => 'Whiteroot',
                'requiredClicks' => 0,
            ],
        ];

        yield 'family alt' => [
            325,
            'Aello',
            RarityCategoryEnum::Scarce,
            [
                ['id' => 324, 'name' => 'Arche'],
                ['id' => 326, 'name' => 'Egg'],
            ],
            ['noble', 'exalted', 'candycane'],
            [SpecialtyEnum::Noble, SpecialtyEnum::Exalted, SpecialtyEnum::None],
            [
                'artist' => 'Azrielen',
                'stageOrdinal' => '3rd',
                'creatureOrdinal' => '325th',
                'family' => 'Aello',
                'element' => 'Air',
                'rarity' => 'Scarce',
                'uniqueRating' => null,
                'release' => 'It was released on 11th April 2010.',
                'consumable' => 'Skypollen',
                'requiredClicks' => 0,
            ],
        ];

        yield 'first creature has no previous neighbor' => [
            1,
            'Egg',
            RarityCategoryEnum::Common,
            [
                ['id' => null, 'name' => null],
                ['id' => 2, 'name' => 'Asmo'],
            ],
            ['noble', 'exalted'],
            [SpecialtyEnum::Noble, SpecialtyEnum::Exalted],
            [
                'artist' => 'Auna',
                'stageOrdinal' => '1st',
                'creatureOrdinal' => '1st',
                'family' => 'Blizz',
                'element' => 'Water',
                'rarity' => 'Common',
                'uniqueRating' => null,
                'release' => 'It was released on 31st December 1970.',
                'consumable' => 'Watervine',
                'requiredClicks' => 12,
            ],
        ];

        yield 'last creature has no next neighbor' => [
            741,
            'Sakuya',
            RarityCategoryEnum::Uncommon,
            [
                ['id' => 740, 'name' => 'Mariel'],
                ['id' => null, 'name' => null],
            ],
            ['noble', 'exalted'],
            [SpecialtyEnum::Noble, SpecialtyEnum::Exalted],
            [
                'artist' => 'Alwerien',
                'stageOrdinal' => '4th',
                'creatureOrdinal' => '741st',
                'family' => 'Sakuya',
                'element' => 'Physical',
                'rarity' => 'Uncommon',
                'uniqueRating' => null,
                'release' => 'It was released on 2nd September 2013.',
                'consumable' => 'Sunnyseed',
                'requiredClicks' => 0,
            ],
        ];

        yield 'unknown artist and second stage' => [
            35,
            'Boo',
            RarityCategoryEnum::Exotic,
            [
                ['id' => 34, 'name' => 'Egg'],
                ['id' => 36, 'name' => 'Rawr'],
            ],
            [],
            [],
            [
                'artist' => null,
                'stageOrdinal' => '2nd',
                'creatureOrdinal' => '35th',
                'family' => 'Sly',
                'element' => 'Physical',
                'rarity' => 'Exotic',
                'uniqueRating' => 'Exotic',
                'release' => 'It was released on 13th February 2009.',
                'consumable' => 'Treescent',
                'requiredClicks' => 38,
            ],
        ];

        yield 'unknown release date' => [
            143,
            'Yarr',
            RarityCategoryEnum::Limited,
            [
                ['id' => 142, 'name' => 'Scalawag'],
                ['id' => 144, 'name' => 'Egg'],
            ],
            ['noble', 'exalted'],
            [SpecialtyEnum::Noble, SpecialtyEnum::Exalted],
            [
                'artist' => 'Azrielen',
                'stageOrdinal' => '4th',
                'creatureOrdinal' => '143rd',
                'family' => 'Yarr',
                'element' => 'Water',
                'rarity' => 'Limited',
                'uniqueRating' => null,
                'release' => 'Its release date is unknown.',
                'consumable' => 'Skypollen',
                'requiredClicks' => 0,
            ],
        ];
    }

    public function test_missing_creature_redirects_to_search_with_scoped_lookup(): void
    {
        $family = Family::query()
            ->orderBy('name')
            ->first();

        $this->assertNotNull($family);

        $otherFamily = Family::query()
            ->whereKeyNot($family->id)
            ->orderBy('name')
            ->first();

        $this->assertNotNull($otherFamily);

        $familySlugs = $family->stages()
            ->pluck('slug')
            ->all();

        $otherCreature = $otherFamily->stages()
            ->get()
            ->first(fn (Creature $creature) => ! in_array($creature->slug, $familySlugs, true));

        $this->assertNotNull($otherCreature);

        $this
            ->get(route('creatures.family.creature.show', [
                'family' => $family->slug,
                'creature' => $otherCreature->slug,
            ]))
            ->assertRedirect(route('creatures.search', [
                'query' => $otherCreature->slug,
            ]));
    }

    /**
     * @param  list<array{id: int|null, name: string|null}>  $expectedNeighbors
     * @return array{family: Family, pet: UserPet, alts: Collection<string, UserPet>, response: TestResponse<Response>}
     */
    private function assertCreatureShowPage(int $creatureId, array $expectedNeighbors): array
    {
        $creature = Creature::query()
            ->with('family')
            ->whereKey($creatureId)
            ->firstOrFail();

        $family = $creature->family;

        $response = $this
            ->get(route('creatures.family.creature.show', [$family, $creature]))
            ->assertOk()
            ->assertViewIs('pages.creatures.family.creature.show')
            ->assertViewHas('closestCreatures')
            ->assertViewHas('family')
            ->assertViewHas('pet')
            ->assertViewHas('alts')
            ->assertViewHas('explorationStories');

        $closestCreatures = $this->viewDataAs($response, 'closestCreatures', Collection::class);
        $viewFamily = $this->viewDataAs($response, 'family', Family::class);
        $pet = $this->viewDataAs($response, 'pet', UserPet::class);
        $alts = $this->viewDataAs($response, 'alts', Collection::class);
        $this->viewDataAs($response, 'explorationStories', Collection::class);

        $this->assertSame(['previous', 'next'], $closestCreatures->keys()->all());
        $this->assertSame(
            array_column($expectedNeighbors, 'id'),
            $closestCreatures->pluck('creature.id')->all()
        );
        $this->assertSame(
            array_column($expectedNeighbors, 'name'),
            $closestCreatures->pluck('creature.name')->all()
        );
        $this->assertSame($creature->id, $pet->creature->id);
        $this->assertSame($creature->name, $pet->creature->name);
        $this->assertSame($family->id, $viewFamily->id);
        $this->assertSame($family->name, $viewFamily->name);

        $this->assertBreadcrumbTrail($response, [
            ['Archive', route('home')],
            ['All families', route('creatures.index')],
            [$family->name, route('creatures.family.show', $family)],
            [$creature->name, null],
        ]);

        return [
            'family' => $viewFamily,
            'pet' => $pet,
            'alts' => $alts,
            'response' => $response,
        ];
    }
}
