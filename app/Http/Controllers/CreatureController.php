<?php

namespace App\Http\Controllers;

use App\Models\Alt;
use App\Models\Creature;
use App\Models\Family;
use App\Models\UserPet;
use Illuminate\View\View;

class CreatureController extends Controller
{
    /**
     * Resolve a creature by providing the family name and creature name
     */
    public function show(Family $family, Creature $creature): View
    {
        $creature->loadMissing([
            'consumable',
            'family',
            'trainingOptions.creature',
        ]);
        $family->loadMissing('alts');

        $closestCreatures = $creature
            ->getChronologicalAdjacents()
            ->map(
                fn ($closest) => $closest ? UserPet::factory()
                    ->mockCreature($closest)
                    ->make() : null
            );

        $wrappedCreature = UserPet::factory()
            ->mockCreature($creature)
            ->make();

        $altEvolutions = collect();

        if (! $family->deny_exalt) {
            $alts = collect([
                1 => 'noble',
                2 => 'exalted',
            ]);

            $altEvolutions = $altEvolutions->merge($alts
                ->flip()
                ->map(
                    fn (int $v) => UserPet::factory()
                        ->mockCreature($creature)
                        ->make([
                            'specialty' => $v,
                        ])
                ));
        }

        if ($family->alts->isNotEmpty()) {
            $alts = $family->alts->map(fn (Alt $alt) => $alt->name)->flip();
            $altEvolutions = $altEvolutions->merge($alts->map(fn ($v, $altName) => UserPet::factory()
                ->mockCreature($creature)
                ->make([
                    'variety' => $altName,
                ])));
        }

        return view('pages.creatures.family.creature.show', [
            'closestCreatures' => $closestCreatures,
            'family' => $family,
            'pet' => $wrappedCreature,
            'alts' => $altEvolutions,
            'explorationStories' => $creature
                ->explorationStories()
                ->with('explorationArea')
                ->get(),
        ]);
    }
}
