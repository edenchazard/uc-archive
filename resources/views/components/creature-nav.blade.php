<li
    aria-current="{{ $direction === 'current' }}">
    @if ($pet)
        <a 
            href='{{ route("creature", [$pet->creature->family->name, $pet->creature->name]) }}'
            class="text-center flex flex-col items-center">
            <img 
                src='{{ $pet->imageLink() }}'
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
    @endif
</li>