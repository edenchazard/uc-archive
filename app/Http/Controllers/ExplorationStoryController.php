<?php

namespace App\Http\Controllers;

use App\Models\ExplorationArea;
use App\Models\ExplorationStory;
use App\Models\UserPet;
use Illuminate\View\View;

class ExplorationStoryController extends Controller
{
    public function show(ExplorationArea $explorationArea, ExplorationStory $explorationStory): View
    {
        $explorationStory->loadMissing([
            'creature1.family',
            'creature2.family',
            'creature3.family',
        ]);

        return view('pages.exploration.stories.show', [
            'explorationStory' => $explorationStory,
            'creatures' => collect([
                $explorationStory->creature1,
                $explorationStory->creature2,
                $explorationStory->creature3,
            ])
                ->filter()
                ->map(fn ($creature) => UserPet::factory()->mockCreature($creature)->make()),
        ]);
    }
}
