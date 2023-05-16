<x-page :data='$page'>
    <section id="family-introduction">
        <h1>Family: {{$family->name}}</h1>
        <section id='evolutionary-line'>
            <x-evolutionary-line :stages='$stages' class="justify-center" />
        </section>
        <div class="flex justify-center">
            <div class="max-w-sm">
                <p>The <span class='font-bold'>{{ $family->name }}</span> family was released on <time>{{ $family->released() }}</time> with {{ count($stages) }} evolutions. 
                @if ($family->gender <= 1)
                    It was {{ $family->gender() }}-only.
                @elseif ($family->gender === 3)
                    It was available in both genders.
                @else
                    It had a unique gender, {{ $family->gender() }}.
                @endif
                </p>
                <p>All members within this family are of the {{ ucfirst($family->element()) }} element with a rarity rating of {{ ucfirst($family->rarity()) }}{!! $family->unique_rating > 0 ? " <span class='font-bold'>(".ucfirst($family->uniqueRating()).")</span>" : '' !!}.
                    @if (!$family->deny_exalt)
                        Noble versions would be {{ CreatureUtils::rarity($family->rarity + 1) }} and exalteds would be {{ ucfirst(CreatureUtils::rarity($family->rarity + 2)) }}.
                    @endif
                </p>
                <p>It could 
                    @if ($family->rarity <= 7)
                        only be found through exploration{{ $family->in_basket ? ' or in the basket' : '' }}.
                    @elseif ($family->rarity === 8)
                        only be obtained via limited means, such as from events, the shop or transmutation.
                    @elseif ($family->rarity === 10)
                        only be bought from the exotic shop with an exotic credit
                        @if ($family->unique_rating === 1)
                            at certain times of the year.
                        @elseif ($family->unique_rating === 2)
                            during its period of availability. After leaving the shop, it was retired permanently.
                        @endif
                    @elseif ($family->rarity === 11)
                        only be obtained by transmuting it from the shop.
                    @endif
                </p>
            </div>
        </div>
    </section>
    <section id='base-stats' class="mt-4">
        <h2 class="my-2 section-title">
            <a href='#base-stats'>Base Stats</a>
        </h2>
        <table class='w-full'>
            <thead>
                <tr class='flex flex-col sm:table-row'>
                    @foreach ($family->getBaseStats()->keys() as $stat)
                        <th>{{ ucfirst($stat) }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                <tr class="flex flex-col sm:table-row">
                    @foreach ($family->getBaseStats() as $stat)
                        <td class="odd:bg-[#add0eb] even:bg-uc-blue text-center">{{ $stat }}</td>
                    @endforeach
                </tr>
            </tbody>
        </table>
    </section>
    <section id='evolutions' class="mt-4">
        <h2 class="my-2 section-title">
            <a href='#evolutions'>Evolutions</a>
        </h2>
        @foreach ($stages as $stage)
            <article class='flex flex-col justify-center items-start p-3 gap-2' id='{{ $stage->creature->name }}'>
                <img
                    src='{{ $stage->imageLink() }}'
                    alt="{{ $stage->creature->name }}"
                    class="self-start" />
                <div>
                    <h3 class='inline font-medium'>{{ $stage->creature->name }}</h3>
                    <x-article-link :url='route("creature", [$family->name, $stage->creature->name])' />
                </div>
                <section>
                    <h4 class='font-medium'>Visual Description</h4>
                    <x-creature-formatted-block :text="$stage->creature->short_description" :pet="$stage" />
                </section>
                <section>
                    <h4 class='font-medium'>Lifestyle</h4>
                    <x-creature-formatted-block :text="$stage->creature->long_description" :pet="$stage" />
                </section>
            </article>
        @endforeach
    </section>
</x-page>
