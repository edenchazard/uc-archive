<?php

namespace App\Http\Controllers;

use App\Models\Family;
use App\Models\Creature;
use App\Services\Formatting\CreatureFormattingService;
use Illuminate\Http\Request;
use App\Services\Creatures\CreatureUtils;

class FamilyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        $data = $request->all();
        return Family::create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Family  $name
     * @return \Illuminate\Http\Response
     */
    public function show(string $name)
    {
        $family = Family::firstWhere('name', $name);

        // I don't know if modifying the original property is a good idea tbh
        // or if the formatter could be 'injected' into the blade template
        $stages = $family->stages->all();
    
        array_walk($stages, function(Creature $creature) use ($family) {
            [$long, $short] = array_map(fn(CreatureFormattingService $f) => $f->formatAll()->get(), [
                new CreatureFormattingService($creature->longDescription, [
                    'c:nickname' => $creature->name,
                    'c:name' => $creature->name,
                    'c:family' => $family->name
                ]),
                new CreatureFormattingService($creature->shortDescription)
            ]);
            $creature->longDescription = $long;
            $creature->shortDescription = $short;
        });

        $data = [
            'stages' => $stages,
            'familyData' => $family,
            'generalAttributes' => [
                'Name' => $family->name,
                'Rarity' => CreatureUtils::rarity($family->rarity),
                'Released on' => $family->released,
                'Unique rating' => $family->uniqueRating,
                'Gender' => CreatureUtils::gender($family->gender)::friendlyName(),
                'Noble/Exalt' => ($family->allowExalt ? 'Yes' : 'No'),
                'Basket' => ($family->inBasket ? 'Yes' : 'No'),
                'Artists' => ''
            ],
            'page' => [
                'title' => $family->name,
                'route' => 'family',
                'name' => $family->name
            ]
        ];
    
        return view('creatures.family', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Family  $family
     * @return \Illuminate\Http\Response
     */
    public function edit(Family $family)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Family  $family
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Family $family)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Family  $family
     * @return \Illuminate\Http\Response
     */
    public function destroy(Family $family)
    {
        //
    }
}
