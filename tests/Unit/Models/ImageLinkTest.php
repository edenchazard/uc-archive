<?php

namespace Tests\Unit\Models;

use App\Enums\SpecialtyEnum;
use App\Models\Consumable;
use App\Models\Creature;
use App\Models\ExplorationArea;
use App\Models\Family;
use App\Models\Item;
use App\Models\UserPet;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\Unit\TestCase;

class ImageLinkTest extends TestCase
{
    #[DataProvider('linkedModels')]
    public function test_image_link(Model $model, ?string $expectedPath): void
    {
        $this->assertSame(
            $expectedPath === null ? null : asset($expectedPath),
            $model->getAttribute('image_link')
        );
    }

    /**
     * @return iterable<string, array{Model, string|null}>
     */
    public static function linkedModels(): iterable
    {
        yield 'consumable' => [
            (new Consumable)->forceFill(['name' => 'Mystic Dew']),
            'images/consumables/mystic_dew.webp',
        ];

        yield 'item' => [
            (new Item)->forceFill(['name' => 'Male Gen-X']),
            'images/items/male_gen_x.webp',
        ];

        yield 'exploration area' => [
            (new ExplorationArea)->forceFill(['name' => 'The Great Plains']),
            'images/exploration/the_great_plains.webp',
        ];

        $egg = self::creature('Egg', 'Blizz');
        $blizz = self::creature('Blizz', 'Blizz');
        $uppercase = self::creature('EGG', 'BLIZZ');
        $missing = self::creature('Egg', 'No Such Family');

        yield 'creature with a distinct name' => [
            $egg,
            'images/creatures/blizz/blizz_egg.webp',
        ];

        yield 'creature sharing its family name' => [
            $blizz,
            'images/creatures/blizz/blizz.webp',
        ];

        yield 'creature lookup is case insensitive' => [
            $uppercase,
            'images/creatures/blizz/blizz_egg.webp',
        ];

        yield 'creature without an image file' => [
            $missing,
            null,
        ];

        yield 'user pet without a specialty or variety' => [
            self::userPet($egg, SpecialtyEnum::None, 0),
            'images/creatures/blizz/blizz_egg.webp',
        ];

        yield 'user pet with a noble specialty' => [
            self::userPet($egg, SpecialtyEnum::Noble, 0),
            'images/creatures/blizz/noble_blizz_egg.webp',
        ];

        yield 'user pet with an exalted specialty' => [
            self::userPet($egg, SpecialtyEnum::Exalted, 0),
            'images/creatures/blizz/exalted_blizz_egg.webp',
        ];

        yield 'user pet with a specialty above exalted has no prefix' => [
            self::userPet($egg, SpecialtyEnum::Exotic, 0),
            'images/creatures/blizz/blizz_egg.webp',
        ];

        yield 'user pet with a variety' => [
            self::userPet($egg, SpecialtyEnum::None, 2),
            null,
        ];

        yield 'user pet with a specialty and variety' => [
            self::userPet($egg, SpecialtyEnum::Noble, 2),
            null,
        ];
    }

    public function test_user_pet_variety_is_included_in_the_path_when_the_file_exists(): void
    {
        File::shouldReceive('exists')
            ->once()
            ->with(public_path('images/creatures/blizz/2_blizz_egg.webp'))
            ->andReturn(true);

        $pet = self::userPet(self::creature('Egg', 'Blizz'), SpecialtyEnum::None, 2);

        $this->assertSame(
            asset('images/creatures/blizz/2_blizz_egg.webp'),
            $pet->getAttribute('image_link')
        );
    }

    private static function creature(string $name, string $familyName): Creature
    {
        $creature = (new Creature)->forceFill(['name' => $name]);
        $creature->setRelation('family', (new Family)->forceFill(['name' => $familyName]));

        return $creature;
    }

    private static function userPet(Creature $creature, SpecialtyEnum $specialty, int $variety): UserPet
    {
        $pet = (new UserPet)->forceFill([
            'specialty' => $specialty,
            'variety' => $variety,
        ]);
        $pet->setRelation('creature', $creature);

        return $pet;
    }
}
