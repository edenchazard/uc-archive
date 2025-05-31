<?php

namespace App\Http\Controllers;

use App\Enums\SpecialtyEnum;
use App\Models\Creature;
use App\Models\Family;
use App\Models\UserPet;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;

class FamilyController extends Controller
{
    public function index(): View
    {
        $families = Creature::query()
            ->with('family')
            ->get()
            ->map(
                fn (Creature $creature) => UserPet::factory()
                    ->mockCreature($creature)
                    ->make()
            )
            ->groupBy('creature.family.name')
            ->map(fn ($creatures) => [
                'family' => $creatures->first()?->creature->family,
                'stages' => $creatures,
            ])
            ->sortBy('family.name');

        return view('pages.creatures.index', [
            'groups' => $families->groupBy(fn ($family) => $family['family']?->name[0] ?? ''),
            'page' => [
                'title' => 'Families',
                'route' => 'family',
                'name' => 'All families',
            ],
        ]);
    }

    public function show(Family $family): View
    {
        $family->loadMissing('stages');

        // create a separate list of alt evolution lists
        $alt_evos = collect();

        // determine if we should add noble/exalt variations to the list
        if (! $family->deny_exalt) {
            $alts = collect([
                SpecialtyEnum::Noble,
                SpecialtyEnum::Exalted,
            ])
                ->map(fn ($specialty) => $family->stages->map(fn (Creature $stage) => UserPet::factory()
                    ->mockCreature($stage)
                    ->make([
                        'specialty' => $specialty,
                    ])));

            $alt_evos->merge($alts);
        }

        $wrappedStages = $family->stages->map(
            fn (Creature $stage) => UserPet::factory()
                ->mockCreature($stage)
                ->make()
        );

        return view('pages.creatures.family.show', [
            'alts' => $alt_evos,
            'stages' => $wrappedStages,
            'family' => $family,
        ]);
    }

    public function search(): Response|RedirectResponse
    {
        /**
         * Family not found, try to search for a creature with the specified
         * $name and redirects to the creature's page.
         * If multiple matches such as "Egg" are found, a collection of results will be returned.
         */
        $validation = request()->validate([
            'query' => [
                'nullable',
                'string',
                'alpha:ascii',
            ],
        ]);

        assert(is_array($validation));

        $data = [];

        if (isset($validation['query'])) {
            $results = Creature::query()
                ->with('family')
                ->withAggregate('family AS family_name', 'name')
                ->where('name', $validation['query'])
                ->orderBy('family_name')
                ->get()
                ->map(fn (Creature $creature) => UserPet::factory()->mockCreature($creature)->make());

            // redirect if a single match, otherwise give the user options.
            if ($results->count() === 1) {
                $userPet = $results->first();

                return to_route('creatures.family.creature.show', [
                    $userPet?->creature?->family,
                    $userPet?->creature,
                ]);
            }

            $data = [
                'query' => $validation['query'],
                'results' => $results,
            ];
        }

        return response()->view('pages.creatures.search', [
            'query' => null,
            'results' => collect([]),
            ...$data,
        ], 404);
    }
}
