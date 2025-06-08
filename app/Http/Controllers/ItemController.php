<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\View\View;

class ItemController extends Controller
{
    public function index(): View
    {
        $items = Item::query()
            ->orderBy('name')
            ->get();

        return view('pages.items.index', [
            'items' => $items,
        ]);
    }

    public function show(Item $item): View
    {
        $item->loadMissing([
            'shopTransactionRequirements.shopTransaction' => fn (BelongsTo $q) => $q
                ->with('shopCategory')
                ->orderBy('title'),
            'shopTransactions.shopCategory' => fn (BelongsTo $q) => $q
                ->orderBy('title'),
        ]);

        return view('pages.items.show', [
            'item' => $item,
        ]);
    }
}
