<?php

namespace App\Http\Controllers;

use App\Models\Creature;
use App\Models\Family;
use Illuminate\Http\Request;

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
     * Display the specified resource.
     *
     * @param  \App\Models\Creature  $creature
     * @return \Illuminate\Http\Response
     */
    public function showByTaxonomy(string $family, string $name)
    {
        $creature = Creature::firstWhere('name', $name);//::firstWhere('family', $family);
        return $creature;
    }

    public function showById(int $id){
        $creature = Creature::find($id);
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
