<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Alt
 *
 * @property int $id
 * @property int $family_id
 * @property string $name
 * @property int $enabled
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Family|null $family
 * @method static \Illuminate\Database\Eloquent\Builder|Alt newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Alt newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Alt query()
 * @method static \Illuminate\Database\Eloquent\Builder|Alt whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Alt whereEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Alt whereFamilyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Alt whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Alt whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Alt whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Alt extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Consumable
 *
 * @property int $id
 * @property string $name
 * @property string $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Consumable newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Consumable newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Consumable query()
 * @method static \Illuminate\Database\Eloquent\Builder|Consumable whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Consumable whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Consumable whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Consumable whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Consumable whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Consumable extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Creature
 *
 * @property int $id
 * @property string $name
 * @property int $stage
 * @property string $short_description
 * @property string $long_description
 * @property int $required_clicks
 * @property int $max_strength
 * @property int $max_agility
 * @property int $max_speed
 * @property int $max_intelligence
 * @property int $max_wisdom
 * @property int $max_charisma
 * @property int $max_creativity
 * @property int $max_willpower
 * @property int $max_focus
 * @property int $family_id
 * @property int $component_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Consumable|null $consumable
 * @property-read \App\Models\Family|null $family
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\TrainingOption> $trainingOptions
 * @property-read int|null $training_options_count
 * @method static \Illuminate\Database\Eloquent\Builder|Creature locate(string|int $family, string|int $creature)
 * @method static \Illuminate\Database\Eloquent\Builder|Creature newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Creature newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Creature query()
 * @method static \Illuminate\Database\Eloquent\Builder|Creature whereComponentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Creature whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Creature whereFamilyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Creature whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Creature whereLongDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Creature whereMaxAgility($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Creature whereMaxCharisma($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Creature whereMaxCreativity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Creature whereMaxFocus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Creature whereMaxIntelligence($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Creature whereMaxSpeed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Creature whereMaxStrength($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Creature whereMaxWillpower($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Creature whereMaxWisdom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Creature whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Creature whereRequiredClicks($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Creature whereShortDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Creature whereStage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Creature whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Creature joinFamily(bool $selectFamilyTable = false)
 * @method static \Illuminate\Database\Eloquent\Builder|Creature orderByFamilyName()
 * @mixin \Eloquent
 */
	class Creature extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Family
 *
 * @property int $id
 * @property string $name
 * @property int $in_basket
 * @property int $deny_exalt
 * @property int $has_alts
 * @property int $gender
 * @property int $rarity
 * @property int $unique_rating
 * @property int $element
 * @property string $released
 * @property string $availability_begin
 * @property string $availability_end
 * @property int $base_strength
 * @property int $base_agility
 * @property int $base_speed
 * @property int $base_intelligence
 * @property int $base_wisdom
 * @property int $base_charisma
 * @property int $base_creativity
 * @property int $base_willpower
 * @property int $base_focus
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Creature> $stages
 * @property-read int|null $stages_count
 * @method static \Illuminate\Database\Eloquent\Builder|Family newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Family newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Family query()
 * @method static \Illuminate\Database\Eloquent\Builder|Family whereAvailabilityBegin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Family whereAvailabilityEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Family whereBaseAgility($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Family whereBaseCharisma($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Family whereBaseCreativity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Family whereBaseFocus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Family whereBaseIntelligence($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Family whereBaseSpeed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Family whereBaseStrength($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Family whereBaseWillpower($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Family whereBaseWisdom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Family whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Family whereDenyExalt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Family whereElement($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Family whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Family whereHasAlts($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Family whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Family whereInBasket($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Family whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Family whereRarity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Family whereReleased($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Family whereUniqueRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Family whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Alt> $alts
 * @property-read int|null $alts_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Creature> $creatures
 * @property-read int|null $creatures_count
 * @mixin \Eloquent
 */
	class Family extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\TrainingOption
 *
 * @property int $id
 * @property int $creature_id
 * @property string $title
 * @property string $description
 * @property int $energy_cost
 * @property string $reward
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|TrainingOption newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TrainingOption newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TrainingOption query()
 * @method static \Illuminate\Database\Eloquent\Builder|TrainingOption whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrainingOption whereCreatureId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrainingOption whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrainingOption whereEnergyCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrainingOption whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrainingOption whereReward($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrainingOption whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrainingOption whereUpdatedAt($value)
 * @property-read \App\Models\Creature|null $creature
 * @mixin \Eloquent
 */
	class TrainingOption extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UserPet
 *
 * @property int $id
 * @property int $creature_id
 * @property int $specialty
 * @property int $variety
 * @property string $nickname
 * @property int $gender
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Creature|null $creature
 * @method static \Database\Factories\UserPetFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|UserPet newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserPet newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserPet query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserPet whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPet whereCreatureId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPet whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPet whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPet whereNickname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPet whereSpecialty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPet whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPet whereVariety($value)
 * @mixin \Eloquent
 */
	class UserPet extends \Eloquent {}
}

