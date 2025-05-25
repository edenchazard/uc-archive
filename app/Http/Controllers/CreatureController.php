<?php

namespace App\Http\Controllers;

use App\Models\Alt;
use App\Models\Creature;
use App\Models\Family;
use App\Models\UserPet;
use App\Services\Creatures\CreatureGender;
use Illuminate\View\View;

class CreatureController extends Controller
{
    /**
     * Resolve a creature by providing the family name and creature name
     */
    public function show(Family $family, Creature $creature): View
    {
        $creature->loadMissing('consumable');
        $gender = CreatureGender::get($family->gender);

        $closestCreatures = $creature->getChronologicalAdjacents();

        $wrappedClosestCreatures = $closestCreatures->map(
            fn ($cr) => $cr ? UserPet::factory()->mockCreature($creature)->make() : null
        );

        // wrap a user pet
        $wrappedCreature = UserPet::factory()
            ->mockCreature($creature)
            ->make([
                'gender' => $gender,
            ]);

        $alt_evos = collect();

        if (! $family->deny_exalt) {
            $alts = collect([
                1 => 'noble',
                2 => 'exalted',
            ]);

            $alt_evos = $alt_evos->merge($alts->flip()->map(function (int $v) use ($creature, $gender) {
                return UserPet::factory()
                    ->mockCreature($creature)
                    ->make([
                        'specialty' => $v,
                        'gender' => $gender,
                    ]);
            }));
        }

        if ($family->alts->count() > 0) {
            $alts = $family->alts->map(fn (Alt $alt) => $alt->name)->flip();
            $alt_evos = $alt_evos->merge($alts->map(fn ($v, $altName) => UserPet::factory()
                ->mockCreature($creature)
                ->make([
                    'variety' => $altName,
                ])));
        }

        $data = [
            'closestCreatures' => $wrappedClosestCreatures,
            'family' => $family,
            'pet' => $wrappedCreature,
            'page' => [
                'title' => "Creature: {$creature->name}",
                'route' => 'creature',
                'breadcrumb' => $creature->name,
            ],
            'alts' => $alt_evos,
        ];

        return view('pages.creatures.family.creature.show', $data);
    }
}
