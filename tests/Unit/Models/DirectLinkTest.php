<?php

namespace Tests\Unit\Models;

use App\Models\Consumable;
use App\Models\Creature;
use App\Models\ExplorationArea;
use App\Models\ExplorationStory;
use App\Models\Family;
use App\Models\Item;
use App\Models\ShopCategory;
use Illuminate\Database\Eloquent\Model;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\Unit\TestCase;

class DirectLinkTest extends TestCase
{
    /**
     * @param  class-string<Model>  $modelClass
     * @param  array<string,string>  $attributes
     * @param  array<string,Model>  $relations
     */
    #[DataProvider('linkedModels')]
    public function test_direct_link_generates_the_expected_route_url(
        string $modelClass,
        array $attributes,
        array $relations,
        string $expectedPath,
    ): void {
        $model = new $modelClass;
        $model->forceFill($attributes);

        foreach ($relations as $name => $related) {
            $model->setRelation($name, $related);
        }

        $this->assertSame(url($expectedPath), $model->getAttribute('direct_link'));
    }

    /**
     * @return iterable<string, array{class-string<Model>, array<string,string>, array<string,Model>, string}>
     */
    public static function linkedModels(): iterable
    {
        yield 'consumable' => [
            Consumable::class,
            ['slug' => 'ancientberry'],
            [],
            '/components/ancientberry',
        ];

        yield 'item' => [
            Item::class,
            ['slug' => 'male-gen-x'],
            [],
            '/items/male-gen-x',
        ];

        yield 'exploration area' => [
            ExplorationArea::class,
            ['slug' => 'the-great-plains'],
            [],
            '/exploration/the-great-plains',
        ];

        yield 'exploration story' => [
            ExplorationStory::class,
            ['slug' => 'the-glistening-pond'],
            ['explorationArea' => (new ExplorationArea)->forceFill(['slug' => 'sargasso'])],
            '/exploration/sargasso/the-glistening-pond',
        ];

        yield 'creature' => [
            Creature::class,
            ['slug' => 'egg'],
            ['family' => (new Family)->forceFill(['slug' => 'blizz'])],
            '/creatures/blizz/egg',
        ];

        yield 'family' => [
            Family::class,
            ['slug' => 'adamant'],
            [],
            '/creatures/adamant',
        ];

        yield 'shop category' => [
            ShopCategory::class,
            ['slug' => 'items'],
            [],
            '/shop/items',
        ];
    }
}
