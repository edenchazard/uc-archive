<?php

namespace App\Http\Controllers;

use App\Models\Family;
use App\Services\Creatures\CreatureGender;
use Illuminate\Http\Request;
use App\Models\Creature;

class FamilyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $families = Family::with('stages')->get();

        $wrappedFamilies =  $families->map(
            function ($family) {
                $family->stages = $family->stages->map(
                    function ($stage) use ($family) {
                        $stage->setRelation('family', $family);
                        return $stage->wrap();
                    }
                );
                return $family;
            }
        );

        $data = [
            'groups' => $wrappedFamilies->groupBy(fn ($family) => $family->name[0]),
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
        $family = Family::with('stages')->whereName($name)->first();

        /**
         * Family not found, try to search for a creature with the specified 
         * $name and redirects to the creature's page.
         * If multiple matches such as "Egg" are found, a collection of results will be returned.
         */
        if (!$family) {
            $results = Creature::with('family')
                ->where((new Creature)->getTable() . ".name", $name)
                ->joinFamily()
                ->orderByFamilyName()
                ->get();

            // redirect if a single match, otherwise give the user options.
            if ($results->count() === 1) {
                $creature = $results->first();
                return redirect(route('creature', [$creature->family->name, $creature->name]));
            }

            $data = [
                'query' => $name,
                'results' => $results->map(fn ($creature) => $creature->wrap()),
                'page' => [
                    'title' => "Search",
                    'route' => '',
                    'breadcrumb' => ''
                ]
            ];

            return view('creatures.search', $data);
        }

        // Generate a single gender. If we ran this in the map, we'd get a
        // different one every time and it breaks viewer immersion.
        $gender = CreatureGender::get($family->gender);

        // wrap each stage with a pet object so the we can apply some 
        // attributes
        $wrappedStages = $family->stages->map(fn ($stage) => $stage->wrap([
            'gender' => $gender
        ]));

        $data = [
            'stages' => $wrappedStages,
            'family' => $family,
            'page' => [
                'title' => "Family: {$family->name}",
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
