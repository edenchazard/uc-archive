<ol {{ $attributes->merge(['class' => 'flex flex-row flex-wrap items-stretch list-none gap-2 evolutionary-line']) }}>
    @foreach ($family->stages as $creature)
        <li class="flex flex-col justify-between items-center">
            <span>{{ $creature->name }}</span>
            <img src='{{ CreatureUtils::imageLink($creature) }}'
                alt="{{ $creature->name }}" 
                class='creature-image' />
        </li>
        <li aria-hidden="true" role="presentation" class="flex flex-col items-center justify-center last:hidden">→</li>
    @endforeach
</ol>