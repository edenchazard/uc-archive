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
        $creature->loadMissing([
          'consumable',
        ]);

        $gender = CreatureGender::get($family->gender);

        $wrappedClosestCreatures = collect([
          'next' => $creature->canonicalNext(),
          'previous' => $creature->canonicalPrevious(),
        ])
          ->map(fn (Creature|null $cr) => $cr ? (new UserPet())->use($cr) : null);

        // Wrap a user pet
        $wrappedCreature = (new UserPet([
            'gender' => $gender,
        ]))->use($creature);

        $alt_evos = collect()
          ->when(! $family->deny_exalt, function ($collection) use ($creature, $gender) {
              $alts = collect([
                  1 => 'noble',
                  2 => 'exalted',
              ]);

              return $collection->merge($alts->flip()->map(function (int $v) use ($creature, $gender) {
                  return (new UserPet([
                      'specialty' => $v,
                      'gender' => $gender,
                  ]))->use($creature);
              }));
          })
          ->when($family->alts->isNotEmpty(), function ($collection) use ($creature, $family) {
              $alts = $family->alts
                ->map(fn (Alt $alt) => $alt->name)
                ->flip();

              return $collection
                ->merge($alts->map(fn ($v, $altName) => (new UserPet([
                  'variety' => $altName,
              ]))->use($creature)));
          });

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
