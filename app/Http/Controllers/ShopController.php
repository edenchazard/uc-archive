<?php

namespace App\Http\Controllers;

use App\Models\Creature;
use App\Models\ShopCategory;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\View\View;

class ShopController extends Controller
{
    public function index(): View
    {
        $categories = ShopCategory::query()->get();

        return view('pages.shop.index', [
            'categories' => $categories,
        ]);
    }

    public function show(ShopCategory $shopCategory): View
    {
        $shopCategory->loadMissing([
            'transactions.rewardable',
            'transactions.requirements.requireable' => fn (MorphTo $q) => $q
                ->orderBy('type')
                ->orderBy('name'),
        ]);

        $shopCategory->transactions->loadMorph('rewardable', [
            Creature::class => ['family'],
        ]);

        return view('pages.shop.categories.show', [
            'shopCategory' => $shopCategory,
        ]);
    }
}
