<?php

namespace App\Http\Controllers;

use App\Enums\ConsumableTypeEnum;
use App\Models\ExplorationArea;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\View\View;

class ExplorationController extends Controller
{
    public function index(): View
    {
        $explorationAreas = ExplorationArea::query()
            ->orderBy('name')
            ->get();

        return view('pages.exploration.index', [
            'explorationAreas' => $explorationAreas,
        ]);
    }

    public function show(ExplorationArea $explorationArea): View
    {

        $explorationArea->loadMissing([
            'consumables' => fn (BelongsToMany $q) => $q
                ->orderByRaw("type = '" . ConsumableTypeEnum::Tree->value . "' DESC")
                ->orderBy('name'),
            'explorationStories' => fn (HasMany $q) => $q
                ->orderBy('title'),
        ]);

        return view('pages.exploration.show', [
            'explorationArea' => $explorationArea,
        ]);
    }
}
