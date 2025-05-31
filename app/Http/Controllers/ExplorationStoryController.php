<?php

namespace App\Http\Controllers;

use App\Models\ExplorationArea;
use App\Models\ExplorationStory;
use App\Models\ExplorationStoryOption;
use App\Models\UserPet;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\View\View;

class ExplorationStoryController extends Controller
{
    public function show(ExplorationArea $explorationArea, ExplorationStory $explorationStory): View
    {
        $explorationStory
            ->loadMissing([
                'storyOptions' => fn (HasMany $q) => $q
                    ->with('creature.family')
                    ->orderBy('order'),
            ]);

        return view('pages.exploration.stories.show', [
            'explorationStory' => $explorationStory,
            'creatures' => $explorationStory
                ->storyOptions
                ->map(fn (ExplorationStoryOption $storyOption)
                    => UserPet::factory()->mockCreature($storyOption->creature)->make()),
        ]);
    }
}
