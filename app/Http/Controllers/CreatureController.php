<?php

namespace App\Http\Controllers;

use App\Models\Alt;
use App\Models\Creature;
use App\Models\Family;
use App\Models\UserPet;
use App\Services\Creatures\CreatureGender;

class CreatureController extends Controller
{
    /**
     * Resolve a creature by providing the family name and creature name
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Family $family, Creature $creature)
    {
        $creature->loadMissing('consumable');

        $gender = CreatureGender::get($family->gender);

        $closestCreatures = $creature->getAdjacentIds();

        $wrappedClosestCreatures = $closestCreatures->map(
            fn ($cr) => $cr ? (new UserPet())->use($cr) : null
        );

        // wrap a user pet
        $wrappedCreature = (new UserPet([
            'gender' => $gender,
        ]))->use($creature);

        $alt_evos = collect();

        if (! $family->deny_exalt) {
            $alts = collect([
                1 => 'noble',
                2 => 'exalted',
            ]);

            $alt_evos = $alt_evos->merge($alts->flip()->map(function (int $v) use ($creature, $gender) {
                return (new UserPet([
                    'specialty' => $v,
                    'gender' => $gender,
                ]))->use($creature);
            }));
        }

        if ($family->alts->count() > 0) {
            $alts = $family->alts->map(fn (Alt $alt) => $alt->name)->flip();
            $alt_evos = $alt_evos->merge($alts->map(fn ($v, $altName) => (new UserPet([
                'variety' => $altName,
            ]))->use($creature)));
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
