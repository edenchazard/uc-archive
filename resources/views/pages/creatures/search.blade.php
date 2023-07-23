<x-page :data='$page'>
    <section id="results">
        <h1>Search</h1>
        @if ($results->first())
            <p><span class='font-bold'>'{{ $query }}'</span> doesn't match a specific family, however there are creatures with that name. Did you mean:</p>
            <ul class="grid grid-cols-fill-auto gap-5 m-5" >
            @foreach ($results as $pet)
                <li class='flex flex-col'>
                    <a class='flex flex-1 flex-col items-center text-center justify-between' href="{{ route('creatures.family.creature.show', [$pet->creature->family, $pet->creature]) }}">
                        <img src='{{ $pet->imageLink() }}' class='' />
                        {{ $pet->creature->family->name }} {{ $pet->creature->name }}
                    </a>
                </li>
            @endforeach
            </ul>
        @else
            The family <span class='font-bold'>'{{ $query }}'</span> doesn't exist and no creature results were found. <a href="{{ route('creatures.index') }}">Go to the creatures index</a>.
        @endif
    </section>
</x-page>
