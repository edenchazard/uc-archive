<x-page :data='$page'>
    <aside aria-label="creatures by id order">
        <ul class="flex flex-row flex-wrap justify-between items-end">
            <x-creature-nav :direction="'previous'" :creature='$closestCreatures[0]'></x-creature-nav>
            <x-creature-nav :direction="'current'" :creature='$creature'></x-creature-nav>
            <x-creature-nav :direction="'next'" :creature='$closestCreatures[1]'></x-creature-nav>
        </ul>
    </aside>
    <section id='creature-introduction' class="my-2">
        <h1>Creature: {{ $creature->name }}</h1>
        <h2 class='italic text-sm'>
            From the 
            <a class='main-article' href='{{ route("family", [$family->name]) }}' aria-labelledby="{{ $creature->name }}">{{$family->name}}</a>
            family
        </h2>
        <div class="flex flex-row flex-wrap gap-3 justify-center">
            <img
                src='{{ asset("images/creatures/" . $family->name . "/" . strtolower($family->name . "_" . $creature->name . ".png")) }}'
                alt="{{ $creature->name }}"
                class="self-center"/>
            {{-- to do convert stage to ordinal suffix --}}
            <div class="max-w-sm">
                <div class="flex flex-col gap-2">
                    <p><span class='font-bold'>{{ $creature->name }}</span> is the {{$creature->stage}} evolution of the {{$family->name}} family and {{ $creature->id }} creature overall. Being a member of the {{$family->name}} family, its elemental type is {{$family->element}} with a rarity rating of {{$family->rarity}}.</p>
                    <p>It was released on <time>{{$family->released}}</time>.</p>
                    <p class="flex flex-wrap align-middle justify-center gap-3 flex-row sm:flex-nowrap py-3 sm:px-5">
                        <img
                            src='{{ asset(strtolower("images/components/" . $creature->consumable->name .".png")) }}'
                            alt='{{ $creature->consumable->name }}'
                            class="self-center"/>
                        Clicking {{$creature->name}} would earn you the {{$creature->consumable->name}} component.
                        @if ($creature->requiredClicks > 0)
                            It requires {{$creature->requiredClicks}} clicks to evolve.
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
        {{$creature->shortDescription}}
    </section>
    <section id='lifestyle'>
        <h2 class="my-2 section-title">
            <a href='#lifestyle'>Lifestyle</a>
        </h2>
        {{$creature->longDescription}}
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
                @forelse ($creature->trainingOptions as $option)
                    <tr class="flex flex-col odd:bg-[#add0eb] even:bg-uc-blue md:table-row">
                        <td>{{ $option->title }}</td>
                        <td>{{ $option->energyCost }}</td>
                        <td>{{ $option->reward }}</td>
                        <td>{{ $option->description }}</td>
                    </tr>
                @empty
                    None.
                @endforelse
            </tbody>
        </table>
    </section>
</x-page>