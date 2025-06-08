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

    public function show(Consumable $consumable): View
    {
        $consumable->loadMissing([
            'creatures.family',
            'shopTransactionRequirements.shopTransaction.shopCategory',
            'shopTransactions.shopCategory',
            'explorationAreas',
        ]);

        return view('pages.components.show', [
            'consumable' => $consumable,
        ]);
    }
}
