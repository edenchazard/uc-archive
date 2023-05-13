<x-page :data='$page'>
    <aside aria-label="creatures by id order">
        <ul class="flex flex-row flex-wrap justify-between items-end">
            <x-creature-nav :direction="'previous'" :pet='$closestCreatures[0]'></x-creature-nav>
            <x-creature-nav :direction="'current'" :pet='$pet'></x-creature-nav>
            <x-creature-nav :direction="'next'" :pet='$closestCreatures[1]'></x-creature-nav>
        </ul>
    </aside>
    <section id='creature-introduction' class="my-2">
        <h1>Creature: {{ $pet->creature->name }}</h1>
        <h2 class='italic text-sm'>
            From the 
            <a class='main-article' href='{{ route("family", [$family->name]) }}' aria-labelledby="{{ $pet->creature->name }}">{{$family->name}}</a>
            family
        </h2>
        <div class="flex flex-row flex-wrap gap-3 justify-center">
            <img
                src='{{ $pet->imageLink() }}'
                alt="{{ $pet->creature->name }}"
                class="self-center"/>
            {{-- to do convert stage to ordinal suffix --}}
            <div class="max-w-sm">
                <div class="flex flex-col gap-2">
                    <p><span class='font-bold'>{{ $pet->creature->name }}</span> is the {{$pet->creature->stage}} evolution of the {{$family->name}} family and {{ $pet->creature->id }} creature overall. Being a member of the {{$family->name}} family, its elemental type is {{$family->element}} with a rarity rating of {{$family->rarity}}.</p>
                    <p>It was released on <time>{{$family->released}}</time>.</p>
                    <p class="flex flex-wrap align-middle justify-center gap-3 flex-row sm:flex-nowrap py-3 sm:px-5">
                        <img
                            src='{{ asset(strtolower("images/components/" . $pet->creature->consumable->name .".png")) }}'
                            alt='{{ $pet->creature->consumable->name }}'
                            class="self-center"/>
                        Clicking {{$pet->creature->name}} would earn you the {{$pet->creature->consumable->name}} component.
                        @if ($pet->creature->requiredClicks > 0)
                            It requires {{$pet->creature->requiredClicks}} clicks to evolve.
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section id='visual-description'>
        <h2 class="my-2 section-title">
            <a href='#visual-description'>Visual description</a>
        </h2>
        <x-creature-formatted-block :text="$pet->creature->shortDescription" :creature="$pet->creature" />
    </section>
    <section id='lifestyle'>
        <h2 class="my-2 section-title">
            <a href='#lifestyle'>Lifestyle</a>
        </h2>
        <x-creature-formatted-block :text="$pet->creature->longDescription" :creature="$pet->creature" />
    </section>
    <section id='general'>
        <h2 class="my-2 section-title">
            <a href='#general'>Training options</a>
        </h2>
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
                @forelse ($pet->creature->trainingOptions as $option)
                    <tr class="flex flex-col odd:bg-[#add0eb] even:bg-uc-blue md:table-row">
                        <td>{{ $option->title }}</td>
                        <td>{{ $option->energyCost }}</td>
                        <td>{{ $option->reward }}</td>
                        <td>
                            <x-creature-formatted-block :text="$option->description" :creature="$pet->creature" :additional="['*' => $pet->creature->name]" />
                        </td>
                    </tr>
                @empty
                    None.
                @endforelse
            </tbody>
        </table>
    </section>
</x-page>