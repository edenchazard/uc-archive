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
        $families = Family::with('stages')->get();

        $data = [
            'groups' => $families->groupBy(fn($family) => $family->name[0]),
            'page' => [
                'title' => 'Families',
                'route' => 'family',
                'name' => 'All families'
            ]
        ];

        return view('creatures.all-families', $data);
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
        /* $data = $request->all();
        return Family::create($data); */
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Family  $name
     * @return \Illuminate\Http\Response
     */
    public function show(string $name)
    {
        $family = Family::findByName($name);

        $stages = $family->stages->all();

        $gender = $family->gender > 1 ? CreatureUtils::gender()::random() : CreatureUtils::gender($family->gender);
        array_walk($stages, fn($stage) => $stage->gender = $gender);
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
