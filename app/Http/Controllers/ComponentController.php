<?php

namespace App\Http\Controllers;

use App\Enums\ConsumableTypeEnum;
use App\Models\Consumable;
use Illuminate\View\View;

class ComponentController extends Controller
{
    public function index(): View
    {
        $components = Consumable::query()
            ->orderBy('name')
            ->whereNot('type', ConsumableTypeEnum::Other)
            ->get()
            ->groupBy('type');

        return view('pages.components.index', [
            'components' => $components,
        ]);
    }
}
