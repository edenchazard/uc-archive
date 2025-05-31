<x-page>
    <aside aria-label="creatures by id order">
        <ul class="flex flex-row flex-wrap justify-between items-end">
            <x-creature-nav :direction="'previous'" :pet='$closestCreatures["previous"]'></x-creature-nav>
            <x-creature-nav :direction="'current'" :pet='$pet'></x-creature-nav>
            <x-creature-nav :direction="'next'" :pet='$closestCreatures["next"]'></x-creature-nav>
        </ul>
    </aside>
    <section id='creature-introduction' class="my-2">
        <h1>{{ Breadcrumbs::pageTitle() }}</h1>
        <h2 class='italic text-sm'>
            From the
            <a class='main-article' href='{{ route("creatures.family.show", $family) }}' aria-labelledby="{{ $pet->creature->name }}">{{$family->name}}</a>
            family
        </h2>
        <div class="flex flex-row flex-wrap gap-3 justify-center">
            <img src='{{ $pet->image_link }}' alt="{{ $pet->creature->name }}" class="self-center" />
            <div class="max-w-sm">
                <div class="flex flex-col gap-2">
                    <p><span class='font-bold'>{{ $pet->creature->name }}</span> is the {{ Number::ordinal($pet->creature->stage) }}{{  $pet->creature->required_clicks === 0 ? ' and final' : '' }} evolution of the {{$family->name}} family and {{ Number::ordinal($pet->creature->id) }} creature overall.</p>
                    <p>Being a member of the {{$family->name}} family, its elemental type is {{ $family->element->value }} with a rarity rating of {{ $family->rarity->friendlyName() }}{!! $family->unique_rating ? " <span class='font-bold'>(".$family->unique_rating->value.")</span>" : '' !!}.</p>
                    <p>It was released on <time>{{ $family->released->format('jS F o') }}</time>.</p>
                    <p class="flex flex-wrap align-middle justify-center gap-3 flex-row sm:flex-nowrap py-3 sm:px-5">
                        <img
                            src='{{ $pet->creature->consumable->image_link }}'
                            alt='{{ $pet->creature->consumable->name }}'
                            class="self-center"/>
                        Interacting with {{$pet->creature->name}} while exploring would earn you the {{$pet->creature->consumable->name}} component.
                        @if ($pet->creature->required_clicks > 0)
                        It requires {{$pet->creature->required_clicks}} clicks to evolve.
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </section>
    <x-content-section :title='"visual description"'>
        <x-formatted-block :text="$pet->short_description" />
    </x-content-section>
    <x-content-section :title='"lifestyle"'>
        <x-formatted-block :text="$pet->long_description" />
    </x-content-section >
    <x-content-section :title='"variations"'>
        @if ($alts->isNotEmpty())
            <div class="flex flex-wrap items-end gap-3">
                @foreach (['normal' => $pet, ...$alts] as $altName => $alt)
                    <div class="flex flex-col justify-between items-center">
                        <img src="{{ $alt->image_link }}" alt="{{ ucfirst($altName) }}" />
                        <span>{{ ucfirst($altName) }}</span>
                    </div>
                @endforeach
            </div>
        @else
            N/A
        @endif
    </x-content-section>
    <x-content-section :title='"Max Stats"'>
        @if ($pet->creature->max_stat_points > 0)
        <table class='w-full'>
            <thead>
                <tr class='flex flex-col sm:table-row'>
                    @foreach ([...$pet->creature->max_stats->keys(), 'Total'] as $stat)
                        <th>{{ ucfirst($stat) }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                <tr class="flex flex-col sm:table-row">
                    @foreach ([...$pet->creature->max_stats, $pet->creature->max_stat_points] as $stat)
                        <td class="odd:bg-[#add0eb] even:bg-uc-blue text-center">{{ $stat }}</td>
                    @endforeach
                </tr>
            </tbody>
        </table>
        @else
        N/A
        @endif
    </x-content-section>
    <x-content-section :title='"training options"'>
        @if ($pet->creature->trainingOptions->count() > 0)
        <table>
            <thead>
                <tr class='flex flex-col md:table-row'>
                    <th>Title</th>
                    <th>Energy Cost</th>
                    <th>Reward</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pet->creature->trainingOptions as $option)
                <tr class="flex flex-col odd:bg-[#add0eb] even:bg-uc-blue md:table-row">
                    <td>{{ $option->title }}</td>
                    <td>{{ $option->energy_cost }}</td>
                    <td>{{ $option->reward }}</td>
                    <td>
                        <x-formatted-block :text="$option->format($pet)" />
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        N/A
        @endif
    </x-content-section>
</x-page>
