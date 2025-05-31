<?php

namespace App\Http\Controllers;

use App\Models\Creature;
use App\Models\Family;
use Illuminate\View\View;

class ExplorationStoryController extends Controller
{
    /**
     * Resolve a creature by providing the family name and creature name
     */
    public function index(): View
    {

        /*  return view('pages.exploration.index', [
             'explorationAreas' => $explorationAreas,
         ]); */
    }
}
