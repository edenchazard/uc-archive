<li
    aria-current="{{ $direction === 'current' }}">
    @if ($creature)
        <a 
            href='{{ route("creature", [$creature->family->name, $creature->name]) }}'
            class="text-center flex flex-col items-center">
            <img 
                src='{{ CreatureUtils::imageLink($creature) }}'
                alt=""
                class="max-w-10 max-h-10 self-center"/>
            <span>#{{$creature->id}}</span>
            <span>{{$creature->name}}</span>
            @if($direction === 'current')
                <span class="font-bold">This creature</span>
            @else
                {{ ucfirst($direction) }}
            @endif
        </a>
    @endif
</li>