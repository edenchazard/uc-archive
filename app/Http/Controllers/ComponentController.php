<?php

namespace App\Http\Controllers;

use App\Enums\ConsumableTypeEnum;
use App\Models\Consumable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
            'creatures' => fn (HasMany $q) => $q
                ->with('family')
                ->orderBy('name'),
            'shopTransactionRequirements.shopTransaction' => fn (BelongsTo $q) => $q
                ->with('shopCategory')
                ->orderBy('title'),
            'shopTransactions.shopCategory' => fn (BelongsTo $q) => $q
                ->orderBy('title'),
            'explorationAreas' => fn (BelongsToMany $q) => $q
                ->orderBy('name'),
        ]);

        return view('pages.components.show', [
            'consumable' => $consumable,
        ]);
    }
}
