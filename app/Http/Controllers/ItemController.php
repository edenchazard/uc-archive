<?php

namespace App\Http\Controllers;

use App\Models\Item;
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
            'shopTransactionRequirements.shopTransaction.shopCategory',
            'shopTransactions.shopCategory',
        ]);

        return view('pages.items.show', [
            'item' => $item,
        ]);
    }
}
