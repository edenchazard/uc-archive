<?php

namespace App\Http\Controllers;

use App\Models\ExplorationArea;
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
            'page' => [
                'title' => 'Exploration',
                'route' => 'exploration.index',
                'name' => 'Exploration',
            ],
        ]);
    }

    public function show(ExplorationArea $explorationArea): View
    {
        $explorationArea->loadMissing([
            'consumables',
            'explorationStories',
        ]);

        return view('pages.exploration.show', [
            'explorationArea' => $explorationArea,
            'page' => [
                'title' => "Exploration: {$explorationArea->name}",
                'route' => 'exploration.area.show',
                'name' => $explorationArea->name,
            ],
        ]);
    }
}
