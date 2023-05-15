<?php

namespace App\Http\Controllers;

use App\Models\Creature;
use App\Models\Family;
use App\Models\UserPet;
use App\Services\Creatures\CreatureGender;
use Illuminate\Http\Request;
use App\Services\Creatures\CreatureUtils;

class CreatureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, string $familyName)
    {
        $data = $request->all();

        // resolve family id from family name
        $family = Family::firstWhere('name', $familyName);
        return Creature::create(array_merge($data, ['family_id' => $family->id]));
    }

    /**
     * Resolve a creature by providing the family name and creature name
     *
     * @param  \App\Models\Creature  $creature
     * @return \Illuminate\Http\Response
     */
    public function showByTaxonomy(string $familyName, string $creatureName)
    {
        // retrieve family id
        $family = Family::firstWhere('name', $familyName);

        if (!$family) abort(404, "Family not found.");

        // get creature
        $creature = Creature::with('consumable')->firstWhere([
            'family_id' => $family->id,
            'name' => $creatureName
        ]);

        if (!$creature) abort(404, "Creature not found.");

        $gender = CreatureGender::get($family->gender);

        $closestCreatures = $creature->getAdjacentIds();

        $wrappedClosestCreatures = $closestCreatures->map(
            fn ($creature) => $creature ? $creature->wrap() : null
        );

        // wrap a virtual user pet
        $wrappedCreature = $creature->wrap(['gender' => $gender]);

        $data = [
            'closestCreatures' => $wrappedClosestCreatures,
            'family' => $family,
            'pet' => $wrappedCreature,
            'page' => [
                'title' => "Creature: {$creature->name}",
                'route' => 'creature',
                'breadcrumb' => $creature->name
            ]
        ];

        return view('creatures.creature', $data);
    }

    public function showById(int $id)
    {
        $creature = Creature::find($id);

        if (!$creature) abort(404, "Creature not found.");

        return $creature;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Creature  $creature
     * @return \Illuminate\Http\Response
     */
    public function edit(Creature $creature)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Creature  $creature
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Creature $creature)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Creature  $creature
     * @return \Illuminate\Http\Response
     */
    public function destroy(Creature $creature)
    {
        //
    }
}
