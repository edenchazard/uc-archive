<?php

namespace App\Http\Controllers;

use App\Models\Creature;
use App\Models\Family;
use App\Models\UserPet;
use App\Services\Creatures\CreatureGender;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;

class FamilyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $families = Family::query()
          ->with('stages')
          ->get();

        $wrappedFamilies = $families->map(
            function ($family) {
                $family->stages = $family->stages->map(
                    function ($stage) use ($family) {
                        $stage->setRelation('family', $family);
                        return (new UserPet())->use($stage);
                    }
                );
                return $family;
            }
        );

        return view('pages.creatures.index', [
          'groups' => $wrappedFamilies->groupBy(fn ($family) => $family->name[0]),
          'page' => [
              'title' => 'Families',
              'route' => 'family',
              'name' => 'All families',
          ],
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Family $family): View
    {
        $family->loadMissing('stages');

        // Generate a single gender. If we ran this in the map, we'd get a
        // different one every time and it breaks viewer immersion.
        $gender = CreatureGender::get($family->gender);

        // create a separate list of alt evolution lists
        $alt_evos = collect();

        // determine if we should add noble/exalt variations to the list
        if (! $family->deny_exalt) {
            $alts = collect([
                1 => 'noble',
                2 => 'exalted',
            ]);

            $alt_evos = $alt_evos->merge($alts->flip()->map(function (int $v) use ($family, $gender) {
                return $family->stages->map(fn (Creature $stage) => (new UserPet([
                    'specialty' => $v,
                    'gender' => $gender,
                ]))->use($stage));
            }));
        }

        $wrappedStages = $family->stages->map(
            fn (Creature $stage) => (new UserPet([
                'gender' => $gender,
            ]))->use($stage)
        );

        $data = [
            'alts' => $alt_evos,
            'stages' => $wrappedStages,
            'family' => $family,
            'page' => [
                'title' => "Family: {$family->name}",
                'route' => 'family',
                'name' => $family->name,
            ],
        ];

        return view('pages.creatures.family.show', $data);
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

        $data = [];

        if (isset($validation['query'])) {
            $results = Creature::query()
              ->with('family')
              ->where('creatures.name', $validation['query'])
              ->joinFamily()
              ->orderByFamilyName()
              ->get();

            // redirect if a single match, otherwise give the user options.
            if ($results->count() === 1) {
                $creature = $results->first();
                return to_route('creatures.family.creature.show', [$creature->family, $creature]);
            }
            $data = [
                'query' => $validation['query'],
                'results' => $results->map(fn ($creature) => $creature->wrap()),
            ];
        }

        return response()->view(
          'pages.creatures.search',
          [
            'query' => null,
            'results' => collect([]),
            ...$data,
            'page' => [
                'title' => 'Search',
                'route' => '',
                'breadcrumb' => '',
            ],
          ],
          404
        );
    }
}
