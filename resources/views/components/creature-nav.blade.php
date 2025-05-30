<li
    aria-current="{{ $direction === 'current' }}">
    @if ($pet)
        <a
            href='{{ route("creatures.family.creature.show", [$pet->creature->family, $pet->creature]) }}'
            class="text-center flex flex-col items-center">
            <img
                src='{{ $pet->image_link }}'
                alt=""
                class="max-w-10 max-h-10 self-center"/>
            <span>#{{$pet->creature->id}}</span>
            <span>{{$pet->creature->name}}</span>
            @if($direction === 'current')
                <span class="font-bold">This creature</span>
            @else
                {{ ucfirst($direction) }}
            @endif
        </a>
        @elseif ($direction === 'next')
            End
        @elseif ($direction === 'previous')
            Start
    @endif
</li>
