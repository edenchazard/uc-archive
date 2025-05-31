<?php

namespace App\Http\Controllers;

use App\Models\Consumable;
use Illuminate\View\View;

class ComponentController extends Controller
{
    public function index(): View
    {
        $components = Consumable::query()
            ->orderBy('name')
            ->get()
            ->groupBy('type');

        return view('pages.components.index', [
            'components' => $components,
        ]);
    }
}
