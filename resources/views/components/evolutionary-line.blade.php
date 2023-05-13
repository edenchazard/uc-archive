<ol {{ $attributes->merge(['class' => 'flex flex-row flex-wrap items-stretch list-none gap-2 evolutionary-line']) }}>
    @foreach ($stages as $pet)
        <li class="flex flex-col justify-between items-center">
            <span>{{ $pet->creature->name }}</span>
            <img src='{{ $pet->imageLink() }}'
                alt="{{ $pet->creature->name }}" 
                class='creature-image' />
        </li>
        <li aria-hidden="true" role="presentation" class="flex flex-col items-center justify-center last:hidden">→</li>
    @endforeach
</ol>